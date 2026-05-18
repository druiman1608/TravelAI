import api from "../api/axios";
import { toast } from "react-toastify";
import { useCrud } from "./useCrud";

export function useUsers() {
  const crud = useCrud("/users");

  const updateUser = async (formData, id) => {
    try {
      const dataUpdate = {
        nombre: formData.nombre,
        email: formData.email,
        telefono: formData.telefono,
        rol_id: formData.rol_id,
        estado: formData.estado,
      };
      if (formData.password) dataUpdate.password = formData.password;

      await api.put(`/users/${id}`, dataUpdate);
      toast.success("Usuario actualizado");
      crud.refresh();
      crud.closeModal();
    } catch (e) {
      toast.error("Error al actualizar usuario");
    }
  };

  const createUser = async (formData) => {
    try {
      const dataCreate = {
        name: formData.nombre,
        email: formData.email,
        password: formData.password,
        role_id: formData.rol_id,
        status: formData.estado,
      };

      await api.post("/users", dataCreate);
      toast.success("Usuario creado con éxito");
      crud.refresh();
      crud.closeModal();
    } catch (e) {
      toast.error("Error al crear usuario");
    }
  };

  const saveUser = async (formData, id) => {
    if (id) {
      await updateUser(formData, id);
    } else {
      await createUser(formData);
    }
  };

  return { ...crud, updateUser, saveUser };
}
