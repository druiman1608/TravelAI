import { useState, useEffect } from "react";
import api from "../api/axios";
import { useCrud } from "./useCrud";
import { toast } from "react-toastify";

export function usePackages() {
  const crud = useCrud("/packages");
  const [options, setOptions] = useState({
    hotels: [],
    flights: [],
    activities: [],
  });

  const [fotos, setFotos] = useState({ principal: null, f2: null, f3: null });

  useEffect(() => {
    const fetchOptions = async () => {
      const [h, f, a] = await Promise.all([
        api.get("/hotels"),
        api.get("/flights"),
        api.get("/activities"),
      ]);
      setOptions({
        hotels: h.data.data,
        flights: f.data.data,
        activities: a.data.data,
      });
    };
    fetchOptions();
  }, []);

  const savePackage = async (formData, id = null) => {
    const data = new FormData();

    data.append("name", formData.nombre);
    data.append("description", formData.descripcion);
    data.append("total_price", formData.precio_total);
    if (formData.precio_oferta)
      data.append("discount_price", formData.precio_oferta);
    if (formData.hotel_id) data.append("hotel_id", formData.hotel_id);
    if (formData.flight_id) data.append("flight_id", formData.flight_id);
    if (formData.activity_id) data.append("activity_id", formData.activity_id);

    if (formData.itinerario && formData.itinerario.length > 0) {
      formData.itinerario.forEach((line, i) =>
        data.append(`itinerary[${i}]`, line),
      );
    }

    if (fotos.principal) data.append("images[]", fotos.principal);
    if (fotos.f2) data.append("images[]", fotos.f2);
    if (fotos.f3) data.append("images[]", fotos.f3);

    try {
      if (id) {
        data.append("_method", "PUT");
        await api.post(`/packages/${id}`, data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
        toast.success("Paquete actualizado correctamente");
      } else {
        await api.post("/packages", data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
        toast.success("¡Paquete creado con éxito!");
      }

      crud.refresh();
      crud.closeModal();
      setFotos({ principal: null, f2: null, f3: null });
    } catch (e) {
      toast.error("Error al guardar el paquete");
    }
  };

  return { ...crud, ...options, fotos, setFotos, savePackage };
}
