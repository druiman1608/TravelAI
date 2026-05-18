import React, { useState, useEffect } from "react";
import api from "../../../api/axios";
import { useApi } from "../../../hooks/useApi";
import { toast } from "react-toastify";
import styles from "./EditPreferences.module.css";

export default function EditPreferences() {
  const [formData, setFormData] = useState({
    tipo_viaje: "",
    presupuesto_max: "",
    clima_favorito: "",
  });

  const { data, loading } = useApi("/preferences");

  useEffect(() => {
    if (data && !Array.isArray(data)) {
      setFormData({
        tipo_viaje: data.tipo_viaje || "",
        presupuesto_max: data.presupuesto_max || "",
        clima_favorito: data.clima_favorito || "",
      });
    }
  }, [data]);

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await api.post("/preferences", {
        travel_type: formData.tipo_viaje,
        max_budget: formData.presupuesto_max,
        fav_weather: formData.clima_favorito,
      });
      toast.success("Preferencias actualizadas");
    } catch (error) {
      toast.error("Error al actualizar");
    }
  };

  if (loading) return <p>Cargando...</p>;

  return (
    <form onSubmit={handleSubmit} className={styles.form}>
      <div className={styles.formGrid}>
        <div className={styles.group}>
          <label>Tipo de Viaje</label>
          <select
            name="tipo_viaje"
            value={formData.tipo_viaje}
            onChange={handleChange}
          >
            <option value="">Selecciona...</option>
            <option value="mochilero">Mochilero</option>
            <option value="lujo">Lujo</option>
            <option value="aventura">Aventura</option>
          </select>
        </div>
        <div className={styles.group}>
          <label>Presupuesto Máximo (€)</label>
          <input
            type="number"
            name="presupuesto_max"
            value={formData.presupuesto_max}
            onChange={handleChange}
          />
        </div>
        <div className={styles.group}>
          <label>Clima Favorito</label>
          <input
            type="text"
            name="clima_favorito"
            value={formData.clima_favorito}
            onChange={handleChange}
          />
        </div>
      </div>
      <button type="submit" className={styles.saveBtn}>
        Actualizar Preferencias
      </button>
    </form>
  );
}
