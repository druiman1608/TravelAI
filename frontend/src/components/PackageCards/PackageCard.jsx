import React from "react";
import { useNavigate } from "react-router-dom";
import styles from "./PackageCard.module.css";
import CardButtons from "../Common/CardsButtons";
import { FaLocationDot } from "react-icons/fa6";

export default function PackageCard({ pkg }) {
  const navigate = useNavigate();
  const displayPrice = Math.ceil(pkg.precio_descuento || pkg.precio_total || 0);

  const handleReserve = () => {
    navigate("/checkout", {
      state: { pkg: pkg, type: "pkg" },
    });
  };

  return (
    <div className={styles.cardContainer}>
      <div className={styles.imageWrapper}>
        <div className={styles.imageBox}>
          <img
            src={pkg.imagenes?.[0] || "/placeholder-pkg.jpg"}
            alt={pkg.nombre}
            loading="lazy"
          />
        </div>
        <span className={styles.plusSymbol}>+</span>
        <div className={styles.imageBox}>
          <img
            src={
              pkg.vuelo?.imagen ||
              pkg.actividad?.imagenes?.[0] ||
              "/placeholder-dest.jpg"
            }
            alt="Destino"
            loading="lazy"
          />
        </div>
      </div>
      <div className={styles.verticalDivider}></div>
      <div className={styles.infoSection}>
        <h3 className={styles.packageName}>{pkg.nombre}</h3>
        <div className={styles.locationTag}>
          <span>
            <FaLocationDot className={styles.locationIcon} /> {pkg.destino}
          </span>
        </div>
        <p className={styles.description}>{pkg.descripcion}</p>
      </div>
      <div className={styles.verticalDivider}></div>
      <div className={styles.actionSection}>
        <div className={styles.priceContainer}>
          <span className={styles.priceLabel}>Desde</span>
          <br></br>
          <span className={styles.price}>{displayPrice}€</span>
        </div>
        <CardButtons id={pkg.id} type="packages" onReserve={handleReserve} />
      </div>
    </div>
  );
}
