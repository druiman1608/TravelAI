import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import styles from "./CrudDashboard.module.css";
import { useAuth } from "../../context/AuthContext";
import {
  HiUsers,
  HiOfficeBuilding,
  HiPaperAirplane,
  HiTicket,
  HiGift,
  HiGlobe,
  HiChatAlt2,
  HiLogout,
  HiHome,
  HiTag,
  HiMenu,
  HiX,
  HiGlobeAlt,
} from "react-icons/hi";

import UsersCrud from "./Admin/Users/UsersCrud";
import HotelsCrud from "./Admin/Hotels/HotelsCrud";
import FlightsCrud from "./Admin/Flights/FlightsCrud";
import FlightOffersCrud from "./Admin/FlightOffers/FlightOffersCrud";
import ActivitiesCrud from "./Admin/Activities/ActivitiesCrud";
import PackagesCrud from "./Admin/Packages/PackagesCrud";
import LocationsCrud from "./Admin/Locations/Locations";
import ReviewsCrud from "./Mod/Reviews/ReviewsModCrud";
import ReviewsAdminCrud from "./Admin/Reviews/ReviewsAdminCrud";

const TAB_LABELS = {
  users: "Usuarios",
  hotels: "Hoteles",
  flights: "Vuelos",
  flightOffers: "Ofertas de Vuelo",
  activities: "Actividades",
  packages: "Paquetes",
  locations: "Destinos",
  reviews: "Reseñas",
};

export default function CrudDashboard() {
  const navigate = useNavigate();
  const { user, logout, isAdmin } = useAuth();
  const [activeTab, setActiveTab] = useState(isAdmin ? "users" : "reviews");

  const [sidebarOpen, setSidebarOpen] = useState(false);

  const handleLogout = () => {
    logout();
    navigate("/");
  };

  const handleTabChange = (tab) => {
    setActiveTab(tab);
    setSidebarOpen(false);
  };

  const adminLinks = [
    { id: "users", label: "Usuarios", icon: <HiUsers /> },
    { id: "hotels", label: "Hoteles", icon: <HiOfficeBuilding /> },
    { id: "flights", label: "Vuelos", icon: <HiPaperAirplane /> },
    { id: "flightOffers", label: "Ofertas Vuelo", icon: <HiTag /> },
    { id: "activities", label: "Actividades", icon: <HiTicket /> },
    { id: "packages", label: "Paquetes", icon: <HiGift /> },
    { id: "locations", label: "Destinos", icon: <HiGlobe /> },
  ];

  const renderNav = () => (
    <>
      {isAdmin &&
        adminLinks.map((item) => (
          <button
            key={item.id}
            className={`${styles.navItem} ${activeTab === item.id ? styles.active : ""}`}
            onClick={() => handleTabChange(item.id)}
          >
            {item.icon}
            <span className={styles.navLabel}>{item.label}</span>
          </button>
        ))}
      <button
        className={`${styles.navItem} ${activeTab === "reviews" ? styles.active : ""}`}
        onClick={() => handleTabChange("reviews")}
      >
        <HiChatAlt2 />
        <span className={styles.navLabel}>Reseñas</span>
      </button>
    </>
  );

  return (
    <div className={styles.adminContainer}>
      <div
        className={`${styles.sidebarOverlay} ${sidebarOpen ? styles.overlayVisible : ""}`}
        onClick={() => setSidebarOpen(false)}
      />

      <aside
        className={`${styles.sidebar} ${sidebarOpen ? styles.sidebarOpen : ""}`}
      >
        <div className={styles.logoArea}>
          <div className={styles.logoIcon}>
            <HiGlobeAlt />
          </div>
          <div className={styles.logoText}>
            <div className={styles.logoTitle}>TravelPanel</div>
            <div className={styles.logoSub}>
              {isAdmin ? "Administrador" : "Moderador"}
            </div>
          </div>
        </div>

        <nav className={styles.nav}>{renderNav()}</nav>

        <div className={styles.navFooter}>
          <button onClick={() => navigate("/")} className={styles.homeBtn}>
            <HiHome />
            <span className={styles.navLabel}>Volver al Inicio</span>
          </button>
          <button onClick={handleLogout} className={styles.logoutBtn}>
            <HiLogout />
            <span className={styles.navLabel}>Cerrar sesión</span>
          </button>
        </div>
      </aside>

      <main className={styles.mainContent}>
        <div className={styles.topbar}>
          <div className={styles.topbarLeft}>
            <button
              className={styles.menuToggle}
              onClick={() => setSidebarOpen(!sidebarOpen)}
              aria-label="Toggle menu"
            >
              {sidebarOpen ? <HiX size={20} /> : <HiMenu size={20} />}
            </button>
            <div className={styles.topbarTitle}>{TAB_LABELS[activeTab]}</div>
          </div>
          <div className={styles.topbarRight}>
            <div className={styles.avatar}>
              {user?.name?.substring(0, 2).toUpperCase() || "US"}
            </div>
          </div>
        </div>

        <div className={styles.contentArea}>
          {activeTab === "users" && isAdmin && <UsersCrud />}
          {activeTab === "hotels" && isAdmin && <HotelsCrud />}
          {activeTab === "flights" && isAdmin && <FlightsCrud />}
          {activeTab === "flightOffers" && isAdmin && <FlightOffersCrud />}
          {activeTab === "activities" && isAdmin && <ActivitiesCrud />}
          {activeTab === "packages" && isAdmin && <PackagesCrud />}
          {activeTab === "locations" && isAdmin && <LocationsCrud />}
          {activeTab === "reviews" && isAdmin && <ReviewsAdminCrud />}
          {activeTab === "reviews" && !isAdmin && <ReviewsCrud />}
        </div>
      </main>
    </div>
  );
}
