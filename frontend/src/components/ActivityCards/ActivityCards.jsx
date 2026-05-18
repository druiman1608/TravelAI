import React from "react";
import { useNavigate } from "react-router-dom";
import styles from "./ActivityCards.module.css";
import CardButtons from "../Common/CardsButtons";
import { FaLocationDot } from "react-icons/fa6";

export default function ActivityCard({ activity }) {
  const navigate = useNavigate();
  if (!activity) return null;

  const handleReserve = () => {
    navigate("/checkout", {
      state: { activity: activity, type: "activity" },
    });
  };

  return (
    <div className={styles.cardContainer}>
      <div className={styles.imageWrapper}>
        <div className={styles.imageBox}>
          <img
            src={
              activity.imagenes?.[0] ||
              "https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=500"
            }
            alt={activity.nombre}
            loading="lazy"
          />
        </div>
      </div>

      <div className={styles.verticalDivider}></div>

      <div className={styles.infoSection}>
        <h3 className={styles.packageName}>{activity.nombre}</h3>
        <div className={styles.locationTag}>
          <span>
            <FaLocationDot className={styles.locationIcon} />{" "}
            {activity.ubicacion_nombre || "Ubicación no disponible"}
          </span>
        </div>
        <div className={styles.metaInfo}>
          <span className={styles.durationBadge}>⏱ {activity.duracion}</span>
        </div>
        <p className={styles.description}>{activity.descripcion}</p>
      </div>

      <div className={styles.verticalDivider}></div>

      <div className={styles.actionSection}>
        <div className={styles.priceContainer}>
          <span className={styles.priceLabel}>Por persona</span>
          <br></br>
          <span className={styles.price}>
            {Math.ceil(activity.precio || 0)}€
          </span>
        </div>
        <CardButtons
          id={activity.id}
          type="activities"
          onReserve={handleReserve}
        />
      </div>
    </div>
  );
}
