import React, { useState, useEffect, useRef } from "react";
import { useLocation, useNavigate, Link } from "react-router-dom";
import { useAuth } from "../../context/AuthContext";
import api from "../../api/axios";
import styles from "./Ai.module.css";
import {
  HiPaperAirplane,
  HiBadgeCheck,
  HiLockClosed,
  HiMap,
} from "react-icons/hi";
import { IoSparkles } from "react-icons/io5";

const FREE_LIMIT = 10;

const BOOKING_KEYWORDS = [
  "reservar", "reservamelo", "quiero reservar", "hazme la reserva",
  "reserva el viaje", "reserva esto", "me gusta, resérvalo",
];

function isBookingIntent(text) {
  const lower = text.toLowerCase();
  return BOOKING_KEYWORDS.some((kw) => lower.includes(kw));
}

function ChatMessage({ msg, isPremium, onPlannerClick }) {
  const showPlannerBtn = msg.role === "ai" && isPremium && msg.bookingData;

  return (
    <div className={`${styles.msgRow} ${msg.role === "user" ? styles.msgUser : styles.msgAi}`}>
      {msg.role === "ai" && (
        <div className={styles.aiAvatar}>
          <IoSparkles />
        </div>
      )}
      <div className={styles.msgBubble}>
        <p className={styles.msgText}>{msg.text}</p>
        {showPlannerBtn && (
          <button className={styles.plannerBtn} onClick={() => onPlannerClick(msg.bookingData)}>
            <HiMap /> Planificar este viaje
          </button>
        )}
      </div>
    </div>
  );
}

