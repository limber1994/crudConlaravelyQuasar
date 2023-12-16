<template>
  <div>
    <h1>Editar Alumno</h1>
    <form @submit.prevent="guardarCambios">
      <label>Nombre:</label>
      <input v-model="alumno.nombre" type="text" />
      <label>Email:</label>
      <input v-model="alumno.correo" type="text" />
      <label>Edad</label>
      <input v-model="alumno.edad" type="text" />
      <!-- Agrega más campos según los datos del alumno -->

      <button type="submit">Guardar</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      alumno: {},
    };
  },
  mounted() {
    this.obtenerAlumno();
  },
  methods: {
    async obtenerAlumno() {
      try {
        const id = this.$route.params.id;
        const response = await fetch(`http://127.0.0.1:8000/alumnos/${id}`);
        const data = await response.json();
        this.alumno = data;
      } catch (error) {
        console.error("Error al obtener el alumno:", error);
      }
    },
    async guardarCambios() {
      try {
        const id = this.$route.params.id;
        const response = await fetch(
          `http://127.0.0.1:8000/alumnos/update/${id}`,
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(this.alumno),
          }
        );

        if (response.ok) {
          console.log("Alumno actualizado correctamente");
        } else {
          console.error("Error al actualizar el alumno");
        }
      } catch (error) {
        console.error("Error al guardar los cambios:", error);
      }
    },
  },
};
</script>

<style scoped>
/* Estilos específicos para el formulario de edición */
/* ... */
</style>
