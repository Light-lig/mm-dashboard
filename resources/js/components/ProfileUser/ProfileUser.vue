<template>
    <div>
        <div class="container">
            <template v-if="!loading">
                <div class="row">
                    <h1>Mis Datos</h1>
                    <!-- Form -->
                    <div class="col-md-4 d-none">
                        <input
                            class="form-control"
                            type="text"
                            v-model="profile.usr_id"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Nombre:</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="profile.usr_nombre"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Apellidos:</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="profile.usr_apellido"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Correo:</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="profile.usr_correo"
                            disabled="true"
                        />
                    </div>
                     <div class="col-md-4 pt-3">
                        <label>Dui:</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="profile.usr_dui"
                        />
                    </div>
                     <div class="col-md-4 pt-3">
                        <label>Nit:</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="profile.usr_nit"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Direccion:</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="profile.usr_direccion"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Departamento</label>

                        <select
                            class="form-control"
                            v-model="de_id"
                             @change="onChange()" 
                            
                        >
                            <option disabled value="">
                                Seleccione un departamento
                            </option>
                            <option
                                v-for="su in department"
                                :key="su.dep_id"
                                :value="su.dep_id"
                            >
                                {{ su.dep_nombre }}
                            </option>
                        </select>
                    </div>

                     <div class="col-md-4 pt-3">
                        <label>Municipios</label>

                        <select
                            class="form-control"
                            v-model="profile.mun_id"
                            
                            
                        >
                            <option disabled :value="0">
                                Seleccione un Municipio
                            </option>
                            <option
                                v-for="su in municipios"
                                :key="su.mun_id"
                                :value="su.mun_id"
                            >
                                {{ su.mun_nombre }}
                            </option>
                        </select>
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
        <br />
        <ContraseniaVue  :id="profile.usr_id"/>
    </div>
</template>



<script>
import ui from "../../libs/ui.js";
// import PaginationLaravel from "laravel-vue-pagination";
import Swal from "sweetalert2";
import ContraseniaVue from './Contrasenia.vue'

export default {
    // components: { PaginationLaravel },
    data: () => {
        return {
            profile: {
                usr_id: "",
                usr_correo: "",
                mun_id: "",
                usr_dui: "",
                usr_nit: "",
                usr_direccion: "",
                usr_nombre: "",
                usr_apellido: "",
            },
            person: [],
            municipios: [],
            department: [],
            textButton: "Guardar",
            loading: false,
            pagination: {},
            de_id: ""
        };
    },
    mounted() {
        this.initialize();
    },
    methods: {
        async initialize() {
            this.loading = true;
            let res = await axios.get("api/user-profile");
            console.log(res);
            this.profile = res.data.perfil;
            this.department = res.data.departamento;
            this.municipios = res.data.municipios;
            this.loading = false;
            this.de_id = res.data.municipios.find((item) => item.mun_id === res.data.perfil.mun_id).dep_id;
        },
        async onChange() {
            this.profile.mun_id = "0";
            let response = await axios.get(`api/municipios/${this.de_id}`);
            this.municipios = response.data.municipios;
        },
        async save() {
            let res;
            res = await axios
                .put(`api/user-profile/${this.profile.usr_id}`, this.profile)
                .catch((e) => {
                ui.alert("Registro no pudo ser actualizado correctamente.", "error");
            });
            if (res.data.message == "success") {
                ui.alert("Registro modificado correctamente.");
                this.initialize();
            }
        },
        // async save() {
        //     let res;
        //     switch (this.textButton) {
        //         case "Guardar":
        //             res = await axios
        //                 .post("api/profile", this.profile)
        //                 .catch((e) => {
        //                     ui.alert(
        //                         "Registro no pudo ser guardado correctamente.",
        //                         "error"
        //                     );
        //                 });
        //             if (res.data.message == "success") {
        //                 this.profiles = res.data.profiles;
        //                 ui.alert("Registro creado correctamente.");
        //             }
        //             break;
        //         case "Modificar":
        //             res = await axios
        //                 .put(`api/profile/${this.profile.id}`, this.profile)
        //                 .catch((e) => {
        //                     ui.alert(
        //                         "Registro no pudo ser actualizado correctamente.",
        //                         "error"
        //                     );
        //                 });
        //             if (res.data.message == "success") {
        //                 ui.alert("Registro modificado correctamente.");
        //             }
        //             break;
        //     }
        //     this.initialize();
        //     this.cleanInputs();
        // },
        // edit(id) {
        //     this.profile = this.profiles.find((emp) => emp.id == id);
        //     this.textButton = "Modificar";
        // },
        // cleanInputs() {
        //     this.profile = {};
        //     this.textButton = "Guardar";
        // },
        // async getResults(page = 1) {
        //     const res = await axios.get(this.pagination.path + "?page=" + page);
        //     this.profiles = res.data.profiles;
        // },
    },
    components: { ContraseniaVue }
};
</script>

<style></style>
