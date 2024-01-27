<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="col-7">
          <div class="q-pa-md">
            <h6 class="text-center bg-dark border border-success text-white">
              Agregar Usuario
            </h6>
            <q-form
              @submit.prevent="agregarNuevoUsuario"
              @reset="resetForm"
              class="q-gutter-md"
            >
              <q-input
                filled
                v-model="nuevoUsuario.nombre"
                label="Nombre *"
                hint="Nombre"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />

              <q-input
                filled
                v-model="nuevoUsuario.apellido"
                label="Apellido *"
                hint="Apellido"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />

              <q-input
                filled
                type="number"
                v-model="nuevoUsuario.telefono"
                label="Telefono *"
                lazy-rules
              />

              <q-input
                filled
                v-model="nuevoUsuario.email"
                label="Correo electrónico *"
                hint="example@example.com"
                lazy-rules
                :rules="[
                  (val) =>
                    /.+@.+\..+/.test(val) ||
                    'Por favor, ingresa un correo válido',
                ]"
              />

              <q-input
                filled
                type="password"
                v-model="nuevoUsuario.contrasenia"
                label="Contraseña *"
                lazy-rules
                :rules="[
                  (val) =>
                    (val && val.length >= 8) ||
                    'La contraseña debe tener al menos 8 caracteres',
                  (val) =>
                    /[A-Z]/.test(val) ||
                    'La contraseña debe contener al menos una letra mayúscula',
                  (val) =>
                    /\d/.test(val) ||
                    'La contraseña debe contener al menos un número',
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
      nuevoUsuario: {
        nombre: null,
        apellido: null,
        telefono: null,
        email: null,
        contrasenia: null,
      },
    };
  },
  methods: {
    async agregarNuevoUsuario() {
      // Lógica para enviar datos al backend (adaptar según tu backend en Laravel)
      console.log("Datos a enviar:", this.nuevoUsuario);
      try {
        const response = await fetch("http://127.0.0.1:8000/usuarios/nuevo", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.nuevoUsuario),
        });

        if (response.ok) {
          console.log("Usuario agregado exitosamente");
          this.$router.push("/usuarios");
        } else {
          const errorData = await response.json();
          throw new Error(errorData.message || "Error al agregar el usuario");
        }
      } catch (error) {
        console.error("Error al agregar el usuario:", error.message);
      }
    },
    cancelarAgregar() {
      this.$router.push("/usuarios");
    },
    resetForm() {
      this.nuevoUsuario = {
        nombre: null,
        apellido: null,
        telefono: null,
        email: null,
        contrasenia: null,
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
