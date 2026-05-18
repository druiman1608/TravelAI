import React from "react";
import styles from "./Footer.module.css";
import { Link } from "react-router-dom";

export default function Footer() {
  return (
    <footer className={styles.footer}>
      <div className={styles.footerCard}>
        <div className={styles.newsletter}>
          <h3>Suscríbete para no perderte ninguna de nuestras ofertas</h3>
          <div className={styles.inputGroup}>
            <input type="email" placeholder="Correo electrónico" />
            <button className={styles.subscribeBtn}>SUSCRIBIRME</button>
          </div>
          <p className={styles.disclaimer}>
            Al suscribirte aceptas los términos y servicios de nuestra web*
          </p>
        </div>

        <div className={styles.divider}></div>

        <div className={styles.linksColumn}>
          <p className={styles.columnTitle}>LEGAL</p>
          <Link to="/datos" className={styles.fLink}>Tratamiento de datos</Link>
          <Link to="/privacidad" className={styles.fLink}>Política de privacidad</Link>
          <Link to="/cookies" className={styles.fLink}>Política de cookies</Link>
          <Link to="/contacto" className={styles.fLink}>Contacto</Link>
        </div>

        <div className={styles.divider}></div>

        <div className={styles.linksColumn}>
          <p className={styles.columnTitle}>EXPLORA</p>
          <Link to="/" className={styles.fLink}>
            Inicio
          </Link>
          <Link to="/hoteles" className={styles.fLink}>
            Hoteles
          </Link>
          <Link to="/vuelos" className={styles.fLink}>
            Vuelos
          </Link>
          <Link to="/paquetes" className={styles.fLink}>
            Paquetes de viaje
          </Link>
          <Link to="/planificador" className={styles.fLink}>
            Planificador
          </Link>
        </div>
      </div>
    </footer>
  );
}
