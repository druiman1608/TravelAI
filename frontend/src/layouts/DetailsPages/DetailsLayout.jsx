import React from "react";
import { Link } from "react-router-dom";
import { HiLocationMarker, HiArrowLeft } from "react-icons/hi";
import Gallery from "../../components/Gallery/Gallery";
import ReviewSection from "../../components/ReviewSection/ReviewSection";
import styles from "./DetailsLayout.module.css";

export default function DetailsLayout({
  item,
  title,
  stars,
  location,
  images,
  sidebarContent,
  children,
  backPath,
  onReserve,
  entityType,
}) {
  return (
    <div className={styles.mainContainer}>
      <Link to={backPath} className={styles.backBtn}>
        <div className={styles.backCircle}>
          <HiArrowLeft />
        </div>
        <span>Volver</span>
      </Link>

      <div className={styles.topCard}>
        <div className={styles.titleArea}>
          <div className={styles.titleRow}>
            <h1>{title}</h1>
            {stars && <div className={styles.starsBadge}>{stars}</div>}
          </div>
          <p className={styles.locationText}>
            <HiLocationMarker className={styles.locIcon} /> {location}
          </p>
        </div>
        {onReserve && (
          <button className={styles.btnReserveTop} onClick={onReserve}>
            Reservar ahora
          </button>
        )}
      </div>

      <div className={styles.contentGrid}>
        <div className={styles.galleryWrapper}>
          <Gallery images={images} />
        </div>
        <aside className={styles.detailsSidebar}>
          <div className={styles.sidebarInner}>{sidebarContent}</div>
        </aside>
      </div>

      <div className={styles.descriptionBox}>
        <h3>Descripción</h3>
        <div className={styles.descriptionContent}>
          {item?.description || item?.descripcion}
        </div>
      </div>

      {children}

      <div className={styles.reviewsWrapper}>
        <ReviewSection
          reviews={item?.reviews || []}
          entityType={entityType}
          entityId={item?.id}
        />
      </div>
    </div>
  );
}
