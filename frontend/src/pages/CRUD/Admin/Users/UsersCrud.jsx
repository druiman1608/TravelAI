import React, { useState, useEffect } from "react";
import { useUsers } from "../../../../hooks/useUsers";
import { HiPencil, HiTrash, HiUserAdd } from "react-icons/hi";
import styles from "../../CrudDashboard.module.css";
import Modal from "../../../../components/ModalCrud/Modal";
import modalStyles from "../../../../components/ModalCrud/Modal.module.css";

export default function UsersCrud() {
  const {
    data: users,
    loading,
    isModalOpen,
    openModal,
    closeModal,
    selectedItem,
    handleDelete,
    saveUser,
  } = useUsers();

  const [form, setForm] = useState({
    nombre: "",
    email: "",
    password: "",
    estado: "active",
    rol_id: 3,
  });

  useEffect(() => {
    if (selectedItem) {
      setForm({
        nombre: selectedItem.nombre,
        email: selectedItem.email,
        estado: selectedItem.estado,
        rol_id: selectedItem.rol_id,
        password: "",
      });
    } else {
      setForm({
        nombre: "",
        email: "",
        password: "",
        estado: "active",
        rol_id: 3,
      });
    }
  }, [selectedItem]);

  const handleSubmit = (e) => {
    e.preventDefault();
    saveUser(form, selectedItem?.id);
  };

  if (loading) return <div className={styles.loading}>Cargando usuarios…</div>;

  return (
    <>
      <div className={styles.card}>
        <div className={styles.cardHeader}>
          <span className={styles.cardTitle}>Gestión de Usuarios</span>
          <button className={styles.addBtn} onClick={() => openModal()}>
            <HiUserAdd /> Crear Usuario
          </button>
        </div>

        <div className={styles.tableWrapper}>
          <table className={styles.table}>
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {users.map((u) => (
                <tr key={u.id}>
                  <td>{u.nombre}</td>
                  <td>{u.email}</td>
                  <td>{u.rol_nombre}</td>
                  <td>{u.estado}</td>
                  <td>
                    <div className={styles.cellActions}>
                      <button
                        className={styles.editBtn}
                        onClick={() => openModal(u)}
                      >
                        <HiPencil />
                      </button>
                      <button
                        className={styles.deleteBtn}
                        onClick={() => handleDelete(u.id)}
                      >
                        <HiTrash />
                      </button>
                    </div>
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
        title={selectedItem ? "Editar Usuario" : "Nuevo Usuario"}
      >
        <form onSubmit={handleSubmit} className={modalStyles.form}>
          <div className={modalStyles.formGroup}>
            <label>Nombre Completo</label>
            <input
              type="text"
              value={form.nombre}
              onChange={(e) => setForm({ ...form, nombre: e.target.value })}
              required
            />
          </div>
          <div className={modalStyles.formGroup}>
            <label>Email</label>
            <input
              type="email"
              value={form.email}
              onChange={(e) => setForm({ ...form, email: e.target.value })}
              required
              disabled={!!selectedItem}
            />
          </div>
          {!selectedItem && (
            <div className={modalStyles.formGroup}>
              <label>Contraseña</label>
              <input
                type="password"
                onChange={(e) => setForm({ ...form, password: e.target.value })}
                required
              />
            </div>
          )}
          <div className={modalStyles.gridTwoCols}>
            <div className={modalStyles.formGroup}>
              <label>Rol</label>
              <select
                value={form.rol_id}
                onChange={(e) =>
                  setForm({ ...form, rol_id: parseInt(e.target.value) })
                }
              >
                <option value={1}>Admin</option>
                <option value={2}>Moderador</option>
                <option value={3}>Usuario</option>
              </select>
            </div>
            <div className={modalStyles.formGroup}>
              <label>Estado</label>
              <select
                value={form.estado}
                onChange={(e) => setForm({ ...form, estado: e.target.value })}
              >
                <option value="active">Activo</option>
                <option value="suspended">Suspendido</option>
                <option value="inactive">Inactivo</option>
              </select>
            </div>
          </div>
          <button type="submit" className={modalStyles.saveBtn}>
            {selectedItem ? "Guardar Cambios" : "Crear Usuario"}
          </button>
        </form>
      </Modal>
    </>
  );
}
