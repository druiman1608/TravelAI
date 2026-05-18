import React, { useState } from "react";
import styles from "./ReviewSection.module.css";
import { HiStar, HiUserCircle } from "react-icons/hi";
import { useAuth } from "../../context/AuthContext";
import api from "../../api/axios";
import { toast } from "react-toastify";
import { Link } from "react-router-dom";

export default function ReviewSection({ reviews, entityType, entityId }) {
  const { isAuthenticated } = useAuth();
  const displayReviews = reviews || [];

  const [rating, setRating] = useState(0);
  const [hoverRating, setHoverRating] = useState(0);
  const [comment, setComment] = useState("");
  const [submitting, setSubmitting] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!rating) return toast.error("Selecciona una puntuación.");
    if (comment.trim().length < 5) return toast.error("El comentario debe tener al menos 5 caracteres.");

    setSubmitting(true);
    try {
      await api.post("/reviews", {
        [entityType]: entityId,
        rating,
        comment: comment.trim(),
      });
      toast.success("Reseña enviada. Estará disponible tras ser revisada por moderación.");
      setRating(0);
      setComment("");
    } catch (err) {
      const serverError =
        err.response?.data?.errors?.servicio?.[0] ||
        err.response?.data?.message ||
        "Error al enviar la reseña.";
      toast.error(serverError);
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <section className={styles.reviewWrapper}>
      <h2 className={styles.sectionTitle}>Lo que dicen nuestros viajeros</h2>

      {displayReviews.length > 0 ? (
        <div className={styles.reviewGrid}>
          {displayReviews.map((rev) => (
            <div key={rev.id} className={styles.reviewCard}>
              <div className={styles.userHeader}>
                <HiUserCircle className={styles.userIcon} />
                <div>
                  <span className={styles.userName}>
                    {rev.usuario_nombre || "Usuario"}
                  </span>
                  <div className={styles.starsDisplay}>
                    {[...Array(5)].map((_, i) => (
                      <HiStar
                        key={i}
                        className={
                          i < (rev.puntuacion || 5)
                            ? styles.starActive
                            : styles.starInactive
                        }
                      />
                    ))}
                  </div>
                </div>
              </div>
              <p className={styles.comment}>"{rev.comentario}"</p>
            </div>
          ))}
        </div>
      ) : (
        <div className={styles.noReviewsBox}>
          <p>
            Aún no hay reseñas para este servicio. ¡Sé el primero en compartir
            tu experiencia!
          </p>
        </div>
      )}

      {entityType && entityId && (
        <div className={styles.formSection}>
          <h3 className={styles.formTitle}>Deja tu valoración</h3>
          {isAuthenticated ? (
            <form className={styles.reviewForm} onSubmit={handleSubmit}>
              <div className={styles.starsInput}>
                {[1, 2, 3, 4, 5].map((n) => (
                  <HiStar
                    key={n}
                    className={
                      n <= (hoverRating || rating)
                        ? styles.starInputActive
                        : styles.starInputInactive
                    }
                    onMouseEnter={() => setHoverRating(n)}
                    onMouseLeave={() => setHoverRating(0)}
                    onClick={() => setRating(n)}
                  />
                ))}
                {rating > 0 && (
                  <span className={styles.ratingLabel}>{rating} / 5</span>
                )}
              </div>
              <textarea
                className={styles.commentInput}
                placeholder="Cuéntanos tu experiencia..."
                value={comment}
                onChange={(e) => setComment(e.target.value)}
                rows={4}
                maxLength={1000}
              />
              <button
                type="submit"
                className={styles.submitBtn}
                disabled={submitting}
              >
                {submitting ? "Enviando..." : "Enviar reseña"}
              </button>
            </form>
          ) : (
            <div className={styles.loginPrompt}>
              <p>
                <Link to="/login" className={styles.loginLink}>Inicia sesión</Link>{" "}
                para dejar tu valoración.
              </p>
            </div>
          )}
        </div>
      )}
    </section>
  );
}
