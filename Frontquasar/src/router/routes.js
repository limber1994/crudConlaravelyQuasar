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
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