export default function Ai() {
  const { user, loading: authLoading } = useAuth();
  const location = useLocation();
  const navigate = useNavigate();
  const messagesEndRef = useRef(null);
  const messagesAreaRef = useRef(null);
  const inputRef = useRef(null);

  const [messages, setMessages] = useState([]);
  const [input, setInput] = useState("");
  const [sending, setSending] = useState(false);
  const [msgCount, setMsgCount] = useState(0);
  const [historyLoaded, setHistoryLoaded] = useState(false);
  const [limitError, setLimitError] = useState(false);

  const isPremium = user?.is_premium === true;
  const remaining = FREE_LIMIT - msgCount;

  useEffect(() => {
    if (!user || historyLoaded) return;

    const loadHistory = async () => {
      try {
        const res = await api.get("/chatlogs");
        const logs = res.data.data || [];
        setMsgCount(logs.length);

        const mapped = logs
          .slice()
          .reverse()
          .flatMap((log) => [
            { role: "user", text: log.pregunta },
            { role: "ai", text: log.respuesta_ia },
          ]);

        setMessages(mapped);
      } catch {
        setMessages([]);
      } finally {
        setHistoryLoaded(true);
      }
    };

    loadHistory();
  }, [user, historyLoaded]);

  useEffect(() => {
    const initialQuery = location.state?.initialQuery;
    if (initialQuery && historyLoaded && user) {
      setInput(initialQuery);
      inputRef.current?.focus();
      navigate(location.pathname, { replace: true, state: {} });
    }
  }, [historyLoaded, location.state, user]);

  useEffect(() => {
    const el = messagesAreaRef.current;
    if (el) el.scrollTop = el.scrollHeight;
  }, [messages, sending]);

  const sendMessage = async (text) => {
    const trimmed = (text ?? input).trim();
    if (!trimmed || sending) return;

    if (!isPremium && msgCount >= FREE_LIMIT) {
      setLimitError(true);
      return;
    }

    setInput("");
    setSending(true);
    setLimitError(false);

    setMessages((prev) => [...prev, { role: "user", text: trimmed }]);

    try {
      const res = await api.post("/chatlogs", { message: trimmed });
      const logData = res.data.data;
      const aiText = logData?.respuesta_ia || "No he podido procesar tu mensaje.";
      const bookingData = logData?.datos_contexto || null;
      setMessages((prev) => [...prev, { role: "ai", text: aiText, bookingData }]);
      setMsgCount((c) => c + 1);
    } catch (err) {
      const errMsg =
        err.response?.data?.message ||
        "Ha ocurrido un error. Inténtalo de nuevo.";
      if (err.response?.status === 403) {
        setLimitError(true);
      }
      setMessages((prev) => [
        ...prev,
        { role: "ai", text: errMsg },
      ]);
    } finally {
      setSending(false);
    }
  };

  const handleKeyDown = (e) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  };

  if (authLoading) return null;

  if (!user) {
    return (
      <div className={styles.gateWrapper}>
        <div className={styles.gateCard}>
          <HiLockClosed className={styles.gateIcon} />
          <h2>Inicia sesión para usar la IA</h2>
          <p>
            Necesitas una cuenta para hablar con TravelAI. Los usuarios
            gratuitos tienen hasta 10 mensajes. Los usuarios Premium tienen
            acceso ilimitado.
          </p>
          <div className={styles.gateBtns}>
            <Link to="/login" className={styles.gateBtnPrimary}>
              Iniciar sesión
            </Link>
            <Link to="/register" className={styles.gateBtnSecondary}>
              Crear cuenta
            </Link>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className={styles.chatWrapper}>
      <div className={styles.chatHeader}>
        <div className={styles.headerLeft}>
          <IoSparkles className={styles.headerIcon} />
          <div>
            <h1 className={styles.headerTitle}>TravelAI</h1>
            <p className={styles.headerSub}>
              Tu asistente de viajes inteligente
            </p>
          </div>
        </div>
        <div className={styles.headerRight}>
          {isPremium ? (
            <span className={styles.premiumBadge}>
              <HiBadgeCheck /> Premium · Mensajes ilimitados
            </span>
          ) : (
            <span className={`${styles.counterBadge} ${remaining <= 2 ? styles.counterLow : ""}`}>
              {remaining > 0 ? `${remaining} mensajes restantes` : "Límite alcanzado"}
            </span>
          )}
        </div>
      </div>

      <div className={styles.messagesArea} ref={messagesAreaRef}>
        {messages.length === 0 && !sending && (
          <div className={styles.emptyState}>
            <IoSparkles className={styles.emptyIcon} />
            <h3>¿En qué puedo ayudarte?</h3>
            <p>Cuéntame qué tipo de viaje buscas y te doy recomendaciones personalizadas.</p>
            <div className={styles.suggestions}>
              {[
                "¿Qué destino me recomiendas para verano con playa?",
                "Quiero un viaje romántico a Europa con poco presupuesto",
                "¿Qué actividades hay en Barcelona?",
              ].map((s) => (
                <button
                  key={s}
                  className={styles.suggestionChip}
                  onClick={() => sendMessage(s)}
                >
                  {s}
                </button>
              ))}
            </div>
          </div>
        )}

        {messages.map((msg, i) => (
          <ChatMessage
            key={i}
            msg={msg}
            isPremium={isPremium}
            onPlannerClick={(bookingData) =>
              navigate("/planificador", { state: { bookingIds: bookingData } })
            }
          />
        ))}

        {sending && (
          <div className={`${styles.msgRow} ${styles.msgAi}`}>
            <div className={styles.aiAvatar}>
              <IoSparkles />
            </div>
            <div className={styles.msgBubble}>
              <div className={styles.typingDots}>
                <span /><span /><span />
              </div>
            </div>
          </div>
        )}

      </div>

      {limitError && !isPremium && (
        <div className={styles.limitBanner}>
          <HiLockClosed />
          Has alcanzado el límite de {FREE_LIMIT} mensajes gratuitos.{" "}
          <Link to="/perfil/premium" className={styles.limitLink}>
            Hazte Premium para mensajes ilimitados
          </Link>
        </div>
      )}

      <div className={styles.inputArea}>
        <textarea
          ref={inputRef}
          className={styles.inputBox}
          rows={1}
          placeholder={
            !isPremium && msgCount >= FREE_LIMIT
              ? "Límite alcanzado — hazte Premium"
              : "Escribe tu pregunta sobre viajes..."
          }
          value={input}
          onChange={(e) => setInput(e.target.value)}
          onKeyDown={handleKeyDown}
          disabled={sending || (!isPremium && msgCount >= FREE_LIMIT)}
        />
        <button
          className={styles.sendBtn}
          onClick={() => sendMessage()}
          disabled={sending || !input.trim() || (!isPremium && msgCount >= FREE_LIMIT)}
        >
          <HiPaperAirplane />
        </button>
      </div>
    </div>
  );
}
