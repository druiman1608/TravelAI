import React, { useState } from "react";
import api from "../../api/axios";
import styles from "./ReviewForm.module.css";
import { HiStar } from "react-icons/hi";
import { toast } from "react-toastify";

export default function ReviewForm({
  serviceId,
  serviceType,
  onReviewSubmitted,
}) {
  const [rating, setRating] = useState(0);
  const [hover, setHover] = useState(0);
  const [comment, setComment] = useState("");
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (rating === 0) {
      toast.error("Por favor, selecciona una puntuación");
      return;
    }
    setLoading(true);

    const reviewData = {
      rating: rating,
      comment: comment,
      [serviceType]: serviceId,
    };

    try {
      await api.post("/reviews", reviewData);
      toast.success("¡Gracias! Tu reseña ha sido enviada.");
      setRating(0);
      setComment("");
      if (onReviewSubmitted) onReviewSubmitted();
    } catch (error) {
      toast.error("No se pudo enviar la reseña. ¿Has iniciado sesión?");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className={styles.formContainer}>
      <h3>Deja tu opinión</h3>
      <p>Tu experiencia ayuda a otros viajeros a elegir mejor.</p>

      <form onSubmit={handleSubmit} className={styles.formElement}>
        <div className={styles.starRating}>
          {[...Array(5)].map((_, index) => {
            const ratingValue = index + 1;
            return (
              <HiStar
                key={index}
                className={styles.star}
                color={ratingValue <= (hover || rating) ? "#ffc107" : "#e4e5e9"}
                onMouseEnter={() => setHover(ratingValue)}
                onMouseLeave={() => setHover(0)}
                onClick={() => setRating(ratingValue)}
              />
            );
          })}
          {rating > 0 && (
            <span className={styles.ratingText}>{rating} / 5</span>
          )}
        </div>

        <textarea
          className={styles.textarea}
          placeholder="Escribe aquí tu comentario sobre el servicio..."
          value={comment}
          onChange={(e) => setComment(e.target.value)}
          required
        />

        <button type="submit" className={styles.submitBtn} disabled={loading}>
          {loading ? "Enviando..." : "Enviar Reseña"}
        </button>
      </form>
    </div>
  );
}
