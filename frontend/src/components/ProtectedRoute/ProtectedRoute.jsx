import { Navigate } from "react-router-dom";
import { useAuth } from "../../context/AuthContext";

export const ProtectedRoute = ({ children, roleRequired }) => {
  const { isAuthenticated, loading, isAdmin, isMod } = useAuth();

  if (loading) return null;

  if (!isAuthenticated) {
    return <Navigate to="/login" />;
  }

  if (roleRequired === "dashboard" && !isAdmin && !isMod) {
    return <Navigate to="/" />;
  }

  return children;
};
