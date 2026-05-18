import React, { useState, useEffect } from "react";
import { useFlights } from "../../../../hooks/useFlights";
import { HiPaperAirplane, HiPencil, HiTrash } from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";
import Modal from "../../../../components/ModalCrud/Modal";
import modalStyles from "../../../../components/ModalCrud/Modal.module.css";

export default function FlightsCrud() {
  const {
    data: flights,
    loading,
    isModalOpen,
    openModal,
    closeModal,
    selectedItem,
    handleDelete,
    locations,
    saveFlight,
    setImageFlight,
  } = useFlights();

  const [form, setForm] = useState({
    numero_vuelo: "",
    aerolinea: "",
    origen_id: "",
    destino_id: "",
    precio: "",
    capacidad: "",
    salida: "",
    llegada: "",
    duracion: "",
    escalas: 0,
  });

  const [extrasInputs, setExtrasInputs] = useState([{ clave: "", valor: "" }]);

  useEffect(() => {
    if (selectedItem) {
      setForm({
        numero_vuelo:
          selectedItem.flight_number ?? selectedItem.numero_vuelo ?? "",
        aerolinea: selectedItem.airline ?? selectedItem.aerolinea ?? "",
        origen_id: selectedItem.origin_loc_id ?? selectedItem.origen_id ?? "",
        destino_id:
          selectedItem.destination_loc_id ?? selectedItem.destino_id ?? "",
        precio: selectedItem.price ?? selectedItem.precio ?? "",
        capacidad: selectedItem.capacity ?? selectedItem.capacidad ?? "",
        salida: selectedItem.departure
          ? selectedItem.departure.replace(" ", "T")
          : "",
        llegada: selectedItem.arrival
          ? selectedItem.arrival.replace(" ", "T")
          : "",
        duracion: selectedItem.duration_time ?? selectedItem.duracion ?? "",
        escalas: selectedItem.stops ?? selectedItem.escalas ?? 0,
      });

      if (selectedItem.extras && typeof selectedItem.extras === "object") {
        const loadedExtras = Object.entries(selectedItem.extras).map(
          ([k, v]) => ({
            clave: k,
            valor: v,
          }),
        );
        setExtrasInputs(
          loadedExtras.length > 0 ? loadedExtras : [{ clave: "", valor: "" }],
        );
      } else {
        setExtrasInputs([{ clave: "", valor: "" }]);
      }
    } else {
      setForm({
        numero_vuelo: "",
        aerolinea: "",
        origen_id: "",
        destino_id: "",
        precio: "",
        capacidad: "",
        salida: "",
        llegada: "",
        duracion: "",
        escalas: 0,
      });
      setExtrasInputs([{ clave: "", valor: "" }]);
    }
  }, [selectedItem]);

  const handleExtraChange = (index, field, value) => {
    const updated = [...extrasInputs];
    updated[index][field] = value;
    setExtrasInputs(updated);
  };

  const addExtraField = () => {
    setExtrasInputs([...extrasInputs, { clave: "", valor: "" }]);
  };

  const removeExtraField = (index) => {
    setExtrasInputs(extrasInputs.filter((_, i) => i !== index));
  };

  const calcularDuracion = (salida, llegada) => {
    if (!salida || !llegada) return "";
    const diff = new Date(llegada) - new Date(salida);
    if (diff <= 0) return "";
    const h = Math.floor(diff / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    return `${h}h ${m}m`;
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    saveFlight(form, extrasInputs, selectedItem?.id);
  };

  if (loading) return <p>Cargando vuelos...</p>;

  return (
    <div className={styles.card}>
      <div className={styles.cardHeader}>
        <h2 className={styles.cardTitle}>Gestión de Vuelos</h2>
        <button className={styles.addBtn} onClick={() => openModal(null)}>
          <HiPaperAirplane /> Añadir Vuelo
        </button>
      </div>

      <div className={styles.tableResponsive}>
        <table className={styles.table}>
          <thead>
            <tr>
              <th>ID</th>
              <th>Imagen</th>
              <th>Nº Vuelo</th>
              <th>Aerolínea</th>
              <th>Origen</th>
              <th>Destino</th>
              <th>Precio</th>
              <th>Salida</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {flights.map((flight) => (
              <tr key={flight.id}>
                <td>{flight.id}</td>
                <td>
                  <img
                    src={flight.imagen || "/placeholder-flight.png"}
                    alt="Vuelo"
                    className={styles.tableImg}
                  />
                </td>
                <td>{flight.numero_vuelo || flight.flight_number}</td>
                <td>{flight.aerolinea || flight.airline}</td>
                <td>{flight.origen_ciudad || "N/A"}</td>
                <td>{flight.destino_ciudad || "N/A"}</td>
                <td>{flight.precio || flight.price}€</td>
                <td>{flight.salida || flight.departure}</td>
                <td className={styles.cellActions}>
                  <button
                    className={styles.editBtn}
                    onClick={() => openModal(flight)}
                  >
                    <HiPencil />
                  </button>
                  <button
                    className={styles.deleteBtn}
                    onClick={() => handleDelete(flight.id)}
                  >
                    <HiTrash />
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <Modal
        isOpen={isModalOpen}
        onClose={closeModal}
        title={selectedItem ? "Editar Vuelo" : "Nuevo Vuelo"}
      >
        <form onSubmit={handleSubmit} className={modalStyles.form}>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Número de Vuelo</label>
              <input
                type="text"
                value={form.numero_vuelo}
                onChange={(e) =>
                  setForm({ ...form, numero_vuelo: e.target.value })
                }
                placeholder="Ej: IB3240"
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Aerolínea</label>
              <input
                type="text"
                value={form.aerolinea}
                onChange={(e) =>
                  setForm({ ...form, aerolinea: e.target.value })
                }
                placeholder="Ej: Iberia"
                required
              />
            </div>
          </div>

          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Origen</label>
              <select
                value={form.origen_id}
                onChange={(e) =>
                  setForm({ ...form, origen_id: e.target.value })
                }
                required
              >
                <option value="">Selecciona origen...</option>
                {locations.map((loc) => (
                  <option key={loc.id} value={loc.id}>
                    {loc.ciudad} ({loc.pais})
                  </option>
                ))}
              </select>
            </div>
            <div className={modalStyles.formGroup}>
              <label>Destino</label>
              <select
                value={form.destino_id}
                onChange={(e) =>
                  setForm({ ...form, destino_id: e.target.value })
                }
                required
              >
                <option value="">Selecciona destino...</option>
                {locations.map((loc) => (
                  <option key={loc.id} value={loc.id}>
                    {loc.ciudad} ({loc.pais})
                  </option>
                ))}
              </select>
            </div>
          </div>

          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Precio (€)</label>
              <input
                type="number"
                value={form.precio}
                onChange={(e) => setForm({ ...form, precio: e.target.value })}
                min="0"
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Capacidad Pasajeros</label>
              <input
                type="number"
                value={form.capacidad}
                onChange={(e) =>
                  setForm({ ...form, capacidad: e.target.value })
                }
                min="1"
                required
              />
            </div>
          </div>

          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Fecha/Hora Salida</label>
              <input
                type="datetime-local"
                value={form.salida}
                onChange={(e) => {
                  const nueva = e.target.value;
                  setForm({
                    ...form,
                    salida: nueva,
                    duracion: calcularDuracion(nueva, form.llegada),
                  });
                }}
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Fecha/Hora Llegada</label>
              <input
                type="datetime-local"
                value={form.llegada}
                onChange={(e) => {
                  const nueva = e.target.value;
                  setForm({
                    ...form,
                    llegada: nueva,
                    duracion: calcularDuracion(form.salida, nueva),
                  });
                }}
                required
              />
            </div>
          </div>

          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Duración Estimada</label>
              <input type="text" value={form.duracion} readOnly />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Número de Escalas</label>
              <input
                type="number"
                value={form.escalas}
                onChange={(e) =>
                  setForm({ ...form, escalas: parseInt(e.target.value) || 0 })
                }
                min="0"
              />
            </div>
          </div>

          <div className={modalStyles.imageSection}>
            <label>Foto representativa del vuelo / aerolínea</label>
            <input
              type="file"
              accept="image/*"
              onChange={(e) => setImageFlight(e.target.files[0])}
            />
          </div>

          <div className={modalStyles.formGroup}>
            <label className={styles.extrasLabel}>
              Características adicionales / Extras del Vuelo
            </label>
            {extrasInputs.map((item, index) => (
              <div key={index} className={styles.extraRow}>
                <input
                  type="text"
                  placeholder="Ej: Equipaje"
                  value={item.clave}
                  onChange={(e) =>
                    handleExtraChange(index, "clave", e.target.value)
                  }
                  className={styles.extraInput}
                />
                <input
                  type="text"
                  placeholder="Ej: Incluido 23kg o +25€"
                  value={item.valor}
                  onChange={(e) =>
                    handleExtraChange(index, "valor", e.target.value)
                  }
                  className={styles.extraInput}
                />
                {extrasInputs.length > 1 && (
                  <button
                    type="button"
                    onClick={() => removeExtraField(index)}
                    className={styles.removeExtraBtn}
                  >
                    X
                  </button>
                )}
              </div>
            ))}
            <button
              type="button"
              onClick={addExtraField}
              className={styles.addExtraBtn}
            >
              + Añadir característica
            </button>
          </div>

          <button type="submit" className={modalStyles.saveBtn}>
            {selectedItem ? "Guardar cambios" : "Crear vuelo"}
          </button>
        </form>
      </Modal>
    </div>
  );
}
