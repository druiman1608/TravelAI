import { useCrud } from "./useCrud";
import api from "../api/axios";
import { toast } from "react-toastify";

export function useReviews() {
  const crud = useCrud("/admin/reviews/pending");

  const updateStatus = async (id, status) => {
    try {
      await api.patch(`/admin/reviews/${id}/status`, { status });
      toast.success(
        `Reseña ${status === "approved" ? "aprobada" : "rechazada"}`,
      );
      crud.setData((prev) => prev.filter((r) => r.id !== id));
    } catch (e) {
      toast.error("Error al actualizar estado");
    }
  };

  const handleDelete = async (id) => {
    if (!window.confirm("¿Eliminar esta reseña?")) return;
    try {
      await api.delete(`/reviews/${id}`);
      crud.setData((prev) => prev.filter((r) => r.id !== id));
      toast.success("Reseña eliminada");
    } catch (e) {
      toast.error("Error al eliminar");
    }
  };

  return { ...crud, updateStatus, handleDelete };
}
