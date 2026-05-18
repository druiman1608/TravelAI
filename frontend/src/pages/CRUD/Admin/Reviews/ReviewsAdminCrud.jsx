import React, { useState, useEffect } from "react";
import { useReviews } from "../../../../hooks/useReviews";
import {
  HiCheckCircle,
  HiXCircle,
  HiStar,
  HiTrash,
  HiPencil,
  HiOfficeBuilding,
  HiTicket,
  HiPaperAirplane,
  HiGift,
} from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";
import Modal from "../../../../components/ModalCrud/Modal";
import modalStyles from "../../../../components/ModalCrud/Modal.module.css";
import api from "../../../../api/axios";
import { toast } from "react-toastify";

const SERVICE_BADGE = {
  hotel_id: { label: "Hotel", icon: HiOfficeBuilding, cls: styles.badgeHotel },
  activity_id: { label: "Actividad", icon: HiTicket, cls: styles.badgeActivity },
  flight_id: { label: "Vuelo", icon: HiPaperAirplane, cls: styles.badgeFlight },
  package_id: { label: "Paquete", icon: HiGift, cls: styles.badgePackage },
};

function ServiceBadge({ review }) {
  const key = ["hotel_id", "activity_id", "flight_id", "package_id"].find(
    (k) => review.referencia?.[k],
  );
  if (!key) return <span>—</span>;
  const { label, icon: Icon, cls } = SERVICE_BADGE[key];
  return (
    <span className={`${styles.badge} ${cls}`}>
      <Icon /> {label}
    </span>
  );
}

function Stars({ count }) {
  return (
    <div className={styles.starRow}>
      {Array.from({ length: 5 }, (_, i) => (
        <HiStar
          key={i}
          className={i < count ? styles.starFilled : styles.starEmpty}
        />
      ))}
    </div>
  );
}

export default function ReviewsAdminCrud() {
  const {
    data: reviews,
    loading,
    updateStatus,
    handleDelete,
    setData,
  } = useReviews();
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [selectedReview, setSelectedReview] = useState(null);
  const [form, setForm] = useState({
    comentario: "",
    puntuacion: 5,
    estado: "pending",
  });

  useEffect(() => {
    if (selectedReview) {
      const estadoMap = {
        pendiente: "pending",
        aprobada: "approved",
        rechazada: "rejected",
      };
      setForm({
        comentario: selectedReview.comentario ?? "",
        puntuacion: selectedReview.puntuacion ?? 5,
        estado: estadoMap[selectedReview.estado] ?? selectedReview.estado,
      });
    }
  }, [selectedReview]);

  const openEdit = (review) => {
    setSelectedReview(review);
    setIsModalOpen(true);
  };

  const closeModal = () => {
    setIsModalOpen(false);
    setSelectedReview(null);
  };

  const handleEdit = async (e) => {
    e.preventDefault();
    try {
      await api.put(`/reviews/${selectedReview.id}`, {
        comment: form.comentario,
        rating: form.puntuacion,
        status: form.estado,
      });
      toast.success("Reseña actualizada");
      setData((prev) =>
        prev.map((r) =>
          r.id === selectedReview.id
            ? {
                ...r,
                comentario: form.comentario,
                puntuacion: form.puntuacion,
                estado: form.estado,
              }
            : r,
        ),
      );
      closeModal();
    } catch (e) {
      toast.error("Error al editar la reseña");
    }
  };

  if (loading) return <div className={styles.loading}>Cargando reseñas...</div>;

  const safeReviews = Array.isArray(reviews) ? reviews : [];

  return (
    <>
      <div className={styles.card}>
        <div className={styles.cardHeader}>
          <h2>Gestión de Reseñas [Admin]</h2>
        </div>
        <div className={styles.tableResponsive}>
          <table className={styles.table}>
            <thead>
              <tr>
                <th>Usuario y Elemento</th>
                <th>Comentario</th>
                <th>Puntuación</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {safeReviews.map((r) => (
                <tr key={r.id}>
                  <td>
                    <div className={styles.cellMain}>{r.usuario_nombre}</div>
                    <ServiceBadge review={r} />
                  </td>
                  <td className={styles.textTruncate} title={r.comentario}>
                    {r.comentario}
                  </td>
                  <td>
                    <Stars count={r.puntuacion} />
                  </td>
                  <td>
                    <span className={`${styles.badge} ${styles.badgePending}`}>
                      {r.estado}
                    </span>
                  </td>
                  <td className={styles.cellActions}>
                    <button
                      className={styles.approveBtn}
                      onClick={() => updateStatus(r.id, "approved")}
                      title="Aprobar"
                    >
                      <HiCheckCircle />
                    </button>
                    <button
                      className={styles.rejectBtn}
                      onClick={() => updateStatus(r.id, "rejected")}
                      title="Rechazar"
                    >
                      <HiXCircle />
                    </button>
                    <button
                      className={styles.editBtn}
                      onClick={() => openEdit(r)}
                      title="Editar"
                    >
                      <HiPencil />
                    </button>
                    <button
                      className={styles.deleteBtn}
                      onClick={() => handleDelete(r.id)}
                      title="Eliminar"
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

      <Modal isOpen={isModalOpen} onClose={closeModal} title="Editar Reseña">
        <form onSubmit={handleEdit} className={modalStyles.form}>
          <div className={modalStyles.formGroup}>
            <label>Comentario</label>
            <textarea
              value={form.comentario}
              onChange={(e) => setForm({ ...form, comentario: e.target.value })}
              rows={4}
              required
            />
          </div>
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Puntuación (1-5)</label>
              <input
                type="number"
                value={form.puntuacion}
                onChange={(e) =>
                  setForm({ ...form, puntuacion: parseInt(e.target.value) })
                }
                min="1"
                max="5"
                required
              />
            </div>
            <div className={modalStyles.formGroup}>
              <label>Estado</label>
              <select
                value={form.estado}
                onChange={(e) => setForm({ ...form, estado: e.target.value })}
              >
                <option value="pending">Pendiente</option>
                <option value="approved">Aprobada</option>
                <option value="rejected">Rechazada</option>
              </select>
            </div>
          </div>
          <button type="submit" className={modalStyles.saveBtn}>
            Guardar cambios
          </button>
        </form>
      </Modal>
    </>
  );
}
