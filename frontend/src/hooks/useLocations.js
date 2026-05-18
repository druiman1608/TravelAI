import { useState } from "react";
import api from "../api/axios";
import { toast } from "react-toastify";
import { useCrud } from "./useCrud";

export function useLocations() {
  const crud = useCrud("/locations");
  const [foto, setFoto] = useState(null);

  const saveLocation = async (formData, id = null) => {
    const data = new FormData();
    data.append("city", formData.ciudad);
    data.append("country", formData.pais);
    data.append("continent", formData.continente);
    data.append("weather_type", formData.clima);
    data.append("description", formData.descripcion);
    data.append("status", formData.activo ? 1 : 0);
    if (foto) data.append("foto", foto);

    try {
      if (id) {
        data.append("_method", "PUT");
        await api.post(`/locations/${id}`, data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
      } else {
        await api.post("/locations", data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
      }
      toast.success("Destino guardado");
      crud.refresh();
      crud.closeModal();
      setFoto(null);
    } catch (e) {
      toast.error("Error al guardar destino");
    }
  };

  return { ...crud, setFoto, saveLocation };
}
