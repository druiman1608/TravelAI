import React from "react";
import { useNavigate } from "react-router-dom";
import { HiPlus, HiEye, HiClock, HiOutlineMap } from "react-icons/hi";
import styles from "./ActivityPlannerCard.module.css";

export default function ActivityPlannerCard({ activity, onSelect }) {
  const navigate = useNavigate();

  return (
    <div className={styles.card} onClick={() => onSelect(activity)}>
      <div className={styles.imageWrapper}>
        <img
          src={activity.imagenes?.[0] || "/placeholder.jpg"}
          alt={activity.nombre}
          className={styles.img}
        />
        <div className={styles.priceTag}>{Math.ceil(activity.precio)}€</div>
      </div>

      <div className={styles.content}>
        <div className={styles.badge}>
          <HiOutlineMap /> Actividad
        </div>
        <h4 className={styles.title}>{activity.nombre}</h4>
        <p className={styles.description}>
          {activity.descripcion?.substring(0, 60)}...
        </p>

        <div className={styles.infoRow}>
          <span>
            <HiClock /> {activity.duracion}
          </span>
        </div>

        <div className={styles.actions}>
          <button
            className={styles.btnView}
            onClick={(e) => {
              e.stopPropagation();
              navigate(`/actividades/${activity.id}`);
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
