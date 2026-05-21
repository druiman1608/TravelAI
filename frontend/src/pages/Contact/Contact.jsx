import React, { useState } from "react";
import { toast } from "react-toastify";
import {
  HiMail,
  HiPhone,
  HiLocationMarker,
  HiPaperAirplane,
} from "react-icons/hi";
import styles from "./Contact.module.css";

export default function Contact() {
  const [form, setForm] = useState({
    name: "",
    email: "",
    subject: "",
    message: "",
  });
  const [sending, setSending] = useState(false);

  const handleChange = (e) =>
    setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!form.name.trim()) return toast.error("El nombre es obligatorio.");
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) return toast.error("El email no tiene un formato válido.");
    if (!form.message.trim()) return toast.error("El mensaje no puede estar vacío.");
    setSending(true);
    await new Promise((r) => setTimeout(r, 800));
    toast.success("Mensaje enviado. Te responderemos en menos de 48 horas.");
    setForm({ name: "", email: "", subject: "", message: "" });
    setSending(false);
  };

  return (
    <div className={styles.wrapper}>
      <div className={styles.hero}>
        <h1>Contáctanos</h1>
        <p>Estamos aquí para ayudarte a planificar tu próxima aventura.</p>
      </div>

      <div className={styles.container}>
        <div className={styles.infoColumn}>
          <h2>Información de contacto</h2>
          <div className={styles.infoItem}>
            <HiMail className={styles.infoIcon} />
            <div>
              <strong>Email</strong>
              <a href="travelaitfg@gmail.com">travelaitfg@gmail.com</a>
            </div>
          </div>
          <div className={styles.infoItem}>
            <HiPhone className={styles.infoIcon} />
            <div>
              <strong>Teléfono</strong>
              <span>+34 600 000 000</span>
            </div>
          </div>
          <div className={styles.infoItem}>
            <HiLocationMarker className={styles.infoIcon} />
            <div>
              <strong>Horario de atención</strong>
              <span>Lunes a viernes · 9:00 – 18:00</span>
            </div>
          </div>

          <div className={styles.faqBlock}>
            <h3>Preguntas frecuentes</h3>
            <details className={styles.faqItem}>
              <summary>¿Cómo cancelo una reserva?</summary>
              <p>
                Accede a tu perfil → Mis Reservas y selecciona la reserva que
                deseas cancelar. Si tienes algún problema, escríbenos.
              </p>
            </details>
            <details className={styles.faqItem}>
              <summary>¿Qué incluye el plan Premium?</summary>
              <p>
                El plan Premium incluye recomendaciones ilimitadas de IA,
                soporte prioritario, descuentos en reservas y acceso anticipado
                a ofertas.
              </p>
            </details>
            <details className={styles.faqItem}>
              <summary>¿Es seguro pagar en TravelAI?</summary>
              <p>
                Sí. Todos los pagos se procesan de forma segura a través de
                Stripe, que cumple con el estándar PCI-DSS nivel 1.
              </p>
            </details>
          </div>
        </div>

        <div className={styles.formColumn}>
          <h2>Envíanos un mensaje</h2>
          <form className={styles.form} onSubmit={handleSubmit}>
            <div className={styles.formGrid}>
              <div className={styles.inputGroup}>
                <label>Nombre *</label>
                <input
                  type="text"
                  name="name"
                  value={form.name}
                  onChange={handleChange}
                  placeholder="Tu nombre"
                  required
                />
              </div>
              <div className={styles.inputGroup}>
                <label>Email *</label>
                <input
                  type="email"
                  name="email"
                  value={form.email}
                  onChange={handleChange}
                  placeholder="tu@email.com"
                  required
                />
              </div>
            </div>
            <div className={styles.inputGroup}>
              <label>Asunto</label>
              <input
                type="text"
                name="subject"
                value={form.subject}
                onChange={handleChange}
                placeholder="¿En qué podemos ayudarte?"
              />
            </div>
            <div className={styles.inputGroup}>
              <label>Mensaje *</label>
              <textarea
                name="message"
                value={form.message}
                onChange={handleChange}
                placeholder="Cuéntanos tu consulta..."
                rows={6}
                required
              />
            </div>
            <button
              type="submit"
              className={styles.submitBtn}
              disabled={sending}
            >
              {sending ? (
                "Enviando..."
              ) : (
                <>
                  <HiPaperAirplane /> Enviar mensaje
                </>
              )}
            </button>
          </form>
        </div>
      </div>
    </div>
  );
}
