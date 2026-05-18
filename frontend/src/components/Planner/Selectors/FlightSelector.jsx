import React, { useEffect } from "react";
import { useFlightsData } from "../../../hooks/Data/useFlightsData";
import styles from "../../../pages/Planner/Planner.module.css";

export default function FlightSelector({ onSelect, onDetail, globalDest }) {
  const { currentItems = [], setFilters, loading } = useFlightsData();
  useEffect(() => {
    setFilters((prev) => ({ ...prev, dest: globalDest || "Todos" }));
  }, [globalDest, setFilters]);

  if (loading) return <p>Buscando vuelos...</p>;
  return (
    <div className={styles.rowContainer}>
      {currentItems.map((f) => (
        <div key={f.id} className={styles.horizontalItem}>
          <img src={f.ida?.imagen_url} alt={f.ida?.destino || "Vuelo"} className={styles.rowImg} />
          <div className={styles.rowInfo}>
            <h4>{f.ida?.aerolinea}</h4>
            <p>
              {f.ida?.origen} ➔ {f.ida?.destino} • {f.precio_total}€
            </p>
          </div>
          <div className={styles.rowButtons}>
            <button className={styles.detailBtn} onClick={() => onDetail(f.id)}>
              Detalles
            </button>
            <button className={styles.selectBtn} onClick={() => onSelect(f)}>
              Añadir
            </button>
          </div>
        </div>
      ))}
    </div>
  );
}
