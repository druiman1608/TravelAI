import React, { useState } from "react";
import { useAuth } from "../../../context/AuthContext";
import api from "../../../api/axios";
import { toast } from "react-toastify";
import styles from "./EditProfile.module.css";

export default function EditProfile() {
  const { user, refreshUser } = useAuth();
  const [formData, setFormData] = useState({
    name: user?.name || "",
    email: user?.email || "",
    password: "",
    confirmPassword: "",
  });

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (formData.password && formData.password !== formData.confirmPassword) {
      return toast.error("Las contraseñas no coinciden");
    }

    try {
      await api.put("/user/update", {
        nombre: formData.name,
        email: formData.email,
        password: formData.password,
      });

      toast.success("Perfil actualizado");
      refreshUser();
    } catch {
      toast.error("Error al actualizar el perfil");
    }
  };

  return (
    <form onSubmit={handleSubmit} className={styles.form}>
      <div className={styles.formGrid}>
        <div className={styles.group}>
          <label>Nombre</label>
          <input
            type="text"
            value={formData.name}
            onChange={(e) => setFormData({ ...formData, name: e.target.value })}
          />
        </div>
        <div className={styles.group}>
          <label>Email</label>
          <input
            type="email"
            value={formData.email}
            onChange={(e) =>
              setFormData({ ...formData, email: e.target.value })
            }
          />
        </div>
        <div className={styles.group}>
          <label>Nueva Contraseña (opcional)</label>
          <input
            type="password"
            placeholder="••••••••"
            value={formData.password}
            onChange={(e) =>
              setFormData({ ...formData, password: e.target.value })
            }
          />
        </div>
        <div className={styles.group}>
          <label>Confirmar Contraseña</label>
          <input
            type="password"
            placeholder="••••••••"
            value={formData.confirmPassword}
            onChange={(e) =>
              setFormData({ ...formData, confirmPassword: e.target.value })
            }
          />
        </div>
      </div>
      <button type="submit" className={styles.saveBtn}>
        Guardar Cambios
      </button>
    </form>
  );
}
