import { useState, useEffect } from "react";
import api from "../api/axios";
import { toast } from "react-toastify";

export const useFlightOffers = () => {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [selectedItem, setSelectedItem] = useState(null);

  const fetchOffers = async () => {
    try {
      setLoading(true);
      const response = await api.get("/flight-offers");
      setData(response.data.data || response.data);
    } catch (error) {
      toast.error("No se pudieron cargar las ofertas");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchOffers();
  }, []);

  const openModal = (item = null) => {
    setSelectedItem(item);
    setIsModalOpen(true);
  };

  const closeModal = () => {
    setSelectedItem(null);
    setIsModalOpen(false);
  };

  const saveOffer = async (formData, id = null) => {
    const payload = {
      type: formData.tipo,
      outbound_flight_id: formData.vuelo_ida_id,
      return_flight_id:
        formData.tipo === "round_trip" ? formData.vuelo_vuelta_id : null,
      total_price: formData.precio_total,
    };

    try {
      if (id) {
        await api.put(`/flight-offers/${id}`, payload);
        toast.success("Oferta actualizada correctamente");
      } else {
        await api.post("/flight-offers", payload);
        toast.success("Nueva oferta creada");
      }
      fetchOffers();
      closeModal();
    } catch (error) {
      toast.error("Error al procesar la oferta");
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm("¿Estás seguro de que quieres eliminar esta oferta?")) {
      try {
        await api.delete(`/flight-offers/${id}`);
        toast.info("Oferta eliminada");
        fetchOffers();
      } catch (error) {
        toast.error("Error al eliminar la oferta");
      }
    }
  };

  return {
    data,
    loading,
    isModalOpen,
    selectedItem,
    openModal,
    closeModal,
    saveOffer,
    handleDelete,
  };
};
