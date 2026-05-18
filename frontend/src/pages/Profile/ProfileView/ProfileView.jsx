import React, { useRef, useState } from "react";
import { useAuth } from "../../../context/AuthContext";
import styles from "./ProfileView.module.css";
import {
  HiMail,
  HiBadgeCheck,
  HiLightningBolt,
  HiUserCircle,
  HiMap,
  HiCash,
  HiStar,
  HiCamera,
} from "react-icons/hi";
import { Link } from "react-router-dom";
import api from "../../../api/axios";
import { toast } from "react-toastify";

export default function ProfileView() {
  const { user, loading, refreshUser } = useAuth();
  const fileInputRef = useRef(null);
  const [uploading, setUploading] = useState(false);

  const handleAvatarClick = () => fileInputRef.current?.click();

  const handleAvatarChange = async (e) => {
    const file = e.target.files?.[0];
    if (!file) return;
    const formData = new FormData();
    formData.append("avatar", file);
    setUploading(true);
    try {
      await api.post("/user/upload-avatar", formData, {
        headers: { "Content-Type": "multipart/form-data" },
      });
      await refreshUser();
      toast.success("Avatar actualizado correctamente.");
    } catch {
      toast.error("Error al subir la imagen.");
    } finally {
      setUploading(false);
    }
  };

  if (loading) return <div className={styles.loading}>Cargando perfil...</div>;

  return (
    <div className={styles.viewWrapper}>
      <header className={styles.header}>
        <h2>Mi Perfil</h2>
        <p>Resumen de tu cuenta</p>
      </header>

      <div className={styles.profileGrid}>
        <div className={styles.mainCard}>
          <div className={styles.avatarWrapper}>
            <div className={styles.avatarLarge}>
              {user?.avatar ? (
                <img src={user.avatar} alt="Avatar" className={styles.avatarImg} />
              ) : (
                <HiUserCircle />
              )}
            </div>
            <button
              className={styles.avatarEditBtn}
              onClick={handleAvatarClick}
              disabled={uploading}
              title="Cambiar foto"
            >
              <HiCamera />
            </button>
            <input
              ref={fileInputRef}
              type="file"
              accept="image/jpeg,image/png"
              hidden
              onChange={handleAvatarChange}
            />
          </div>
          <h3>{user?.name || "Usuario"}</h3>
          <div className={styles.emailInfo}>
            <HiMail /> {user?.email}
          </div>
          {user?.is_premium && (
            <div className={styles.premiumBadge}>
              <HiBadgeCheck /> Miembro Premium
            </div>
          )}
        </div>

        <div className={styles.detailsColumn}>
          <div className={styles.infoCard}>
            <div className={styles.cardHeader}>
              <HiLightningBolt className={styles.iconBlue} />
              <h3>Estado del plan</h3>
            </div>
            <p className={styles.planDesc}>
              {user?.is_premium
                ? "Disfrutas de todas las ventajas Premium e IA ilimitada."
                : "Actualmente usas el plan gratuito con funciones limitadas."}
            </p>
            <Link to="/perfil/premium" className={styles.planBtn}>
              {user?.is_premium ? "Gestionar suscripción" : "Hacerme Premium"}
            </Link>
          </div>

          <div className={styles.infoCard}>
            <div className={styles.cardHeader}>
              <HiStar className={styles.iconGold} />
              <h3>Mis Preferencias</h3>
            </div>
            <div className={styles.miniPrefs}>
              <div className={styles.prefItem}>
                <HiMap /> {user?.preferencias?.tipo_viaje || "No definido"}
              </div>
              <div className={styles.prefItem}>
                <HiCash /> {user?.preferencias?.presupuesto_max || "0"}€ máx.
              </div>
            </div>
            <Link to="/perfil/configuracion" className={styles.planBtn}>
              Editar todo
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}
