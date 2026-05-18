import React from "react";
import { useNavigate } from "react-router-dom";
import styles from "./FlightCards.module.css";
import { GiAirplaneDeparture, GiAirplaneArrival } from "react-icons/gi";
import {
  BsSuitcaseLg,
  BsBackpack3,
  BsArrowLeft,
  BsArrowRight,
} from "react-icons/bs";
import { FaLocationDot } from "react-icons/fa6";
import CardButtons from "../Common/CardsButtons";

export default function FlightCard({ flight }) {
  const navigate = useNavigate();
  const { ida, vuelta, precio_total, tipo, id } = flight;
  const valorReal =
    flight.precio_total ?? flight.precio ?? flight.total_price ?? 0;
  const precioFinal = Math.ceil(valorReal);
  const isRoundTrip = tipo === "round_trip" && vuelta !== null;

  const formatTime = (dateString) => {
    if (!dateString) return "--:--";
    const date = new Date(dateString);
    return date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
  };

  const formatDate = (dateString) => {
    if (!dateString) return "S/N";
    const date = new Date(dateString);
    return date.toLocaleDateString("es-ES", {
      day: "2-digit",
      month: "2-digit",
      year: "2-digit",
    });
  };

  const handleReserve = () => {
    navigate("/checkout", {
      state: { flight: flight, type: "flight" },
    });
  };

  const getEscalaClass = (escalas) => {
    if (escalas === 0) return styles.directo;
    if (escalas === 1) return styles.unaEscala;
    return styles.variasEscalas;
  };

  const RenderFlightRow = ({ flightData, isReverse }) => (
    <div className={styles.flightRow}>
      <div className={styles.timeBlock}>
        <span className={styles.time}>{formatTime(flightData.salida)}</span>
        <span className={styles.date}>
          {flightData.origen?.substring(0, 3).toUpperCase()} -{" "}
          {formatDate(flightData.salida)}
        </span>
      </div>

      <div className={styles.flightPath}>
        {isReverse ? (
          <GiAirplaneArrival className={styles.iconAlignReverse} />
        ) : (
          <GiAirplaneDeparture className={styles.iconAlign} />
        )}
        <BsArrowRight className={styles.arrowAlign} />
        <div className={styles.duration}>
          <span className={getEscalaClass(flightData.escalas)}>
            {flightData.escalas === 0
              ? "Directo"
              : `${flightData.escalas} Esc.`}
          </span>
          <small>{flightData.duracion}</small>
        </div>
        <BsArrowLeft className={styles.arrowAlign} />
        {isReverse ? (
          <GiAirplaneDeparture className={styles.iconAlignReverse} />
        ) : (
          <GiAirplaneArrival className={styles.iconAlign} />
        )}
      </div>

      <div className={styles.timeBlock}>
        <span className={styles.time}>{formatTime(flightData.llegada)}</span>
        <span className={styles.date}>
          {flightData.destino?.substring(0, 3).toUpperCase()} -{" "}
          {formatDate(flightData.llegada)}
        </span>
      </div>
    </div>
  );

  return (
    <div
      className={`${styles.cardContainer} ${!isRoundTrip ? styles.singleTrip : ""}`}
    >
      <div className={styles.imageSection}>
        <img
          src={ida.imagen_url || "/placeholder-flight.jpg"}
          alt={ida.destino}
          loading="lazy"
        />
      </div>

      <div className={styles.infoSection}>
        <div className={styles.headerCenter}>
          <h2 className={styles.flightTitle}>
            {ida.origen} — {ida.destino}
          </h2>
          <span className={styles.airlineName}>Aerolínea: {ida.aerolinea}</span>
        </div>
        <div className={styles.flightDetailsGrid}>
          <RenderFlightRow flightData={ida} isReverse={false} />
          {isRoundTrip && (
            <RenderFlightRow flightData={vuelta} isReverse={true} />
          )}
        </div>
      </div>

      <div className={styles.verticalDivider}></div>

      <div className={styles.actionSection}>
        <div className={styles.luggageIcons}>
          <BsBackpack3 title="Mochila" />
          <BsSuitcaseLg title="Maleta de mano" />
        </div>
        <div className={styles.priceContainer}>
          <span className={styles.priceLabel}>Total</span>
          <br></br>
          <span className={styles.price}>{precioFinal}€</span>
        </div>
        <CardButtons id={id} type="flights" onReserve={handleReserve} />
      </div>
    </div>
  );
}
