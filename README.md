# TravelAI - Plataforma de Viajes con IA

**Autor:** David Ruiz Manuel  
**Ciclo:** 2º DAW - IES Juan de la Cierva · Curso 2025/26  
**Aplicación en producción:** https://travel-ai-iota-roan.vercel.app  
**Figma:** https://www.figma.com/design/vPdK5EgxmQ1DWkNIa8bnMB/TravelAi?node-id=1-2&t=YcrE7awEi822gs4I-1  
**Vídeo:** https://youtu.be/hVKNvST6bwE  
**Instalación en local:** [Setup.md](https://github.com/druiman1608/TravelAI/blob/main/setup.md)  
**Documentación:** [Wiki del repositorio](https://github.com/druiman1608/TravelAI/wiki)  

## Título y Temática

  - Título: TravelAI
  
  - Temática: Desarrollo de una aplicación web para una agencia de viajes que integra un chatbot basado en inteligencia artificial, orientado a asistir a los usuarios en la elección y gestión de reservas de vuelos, hoteles, actividades y paquetes turísticos.

## Descripción

TravelAI es una plataforma web de reservas de viajes que integra un
asistente de inteligencia artificial para ayudar a los usuarios a
elegir y gestionar sus viajes. Permite reservar hoteles, vuelos,
actividades y paquetes combinados, con un sistema de pagos real
integrado mediante Stripe.

## Objetivos

- Construir una plataforma de reservas funcional con ciclo de vida completo
- Diseñar una interfaz intuitiva y visualmente cuidada
- Implementar autenticación segura con roles diferenciados
- Integrar servicios externos reales: pagos, IA, email transaccional
- Desplegar la aplicación en producción de forma accesible

## Tecnologías

| Parte | Tecnología |
|---|---|
| Frontend | React + Vite + CSS Modules |
| Backend | Laravel + PHP |
| Base de datos | MySQL |
| Autenticación | Laravel Sanctum + Google OAuth |
| Pagos | Stripe |
| IA | Groq API (llama-3.1-8b-instant) |
| Email | Resend |
| Despliegue frontend | Vercel |
| Despliegue backend | Railway |

## Roles del sistema

- **Administrador** - Control total: CRUD de todos los servicios y usuarios
- **Moderador** - Gestión de reseñas (aprobar/rechazar)
- **Usuario Premium** - 10% de descuento en todas las reservas, uso ilimitado de la IA
- **Usuario registrado** - Reservas, reseñas, chat IA (Solo 10 usos), sin descuentos
- **Usuario anónimo** - Navegación pública y consulta de servicios, no puede usar la IA

## Documentación

Toda la documentación técnica está disponible en la
[Wiki del repositorio](https://github.com/druiman1608/TravelAI/wiki).


