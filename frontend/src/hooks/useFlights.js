import { useState, useEffect } from "react";
import api from "../api/axios";
import { toast } from "react-toastify";
import { useCrud } from "./useCrud";

export function useFlights() {
  const crud = useCrud("/flights");
  const [locations, setLocations] = useState([]);
  const [imageFlight, setImageFlight] = useState(null);

  useEffect(() => {
    api
      .get("/locations")
      .then((res) => setLocations(res.data.data || []))
      .catch(() => toast.error("Error al cargar localizaciones de vuelos"));
  }, []);

  const saveFlight = async (formData, extras, id = null) => {
    const data = new FormData();

    data.append("flight_number", formData.numero_vuelo);
    data.append("airline", formData.aerolinea);
    data.append("origin_loc_id", formData.origen_id);
    data.append("destination_loc_id", formData.destino_id);
    data.append("price", formData.precio);
    data.append("capacity", formData.capacidad);
    data.append("departure", formData.salida.replace("T", " "));
    data.append("arrival", formData.llegada.replace("T", " "));
    data.append("duration_time", formData.duracion);
    data.append("stops", formData.escalas);

    if (extras && extras.length > 0) {
      const extrasObj = {};
      extras.forEach((item) => {
        if (item.clave.trim() && item.valor.trim()) {
          extrasObj[item.clave.trim()] = item.valor.trim();
        }
      });
      Object.entries(extrasObj).forEach(([k, v]) => {
        data.append(`extras[${k}]`, v);
      });
    }

    if (imageFlight) {
      data.append("image_flight", imageFlight);
    }

    try {
      if (id) {
        data.append("_method", "PUT");
        await api.post(`/flights/${id}`, data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
        toast.success("Vuelo actualizado correctamente");
      } else {
        await api.post("/flights", data, {
          headers: { "Content-Type": "multipart/form-data" },
        });
        toast.success("Vuelo creado correctamente");
      }

      await crud.refresh();

      crud.closeModal();
      setImageFlight(null);
    } catch {
      toast.error("Error al guardar el vuelo");
    }
  };

  return { ...crud, locations, saveFlight, imageFlight, setImageFlight };
}
