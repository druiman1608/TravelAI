import React from "react";
import styles from "./Common.module.css";

export default function Pagination({ currentPage, totalPages, onPageChange }) {
  if (totalPages <= 1) return null;
  return (
    <div className={styles.paginationContainer}>
      <button
        disabled={currentPage === 1}
        onClick={() => onPageChange(currentPage - 1)}
        className={styles.pageBtn}
      >
        {" "}
        Anterior{" "}
      </button>
      <span className={styles.pageInfo}>
        Página <b>{currentPage}</b> de {totalPages}
      </span>
      <button
        disabled={currentPage === totalPages}
        onClick={() => onPageChange(currentPage + 1)}
        className={styles.pageBtn}
      >
        {" "}
        Siguiente{" "}
      </button>
    </div>
  );
}
