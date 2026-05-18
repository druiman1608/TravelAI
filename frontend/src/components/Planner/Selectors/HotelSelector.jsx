import React, { useEffect } from "react";
import { useHotelsData } from "../../../hooks/Data/useHotelsData";
import styles from "../../../pages/Planner/Planner.module.css";

export default function HotelSelector({ onSelect, onDetail, globalDest }) {
  const { currentItems = [], setFilters, loading } = useHotelsData();
  useEffect(() => {
    setFilters((prev) => ({
      ...prev,
      country: globalDest || "Todos",
      search: "",
    }));
  }, [globalDest, setFilters]);

  if (loading) return <p>Cargando hoteles...</p>;
  return (
    <div className={styles.rowContainer}>
      {currentItems.map((h) => (
        <div key={h.id} className={styles.horizontalItem}>
          <img src={h.imagenes?.[0]} alt={h.nombre} className={styles.rowImg} />
          <div className={styles.rowInfo}>
            <h4>{h.nombre}</h4>
            <p>
              {h.ubicacion_nombre} • {h.precio_noche}€/noche
            </p>
          </div>
          <div className={styles.rowButtons}>
            <button className={styles.detailBtn} onClick={() => onDetail(h.id)}>
              Detalles
            </button>
            <button className={styles.selectBtn} onClick={() => onSelect(h)}>
              Añadir
            </button>
          </div>
        </div>
      ))}
    </div>
  );
}
