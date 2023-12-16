const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "/",
        component: () => import("pages/ListaAlumnos.vue"),
      }, // Ruta para mostrar la lista de alumnos
      {
        path: "/login",
        component: () => import("pages/LoginPage.vue"),
      },
      // Nueva ruta que apunta a la API de Laravel
      {
        path: "/api/alumnos", // Ruta de tu API de Laravel
        component: () => import("pages/AlumnosAPI.vue"), // Componente para acceder a la API de Laravel
      },
      {
        path: "/agregar-alumno",
        name: "AgregarAlumno",
        component: () => import("components/FormularioAgregarAlumno.vue"), // Reemplaza con la ruta de tu formulario
      },
      {
        path: "/editar-alumno/:id",
        name: "editarAlumno",
        component: () => import("components/editarAlumno.vue"), // Asegúrate de tener un componente para la edición
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
