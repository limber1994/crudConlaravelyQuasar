<template>
  <div>
    <div class="q-pa-md q-gutter-sm text-center">
      <q-btn
        @click="agregarInstitucion"
        class="custom-add-button"
        icon="add"
        label="Agregar Institucion"
      />
    </div>
    <div class="search-container q-pa-md text-center">
      <q-input
        style="width: 300px"
        v-model="busqueda"
        outlined
        dense
        @input="filtrarUsuarios"
        placeholder="Buscar institucion"
        class="custom-search-input"
      />
    </div>
    <div class="q-pa-md">
      <q-table
        class="my-sticky-virtscroll-table"
        virtual-scroll
        flat
        bordered
        v-model:pagination="pagination"
        :rows-per-page-options="[0]"
        :virtual-scroll-sticky-size-start="48"
        row-key="id"
        :rows="instituciones"
        :columns="columns"
        dark
        color="amber"
        :filter="busqueda"
        ref="table"
      >
        <template v-slot:body-cell-foto="props">
          <q-td :props="props">
            <q-img
              v-if="props.row.foto && props.row.foto.length > 0"
              :src="props.row.foto"
              alt="Imagen de la institución"
              style="width: 50px; height: 50px; object-fit: cover"
            />
            <q-banner v-else icon="image" class="q-ma-md" color="warning">
              Sin imagen
            </q-banner>
          </q-td>
        </template>
        <template v-slot:body-cell-acciones="props">
          <div class="q-pa-md q-gutter-sm text-center">
            <q-btn
              @click="editarInstitucion(props.row.id)"
              square
              color="amber"
              icon="edit"
              class="q-ml-sm q-mr-sm"
            />
            <q-btn
              @click="confirmarEliminarInstitucion(props.row.id)"
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
export default {
  data() {
    return {
      instituciones: [],
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
          name: "direccion",
          required: true,
          label: "Direccion",
          align: "left",
          field: "direccion",
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
          name: "tipo",
          required: true,
          label: "Tipo",
          align: "left",
          field: "tipo",
          sortable: true,
        },
        {
          name: "turno",
          required: true,
          label: "Turno",
          align: "left",
          field: "turno",
          sortable: true,
        },
        {
          name: "vacante",
          required: true,
          label: "Vacante",
          align: "left",
          field: "vacante",
          sortable: true,
        },
        {
          name: "informacion",
          required: true,
          label: "Informacion",
          align: "left",
          field: "informacion",
          sortable: true,
        },
        {
          name: "foto",
          label: "Foto",
          align: "left",
          field: "foto",
          sortable: true,
        },
        {
          name: "mensualidad",
          required: true,
          label: "Mensualidad",
          align: "left",
          field: "mensualidad",
          sortable: true,
        },
        {
          name: "tipo_ins",
          required: true,
          label: "Tipo",
          align: "left",
          field: "tipo_ins",
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
    this.obtenerInstituciones(); // Llama a la función para obtener los alumnos al cargar la página
  },
  methods: {
    async obtenerInstituciones() {
      try {
        const response = await fetch(
          "http://143.198.50.189:8000/instituciones"
        );
        const data = await response.json();

        console.log("Datos de instituciones obtenidos:", data); // Verifica los datos obtenidos en la consola

        this.instituciones = data; // Asigna los datos a la variable 'alumnos'
      } catch (error) {
        console.error("Error al obtener los instituciones:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async agregarInstitucion() {
      this.$router.push({ name: "AgregarInstitucion" });
    },
    async editarInstitucion(id) {
      try {
        this.$router.push({ name: "editarInstitucion", params: { id: id } });
      } catch (error) {
        console.error("Error al editar el institucion:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async confirmarEliminarInstitucion(id) {
      try {
        const confirmacion = confirm(
          "¿Estás seguro de eliminar este institucion?"
        );
        if (confirmacion) {
          const response = await fetch(
            `http://143.198.50.189:8000/instituciones/eliminar/${id}`,
            {
              method: "DELETE",
            }
          );

          if (response.ok) {
            // Eliminación exitosa
            // Puedes actualizar la lista de alumnos después de eliminar
            await this.obtenerInstituciones();
            // O realizar cualquier otra acción necesaria después de la eliminación
          } else {
            // Manejar el error si la eliminación falla
            console.error("Error al intentar eliminar el institucion");
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
<style lang="scss">
.my-sticky-virtscroll-table {
  height: 410px; /* Ajusta la altura según tus necesidades */
}

.custom-add-button {
  background-color: #312d2d;
  color: white; /* Cambia el color del texto si es necesario */
}

.text-center {
  text-align: center;
}
.search-container {
  display: flex;
  justify-content: center;
  margin-bottom: 10px; /* Ajusta la separación entre el buscador y el contenido principal */
}

.search-input {
  font-size: 16px; /* Ajusta el tamaño de la fuente del buscador según tus preferencias */
}
</style>
