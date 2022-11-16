<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card de busca -->
                <card-component title="Busca de modelos">
                    <template v-slot:content>
                        <div class="row">
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputId"
                                    label="ID"
                                    help="idHelp"
                                    help-text="Opcional. Informe o id do modelo."
                                >
                                    <template v-slot:content>
                                        <p>&larr;</p>
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
                                    id="selectMarca"
                                    label="Marca"
                                    help="marcaHelp"
                                    help-text="Opcional. Informe a marca do modelo."
                                >
                                    <template v-slot:content>
                                        <div class="input-group">
                                            <select
                                                class="form-control"
                                                id="selectMarca"
                                                v-model="busca.marca_id"
                                            >
                                                <option
                                                    value=""
                                                    class="disabled"
                                                >
                                                    Selecione uma marca
                                                </option>
                                                <option
                                                    v-for="(
                                                        marca, index
                                                    ) in marcas"
                                                    :key="index"
                                                    :value="marca.id"
                                                >
                                                    {{ marca.nome }}
                                                </option>
                                            </select>
                                        </div>
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputNome"
                                    label="Nome"
                                    help="nomeHelp"
                                    help-text="Opcional. Informe o nome do modelo."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="inputNome"
                                            aria-describedby="nomeHelp"
                                            placeholder="Nome do modelo"
                                            v-model="busca.nome"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputNumeroPortas"
                                    label="Números de Portas"
                                    help="numeroPortasHelp"
                                    help-text="Opcional. Informe o números de portas do modelo."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="inputNinputNumeroPortasome"
                                            aria-describedby="númeroPortasHelp"
                                            placeholder="Número de portas"
                                            v-model="busca.numero_portas"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputLugares"
                                    label="Números de lugares"
                                    help="lugaresHelp"
                                    help-text="Opcional. Informe o número de lugares do modelo."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="inputLugares"
                                            aria-describedby="lugaresHelp"
                                            placeholder="Número de lugares"
                                            v-model="busca.lugares"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputAirBag"
                                    label="Air-bag"
                                    help="airBagHelp"
                                    help-text="Opcional. Informe se o modelo possui Abs."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="checkbox"
                                            class="ms-2 form-input-check"
                                            id="inputAirBag"
                                            aria-describedby="airBagHelp"
                                            name="radioAirBag"
                                            v-model="form.yes_air_bag"
                                            @change="
                                                this.form.no_air_bag = false;
                                                onAirBag();
                                            "
                                            autocomplete="off"
                                            checked
                                        /><label for="inputAirBag"
                                            >&nbsp;&nbsp;Possui Air-bag</label
                                        ><br />
                                        <input
                                            type="checkbox"
                                            class="ms-2 form-input-check"
                                            id="inputNoAirBag"
                                            aria-describedby="noAirBagHelp"
                                            name="radionoAirBag"
                                            v-model="form.no_air_bag"
                                            @change="
                                                this.form.yes_air_bag = false;
                                                onAirBag();
                                            "
                                            autocomplete="off"
                                        /><label for="inputNoAirBag">
                                            &nbsp;&nbsp;Não possui
                                            Air-bag</label
                                        ><br />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputNome"
                                    label="Nome"
                                    help="nomeHelp"
                                    help-text="Opcional. Informe o nome do modelo."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="checkbox"
                                            class="ms-2 form-input-check"
                                            id="inputAbs"
                                            aria-describedby="absHelp"
                                            name="radioAbs"
                                            v-model="form.yes_abs"
                                            @change="
                                                this.form.no_abs = false;
                                                onAbs();
                                            "
                                            autocomplete="off"
                                            checked
                                        /><label for="inputAbs"
                                            >&nbsp;&nbsp;Possui Abs</label
                                        ><br />
                                        <input
                                            type="checkbox"
                                            class="ms-2 form-input-check"
                                            id="inputNoAbs"
                                            aria-describedby="noAbsHelp"
                                            name="radionoAbs"
                                            v-model="form.no_abs"
                                            @change="
                                                this.form.yes_abs = false;
                                                onAbs();
                                            "
                                            autocomplete="off"
                                        /><label for="inputNoAbs">
                                            &nbsp;&nbsp;Não possui Abs</label
                                        ><br />
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
                <card-component title="Relação de modelos">
                    <template v-slot:content>
                        <table-component
                            :data="modelos"
                            :titles="{
                                id: { title: 'ID', type: 'text' },
                                marca_id: { title: 'Marca', type: 'text' },
                                nome: { title: 'Nome', type: 'text' },
                                imagem: { title: 'Imagem', type: 'img' },
                                numero_portas: {
                                    title: 'Número de portas',
                                    type: 'text',
                                },
                                lugares: {
                                    title: 'Número de lugares',
                                    type: 'text',
                                },
                                air_bag: { title: 'Air-bag', type: 'text' },
                                abs: { title: 'Abs', type: 'text' },
                            }"
                            :see="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalSeeModelo',
                            }"
                            :edit="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalEditModelo',
                            }"
                            :remove="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalRemoveModelo',
                            }"
                        ></table-component>
                    </template>
                    <template v-slot:footer>
                        <div class="row w-100">
                            <div class="col-10">
                                <paginate-component>
                                    <li
                                        v-for="(link, key) in modelos.links"
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
                                    data-bs-target="#modalAddModelo"
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
        <modal-component id="modalAddModelo" title="Adicionar modelo">
            <template v-slot:alert>
                <alert-component
                    v-if="transationDetails.type !== ''"
                    :details="transationDetails"
                ></alert-component>
            </template>
            <template v-slot:content>
                <input-container-component
                    id="novoMarca"
                    label="Marca"
                    help="marcaHelp"
                    help-text="Informe a marca do modelo."
                >
                    <template v-slot:content>
                        <select
                            class="form-control"
                            id="novoMarca"
                            aria-describedby="marcaHelp"
                            v-model="form.marca_id"
                        >
                            <option disabled value="">
                                --- Selecione uma marca ---
                            </option>
                            <option
                                v-for="(marca, index) in marcas"
                                :key="index"
                                :value="marca.id"
                            >
                                {{ marca.nome }}
                            </option>
                        </select>
                        <p v-if="transationDetails.errors.marca_id">
                            {{ transationDetails.errors.marca_id[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="novoNome"
                    label="Nome"
                    help="nomeHelp"
                    help-text="Informe o nome do modelo."
                >
                    <template v-slot:content>
                        <input
                            type="text"
                            class="form-control"
                            id="novoNome"
                            aria-describedby="nomeHelp"
                            placeholder="Nome do modelo"
                            v-model="form.nome"
                        />
                        <p v-if="transationDetails.errors.nome">
                            {{ transationDetails.errors.nome[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="novoNumeroPortas"
                    label="Número de portas"
                    help="numeroPortasHelp"
                    help-text="Opcional. Informe o número de portas do modelo."
                >
                    <template v-slot:content>
                        <input
                            type="number"
                            class="form-control"
                            id="novoNumeroPortas"
                            aria-describedby="numeroPortasHelp"
                            placeholder="4"
                            v-model="form.numero_portas"
                        />
                        <p v-if="transationDetails.errors.numero_portas">
                            {{ transationDetails.errors.numero_portas[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="novoLugares"
                    label="Número de lugares"
                    help="lugaresHelp"
                    help-text="Opcional. Informe o número de lugares do modelo."
                >
                    <template v-slot:content>
                        <input
                            type="number"
                            class="form-control"
                            id="novoLugares"
                            aria-describedby="lugaresHelp"
                            placeholder="4"
                            v-model="form.lugares"
                        />
                        <p v-if="transationDetails.errors.lugares">
                            {{ transationDetails.errors.lugares[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="novoAirbBg"
                    label="Air-bag"
                    help="airBagHelp"
                    help-text="Opcional. Informe se o modelo possui airbag."
                >
                    <template v-slot:content>
                        <input
                            type="checkbox"
                            class="ms-2 form-check-input"
                            id="novoAirBag"
                            aria-describedby="airBagHelp"
                            v-model="form.air_bag"
                        />
                        <p v-if="transationDetails.errors.air_bag">
                            {{ transationDetails.errors.air_bag[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="novoAbs"
                    label="Abs"
                    help="absHelp"
                    help-text="Opcional. Informe se o modelo possui Abs."
                >
                    <template v-slot:content>
                        <input
                            type="checkbox"
                            class="ms-2 form-check-input"
                            id="novoAbs"
                            aria-describedby="absHelp"
                            v-model="form.abs"
                        />
                        <p v-if="transationDetails.errors.abs">
                            {{ transationDetails.errors.abs[0] }}
                        </p>
                    </template>
                </input-container-component>
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
        <modal-component id="modalSeeModelo" title="Visulizar modelo">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                {{ $store.state.item }}
                <input-container-component id="seeMarca" label="Marca">
                    <template v-slot:content>
                        <select
                            disabled
                            class="form-control"
                            id="seeMarca"
                            aria-describedby="marcaHelp"
                            v-model="$store.state.item.marca_id"
                        >
                            <option value="-1" selected>
                                --- Selecione uma marca ---
                            </option>
                            <option
                                v-for="(marca, index) in marcas"
                                :key="index"
                                :value="marca.id"
                            >
                                {{ marca.nome }}
                            </option>
                        </select>
                    </template>
                </input-container-component>
                <input-container-component id="seeNome" label="Nome">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            id="seeNome"
                            aria-describedby="nomeHelp"
                            v-model="$store.state.item.nome"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeNumeroPortas"
                    label="Número de portas"
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="number"
                            class="form-control"
                            id="seeNumeroPortas"
                            aria-describedby="numeroPortasHelp"
                            v-model="$store.state.item.numero_portas"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeLugares"
                    label="Número de lugares"
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="number"
                            class="form-control"
                            id="seeLugares"
                            aria-describedby="lugaresHelp"
                            v-model="$store.state.item.lugares"
                        />
                    </template>
                </input-container-component>
                <input-container-component id="seeAirbBg" label="Air-bag">
                    <template v-slot:content>
                        <input
                            disabled
                            type="checkbox"
                            class="ms-2 form-check-input"
                            id="seeAirBag"
                            aria-describedby="airBagHelp"
                            v-model="$store.state.item.air_bag"
                        />
                    </template>
                </input-container-component>
                <input-container-component id="seeAbs" label="Abs">
                    <template v-slot:content>
                        <input
                            disabled
                            type="checkbox"
                            class="ms-2 form-check-input"
                            id="seeAbs"
                            aria-describedby="absHelp"
                            v-model="$store.state.item.abs"
                        />
                    </template>
                </input-container-component>
                <input-container-component id="seeImagem" label="Imagem">
                    <template v-slot:content>
                        <img
                            :src="'/storage/' + $store.state.item.imagem"
                            width="30"
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
        <modal-component id="modalEditModelo" title="Editar modelo">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                <input-container-component
                    id="editMarca"
                    label="Marca"
                    help="marcaHelp"
                    help-text="Informe a marca do modelo."
                >
                    <template v-slot:content>
                        <select
                            class="form-control"
                            id="editMarca"
                            aria-describedby="marcaHelp"
                            v-model="$store.state.item.marca_id"
                        >
                            <option value="" disabled>
                                --- Selecione uma marca ---
                            </option>
                            <option
                                v-for="(marca, index) in marcas"
                                :key="index"
                                :value="marca.id"
                            >
                                {{ marca.nome }}
                            </option>
                        </select>
                        <p v-if="transationDetails.errors.marca_id">
                            {{ transationDetails.errors.marca_id[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="editNome"
                    label="Nome"
                    help="nomeHelp"
                    help-text="Informe o nome do modelo."
                >
                    <template v-slot:content>
                        <input
                            type="text"
                            class="form-control"
                            id="editNome"
                            aria-describedby="nomeHelp"
                            placeholder="Nome do modelo"
                            v-model="$store.state.item.nome"
                        />
                        <p v-if="transationDetails.errors.nome">
                            {{ transationDetails.errors.nome[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="editNumeroPortas"
                    label="Número de portas"
                    help="numeroPortasHelp"
                    help-text="Opcional. Informe o número de portas do modelo."
                >
                    <template v-slot:content>
                        <input
                            type="number"
                            class="form-control"
                            id="editNumeroPortas"
                            aria-describedby="numeroPortasHelp"
                            placeholder="4"
                            v-model="$store.state.item.numero_portas"
                        />
                        <p v-if="transationDetails.errors.numero_portas">
                            {{ transationDetails.errors.numero_portas[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="editLugares"
                    label="Número de lugares"
                    help="lugaresHelp"
                    help-text="Opcional. Informe o número de lugares do modelo."
                >
                    <template v-slot:content>
                        <input
                            type="number"
                            class="form-control"
                            id="editLugares"
                            aria-describedby="lugaresHelp"
                            placeholder="5"
                            v-model="$store.state.item.lugares"
                        />
                        <p v-if="transationDetails.errors.lugares">
                            {{ transationDetails.errors.lugares[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="editAirbBg"
                    label="Air-bag"
                    help="airBagHelp"
                    help-text="Opcional. Informe se o modelo possui airbag."
                >
                    <template v-slot:content>
                        <input
                            type="checkbox"
                            class="ms-2 form-check-input"
                            id="editAirBag"
                            aria-describedby="airBagHelp"
                            v-model="$store.state.item.air_bag"
                        />
                        <p v-if="transationDetails.errors.air_bag">
                            {{ transationDetails.errors.air_bag[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="editAbs"
                    label="Abs"
                    help="absHelp"
                    help-text="Opcional. Informe se o modelo possui Abs."
                >
                    <template v-slot:content>
                        <input
                            type="checkbox"
                            class="ms-2 form-check-input"
                            id="editAbs"
                            aria-describedby="absHelp"
                            v-model="$store.state.item.abs"
                        />
                        <p v-if="transationDetails.errors.abs">
                            {{ transationDetails.errors.abs[0] }}
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
                            aria-describedby="editImagemHelp"
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
        <modal-component id="modalRemoveModelo" title="Remover modelo">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                <input-container-component id="removeMarca" label="Marca">
                    <template v-slot:content>
                        <select
                            disabled
                            class="form-control"
                            id="removeMarca"
                            aria-describedby="marcaHelp"
                            v-model="$store.state.item.marca_id"
                        >
                            <option value="-1" selected>
                                --- Selecione uma marca ---
                            </option>
                            <option
                                v-for="(marca, index) in marcas"
                                :key="index"
                                :value="marca.id"
                            >
                                {{ marca.nome }}
                            </option>
                        </select>
                    </template>
                </input-container-component>
                <input-container-component id="removeNome" label="Nome">
                    <template v-slot:content>
                        <input
                            disabled
                            type="text"
                            class="form-control"
                            id="removeNome"
                            aria-describedby="nomeHelp"
                            placeholder="Nome do modelo"
                            v-model="$store.state.item.nome"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="removeNumeroPortas"
                    label="Número de portas"
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="number"
                            class="form-control"
                            id="removeNumeroPortas"
                            aria-describedby="numeroPortasHelp"
                            v-model="$store.state.item.numero_portas"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="removeLugares"
                    label="Número de lugares"
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="number"
                            class="form-control"
                            id="removeLugares"
                            aria-describedby="lugaresHelp"
                            v-model="$store.state.item.lugares"
                        />
                    </template>
                </input-container-component>
                <input-container-component id="removeAirbBg" label="Air-bag">
                    <template v-slot:content>
                        <input
                            disabled
                            type="checkbox"
                            class="ms-2 form-check-input"
                            id="removeAirBag"
                            aria-describedby="airBagHelp"
                            v-model="$store.state.item.air_bag"
                        />
                    </template>
                </input-container-component>
                <input-container-component id="removeAbs" label="Abs">
                    <template v-slot:content>
                        <input
                            disabled
                            type="checkbox"
                            class="ms-2 form-check-input"
                            id="removeAbs"
                            aria-describedby="absHelp"
                            v-model="$store.state.item.abs"
                        />
                    </template>
                </input-container-component>
                <input-container-component id="removeImagem" label="Imagem">
                    <template v-slot:content>
                        <img
                            :src="'/storage/' + $store.state.item.imagem"
                            width="30"
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
            urlBase: "http://localhost:8000/api/modelo",
            urlMarca: "http://localhost:8000/api/marca",
            transationDetails: {
                status: "",
                type: "",
                message: "",
                errors: "",
            },
            modelos: { data: "" },
            form: {
                marca_id: "",
                nome: "",
                arquivoImagem: "",
                numero_portas: "",
                lugares: "",
                air_bag: "",
                yes_air_bag: "",
                no_air_bag: "",
                abs: "",
                yes_abs: "",
                no_abs: "",
            },
            marcas: [],
            busca: {
                id: "",
                nome: "",
                marca_id: "",
                numero_portas: "",
                lugares: "",
                air_bag: "",
                abs: "",
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

            formData.append("marca_id", this.form.marca_id);
            formData.append("nome", this.form.nome);
            formData.append("imagem", this.form.arquivoImagem);
            formData.append("numero_portas", this.form.numero_portas);
            formData.append("lugares", this.form.lugares);
            checked = this.form.air_bag == true ? 1 : 0;
            formData.append("air_bag", checked);
            checked = this.form.abs == true ? 1 : 0;
            formData.append("abs", checked);

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
                this.modelos = response.data;
                this.modelos.map((modelo, key) => {
                    this.modelos[key].air_bag =
                        modelo.air_bag == 1 ? true : false;
                    this.modelos[key].abs = modelo.abs == 1 ? true : false;
                });
                console.log("Modelos", this.modelos);
            });

            axios.get(this.urlMarca, config).then((response) => {
                this.marcas = response.data;
            });
        },
        edit() {
            let checked = false;
            let formData = new FormData();
            formData.append("_method", "patch");
            if (this.$store.state.item.nome)
                formData.append("nome", this.$store.state.item.nome);
            if (this.form.arquivoImagem) {
                formData.append("imagem", this.form.arquivoImagem);
            }
            if (this.$store.state.item.numero_portas)
                formData.append(
                    "numero_portas",
                    this.$store.state.item.numero_portas
                );
            if (this.$store.state.item.lugares)
                formData.append("lugares", this.$store.state.item.lugares);
            if (this.$store.state.item.air_bag) {
                checked = this.$store.state.item.air_bag == true ? 1 : 0;
                formData.append("air_bag", checked);
            }
            if (this.$store.state.item.abs) {
                checked = this.$store.state.item.abs == true ? 1 : 0;
                formData.append("abs", checked);
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
        onAirBag() {
            this.busca.air_bag = this.form.yes_air_bag && !this.form.no_air_bag;
            this.busca.air_bag =
                this.form.yes_air_bag ^ this.form.no_air_bag
                    ? this.busca.air_bag
                    : "";
            if (this.busca.air_bag === true) this.busca.air_bag = 1;
            else if (this.busca.air_bag === false) {
                console.log("Tá pesquisando como não tem");
                this.busca.air_bag = 0;
            }
        },
        onAbs() {
            this.busca.abs = this.form.yes_abs && !this.form.no_abs;
            this.busca.abs =
                this.form.yes_abs ^ this.form.no_abs ? this.busca.abs : "";
            if (this.busca.abs === true) this.busca.abs = 1;
            else if (this.busca.abs === false) {
                console.log("Tá pesquisando como não tem");
                this.busca.abs = 0;
            }
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
                if (this.busca[key] !== "") {
                    this.urlPagination = "?page=1";
                    if (this.urlFiltro != "") {
                        this.urlFiltro += ";";
                    } else {
                        this.urlFiltro = "&filtro=";
                    }
                    if (key.includes("_id")) {
                        this.urlFiltro += key + ":=:" + this.busca[key];
                    } else {
                        this.urlFiltro +=
                            key + ":like:" + "%25" + this.busca[key] + "%25";
                    }
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
