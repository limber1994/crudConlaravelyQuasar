const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/LoginPage.vue"),
        // Esta es tu página de inicio de sesión, manténla aquí
      },
      {
        path: "/lista-alumnos", // Cambia la ruta de ListaAlumnos.vue
        component: () => import("pages/ListaAlumnos.vue"),
        // Cambia el path para evitar conflictos con la ruta de LoginPage.vue
      },
      {
        path: "/api/alumnos",
        component: () => import("pages/AlumnosAPI.vue"),
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
      // Otras rutas si son necesarias para tu aplicación
    ],
  },
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
