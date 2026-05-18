import React, { useState, useEffect } from "react";
import { usePackages } from "../../../../hooks/usePackages";
import { HiGift, HiPencil, HiTrash } from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";
import Modal from "../../../../components/ModalCrud/Modal";
import modalStyles from "../../../../components/ModalCrud/Modal.module.css";

export default function PackagesCrud() {
  const {
    data: packages,
    loading,
    isModalOpen,
    openModal,
    closeModal,
    selectedItem,
    handleDelete,
    savePackage,
    hotels,
    flights,
    activities,
    setFotos,
  } = usePackages();

  const [form, setForm] = useState({
    nombre: "",
    descripcion: "",
    precio_total: "",
    precio_oferta: "",
    hotel_id: "",
    flight_id: "",
    activity_id: "",
    itinerario: "",
  });

  useEffect(() => {
    if (selectedItem) {
      setForm({
        nombre: selectedItem.nombre ?? "",
        descripcion: selectedItem.descripcion ?? "",
        precio_total: selectedItem.precio_total ?? "",
        precio_oferta: selectedItem.precio_oferta ?? "",
        hotel_id: selectedItem.hotel?.id ?? "",
        flight_id: selectedItem.vuelo?.id ?? "",
        activity_id: selectedItem.actividad?.id ?? "",
        itinerario: Array.isArray(selectedItem.itinerario)
          ? selectedItem.itinerario.join("\n")
          : "",
      });
    } else {
      setForm({
        nombre: "",
        descripcion: "",
        precio_total: "",
        precio_oferta: "",
        hotel_id: "",
        flight_id: "",
        activity_id: "",
        itinerario: "",
      });
    }
  }, [selectedItem]);

  const handleSubmit = (e) => {
    e.preventDefault();
    const payload = {
      ...form,
      itinerario: form.itinerario
        .split("\n")
        .map((line) => line.trim())
        .filter(Boolean),
    };
    savePackage(payload, selectedItem?.id);
  };

  if (loading)
    return <div className={styles.loading}>Cargando paquetes de viajes...</div>;

  return (
    <>
      <div className={styles.card}>
        <div className={styles.cardHeader}>
          <h2>Paquetes Turísticos Completos</h2>
          <button className={styles.addBtn} onClick={() => openModal()}>
            <HiGift /> Nuevo Paquete
          </button>
        </div>
        <div className={styles.tableResponsive}>
          <table className={styles.table}>
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Destino</th>
                <th>Precio Base</th>
                <th>Precio Oferta</th>
                <th>Ahorro</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {packages.map((pkg) => (
                <tr key={pkg.id}>
                  <td>{pkg.nombre}</td>
                  <td>{pkg.destino}</td>
                  <td>{pkg.precio_total}€</td>
                  <td>
                    {pkg.precio_oferta ? `${pkg.precio_oferta}€` : "Sin oferta"}
                  </td>
                  <td>
                    <span className={styles.badgeSuccess}>{pkg.ahorro}€</span>
                  </td>
                  <td className={styles.cellActions}>
                    <button
                      className={styles.editBtn}
                      onClick={() => openModal(pkg)}
                    >
                      <HiPencil />
                    </button>
                    <button
                      className={styles.deleteBtn}
                      onClick={() => handleDelete(pkg.id)}
                    >
                      <HiTrash />
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      <Modal
        isOpen={isModalOpen}
        onClose={closeModal}
        title={
          selectedItem
            ? "Editar Paquete Vacacional"
            : "Crear Paquete Vacacional"
        }
      >
        <form onSubmit={handleSubmit} className={modalStyles.form}>
          <div className={modalStyles.formGroup}>
            <label>Nombre Comercial del Paquete</label>
            <input
              type="text"
              value={form.nombre}
              onChange={(e) => setForm({ ...form, nombre: e.target.value })}
              required
            />
          </div>
          <div className={modalStyles.formGroup}>
            <label>Descripción</label>
            <textarea
              value={form.descripcion}
              onChange={(e) =>
                setForm({ ...form, descripcion: e.target.value })
              }
              rows={3}
              required
            />
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Precio Original Total (€)</label>
              <input
                type="number"
                value={form.precio_total}
                onChange={(e) =>
                  setForm({ ...form, precio_total: e.target.value })
                }
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Precio Rebajado / Oferta (€)</label>
              <input
                type="number"
                value={form.precio_oferta}
                onChange={(e) =>
                  setForm({ ...form, precio_oferta: e.target.value })
                }
                placeholder="Dejar vacío si no aplica"
              />
            </div>
          </div>
          <div className={modalStyles.formGroup}>
            <label>Alojamiento (Hotel)</label>
            <select
              value={form.hotel_id}
              onChange={(e) => setForm({ ...form, hotel_id: e.target.value })}
              required
            >
              <option value="">Seleccione hotel combinado...</option>
              {hotels.map((h) => (
                <option key={h.id} value={h.id}>
                  {h.nombre}
                </option>
              ))}
            </select>
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Vuelo Relacionado</label>
              <select
                value={form.flight_id}
                onChange={(e) =>
                  setForm({ ...form, flight_id: e.target.value })
                }
              >
                <option value="">Ninguno</option>
                {flights.map((f) => (
                  <option key={f.id} value={f.id}>
                    {f.numero_vuelo} ({f.aerolinea})
                  </option>
                ))}
              </select>
            </div>
            <div className={modalStyles.formGroup}>
              <label>Actividad de Aventura</label>
              <select
                value={form.activity_id}
                onChange={(e) =>
                  setForm({ ...form, activity_id: e.target.value })
                }
              >
                <option value="">Ninguno</option>
                {activities.map((a) => (
                  <option key={a.id} value={a.id}>
                    {a.nombre}
                  </option>
                ))}
              </select>
            </div>
          </div>
          <div className={modalStyles.formGroup}>
            <label>Itinerario Diario (un día por línea)</label>
            <textarea
              value={form.itinerario}
              onChange={(e) => setForm({ ...form, itinerario: e.target.value })}
              rows={4}
              placeholder="Día 1: Llegada y Check-in&#10;Día 2: Tour guiado por el centro histórico&#10;Día 3: Tiempo libre y despedida"
            />
          </div>
          <div className={modalStyles.imageSection}>
            <label>Foto Principal del Paquete</label>
            <input
              type="file"
              accept="image/*"
              onChange={(e) =>
                setFotos((prev) => ({ ...prev, principal: e.target.files[0] }))
              }
            />
          </div>

          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.imageSection}>
              <label>Imagen de Galería 1</label>
              <input
                type="file"
                accept="image/*"
                onChange={(e) =>
                  setFotos((prev) => ({ ...prev, f2: e.target.files[0] }))
                }
              />
            </div>
            <div className={modalStyles.imageSection}>
              <label>Imagen de Galería 2</label>
              <input
                type="file"
                accept="image/*"
                onChange={(e) =>
                  setFotos((prev) => ({ ...prev, f3: e.target.files[0] }))
                }
              />
            </div>
          </div>
          <button type="submit" className={modalStyles.saveBtn}>
            {selectedItem ? "Actualizar Paquete" : "Crear Paquete"}
          </button>
        </form>
      </Modal>
    </>
  );
}
