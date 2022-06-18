<template>
  <div class="container mb-5 shadow-sm bg-white p-3">
    <h1 class="display-4">Accesos motel</h1>

    <div class="row ">
      <div
        class="col mx-2 px-2 py-3 bg-light border rounded"
        v-for="(lista, key) in motels"
        :key="key"
      >
        <h6>{{ key.split("-")[0] }} ✍</h6>
        <draggable
          v-if="key == 'usuarios'"
          class="draggable-list"
          :clone="handleClone"
          :list="lista"
          :options="availableItemOptions"
        >
          <div v-for="user in lista" :key="uuid(user)">
            <div class="bg-white mt-3 p-2 shadow-sm border rounded">
              <p>{{ user.usr_nombre }} {{ user.usr_apellido }}</p>
              <p>{{ user.usr_correo }}</p>
            </div>
          </div>
        </draggable>

        <draggable
          v-else
          class="draggable-list"
          :list="lista"
          :options="clonedItemOptions"
          @change="(item) => handleChage(item, key)"
        >
          <div v-for="user in lista" :key="uuid(user)">
            <div
              class="
                bg-white
                mt-3
                p-2
                shadow-sm
                border
                rounded
                position-relative
              "
            >
              <button
                type="button"
                @click="destroyElement(user, key)"
                class="btn-close position-absolute top-0 end-0"
                aria-label="Close"
              ></button>

              <p>{{ user.usr_nombre }} {{ user.usr_apellido }}</p>
              <p>{{ user.usr_correo }}</p>
            </div>
          </div>
        </draggable>
      </div>
    </div>
    <notifications position="bottom right" />
  </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
    components: {
        draggable,
    },
    data() {
        return {
            added: {},
            removed: {},
            remove: false,
            motels: {},
            clonedItemOptions: {
                group: "items",
            },

            availableItemOptions: {
                group: {
                    name: "items",
                    pull: "clone",
                    put: false,
                },
                sort: false,
            },
        };
    },
    mounted() {
        this.initialize();
    },

    methods: {
        handleClone(item) {
            // Create a fresh copy of item
            let cloneMe = JSON.parse(JSON.stringify(item));
            this.$delete(cloneMe, "uid");

            return cloneMe;
        },
        async handleChage(item, key) {
            if (item.added) {
                let itemAdd = item.added.element;
                itemAdd.molist = key;
                this.added = itemAdd;

                await this.addAccess(itemAdd, key);
            } else {
                let itemRemoved = item.removed.element;
                itemRemoved.molist = key;
                this.removed = itemRemoved;

                const self = this;
                setTimeout(async function () {
                    let remove = self.remove;
                    if (remove) {
                        let removedItem = self.removed;
                        await self.destroyElement(
                            removedItem,
                            removedItem.molist
                        );
                    } else {
                        let removedItem = self.removed;
                        self.motels[removedItem.molist].push(removedItem);
                        self.remove = false;
                    }
                }, 1000);
            }
        },
        async addAccess(item, key) {
            let usr_id = item.usr_id;
            let mo_id = key.split("-")[1];
            await axios
                .post("api/store-accesos", {
                    usr_id: usr_id,
                    mo_id: mo_id,
                })
                .then((response) => {
                    let { status, message } = response.data;

                    if (status == "failed") {
                        this.motels[key] = this.motels[key].filter(
                            (el) => el.uid !== item.uid
                        );
                        this.remove = false;
                        this.$notify({ type: "warn", text: message });
                    } else {
                        this.$notify(message);

                        this.remove = true;
                    }
                })
                .catch(function (error) {
                    this.$notify({
                        type: "error",
                        text: "Ocurrio un error interno.",
                    });
                });
        },
        async destroyElement(item, key) {
            let usr_id = item.usr_id;
            let mo_id = key.split("-")[1];
            await axios
                .post("api/destroy-accesos", {
                    usr_id: usr_id,
                    mo_id: mo_id,
                })
                .then((response) => {
                    let { status } = response.data;
                    if (status == "failed") {
                        let element = item;
                        this.motels[key].push(element);
                    } else {
                        this.$notify({
                            type: "success",
                            text: "Se eliminaron los permisos correctamente.",
                        });

                        this.remove = false;
                        this.motels[key] = this.motels[key].filter(
                            (el) => el.usr_id !== item.usr_id
                        );
                    }
                })
                .catch(function (error) {
                    this.$notify({
                        type: "error",
                        text: "Ocurrio un error interno.",
                    });
                });
        },
        uuid(e) {
            if (e.uid) return e.uid;

            const key = Math.random().toString(16).slice(2);
            this.$set(e, "uid", key);
            return e.uid;
        },

        async initialize() {
            await axios
                .get("api/usuarios-by-padre")
                .then((response) => {
                    const { status } = response.data;

                    if (status == "success") {
                        const { motels, accesos, users } = response.data;
                        const datos = { usuarios: [] };
                        motels.forEach((el) => {
                            let usuariosMotel = [];
                            accesos
                                .filter((ac) => ac.mo_id == el.mo_id)
                                .forEach((acceso) => {
                                    const found = {
                                        ...users.find(
                                            (usr) => usr.usr_id == acceso.usr_id
                                        ),
                                    };
                                    if (Object.keys(found).length > 0) {
                                        found.mo_id = el.mo_id;
                                        usuariosMotel.push(found);
                                    }
                                });
                            datos[`${el.mo_nombre}-${el.mo_id}`] =
                                usuariosMotel;
                        });
                        datos.usuarios = users;
                        this.motels = datos;
                    }
                })
                .catch(function (error) {
                    this.$notify({
                        type: "error",
                        text: "Ocurrio un error interno.",
                    });
                });
        },
    },
};
</script>

<style scoped>
h6 {
    font-weight: 700;
}
.col {
    height: 70vh;
    overflow: auto;
}
.draggable-list {
    min-height: 10vh;
}
.draggable-list > div {
    cursor: pointer;
}
</style>
