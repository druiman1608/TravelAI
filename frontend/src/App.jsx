import { lazy, Suspense, useEffect } from "react";
import {
  BrowserRouter as Router,
  Routes,
  Route,
  useLocation,
} from "react-router-dom";
import { ToastContainer } from "react-toastify";
import { ProtectedRoute } from "./components/ProtectedRoute/ProtectedRoute";
import { AuthProvider } from "./context/AuthContext";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import "react-toastify/dist/ReactToastify.css";

import Navbar from "./components/Navbar/Navbar";
import Footer from "./components/Footer/Footer";
import LoadingScreen from "./components/Common/LoadingScreen";

const Login           = lazy(() => import("./pages/auth/Login"));
const Register        = lazy(() => import("./pages/auth/Register"));
const Inicio          = lazy(() => import("./pages/Inicio/Inicio"));
const Hoteles         = lazy(() => import("./pages/Hotels/Hotels"));
const Vuelos          = lazy(() => import("./pages/Flights/Flights"));
const Paquetes        = lazy(() => import("./pages/Packages/Packages"));
const Actividades     = lazy(() => import("./pages/Activities/Activities"));
const Planificador    = lazy(() => import("./pages/Planner/Planner"));
const Ai              = lazy(() => import("./pages/Ai/Ai"));
const DetallesHoteles    = lazy(() => import("./pages/Details/Hotels/HotelDetails"));
const DetallesVuelos     = lazy(() => import("./pages/Details/Flights/FlightDetails"));
const DetallesPaquetes   = lazy(() => import("./pages/Details/Packages/PackageDetails"));
const DetallesActividades = lazy(() => import("./pages/Details/Activities/ActivityDetails"));
const Resenias        = lazy(() => import("./pages/Reviews/Reviews"));
const Checkout        = lazy(() => import("./pages/Checkout/Checkout"));
const LayoutPerfil    = lazy(() => import("./layouts/Profile/ProfileLayout"));
const Perfil          = lazy(() => import("./pages/Profile/ProfileView/ProfileView"));
const Reservas        = lazy(() => import("./pages/Profile/Bookings/MyBookings"));
const MyReviews       = lazy(() => import("./pages/Profile/MyReviews/MyReviews"));
const Premium         = lazy(() => import("./pages/Profile/PremiumView/PremiumView"));
const Settings        = lazy(() => import("./pages/Profile/Settings/Settings"));
const CrudDashboard   = lazy(() => import("./pages/CRUD/CrudDashboard"));
const PrivacyPolicy   = lazy(() => import("./pages/Legal/PrivacyPolicy"));
const CookiePolicy    = lazy(() => import("./pages/Legal/CookiePolicy"));
const DataTreatment   = lazy(() => import("./pages/Legal/DataTreatment"));
const Contact         = lazy(() => import("./pages/Contact/Contact"));

function ScrollToTop() {
  const { pathname } = useLocation();
  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);
  return null;
}

const LayoutWrapper = ({ children }) => {
  const location = useLocation();
  const isdashboardPath = location.pathname.startsWith("/dashboard");

  return (
    <>
      {!isdashboardPath && <Navbar />}
      {children}
      {!isdashboardPath && <Footer />}
    </>
  );
};

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      staleTime: 60_000,
      gcTime: 5 * 60_000,
      retry: 1,
    },
  },
});

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <AuthProvider>
        <Router>
          <ScrollToTop />
          <LayoutWrapper>
            <Suspense fallback={<LoadingScreen />}>
              <Routes>
                <Route path="/" element={<Inicio />} />
                <Route path="/inicio" element={<Inicio />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/hoteles" element={<Hoteles />} />
                <Route path="/vuelos" element={<Vuelos />} />
                <Route path="/paquetes" element={<Paquetes />} />
                <Route path="/actividades" element={<Actividades />} />
                <Route path="/planificador" element={<Planificador />} />
                <Route path="/ai" element={<Ai />} />

                <Route path="/hotels/:id" element={<DetallesHoteles />} />
                <Route path="/flights/:id" element={<DetallesVuelos />} />
                <Route path="/packages/:id" element={<DetallesPaquetes />} />
                <Route path="/activities/:id" element={<DetallesActividades />} />

                <Route
                  path="/checkout"
                  element={
                    <ProtectedRoute>
                      <Checkout />
                    </ProtectedRoute>
                  }
                />

                <Route path="/hotels/:id/reviews" element={<Resenias />} />
                <Route path="/flights/:id/reviews" element={<Resenias />} />
                <Route path="/packages/:id/reviews" element={<Resenias />} />
                <Route path="/activities/:id/reviews" element={<Resenias />} />

                <Route
                  path="/perfil"
                  element={
                    <ProtectedRoute>
                      <LayoutPerfil />
                    </ProtectedRoute>
                  }
                >
                  <Route index element={<Perfil />} />
                  <Route path="reservas" element={<Reservas />} />
                  <Route path="resenas" element={<MyReviews />} />
                  <Route path="premium" element={<Premium />} />
                  <Route path="configuracion" element={<Settings />} />
                </Route>

                <Route path="/privacidad" element={<PrivacyPolicy />} />
                <Route path="/cookies" element={<CookiePolicy />} />
                <Route path="/datos" element={<DataTreatment />} />
                <Route path="/contacto" element={<Contact />} />

                <Route
                  path="/dashboard"
                  element={
                    <ProtectedRoute roleRequired="dashboard">
                      <CrudDashboard />
                    </ProtectedRoute>
                  }
                />
              </Routes>
            </Suspense>
          </LayoutWrapper>
        </Router>
        <ToastContainer position="bottom-right" />
      </AuthProvider>
    </QueryClientProvider>
  );
}

export default App;
