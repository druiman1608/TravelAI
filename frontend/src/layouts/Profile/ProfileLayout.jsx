import React from "react";
import { Link, Outlet, useLocation, useNavigate } from "react-router-dom";
import styles from "./ProfileLayout.module.css";
import {
  HiUser,
  HiShoppingBag,
  HiCog,
  HiStar,
  HiBadgeCheck,
  HiLogout,
} from "react-icons/hi";
import { useAuth } from "../../context/AuthContext";

export default function ProfileLayout() {
  const location = useLocation();
  const navigate = useNavigate();
  const { user, loading, logout } = useAuth();

  if (loading) return <p>Cargando...</p>;

  const menuItems = [
    { path: "/perfil", label: "Mis Datos", icon: <HiUser /> },
    {
      path: "/perfil/reservas",
      label: "Mis Reservas",
      icon: <HiShoppingBag />,
    },
    { path: "/perfil/resenas", label: "Mis Reseñas", icon: <HiStar /> },
    { path: "/perfil/premium", label: "Plan Premium", icon: <HiBadgeCheck /> },
    { path: "/perfil/configuracion", label: "Configuración", icon: <HiCog /> },
  ];

  const handleLogoutClick = async () => {
    await logout();
    navigate("/");
  };

  return (
    <div className={styles.profileContainer}>
      <aside className={styles.sidebar}>
        <div className={styles.userBadge}>
          <div className={styles.avatarPlaceholder}>
            {user?.name?.substring(0, 2).toUpperCase() || "US"}
          </div>
          <h3>Bienvenido, {user?.name || "Usuari@"}</h3>
        </div>

        <nav className={styles.nav}>
          {menuItems.map((item) => (
            <Link
              key={item.path}
              to={item.path}
              className={`${styles.navLink} ${
                location.pathname === item.path ? styles.active : ""
              }`}
            >
              <span className={styles.icon}>{item.icon}</span>
              {item.label}
            </Link>
          ))}

          <button onClick={handleLogoutClick} className={styles.logoutBtn}>
            <span className={styles.icon}>
              <HiLogout />
            </span>
            Cerrar Sesión
          </button>
        </nav>
      </aside>

      <main className={styles.content}>
        <Outlet />
      </main>
    </div>
  );
}
