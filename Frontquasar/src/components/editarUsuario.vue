<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="col-7">
          <div class="q-pa-md">
            <h6 class="text-center bg-dark border border-success text-white">
              Editar Usuario
            </h6>
            <q-form
              @submit.prevent="guardarCambios"
              @reset="resetForm"
              class="q-gutter-md"
            >
              <q-input
                filled
                v-model="usuario.nombre"
                label="Nombre *"
                hint="Nombre y apellido"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />

              <q-input
                filled
                v-model="usuario.apellido"
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
                v-model="usuario.telefono"
                label="Telefono *"
                lazy-rules
              />

              <q-input
                filled
                type="text"
                v-model="usuario.email"
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
                v-model="usuario.contrasenia"
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
      usuario: {
        nombre: null,
        apellido: null,
        telefono: null,
        email: null,
        contrasenia: null,
      },
    };
  },
  mounted() {
    this.obtenerUsuario();
  },
  methods: {
    async obtenerUsuario() {
      try {
        const id = this.$route.params.id;
        const response = await fetch(
          `http://143.198.50.189:8000/usuarios/${id}`
        );
        const data = await response.json();
        this.usuario = data;
      } catch (error) {
        console.error("Error al obtener el usuario:", error);
      }
    },
    async guardarCambios() {
      try {
        const id = this.$route.params.id;
        const response = await fetch(
          `http://143.198.50.189:8000/usuarios/update/${id}`,
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(this.usuario),
          }
        );

        if (response.ok) {
          console.log("Usuario actualizado correctamente");
          this.$router.push("/usuarios");
        } else {
          console.error("Error al actualizar el usuario");
        }
      } catch (error) {
        console.error("Error al guardar los cambios:", error);
      }
    },
    resetForm() {
      // Puedes añadir aquí la lógica de reinicio si lo necesitas
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
