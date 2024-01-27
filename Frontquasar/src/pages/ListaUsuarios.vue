<template>
  <div class="lista-usuarios">
    <div class="action-buttons q-pa-md q-gutter-sm text-center">
      <q-btn
        @click="agregarUsuario"
        class="custom-add-button"
        icon="add"
        label="Agregar Usuario"
      />

      <reporteador-usuario></reporteador-usuario>
    </div>

    <div class="search-input q-pa-md text-center">
      <q-input
        v-model="busqueda"
        outlined
        dense
        @input="filtrarUsuarios"
        placeholder="Buscar usuario"
        class="custom-search-input"
      />
    </div>

    <div class="user-table q-pa-md">
      <q-table
        class="my-sticky-virtscroll-table"
        virtual-scroll
        flat
        bordered
        v-model:pagination="pagination"
        :rows-per-page-options="[0]"
        :virtual-scroll-sticky-size-start="48"
        row-key="id"
        :rows="usuarios"
        :columns="columns"
        dark
        color="amber"
        :filter="busqueda"
        ref="table"
      >
        <template v-slot:body-cell-acciones="props">
          <div class="q-pa-md q-gutter-sm text-center">
            <q-btn
              @click="editarUsuario(props.row.id)"
              square
              color="amber"
              icon="edit"
              class="q-ml-sm q-mr-sm"
            />
            <q-btn
              @click="confirmarEliminarUsuario(props.row.id)"
              square
              color="negative"
              icon="delete"
              class="q-ml-sm q-mr-sm"
            />
          </div>
        </template>
      </q-table>
    </div>
  </div>
</template>

<script>
import ReporteadorUsuario from "components/ReporteadorUsuario.vue";

export default {
  components: {
    ReporteadorUsuario,
  },
  data() {
    return {
      usuarios: [],
      columns: [
        {
          name: "id",
          required: true,
          label: "ID",
          align: "left",
          field: "id",
          sortable: true,
        },
        {
          name: "nombre",
          required: true,
          label: "Nombre",
          align: "left",
          field: "nombre",
          sortable: true,
        },
        {
          name: "apellido",
          required: true,
          label: "Apellido",
          align: "left",
          field: "apellido",
          sortable: true,
        },
        {
          name: "telefono",
          required: true,
          label: "Telefono",
          align: "left",
          field: "telefono",
          sortable: true,
        },
        {
          name: "email",
          required: true,
          label: "Correo",
          align: "left",
          field: "email",
          sortable: true,
        },
        {
          name: "contrasenia",
          required: true,
          label: "Contraseña",
          align: "left",
          field: "contrasenia",
          sortable: true,
        },
        {
          name: "acciones",
          label: "Acciones",
          align: "center",
          field: "acciones",
          sortable: false,
        },
      ],
      pagination: {
        rowsPerPage: 0,
      },
      busqueda: "",
    };
  },
  mounted() {
    this.obtenerUsuarios();
  },
  methods: {
    async obtenerUsuarios() {
      try {
        const response = await fetch("http://127.0.0.1:8000/usuarios");
        const data = await response.json();

        console.log("Datos de usuarios obtenidos:", data);

        this.usuarios = data;
      } catch (error) {
        console.error("Error al obtener los usuarios:", error);
      }
    },
    async agregarUsuario() {
      this.$router.push({ name: "AgregarUsuario" });
    },
    async editarUsuario(id) {
      try {
        this.$router.push({ name: "editarUsuario", params: { id: id } });
      } catch (error) {
        console.error("Error al editar el usuario:", error);
      }
    },
    async crearReporteador() {
      try {
        const response = await fetch("http://127.0.0.1:8000/usuarios/pdf");

        if (response.ok) {
          // Manejar la respuesta exitosa, por ejemplo, abrir el PDF en una nueva pestaña
          const blob = await response.blob();
          const url = window.URL.createObjectURL(blob);
          window.open(url, "_blank");
        } else {
          console.error("Error al generar el reporte de usuarios");
          // Manejar el error, mostrar mensaje al usuario, etc.
        }
      } catch (error) {
        console.error("Error al intentar generar el reporte:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async confirmarEliminarUsuario(id) {
      try {
        const confirmacion = confirm("¿Estás seguro de eliminar este usuario?");
        if (confirmacion) {
          const response = await fetch(
            `http://127.0.0.1:8000/usuarios/eliminar/${id}`,
            {
              method: "DELETE",
            }
          );

          if (response.ok) {
            await this.obtenerUsuarios();
          } else {
            console.error("Error al intentar eliminar el usuario");
          }
        }
      } catch (error) {
        console.error("Error al confirmar la eliminación:", error);
      }
    },
    filtrarUsuarios() {
      this.$refs.table.filter(this.busqueda);
    },
  },
};
</script>

<style lang="scss">
.my-sticky-virtscroll-table {
  height: 410px;
}
.custom-add-button {
  background-color: #312d2d;
  color: white;
}

.custom-search-input {
  width: 200px; /* Ajusta el ancho según tus necesidades */
  margin-top: 5px;
}

.text-center {
  text-align: center;
}
.lista-usuarios {
  max-width: 1200px;
  margin: 0 auto;
}

.action-buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
}

.search-input {
  margin-top: -40px;
}

.user-table {
  margin-top: 10px;
}

.lista-usuarios {
  max-width: 1400px;
  margin: 0 auto;
}

.action-buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px; /* Reducido el espacio entre botones */
}

.search-input {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 10px; /* Ajusta según sea necesario */
}

.custom-search-input {
  width: 300px; /* Ancho del buscador según tus necesidades */
  border-radius: 20px; /* Bordes redondeados */
}

.custom-search-input input {
  padding: 10px; /* Espaciado interno del input */
  font-size: 14px; /* Tamaño de fuente */
  border-radius: 20px; /* Bordes redondeados */
}
</style>
