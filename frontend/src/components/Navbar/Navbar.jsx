import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import styles from "./Navbar.module.css";
import { FaUserCircle, FaBars, FaTimes } from "react-icons/fa";
import { IoSparkles } from "react-icons/io5";
import Logo from "../../assets/Logo/BG/TravelAi-logo-circle-nl.webp";
import { useAuth } from "../../context/AuthContext";

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false);
  const { isAuthenticated, isAdmin, isMod } = useAuth();

  const toggleMenu = () => setIsOpen(!isOpen);

  useEffect(() => {
    if (isOpen) document.body.style.overflow = "hidden";
    else document.body.style.overflow = "auto";
  }, [isOpen]);

  return (
    <nav className={styles.navbar}>
      <div
        className={`${styles.overlay} ${isOpen ? styles.overlayActive : ""}`}
        onClick={() => setIsOpen(false)}
      ></div>

      <div className={styles.logoContainer}>
        <Link to="/" onClick={() => setIsOpen(false)}>
          <img src={Logo} alt="TravelAi Logo" className={styles.logo} />
        </Link>
      </div>

      <div className={styles.menuIcon} onClick={toggleMenu}>
        {isOpen ? <FaTimes /> : <FaBars />}
      </div>

      <div
        className={`${styles.navLinks} ${isOpen ? styles.navLinksActive : ""}`}
      >
        <Link
          to="/inicio"
          className={styles.link}
          onClick={() => setIsOpen(false)}
        >
          INICIO
        </Link>
        <Link
          to="/vuelos"
          className={styles.link}
          onClick={() => setIsOpen(false)}
        >
          VUELOS
        </Link>
        <Link
          to="/hoteles"
          className={styles.link}
          onClick={() => setIsOpen(false)}
        >
          HOTELES
        </Link>
        <Link
          to="/paquetes"
          className={styles.link}
          onClick={() => setIsOpen(false)}
        >
          PAQUETES
        </Link>
        <Link
          to="/actividades"
          className={styles.link}
          onClick={() => setIsOpen(false)}
        >
          ACTIVIDADES
        </Link>
        <Link
          to="/planificador"
          className={styles.link}
          onClick={() => setIsOpen(false)}
        >
          PLANIFICADOR
        </Link>
        <Link
          to="/ai"
          className={`${styles.link} ${styles.aiLink}`}
          onClick={() => setIsOpen(false)}
        >
          <IoSparkles /> IA
        </Link>

        {isAuthenticated && isAdmin && (
          <Link
            to="/dashboard"
            className={styles.link}
            onClick={() => setIsOpen(false)}
          >
            ADMINISTRAR
          </Link>
        )}

        {isAuthenticated && isMod && !isAdmin && (
          <Link
            to="/dashboard"
            className={styles.link}
            onClick={() => setIsOpen(false)}
          >
            MODERAR RESEÑAS
          </Link>
        )}
      </div>

      <div className={styles.userIconContainer}>
        <Link to="/perfil">
          <FaUserCircle className={styles.userIcon} />
        </Link>
      </div>
    </nav>
  );
}
