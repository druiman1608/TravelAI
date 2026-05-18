import React, { useState, useMemo, useEffect } from "react";
import { useNavigate, useLocation } from "react-router-dom";
import api from "../../api/axios";
import styles from "./Planner.module.css";
import { useHotelsData } from "../../hooks/Data/useHotelsData";
import { useFlightsData } from "../../hooks/Data/useFlightsData";
import { useActivitiesData } from "../../hooks/Data/useActivitiesData";
import { HiOutlineTrash, HiPlus, HiX, HiLocationMarker } from "react-icons/hi";
import { MdOutlineLocalActivity } from "react-icons/md";
import { LiaHotelSolid } from "react-icons/lia";
import { SlPlane } from "react-icons/sl";
import HotelSelector from "../../components/Planner/Selectors/HotelSelector";
import FlightSelector from "../../components/Planner/Selectors/FlightSelector";
import ActivitySelector from "../../components/Planner/Selectors/ActivitySelector";

export default function Planner() {
  const navigate = useNavigate();
  const locationState = useLocation();
  const [activeSelector, setActiveSelector] = useState(null);
  const [selection, setSelection] = useState({
    flight: null,
    hotel: null,
    activity: null,
  });
  const [globalDest, setGlobalDest] = useState("");
  const [preloading, setPreloading] = useState(false);

  useEffect(() => {
    const bookingIds = locationState.state?.bookingIds;
    if (!bookingIds) return;

    const preselect = async () => {
      setPreloading(true);
      try {
        const [hotelRes, flightRes, activityRes] = await Promise.allSettled([
          bookingIds.hotel_id       ? api.get(`/hotels/${bookingIds.hotel_id}`)            : Promise.resolve(null),
          bookingIds.flight_offer_id ? api.get(`/flight-offers/${bookingIds.flight_offer_id}`) : Promise.resolve(null),
          bookingIds.activity_id    ? api.get(`/activities/${bookingIds.activity_id}`)     : Promise.resolve(null),
        ]);

        setSelection({
          hotel:    hotelRes.status    === "fulfilled" ? hotelRes.value?.data?.data    ?? null : null,
          flight:   flightRes.status   === "fulfilled" ? flightRes.value?.data?.data   ?? null : null,
          activity: activityRes.status === "fulfilled" ? activityRes.value?.data?.data ?? null : null,
        });
      } catch {
      } finally {
        setPreloading(false);
      }
    };

    preselect();
  }, []);

  const flightIcon = <SlPlane className={styles.icon} />;
  const hotelIcon = <LiaHotelSolid className={styles.icon} />;
  const activityIcon = <MdOutlineLocalActivity className={styles.icon} />;

  const { options: hOpts = {} } = useHotelsData();
  const { options: fOpts = {} } = useFlightsData();
  const { options: aOpts = {} } = useActivitiesData();

  const allLocations = useMemo(() => {
    const locations = new Set([
      ...(hOpts?.countries || []),
      ...(fOpts?.destinations || []),
      ...(aOpts?.countries || []),
    ]);
    return Array.from(locations)
      .filter((l) => l && l !== "Todos")
      .sort();
  }, [hOpts, fOpts, aOpts]);

  const handleSelect = (type, item) => {
    setSelection((prev) => ({ ...prev, [type]: item }));
    setActiveSelector(null);
    if (!globalDest) {
      const detected = item.ubicacion_nombre || item.ida?.destino;
      if (detected) setGlobalDest(detected);
    }
  };

  const handleReservePackage = () => {
    navigate("/checkout", {
      state: {
        flight: selection.flight,
        hotel: selection.hotel,
        activity: selection.activity,
        type: "pkg",
      },
    });
  };

  const totalPrice =
    (selection.flight?.precio_total || 0) +
    (selection.hotel?.precio_noche || 0) +
    (selection.activity?.precio || 0);

  return (
    <div className={styles.plannerWrapper}>
      <div className={styles.plannerHeader}>
        <h1>Planificador Inteligente</h1>
        <p>
          {preloading
            ? "Cargando recomendaciones de la IA..."
            : "Construye tu viaje ideal combinando nuestros servicios"}
        </p>
      </div>

      <div className={styles.masterFilterCard}>
        <div className={styles.filterHeader}>
          <HiLocationMarker className={styles.filterIcon} />
          <label>¿A dónde quieres ir?</label>
        </div>
        <select
          className={styles.masterSelect}
          value={globalDest}
          onChange={(e) => setGlobalDest(e.target.value)}
        >
          <option value="">Cualquier destino...</option>
          {allLocations.map((loc) => (
            <option key={loc} value={loc}>
              {loc}
            </option>
          ))}
        </select>
        {globalDest && (
          <button className={styles.clearBtn} onClick={() => setGlobalDest("")}>
            Limpiar <HiX />
          </button>
        )}
      </div>

      <div className={styles.mainLayout}>
        <div className={styles.leftColumn}>
          <div className={styles.plannerCanvas}>
            <PlannerStep
              title="Vuelo"
              icon={flightIcon}
              data={selection.flight}
              onAdd={() => setActiveSelector("flight")}
              onRemove={() =>
                setSelection((prev) => ({ ...prev, flight: null }))
              }
            />
            <PlannerStep
              title="Hotel"
              icon={hotelIcon}
              data={selection.hotel}
              onAdd={() => setActiveSelector("hotel")}
              onRemove={() =>
                setSelection((prev) => ({ ...prev, hotel: null }))
              }
            />
            <PlannerStep
              title="Actividad"
              icon={activityIcon}
              data={selection.activity}
              onAdd={() => setActiveSelector("activity")}
              onRemove={() =>
                setSelection((prev) => ({ ...prev, activity: null }))
              }
            />
          </div>
        </div>

        <aside className={styles.rightColumn}>
          <div className={styles.priceStickyCard}>
            <h3>Resumen del Viaje</h3>
            <div className={styles.priceDetail}>
              <div className={styles.priceRow}>
                <span>Vuelo</span>
                <span>{(selection.flight?.precio_total ?? 0).toFixed(2)}€</span>
              </div>
              <div className={styles.priceRow}>
                <span>Hotel</span>
                <span>{(selection.hotel?.precio_noche ?? 0).toFixed(2)}€</span>
              </div>
              <div className={styles.priceRow}>
                <span>Actividad</span>
                <span>{(selection.activity?.precio ?? 0).toFixed(2)}€</span>
              </div>
            </div>
            <div className={styles.totalSeparator} />
            <div className={styles.totalRow}>
              <span>Total:</span>
              <span className={styles.grandTotal}>{totalPrice.toFixed(2)}€</span>
            </div>
            <button
              className={styles.checkoutBtn}
              disabled={Object.values(selection).filter(Boolean).length < 2}
              onClick={handleReservePackage}
            >
              Reservar Paquete
            </button>
            <p className={styles.helperText}>*Añade al menos 2 servicios</p>
          </div>
        </aside>
      </div>

      {activeSelector && (
        <div
          className={styles.modalOverlay}
          onClick={() => setActiveSelector(null)}
        >
          <div
            className={styles.modalContent}
            onClick={(e) => e.stopPropagation()}
          >
            <div className={styles.modalHeader}>
              <h3>Seleccionar {activeSelector}</h3>
              <button
                className={styles.closeModalBtn}
                onClick={() => setActiveSelector(null)}
              >
                <HiX />
              </button>
            </div>
            <div className={styles.selectorScroll}>
              {activeSelector === "flight" && (
                <FlightSelector
                  globalDest={globalDest}
                  onSelect={(i) => handleSelect("flight", i)}
                  onDetail={(id) => navigate(`/flights/${id}`)}
                />
              )}
              {activeSelector === "hotel" && (
                <HotelSelector
                  globalDest={globalDest}
                  onSelect={(i) => handleSelect("hotel", i)}
                  onDetail={(id) => navigate(`/hotels/${id}`)}
                />
              )}
              {activeSelector === "activity" && (
                <ActivitySelector
                  globalDest={globalDest}
                  onSelect={(i) => handleSelect("activity", i)}
                  onDetail={(id) => navigate(`/activities/${id}`)}
                />
              )}
            </div>
          </div>
        </div>
      )}
    </div>
  );
}

function PlannerStep({ title, data, onAdd, onRemove, icon }) {
  return (
    <div className={`${styles.stepCard} ${data ? styles.stepSelected : ""}`}>
      <div className={styles.stepIcon}>{icon}</div>
      <div className={styles.stepMainInfo}>
        <label>{title}</label>
        <p>
          {data
            ? data.nombre || data.ida?.aerolinea
            : `Añadir ${title.toLowerCase()}`}
        </p>
      </div>
      {data && (
        <span className={styles.stepPriceTag}>
          {(data.precio_total || data.precio_noche || data.precio || 0).toFixed(2)}€
        </span>
      )}
      <div className={styles.stepActions}>
        {data ? (
          <button onClick={onRemove} className={styles.removeBtn}>
            <HiOutlineTrash />
          </button>
        ) : (
          <button onClick={onAdd} className={styles.addBtn}>
            <HiPlus /> Seleccionar
          </button>
        )}
      </div>
    </div>
  );
}
