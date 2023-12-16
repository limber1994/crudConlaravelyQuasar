<template>
  <div>
    <h1>Lista de Alumnos</h1>
    <button @click="agregarAlumno">Agregar</button>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>email</th>
          <th>edad</th>
          <th>acciones</th>
          <!-- Agrega aquí más columnas si tienes más propiedades de alumno -->
        </tr>
      </thead>
      <tbody>
        <tr v-for="alumno in alumnos" :key="alumno.id">
          <td>{{ alumno.id }}</td>
          <td>{{ alumno.nombre }}</td>
          <td>{{ alumno.correo }}</td>
          <td>{{ alumno.edad }}</td>
          <td>
            <button @click="editarAlumno(alumno.id)">Editar</button>
            <button @click="confirmarEliminarAlumno(alumno.id)">
              Eliminar
            </button>
          </td>
          <!-- Agrega aquí más celdas si tienes más propiedades de alumno -->
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      alumnos: [], // Aquí se almacenarán los alumnos obtenidos de la API
    };
  },
  mounted() {
    this.obtenerAlumnos(); // Llama a la función para obtener los alumnos al cargar la página
  },
  methods: {
    async obtenerAlumnos() {
      try {
        const response = await fetch("http://127.0.0.1:8000/alumnos");
        const data = await response.json();

        console.log("Datos de alumnos obtenidos:", data); // Verifica los datos obtenidos en la consola

        this.alumnos = data; // Asigna los datos a la variable 'alumnos'
      } catch (error) {
        console.error("Error al obtener los alumnos:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async agregarAlumno() {
      this.$router.push({ name: "AgregarAlumno" });
    },
    async editarAlumno(id) {
      try {
        this.$router.push({ name: "editarAlumno", params: { id: id } });
      } catch (error) {
        console.error("Error al editar el alumno:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async confirmarEliminarAlumno(id) {
      try {
        const confirmacion = confirm("¿Estás seguro de eliminar este alumno?");
        if (confirmacion) {
          const response = await fetch(
            `http://127.0.0.1:8000/alumnos/eliminar/${id}`,
            {
              method: "DELETE",
            }
          );

          if (response.ok) {
            // Eliminación exitosa
            // Puedes actualizar la lista de alumnos después de eliminar
            await this.obtenerAlumnos();
            // O realizar cualquier otra acción necesaria después de la eliminación
          } else {
            // Manejar el error si la eliminación falla
            console.error("Error al intentar eliminar el alumno");
            // Mostrar un mensaje al usuario, ejecutar acciones necesarias, etc.
          }
        }
      } catch (error) {
        console.error("Error al confirmar la eliminación:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
  },
};
</script>

<style scoped>
/* Estilos específicos para la tabla de alumnos */
/* ... */
</style>
