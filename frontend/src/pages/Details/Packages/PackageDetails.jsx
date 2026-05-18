import React from "react";
import { useParams, Link, useNavigate } from "react-router-dom";
import { useItemDetail } from "../../../hooks/Data/useItemDetail";
import LoadingScreen from "../../../components/Common/LoadingScreen";
import DetailsLayout from "../../../layouts/DetailsPages/DetailsLayout";
import { HiCheckCircle, HiArrowRight } from "react-icons/hi";
import styles from "../../../layouts/DetailsPages/DetailsLayout.module.css";

export default function PackageDetails() {
  const { id } = useParams();
  const navigate = useNavigate();
  const { item, loading } = useItemDetail("/packages", id);

  if (loading) return <LoadingScreen message="Organizando tu viaje..." />;
  if (!item) return <div className="container mt-5">Paquete no encontrado</div>;

  const handleReserve = () => {
    navigate("/checkout", {
      state: {
        pkg: item,
        type: "pkg",
      },
    });
  };

  const sidebar = (
    <>
      <h3>Este paquete incluye:</h3>
      <ul className={styles.featureList}>
        {item.hotel && (
          <li>
            <HiCheckCircle className={styles.check} />
            <Link
              to={`/hotels/${item.hotel.id}`}
              className={styles.internalLink}
            >
              Hotel: {item.hotel.nombre} <HiArrowRight size={12} />
            </Link>
          </li>
        )}
        {item.actividad && (
          <li>
            <HiCheckCircle className={styles.check} />
            <Link
              to={`/activities/${item.actividad.id}`}
              className={styles.internalLink}
            >
              Actividad: {item.actividad.nombre} <HiArrowRight size={12} />
            </Link>
          </li>
        )}
        {item.vuelo && (
          <li>
            <HiCheckCircle className={styles.check} />
            <Link
              to={`/flights/${item.vuelo?.id}`}
              className={styles.internalLink}
            >
              Vuelo incluido <HiArrowRight size={12} />
            </Link>
          </li>
        )}
        <li>
          <HiCheckCircle className={styles.check} /> Seguro de viaje y traslados
        </li>
      </ul>
      <div className={styles.totalPrice}>
        <small>Precio total paquete</small>
        <p>{Math.ceil(item.precio_total)}€</p>
      </div>

    </>
  );

  return (
    <DetailsLayout
      item={item}
      title={item.nombre}
      location={item.destino}
      images={item.imagenes || []}
      sidebarContent={sidebar}
      backPath="/paquetes"
      onReserve={handleReserve}
      entityType="package_id"
    />
  );
}
