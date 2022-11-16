<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card de busca -->
                <card-component title="Busca de carros">
                    <template v-slot:content>
                        <div class="row">
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputId"
                                    label="ID"
                                    help="idHelp"
                                    help-text="Opcional. Informe o id do carro."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="inputId"
                                            aria-describedby="idHelp"
                                            placeholder="ID"
                                            v-model="busca.id"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="selectModelo"
                                    label="Modelo"
                                    help="modeloHelp"
                                    help-text="Opcional. Informe a modelo do carro."
                                >
                                    <template v-slot:content>
                                        <div class="input-group">
                                            <select
                                                class="form-control"
                                                id="selectMoelo"
                                                v-model="busca.modelo_id"
                                            >
                                                <option
                                                    value=""
                                                    class="disabled"
                                                >
                                                    Selecione um modelo
                                                </option>
                                                <option
                                                    v-for="(
                                                        modelo, index
                                                    ) in modelos"
                                                    :key="index"
                                                    :value="modelo.id"
                                                >
                                                    {{ modelo.nome }}
                                                </option>
                                            </select>
                                        </div>
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputPlaca"
                                    label="Placa"
                                    help="placaHelp"
                                    help-text="Opcional. Informe o placa do carro."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="inputPlaca"
                                            aria-describedby="placaHelp"
                                            placeholder="Placa do carro"
                                            v-model="busca.placa"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    help="disponivelHelp"
                                    help-text="Opcional. Informe se o carro está disponivel."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="checkbox"
                                            class="ms-2 form-input-check"
                                            id="inputDisponivel"
                                            aria-describedby="disponivelHelp"
                                            name="radioDisponivel"
                                            v-model="form.yes_disponivel"
                                            @change="
                                                this.form.no_disponivel = false;
                                                onDisponivel();
                                            "
                                            autocomplete="off"
                                            checked
                                        /><label for="inputDisponivel"
                                            >&nbsp;&nbsp;Disponível</label
                                        ><br />
                                        <input
                                            type="checkbox"
                                            class="ms-2 form-input-check"
                                            id="inputIndisponivel"
                                            aria-describedby="disponivelHelp"
                                            name="rad1ioDisponivel"
                                            v-model="form.no_disponivel"
                                            @change="
                                                this.form.yes_disponivel = false;
                                                onDisponivel();
                                            "
                                            autocomplete="off"
                                        /><label for="inputindisponivel">
                                            &nbsp;&nbsp;Indisponível</label
                                        ><br />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputMinKm"
                                    label="Kilometragem mínima"
                                    help="minKmHelp"
                                    help-text="Opcional. Informe a kilometragem mínima."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="inputMinKm"
                                            aria-describedby="minKmHelp"
                                            placeholder="Kilometragem mínima"
                                            v-model="busca.minKm"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputMaxKm"
                                    label="Kilometragem máxima"
                                    help="maxKmHelp"
                                    help-text="Opcional. Informe a kilometragem máxima."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="inputMaxKm"
                                            aria-describedby="maxKmHelp"
                                            placeholder="Kilometragem máxima"
                                            v-model="busca.maxKm"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:footer>
                        <button
                            type="submit"
                            class="btn btn-primary btn-sm float-right"
                            @click="pesquisar()"
                        >
                            Pesquisar
                        </button>
                    </template>
                </card-component>
                <!-- Card de busca -->
                <!-- Card de relação -->
                <card-component title="Relação de Carros">
                    <template v-slot:content>
                        <table-component
                            :data="carros"
                            :titles="{
                                id: { title: 'ID', type: 'text' },
                                modelo_id: {
                                    title: 'Modelo',
                                    type: 'text',
                                },
                                placa: { title: 'Placa', type: 'text' },
                                disponivel: {
                                    title: 'Disponível',
                                    type: 'text',
                                },
                                km: { title: 'Kilometragem', type: 'text' },
                            }"
                            :see="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalSeeCarro',
                            }"
                            :edit="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalEditCarro',
                            }"
                            :remove="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalRemoveCarro',
                            }"
                        ></table-component>
                    </template>
                    <template v-slot:footer>
                        <div class="row w-100">
                            <div class="col-10">
                                <paginate-component>
                                    <li
                                        v-for="(link, key) in carros.links"
                                        :key="key"
                                        :class="
                                            link.active
                                                ? 'page-item active'
                                                : 'page-item'
                                        "
                                        @click="pagination(link)"
                                    >
                                        <a
                                            class="page-link"
                                            v-html="link.label"
                                        ></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAddCarro"
                                    class="btn btn-primary btn-sm float-right"
                                    @click="limparCampos()"
                                >
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- Card de relação -->
            </div>
        </div>
        <!-- Modal de adição-->
        <modal-component id="modalAddCarro" title="Adicionar carro">
            <template v-slot:alert>
                <alert-component
                    v-if="transationDetails.type !== ''"
                    :details="transationDetails"
                ></alert-component>
            </template>
            <template v-slot:content>
                <input-container-component
                    id="novoModelo"
                    label="Modelo"
                    help="modeloHelp"
                    help-text="Informe o modelo do carro."
                >
                    <template v-slot:content>
                        <select
                            class="form-control"
                            id="novoModelo"
                            aria-describedby="modeloHelp"
                            v-model="form.modelo_id"
                        >
                            <option disabled value="">
                                --- Selecione um modelo ---
                            </option>
                            <option
                                v-for="(modelo, index) in modelos"
                                :key="index"
                                :value="modelo.id"
                            >
                                {{ modelo.nome }}
                            </option>
                        </select>
                        <p v-if="transationDetails.errors.modelo_id">
                            {{ transationDetails.errors.modelo_id[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="novoPlaca"
                    label="Placa"
                    help="placaHelp"
                    help-text="Informe a placa do carro."
                >
                    <template v-slot:content>
                        <input
                            type="text"
                            class="form-control"
                            id="novoPlaca"
                            aria-describedby="placaHelp"
                            placeholder="Placa do carro"
                            v-model="form.placa"
                        />
                        <p v-if="transationDetails.errors.placa">
                            {{ transationDetails.errors.placa[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="novoDisponivel"
                    label="Disponível"
                    help="disponivelHelp"
                    help-text="Opcional. Informe se o carro está disponível."
                >
                    <template v-slot:content>
                        <input
                            type="checkbox"
                            class="ms-2 form-input-check"
                            id="novoDisponivel"
                            aria-describedby="disponivelHelp"
                            v-model="form.disponivel"
                        />
                        <p v-if="transationDetails.errors.disponivel">
                            {{ transationDetails.errors.disponivel[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="novoKm"
                    label="Kilometragem"
                    help="kmHelp"
                    help-text="Opcional. Informe a kilometragem do carro."
                >
                    <template v-slot:content>
                        <input
                            type="number"
                            class="form-control"
                            id="novoKm"
                            aria-describedby="kmHelp"
                            placeholder="0"
                            v-model="form.km"
                        />
                        <p v-if="transationDetails.errors.km">
                            {{ transationDetails.errors.km[0] }}
                        </p>
                    </template>
                </input-container-component>
            </template>
            <template v-slot:footer>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>
                <button type="button" class="btn btn-primary" @click="add()">
                    Adicionar
                </button>
            </template>
        </modal-component>
        <!-- Modal de adição-->
        <!-- Modal de visualização-->
        <modal-component id="modalSeeCarro" title="Visualizar carro">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                <input-container-component id="seeModelo" label="Modelo">
                    <template v-slot:content>
                        <select
                            disabled
                            class="form-control"
                            id="seeModelo"
                            aria-describedby="modeloHelp"
                            v-model="$store.state.item.modelo_id"
                        >
                            <option value="" disabled>
                                --- Selecione um modelo ---
                            </option>
                            <option
                                v-for="(modelo, index) in modelos"
                                :key="index"
                                :value="modelo.id"
                            >
                                {{ modelo.nome }}
                            </option>
                        </select>
                    </template>
                </input-container-component>
                <input-container-component id="seePlaca" label="Placa">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            id="seePlaca"
                            aria-describedby="placaHelp"
                            placeholder="Placa do carro"
                            v-model="$store.state.item.placa"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeDisponivel"
                    label="Disponível"
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="checkbox"
                            class="ms-2 form-input-check"
                            id="seeDisponivel"
                            aria-describedby="disponivelHelp"
                            v-model="$store.state.item.disponivel"
                        />
                    </template>
                </input-container-component>
                <input-container-component id="seeKm" label="Kilometragem">
                    <template v-slot:content>
                        <input
                            disabled
                            type="number"
                            class="form-control"
                            id="seeKm"
                            aria-describedby="kmHelp"
                            v-model="$store.state.item.km"
                        />
                    </template>
                </input-container-component>
            </template>
            <template v-slot:footer>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>
            </template>
        </modal-component>
        <!-- Modal de visualização-->
        <!-- Modal de edição-->
        <modal-component id="modalEditCarro" title="Editar carro">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                {{ $store.state.item }}
                <input-container-component
                    id="editModelo"
                    label="Modelo"
                    help="modeloHelp"
                    help-text="Informe o modelo do carro."
                >
                    <template v-slot:content>
                        <select
                            class="form-control"
                            id="editModelo"
                            aria-describedby="modeloHelp"
                            v-model="$store.state.item.modelo_id"
                        >
                            <option value="" disabled>
                                --- Selecione um modelo ---
                            </option>
                            <option
                                v-for="(modelo, index) in modelos"
                                :key="index"
                                :value="modelo.id"
                            >
                                {{ modelo.nome }}
                            </option>
                        </select>
                        <p v-if="transationDetails.errors.modelo_id">
                            {{ transationDetails.errors.modelo_id[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="editPlaca"
                    label="Placa"
                    help="placaHelp"
                    help-text="Informe a placa do carro."
                >
                    <template v-slot:content>
                        <input
                            type="text"
                            class="form-control"
                            id="editPlaca"
                            aria-describedby="placaHelp"
                            placeholder="Placa do carro"
                            v-model="$store.state.item.placa"
                        />
                        <p v-if="transationDetails.errors.placa">
                            {{ transationDetails.errors.placa[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeDisponivel"
                    label="Disponível"
                    help="disponivelHelp"
                    help-text="Opcional. Informe se o carro está disponível."
                >
                    <template v-slot:content>
                        <input
                            type="checkbox"
                            class="ms-2 form-input-check"
                            id="seeDisponivel"
                            aria-describedby="disponivelHelp"
                            placeholder="Nome do modelo"
                            v-model="$store.state.item.disponivel"
                        />
                        <p v-if="transationDetails.errors.disponivel">
                            {{ transationDetails.errors.disponivel[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeKm"
                    label="Kilometragem"
                    help="kmHelp"
                    help-text="Opcional. Informe a kilometragem do carro."
                >
                    <template v-slot:content>
                        <input
                            type="number"
                            class="form-control"
                            id="seeKm"
                            aria-describedby="kmHelp"
                            placeholder="0"
                            v-model="$store.state.item.km"
                        />
                        <p v-if="transationDetails.errors.km">
                            {{ transationDetails.errors.km[0] }}
                        </p>
                    </template>
                </input-container-component>
            </template>
            <template v-slot:footer>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>
                <button type="button" class="btn btn-primary" @click="edit()">
                    Editar
                </button>
            </template>
        </modal-component>
        <!-- Modal de edição-->
        <!-- Modal de remoção-->
        <modal-component id="modalRemoveCarro" title="Remover carro">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                <input-container-component id="seeModelo" label="Modelo">
                    <template v-slot:content>
                        <select
                            disabled
                            class="form-control"
                            id="seeModelo"
                            aria-describedby="modeloHelp"
                            v-model="$store.state.item.modelo_id"
                        >
                            <option value="" disabled>
                                --- Selecione um modelo ---
                            </option>
                            <option
                                v-for="(modelo, index) in modelos"
                                :key="index"
                                :value="modelo.id"
                            >
                                {{ modelo.nome }}
                            </option>
                        </select>
                    </template>
                </input-container-component>
                <input-container-component id="seePlaca" label="Placa">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            id="seePlaca"
                            aria-describedby="placaHelp"
                            placeholder="Placa do carro"
                            v-model="$store.state.item.placa"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeDisponivel"
                    label="Disponível"
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="checkbox"
                            class="ms-2 form-input-check"
                            id="seeDisponivel"
                            aria-describedby="disponivelHelp"
                            v-model="$store.state.item.disponivel"
                        />
                    </template>
                </input-container-component>
                <input-container-component id="seeKm" label="Kilometragem">
                    <template v-slot:content>
                        <input
                            disabled
                            type="number"
                            class="form-control"
                            id="seeKm"
                            aria-describedby="kmHelp"
                            v-model="$store.state.item.km"
                        />
                    </template>
                </input-container-component>
            </template>
            <template v-slot:footer>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>
                <button type="button" class="btn btn-danger" @click="remove()">
                    Remover
                </button>
            </template>
        </modal-component>
        <!-- Modal de remoção-->
    </div>
</template>

<script>
export default {
    props: ["csrf_token"],
    data() {
        return {
            urlBase: "http://localhost:8000/api/carro",
            urlModelo: "http://localhost:8000/api/modelo",
            transationDetails: {
                status: "",
                type: "",
                message: "",
                errors: "",
            },
            modelos: [],
            carros: { data: "" },
            form: {
                modelo_id: "",
                placa: "",
                yes_disponivel: "",
                no_disponivel: "",
                disponivel: "",
                km: "",
            },
            busca: {
                id: "",
                modelo_id: "",
                placa: "",
                disponivel: "",
                minKm: "",
                maxKm: "",
            },
            urlFiltro: "",
            urlPagination: "",
        };
    },
    computed: {},
    methods: {
        add() {
            let checked = false;
            let formData = new FormData();

            formData.append("modelo_id", this.form.modelo_id);
            formData.append("placa", this.form.placa);
            checked = this.form.disponivel == true ? 1 : 0;
            formData.append("disponivel", checked);
            formData.append("km", this.form.km);

            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios
                .post(this.urlBase, formData, config)
                .then((response) => {
                    this.transationDetails.status = "added";
                    this.transationDetails.type = "success";
                    this.transationDetails.message =
                        "Registro " +
                        response.data.id +
                        " adicionado com sucesso.";
                    this.transationDetails.errors = "";
                    this.carregar();
                })
                .catch((errors) => {
                    this.transationDetails.status = "error";
                    this.transationDetails.type = "danger";
                    this.transationDetails.message =
                        "Erro ao adicionar registro.";
                    this.transationDetails.errors = errors.response.data.errors;
                });
        },
        carregar() {
            let url = this.urlBase + this.urlPagination + this.urlFiltro;
            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };
            axios.get(url, config).then((response) => {
                this.carros = response.data;
                this.carros.map((carro, key) => {
                    this.carros[key].disponivel =
                        carro.disponivel == 1 ? true : false;
                });
            });

            axios.get(this.urlModelo, config).then((response) => {
                this.modelos = response.data;
            });
        },
        edit() {
            let checked = false;
            let formData = new FormData();
            formData.append("_method", "patch");
            if (this.$store.state.item.modelo_id)
                formData.append("modelo_id", this.$store.state.item.modelo_id);
            if (this.$store.state.item.placa) {
                formData.append("imagem", this.$store.state.item.placa);
            }
            checked = this.$store.state.item.disponivel == true ? 1 : 0;
            formData.append("disponivel", checked);
            if (this.$store.state.item.km !== null)
                formData.append("km", this.$store.state.item.km);

            let url = this.urlBase + "/" + this.$store.state.item.id;

            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios
                .post(url, formData, config)
                .then((response) => {
                    this.$store.state.transation.status = "updated";
                    this.$store.state.transation.message =
                        "Registro atualizado com sucesso";
                    this.$store.state.transation.type = "primary";
                    this.carregar();
                })
                .catch((errors) => {
                    this.$store.state.transation.status = "error";
                    this.$store.state.transation.message =
                        "Erro ao atualizar o registro";
                    this.$store.state.transation.type = "danger";
                    this.$store.state.transation.errors = Object.values(
                        errors.response.data.errors
                    );
                });
        },
        remove() {
            let confirma = confirm(
                "Tem certeza que deseja remover esse registro?"
            );

            if (!confirma) {
                return false;
            }

            let url = this.urlBase + "/" + this.$store.state.item.id;

            let formData = new FormData();
            formData.append("_method", "delete");

            axios
                .post(url, formData)
                .then((response) => {
                    this.$store.state.transation.status = "deleted";
                    this.$store.state.transation.message =
                        "Registro removido com sucesso";
                    this.$store.state.transation.type = "success";
                    this.urlPagination = "?page=1";
                    this.carregar();
                })
                .catch((errors) => {
                    this.$store.state.transation.status = "error";
                    this.$store.state.transation.message =
                        "Erro ao remover registro";
                    this.$store.state.transation.type = "danger";
                    this.$store.state.transation.errors = [
                        [errors.response.data.error],
                    ];
                });
        },
        pesquisar() {
            this.urlFiltro = "";
            for (let key in this.busca) {
                if (this.busca[key] !== "") {
                    this.urlPagination = "?page=1";
                    if (this.urlFiltro != "") {
                        this.urlFiltro += ";";
                    } else {
                        this.urlFiltro = "&filtro=";
                    }
                    if (this.busca[key] === true) this.busca[key] = 1;
                    if (this.busca[key] === false) this.busca[key] = 0;
                    if (key.includes("min"))
                        this.urlFiltro +=
                            key.replace("min", "") + ":>=:" + this.busca[key];
                    else if (key.includes("max"))
                        this.urlFiltro +=
                            key.replace("max", "") + ":<=:" + this.busca[key];
                    else if (key != "id")
                        this.urlFiltro +=
                            key + ":like:" + "%25" + this.busca[key] + "%25";
                    else this.urlFiltro += key + ":=:" + this.busca[key];
                }
            }
            this.carregar();
        },
        pagination(link) {
            this.urlPagination = "?" + link.url.split("?")[1];
            this.carregar();
        },
        onDisponivel() {
            this.busca.disponivel =
                this.form.yes_disponivel && !this.form.no_disponivel;
            this.busca.disponivel =
                this.form.yes_disponivel ^ this.form.no_disponivel
                    ? this.busca.disponivel
                    : "";
        },
        limparCampos() {
            this.transationDetails.type = "";
            for (let i in this.form) this.form[i] = "";
        },
    },
    mounted() {
        this.carregar();
    },
};
</script>
