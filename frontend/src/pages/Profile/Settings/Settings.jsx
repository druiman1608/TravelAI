import React from "react";
import EditProfile from "../EditProfile/EditProfile";
import EditPreferences from "../EditPreferences/EditPreferences";
import api from "../../../api/axios";
import { toast } from "react-toastify";
import styles from "./Settings.module.css";
import {
  HiOutlineExclamation,
  HiUser,
  HiAdjustments,
  HiShieldCheck,
} from "react-icons/hi";

export default function SettingsPage() {
  const handleDeleteAccount = async () => {
    if (
      window.confirm(
        "¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer y perderás todos tus datos y reservas.",
      )
    ) {
      try {
        await api.delete("/user/me");
        toast.success("Cuenta eliminada correctamente");
        localStorage.clear();
        window.location.href = "/";
      } catch (error) {
        toast.error("Error al eliminar la cuenta");
      }
    }
  };

  return (
    <div className={styles.settingsWrapper}>
      <header className={styles.header}>
        <h1>Configuración</h1>
        <p>Gestiona tu privacidad, datos personales y preferencias de viaje.</p>
      </header>

      <div className={styles.sectionsGrid}>
        <section className={styles.card}>
          <div className={styles.cardHeader}>
            <div className={styles.iconCircle}>
              <HiUser />
            </div>
            <h3>Datos Personales</h3>
          </div>
          <div className={styles.cardContent}>
            <EditProfile />
          </div>
        </section>

        <section className={styles.card}>
          <div className={styles.cardHeader}>
            <div className={styles.iconCircle}>
              <HiAdjustments />
            </div>
            <h3>Preferencias de Viaje</h3>
          </div>
          <div className={styles.cardContent}>
            <EditPreferences />
          </div>
        </section>

        <section className={`${styles.card} ${styles.dangerCard}`}>
          <div className={styles.cardHeader}>
            <div className={`${styles.iconCircle} ${styles.dangerIcon}`}>
              <HiShieldCheck />
            </div>
            <h3>Eliminar cuenta</h3>
          </div>
          <div className={styles.cardContent}>
            <div className={styles.dangerInfo}>
              <h4>¡Cuidado!</h4>
              <p>
                Al borrar tu cuenta, se eliminarán tus datos permanentemente,
                esta accion es irreversible.
              </p>
              <button
                onClick={handleDeleteAccount}
                className={styles.deleteButton}
              >
                Eliminar cuenta definitivamente
              </button>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
}
