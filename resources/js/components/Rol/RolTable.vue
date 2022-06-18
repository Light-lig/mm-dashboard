<template>
  <div class="table-responsive">
    <table class="table table-striped table-hover mt-3 shadow">
      <thead class="table-dark">
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
        <tr v-for="(value, index) in data" :key="value.id">
          <td>{{ index + 1 }}</td>
          <td>{{ value.name }}</td>
          <td>{{ value.created_at | formatDate }}</td>
          <td>{{ value.updated_at | formatDate }}</td>
          <!-- <td>{{ value.permissions }}</td> -->
          <td>
            <div v-if="value.permissions.length > 0"><span class="badge bg-primary m-1 fs-6" v-for="p in value.permissions" :key="p.id">{{p.name}}</span></div>
            <span class="badge bg-secondary m-1 fs-6" v-if="value.permissions.length == 0">Sin permisos asignados</span>
            </td>
          <td class="align-middle ">
            <div class="btn-group btn-btn-group-lg" role="group">
              <a href="#" class="btn btn-warning" @click="edit(value.id)"
              ><i class="fa fa-edit"></i></a
            >
            <a href="#" class="btn btn-danger" @click="deleteValue(value.id)"
              ><i class="fa fa-trash"></i></a
            >
            </div>
            
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import moment from 'moment'
import Vue from 'vue'

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm')
  }
});

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
        
  },
  methods: {
    async deleteValue(id) {
      this.$emit("delete", id);
    },
    async edit(id) {
      this.$emit("edit", id);
    },
  },
};
</script>

<style>
</style>
