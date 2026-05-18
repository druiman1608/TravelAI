import React from "react";
import { useParams, Link, useNavigate } from "react-router-dom";
import { useItemDetail } from "../../../hooks/Data/useItemDetail";
import LoadingScreen from "../../../components/Common/LoadingScreen";
import styles from "./FlightDetails.module.css";
import { HiArrowLeft } from "react-icons/hi";
import { MdOutlineBackpack, MdLuggage } from "react-icons/md";
import ReviewSection from "../../../components/ReviewSection/ReviewSection";

export default function FlightDetails() {
  const { id } = useParams();

  const navigate = useNavigate();
  const { item: offer, loading } = useItemDetail("/flight-offers", id);

  if (loading) return <LoadingScreen />;

  if (!offer || !offer.ida) {
    return (
      <div className="container mt-5">Datos del vuelo no disponibles.</div>
    );
  }
  const precioFinal = Math.ceil(offer.precio_total || offer.precio || 0);

  const FlightInfo = ({ flight, title }) => (
    <section className={styles.flightSection}>
      <h2 className={styles.flightTitle}>
        Vuelo {flight.origen} - {flight.destino}
      </h2>
      <p className={styles.subHeader}>Directo | {flight.duracion}</p>

      <div className={styles.flightMainContent}>
        <div className={styles.timelineContainer}>
          <div className={styles.timelineItem}>
            <div className={styles.timeData}>
              <strong>
                {new Date(flight.salida).toLocaleDateString()} -{" "}
                {new Date(flight.salida).toLocaleTimeString([], {
                  hour: "2-digit",
                  minute: "2-digit",
                })}
              </strong>
              <span>
                {flight.origen} - Aeropuerto de {flight.origen}
              </span>
            </div>
          </div>
          <div className={styles.timelineItem}>
            <div className={styles.timeData}>
              <strong>
                {new Date(flight.llegada).toLocaleDateString()} -{" "}
                {new Date(flight.llegada).toLocaleTimeString([], {
                  hour: "2-digit",
                  minute: "2-digit",
                })}
              </strong>
              <span>
                {flight.destino} - Aeropuerto de {flight.destino}
              </span>
            </div>
          </div>
        </div>

        <div className={styles.airlineInfoSide}>
          <img
            src={flight.imagen_url || "/emirates-logo.png"}
            alt="Airline Logo"
            className={styles.bigLogo}
          />
          <div className={styles.airlineText}>
            <h3>{flight.aerolinea}</h3>
            <p>{offer.id_vuelo || "EK6648"} · Turista</p>
            <p className={styles.durationLabel}>
              Duración del vuelo: {flight.duracion}
            </p>
          </div>
        </div>
      </div>
    </section>
  );

  const handleReserve = () => {
    navigate("/checkout", { state: { flight: offer, type: "flight" } });
  };

  return (
    <div className={styles.mainContainer}>
      <Link to="/vuelos" className={styles.backBtn}>
        <div className={styles.backCircle}>
          <HiArrowLeft />
        </div>
        <span>Volver</span>
      </Link>

      <div className={styles.topCard}>
        <div className={styles.titleArea}>
          <h1 className={styles.topCardTitle}>
            {offer.ida.origen} — {offer.ida.destino}
          </h1>
          <p className={styles.topCardSub}>{offer.ida.aerolinea}</p>
        </div>
        <button className={styles.btnReserveTop} onClick={handleReserve}>
          Reservar ahora
        </button>
      </div>

      <div className={styles.whiteWrapperCard}>
        <FlightInfo flight={offer.ida} />
        {offer.vuelta && (
          <div className={styles.dividerWrapper}>
            <FlightInfo flight={offer.vuelta} />
          </div>
        )}
      </div>

      <div className={styles.whiteWrapperCard}>
        <h2 className={styles.extras}>Extras</h2>

        <div className={styles.detailRow}>
          <div className={styles.rowLeft}>
            <h4>Equipaje incluido</h4>
            <p>El equipaje total incluido en el precio</p>
          </div>
          <div className={styles.blueSeparator}></div>
          <div className={styles.rowRight}>
            <MdOutlineBackpack className={styles.rowIcon} />
            <div>
              <strong>1 Mochila personal</strong>
              <p>Se guarda bajo el asiento</p>
            </div>
            <span className={styles.statusGreen}>Incluido en el precio</span>
          </div>
        </div>

        <div className={styles.detailRow}>
          <div className={styles.rowLeft}>
            <h4>Condiciones de la tarifa</h4>
            <p>Información útil sobre condiciones</p>
          </div>
          <div className={styles.blueSeparator}></div>
          <div className={styles.rowRight}>
            <p className={styles.condicionesText}>
              Los usuarios <span className={styles.gold}>premium</span> pueden
              cancelar en cualquier momento.
              <br />
              <br />
              Los usuarios <span className={styles.red}>no premium</span> no
              podrán cancelar el vuelo pasadas 2 horas desde su reserva.
            </p>
          </div>
        </div>

        <div className={styles.detailRow}>
          <div className={styles.rowLeft}>
            <h4>Extras</h4>
            <p>Se añaden por un suplemento</p>
          </div>
          <div className={styles.blueSeparator}></div>
          <div className={styles.rowRight}>
            <div className={styles.extraItem}>
              <MdOutlineBackpack className={styles.rowIcon} />
              <div>
                <strong>1 Mochila personal</strong>
                <p>Se guarda bajo el asiento</p>
              </div>
            </div>
            <div className={styles.extraItem}>
              <MdLuggage className={styles.rowIcon} />
              <div>
                <strong>Equipaje de mano/facturado</strong>
                <p>A partir de 55,90€</p>
              </div>
            </div>
          </div>
        </div>

        <div className={styles.footerAction}>
          <span className={styles.totalPriceLabel}>Precio total</span>
          <span className={styles.totalPriceDisplay}>{precioFinal}€</span>
        </div>
      </div>

      <div className={styles.reviewsWrapper}>
        <ReviewSection
          reviews={offer.reviews || []}
          entityType="flight_id"
          entityId={offer.ida?.vuelo_id}
        />
      </div>
    </div>
  );
}
