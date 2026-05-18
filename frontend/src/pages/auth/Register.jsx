import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { toast } from "react-toastify";
import api from "../../api/axios";
import styles from "./Register.module.css";
import Logo from "../../assets/Logo/BG/TravelAi-logo-circle-nl.webp";
import { GoogleLogin } from "@react-oauth/google";
import { useAuth } from "../../context/AuthContext";

export default function Register() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    phone_number: "No definido",
  });
  const [isSubmitting, setIsSubmitting] = useState(false);
  const navigate = useNavigate();
  const { loginManual } = useAuth();

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const responseGoogle = async (response) => {
    try {
      const res = await api.post("/auth/google", { token: response.credential });
      const { token, user } = res.data.data;
      await loginManual(token, user);
      toast.success("¡Bienvenido! Registro completado con Google.");
      navigate("/");
    } catch {
      toast.error("Error al registrarse con Google.");
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (formData.password !== formData.password_confirmation) {
      return toast.error("Las contraseñas no coinciden");
    }
    setIsSubmitting(true);
    try {
      const res = await api.post("/register", formData);
      const { token, user } = res.data.data;
      await loginManual(token, user);
      toast.success("Cuenta creada con éxito");
      navigate("/");
    } catch (error) {
      toast.error(error.response?.data?.message || "Error al registrarse");
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className={styles.containerBody}>
      <div className={styles.containerMain}>
        <div className={styles.containerLeft}>
          <div className={styles.containerLogo}>
            <img src={Logo} alt="TravelAi Logo" className={styles.logo} />
          </div>
          <div className={styles.leftText}>
            <h2>¿Ya tienes cuenta?</h2>
            <p>Inicia sesión para seguir planificando tus aventuras.</p>
            <Link to="/login" className={styles.loginLink}>
              Iniciar Sesión
            </Link>
          </div>
        </div>

        <div className={styles.containerRight}>
          <form onSubmit={handleSubmit} className={styles.registerForm}>
            <h1 className={styles.formTitle}>Crea tu cuenta</h1>

            <div className={styles.inputGroup}>
              <label>Nombre Completo</label>
              <input
                name="name"
                type="text"
                placeholder="Nombre..."
                required
                onChange={handleChange}
              />
            </div>

            <div className={styles.inputGroup}>
              <label>Email</label>
              <input
                name="email"
                type="email"
                placeholder="tu@email.com"
                required
                onChange={handleChange}
              />
            </div>

            <div className={styles.inputGroup}>
              <label>Contraseña</label>
              <input
                name="password"
                type="password"
                placeholder="••••••••"
                required
                onChange={handleChange}
              />
            </div>

            <div className={styles.inputGroup}>
              <label>Confirmar Contraseña</label>
              <input
                name="password_confirmation"
                type="password"
                placeholder="••••••••"
                required
                onChange={handleChange}
              />
            </div>

            <div className={styles.containerButtons}>
              <button
                type="submit"
                className={styles.registerButton}
                disabled={isSubmitting}
              >
                {isSubmitting ? "Registrando..." : "Registrarse"}
              </button>

              <div className={styles.divider}>
                <span>o regístrate con</span>
              </div>

              <div className={styles.googleLoginWrapper}>
                <GoogleLogin
                  onSuccess={responseGoogle}
                  onError={() => toast.error("Error en Google Auth")}
                  useOneTap={false}
                  theme="outline"
                  shape="pill"
                  size="large"
                  width="350px"
                  text="signup_with"
                />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
