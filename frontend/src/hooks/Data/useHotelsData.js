import { useState, useMemo, useEffect } from "react";
import { useLiveResource } from "../LiveResource/useLiveResource";
import api from "../../api/axios";
import { useFilter } from "../useFilter";

export function useHotelsData() {
  const { data: hotels, isLoading: loading, isError } = useLiveResource(
    ["hotels"],
    async () => {
      const res = await api.get("/hotels");
      const d = res.data.data ?? res.data; return Array.isArray(d) ? d : [];
    },
    { interval: 60000 },
  );

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 6;

  const dynamicPriceLimit = useMemo(() => {
    if (!Array.isArray(hotels) || hotels.length === 0) return 2000;
    const max = Math.max(...hotels.map((h) => h.precio_noche || 0));
    return Math.ceil(max / 100) * 100;
  }, [hotels]);

  const [filters, setFilters] = useState({
    search: "",
    price: 2000,
    stars: 0,
    services: [],
    country: "Todos",
  });

  useEffect(() => {
    if (dynamicPriceLimit > 0) {
      setFilters((prev) => ({ ...prev, price: dynamicPriceLimit }));
    }
  }, [dynamicPriceLimit]);

  const dynamicServices = useMemo(() => {
    if (!Array.isArray(hotels)) return [];
    return [...new Set(hotels.flatMap((h) => h.servicios || []))].filter(
      Boolean,
    );
  }, [hotels]);

  const filteredHotels = useFilter(hotels, filters, (h) => {
    const searchLower = filters.search.toLowerCase();
    const matchesServices =
      filters.services.length === 0 ||
      filters.services.every((s) =>
        h.servicios?.some(
          (hotelServ) =>
            hotelServ.trim().toLowerCase() === s.trim().toLowerCase(),
        ),
      );

    const matchesSearch =
      (h.nombre || "").toLowerCase().includes(searchLower) ||
      (h.ubicacion_nombre || "").toLowerCase().includes(searchLower);

    const matchesPrice = (h.precio_noche || 0) <= filters.price;
    const matchesStars = filters.stars === 0 || h.estrellas === filters.stars;
    const matchesCountry =
      !filters.country || filters.country === "Todos" || h.ubicacion_nombre === filters.country;

    return matchesSearch && matchesPrice && matchesStars && matchesServices && matchesCountry;
  });

  const totalPages = Math.ceil(filteredHotels.length / itemsPerPage);

  const currentItems = useMemo(() => {
    return filteredHotels.slice(
      (currentPage - 1) * itemsPerPage,
      currentPage * itemsPerPage,
    );
  }, [filteredHotels, currentPage]);

  const handleReset = () => {
    setFilters({
      search: "",
      price: dynamicPriceLimit,
      stars: 0,
      services: [],
      country: "Todos",
    });
    setCurrentPage(1);
  };

  return {
    hotels: filteredHotels,
    currentItems,
    loading,
    error: isError,
    filters,
    setFilters,
    dynamicPriceLimit,
    dynamicServices,
    handleReset,
    currentPage,
    setCurrentPage,
    totalPages,
  };
}
