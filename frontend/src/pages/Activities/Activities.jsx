import React from "react";
import { useActivitiesData } from "../../hooks/Data/useActivitiesData";
import MainLayout from "../../layouts/MainPages/MainLayout";
import SidebarFilters from "../../components/Common/SideBarFilter";
import ActivityCard from "../../components/ActivityCards/ActivityCards";
import LoadingScreen from "../../components/Common/LoadingScreen";
import ErrorScreen from "../../components/Common/ErrorScreen";
import Pagination from "../../components/Common/Pagination";
import NoResults from "../../components/Common/NoResults";
import styles from "./Activities.module.css";

export default function Activities() {
  const {
    activities,
    currentItems,
    loading,
    error,
    filters,
    setFilters,
    dynamicPriceLimit,
    options,
    handleReset,
    currentPage,
    setCurrentPage,
    totalPages,
  } = useActivitiesData();

  if (loading) return <LoadingScreen message="Cargando experiencias..." />;
  if (error) return <ErrorScreen message="No se pudieron cargar las actividades. Por favor, inténtalo de nuevo." />;

  return (
    <MainLayout
      title="Explora Experiencias"
      totalCount={activities.length}
      unit="actividades"
      sidebar={
        <SidebarFilters
          showSearch={false}
          maxPrice={filters.price}
          setMaxPrice={(v) => setFilters({ ...filters, price: v })}
          priceLimit={dynamicPriceLimit}
          resetFilters={handleReset}
        >
          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>País</label>
            <select
              className={styles.selectInput}
              value={filters.country}
              onChange={(e) =>
                setFilters({ ...filters, country: e.target.value })
              }
            >
              {options.countries.map((c) => (
                <option key={c} value={c}>
                  {c}
                </option>
              ))}
            </select>
          </div>

          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>Categoría</label>
            <select
              className={styles.selectInput}
              value={filters.type}
              onChange={(e) => setFilters({ ...filters, type: e.target.value })}
            >
              {options.types.map((t) => (
                <option key={t} value={t}>
                  {t}
                </option>
              ))}
            </select>
          </div>
        </SidebarFilters>
      }
    >
      {activities.length > 0 ? (
        <>
          <div className={styles.grid}>
            {currentItems.map((a) => (
              <ActivityCard key={a.id} activity={a} />
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
