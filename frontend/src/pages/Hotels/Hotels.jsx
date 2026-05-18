import React from "react";
import { useHotelsData } from "../../hooks/Data/useHotelsData";
import MainLayout from "../../layouts/MainPages/MainLayout";
import SidebarFilters from "../../components/Common/SideBarFilter";
import HotelCard from "../../components/HotelCards/HotelCard";
import LoadingScreen from "../../components/Common/LoadingScreen";
import ErrorScreen from "../../components/Common/ErrorScreen";
import Pagination from "../../components/Common/Pagination";
import NoResults from "../../components/Common/NoResults";
import styles from "./Hotels.module.css";

export default function Hotels() {
  const {
    hotels,
    currentItems,
    loading,
    filters,
    setFilters,
    dynamicPriceLimit,
    dynamicServices,
    handleReset,
    currentPage,
    setCurrentPage,
    totalPages,
    error,
  } = useHotelsData();

  if (loading) return <LoadingScreen message="Buscando los mejores alojamientos..." />;
  if (error) return <ErrorScreen message="No se pudieron cargar los hoteles. Por favor, inténtalo de nuevo." />;

  return (
    <MainLayout
      title="Hoteles Disponibles"
      totalCount={hotels.length}
      unit="hoteles"
      sidebar={
        <SidebarFilters
          showSearch={false}
          maxPrice={filters.price}
          setMaxPrice={(v) => setFilters({ ...filters, price: v })}
          priceLimit={dynamicPriceLimit}
          resetFilters={handleReset}
        >
          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>Categoría</label>
            <select
              className={styles.selectInput}
              value={filters.stars}
              onChange={(e) =>
                setFilters({ ...filters, stars: Number(e.target.value) })
              }
            >
              <option value="0">Todas las estrellas</option>
              {[5, 4, 3, 2, 1].map((n) => (
                <option key={n} value={n}>
                  {n} Estrellas
                </option>
              ))}
            </select>{" "}
          </div>

          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>Ubicación</label>
            <select
              className={styles.selectInput}
              value={filters.country || "Todos"}
              onChange={(e) =>
                setFilters({ ...filters, country: e.target.value })
              }
            >
              <option value="Todos">Todas las ubicaciones</option>
              {[
                ...new Set(
                  hotels?.map((h) => h.ubicacion_nombre).filter(Boolean),
                ),
              ].map((loc) => (
                <option key={loc} value={loc}>
                  {loc}
                </option>
              ))}
            </select>
          </div>

          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>Servicios</label>
            <div className={styles.servicesGrid}>
              {dynamicServices.map((s) => (
                <label key={s} className={styles.checkboxLabel}>
                  <input
                    type="checkbox"
                    checked={filters.services.includes(s)}
                    onChange={(e) => {
                      const next = e.target.checked
                        ? [...filters.services, s]
                        : filters.services.filter((serv) => serv !== s);
                      setFilters({ ...filters, services: next });
                    }}
                  />{" "}
                  {s}
                </label>
              ))}
            </div>
          </div>
        </SidebarFilters>
      }
    >
      {hotels.length > 0 ? (
        <>
          <div className={styles.grid}>
            {currentItems.map((h) => (
              <HotelCard key={h.id} hotel={h} />
            ))}
          </div>
          <Pagination
            currentPage={currentPage}
            totalPages={totalPages}
            onPageChange={setCurrentPage}
          />
        </>
      ) : (
        <NoResults onReset={handleReset} />
      )}
    </MainLayout>
  );
}
