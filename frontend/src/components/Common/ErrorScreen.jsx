import React from "react";
import styles from "./Common.module.css";
import { HiExclamationCircle } from "react-icons/hi";

export default function ErrorScreen({ message = "No se pudo conectar con el servidor.", onRetry }) {
  return (
    <div className={styles.errorContainer}>
      <HiExclamationCircle className={styles.errorIcon} />
      <p className={styles.errorTitle}>Error de conexión</p>
      <p className={styles.errorText}>{message}</p>
      {onRetry && (
        <button className={styles.retryBtn} onClick={onRetry}>
          Reintentar
        </button>
      )}
    </div>
  );
}
