import React from "react";
import styles from "./ReviewCard.module.css";
import { HiStar } from "react-icons/hi";

export default function ReviewCard({ review }) {
  const totalStars = 5;

  return (
    <div className={styles.reviewCardAlternative}>
      <div className={styles.leftCol}>
        <img
          src={
            review.user_avatar ||
            `https://ui-avatars.com/api/?name=${review.usuario_nombre}&background=0D8ABC&color=fff`
          }
          alt={review.usuario_nombre}
          className={styles.avatarLarge}
        />
        <div className={styles.starsRow}>
          {[...Array(totalStars)].map((_, i) => (
            <HiStar
              key={i}
              className={
                i < review.puntuacion ? styles.starFilled : styles.starEmpty
              }
            />
          ))}
        </div>
      </div>

      <div className={styles.rightCol}>
        <h4 className={styles.userName}>{review.usuario_nombre}</h4>
        <p className={styles.comment}>{review.comentario}</p>
      </div>
    </div>
  );
}
