import { useState, useEffect, useCallback } from "react";
import api from "../api/axios";
import { toast } from "react-toastify";
import { useQueryClient } from "@tanstack/react-query";

export function useCrud(endpoint) {
  const queryClient = useQueryClient();
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [selectedItem, setSelectedItem] = useState(null);

  const queryKey = endpoint.replaceAll("/", "");

  const fetchData = useCallback(async () => {
    setLoading(true);
    try {
      const res = await api.get(endpoint);
      const result = res.data.data || res.data;
      setData(Array.isArray(result) ? result : []);

      queryClient.invalidateQueries({ queryKey: [queryKey] });
    } catch (error) {
      toast.error(`Error al cargar datos de ${endpoint}`);
    } finally {
      setLoading(false);
    }
  }, [endpoint, queryClient, queryKey]);

  useEffect(() => {
    fetchData();
  }, [fetchData]);

  useEffect(() => {
    const id = setInterval(fetchData, 30000);
    return () => clearInterval(id);
  }, [fetchData]);

  const handleDelete = async (id) => {
    if (!window.confirm("¿Estás seguro de eliminar este registro?")) return;
    try {
      await api.delete(`${endpoint}/${id}`);
      setData((prev) => prev.filter((item) => item.id !== id));

      queryClient.invalidateQueries({ queryKey: [queryKey] });

      toast.success("Eliminado correctamente");
    } catch (error) {
      toast.error("No se pudo eliminar");
    }
  };

  const openModal = (item = null) => {
    setSelectedItem(item);
    setIsModalOpen(true);
  };

  const closeModal = () => {
    setIsModalOpen(false);
    setSelectedItem(null);
  };

  const refresh = () => fetchData();

  return {
    data,
    loading,
    handleDelete,
    refresh,
    isModalOpen,
    setIsModalOpen,
    selectedItem,
    setSelectedItem,
    openModal,
    closeModal,
    setData,
  };
}
