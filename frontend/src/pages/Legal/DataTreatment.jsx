import React from "react";
import styles from "./Legal.module.css";

export default function DataTreatment() {
  return (
    <div className={styles.wrapper}>
      <div className={styles.container}>
        <h1>Tratamiento de Datos</h1>
        <p className={styles.updated}>Última actualización: mayo de 2026</p>

        <section>
          <h2>Responsable del tratamiento</h2>
          <table className={styles.infoTable}>
            <tbody>
              <tr>
                <th>Denominación</th>
                <td>TravelAI</td>
              </tr>
              <tr>
                <th>Email de contacto</th>
                <td>
                  <a href="mailto:travelaitfg@gmail.com">
                    travelaitfg@gmail.com
                  </a>
                </td>
              </tr>
              <tr>
                <th>Normativa aplicable</th>
                <td>RGPD (UE) 2016/679 · LOPDGDD (España)</td>
              </tr>
            </tbody>
          </table>
        </section>

        <section>
          <h2>Registro de actividades de tratamiento</h2>
          <div className={styles.treatmentCard}>
            <h3>Gestión de usuarios</h3>
            <p>
              <strong>Finalidad:</strong> Crear y gestionar cuentas de usuario.
            </p>
            <p>
              <strong>Base legal:</strong> Ejecución de contrato.
            </p>
            <p>
              <strong>Datos:</strong> Nombre, email, contraseña (hash),
              teléfono, foto de perfil.
            </p>
            <p>
              <strong>Conservación:</strong> Mientras la cuenta esté activa + 30
              días tras eliminación.
            </p>
          </div>
          <div className={styles.treatmentCard}>
            <h3>Reservas y pagos</h3>
            <p>
              <strong>Finalidad:</strong> Procesar y confirmar reservas de
              viajes.
            </p>
            <p>
              <strong>Base legal:</strong> Ejecución de contrato.
            </p>
            <p>
              <strong>Datos:</strong> Nombre, DNI, email, teléfono, datos de
              acompañantes.
            </p>
            <p>
              <strong>Conservación:</strong> 5 años (obligación fiscal).
            </p>
          </div>
          <div className={styles.treatmentCard}>
            <h3>Asistente de IA</h3>
            <p>
              <strong>Finalidad:</strong> Ofrecer recomendaciones personalizadas
              de viaje.
            </p>
            <p>
              <strong>Base legal:</strong> Consentimiento del usuario.
            </p>
            <p>
              <strong>Datos:</strong> Historial de conversaciones con la IA,
              preferencias de viaje.
            </p>
            <p>
              <strong>Conservación:</strong> 6 meses desde la última
              interacción.
            </p>
          </div>
        </section>

        <section>
          <h2>Destinatarios</h2>
          <ul>
            <li>
              <strong>Stripe Inc.</strong> — procesamiento de pagos (UE/EE.UU.
              bajo cláusulas contractuales tipo).
            </li>
            <li>
              <strong>Google LLC</strong> — autenticación OAuth y servicios de
              fuente tipográfica.
            </li>
            <li>
              <strong>Anthropic PBC</strong> — proveedor del modelo de IA
              generativa.
            </li>
          </ul>
        </section>

        <section>
          <h2>Ejercicio de derechos</h2>
          <p>
            Puedes solicitar acceso, rectificación, supresión, oposición,
            limitación del tratamiento o portabilidad de tus datos escribiendo a{" "}
            <a href="mailto:travelaitfg@gmail.com">travelaitfg@gmail.com</a>.
            Tienes también derecho a presentar reclamación ante la Agencia
            Española de Protección de Datos (
            <a
              href="https://www.aepd.es"
              target="_blank"
              rel="noopener noreferrer"
            >
              www.aepd.es
            </a>
            ).
          </p>
        </section>
      </div>
    </div>
  );
}
