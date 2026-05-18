import React from "react";
import styles from "./Common.module.css";

export default function NoResults({ message = "No hay resultados", onReset }) {
  return (
    <div className={styles.noResultsContainer}>
      <h3>{message}</h3>
      {onReset && (
        <button className={styles.resetBtn} onClick={onReset}>
          Limpiar filtros
        </button>
      )}
    </div>
  );
}
