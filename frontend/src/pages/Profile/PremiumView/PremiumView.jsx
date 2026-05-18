import React, { useState } from "react";
import { useAuth } from "../../../context/AuthContext";
import styles from "./PremiumView.module.css";
import {
  HiCheck,
  HiX,
  HiBadgeCheck,
  HiShieldCheck,
  HiLockClosed,
  HiCheckCircle,
} from "react-icons/hi";
import { loadStripe } from "@stripe/stripe-js";
import {
  Elements,
  CardNumberElement,
  CardExpiryElement,
  CardCvcElement,
  useStripe,
  useElements,
} from "@stripe/react-stripe-js";
import api from "../../../api/axios";
import { toast } from "react-toastify";

const stripePromise = loadStripe(import.meta.env.VITE_STRIPE_KEY);

const PREMIUM_PRICE = 9.99;

const cardElementOptions = {
  style: {
    base: {
      fontSize: "16px",
      color: "#1e293b",
      fontFamily: "'Roboto', sans-serif",
      "::placeholder": { color: "#94a3b8" },
    },
    invalid: { color: "#ef4444" },
  },
};

function PremiumPaymentForm({ onSuccess }) {
  const stripe = useStripe();
  const elements = useElements();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const handlePay = async () => {
    if (!stripe || !elements) return;
    setLoading(true);
    setError(null);

    try {
      const intentRes = await api.post("/payment/intent", { amount: PREMIUM_PRICE });
      const { client_secret } = intentRes.data;

      const cardElement = elements.getElement(CardNumberElement);
      const { error: stripeError, paymentIntent } = await stripe.confirmCardPayment(
        client_secret,
        { payment_method: { card: cardElement } }
      );

      if (stripeError) {
        setError(stripeError.message);
        setLoading(false);
        return;
      }

      if (paymentIntent.status === "succeeded") {
        await api.post("/user/become-premium");
        onSuccess();
      }
    } catch {
      setError("Ha ocurrido un error. Inténtalo de nuevo.");
      setLoading(false);
    }
  };

  return (
    <div className={styles.paymentForm}>
      <div className={styles.payInputGroup}>
        <label>Número de tarjeta</label>
        <div className={styles.cardBox}>
          <CardNumberElement options={cardElementOptions} />
        </div>
      </div>
      <div className={styles.payGrid}>
        <div className={styles.payInputGroup}>
          <label>Caducidad</label>
          <div className={styles.cardBox}>
            <CardExpiryElement options={cardElementOptions} />
          </div>
        </div>
        <div className={styles.payInputGroup}>
          <label>CVC</label>
          <div className={styles.cardBox}>
            <CardCvcElement options={cardElementOptions} />
          </div>
        </div>
      </div>
      <p className={styles.testHint}>
        Tarjeta de prueba: <strong>4242 4242 4242 4242</strong> · fecha futura · cualquier CVC
      </p>
      {error && <div className={styles.payError}>{error}</div>}
      <button className={styles.payBtn} onClick={handlePay} disabled={loading || !stripe}>
        {loading ? (
          <span className={styles.spinner} />
        ) : (
          <>
            <HiLockClosed /> Pagar {PREMIUM_PRICE.toFixed(2)}€/mes
          </>
        )}
      </button>
    </div>
  );
}

function PremiumModal({ onClose, onSuccess }) {
  const [paid, setPaid] = useState(false);
  const { refreshUser } = useAuth();

  const handleSuccess = async () => {
    await refreshUser();
    setPaid(true);
    toast.success("¡Bienvenido a Premium! Disfruta de todas las ventajas.");
  };

  if (paid) {
    return (
      <div className={styles.modalOverlay}>
        <div className={styles.modalBox}>
          <div className={styles.successState}>
            <HiCheckCircle className={styles.successIcon} />
            <h2>¡Ya eres Premium!</h2>
            <p>Disfruta de todas las ventajas de la suscripción.</p>
            <button className={styles.successBtn} onClick={onClose}>
              Continuar
            </button>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className={styles.modalOverlay} onClick={onClose}>
      <div className={styles.modalBox} onClick={(e) => e.stopPropagation()}>
        <div className={styles.modalHeader}>
          <div>
            <h2>Suscripción Premium</h2>
            <p>
              Total: <strong>{PREMIUM_PRICE.toFixed(2)}€/mes</strong>
            </p>
          </div>
          <button className={styles.closeBtn} onClick={onClose}>
            <HiX />
          </button>
        </div>

        <Elements stripe={stripePromise}>
          <PremiumPaymentForm onSuccess={handleSuccess} />
        </Elements>

        <div className={styles.modalSecure}>
          <HiShieldCheck /> Pago procesado de forma segura por Stripe
        </div>
      </div>
    </div>
  );
}

export default function PremiumView() {
  const { user } = useAuth();
  const [showModal, setShowModal] = useState(false);

  return (
    <div className={styles.viewWrapper}>
      <header className={styles.header}>
        <h2>Suscripción Premium</h2>
        <p>Lleva tus viajes al siguiente nivel con IA.</p>
      </header>

      <div className={styles.premiumGrid}>
        <div className={styles.leftColumn}>
          <div className={styles.promoCard}>
            <HiBadgeCheck className={styles.promoIcon} />
            <h3>Ventajas Exclusivas</h3>
            <p>
              Recomendaciones ilimitadas generadas por nuestra IA avanzada,
              soporte 24/7, descuentos en reservas y acceso anticipado a
              ofertas, cambios y cancelaciones.
            </p>
          </div>

          <div className={styles.comparisonTable}>
            <div className={styles.tableHeader}>
              <span>Beneficio</span>
              <span>Gratis</span>
              <span className={styles.premiumCol}>Premium</span>
            </div>
            <div className={styles.tableRow}>
              <span>IA de Itinerarios</span>
              <span>Limitada</span>
              <span className={styles.premiumCol}>Ilimitada</span>
            </div>
            <div className={styles.tableRow}>
              <span>Soporte Prioritario</span>
              <span>
                <HiX className={styles.red} />
              </span>
              <span className={styles.premiumCol}>
                <HiCheck className={styles.green} />
              </span>
            </div>
            <div className={styles.tableRow}>
              <span>Descuentos en reservas</span>
              <span>
                <HiX className={styles.red} />
              </span>
              <span className={styles.premiumCol}>
                <HiCheck className={styles.green} />
              </span>
            </div>
          </div>
        </div>

        <div className={styles.pricingCard}>
          <div className={styles.goldBadge}>PLAN RECOMENDADO</div>
          <div className={styles.priceContainer}>
            <span className={styles.amount}>9.99€</span>
            <span className={styles.period}>/mes</span>
          </div>
          <ul className={styles.benefitsList}>
            <li>
              <HiCheck /> IA Generativa sin límites
            </li>
            <li>
              <HiCheck /> Descuentos en reservas
            </li>
            <li>
              <HiCheck /> Acceso anticipado a ofertas
            </li>
            <li>
              <HiCheck /> Cancela cuando quieras
            </li>
            <li>
              <HiCheck /> Soporte 24/7
            </li>
          </ul>
          {user?.is_premium ? (
            <div className={styles.alreadyPremium}>
              <HiBadgeCheck /> Ya eres Premium
            </div>
          ) : (
            <button className={styles.upgradeBtn} onClick={() => setShowModal(true)}>
              Mejorar ahora
            </button>
          )}
          <p className={styles.secureNote}>Pago seguro vía Stripe</p>
        </div>
      </div>

      {showModal && (
        <PremiumModal onClose={() => setShowModal(false)} />
      )}
    </div>
  );
}
