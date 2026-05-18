import React from "react";
import { useApi } from "../../../hooks/useApi";
import styles from "./MyBookings.module.css";
import {
  HiTicket,
  HiCalendar,
  HiOfficeBuilding,
  HiPaperAirplane,
  HiGift,
  HiStar,
} from "react-icons/hi";
import { Link } from "react-router-dom";

const TYPE_ICON = {
  hotel: <HiOfficeBuilding />,
  vuelo: <HiPaperAirplane />,
  paquete: <HiGift />,
  actividad: <HiStar />,
};

function getStatusClass(status) {
  if (!status) return styles.statusPending;
  const s = status.toLowerCase();
  if (s === "confirmed" || s === "confirmada") return styles.statusConfirmed;
  if (s === "cancelled" || s === "cancelada") return styles.statusCancelled;
  return styles.statusPending;
}

function getServiceName(b) {
  return (
    b.resumen?.hotel ||
    b.resumen?.vuelo ||
    b.resumen?.actividad ||
    b.resumen?.paquete ||
    "Servicio reservado"
  );
}

function getServiceType(b) {
  if (b.resumen?.hotel) return "hotel";
  if (b.resumen?.vuelo) return "vuelo";
  if (b.resumen?.paquete) return "paquete";
  if (b.resumen?.actividad) return "actividad";
  return null;
}

export default function MyBookings() {
  const { data: bookings, loading } = useApi("/reservations");

  return (
    <div className={styles.viewWrapper}>
      <header className={styles.header}>
        <h2>Mis Reservas</h2>
        <p>Consulta el historial de tus aventuras.</p>
      </header>

      <div className={styles.mainContainer}>
        {loading ? (
          <div className={styles.loadingState}>
            <div className={styles.spinner} />
            <p>Cargando tus planes...</p>
          </div>
        ) : bookings.length === 0 ? (
          <div className={styles.centeredState}>
            <HiTicket className={styles.emptyIcon} />
            <h3>Sin reservas todavía</h3>
            <p>No tienes ninguna reserva activa. Explora nuestros destinos.</p>
            <Link to="/inicio" className={styles.planBtn}>
              Buscar viajes
            </Link>
          </div>
        ) : (
          <div className={styles.list}>
            {bookings.map((b) => {
              const tipo = getServiceType(b);
              return (
                <div key={b.id} className={styles.bookingCard}>
                  <div className={styles.typeIcon}>
                    {TYPE_ICON[tipo] || <HiTicket />}
                  </div>
                  <div className={styles.cardInfo}>
                    <h3>{getServiceName(b)}</h3>
                    <div className={styles.meta}>
                      {b.fecha && (
                        <span className={styles.metaItem}>
                          <HiCalendar /> {b.fecha}
                        </span>
                      )}
                      <span
                        className={`${styles.statusTag} ${getStatusClass(b.estado)}`}
                      >
                        {b.estado || "Pendiente"}
                      </span>
                    </div>
                  </div>
                  <div className={styles.priceTag}>{b.precio_total}€</div>
                </div>
              );
            })}
          </div>
        )}
      </div>
    </div>
  );
}
