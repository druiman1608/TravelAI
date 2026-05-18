import { useState, useMemo, useEffect } from "react";
import { useLiveResource } from "../LiveResource/useLiveResource";
import api from "../../api/axios";
import { useFilter } from "../useFilter";

export function useActivitiesData() {
  const { data: activities, isLoading: loading, isError } = useLiveResource(
    ["activities"],
    async () => {
      const res = await api.get("/activities");
      return res.data.data || res.data;
    },
    { interval: 60000 },
  );

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 6;

  const dynamicPriceLimit = useMemo(() => {
    if (!activities || activities.length === 0) return 1500;
    const max = Math.max(...activities.map((a) => a.precio || 0));
    return Math.ceil(max / 100) * 100;
  }, [activities]);

  const [filters, setFilters] = useState({
    search: "",
    price: 1500,
    type: "Todos",
    country: "Todos",
  });

  useEffect(() => {
    if (dynamicPriceLimit > 0) {
      setFilters((prev) => ({ ...prev, price: dynamicPriceLimit }));
    }
  }, [dynamicPriceLimit]);

  const options = useMemo(
    () => ({
      types: [
        "Todos",
        ...new Set(activities?.map((a) => a.tipo).filter(Boolean)),
      ],
      countries: [
        "Todos",
        ...new Set(activities?.map((a) => a.ubicacion_nombre).filter(Boolean)),
      ],
    }),
    [activities],
  );

  const filtered = useFilter(activities, filters, (a) => {
    const matchesSearch = (a.nombre || "")
      .toLowerCase()
      .includes(filters.search.toLowerCase());
    const matchesPrice = a.precio <= filters.price;
    const matchesType = filters.type === "Todos" || a.tipo === filters.type;
    const matchesCountry =
      filters.country === "Todos" || a.ubicacion_nombre === filters.country;
    return matchesSearch && matchesPrice && matchesType && matchesCountry;
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
      type: "Todos",
      country: "Todos",
    });
    setCurrentPage(1);
  };

  return {
    activities: filtered,
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
