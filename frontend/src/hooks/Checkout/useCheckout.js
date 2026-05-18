import { useState, useMemo, useEffect } from "react";

function parseExtras(obj) {
  if (!obj || typeof obj !== "object") return [];
  if (Array.isArray(obj)) return obj;
  return Object.entries(obj).map(([nombre, precio]) => ({
    nombre,
    precio: parseFloat(precio) || 0,
  }));
}

function extractFlightExtras(flight) {
  if (!flight) return [];
  const direct = parseExtras(flight.extras);
  const ida = parseExtras(flight.ida?.extras);
  const vuelta = parseExtras(flight.vuelta?.extras);

  const all = [...direct, ...ida, ...vuelta];
  const seen = new Set();
  return all.filter(({ nombre }) => {
    if (!nombre || seen.has(nombre)) return false;
    seen.add(nombre);
    return true;
  });
}

export function useCheckout(state) {
  const [numAcompañantes, setNumAcompañantes] = useState(0);
  const [noches, setNoches] = useState(1);
  const [fechaEntrada, setFechaEntrada] = useState(
    new Date().toISOString().split("T")[0],
  );
  const [fechaSalida, setFechaSalida] = useState(
    new Date(Date.now() + 86400000).toISOString().split("T")[0],
  );

  useEffect(() => {
    const entrada = new Date(fechaEntrada);
    const salida = new Date(fechaSalida);
    const diff = Math.ceil((salida - entrada) / (1000 * 60 * 60 * 24));
    setNoches(Math.max(1, diff));
  }, [fechaEntrada, fechaSalida]);
  const [contacto, setContacto] = useState({
    name: "",
    dni: "",
    email: "",
    phone: "",
  });
  const [acompañantes, setAcompañantes] = useState([]);
  const [selExtras, setSelExtras] = useState([]);

  const pkg = state?.pkg;
  const flight = state?.flight || pkg?.vuelo;
  const hotel = state?.hotel || pkg?.hotel;
  const activity = state?.activity || pkg?.actividad;

  const data = useMemo(() => {
    const fEx = extractFlightExtras(flight);
    const hEx = parseExtras(hotel?.extras);
    const aEx = parseExtras(activity?.extras);

    const extrasCategorizados = {
      vuelo: fEx,
      hotel: hEx,
      actividad: aEx,
    };

    const base = pkg
      ? parseFloat(pkg.precio_oferta) || parseFloat(pkg.precio_total) || 0
      : (parseFloat(flight?.precio_total) || 0) +
        (parseFloat(hotel?.precio_noche) || 0) * noches +
        (parseFloat(activity?.precio) || 0);

    return { regimenes: [], extrasCategorizados, base };
  }, [flight, hotel, activity, pkg, noches]);

  const stats = useMemo(() => {
    const extraTotal = selExtras.reduce((sum, e) => sum + (e.precio || 0), 0);
    return {
      totalFinal: (data.base + extraTotal) * (numAcompañantes + 1),
    };
  }, [data, selExtras, numAcompañantes]);

  const toggleExtra = (extra) => {
    setSelExtras((prev) =>
      prev.find((e) => e.nombre === extra.nombre)
        ? prev.filter((e) => e.nombre !== extra.nombre)
        : [...prev, extra],
    );
  };

  const updateAcompañante = (idx, field, val) => {
    setAcompañantes((prev) => {
      const next = [...prev];
      next[idx] = { ...next[idx], [field]: val };
      return next;
    });
  };

  return {
    numAcompañantes,
    setNumAcompañantes,
    noches,
    setNoches,
    fechaEntrada,
    setFechaEntrada,
    fechaSalida,
    setFechaSalida,
    contacto,
    setContacto,
    acompañantes,
    setAcompañantes,
    selExtras,
    toggleExtra,
    updateAcompañante,
    data,
    stats,
    flight,
    hotel,
    activity,
    pkg,
  };
}
