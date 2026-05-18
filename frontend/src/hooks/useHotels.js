import { useState, useEffect } from "react";
import api from "../api/axios";
import { toast } from "react-toastify";
import { useCrud } from "./useCrud";

export function useHotels() {
  const crud = useCrud("/hotels");
  const [locations, setLocations] = useState([]);
  const [fotos, setFotos] = useState({ principal: null, f2: null, f3: null });

  useEffect(() => {
    api
      .get("/locations")
      .then((res) => {
        const result = res.data.data || res.data;
        setLocations(Array.isArray(result) ? result : []);
      })
      .catch(() => toast.error("Error al cargar ubicaciones"));
  }, []);

  const saveHotel = async (formData, id = null) => {
    const data = new FormData();

    data.append("name", formData.nombre);
    data.append("address", formData.direccion);
    data.append("description", formData.descripcion);
    data.append("zip_code", formData.codigo_postal);
    data.append("stars", formData.estrellas);
    data.append("price_per_night", formData.precio_noche);
    data.append("location_id", formData.ubicacion_id);
    data.append("available_rooms", 10);

    if (formData.extras) {
      data.append("extras", JSON.stringify(formData.extras));
    }

    if (formData.servicios) {
      const servicesArray = formData.servicios
        .split(",")
        .map((s) => s.trim())
        .filter(Boolean);
      servicesArray.forEach((service, index) => {
        data.append(`services[${index}]`, service);
      });
    }

    if (fotos.principal) data.append("images[]", fotos.principal);
    if (fotos.f2) data.append("images[]", fotos.f2);
    if (fotos.f3) data.append("images[]", fotos.f3);

    try {
      if (id) {
        data.append("_method", "PUT");
        await api.post(`/hotels/${id}`, data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
        toast.success("Hotel actualizado correctamente");
      } else {
        await api.post("/hotels", data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
        toast.success("Hotel registrado correctamente");
      }

      crud.refresh();
      crud.closeModal();
      setFotos({ principal: null, f2: null, f3: null });
    } catch (e) {
      toast.error("Error al guardar el hotel");
    }
  };

  return { ...crud, locations, fotos, setFotos, saveHotel };
}
