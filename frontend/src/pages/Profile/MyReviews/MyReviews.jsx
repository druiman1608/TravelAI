import React from "react";
import { useApi } from "../../../hooks/useApi";
import styles from "./MyReviews.module.css";
import { HiStar, HiChatAlt2, HiCalendar } from "react-icons/hi";

function StarRating({ score }) {
  return (
    <div className={styles.stars}>
      {[...Array(5)].map((_, i) => (
        <HiStar key={i} className={i < score ? styles.gold : styles.gray} />
      ))}
    </div>
  );
}

function getStatusClass(status) {
  if (!status) return styles.statusPending;
  const s = status.toLowerCase();
  if (s === "published" || s === "publicada" || s === "aprobada") return styles.statusPublished;
  return styles.statusPending;
}

export default function MyReviews() {
  const { data: reviews, loading } = useApi("/my-reviews");

  return (
    <div className={styles.viewWrapper}>
      <header className={styles.header}>
        <h2>Mis Reseñas</h2>
        <p>Tus opiniones ayudan a la comunidad.</p>
      </header>

      <div className={styles.mainContent}>
        {loading ? (
          <div className={styles.centeredState}>
            <div className={styles.spinner} />
            <p>Cargando reseñas...</p>
          </div>
        ) : reviews.length === 0 ? (
          <div className={styles.centeredState}>
            <HiChatAlt2 className={styles.emptyIcon} />
            <h3>Sin opiniones todavía</h3>
            <p>Comparte tus experiencias de viaje con la comunidad.</p>
          </div>
        ) : (
          <div className={styles.reviewGrid}>
            {reviews.map((r) => (
              <div key={r.id} className={styles.reviewCard}>
                <div className={styles.cardTop}>
                  <StarRating score={r.puntuacion} />
                  <span className={`${styles.statusBadge} ${getStatusClass(r.estado)}`}>
                    {r.estado || "Pendiente"}
                  </span>
                </div>
                <p className={styles.comment}>"{r.comentario}"</p>
                <div className={styles.reviewFooter}>
                  {r.fecha && (
                    <span className={styles.dateItem}>
                      <HiCalendar /> {r.fecha}
                    </span>
                  )}
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
