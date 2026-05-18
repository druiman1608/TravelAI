import React from "react";
import { useParams, useNavigate } from "react-router-dom";
import { useItemDetail } from "../../../hooks/Data/useItemDetail";
import LoadingScreen from "../../../components/Common/LoadingScreen";
import DetailsLayout from "../../../layouts/DetailsPages/DetailsLayout";
import { HiClock, HiCheckCircle } from "react-icons/hi";
import styles from "../../../layouts/DetailsPages/DetailsLayout.module.css";

export default function ActivityDetails() {
  const { id } = useParams();
  const navigate = useNavigate();
  const { item, loading } = useItemDetail("/activities", id);

  if (loading) return <LoadingScreen message="Cargando experiencia..." />;
  if (!item) return <div>No encontrado</div>;

  const locationName = item.ubicacion_nombre || item.tipo || "Ubicación no disponible";

  const handleReserve = () => {
    navigate("/checkout", { state: { activity: item, type: "activity" } });
  };

  return (
    <DetailsLayout
      item={item}
      title={item.nombre}
      location={locationName}
      images={item.imagenes || []}
      backPath="/actividades"
      onReserve={handleReserve}
      entityType="activity_id"
      sidebarContent={
        <>
          <h3>Información</h3>
          <ul className={styles.featureList}>
            <li>
              <HiClock className={styles.check} /> <strong>Duración:</strong>{" "}
              {item.duracion}
            </li>
            {item.servicios_incluidos?.map((f, i) => (
              <li key={i}>
                <HiCheckCircle className={styles.check} /> {f}
              </li>
            ))}
          </ul>
          <div className={styles.totalPrice}>
            <small>Precio por persona</small>
            <p>{Math.ceil(item.precio)}€</p>
          </div>
        </>
      }
    />
  );
}
