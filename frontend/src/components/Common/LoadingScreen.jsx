import React from "react";
import styles from "./Common.module.css";

export default function LoadingScreen({ message = "Cargando..." }) {
  return (
    <div className={styles.loadingContainer}>
      <div className={styles.spinner}></div>
      <p className={styles.loadingText}>{message}</p>
    </div>
  );
}
