import React, { createContext, useState, useContext, useEffect } from "react";
import api from "../api/axios";

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);
  const isAuthenticated = !!user;
  const isAdmin = user?.rol_nombre === "Administrador";
  const isMod = user?.rol_nombre === "Moderador";

  const normalizeUser = (rawData) => ({
    ...rawData,
    name: rawData.nombre,
    avatar: rawData.foto,
    role_label: rawData.rol_nombre,
    is_premium: rawData.rol_nombre === "Premium",
    preferencias: rawData.preferencias
      ? {
          tipo_viaje: rawData.preferencias.tipo_viaje,
          presupuesto_max: rawData.preferencias.presupuesto_max,
          clima_favorito: rawData.preferencias.clima_favorito,
        }
      : { tipo_viaje: "No definido", presupuesto_max: 0, clima_favorito: "No definido" },
  });

  const refreshUser = async () => {
    try {
      const res = await api.get("/user/profile-summary");
      const normalized = normalizeUser(res.data.data);
      setUser(normalized);
      return normalized;
    } catch (err) {
      if (err.response?.status === 401) {
        localStorage.removeItem("token");
        setUser(null);
      }
    }
  };

  const checkAuth = async () => {
    const token = localStorage.getItem("token");
    if (token) {
      await refreshUser();
    }
    setLoading(false);
  };

  useEffect(() => {
    checkAuth();
  }, []);

  useEffect(() => {
    if (!isAuthenticated) return;
    const interval = setInterval(refreshUser, 5 * 60 * 1000);
    return () => clearInterval(interval);
  }, [isAuthenticated]);

  useEffect(() => {
    const handleVisibility = () => {
      if (document.visibilityState === "visible" && localStorage.getItem("token")) {
        refreshUser();
      }
    };
    document.addEventListener("visibilitychange", handleVisibility);
    return () => document.removeEventListener("visibilitychange", handleVisibility);
  }, []);

  const loginManual = async (token, rawUserData) => {
    localStorage.setItem("token", token);
    if (rawUserData) {
      setUser(normalizeUser(rawUserData));
    } else {
      await refreshUser();
    }
  };

  const logout = async () => {
    try {
      await api.post("/logout");
    } catch {
    } finally {
      localStorage.removeItem("token");
      setUser(null);
    }
  };

  return (
    <AuthContext.Provider
      value={{
        user,
        loading,
        isAuthenticated,
        isAdmin,
        isMod,
        loginManual,
        logout,
        refreshUser,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => useContext(AuthContext);
