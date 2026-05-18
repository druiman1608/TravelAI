import React, { useState, useEffect } from "react";
import { useActivities } from "../../../../hooks/useActivities";
import { HiTicket, HiPencil, HiTrash } from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";
import Modal from "../../../../components/ModalCrud/Modal";
import modalStyles from "../../../../components/ModalCrud/Modal.module.css";

export default function ActivitiesCrud() {
  const {
    data: activities,
    loading,
    isModalOpen,
    openModal,
    closeModal,
    selectedItem,
    handleDelete,
    locations,
    setFotos,
    saveActivity,
  } = useActivities();

  const [form, setForm] = useState({
    nombre: "",
    descripcion: "",
    duracion: "",
    precio: "",
    location_id: "",
    included_features: "",
  });

  const [extrasInputs, setExtrasInputs] = useState([{ clave: "", valor: "" }]);

  useEffect(() => {
    if (selectedItem) {
      setForm({
        nombre: selectedItem.nombre ?? "",
        descripcion: selectedItem.descripcion ?? "",
        duracion: (selectedItem.duracion ?? "").replace(" horas", ""),
        precio: selectedItem.precio ?? "",
        location_id:
          selectedItem.ubicacion_id ?? selectedItem.location_id ?? "",
        included_features: Array.isArray(selectedItem.servicios_incluidos)
          ? selectedItem.servicios_incluidos.join(", ")
          : (selectedItem.included_features ?? ""),
      });

      if (selectedItem.extras && typeof selectedItem.extras === "object") {
        const loaded = Object.entries(selectedItem.extras).map(([k, v]) => ({
          clave: k,
          valor: String(v),
        }));
        setExtrasInputs(
          loaded.length > 0 ? loaded : [{ clave: "", valor: "" }],
        );
      } else {
        setExtrasInputs([{ clave: "", valor: "" }]);
      }
    } else {
      setForm({
        nombre: "",
        descripcion: "",
        duracion: "",
        precio: "",
        location_id: "",
        included_features: "",
      });

      setExtrasInputs([{ clave: "", valor: "" }]);
    }
  }, [selectedItem]);

  const handleExtraChange = (index, field, value) => {
    const newExtras = [...extrasInputs];
    newExtras[index][field] = value;
    setExtrasInputs(newExtras);
  };

  const addExtraRow = () =>
    setExtrasInputs([...extrasInputs, { clave: "", valor: "" }]);

  const removeExtraRow = (index) =>
    setExtrasInputs(extrasInputs.filter((_, i) => i !== index));

  if (loading)
    return <div className={styles.loading}>Cargando actividades…</div>;

  return (
    <>
      <div className={styles.card}>
        <div className={styles.cardHeader}>
          <div className={styles.cardTitleGroup}>
            <span className={styles.cardTitle}>Actividades</span>
            <span className={styles.cardCount}>
              {activities.length} registros
            </span>
          </div>
          <button className={styles.addBtn} onClick={() => openModal()}>
            <HiTicket /> Nueva actividad
          </button>
        </div>

        <div className={styles.tableWrapper}>
          <table className={styles.table}>
            <thead>
              <tr>
                <th>Experiencia</th>
                <th>Duración</th>
                <th>Destino / Ubicación</th>
                <th>Precio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {activities.map((act) => (
                <tr key={act.id}>
                  <td>
                    <div className={styles.cellMain}>{act.nombre}</div>
                    <span className={styles.cellSub}>
                      {act.tipo || "Tour / Aventura"}
                    </span>
                  </td>
                  <td>
                    <span className={styles.durationBadge}>{act.duracion}</span>
                  </td>
                  <td>{act.ubicacion_nombre || "Ubicación global"}</td>
                  <td>
                    <span className={styles.priceTag}>{act.precio}€</span>
                  </td>
                  <td className={styles.cellActions}>
                    <button
                      className={styles.editBtn}
                      onClick={() => openModal(act)}
                    >
                      <HiPencil />
                    </button>
                    <button
                      className={styles.deleteBtn}
                      onClick={() => handleDelete(act.id)}
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
        title={selectedItem ? "Editar actividad" : "Nueva actividad"}
      >
        <form
          onSubmit={(e) => {
            e.preventDefault();
            const extrasObj = {};
            extrasInputs.forEach((item) => {
              if (item.clave.trim())
                extrasObj[item.clave.trim()] = item.valor.trim();
            });
            saveActivity({ ...form, extras: extrasObj }, selectedItem?.id);
          }}
          className={modalStyles.form}
        >
          <div className={modalStyles.formGroup}>
            <label>Nombre</label>
            <input
              type="text"
              value={form.nombre}
              onChange={(e) => setForm({ ...form, nombre: e.target.value })}
              placeholder="Ej: Tour guiado por la Alhambra"
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
              placeholder="Breve descripción de la actividad…"
              rows={3}
            />
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Duración (horas)</label>
              <input
                type="number"
                value={form.duracion}
                onChange={(e) => setForm({ ...form, duracion: e.target.value })}
                placeholder="Ej: 3"
                min="1"
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Precio (€)</label>
              <input
                type="number"
                value={form.precio}
                onChange={(e) => setForm({ ...form, precio: e.target.value })}
                placeholder="0"
                min="0"
              />
            </div>
          </div>
          <div className={modalStyles.formGroup}>
            <label>Destino</label>
            <select
              value={form.location_id}
              onChange={(e) =>
                setForm({ ...form, location_id: e.target.value })
              }
              required
            >
              <option value="">Selecciona un destino</option>
              {locations.map((loc) => (
                <option key={loc.id} value={loc.id}>
                  {loc.ciudad}
                </option>
              ))}
            </select>
          </div>

          <div className={modalStyles.formGroup}>
            <label>Características incluidas (separadas por comas)</label>
            <input
              type="text"
              value={form.included_features}
              onChange={(e) =>
                setForm({ ...form, included_features: e.target.value })
              }
              placeholder="Ej: Guía, Transporte, Almuerzo"
            />
          </div>

          <div className={modalStyles.imageSection}>
            <label>Foto principal</label>
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
              <label>Galería 1</label>
              <input
                type="file"
                accept="image/*"
                onChange={(e) =>
                  setFotos((prev) => ({ ...prev, f2: e.target.files[0] }))
                }
              />
            </div>
            <div className={modalStyles.imageSection}>
              <label>Galería 2</label>
              <input
                type="file"
                accept="image/*"
                onChange={(e) =>
                  setFotos((prev) => ({ ...prev, f3: e.target.files[0] }))
                }
              />
            </div>
          </div>

          <div className={modalStyles.formGroup}>
            <label className={styles.extrasLabel}>
              Características / Extras de la Actividad
            </label>
            {extrasInputs.map((extra, index) => (
              <div key={index} className={styles.extraRow}>
                <input
                  type="text"
                  placeholder="Ej: Equipaje"
                  value={extra.clave}
                  onChange={(e) =>
                    handleExtraChange(index, "clave", e.target.value)
                  }
                  className={styles.extraInput}
                />
                <input
                  type="text"
                  placeholder="Ej: Incluido"
                  value={extra.valor}
                  onChange={(e) =>
                    handleExtraChange(index, "valor", e.target.value)
                  }
                  className={styles.extraInput}
                />
                {extrasInputs.length > 1 && (
                  <button
                    type="button"
                    onClick={() => removeExtraRow(index)}
                    className={styles.removeExtraBtn}
                  >
                    ✕
                  </button>
                )}
              </div>
            ))}
            <button
              type="button"
              onClick={addExtraRow}
              className={styles.addExtraBtn}
            >
              + Añadir característica
            </button>
          </div>

          <button type="submit" className={modalStyles.saveBtn}>
            {selectedItem ? "Guardar cambios" : "Crear actividad"}
          </button>
        </form>
      </Modal>
    </>
  );
}
