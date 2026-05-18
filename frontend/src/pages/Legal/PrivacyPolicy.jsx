import React from "react";
import styles from "./Legal.module.css";

export default function PrivacyPolicy() {
  return (
    <div className={styles.wrapper}>
      <div className={styles.container}>
        <h1>Política de Privacidad</h1>
        <p className={styles.updated}>Última actualización: mayo de 2026</p>

        <section>
          <h2>1. Responsable del tratamiento</h2>
          <p>
            <strong>TravelAI</strong> es responsable del tratamiento de los
            datos personales que nos facilitas a través de esta plataforma.
            Puedes contactarnos en{" "}
            <a href="mailto:travelaitfg@gmail.com">travelaitfg@gmail.com</a>.
          </p>
        </section>

        <section>
          <h2>2. Datos que recopilamos</h2>
          <ul>
            <li>
              <strong>Datos de registro:</strong> nombre, dirección de correo
              electrónico y contraseña.
            </li>
            <li>
              <strong>Datos de perfil:</strong> foto de perfil, número de
              teléfono y preferencias de viaje.
            </li>
            <li>
              <strong>Datos de reservas:</strong> información sobre los viajes
              contratados (vuelos, hoteles, actividades, paquetes).
            </li>
            <li>
              <strong>Datos de pago:</strong> gestionados íntegramente por
              Stripe. TravelAI no almacena datos de tarjeta de crédito.
            </li>
            <li>
              <strong>Datos de uso:</strong> historial de búsquedas e
              interacciones con el asistente IA.
            </li>
          </ul>
        </section>

        <section>
          <h2>3. Finalidad del tratamiento</h2>
          <ul>
            <li>Gestionar tu cuenta y ofrecerte los servicios contratados.</li>
            <li>Personalizar las recomendaciones de viaje mediante IA.</li>
            <li>Procesar pagos y emitir confirmaciones de reserva.</li>
            <li>Enviarte comunicaciones relacionadas con tu cuenta.</li>
            <li>Cumplir con nuestras obligaciones legales.</li>
          </ul>
        </section>

        <section>
          <h2>4. Base jurídica</h2>
          <p>
            El tratamiento de tus datos se basa en la ejecución del contrato
            (prestación del servicio), el cumplimiento de obligaciones legales
            y, cuando aplique, tu consentimiento expreso.
          </p>
        </section>

        <section>
          <h2>5. Conservación de datos</h2>
          <p>
            Conservamos tus datos mientras mantengas una cuenta activa en
            TravelAI. Al eliminar tu cuenta, tus datos se borran de forma
            permanente salvo que la ley nos obligue a conservarlos durante un
            período adicional.
          </p>
        </section>

        <section>
          <h2>6. Tus derechos</h2>
          <p>
            Puedes ejercer en cualquier momento los derechos de acceso,
            rectificación, supresión, oposición, limitación del tratamiento y
            portabilidad escribiendo a{" "}
            <a href="mailto:travelaitfg@gmail.com">travelaitfg@gmail.com</a>.
          </p>
        </section>

        <section>
          <h2>7. Transferencias internacionales</h2>
          <p>
            Algunos de nuestros proveedores (Stripe, Google) pueden procesar
            datos fuera del Espacio Económico Europeo bajo garantías adecuadas
            conforme al RGPD.
          </p>
        </section>
      </div>
    </div>
  );
}
