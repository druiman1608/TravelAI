import { useState, useMemo, useEffect } from "react";
import { useLiveResource } from "../LiveResource/useLiveResource";
import api from "../../api/axios";
import { useFilter } from "../useFilter";

export function usePackagesData() {
  const { data: allPackages, isLoading: loading, isError } = useLiveResource(
    ["packages"],
    async () => {
      const res = await api.get("/packages");
      return res.data.data || res.data;
    },
    { interval: 60000 },
  );

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 5;

  const dynamicPriceLimit = useMemo(() => {
    if (!allPackages || allPackages.length === 0) return 5000;
    const max = Math.max(...allPackages.map((p) => p.precio_total || 0));
    return Math.ceil(max / 500) * 500;
  }, [allPackages]);

  const [filters, setFilters] = useState({
    search: "",
    price: 5000,
    activity: "Todas",
    country: "Todos",
  });

  useEffect(() => {
    if (dynamicPriceLimit > 0) {
      setFilters((prev) => ({ ...prev, price: dynamicPriceLimit }));
    }
  }, [dynamicPriceLimit]);

  const options = useMemo(
    () => ({
      activities: [
        "Todas",
        ...new Set(
          allPackages?.map((p) => p.actividad?.nombre).filter(Boolean),
        ),
      ],
      countries: [
        "Todos",
        ...new Set(allPackages?.map((p) => p.destino).filter(Boolean)),
      ],
    }),
    [allPackages],
  );

  const filtered = useFilter(allPackages, filters, (p) => {
    const currentPrice = p.precio_descuento || p.precio_total || 0;
    const searchLower = filters.search.toLowerCase();
    const matchesSearch =
      (p.nombre || "").toLowerCase().includes(searchLower) ||
      (p.destino || "").toLowerCase().includes(searchLower);
    const matchesPrice = currentPrice <= filters.price;
    const matchesActivity =
      filters.activity === "Todas" || p.actividad?.nombre === filters.activity;
    const matchesCountry =
      filters.country === "Todos" || p.destino === filters.country;
    return matchesSearch && matchesPrice && matchesActivity && matchesCountry;
  });

  const totalPages = Math.ceil(filtered.length / itemsPerPage);

  const currentItems = useMemo(() => {
    return filtered.slice(
      (currentPage - 1) * itemsPerPage,
      currentPage * itemsPerPage,
    );
  }, [filtered, currentPage]);

  const handleReset = () => {
    setFilters({
      search: "",
      price: dynamicPriceLimit,
      activity: "Todas",
      country: "Todos",
    });
    setCurrentPage(1);
  };

  return {
    packages: filtered,
    currentItems,
    loading,
    error: isError,
    filters,
    setFilters,
    dynamicPriceLimit,
    options,
    handleReset,
    currentPage,
    setCurrentPage,
    totalPages,
  };
}
