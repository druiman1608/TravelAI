import React, { useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import styles from "./Checkout.module.css";
import {
  HiUser,
  HiUsers,
  HiCalendar,
  HiShieldCheck,
  HiPlusCircle,
  HiArrowRight,
  HiOutlineTicket,
  HiX,
  HiCheckCircle,
  HiLockClosed,
} from "react-icons/hi";
import { LiaHotelSolid } from "react-icons/lia";
import { SlPlane } from "react-icons/sl";
import { MdOutlineLocalActivity } from "react-icons/md";
import { RiSuitcase2Line } from "react-icons/ri";
import { PassengerCard } from "../../components/PassengerForm/PassengerForm";
import { useCheckout } from "../../hooks/Checkout/useCheckout";
import { useAuth } from "../../context/AuthContext";

import { loadStripe } from "@stripe/stripe-js";
import {
  Elements,
  CardNumberElement,
  CardExpiryElement,
  CardCvcElement,
  useStripe,
  useElements,
} from "@stripe/react-stripe-js";
import api from "../../api/axios";
import { toast } from "react-toastify";

const stripePromise = loadStripe(import.meta.env.VITE_STRIPE_KEY);


function ContactSection({ contacto, setContacto }) {
  const update = (field) => (e) =>
    setContacto({ ...contacto, [field]: e.target.value });
  return (
    <section className={styles.card}>
      <div className={styles.cardHeader}>
        <HiUser className={styles.headerIcon} />
        <h2>Información del Titular</h2>
      </div>
      <div className={styles.formGrid}>
        <div className={styles.inputWrapper}>
          <label>Nombre y Apellidos</label>
          <input
            type="text"
            placeholder="Como aparece en el DNI"
            value={contacto.name || ""}
            onChange={update("name")}
          />
        </div>
        <div className={styles.inputWrapper}>
          <label>DNI / Pasaporte</label>
          <input
            type="text"
            placeholder="Documento de identidad"
            value={contacto.dni || ""}
            onChange={update("dni")}
          />
        </div>
        <div className={styles.inputWrapper}>
          <label>Email de contacto</label>
          <input
            type="email"
            placeholder="tu@email.com"
            value={contacto.email || ""}
            onChange={update("email")}
          />
        </div>
        <div className={styles.inputWrapper}>
          <label>Teléfono</label>
          <input
            type="tel"
            placeholder="600 000 000"
            value={contacto.phone || ""}
            onChange={(e) => {
              const val = e.target.value.replace(/[^\d\s+\-()]/g, "");
              setContacto({ ...contacto, phone: val });
            }}
          />
        </div>
      </div>
    </section>
  );
}

function DatesSection({
  hotel,
  fechaEntrada,
  setFechaEntrada,
  fechaSalida,
  setFechaSalida,
  noches,
}) {
  return (
    <section className={styles.card}>
      <div className={styles.cardHeader}>
        <HiCalendar className={styles.headerIcon} />
        <h2>Fechas de estancia en {hotel.nombre}</h2>
      </div>
      <div className={styles.formGrid}>
        <div className={styles.inputWrapper}>
          <label>Fecha de entrada</label>
          <input
            type="date"
            value={fechaEntrada}
            onChange={(e) => setFechaEntrada(e.target.value)}
          />
        </div>
        <div className={styles.inputWrapper}>
          <label>Fecha de salida</label>
          <input
            type="date"
            value={fechaSalida}
            min={fechaEntrada}
            onChange={(e) => setFechaSalida(e.target.value)}
          />
        </div>
      </div>
      <div className={styles.nightsBadge}>
        Calculado:{" "}
        <strong>
          {noches} {noches === 1 ? "noche" : "noches"}
        </strong>
      </div>
    </section>
  );
}

function ExtrasSection({ extrasCategorizados, selExtras, toggleExtra }) {
  const categorias = [
    {
      id: "vuelo",
      titulo: "Extras de Vuelo",
      data: extrasCategorizados?.vuelo || [],
    },
    {
      id: "hotel",
      titulo: "Extras de Hotel",
      data: extrasCategorizados?.hotel || [],
    },
    {
      id: "actividad",
      titulo: "Extras de Actividad",
      data: extrasCategorizados?.actividad || [],
    },
  ].filter((cat) => cat.data.length > 0);

  if (categorias.length === 0) return null;

  return (
    <section className={styles.card}>
      <div className={styles.cardHeader}>
        <HiPlusCircle className={styles.headerIcon} />
        <h2>Personaliza tu viaje</h2>
      </div>
      <div className={styles.categoryGrid}>
        {categorias.map((cat) => (
          <div key={cat.id} className={styles.categoryColumn}>
            <h3 className={styles.categoryTitle}>{cat.titulo}</h3>
            {cat.data.map((extra, i) => (
              <label
                key={i}
                className={`${styles.extraLabel} ${
                  selExtras.some((s) => s.nombre === extra.nombre)
                    ? styles.activeExtra
                    : ""
                }`}
              >
                <input
                  type="checkbox"
                  checked={selExtras.some((s) => s.nombre === extra.nombre)}
                  onChange={() => toggleExtra(extra)}
                  hidden
                />
                <div className={styles.extraInfo}>
                  <span className={styles.extraName}>{extra.nombre}</span>
                  <strong className={styles.extraPrice}>
                    +{extra.precio}€
                  </strong>
                </div>
              </label>
            ))}
          </div>
        ))}
      </div>
    </section>
  );
}

function PassengersSection({
  numAcompañantes,
  setNumAcompañantes,
  updateAcompañante,
}) {
  return (
    <section className={styles.card}>
      <div className={styles.cardHeader}>
        <HiUsers className={styles.headerIcon} />
        <h2>¿Quiénes viajan contigo?</h2>
      </div>
      <div className={styles.paxSelectorWrapper}>
        <label>Cantidad de acompañantes</label>
        <div className={styles.paxButtons}>
          {[0, 1, 2, 3].map((n) => (
            <button
              key={n}
              type="button"
              className={
                numAcompañantes === n ? styles.paxBtnActive : styles.paxBtn
              }
              onClick={() => setNumAcompañantes(n)}
            >
              {n === 0 ? "Solo yo" : `${n} Acomp.`}
            </button>
          ))}
        </div>
      </div>
      <div className={styles.passengersList}>
        {[...Array(numAcompañantes)].map((_, i) => (
          <PassengerCard key={i} index={i} onChange={updateAcompañante} />
        ))}
      </div>
    </section>
  );
}


function PaymentForm({ totalFinal, reservationData, onSuccess }) {
  const stripe = useStripe();
  const elements = useElements();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const handlePay = async () => {
    if (!stripe || !elements) return;
    setLoading(true);
    setError(null);

    try {
      const intentRes = await api.post("/payment/intent", {
        amount: totalFinal,
      });
      const { client_secret } = intentRes.data;

      const cardElement = elements.getElement(CardNumberElement);
      const { error: stripeError, paymentIntent } =
        await stripe.confirmCardPayment(client_secret, {
          payment_method: { card: cardElement },
        });

      if (stripeError) {
        setError(stripeError.message);
        setLoading(false);
        return;
      }

      if (paymentIntent.status === "succeeded") {
        await api.post("/payment/confirm-reservation", reservationData);
        onSuccess();
      }
    } catch (err) {
      setError("Ha ocurrido un error. Inténtalo de nuevo.");
      setLoading(false);
    }
  };

  const cardElementOptions = {
    style: {
      base: {
        fontSize: "16px",
        color: "#1e293b",
        fontFamily: "'Segoe UI', sans-serif",
        "::placeholder": { color: "#94a3b8" },
      },
      invalid: { color: "#ef4444" },
    },
  };

  return (
    <div className={styles.paymentForm}>
      <div className={styles.inputWrapper}>
        <label className={styles.cardLabel}>Número de tarjeta</label>
        <div className={styles.cardElementBox}>
          <CardNumberElement options={cardElementOptions} />
        </div>
      </div>

      <div className={styles.formGrid}>
        <div className={styles.inputWrapper}>
          <label className={styles.cardLabel}>Caducidad</label>
          <div className={styles.cardElementBox}>
            <CardExpiryElement options={cardElementOptions} />
          </div>
        </div>
        <div className={styles.inputWrapper}>
          <label className={styles.cardLabel}>CVC</label>
          <div className={styles.cardElementBox}>
            <CardCvcElement options={cardElementOptions} />
          </div>
        </div>
      </div>

      <p className={styles.cardHint}>
        Tarjeta de prueba: <strong>4242 4242 4242 4242</strong> · cualquier
        fecha futura · cualquier CVC
      </p>

      {error && <div className={styles.paymentError}>{error}</div>}

      <button
        className={styles.payButton}
        onClick={handlePay}
        disabled={loading || !stripe}
      >
        {loading ? (
          <span className={styles.spinner} />
        ) : (
          <>
            <HiLockClosed /> Pagar {Number(totalFinal).toFixed(2)}€
          </>
        )}
      </button>
    </div>
  );
}


function PaymentModal({ totalFinal, reservationData, onClose }) {
  const [paid, setPaid] = useState(false);
  const navigate = useNavigate();

  if (paid) {
    return (
      <div className={styles.modalOverlay}>
        <div className={styles.modalBox}>
          <div className={styles.successState}>
            <HiCheckCircle className={styles.successIcon} />
            <h2>¡Reserva confirmada!</h2>
            <p>
              Recibirás un email de confirmación en{" "}
              <strong>{reservationData.contact_email}</strong>
            </p>
            <button className={styles.successBtn} onClick={() => navigate("/")}>
              Volver al inicio
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
            <h2>Pago seguro</h2>
            <p>
              Total: <strong>{Number(totalFinal).toFixed(2)}€</strong>
            </p>
          </div>
          <button className={styles.closeBtn} onClick={onClose}>
            <HiX />
          </button>
        </div>

        <Elements stripe={stripePromise}>
          <PaymentForm
            totalFinal={totalFinal}
            reservationData={reservationData}
            onSuccess={() => setPaid(true)}
            onClose={onClose}
          />
        </Elements>

        <div className={styles.modalSecure}>
          <HiShieldCheck /> Pago procesado de forma segura por Stripe
        </div>
      </div>
    </div>
  );
}


function Sidebar({
  state,
  numAcompañantes,
  noches,
  flight,
  hotel,
  activity,
  pkg,
  selExtras,
  totalFinal = 0,
  totalSinDescuento = 0,
  descuento = 0,
  isPremium = false,
  onPagar,
}) {
  return (
    <aside className={styles.sidebar}>
      <div className={styles.premiumSummary}>
        <div className={styles.summaryTop}>
          <h3>Tu Viaje</h3>
          <div className={styles.badgeTrip}>
            {state.type === "pkg" ? "Paquete Premium" : "Servicio Individual"}
          </div>
        </div>

        <div className={styles.summaryServices}>
          {pkg && (
            <div className={styles.serviceRow}>
              <RiSuitcase2Line className={styles.serviceIcon} />
              <div>
                <span className={styles.serviceLabel}>Paquete</span>
                <strong className={styles.serviceName}>{pkg.nombre}</strong>
              </div>
            </div>
          )}
          {hotel && (
            <div className={styles.serviceRow}>
              <LiaHotelSolid className={styles.serviceIcon} />
              <div>
                <span className={styles.serviceLabel}>Hotel · {noches} {noches === 1 ? "noche" : "noches"}</span>
                <strong className={styles.serviceName}>{hotel.nombre}</strong>
              </div>
            </div>
          )}
          {flight && (
            <div className={styles.serviceRow}>
              <SlPlane className={styles.serviceIcon} />
              <div>
                <span className={styles.serviceLabel}>Vuelo · {flight.ida?.aerolinea}</span>
                <strong className={styles.serviceName}>{flight.ida?.origen} → {flight.ida?.destino}</strong>
              </div>
            </div>
          )}
          {activity && (
            <div className={styles.serviceRow}>
              <MdOutlineLocalActivity className={styles.serviceIcon} />
              <div>
                <span className={styles.serviceLabel}>Actividad</span>
                <strong className={styles.serviceName}>{activity.nombre}</strong>
              </div>
            </div>
          )}
        </div>

        <div className={styles.summaryDetails}>
          <div className={styles.sumRow}>
            <span>Viajeros</span>
            <strong>{numAcompañantes + 1}</strong>
          </div>
        </div>

        {selExtras.length > 0 && (
          <div className={styles.sumExtras}>
            <p>Extras seleccionados:</p>
            {selExtras.map((e, i) => (
              <div key={i} className={styles.sumExtraItem}>
                <span>{e.nombre}</span>
                <span>+{e.precio}€</span>
              </div>
            ))}
          </div>
        )}

        {isPremium && descuento > 0 && (
          <div className={styles.premiumDiscount}>
            <div className={styles.discountRow}>
              <span>Subtotal</span>
              <span>{Number(totalSinDescuento).toFixed(2)}€</span>
            </div>
            <div className={styles.discountRow}>
              <span>Descuento Premium (10%)</span>
              <span className={styles.discountAmount}>-{Number(descuento).toFixed(2)}€</span>
            </div>
          </div>
        )}
        <div className={styles.sumTotal}>
          <div className={styles.totalLabel}>Total a pagar</div>
          <div className={styles.totalValue}>
            {Number(totalFinal).toFixed(2)}€
          </div>
          <small>IVA e impuestos incluidos</small>
        </div>

        <button className={styles.confirmButton} onClick={onPagar}>
          Pagar ahora <HiArrowRight />
        </button>
        <div className={styles.secureBadge}>
          <HiShieldCheck /> Pago 100% Seguro
        </div>
      </div>
    </aside>
  );
}


export default function Checkout() {
  const { state } = useLocation();
  const { user } = useAuth();
  const checkout = useCheckout(state, user?.is_premium);
  const [showModal, setShowModal] = useState(false);

  if (!state)
    return <div className={styles.error}>No se seleccionó viaje.</div>;

  const destino =
    checkout.pkg?.destino ||
    checkout.flight?.ida?.destino ||
    checkout.hotel?.ubicacion_nombre ||
    "tu destino";

  const reservationData = {
    user_id: user?.id ?? null,
    package_id: checkout.pkg?.id ?? null,
    hotel_id: checkout.hotel?.id ?? null,
    hotel_room_id: state?.room?.id ?? null,
    flight_id: checkout.flight?.id ?? checkout.flight?.ida?.id ?? null,
    activity_id: checkout.activity?.id ?? null,
    total_price: checkout.stats?.totalFinal || 0,
    contact_email: checkout.contacto.email,
    contact_phone: checkout.contacto.phone,
    contact_name: checkout.contacto.name,
    contact_dni: checkout.contacto.dni,
    passengers_data: checkout.acompañantes ?? [],
    extras: checkout.selExtras,
  };

  const handlePagar = () => {
    if (!checkout.contacto.email || !checkout.contacto.name) {
      toast.warn("Por favor, rellena al menos tu nombre y email de contacto.");
      return;
    }
    setShowModal(true);
  };

  return (
    <div className={styles.page}>
      <div className={styles.container}>
        <main className={styles.content}>
          <header className={styles.mainHeader}>
            <h1>Finalizar Reserva</h1>
            <p>Estás a un paso de tu aventura en {destino}</p>
          </header>

          <ContactSection
            contacto={checkout.contacto}
            setContacto={checkout.setContacto}
          />

          {checkout.hotel && (
            <DatesSection
              hotel={checkout.hotel}
              fechaEntrada={checkout.fechaEntrada}
              setFechaEntrada={checkout.setFechaEntrada}
              fechaSalida={checkout.fechaSalida}
              setFechaSalida={checkout.setFechaSalida}
              noches={checkout.noches}
            />
          )}

          <ExtrasSection
            extrasCategorizados={checkout.data?.extrasCategorizados}
            selExtras={checkout.selExtras}
            toggleExtra={checkout.toggleExtra}
          />

          <PassengersSection
            numAcompañantes={checkout.numAcompañantes}
            setNumAcompañantes={checkout.setNumAcompañantes}
            updateAcompañante={checkout.updateAcompañante}
          />
        </main>

        <Sidebar
          state={state}
          numAcompañantes={checkout.numAcompañantes}
          noches={checkout.noches}
          flight={checkout.flight}
          hotel={checkout.hotel}
          activity={checkout.activity}
          pkg={checkout.pkg}
          selExtras={checkout.selExtras}
          totalFinal={checkout.stats?.totalFinal || 0}
          totalSinDescuento={checkout.stats?.totalSinDescuento || 0}
          descuento={checkout.stats?.descuento || 0}
          isPremium={user?.is_premium}
          onPagar={handlePagar}
        />
      </div>

      {showModal && (
        <PaymentModal
          totalFinal={checkout.stats?.totalFinal || 0}
          reservationData={reservationData}
          onClose={() => setShowModal(false)}
        />
      )}
    </div>
  );
}
