<template>
  <div>
    <h1>Formulario para Agregar Alumno</h1>
    <form @submit.prevent="agregarNuevoAlumno">
      <input type="text" v-model="nuevoAlumno.nombre" placeholder="Nombre" />
      <input
        type="email"
        v-model="nuevoAlumno.correo"
        placeholder="Correo electrónico"
      />
      <input type="number" v-model="nuevoAlumno.edad" placeholder="Edad" />
      <button type="submit" class="btn-guardar">Guardar</button>
      <button @click="cancelarAgregar">Cancelar</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nuevoAlumno: {
        nombre: "",
        edad: null,
        correo: "",
      },
    };
  },
  methods: {
    async agregarNuevoAlumno() {
      console.log("Datos a enviar:", this.nuevoAlumno);
      try {
        const response = await fetch("http://127.0.0.1:8000/alumnos/nuevo", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.nuevoAlumno),
        });

        if (response.ok) {
          console.log("Alumno agregado exitosamente");
          this.$router.push("/");
        } else {
          const errorData = await response.json();
          throw new Error(errorData.message || "Error al agregar el alumno");
        }
      } catch (error) {
        console.error("Error al agregar el alumno:", error.message);
      }
    },

    cancelarAgregar() {
      this.$router.push({ name: "ListaAlumnos" });
    },
  },
};
</script>

<style scoped>
/* Estilos para el formulario */
/* Puedes añadir estilos aquí */
</style>
