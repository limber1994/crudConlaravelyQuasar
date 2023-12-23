<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="col-7">
          <div class="q-pa-md">
            <h6 class="text-center bg-dark border border-success text-white">
              Agregar Alumno
            </h6>
            <q-form
              @submit.prevent="agregarNuevoAlumno"
              @reset="resetForm"
              class="q-gutter-md"
            >
              <q-input
                filled
                v-model="nuevoAlumno.nombre"
                label="Nombre *"
                hint="Nombre y apellido"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />

              <q-input
                filled
                type="number"
                v-model="nuevoAlumno.edad"
                label="Edad *"
                lazy-rules
                :rules="[
                  (val) =>
                    (val !== null && val !== '') ||
                    'Por favor, ingresa tu edad',
                  (val) =>
                    (val > 0 && val < 100) ||
                    'Por favor, ingresa una edad real',
                ]"
              />

              <q-input
                filled
                v-model="nuevoAlumno.correo"
                label="Correo electrónico *"
                hint="example@example.com"
                lazy-rules
                :rules="[
                  (val) =>
                    /.+@.+\..+/.test(val) ||
                    'Por favor, ingresa un correo válido',
                ]"
              />

              <div>
                <q-btn
                  label="Guardar"
                  type="submit"
                  class="q-ml-sm custom-add-button"
                />
                <q-btn
                  label="Cancelar"
                  type="reset"
                  flat
                  class="q-ml-sm custom-add-button"
                  @click="cancelarAgregar"
                />
              </div>
            </q-form>
          </div>
        </q-card-section>
        <q-img
          class="col-5"
          src="https://previews.123rf.com/images/rawpixel/rawpixel1612/rawpixel161249228/67994301-aplicaci%C3%B3n-del-concepto-de-llenado-de-formulario-de-documento.jpg"
        />
      </q-card-section>
    </q-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nuevoAlumno: {
        nombre: null,
        edad: null,
        correo: null,
      },
    };
  },
  methods: {
    async agregarNuevoAlumno() {
      // Lógica para enviar datos al backend (adaptar según tu backend en Laravel)
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
      this.$router.push("/");
    },
    resetForm() {
      this.nuevoAlumno = {
        nombre: null,
        edad: null,
        correo: null,
      };
    },
  },
};
</script>

<style scoped>
.custom-add-button {
  background-color: #312d2d;
  color: white; /* Cambia el color del texto si es necesario */
}
.my-card {
  width: 100%;
  max-width: 1500px;
}
.custom-form-container {
  max-width: 1000px; /* Establece el ancho máximo en el contenedor */
}
</style>
