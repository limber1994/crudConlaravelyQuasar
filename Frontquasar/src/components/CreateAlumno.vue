<template>
  <div>
    <h2>Crear Nuevo Alumno</h2>
    <form @submit.prevent="crearAlumno">
      <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" v-model="alumno.nombre" />
      </div>
      <div>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" v-model.number="alumno.edad" />
      </div>
      <div>
        <label for="correo">Correo:</label>
        <input type="email" id="correo" v-model="alumno.correo" />
      </div>
      <button type="submit">Crear Alumno</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      alumno: {
        nombre: "",
        edad: null,
        correo: "",
      },
    };
  },
  methods: {
    async crearAlumno() {
      try {
        const response = await fetch("http://127.0.0.1:8000/alumnos", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.alumno),
        });

        if (!response.ok) {
          throw new Error("Error al crear el alumno");
        }

        // Limpiar el formulario después de la creación exitosa
        this.alumno = {
          nombre: "",
          edad: null,
          correo: "",
        };

        // Redirigir a la vista de listado de alumnos u otra acción
        // this.$router.push('/ruta-del-listado-de-alumnos');
      } catch (error) {
        console.error("Error al crear el alumno:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
  },
};
</script>

<style scoped>
/* Estilos específicos para el componente Create.vue */
</style>
