<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th v-for="(title, key) in titles" :key="key" scope="col">
                    {{ title.title }}
                </th>
                <th v-if="see || edit || remove"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(obj, key) in filteredData" :key="key">
                <td v-for="(value, keyValue) in obj" :key="keyValue">
                    <span v-if="titles[keyValue].type == 'text'">{{
                        value
                    }}</span>
                    <span v-if="titles[keyValue].type == 'img'"
                        ><img :src="'/storage/' + value" width="30"
                    /></span>
                    <span v-if="titles[keyValue].type == 'date'">{{
                        $filters.formataDataTempo(value)
                    }}</span>
                    <span v-if="titles[keyValue].type == 'dateMySQL'">{{
                        $filters.formataDataTempoMySQL(value)
                    }}</span>
                </td>

                <td v-if="see.visivel || edit.visivel || remove.visivel">
                    <button
                        type="button"
                        v-if="(endLocacao ?? { visivel: false }).visivel"
                        :data-bs-toggle="endLocacao.dataToggle"
                        :data-bs-target="endLocacao.dataTarget"
                        @click="setStore(obj)"
                        class="btn btn-outline-secondary btn-sm"
                    >
                        Encerrar
                    </button>
                    <button
                        type="button"
                        v-if="(addSinistro ?? { visivel: false }).visivel"
                        :data-bs-toggle="addSinistro.dataToggle"
                        :data-bs-target="addSinistro.dataTarget"
                        @click="setStore(obj)"
                        class="btn btn-outline-warning btn-sm"
                    >
                        Sinistro
                    </button>
                    <button
                        type="button"
                        v-if="see.visivel"
                        :data-bs-toggle="see.dataToggle"
                        :data-bs-target="see.dataTarget"
                        @click="setStore(obj)"
                        class="btn btn-outline-primary btn-sm"
                    >
                        Visualizar
                    </button>
                    <button
                        type="button"
                        v-if="edit.visivel"
                        :data-bs-toggle="edit.dataToggle"
                        :data-bs-target="edit.dataTarget"
                        @click="setStore(obj)"
                        class="btn btn-outline-success btn-sm"
                    >
                        Editar
                    </button>
                    <button
                        type="button"
                        v-if="remove.visivel"
                        :data-bs-toggle="remove.dataToggle"
                        :data-bs-target="remove.dataTarget"
                        @click="setStore(obj)"
                        class="btn btn-outline-danger btn-sm"
                    >
                        Remover
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    d: "",
    props: [
        "endLocacao" ?? "",
        "addSinistro" ?? "",
        "data",
        "titles",
        "see",
        "edit",
        "remove",
    ],
    methods: {
        setStore(obj) {
            this.$store.state.transation = {
                status: "",
                type: "",
                message: "",
                errors: "",
            };
            this.$store.state.item = obj;
        },
    },
    computed: {
        dataFormatada() {
            if (this.d != "") {
                return this.d;
            }

            let d = this.d.split("T");

            let date = d[0];
            let time = d[1];

            console.log("Data: ", date);
            console.log("Tempo: ", time);

            return d + "---";
        },
        filteredData() {
            let fields = Object.keys(this.titles);

            let filteredData = [];
            if (this.data.data != "") {
                this.data.map((item, key) => {
                    let filteredItem = {};
                    fields.forEach((field) => {
                        filteredItem[field] = item[field];
                    });
                    filteredData.push(filteredItem);
                });
            }
            return filteredData;
        },
    },
};
</script>
