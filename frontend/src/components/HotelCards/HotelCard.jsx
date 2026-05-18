import React from "react";
import { useNavigate } from "react-router-dom";
import styles from "./HotelCard.module.css";
import CardButtons from "../Common/CardsButtons";
import { FaLocationDot } from "react-icons/fa6";
import { RiStarSFill } from "react-icons/ri";

export default function HotelCard({ hotel }) {
  const navigate = useNavigate();
  const renderStars = (count) => {
    return Array.from({ length: count || 0 }, (_, i) => (
      <RiStarSFill key={i} className={styles.starIcon} />
    ));
  };

  const precioRedondeado = Math.ceil(hotel.precio_noche);
  const habitacionesLibres = hotel.habitaciones_disp ?? 0;
  const serviciosAMostrar =
    hotel.servicios?.length > 0
      ? hotel.servicios
      : ["Wifi", "Piscina", "Parking"];

  const handleReserve = () => {
    navigate("/checkout", {
      state: { hotel: hotel, type: "hotel" },
    });
  };

  return (
    <div className={styles.cardContainer}>
      <div className={styles.imageSection}>
        <img
          src={hotel.imagenes?.[0] || "/placeholder-hotel.jpg"}
          alt={hotel.nombre}
          loading="lazy"
        />
      </div>
      <div className={styles.infoSection}>
        <h2 className={styles.hotelName}>{hotel.nombre}</h2>
        <div className={styles.stars}>{renderStars(hotel.estrellas)}</div>
        <div className={styles.locationTag}>
          <FaLocationDot className={styles.locationIcon} />{" "}
          {hotel.ubicacion_nombre || "Ubicación no disponible"}
        </div>
      </div>
      <div className={styles.shortDivider}></div>
      <div className={styles.detailsSection}>
        <div className={styles.detailGroup}>
          <h3>Disponibilidad</h3>
          {habitacionesLibres > 0 ? (
            <>
              <p className={styles.roomCount}>{habitacionesLibres}</p>
              <p className={styles.roomLabel}>Hab. libres</p>
            </>
          ) : (
            <p className={styles.soldOut}>Agotado</p>
          )}
        </div>
        <div className={styles.shortDivider}></div>
        <div className={styles.detailGroup}>
          <h3>Servicios</h3>
          {serviciosAMostrar.slice(0, 3).map((s, i) => (
            <p key={i}>{s}</p>
          ))}
        </div>
      </div>
      <div className={styles.verticalDivider}></div>
      <div className={styles.actionSection}>
        <div className={styles.priceContainer}>
          <span className={styles.priceLabel}>Por Noche</span>
          <br></br>
          <span className={styles.price}>{precioRedondeado}€</span>
        </div>
        <CardButtons id={hotel.id} type="hotels" onReserve={handleReserve} />
      </div>
    </div>
  );
}
