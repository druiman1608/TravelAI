import React, { useState, useEffect } from "react";
import { useFlights } from "../../../../hooks/useFlights";
import { useFlightOffers } from "../../../../hooks/useFlightOffers";
import { HiTag, HiPencil, HiTrash } from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";
import Modal from "../../../../components/ModalCrud/Modal";
import modalStyles from "../../../../components/ModalCrud/Modal.module.css";

export default function FlightOffersCrud() {
  const { data: allFlights } = useFlights();
  const {
    data: offers,
    loading,
    isModalOpen,
    openModal,
    closeModal,
    selectedItem,
    handleDelete,
    saveOffer,
  } = useFlightOffers();

  const [form, setForm] = useState({
    vuelo_ida_id: "",
    vuelo_vuelta_id: "",
    tipo: "round_trip",
    precio_total: "",
  });

  useEffect(() => {
    if (selectedItem) {
      setForm({
        vuelo_ida_id: selectedItem.ida?.vuelo_id ?? "",
        vuelo_vuelta_id: selectedItem.vuelta?.vuelo_id ?? "",
        tipo: selectedItem.tipo ?? "round_trip",
        precio_total: selectedItem.precio_total ?? "",
      });
    } else {
      setForm({
        vuelo_ida_id: "",
        vuelo_vuelta_id: "",
        tipo: "round_trip",
        precio_total: "",
      });
    }
  }, [selectedItem]);

  const handleSubmit = (e) => {
    e.preventDefault();
    saveOffer(form, selectedItem?.id);
  };

  if (loading)
    return (
      <div className={styles.loading}>Cargando ofertas promocionales...</div>
    );

  return (
    <>
      <div className={styles.card}>
        <div className={styles.cardHeader}>
          <h2>Ofertas Especiales de Vuelo</h2>
          <button className={styles.addBtn} onClick={() => openModal()}>
            <HiTag /> Nueva Oferta
          </button>
        </div>
        <div className={styles.tableResponsive}>
          <table className={styles.table}>
            <thead>
              <tr>
                <th>Tipo Oferta</th>
                <th>Vuelo Ida</th>
                <th>Vuelo Vuelta</th>
                <th>Precio Promocional</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {offers.map((off) => (
                <tr key={off.id}>
                  <td>
                    {off.tipo === "round_trip" ? "Ida y Vuelta" : "Solo Ida"}
                  </td>
                  <td>
                    {off.ida?.aerolinea} ({off.ida?.origen} → {off.ida?.destino}
                    )
                  </td>
                  <td>
                    {off.vuelta?.aerolinea} ({off.vuelta?.origen} →
                    {off.vuelta?.destino})
                  </td>
                  <td>
                    <strong>{off.precio_total}€</strong>
                  </td>
                  <td className={styles.cellActions}>
                    <button
                      className={styles.editBtn}
                      onClick={() => openModal(off)}
                    >
                      <HiPencil />
                    </button>
                    <button
                      className={styles.deleteBtn}
                      onClick={() => handleDelete(off.id)}
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
        title={selectedItem ? "Editar Oferta" : "Crear Nueva Oferta"}
      >
        <form onSubmit={handleSubmit} className={modalStyles.form}>
          <div className={modalStyles.formGroup}>
            <label>Tipo de Trayecto</label>
            <select
              value={form.tipo}
              onChange={(e) => setForm({ ...form, tipo: e.target.value })}
            >
              <option value="one_way">Solo Ida (One Way)</option>
              <option value="round_trip">Ida y Vuelta (Round Trip)</option>
            </select>
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Vuelo de Ida</label>
              <select
                value={form.vuelo_ida_id}
                onChange={(e) =>
                  setForm({ ...form, vuelo_ida_id: e.target.value })
                }
                required
              >
                <option value="">Seleccione...</option>
                {allFlights.map((f) => (
                  <option key={f.id} value={f.id}>
                    {f.numero_vuelo} - {f.aerolinea}
                  </option>
                ))}
              </select>
            </div>
            {form.tipo === "round_trip" && (
              <div className={modalStyles.formGroup}>
                <label>Vuelo de Vuelta</label>
                <select
                  value={form.vuelo_vuelta_id}
                  onChange={(e) =>
                    setForm({ ...form, vuelo_vuelta_id: e.target.value })
                  }
                  required
                >
                  <option value="">Seleccione...</option>
                  {allFlights.map((f) => (
                    <option key={f.id} value={f.id}>
                      {f.numero_vuelo} - {f.aerolinea}
                    </option>
                  ))}
                </select>
              </div>
            )}
          </div>
          <div className={modalStyles.formGroup}>
            <label>Precio Final de la Oferta (€)</label>
            <input
              type="number"
              value={form.precio_total}
              onChange={(e) =>
                setForm({ ...form, precio_total: e.target.value })
              }
              required
              min="0"
            />
          </div>
          <button type="submit" className={modalStyles.saveBtn}>
            {selectedItem ? "Actualizar Oferta" : "Crear Oferta"}
          </button>
        </form>
      </Modal>
    </>
  );
}
