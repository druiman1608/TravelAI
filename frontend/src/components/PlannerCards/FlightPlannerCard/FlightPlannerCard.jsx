import React from "react";
import { useNavigate } from "react-router-dom";
import {
  HiPlus,
  HiEye,
  HiOutlineTicket,
  HiClock,
  HiArrowRight,
} from "react-icons/hi";
import styles from "./FlightPlannerCard.module.css";

export default function FlightPlannerCard({ flight, onSelect }) {
  const navigate = useNavigate();

  const info = flight.ida || flight;

  const aerolinea = info.aerolinea || flight.airline || "Aerolínea";
  const origen = info.origen || flight.origin?.name || "Origen";
  const destino = info.destino || flight.destination?.name || "Destino";
  const imagen =
    info.imagen_url || flight.image_url || "/placeholder-flight.jpg";
  const duracion = info.duracion || flight.duration_time || "--h --m";
  const precio = Math.ceil(flight.precio || flight.price || 0);

  return (
    <div className={styles.card} onClick={() => onSelect(flight)}>
      <div className={styles.imageWrapper}>
        <img src={imagen} alt={destino} className={styles.img} loading="lazy" />
        <div className={styles.priceTag}>{precio}€</div>
      </div>

      <div className={styles.content}>
        <div className={styles.headerRow}>
          <span className={styles.badge}>
            <HiOutlineTicket /> Vuelo
          </span>
          <span className={styles.duration}>
            <HiClock /> {duracion}
          </span>
        </div>

        <h4 className={styles.title}>
          {origen}{" "}
          <HiArrowRight className={styles.arrowIcon} />{" "}
          {destino}
        </h4>

        <p className={styles.airline}>{aerolinea}</p>

        <div className={styles.actions}>
          <button
            className={styles.btnView}
            onClick={(e) => {
              e.stopPropagation();
              navigate(`/flights/${flight.id}`);
            }}
          >
            <HiEye /> Detalles
          </button>
          <div className={styles.btnAdd}>
            <HiPlus /> Añadir
          </div>
        </div>
      </div>
    </div>
  );
}
