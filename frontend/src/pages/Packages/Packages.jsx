import React from "react";
import { usePackagesData } from "../../hooks/Data/usePackagesData";
import MainLayout from "../../layouts/MainPages/MainLayout";
import SidebarFilters from "../../components/Common/SideBarFilter";
import PackageCard from "../../components/PackageCards/PackageCard";
import LoadingScreen from "../../components/Common/LoadingScreen";
import ErrorScreen from "../../components/Common/ErrorScreen";
import Pagination from "../../components/Common/Pagination";
import NoResults from "../../components/Common/NoResults";
import styles from "./Packages.module.css";

export default function Packages() {
  const {
    packages,
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
  } = usePackagesData();

  if (loading) return <LoadingScreen message="Preparando paquetes de viaje..." />;
  if (error) return <ErrorScreen message="No se pudieron cargar los paquetes. Por favor, inténtalo de nuevo." />;

  return (
    <MainLayout
      title="Paquetes de Viaje"
      totalCount={packages.length}
      unit="paquetes"
      sidebar={
        <SidebarFilters
          showSearch={false}
          maxPrice={filters.price}
          setMaxPrice={(v) => setFilters({ ...filters, price: v })}
          priceLimit={dynamicPriceLimit}
          resetFilters={handleReset}
        >
          <div className={styles.extraFilterGroup}>
            <label className={styles.filterLabel}>Destino</label>
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
            <label className={styles.filterLabel}>Actividad incluida</label>
            <select
              className={styles.selectInput}
              value={filters.activity}
              onChange={(e) =>
                setFilters({ ...filters, activity: e.target.value })
              }
            >
              {options.activities.map((act) => (
                <option key={act} value={act}>
                  {act}
                </option>
              ))}
            </select>
          </div>
        </SidebarFilters>
      }
    >
      {packages.length > 0 ? (
        <>
          <div className={styles.grid}>
            {currentItems.map((pkg) => (
              <PackageCard key={pkg.id} pkg={pkg} />
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
