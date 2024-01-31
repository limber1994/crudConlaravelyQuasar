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
    path: "/app7",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "/app7",
        component: () => import("pages/home.vue"),
        // Esta es tu página de inicio de sesión, manténla aquí
      },
      {
        path: "/usuarios",
        component: () => import("pages/ListaUsuarios.vue"),
      },
      {
        path: "/lista-usuarios",
        component: () => import("pages/ListaUsuarios.vue"),
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
        path: "/tests",
        component: () => import("pages/ListaTests.vue"),
      },
      {
        path: "/lista-tests",
        component: () => import("pages/ListaTests.vue"),
      },
      {
        path: "/api/tests",
        component: () => import("pages/TestsAPI.vue"),
      },
      {
        path: "/agregar-test",
        name: "AgregarTest",
        component: () => import("components/FormularioAgregarTest.vue"),
      },
      {
        path: "/reporteador-test",
        name: "ReporteadorTest",
        component: () => import("components/ReporteadorTest.vue"),
        meta: { auth: true },
      },
      {
        path: "/editar-test/:id",
        name: "editarTest",
        component: () => import("components/editarTest.vue"),
      },
      {
        path: "/instituciones",
        component: () => import("pages/ListaInstituciones.vue"),
        // Esta es tu página de inicio de sesión, manténla aquí
      },
      {
        path: "/lista-instituciones", // Cambia la ruta de ListaInstituciones.vue
        component: () => import("pages/ListaInstituciones.vue"),
        // Cambia el path para evitar conflictos con la ruta de LoginPage.vue
      },
      {
        path: "/agregar-institucion",
        name: "AgregarInstitucion",
        component: () => import("components/FormularioAgregarInstitucion.vue"),
      },
      {
        path: "/editar-institucion/:id",
        name: "editarInstitucion",
        component: () => import("components/editarInstitucion.vue"),
      },
      {
        path: "/catalogo",
        component: () => import("pages/Catalogo.vue"),
      },
    ],
    meta: { auth: true },
  },
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
