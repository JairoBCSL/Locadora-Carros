<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card de busca -->
                <card-component title="Busca de marcas">
                    <template v-slot:content>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <input-container-component
                                    id="inputId"
                                    label="ID"
                                    help="idHelp"
                                    help-text="Opcional. Informe o id da marca."
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
                            <div class="mb-3 col-6">
                                <input-container-component
                                    id="inputNome"
                                    label="Nome"
                                    help="nomeHelp"
                                    help-text="Opcional. Informe o nome da marca."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="inputNome"
                                            aria-describedby="nomeHelp"
                                            placeholder="Nome da marca"
                                            v-model="busca.nome"
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
                <card-component title="Relação de marcas">
                    <template v-slot:content>
                        <table-component
                            :data="marcas"
                            :titles="{
                                id: { title: 'ID', type: 'text' },
                                nome: { title: 'Nome', type: 'text' },
                                imagem: { title: 'Imagem', type: 'img' },
                            }"
                            :see="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalSeeMarca',
                            }"
                            :edit="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalEditMarca',
                            }"
                            :remove="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalRemoveMarca',
                            }"
                        ></table-component>
                    </template>
                    <template v-slot:footer>
                        <div class="row w-100">
                            <div class="col-10">
                                <paginate-component>
                                    <li
                                        v-for="(link, key) in marcas.links"
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
                            <div class="col d-flex align-items-center">
                                <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAddMarca"
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
        <modal-component id="modalAddMarca" title="Adicionar marca">
            <template v-slot:alert>
                <alert-component
                    v-if="transationDetails.type !== ''"
                    :details="transationDetails"
                ></alert-component>
            </template>
            <template v-slot:content>
                <div class="form-group">
                    <input-container-component
                        id="novoNome"
                        label="Nome"
                        help="nomeHelp"
                        help-text="Informe o nome da marca."
                    >
                        <template v-slot:content>
                            <input
                                type="text"
                                class="form-control"
                                id="novoNome"
                                aria-describedby="nomeHelp"
                                placeholder="Nome da marca"
                                v-model="form.nome"
                            />
                            <p v-if="transationDetails.errors.nome">
                                {{ transationDetails.errors.nome[0] }}
                            </p>
                        </template>
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component
                        id="formImagem"
                        label="Imagem"
                        help="novoImagemHelp"
                        help-text="Selecione uma imagem no formato png."
                    >
                        <template v-slot:content>
                            <input
                                type="file"
                                class="form-control"
                                id="formImagem"
                                aria-describedby="novoImagemHelp"
                                placeholder="Selecione uma imagem"
                                @change="carregarImagem($event)"
                            />
                            <p v-if="transationDetails.errors.imagem">
                                {{ transationDetails.errors.imagem[0] }}
                            </p>
                        </template>
                    </input-container-component>
                </div>
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
        <modal-component id="modalSeeMarca" title="Visulizar marca">
            <template v-slot:content>
                <input-container-component label="ID">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            :value="$store.state.item.id"
                        />
                    </template>
                </input-container-component>
                <input-container-component label="Nome">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            :value="$store.state.item.nome"
                        />
                    </template>
                </input-container-component>
                <div class="form-group">
                    <input-container-component id="formImagem" label="Imagem">
                        <template v-slot:content>
                            <img
                                :src="'/storage/' + $store.state.item.imagem"
                                width="30"
                            />
                        </template>
                    </input-container-component>
                </div>
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
        <modal-component id="modalEditMarca" title="Editar marca">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                <input-container-component label="ID">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            v-model="$store.state.item.id"
                        />
                    </template>
                </input-container-component>
                <input-container-component label="Nome">
                    <template v-slot:content>
                        <input
                            type="text"
                            class="form-control"
                            v-model="$store.state.item.nome"
                        />
                        <p v-if="transationDetails.errors.nome">
                            {{ transationDetails.errors.nome[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="editImagem"
                    label="Imagem"
                    help="editImagemHelp"
                    help-text="Selecione uma imagem no formato png."
                >
                    <template v-slot:content>
                        <input
                            type="file"
                            class="form-control"
                            id="editImagem"
                            aria-describedby="novoImagemHelp"
                            placeholder="Selecione uma imagem"
                            @change="carregarImagem($event)"
                        />
                        <p v-if="transationDetails.errors.imagem">
                            {{ transationDetails.errors.imagem[0] }}
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
        <modal-component id="modalRemoveMarca" title="Remover marca">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>

            <template v-slot:content>
                <input-container-component label="ID">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            :value="$store.state.item.id"
                        />
                    </template>
                </input-container-component>
                <input-container-component label="Nome">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            :value="$store.state.item.nome"
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
            urlBase: "http://localhost:8000/api/marca",
            transationDetails: {
                status: "",
                type: "",
                message: "",
                errors: "",
            },
            form: {
                id: "",
                nome: "",
                arquivoImagem: "",
            },
            marcas: { data: "" },
            busca: {
                id: "",
                nome: "",
            },
            urlFiltro: "",
            urlPagination: "",
        };
    },
    computed: {},
    methods: {
        add() {
            let formData = new FormData();
            formData.append("nome", this.form.nome);
            formData.append("imagem", this.form.arquivoImagem);

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
            //console.log("URL: ", url);
            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios.get(url, config).then((response) => {
                this.marcas = response.data;
                //console.log(this.marcas);
            });
        },
        edit() {
            let formData = new FormData();
            formData.append("_method", "patch");
            formData.append("nome", this.$store.state.item.nome);
            if (this.form.arquivoImagem) {
                formData.append("imagem", this.form.arquivoImagem);
            }

            let url = this.urlBase + "/" + this.$store.state.item.id;

            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios
                .post(url, formData, config)
                .then((response) => {
                    editImagem.value = "";
                    this.form.arquivoImagem = "";
                    this.$store.state.transation.status = "updated";
                    this.$store.state.transation.message =
                        "Registro atualizado com sucesso";
                    this.$store.state.transation.type = "primary";
                    this.carregar();
                })
                .catch((errors) => {
                    editImagem.value = "";
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
        limparCampos() {
            this.transationDetails.type = "";
            this.transationDetails.errors = [];
            console.log(this.transationDetails.errors);
            for (let i in this.form) this.form[i] = "";
            formImagem.value = "";
        },
        pesquisar() {
            this.urlFiltro = "";
            for (let key in this.busca) {
                if (this.busca[key] != "") {
                    this.urlPagination = "?page=1";
                    if (this.urlFiltro != "") {
                        this.urlFiltro += ";";
                    } else {
                        this.urlFiltro = "&filtro=";
                    }
                    if (key != "id")
                        this.urlFiltro +=
                            key + ":like:" + "%" + this.busca[key] + "%";
                    else this.urlFiltro += key + ":=:" + this.busca[key];
                }
            }
            this.carregar();
        },
        pagination(link) {
            this.urlPagination = "?" + link.url.split("?")[1];
            this.carregar();
        },
        carregarImagem(e) {
            this.form.arquivoImagem = e.target.files[0];
        },
    },
    mounted() {
        this.carregar();
    },
};
</script>
