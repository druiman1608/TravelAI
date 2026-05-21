import React, { useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { useItemDetail } from "../../../hooks/Data/useItemDetail";
import LoadingScreen from "../../../components/Common/LoadingScreen";
import api from "../../../api/axios";
import { toast } from "react-toastify";
import styles from "./ReviewDetails.module.css";
import { FaStar, FaArrowLeft, FaUserCircle } from "react-icons/fa";

const SERVICE_TYPE_MAP = {
  activities: "activity_id",
  hotels: "hotel_id",
  packages: "package_id",
  flights: "flight_id",
  "flight-offers": "flight_id",
};

export default function ReviewDetails() {
  const { type, id } = useParams();
  const navigate = useNavigate();

  const { item, loading } = useItemDetail(`/${type}`, id);

  const [newComment, setNewComment] = useState("");
  const [rating, setRating] = useState(0);
  const [hover, setHover] = useState(null);
  const [submitting, setSubmitting] = useState(false);

  if (loading) return <LoadingScreen message="Cargando opiniones..." />;
  if (!item)
    return <div className="container mt-5">No se encontró el elemento.</div>;

  const reviews = item.reviews || [];

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (rating === 0) {
      toast.error("Selecciona una puntuación.");
      return;
    }
    if (newComment.trim().length < 5) {
      toast.error("El comentario debe tener al menos 5 caracteres.");
      return;
    }
    setSubmitting(true);
    try {
      await api.post("/reviews", {
        rating,
        comment: newComment,
        [SERVICE_TYPE_MAP[type]]: id,
      });
      toast.success("¡Reseña publicada!");
      setNewComment("");
      setRating(0);
    } catch (err) {
      toast.error("No se pudo enviar la reseña. ¿Has iniciado sesión?");
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div className={styles.container}>
      <button className={styles.backBtn} onClick={() => navigate(-1)}>
        <FaArrowLeft /> Volver
      </button>

      <header className={styles.header}>
        <h1>Opiniones de {item.nombre || item.name || item.titulo}</h1>
        <div className={styles.statsRow}>
          <div>
            <p>Basado en {reviews.length} valoraciones</p>
          </div>
        </div>
      </header>

      <div className={styles.mainGrid}>
        <section className={styles.reviewsList}>
          {reviews.length > 0 ? (
            reviews.map((rev) => (
              <div key={rev.id} className={styles.reviewCard}>
                <div className={styles.reviewUser}>
                  <div className={styles.avatar}>
                    {rev.user?.name?.charAt(0) ||
                      rev.usuario_nombre?.charAt(0) || <FaUserCircle />}
                  </div>
                  <div>
                    <h4>
                      {rev.user?.name ||
                        rev.usuario_nombre ||
                        "Usuario Anónimo"}
                    </h4>
                    <div className={styles.stars}>
                      {[...Array(5)].map((_, i) => (
                        <FaStar
                          key={i}
                          color={
                            i < (rev.rating ?? rev.puntuacion)
                              ? "#ffc107"
                              : "#e4e5e9"
                          }
                        />
                      ))}
                    </div>
                  </div>
                </div>
                <p className={styles.commentText}>
                  {rev.comment || rev.comentario}
                </p>
              </div>
            ))
          ) : (
            <p className={styles.noReviews}>
              Aún no hay opiniones. ¡Sé el primero!
            </p>
          )}
        </section>

        <aside className={styles.formSidebar}>
          <div className={styles.formCard}>
            <h3>Escribe tu opinión</h3>
            <form onSubmit={handleSubmit}>
              <div className={styles.starPicker}>
                {[...Array(5)].map((_, i) => {
                  const val = i + 1;
                  return (
                    <FaStar
                      key={i}
                      className={styles.starIcon}
                      color={val <= (hover || rating) ? "#ffc107" : "#e4e5e9"}
                      onMouseEnter={() => setHover(val)}
                      onMouseLeave={() => setHover(null)}
                      onClick={() => setRating(val)}
                    />
                  );
                })}
              </div>
              <textarea
                placeholder="Cuéntanos tu experiencia..."
                value={newComment}
                onChange={(e) => setNewComment(e.target.value)}
                required
              />
              <button
                type="submit"
                className={styles.submitBtn}
                disabled={rating === 0 || submitting}
              >
                {submitting ? "Publicando..." : "Publicar comentario"}
              </button>
            </form>
          </div>
        </aside>
      </div>
    </div>
  );
}
