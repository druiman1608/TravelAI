import React from "react";
import styles from "./Legal.module.css";

export default function CookiePolicy() {
  return (
    <div className={styles.wrapper}>
      <div className={styles.container}>
        <h1>Política de Cookies</h1>
        <p className={styles.updated}>Última actualización: mayo de 2026</p>

        <section>
          <h2>¿Qué son las cookies?</h2>
          <p>
            Las cookies son pequeños archivos de texto que los sitios web
            almacenan en tu dispositivo para recordar información sobre tu
            visita.
          </p>
        </section>

        <section>
          <h2>Cookies que utilizamos</h2>
          <div className={styles.cookieTable}>
            <div className={styles.cookieRow + " " + styles.cookieHeader}>
              <span>Nombre</span>
              <span>Tipo</span>
              <span>Finalidad</span>
              <span>Duración</span>
            </div>
            <div className={styles.cookieRow}>
              <span>
                <code>auth_token</code>
              </span>
              <span>Técnica</span>
              <span>Mantener la sesión iniciada</span>
              <span>Sesión / 30 días</span>
            </div>
            <div className={styles.cookieRow}>
              <span>
                <code>_ga</code>
              </span>
              <span>Analítica</span>
              <span>Google Analytics — estadísticas de uso anónimas</span>
              <span>2 años</span>
            </div>
            <div className={styles.cookieRow}>
              <span>
                <code>stripe_*</code>
              </span>
              <span>Funcional</span>
              <span>Procesamiento seguro de pagos (Stripe)</span>
              <span>Sesión</span>
            </div>
            <div className={styles.cookieRow}>
              <span>
                <code>g_state</code>
              </span>
              <span>Funcional</span>
              <span>Google OAuth — inicio de sesión con Google</span>
              <span>Sesión</span>
            </div>
          </div>
        </section>

        <section>
          <h2>Cookies técnicas (necesarias)</h2>
          <p>
            Son imprescindibles para el funcionamiento básico de la plataforma y
            no se pueden desactivar. No almacenan información personal
            identificable.
          </p>
        </section>

        <section>
          <h2>Cómo desactivar las cookies</h2>
          <p>
            Puedes configurar tu navegador para rechazar o eliminar cookies en
            cualquier momento. Ten en cuenta que deshabilitar ciertas cookies
            puede afectar a la funcionalidad de TravelAI.
          </p>
          <ul>
            <li>
              <strong>Chrome:</strong> Configuración → Privacidad y seguridad →
              Cookies
            </li>
            <li>
              <strong>Firefox:</strong> Opciones → Privacidad y seguridad →
              Cookies
            </li>
            <li>
              <strong>Safari:</strong> Preferencias → Privacidad → Cookies
            </li>
            <li>
              <strong>Edge:</strong> Configuración → Privacidad, búsqueda y
              servicios → Cookies
            </li>
          </ul>
        </section>

        <section>
          <h2>Contacto</h2>
          <p>
            Para cualquier consulta sobre nuestra política de cookies,
            escríbenos a{" "}
            <a href="mailto:travelaitfg@gmail.com">travelaitfg@gmail.com</a>.
          </p>
        </section>
      </div>
    </div>
  );
}
