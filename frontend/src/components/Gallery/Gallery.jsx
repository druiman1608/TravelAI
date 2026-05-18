import React, { useState } from "react";
import Lightbox from "yet-another-react-lightbox";
import "yet-another-react-lightbox/styles.css";
import { HiPhotograph } from "react-icons/hi";
import styles from "./Gallery.module.css";

export default function Gallery({ images = [] }) {
  const [open, setOpen] = useState(false);
  const [index, setIndex] = useState(0);

  const validImages = images.filter(Boolean);
  const hasImages = validImages.length > 0;

  const slides = validImages.map((img) => ({ src: img }));

  const openLightbox = (i) => {
    setIndex(i);
    setOpen(true);
  };

  if (!hasImages) {
    return (
      <div className={styles.galleryContainer}>
        <div className={styles.mosaicGrid}>
          <div className={`${styles.mainImage} ${styles.placeholderMain}`}>
            <HiPhotograph className={styles.placeholderIcon} />
            <span className={styles.placeholderText}>Sin imágenes disponibles</span>
          </div>
          <div className={styles.sideImages}>
            <div className={`${styles.subImg} ${styles.placeholderSub}`} />
            <div className={`${styles.subImg} ${styles.placeholderSub}`} />
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className={styles.galleryContainer}>
      <div className={styles.mosaicGrid}>
        <div className={styles.mainImage} onClick={() => openLightbox(0)}>
          <img src={validImages[0]} alt="Principal" loading="lazy" />
        </div>

        <div className={styles.sideImages}>
          {validImages.slice(1, 3).map((img, i) => (
            <div
              key={i}
              className={styles.subImg}
              onClick={() => openLightbox(i + 1)}
            >
              <img src={img} alt={`Sub ${i}`} loading="lazy" />
              {i === 1 && validImages.length > 3 && (
                <div className={styles.overlay}>
                  <span>+{validImages.length - 3}</span>
                </div>
              )}
            </div>
          ))}
          {validImages.length === 1 && (
            <>
              <div className={`${styles.subImg} ${styles.placeholderSub}`} />
              <div className={`${styles.subImg} ${styles.placeholderSub}`} />
            </>
          )}
          {validImages.length === 2 && (
            <div className={`${styles.subImg} ${styles.placeholderSub}`} />
          )}
        </div>
      </div>

      <Lightbox
        open={open}
        close={() => setOpen(false)}
        index={index}
        slides={slides}
      />
    </div>
  );
}
