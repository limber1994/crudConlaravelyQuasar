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
    path: "/app2",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "/app2",
        component: () => import("pages/ListaTests.vue"),
        // Esta es tu página de inicio de sesión, manténla aquí
      },
      {
        path: "/lista-tests", // Cambia la ruta de ListaTests.vue
        component: () => import("pages/ListaTests.vue"),
        // Cambia el path para evitar conflictos con la ruta de LoginPage.vue
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
        path: "/editar-test/:id",
        name: "editarTest",
        component: () => import("components/editarTest.vue"),
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
];
export default routes;
