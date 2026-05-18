import React, { useState, useEffect } from "react";
import { useHotels } from "../../../../hooks/useHotels";
import { HiPencil, HiTrash, HiStar } from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";
import Modal from "../../../../components/ModalCrud/Modal";
import modalStyles from "../../../../components/ModalCrud/Modal.module.css";

export default function HotelsCrud() {
  const {
    data: hotels,
    loading,
    isModalOpen,
    openModal,
    closeModal,
    selectedItem,
    handleDelete,
    locations,
    setFotos,
    saveHotel,
  } = useHotels();

  const [form, setForm] = useState({
    nombre: "",
    direccion: "",
    descripcion: "",
    codigo_postal: "",
    estrellas: 5,
    precio_noche: "",
    ubicacion_id: "",
    servicios: "",
  });

  const [extrasInputs, setExtrasInputs] = useState([{ clave: "", valor: "" }]);

  useEffect(() => {
    if (selectedItem) {
      setForm({
        nombre: selectedItem.nombre ?? selectedItem.name ?? "",
        direccion: selectedItem.direccion ?? selectedItem.address ?? "",
        descripcion: selectedItem.descripcion ?? selectedItem.description ?? "",
        estrellas: selectedItem.estrellas ?? selectedItem.stars ?? 5,
        precio_noche:
          selectedItem.precio_noche ?? selectedItem.price_per_night ?? "",
        ubicacion_id:
          selectedItem.ubicacion_id ?? selectedItem.location_id ?? "",
        codigo_postal:
          selectedItem.codigo_postal ?? selectedItem.zip_code ?? "",
        servicios: Array.isArray(selectedItem.servicios)
          ? selectedItem.servicios.join(", ")
          : (selectedItem.servicios ?? ""),
      });

      if (
        selectedItem.extras &&
        typeof selectedItem.extras === "object" &&
        !Array.isArray(selectedItem.extras)
      ) {
        const loadedExtras = Object.entries(selectedItem.extras).map(
          ([k, v]) => ({
            clave: k,
            valor: String(v),
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
        nombre: "",
        direccion: "",
        descripcion: "",
        codigo_postal: "",
        estrellas: 5,
        precio_noche: "",
        ubicacion_id: "",
        servicios: "",
      });
      setExtrasInputs([{ clave: "", valor: "" }]);
    }
  }, [selectedItem]);

  const handleExtraChange = (index, field, value) => {
    const newExtras = [...extrasInputs];
    newExtras[index][field] = value;
    setExtrasInputs(newExtras);
  };

  const addExtraRow = () => {
    setExtrasInputs([...extrasInputs, { clave: "", valor: "" }]);
  };

  const removeExtraRow = (index) => {
    setExtrasInputs(extrasInputs.filter((_, i) => i !== index));
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    const extrasObj = {};
    extrasInputs.forEach((item) => {
      if (item.clave.trim()) {
        extrasObj[item.clave.trim()] = item.valor.trim();
      }
    });

    const finalData = {
      ...form,
      extras: extrasObj,
    };

    saveHotel(finalData, selectedItem?.id);
  };

  if (loading)
    return (
      <div className={styles.loading}>Cargando complejos hoteleros...</div>
    );

  return (
    <>
      <div className={styles.card}>
        <div className={styles.cardHeader}>
          <h2>Mantenimiento de Hoteles</h2>
          <button className={styles.addBtn} onClick={() => openModal()}>
            <HiStar /> Registrar Hotel
          </button>
        </div>
        <div className={styles.tableResponsive}>
          <table className={styles.table}>
            <thead>
              <tr>
                <th>Establecimiento</th>
                <th>Categoría</th>
                <th>Ciudad</th>
                <th>Precio Noche</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {hotels?.map((h) => (
                <tr key={h.id}>
                  <td>{h.nombre || h.name}</td>
                  <td>{h.estrellas || h.stars} ⭐</td>
                  <td>{h.ubicacion_nombre || "Sin asignar"}</td>
                  <td>{h.precio_noche || h.price_per_night}€</td>
                  <td className={styles.cellActions}>
                    <button
                      className={styles.editBtn}
                      onClick={() => openModal(h)}
                    >
                      <HiPencil />
                    </button>
                    <button
                      className={styles.deleteBtn}
                      onClick={() => handleDelete(h.id)}
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
          selectedItem ? "Modificar Ficha de Hotel" : "Crear Ficha de Hotel"
        }
      >
        <form onSubmit={handleSubmit} className={modalStyles.form}>
          <div className={modalStyles.formGroup}>
            <label>Nombre del Hotel</label>
            <input
              type="text"
              value={form.nombre}
              onChange={(e) => setForm({ ...form, nombre: e.target.value })}
              required
            />
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Dirección</label>
              <input
                type="text"
                value={form.direccion}
                onChange={(e) =>
                  setForm({ ...form, direccion: e.target.value })
                }
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Código Postal</label>
              <input
                type="text"
                value={form.codigo_postal}
                onChange={(e) =>
                  setForm({ ...form, codigo_postal: e.target.value })
                }
                required
              />
            </div>
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Estrellas (1 - 5)</label>
              <input
                type="number"
                value={form.estrellas}
                onChange={(e) =>
                  setForm({ ...form, estrellas: parseInt(e.target.value) })
                }
                min="1"
                max="5"
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Precio por Noche (€)</label>
              <input
                type="number"
                value={form.precio_noche}
                onChange={(e) =>
                  setForm({ ...form, precio_noche: e.target.value })
                }
                required
              />
            </div>
          </div>
          <div className={modalStyles.formGroup}>
            <label>Destino Geográfico</label>
            <select
              value={form.ubicacion_id}
              onChange={(e) =>
                setForm({ ...form, ubicacion_id: e.target.value })
              }
              required
            >
              <option value="">Seleccione localización...</option>
              {locations?.map((l) => (
                <option key={l.id} value={l.id}>
                  {l.ciudad}
                </option>
              ))}
            </select>
          </div>
          <div className={modalStyles.formGroup}>
            <label>Descripción General</label>
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
            <label>Servicios del Hotel (separados por comas)</label>
            <input
              type="text"
              value={form.servicios}
              onChange={(e) => setForm({ ...form, servicios: e.target.value })}
              placeholder="WiFi, Piscina, Todo Incluido"
            />
          </div>

          <div className={modalStyles.formGroup}>
            <label className={styles.extrasLabel}>
              Características / Extras del Hotel
            </label>
            {extrasInputs.map((extra, index) => (
              <div key={index} className={styles.extraRow}>
                <input
                  type="text"
                  placeholder="Ej: Piscina"
                  value={extra.clave}
                  onChange={(e) =>
                    handleExtraChange(index, "clave", e.target.value)
                  }
                  className={styles.extraInput}
                />
                <input
                  type="text"
                  placeholder="Ej: Incluida"
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

          <div className={modalStyles.imageSection}>
            <label>Foto de portada</label>
            <input
              type="file"
              accept="image/*"
              onChange={(e) =>
                setFotos((f) => ({ ...f, principal: e.target.files[0] }))
              }
            />
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.imageSection}>
              <label>Foto de Galería 1</label>
              <input
                type="file"
                accept="image/*"
                onChange={(e) =>
                  setFotos((f) => ({ ...f, f2: e.target.files[0] }))
                }
              />
            </div>
            <div className={modalStyles.imageSection}>
              <label>Foto de Galería 2</label>
              <input
                type="file"
                accept="image/*"
                onChange={(e) =>
                  setFotos((f) => ({ ...f, f3: e.target.files[0] }))
                }
              />
            </div>
          </div>

          <button type="submit" className={modalStyles.saveBtn}>
            {selectedItem ? "Guardar cambios" : "Crear hotel"}
          </button>
        </form>
      </Modal>
    </>
  );
}
