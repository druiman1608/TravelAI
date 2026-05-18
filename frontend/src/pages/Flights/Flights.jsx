import React from "react";
import { useFlightsData } from "../../hooks/Data/useFlightsData";
import MainLayout from "../../layouts/MainPages/MainLayout";
import SidebarFilters from "../../components/Common/SideBarFilter";
import FlightCard from "../../components/FlightCards/FlightCard";
import LoadingScreen from "../../components/Common/LoadingScreen";
import ErrorScreen from "../../components/Common/ErrorScreen";
import Pagination from "../../components/Common/Pagination";
import NoResults from "../../components/Common/NoResults";
import styles from "./Flights.module.css";

export default function Flights() {
  const {
    flights,
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
  } = useFlightsData();

  if (loading) return <LoadingScreen message="Buscando las mejores rutas..." />;
  if (error) return <ErrorScreen message="No se pudieron cargar los vuelos. Por favor, inténtalo de nuevo." />;

  return (
    <MainLayout
      title="Vuelos Disponibles"
      totalCount={flights.length}
      unit="vuelos"
      sidebar={
        <SidebarFilters
          showSearch={false}
          maxPrice={filters.price}
          setMaxPrice={(v) => setFilters({ ...filters, price: v })}
          priceLimit={dynamicPriceLimit}
          resetFilters={handleReset}
        >
          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>Desde</label>
            <select
              className={styles.selectInput}
              value={filters.origin}
              onChange={(e) =>
                setFilters({ ...filters, origin: e.target.value })
              }
            >
              {options.origins.map((o) => (
                <option key={o} value={o}>
                  {o}
                </option>
              ))}
            </select>
          </div>

          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>Hacia</label>
            <select
              className={styles.selectInput}
              value={filters.dest}
              onChange={(e) => setFilters({ ...filters, dest: e.target.value })}
            >
              {options.destinations.map((d) => (
                <option key={d} value={d}>
                  {d}
                </option>
              ))}
            </select>
          </div>

          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>Aerolínea</label>
            <select
              className={styles.selectInput}
              value={filters.airline}
              onChange={(e) =>
                setFilters({ ...filters, airline: e.target.value })
              }
            >
              {options.airlines.map((a) => (
                <option key={a} value={a}>
                  {a}
                </option>
              ))}
            </select>
          </div>
        </SidebarFilters>
      }
    >
      {flights.length > 0 ? (
        <>
          <div className={styles.grid}>
            {currentItems.map((f) => (
              <FlightCard key={f.id} flight={f} />
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
