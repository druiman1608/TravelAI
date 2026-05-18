import React from "react";
import styles from "./SideBarFilter.module.css";
import { HiFilter } from "react-icons/hi";

export default function SidebarFilters({
  searchTerm,
  setSearchTerm,
  maxPrice,
  setMaxPrice,
  resetFilters,
  children,
  showSearch = true,
  priceLimit = 5000,
}) {
  return (
    <aside className={styles.sidebar}>
      <h3 className={styles.sidebarTitle}>
        <HiFilter /> Filtros
      </h3>

      {showSearch && (
        <div className={styles.filterGroup}>
          <label>Buscar por nombre</label>
          <input
            type="text"
            className={styles.textInput}
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            placeholder="¿Qué buscas?"
          />
        </div>
      )}

      <div className={styles.filterGroup}>
        <div className={styles.priceRow}>
          <label>Precio Máximo</label>
          <span className={styles.priceValue}>{maxPrice}€</span>
        </div>
        <input
          type="range"
          className={styles.rangeInput}
          min="0"
          max={priceLimit}
          value={maxPrice}
          onChange={(e) => setMaxPrice(Number(e.target.value))}
        />
      </div>

      <div className={styles.extraFilters}>{children}</div>

      <button className={styles.resetBtn} onClick={resetFilters}>
        Limpiar Filtros
      </button>
    </aside>
  );
}
