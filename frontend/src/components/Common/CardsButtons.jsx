import React from "react";
import { useNavigate } from "react-router-dom";
import styles from "./Common.module.css";

export default function CardButtons({ id, type, onReserve }) {
  const navigate = useNavigate();
  const handleDetailsClick = () => navigate(`/${type}/${id}`);

  return (
    <div className={styles.buttonGroup}>
      <button className={styles.btnSecondary} onClick={handleDetailsClick}>
        Ver detalles
      </button>
      <button className={styles.btnPrimary} onClick={onReserve}>
        Reservar
      </button>
    </div>
  );
}
