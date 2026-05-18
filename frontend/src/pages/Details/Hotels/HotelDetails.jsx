import React, { useRef } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { useItemDetail } from "../../../hooks/Data/useItemDetail";
import LoadingScreen from "../../../components/Common/LoadingScreen";
import DetailsLayout from "../../../layouts/DetailsPages/DetailsLayout";
import { HiUsers, HiCheckCircle } from "react-icons/hi";
import styles from "../../../layouts/DetailsPages/DetailsLayout.module.css";

export default function HotelDetails() {
  const { id } = useParams();
  const navigate = useNavigate();
  const roomsRef = useRef(null);
  const { item, loading } = useItemDetail("/hotels", id);

  if (loading)
    return <LoadingScreen message="Buscando las mejores habitaciones..." />;
  if (!item) return <div className="container mt-5">Hotel no encontrado</div>;

  const starsIcons = "★".repeat(item.estrellas || 0);

  const handleReserveRoom = (room) => {
    navigate("/checkout", {
      state: {
        hotel: item,
        selectedRoom: room,
        type: "hotel",
      },
    });
  };

  const minPrice =
    item.habitaciones?.length > 0
      ? Math.min(...item.habitaciones.map((r) => r.precio || 0))
      : item.precio_noche || 0;

  const sidebar = (
    <>
      <h3>Servicios y Amenities</h3>
      <ul className={styles.featureList}>
        {item.servicios?.map((service, i) => (
          <li key={i}>
            <HiCheckCircle className={styles.check} /> {service}
          </li>
        ))}
      </ul>
      <div className={styles.totalPrice}>
        <small>Precio por noche</small>
        <p>{Math.ceil(minPrice)}€</p>
      </div>
    </>
  );

  return (
    <DetailsLayout
      item={item}
      title={item.nombre}
      stars={starsIcons}
      location={item.direccion || item.ubicacion_nombre}
      images={item.imagenes || []}
      backPath="/hoteles"
      sidebarContent={sidebar}
      entityType="hotel_id"
      onReserve={() => roomsRef.current?.scrollIntoView({ behavior: "smooth" })}
    >
      <section ref={roomsRef} className={styles.roomsSection}>
        <h3>Habitaciones disponibles</h3>
        <div className={styles.roomsGrid}>
          {item.habitaciones?.map((room) => (
            <div key={room.id} className={styles.roomCard}>
              <img src={item.imagenes?.[0]} alt={room.tipo} loading="lazy" />
              <div className={styles.roomInfo}>
                <h4>{room.tipo}</h4>
                <p>
                  <HiUsers /> Capacidad: {room.capacidad} personas
                </p>
                <span className={styles.roomPrice}>
                  Precio por noche: <br />
                  {Math.ceil(room.precio)}€
                </span>
                <button
                  className={`${styles.btnReserveTop} ${styles.btnFullWidth}`}
                  onClick={() => handleReserveRoom(room)}
                >
                  Seleccionar
                </button>
              </div>
            </div>
          ))}
        </div>
      </section>
    </DetailsLayout>
  );
}
