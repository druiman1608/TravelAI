import React from "react";
import { useNavigate } from "react-router-dom";
import { HiPlus, HiEye, HiStar } from "react-icons/hi";
import { RiStarSFill } from "react-icons/ri";
import styles from "./HotelPlannerCard.module.css";

export default function HotelPlannerCard({ hotel, onSelect }) {
  const navigate = useNavigate();

  return (
    <div className={styles.card} onClick={() => onSelect(hotel)}>
      <div className={styles.imageWrapper}>
        <img
          src={hotel.imagenes?.[0] || "/placeholder-hotel.jpg"}
          alt={hotel.nombre}
          className={styles.img}
        />
        <div className={styles.stars}>
          {Array.from({ length: hotel.estrellas || 0 }).map((_, i) => (
            <RiStarSFill key={i} />
          ))}
        </div>
      </div>

      <div className={styles.content}>
        <span className={styles.badge}>Alojamiento</span>
        <h4 className={styles.title}>{hotel.nombre}</h4>
        <p className={styles.location}>{hotel.ubicacion_nombre}</p>
        <p className={styles.price}>
          <strong>{Math.ceil(hotel.precio_noche)}€</strong> / noche
        </p>

        <div className={styles.actions}>
          <button
            className={styles.btnView}
            onClick={(e) => {
              e.stopPropagation();
              navigate(`/hoteles/${hotel.id}`);
            }}
          >
            <HiEye /> Ver
          </button>
          <div className={styles.btnAdd}>
            <HiPlus /> Añadir
          </div>
        </div>
      </div>
    </div>
  );
}
