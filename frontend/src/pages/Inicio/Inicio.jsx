import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import api from "../../api/axios";
import HotelCard from "../../components/HotelCards/HotelCard";
import FlightCard from "../../components/FlightCards/FlightCard";
import ActivityCard from "../../components/ActivityCards/ActivityCards";
import PackageCard from "../../components/PackageCards/PackageCard";
import styles from "./Inicio.module.css";
import { IoSend } from "react-icons/io5";
import hotelImg from "../../assets/InicioCards/HotelInicio.jpg";
import flightImg from "../../assets/InicioCards/FlightInicio.jpg";
import packageImg from "../../assets/InicioCards/PackageInicio.jpg";
import activityImg from "../../assets/InicioCards/ActivityInicio.jpg";
import plannerImg from "../../assets/InicioCards/PlannerInicio.jpg";

const CategoryCard = ({ title, img }) => (
  <div className={styles.categoryCard}>
    <img src={img} alt={title} className={styles.categoryImg} loading="lazy" />
    <div className={styles.categoryOverlay}>
      <h3>{title}</h3>
    </div>
  </div>
);

function FeaturedSkeleton() {
  return <div className={styles.featuredSkeleton} />;
}

export default function Home() {
  const [hotels, setHotels] = useState([]);
  const [flights, setFlights] = useState([]);
  const [activities, setActivities] = useState([]);
  const [packages, setPackages] = useState([]);
  const [loading, setLoading] = useState(true);
  const [iaQuery, setIaQuery] = useState("");
  const navigate = useNavigate();

  useEffect(() => {
    const fetchData = async () => {
      try {
        const [resH, resF, resA, resP] = await Promise.all([
          api.get("/hotels"),
          api.get("/flight-offers"),
          api.get("/activities"),
          api.get("/packages"),
        ]);
        setHotels(resH.data.data || []);
        setFlights(resF.data.data || []);
        setActivities(resA.data.data || []);
        setPackages(resP.data.data || []);
      } catch {
      } finally {
        setLoading(false);
      }
    };
    fetchData();
  }, []);

  const handleAISubmit = (e) => {
    e.preventDefault();
    if (!iaQuery.trim()) return;
    navigate("/ai", { state: { initialQuery: iaQuery } });
  };

  return (
    <div className={styles.homeContainer}>
      <header className={styles.aiHero}>
        <div className={styles.aiTextContent}>
          <h2 className={styles.aiTitle}>¿No sabes a dónde ir?</h2>
          <p className={styles.aiSubtitle}>
            Deja que nuestra IA te aconseje...
          </p>
        </div>

        <form className={styles.aiCard} onSubmit={handleAISubmit}>
          <h2 className={styles.aiCardTitle}>¿A dónde quieres ir hoy?</h2>
          <div className={styles.chatInputWrapper}>
            <div className={styles.aiInputGroup}>
              <input
                type="text"
                placeholder="Ej: Quiero un viaje romántico a Italia con playa..."
                value={iaQuery}
                onChange={(e) => setIaQuery(e.target.value)}
              />
            </div>
            <button type="submit" className={styles.aiSendButton}>
              <IoSend />
            </button>
          </div>
        </form>
      </header>

      <div className={styles.sectionHeaderBlue}>
        ¿A qué esperas para emprender tu nueva aventura?
      </div>

      <section className={styles.categoriesGrid}>
        <Link to="/hoteles">
          <CategoryCard title="Hoteles" img={hotelImg} />
        </Link>
        <Link to="/vuelos">
          <CategoryCard title="Vuelos" img={flightImg} />
        </Link>
        <Link to="/paquetes">
          <CategoryCard title="Paquetes" img={packageImg} />
        </Link>
        <Link to="/actividades">
          <CategoryCard title="Actividades" img={activityImg} />
        </Link>
        <Link to="/planificador">
          <CategoryCard title="A medida" img={plannerImg} />
        </Link>
      </section>

      <main className={styles.mainContent}>
        <section className={styles.featuredSection}>
          <div className={styles.sectionHeaderBlue}>¡Hotel destacado!</div>
          <div className={styles.featuredList}>
            {loading ? <FeaturedSkeleton /> : hotels.length > 0 && <HotelCard hotel={hotels[0]} />}
          </div>
        </section>

        <section className={styles.featuredSection}>
          <div className={styles.sectionHeaderBlue}>¡Vuelo destacado!</div>
          <div className={styles.featuredList}>
            {loading ? <FeaturedSkeleton /> : flights.length > 0 && <FlightCard flight={flights[0]} />}
          </div>
        </section>

        <section className={styles.featuredSection}>
          <div className={styles.sectionHeaderBlue}>¡Actividad destacada!</div>
          <div className={styles.featuredList}>
            {loading ? <FeaturedSkeleton /> : activities.length > 0 && <ActivityCard activity={activities[0]} />}
          </div>
        </section>

        <section className={styles.featuredSection}>
          <div className={styles.sectionHeaderBlue}>¡Paquete destacado!</div>
          <div className={styles.featuredList}>
            {loading ? <FeaturedSkeleton /> : packages.length > 0 && <PackageCard pkg={packages[0]} />}
          </div>
        </section>
      </main>
    </div>
  );
}
