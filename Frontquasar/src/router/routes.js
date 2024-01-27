const routes = [
  {
    path: "/",
    component: () => import("layouts/AuthLayout.vue"),
    children: [
      { path: "/", redirect: "/login" },
      {
        path: "login",
        component: () => import("pages/LoginPage.vue"),
      },
      {
        path: "register",
        component: () => import("pages/RegisterPage.vue"),
      },
    ],
    meta: { auth: false },
  },
  {
    path: "/app",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "/app",
        component: () => import("pages/ListaAlumnos.vue"),
        // Esta es tu página de inicio de sesión, manténla aquí
      },
      {
        path: "/lista-alumnos", // Cambia la ruta de ListaAlumnos.vue
        component: () => import("pages/ListaAlumnos.vue"),
        // Cambia el path para evitar conflictos con la ruta de LoginPage.vue
      },

      {
        path: "/agregar-alumno",
        name: "AgregarAlumno",
        component: () => import("components/FormularioAgregarAlumno.vue"),
      },
      {
        path: "/editar-alumno/:id",
        name: "editarAlumno",
        component: () => import("components/editarAlumno.vue"),
      },
      {
        path: "/agregar-universidad",
        name: "AgregarUniversidad",
        component: () => import("components/universidades.vue"),
      },
    ],
    meta: { auth: true },
  },
  {
    path: "/usuarios",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "/usuarios",
        component: () => import("pages/ListaUsuarios.vue"),
        // Esta es tu página de inicio de sesión, manténla aquí
      },
      {
        path: "/lista-usuarios", // Cambia la ruta de ListaUsuarios.vue
        component: () => import("pages/ListaUsuarios.vue"),
        // Cambia el path para evitar conflictos con la ruta de LoginPage.vue
      },
      {
        path: "/api/usuarios",
        component: () => import("pages/UsuariosAPI.vue"),
      },
      {
        path: "/agregar-usuario",
        name: "AgregarUsuario",
        component: () => import("components/FormularioAgregarUsuario.vue"),
      },
      {
        path: "/reporteador-usuario",
        name: "ReporteadorUsuario",
        component: () => import("components/ReporteadorUsuario.vue"),
        meta: { auth: true },
      },
      {
        path: "/editar-usuario/:id",
        name: "editarUsuario",
        component: () => import("components/editarUsuario.vue"),
      },
      {
        path: "/agregar-universidad",
        name: "AgregarUniversidad",
        component: () => import("components/universidades.vue"),
      },
    ],
    meta: { auth: true },
  },
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
  {
    path: "/tests",
    component: () => import("pages/TestsPage.vue"),
    meta: { auth: true },
  },
  {
    path: "/usuarios",
    component: () => import("pages/UsuariosPage.vue"),
    meta: { auth: true },
  },
  {
    path: "/etiquetas",
    component: () => import("pages/EtiquetasPage.vue"),
    meta: { auth: true },
  },
  {
    path: "/carreras",
    component: () => import("pages/CarrerasPage.vue"),
    meta: { auth: true },
  },
  {
    path: "/instituciones",
    component: () => import("pages/InstitucionesPage.vue"),
    meta: { auth: true },
  },
];
export default routes;
