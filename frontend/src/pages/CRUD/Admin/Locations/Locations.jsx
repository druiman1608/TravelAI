import React, { useState, useEffect } from "react";
import { useLocations } from "../../../../hooks/useLocations";
import { HiGlobe, HiPencil, HiTrash } from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";
import Modal from "../../../../components/ModalCrud/Modal";
import modalStyles from "../../../../components/ModalCrud/Modal.module.css";

export default function LocationsCrud() {
  const {
    data: locations,
    loading,
    isModalOpen,
    openModal,
    closeModal,
    selectedItem,
    handleDelete,
    setFoto,
    saveLocation,
  } = useLocations();

  const [form, setForm] = useState({
    ciudad: "",
    pais: "",
    continente: "",
    clima: "",
    descripcion: "",
    activo: true,
  });

  useEffect(() => {
    if (selectedItem) {
      setForm({
        ciudad: selectedItem.ciudad ?? "",
        pais: selectedItem.pais ?? "",
        continente: selectedItem.continente ?? "",
        clima: selectedItem.clima ?? "",
        descripcion: selectedItem.descripcion ?? "",
        activo: selectedItem.activo ?? true,
      });
    } else {
      setForm({
        ciudad: "",
        pais: "",
        continente: "",
        clima: "",
        descripcion: "",
        activo: true,
      });
    }
  }, [selectedItem]);

  const handleSubmit = (e) => {
    e.preventDefault();
    saveLocation(form, selectedItem?.id);
  };

  if (loading)
    return (
      <div className={styles.loading}>Cargando destinos turísticos...</div>
    );

  return (
    <>
      <div className={styles.card}>
        <div className={styles.cardHeader}>
          <h2>Destinos y Ubicaciones</h2>
          <button className={styles.addBtn} onClick={() => openModal()}>
            <HiGlobe /> Crear Destino
          </button>
        </div>
        <div className={styles.tableResponsive}>
          <table className={styles.table}>
            <thead>
              <tr>
                <th>Ciudad</th>
                <th>País</th>
                <th>Continente</th>
                <th>Clima</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {locations.map((loc) => (
                <tr key={loc.id}>
                  <td>{loc.ciudad}</td>
                  <td>{loc.pais}</td>
                  <td>{loc.continente}</td>
                  <td>{loc.clima}</td>
                  <td>{loc.activo ? "Activo" : "Inactivo"}</td>
                  <td className={styles.cellActions}>
                    <button
                      className={styles.editBtn}
                      onClick={() => openModal(loc)}
                    >
                      <HiPencil />
                    </button>
                    <button
                      className={styles.deleteBtn}
                      onClick={() => handleDelete(loc.id)}
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
        title={selectedItem ? "Editar Destino" : "Crear Destino"}
      >
        <form onSubmit={handleSubmit} className={modalStyles.form}>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Ciudad</label>
              <input
                type="text"
                value={form.ciudad}
                onChange={(e) => setForm({ ...form, ciudad: e.target.value })}
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>País</label>
              <input
                type="text"
                value={form.pais}
                onChange={(e) => setForm({ ...form, pais: e.target.value })}
                required
              />
            </div>
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Continente</label>
              <input
                type="text"
                value={form.continente}
                onChange={(e) =>
                  setForm({ ...form, continente: e.target.value })
                }
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Clima Dominante</label>
              <input
                type="text"
                value={form.clima}
                onChange={(e) => setForm({ ...form, clima: e.target.value })}
                required
              />
            </div>
          </div>
          <div className={modalStyles.formGroup}>
            <label>Descripción Turística</label>
            <textarea
              value={form.descripcion}
              onChange={(e) =>
                setForm({ ...form, descripcion: e.target.value })
              }
              rows={3}
              required
            />
          </div>
          <div className={modalStyles.formGroup}>
            <label>Estado del Destino</label>
            <select
              value={form.activo}
              onChange={(e) =>
                setForm({ ...form, activo: e.target.value === "true" })
              }
            >
              <option value="true">Activo / Operativo</option>
              <option value="false">Inactivo</option>
            </select>
          </div>
          <div className={modalStyles.imageSection}>
            <label>Fotografía de Paisaje</label>
            <input
              type="file"
              accept="image/*"
              onChange={(e) => setFoto(e.target.files[0])}
            />
          </div>
          <button type="submit" className={modalStyles.saveBtn}>
            {selectedItem ? "Guardar cambios" : "Crear destino"}
          </button>
        </form>
      </Modal>
    </>
  );
}
