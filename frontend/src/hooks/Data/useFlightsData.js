import { useState, useMemo, useEffect } from "react";
import { useLiveResource } from "../LiveResource/useLiveResource";
import api from "../../api/axios";
import { useFilter } from "../useFilter";

export function useFlightsData() {
  const { data: flights, isLoading: loading, isError } = useLiveResource(
    ["flight-offers"],
    async () => {
      const res = await api.get("/flight-offers");
      const d = res.data.data ?? res.data; return Array.isArray(d) ? d : [];
    },
    { interval: 60000 },
  );

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 5;

  const dynamicPriceLimit = useMemo(() => {
    if (!Array.isArray(flights) || flights.length === 0) return 2000;
    const max = Math.max(...flights.map((f) => f.precio_total || 0));
    return Math.ceil(max / 100) * 100;
  }, [flights]);

  const [filters, setFilters] = useState({
    origin: "Todos",
    dest: "Todos",
    airline: "Todas",
    price: 2000,
  });

  useEffect(() => {
    if (dynamicPriceLimit > 0) {
      setFilters((prev) => ({ ...prev, price: dynamicPriceLimit }));
    }
  }, [dynamicPriceLimit]);

  const options = useMemo(
    () => ({
      origins: [
        "Todos",
        ...new Set(flights?.map((f) => f.ida?.origen).filter(Boolean)),
      ],
      destinations: [
        "Todos",
        ...new Set(flights?.map((f) => f.ida?.destino).filter(Boolean)),
      ],
      airlines: [
        "Todas",
        ...new Set(flights?.map((f) => f.ida?.aerolinea).filter(Boolean)),
      ],
    }),
    [flights],
  );

  const filteredFlights = useFilter(flights, filters, (f) => {
    const info = f.ida || {};
    return (
      (filters.origin === "Todos" || info.origen === filters.origin) &&
      (filters.dest === "Todos" || info.destino === filters.dest) &&
      (filters.airline === "Todas" || info.aerolinea === filters.airline) &&
      (f.precio_total || 0) <= filters.price
    );
  });

  const totalPages = Math.ceil(filteredFlights.length / itemsPerPage);

  const currentItems = useMemo(() => {
    return filteredFlights.slice(
      (currentPage - 1) * itemsPerPage,
      currentPage * itemsPerPage,
    );
  }, [filteredFlights, currentPage]);

  const handleReset = () => {
    setFilters({
      origin: "Todos",
      dest: "Todos",
      airline: "Todas",
      price: dynamicPriceLimit,
    });
    setCurrentPage(1);
  };

  return {
    flights: filteredFlights,
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
