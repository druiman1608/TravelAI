import React from "react";
import { useReviews } from "../../../../hooks/useReviews";
import {
  HiCheckCircle,
  HiXCircle,
  HiStar,
  HiOfficeBuilding,
  HiTicket,
  HiPaperAirplane,
  HiGift,
} from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";

const SERVICE_BADGE = {
  hotel_id: { label: "Hotel", icon: HiOfficeBuilding, cls: styles.badgeHotel },
  activity_id: { label: "Actividad", icon: HiTicket, cls: styles.badgeActivity },
  flight_id: { label: "Vuelo", icon: HiPaperAirplane, cls: styles.badgeFlight },
  package_id: { label: "Paquete", icon: HiGift, cls: styles.badgePackage },
};

function ServiceBadge({ review }) {
  const key = ["hotel_id", "activity_id", "flight_id", "package_id"].find(
    (k) => review.referencia?.[k],
  );
  if (!key) return <span>—</span>;
  const { label, icon: Icon, cls } = SERVICE_BADGE[key];
  return (
    <span className={`${styles.badge} ${cls}`}>
      <Icon /> {label}
    </span>
  );
}

function Stars({ count }) {
  return (
    <div className={styles.starRow}>
      {Array.from({ length: 5 }, (_, i) => (
        <HiStar
          key={i}
          className={i < count ? styles.starFilled : styles.starEmpty}
        />
      ))}
    </div>
  );
}

export default function ReviewsModCrud() {
  const { data: reviews, loading, updateStatus } = useReviews();

  if (loading)
    return (
      <div className={styles.loading}>Cargando opiniones pendientes...</div>
    );

  const safeReviews = Array.isArray(reviews) ? reviews : [];

  return (
    <div className={styles.card}>
      <div className={styles.cardHeader}>
        <h2>Moderación de Reseñas Pendientes</h2>
      </div>
      <div className={styles.tableResponsive}>
        <table className={styles.table}>
          <thead>
            <tr>
              <th>Usuario y Elemento</th>
              <th>Comentario de la experiencia</th>
              <th>Puntuación</th>
              <th>Estado Actual</th>
              <th>Acciones de Moderación</th>
            </tr>
          </thead>
          <tbody>
            {safeReviews.map((r) => (
              <tr key={r.id}>
                <td>
                  <div className={styles.cellMain}>{r.usuario_nombre}</div>
                  <ServiceBadge review={r} />
                </td>
                <td className={styles.textTruncate} title={r.comentario}>
                  {r.comentario}
                </td>
                <td>
                  <Stars count={r.puntuacion} />
                </td>
                <td>
                  <span className={`${styles.badge} ${styles.badgePending}`}>
                    {r.estado}
                  </span>
                </td>
                <td className={styles.cellActions}>
                  <button
                    className={styles.approveBtn}
                    onClick={() => updateStatus(r.id, "approved")}
                    title="Aprobar Reseña"
                  >
                    <HiCheckCircle />
                  </button>
                  <button
                    className={styles.rejectBtn}
                    onClick={() => updateStatus(r.id, "rejected")}
                    title="Rechazar Reseña"
                  >
                    <HiXCircle />
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}
