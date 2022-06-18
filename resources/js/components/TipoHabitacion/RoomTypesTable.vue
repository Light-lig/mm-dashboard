<template>
  <div class="table-responsive">
    <table class="table table-striped table-hover mt-3">
      <thead>
        <tr>
          <th v-for="(header, index) in headers" :key="index">{{ header }}</th>
        </tr>
      </thead>
      <tbody v-if="data">
        <tr v-if="data.length == 0">
          <td :colspan="headers.length" class="text-center">
            No se encontraron registros por mostrar.
          </td>
        </tr>
        <tr v-for="(value, index) in data" :key="value.id_tipo_habitacion">
          <td>{{ index + 1 }}</td>
          <td>{{ value.tipo }}</td>
          <td>
            <a href="#" class="btn btn-warning" @click="edit(value.id_tipo_habitacion)"
              ><i class="fa fa-edit"></i> Editar</a
            >
            <a href="#" class="btn btn-danger" @click="deleteValue(value.id_tipo_habitacion)"
              ><i class="fa fa-trash"></i> Eliminar</a
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    headers: {
      type: Array,
      required: false,
      default: () => [],
    },
    data: {
      type: Array,
      required: true,
      default: () => [],
    },
  },
  mounted() {
    console.log("Table: ",this.data);
  },
  methods: {
    async deleteValue(id_tipo_habitacion) {
      this.$emit("delete", id_tipo_habitacion);
    },
    async edit(id_tipo_habitacion) {
      this.$emit("edit", id_tipo_habitacion);
    },
  },
};
</script>

<style>
</style>
