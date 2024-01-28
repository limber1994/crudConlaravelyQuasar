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
        path: "/lista-alumnos", // Cambia la ruta de ListaAlumnos.vue
        component: () => import("pages/ListaAlumnos.vue"),
        //Cambia el path para evitar conflictos con la ruta de LoginPage.vue
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
    ],
    meta: { auth: true },
  },
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
  {
    path: "/usuarios",
    component: () => import("pages/UsuariosPage.vue"),
    meta: { auth: true },
  },
  {
    path: "/tests",
    component: () => import("pages/TestsPage.vue"),
    meta: { auth: true },
  },
];

export default routes;
