import React, { useEffect, useState } from "react";
import { useParams, useLocation } from "react-router-dom";
import api from "../../api/axios";
import LoadingScreen from "../../components/Common/LoadingScreen";
import ReviewForm from "../../components/ReviewForm/ReviewForm";
import styles from "./Reviews.module.css";
import { HiStar, HiOutlineChatAlt2, HiArrowLeft } from "react-icons/hi";

export default function Reviews() {
  const { id } = useParams();
  const location = useLocation();
  const [reviews, setReviews] = useState([]);
  const [loading, setLoading] = useState(true);

  const getServiceType = () => {
    const path = location.pathname;
    if (path.includes("packages") || path.includes("paquetes"))
      return "package_id";
    if (path.includes("hotels") || path.includes("hoteles")) return "hotel_id";
    if (path.includes("activities") || path.includes("actividades"))
      return "activity_id";
    if (path.includes("vuelos") || path.includes("flights")) return "flight_id";
    return null;
  };

  const serviceType = getServiceType();

  const fetchReviews = () => {
    setLoading(true);
    api
      .get(`/reviews?${serviceType}=${id}`)
      .then((res) => {
        setReviews(res.data.data);
        setLoading(false);
      })
      .catch(() => {
        setLoading(false);
      });
  };

  useEffect(() => {
    if (serviceType && id) {
      fetchReviews();
    }
  }, [id, serviceType]);

  if (loading) return <LoadingScreen />;

  return (
    <div className={styles.container}>
      <header className={styles.header}>
        <button
          onClick={() => window.history.back()}
          className={styles.backBtn}
        >
          <HiArrowLeft /> Volver
        </button>
        <h1>Opiniones de nuestros viajeros</h1>
        <div className={styles.stats}>
          <HiOutlineChatAlt2 /> {reviews.length} reseñas verificadas
        </div>
      </header>

      <div className={styles.reviewsGrid}>
        {reviews.length > 0 ? (
          reviews.map((rev) => (
            <div key={rev.id} className={styles.reviewCard}>
              <div className={styles.cardHeader}>
                <div className={styles.userIcon}>
                  {rev.usuario_nombre.charAt(0).toUpperCase()}
                </div>
                <div className={styles.userInfo}>
                  <h4>{rev.usuario_nombre}</h4>
                  <span>{rev.fecha || "Reciente"}</span>
                </div>
                <div className={styles.stars}>
                  {[...Array(5)].map((_, i) => (
                    <HiStar
                      key={i}
                      className={i < rev.puntuacion ? styles.gold : styles.gray}
                    />
                  ))}
                </div>
              </div>
              <div className={styles.commentBody}>
                <p>"{rev.comentario}"</p>
              </div>
            </div>
          ))
        ) : (
          <div className={styles.noReviews}>
            <p>
              Todavía no hay opiniones para este servicio. ¡Sé el primero en
              compartir la tuya!
            </p>
          </div>
        )}
      </div>

      <section className={styles.formSection}>
        <ReviewForm
          serviceId={id}
          serviceType={serviceType}
          onReviewSubmitted={fetchReviews}
        />
      </section>
    </div>
  );
}
