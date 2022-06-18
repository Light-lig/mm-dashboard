<template>
    <div>
        <div class="container">
            <template v-if="!loading">
                <div class="row">
                    <h1>Actualizar Contraseña</h1>
                    <!-- Form -->
                     <div class="col-md-4 d-none">
                        <input
                            class="form-control"
                            type="text"
                            v-model="profile.usr_id"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Nueva Contraseña:</label>
                        <input
                            class="form-control"
                            type="password"
                            v-model="profile.nuevaContra"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Repetir Nueva Contraseña:</label>
                        <input
                            class="form-control"
                            type="password"
                            v-model="profile.usr_password"
                        />
                    </div>
                    
                    
                   <div class="col-md-12 pt-3">
                        <a href="#" class="btn btn-success" @click="save()">
                            <i class="fa fa-save"></i> {{ textButton }}</a
                        >
                    </div>

                    <!-- Table -->
                  
                </div>
                <!-- <paginationLaravel
          :data="pagination"
          @pagination-change-page="getResults"
          :limit="1"
        ></paginationLaravel> -->
            </template>
            <!-- <template v-else>
                <alert />
            </template> -->
        </div>
    </div>
</template>



<script>
import ui from "../../libs/ui.js";
// import PaginationLaravel from "laravel-vue-pagination";
import Swal from "sweetalert2";

export default {
    props: {
    id: {
      type: String,
      required: true,
      default:  0,
    },
  },
    data: () => {
        return {
            profile: {
                nuevaContra:"",
                usr_password:"",
                usr_id:""
            },
           
           
            loading: false,
            textButton: "Guardar",
        };
    },

    mounted() {
        this.initialize();

      

    },

    methods: {
        async initialize() {
            this.loading = true;
            this.profile.nuevaContra = "";
            this.profile.usr_password = "";
            this.loading = false;
        },
        

       async save(){
            let res;
            this.profile.usr_id = this.id;
           if(this.profile.nuevaContra === this.profile.usr_password){

              
                 res = await axios
                .put(`api/modifyPassword/${this.id}`, this.profile)
                .catch((e) => {
                    ui.alert(
                        "Registro no pudo ser actualizado correctamente.",
                        "error"
                    );
                });
                if (res.data.message == "success") {
                ui.alert("Registro modificado correctamente.");
                this.initialize();
            }
           }else {
                ui.alert("Las contraseñas deben coincidir.","error");
           }     
       },
    },
};
</script>

<style></style>
