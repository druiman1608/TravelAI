import React from "react";
import { HiIdentification, HiUserCircle } from "react-icons/hi";
import styles from "./PassengerForm.module.css";

export const PassengerCard = ({ index, onChange }) => (
  <div className={styles.passengerCard}>
    <div className={styles.header}>
      <HiUserCircle className={styles.icon} />
      <span>Acompañante #{index + 1}</span>
    </div>
    <div className={styles.inputGrid}>
      <div className={styles.inputGroup}>
        <label>Nombre Completo</label>
        <input
          type="text"
          placeholder="Ej. Juan Pérez"
          onChange={(e) => onChange(index, "nombre", e.target.value)}
        />
      </div>
      <div className={styles.inputGroup}>
        <label>DNI / Pasaporte</label>
        <input
          type="text"
          placeholder="12345678X"
          onChange={(e) => onChange(index, "dni", e.target.value)}
        />
      </div>
    </div>
  </div>
);
