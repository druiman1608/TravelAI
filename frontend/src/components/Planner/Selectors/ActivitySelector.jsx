import React, { useEffect } from "react";
import { useActivitiesData } from "../../../hooks/Data/useActivitiesData";
import { HiPlus, HiInformationCircle } from "react-icons/hi";
import styles from "../../../pages/Planner/Planner.module.css";

export default function ActivitySelector({ onSelect, onDetail, globalDest }) {
  const { currentItems = [], setFilters, loading } = useActivitiesData();
  useEffect(() => {
    setFilters((prev) => ({
      ...prev,
      country: globalDest || "Todos",
      search: "",
    }));
  }, [globalDest, setFilters]);

  if (loading)
    return <div className={styles.loader}>Cargando experiencias...</div>;

  return (
    <div className={styles.rowContainer}>
      {currentItems.length > 0 ? (
        currentItems.map((a) => (
          <div key={a.id} className={styles.horizontalItem}>
            <div className={styles.rowImgContainer}>
              <img
                src={a.imagenes?.[0] || "/placeholder-act.jpg"}
                alt={a.nombre}
                className={styles.rowImg}
              />
            </div>

            <div className={styles.rowInfo}>
              <h4>{a.nombre}</h4>
              <p className={styles.rowSub}>
                {a.tipo} • {a.ubicacion_nombre}
              </p>
              <span className={styles.rowPrice}>
                {a.precio}€ <small>por persona</small>
              </span>
            </div>

            <div className={styles.rowButtons}>
              <button
                className={styles.detailBtn}
                onClick={() => onDetail(a.id)}
                title="Ver detalles"
              >
                <HiInformationCircle /> Detalles
              </button>
              <button className={styles.selectBtn} onClick={() => onSelect(a)}>
                <HiPlus /> Añadir
              </button>
            </div>
          </div>
        ))
      ) : (
        <div className={styles.noResults}>
          <p>
            No se encontraron actividades en <strong>{globalDest}</strong>.
          </p>
        </div>
      )}
    </div>
  );
}
