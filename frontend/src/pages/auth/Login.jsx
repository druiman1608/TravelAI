import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { toast } from "react-toastify";
import api from "../../api/axios";
import styles from "./Login.module.css";
import Logo from "../../assets/Logo/BG/TravelAi-logo-circle-nl.webp";
import { GoogleLogin } from "@react-oauth/google";
import { useAuth } from "../../context/AuthContext";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [isSubmitting, setIsSubmitting] = useState(false);
  const navigate = useNavigate();
  const { loginManual } = useAuth();

  const responseGoogle = async (response) => {
    try {
      const res = await api.post("/auth/google", { token: response.credential });
      const { token, user } = res.data.data;
      await loginManual(token, user);
      toast.success("¡Bienvenido con Google!");
      navigate("/");
    } catch {
      toast.error("Fallo al autenticar con Google");
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsSubmitting(true);
    try {
      const response = await api.post("/login", { email, password });
      const { token, user } = response.data.data;
      await loginManual(token, user);
      toast.success(`¡Bienvenido de nuevo, ${user.nombre}!`);
      navigate("/");
    } catch {
      toast.error("Credenciales incorrectas o error en el servidor");
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className={styles.containerBody}>
      <div className={styles.containerMain}>
        <div className={styles.containerLeft}>
          <div className={styles.containerLogo}>
            <img src={Logo} alt="TravelAI-Logo" className={styles.logo} />
          </div>
          <div className={styles.leftText}>
            <h2>¿Aún no eres viajero?</h2>
            <p>
              Únete a nuestra comunidad y deja que nuestra IA planifique tu
              viaje.
            </p>
            <Link to="/register" className={styles.registerLink}>
              Crear una cuenta
            </Link>
          </div>
        </div>

        <div className={styles.containerRight}>
          <form onSubmit={handleSubmit} className={styles.loginForm}>
            <h1 className={styles.formTitle}>Iniciar Sesión</h1>

            <div className={styles.inputGroup}>
              <label htmlFor="email">Correo Electrónico</label>
              <input
                id="email"
                type="email"
                placeholder="tu@email.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
              />
            </div>

            <div className={styles.inputGroup}>
              <label htmlFor="password">Contraseña</label>
              <input
                id="password"
                type="password"
                placeholder="••••••••"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
            </div>

            <div className={styles.containerButtons}>
              <button
                type="submit"
                className={styles.loginButton}
                disabled={isSubmitting}
              >
                {isSubmitting ? "Entrando..." : "Iniciar Sesión"}
              </button>

              <div className={styles.divider}>
                <span>o continúa con</span>
              </div>

              <div className={styles.googleLoginWrapper}>
                <GoogleLogin
                  onSuccess={responseGoogle}
                  onError={() => toast.error("Fallo al iniciar sesión con Google")}
                  useOneTap={false}
                  theme="outline"
                  shape="pill"
                  size="large"
                  width="350px"
                />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
