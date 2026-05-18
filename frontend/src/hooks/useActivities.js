import { useState, useEffect } from "react";
import api from "../api/axios";
import { toast } from "react-toastify";
import { useCrud } from "./useCrud";

export function useActivities() {
  const crud = useCrud("/activities");

  const [locations, setLocations] = useState([]);
  const [fotos, setFotos] = useState({ principal: null, f2: null, f3: null });

  useEffect(() => {
    api
      .get("/locations")
      .then((res) => setLocations(res.data.data))
      .catch(() => toast.error("Error al cargar localizaciones"));
  }, []);

  const saveActivity = async (formData, id = null) => {
    const data = new FormData();

    data.append("name", formData.nombre);
    data.append("description", formData.descripcion);
    data.append("duration", `${formData.duracion} horas`);
    data.append("price", formData.precio);
    data.append("location_id", formData.location_id);

    if (fotos.principal) data.append("images[]", fotos.principal);
    if (fotos.f2) data.append("images[]", fotos.f2);
    if (fotos.f3) data.append("images[]", fotos.f3);

    if (formData.included_features) {
      const arr = formData.included_features
        .split(",")
        .map((s) => s.trim())
        .filter(Boolean);
      arr.forEach((f, i) => data.append(`included_features[${i}]`, f));
    }

    if (formData.extras && typeof formData.extras === "object") {
      Object.entries(formData.extras).forEach(([k, v]) => {
        data.append(`extras[${k}]`, v);
      });
    }

    try {
      if (id) {
        data.append("_method", "PUT");
        await api.post(`/activities/${id}`, data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
        toast.success("Experiencia actualizada con éxito");
      } else {
        await api.post("/activities", data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
        toast.success("Experiencia creada con éxito");
      }

      crud.refresh();
      crud.closeModal();
      setFotos({ principal: null, f2: null, f3: null });
    } catch (e) {
      const msg =
        e.response?.data?.message ||
        Object.values(e.response?.data?.errors || {}).flat()[0] ||
        "Error al guardar la actividad";
      toast.error(msg);
    }
  };

  return { ...crud, locations, fotos, setFotos, saveActivity };
}
