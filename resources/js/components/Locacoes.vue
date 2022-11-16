<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Card de busca -->
                <card-component title="Busca de locações">
                    <template v-slot:content>
                        <div class="row">
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="inputId"
                                    label="ID"
                                    help="idHelp"
                                    help-text="Opcional. Informe o id da locação."
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
                                    id="selectCliente"
                                    label="Cliente"
                                    help="clienteHelp"
                                    help-text="Opcional. Informe o cliente da locação."
                                >
                                    <template v-slot:content>
                                        <div class="input-group">
                                            <select
                                                class="form-control"
                                                id="selectMarca"
                                                v-model="busca.cliente_id"
                                            >
                                                <option
                                                    value=""
                                                    class="disabled"
                                                >
                                                    Selecione um cliente
                                                </option>
                                                <option
                                                    v-for="(
                                                        cliente, index
                                                    ) in clientes"
                                                    :key="index"
                                                    :value="cliente.id"
                                                >
                                                    {{ cliente.nome }}
                                                </option>
                                            </select>
                                        </div>
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-4">
                                <input-container-component
                                    id="selectCarro"
                                    label="Carro"
                                    help="carroHelp"
                                    help-text="Opcional. Informe o carro da locação."
                                >
                                    <template v-slot:content>
                                        <div class="input-group">
                                            <select
                                                class="form-control"
                                                id="selectCarro"
                                                v-model="busca.carro_id"
                                            >
                                                <option
                                                    value=""
                                                    class="disabled"
                                                >
                                                    Selecione um carro
                                                </option>
                                                <option
                                                    v-for="(
                                                        carro, index
                                                    ) in carros"
                                                    :key="index"
                                                    :value="carro.id"
                                                >
                                                    {{ carro.modelo.nome }}
                                                </option>
                                            </select>
                                        </div>
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-6">
                                <input-container-component
                                    label="Data de início locação"
                                    help="dataInicioHelp"
                                    help-text="Opcional. Informe a data de início da locação."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            id="minDataInicioId"
                                            aria-describedby="dataInicioHelp"
                                            placeholder="dd/mm/aaaa"
                                            v-model="
                                                busca.minData_inicio_periodo
                                            "
                                        />
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            id="minDataInicioId"
                                            aria-describedby="dataInicioHelp"
                                            placeholder="dd/mm/aaaa"
                                            v-model="
                                                busca.maxData_inicio_periodo
                                            "
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-6">
                                <input-container-component
                                    label="Data final prevista"
                                    help="dataPrevistoHelp"
                                    help-text="Opcional. Informe a data prevista do final da locação."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            id="minDataPrevisto"
                                            aria-describedby="dataPrevistoHelp"
                                            placeholder="dd/mm/aaaa"
                                            v-model="
                                                busca.minData_final_previsto_periodo
                                            "
                                        />
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            id="minDataPrevisto"
                                            aria-describedby="dataPrevistoHelp"
                                            placeholder="dd/mm/aaaa"
                                            v-model="
                                                busca.maxData_final_previsto_periodo
                                            "
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-6">
                                <input-container-component
                                    label="Data final realizada"
                                    help="dataRealizadaHelp"
                                    help-text="Opcional. Informe a data realizada do final da locação."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            id="minDataRealizado"
                                            aria-describedby="dataRealizadaHelp"
                                            placeholder="dd/mm/aaaa"
                                            v-model="
                                                busca.minData_final_realizado_periodo
                                            "
                                        />
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            id="maxDataRealizado"
                                            aria-describedby="dataRealizadaHelp"
                                            placeholder="dd/mm/aaaa"
                                            v-model="
                                                busca.maxData_final_realizado_periodo
                                            "
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-6">
                                <input-container-component
                                    label="Valor da diária"
                                    help="valorDiariaHelp"
                                    help-text="Opcional. Informe o valor da diária da locação."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="minValorDiaria"
                                            placeholder="0,00"
                                            v-model="busca.minValor_diaria"
                                        />
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="maxValorDiaria"
                                            placeholder="0,00"
                                            v-model="busca.maxValor_diaria"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-6">
                                <input-container-component
                                    label="Quilometragem inicial"
                                    help="kmInicialHelp"
                                    help-text="Opcional. Informe a quilometragem inicial da locação."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="minKmInicial"
                                            placeholder="0,00"
                                            v-model="busca.minKm_inicial"
                                        />
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="maxKmInicial"
                                            placeholder="0,00"
                                            v-model="busca.maxKm_inicial"
                                        />
                                    </template>
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-6">
                                <input-container-component
                                    label="Quilometragem final"
                                    help="kmFinalHelp"
                                    help-text="Opcional. Informe a quilometragem final da locação."
                                >
                                    <template v-slot:content>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="minKmFinal"
                                            placeholder="0,00"
                                            v-model="busca.minKm_final"
                                        />
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="maxKmFinal"
                                            placeholder="0,00"
                                            v-model="busca.maxKm_final"
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
                <card-component title="Relação de locações">
                    <template v-slot:content>
                        <table-component
                            :data="locacoes"
                            :titles="{
                                id: { title: 'ID', type: 'text' },
                                cliente_id: {
                                    title: 'ID do cliente',
                                    type: 'text',
                                },
                                carro_id: {
                                    title: 'ID do carro',
                                    type: 'text',
                                },
                                data_inicio_periodo: {
                                    title: 'Data de início da locação',
                                    type: 'dateMySQL',
                                },
                                data_final_previsto_periodo: {
                                    title: 'Data final prevista da locação',
                                    type: 'dateMySQL',
                                },
                                data_final_realizado_periodo: {
                                    title: 'Data final realizada da locação',
                                    type: 'dateMySQL',
                                },
                                valor_diaria: {
                                    title: 'Valor da diária',
                                    type: 'text',
                                },
                                km_inicial: {
                                    title: 'Quilometragem inicial',
                                    type: 'text',
                                },
                                km_final: {
                                    title: 'Quilometragem final',
                                    type: 'text',
                                },
                            }"
                            :see="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalSeeLocacao',
                            }"
                            :edit="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalEditLocacao',
                            }"
                            :remove="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalRemoveLocacao',
                            }"
                            :addSinistro="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalAddSinistro',
                            }"
                            :endLocacao="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalEndLocacao',
                            }"
                        ></table-component>
                    </template>
                    <template v-slot:footer>
                        <div class="row w-100">
                            <div class="col-10">
                                <paginate-component>
                                    <li
                                        v-for="(link, key) in locacoes.links"
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
                                    data-bs-target="#modalAddLocacao"
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
        <!-- Modal de sinistro-->
        <modal-component id="modalEndLocacao" title="Encerrar locação">
            <template v-slot:alert>
                <alert-component
                    v-if="transationDetails.type !== ''"
                    :details="transationDetails"
                ></alert-component>
            </template>
            <template v-slot:content>
                <div class="form-group">
                    <input-container-component
                        disabled
                        id="endLocacaoId"
                        label="Locação"
                        help="endLocacaoIdHelp"
                        help-text="Informe o id da locação."
                    >
                        <template v-slot:content>
                            <select
                                disabled
                                class="form-control"
                                id="endLocacaoId"
                                aria-describedby="endLocacaoIdHelp"
                                v-model="$store.state.item.id"
                            >
                                <option disabled value="">
                                    --- Selecione uma locação ---
                                </option>
                                <option
                                    v-for="(locacao, index) in locacoes"
                                    :key="index"
                                    :value="locacao.id"
                                >
                                    {{ locacao.id }}
                                </option>
                            </select>
                            <p v-if="transationDetails.errors.id">
                                {{ transationDetails.errors.id[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="endLocacaoDataFinal"
                        label="Data final realizada da locação"
                        help="endLocacaoDataFinalHelp"
                        help-text="Opcional. Informe a data final realizada da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="endLocacaoDataFinal"
                                aria-describedby="endLocacaoDataFinalHelp"
                                placeholder="dd/mm/aaaa"
                                v-model="
                                    $store.state.item
                                        .data_final_realizado_periodo
                                "
                            />
                            <p
                                v-if="
                                    transationDetails.errors
                                        .data_final_realizado_periodo
                                "
                            >
                                {{
                                    transationDetails.errors
                                        .data_final_realizado_periodo[0]
                                }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        label="Quilometragem final da locação"
                        help="sinistroKmHelp"
                        help-text="Opcional. Informe a quilometragem final da locacão."
                    >
                        <template v-slot:content>
                            <input
                                type="number"
                                class="form-control"
                                id="endLocacaoKm"
                                placeholder="0,00"
                                v-model="$store.state.item.km_final"
                            />
                            <p v-if="transationDetails.errors.km_final">
                                {{ transationDetails.errors.km_final[0] }}
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
                <button
                    type="button"
                    class="btn btn-primary"
                    @click="endLocacao()"
                >
                    Encerrar
                </button>
            </template>
        </modal-component>
        <!-- Modal de sinistro-->
        <!-- Modal de sinistro-->
        <modal-component id="modalAddSinistro" title="Adicionar sinistro">
            <template v-slot:alert>
                <alert-component
                    v-if="transationDetails.type !== ''"
                    :details="transationDetails"
                ></alert-component>
            </template>
            <template v-slot:content>
                <div class="form-group">
                    <input-container-component
                        id="sinistroLocacao"
                        label="Locação"
                        help="sinistroLocacaoHelp"
                        help-text="Informe a locação do sinistro."
                    >
                        <template v-slot:content>
                            <select
                                class="form-control"
                                id="sinistroLocacao"
                                aria-describedby="sinistroLocacaoHelp"
                                v-model="formSinistro.locacao_id"
                            >
                                <option disabled value="">
                                    --- Selecione uma locação ---
                                </option>
                                <option
                                    v-for="(locacao, index) in locacoes"
                                    :key="index"
                                    :value="locacao.id"
                                >
                                    {{ locacao.id }}
                                </option>
                            </select>
                            <p v-if="transationDetails.errors.locacao_id">
                                {{ transationDetails.errors.locacao_id[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="sinsitroMotivoCausa"
                        label="Motivo/Causa"
                        help="sinsitroMotivoCausaHelp"
                        help-text="Informe a causa do sinistro."
                    >
                        <template v-slot:content>
                            <input
                                type="text"
                                class="form-control"
                                id="sinsitroMotivoCausa"
                                aria-describedby="sinsitroMotivoCausaHelp"
                                placeholder="Causa/Motivo do sinistro"
                                v-model="formSinistro.motivoCausa"
                            />
                            <p v-if="transationDetails.errors.motivoCausa">
                                {{ transationDetails.errors.motivoCausa[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="sinsitroLocalidade"
                        label="Localidade"
                        help="sinsitroLocalidadeHelp"
                        help-text="Informe a localidade do sinistro."
                    >
                        <template v-slot:content>
                            <input
                                type="text"
                                class="form-control"
                                id="sinsitroLocalidade"
                                aria-describedby="sinsitroLocalidadeHelp"
                                placeholder="Localidade do sinistro"
                                v-model="formSinistro.localidade"
                            />
                            <p v-if="transationDetails.errors.localidade">
                                {{ transationDetails.errors.localidade[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="sinistroDataHora"
                        label="Data do sinistro"
                        help="sinistroDataHoraHelp"
                        help-text="Opcional. Informe a data do sinistro."
                    >
                        <template v-slot:content>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="sinistroDataInicio"
                                aria-describedby="sinistroDataHoraHelp"
                                placeholder="dd/mm/aaaa"
                                v-model="formSinistro.dataHora"
                            />
                            <p v-if="transationDetails.errors.dataHora">
                                {{ transationDetails.errors.dataHora[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        label="Quilometragem do sinistro"
                        help="sinistroKmHelp"
                        help-text="Opcional. Informe a quilometragem do sinistro."
                    >
                        <template v-slot:content>
                            <input
                                type="number"
                                class="form-control"
                                id="sinistroKm"
                                placeholder="0,00"
                                v-model="formSinistro.km"
                            />
                            <p v-if="transationDetails.errors.km">
                                {{ transationDetails.errors.km[0] }}
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
                <button
                    type="button"
                    class="btn btn-primary"
                    @click="addSinistro()"
                >
                    Adicionar
                </button>
            </template>
        </modal-component>
        <!-- Modal de sinistro-->
        <!-- Modal de adição-->
        <modal-component id="modalAddLocacao" title="Adicionar locação">
            <template v-slot:alert>
                <alert-component
                    v-if="transationDetails.type !== ''"
                    :details="transationDetails"
                ></alert-component>
            </template>
            <template v-slot:content>
                {{ form }}
                <div class="form-group">
                    <input-container-component
                        id="novoCliente"
                        label="Cliente"
                        help="clienteHelp"
                        help-text="Informe o cliente da locação."
                    >
                        <template v-slot:content>
                            <select
                                class="form-control"
                                id="novoCliente"
                                aria-describedby="clienteHelp"
                                v-model="form.cliente_id"
                            >
                                <option disabled value="">
                                    --- Selecione um cliente ---
                                </option>
                                <option
                                    v-for="(cliente, index) in clientes"
                                    :key="index"
                                    :value="cliente.id"
                                >
                                    {{ cliente.nome }}
                                </option>
                            </select>
                            <p v-if="transationDetails.errors.cliente_id">
                                {{ transationDetails.errors.cliente_id[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="novoCarro"
                        label="Carro"
                        help="carroHelp"
                        help-text="Informe o carro da locação."
                    >
                        <template v-slot:content>
                            <select
                                class="form-control"
                                id="novoCarro"
                                aria-describedby="carroHelp"
                                v-model="form.carro_id"
                            >
                                <option disabled value="">
                                    --- Selecione um carro ---
                                </option>
                                <option
                                    v-for="(carro, index) in carros"
                                    :key="index"
                                    :value="carro.id"
                                >
                                    {{ carro.modelo.nome }}
                                </option>
                            </select>
                            <p v-if="transationDetails.errors.carro_id">
                                {{ transationDetails.errors.carro_id[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="novoDataInicio"
                        label="Data de início locação"
                        help="dataInicioHelp"
                        help-text="Opcional. Informe a data de início da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="novoDataInicio"
                                aria-describedby="dataInicioHelp"
                                placeholder="dd/mm/aaaa"
                                v-model="form.data_inicio_periodo"
                            />
                            <p
                                v-if="
                                    transationDetails.errors.data_inicio_periodo
                                "
                            >
                                {{
                                    transationDetails.errors
                                        .data_inicio_periodo[0]
                                }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="novoDataPrevisto"
                        label="Data prevista do fim da locação"
                        help="dataPrevistoHelp"
                        help-text="Opcional. Informe a data prevista do fim da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="novoDataPrevisto"
                                aria-describedby="dataInicioHelp"
                                placeholder="dd/mm/aaaa"
                                v-model="form.data_final_previsto_periodo"
                            />
                            <p
                                v-if="
                                    transationDetails.errors
                                        .data_final_previsto_periodo
                                "
                            >
                                {{
                                    transationDetails.errors
                                        .data_final_previsto_periodo[0]
                                }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        label="Valor da diária"
                        help="valorDiariaHelp"
                        help-text="Opcional. Informe o valor da diaria da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="number"
                                class="form-control"
                                id="novoValorDiaria"
                                placeholder="0,00"
                                v-model="form.valor_diaria"
                            />
                            <p v-if="transationDetails.errors.valor_diaria">
                                {{ transationDetails.errors.valor_diaria[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        label="Quilometragem inicial"
                        help="kmInicialHelp"
                        help-text="Opcional. Informe a quilometragem inicial da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="number"
                                class="form-control"
                                id="novoKmInicial"
                                placeholder="0,00"
                                v-model="form.km_inicial"
                            />
                            <p v-if="transationDetails.errors.km_inicial">
                                {{ transationDetails.errors.km_inicial[0] }}
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
        <modal-component id="modalSeeLocacao" title="Visulizar locação">
            <template v-slot:content>
                <input-container-component
                    id="seeCliente"
                    label="Cliente"
                    help="clienteHelp"
                    help-text="Informe o cliente da locação."
                >
                    <template v-slot:content>
                        <select
                            disabled
                            class="form-control"
                            id="seeCliente"
                            aria-describedby="clienteHelp"
                            v-model="$store.state.item.cliente_id"
                        >
                            <option disabled value="">
                                --- Selecione um cliente ---
                            </option>
                            <option
                                v-for="(cliente, index) in clientes"
                                :key="index"
                                :value="cliente.id"
                            >
                                {{ cliente.nome }}
                            </option>
                        </select>
                        <p v-if="transationDetails.errors.cliente_id">
                            {{ transationDetails.errors.cliente_id[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeCarro"
                    label="Carro"
                    help="carroHelp"
                    help-text="Informe o carro da locação."
                >
                    <template v-slot:content>
                        <select
                            disabled
                            class="form-control"
                            id="seeCarro"
                            aria-describedby="carroHelp"
                            v-model="$store.state.item.carro_id"
                        >
                            <option disabled value="">
                                --- Selecione um carro ---
                            </option>
                            <option
                                v-for="(carro, index) in carros"
                                :key="index"
                                :value="carro.id"
                            >
                                {{ carro.modelo.nome }}
                            </option>
                        </select>
                        <p v-if="transationDetails.errors.carro_id">
                            {{ transationDetails.errors.carro_id[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeDataInicio"
                    label="Data de início locação"
                    help="dataInicioHelp"
                    help-text="Opcional. Informe a data de início da locação."
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="datetime-local"
                            class="form-control"
                            id="seeDataInicio"
                            aria-describedby="dataInicioHelp"
                            placeholder="dd/mm/aaaa"
                            v-model="$store.state.item.data_inicio_periodo"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeDataPrevisto"
                    label="Data prevista do fim da locação"
                    help="dataPrevistoHelp"
                    help-text="Opcional. Informe a data prevista do fim da locação."
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="datetime-local"
                            class="form-control"
                            id="seeDataPrevisto"
                            aria-describedby="dataPrevistoHelp"
                            placeholder="dd/mm/aaaa"
                            v-model="
                                $store.state.item.data_final_previsto_periodo
                            "
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeDataRealizado"
                    label="Data realizado do fim da locação"
                    help="dataRealizadoHelp"
                    help-text="Opcional. Informe a data realizada do fim da locação."
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="datetime-local"
                            class="form-control"
                            id="seeDataRealizado"
                            aria-describedby="dataPrevistoHelp"
                            placeholder="dd/mm/aaaa"
                            v-model="
                                $store.state.item.data_final_realizado_periodo
                            "
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeKmInicial"
                    label="Quilometragem inicial"
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="number"
                            class="form-control"
                            id="seeKmInicial"
                            placeholder="0,00"
                            v-model="$store.state.item.km_inicial"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="seeKmFInal"
                    label="Quilometragem final"
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="number"
                            class="form-control"
                            id="seeKmFinal"
                            placeholder="0,00"
                            v-model="$store.state.item.km_final"
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
        <modal-component id="modalEditLocacao" title="Editar locação">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                <div class="form-group">
                    <input-container-component
                        id="novoCliente"
                        label="Cliente"
                        help="clienteHelp"
                        help-text="Informe o cliente da locação."
                    >
                        <template v-slot:content>
                            <select
                                class="form-control"
                                id="novoCliente"
                                aria-describedby="clienteHelp"
                                v-model="$store.state.item.cliente_id"
                            >
                                <option disabled value="">
                                    --- Selecione um cliente ---
                                </option>
                                <option
                                    v-for="(cliente, index) in clientes"
                                    :key="index"
                                    :value="cliente.id"
                                >
                                    {{ cliente.nome }}
                                </option>
                            </select>
                            <p v-if="transationDetails.errors.cliente_id">
                                {{ transationDetails.errors.cliente_id[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="novoCarro"
                        label="Carro"
                        help="carroHelp"
                        help-text="Informe o carro da locação."
                    >
                        <template v-slot:content>
                            <select
                                class="form-control"
                                id="novoCarro"
                                aria-describedby="carroHelp"
                                v-model="$store.state.item.carro_id"
                            >
                                <option disabled value="">
                                    --- Selecione um carro ---
                                </option>
                                <option
                                    v-for="(carro, index) in carros"
                                    :key="index"
                                    :value="carro.id"
                                >
                                    {{ carro.modelo.nome }}
                                </option>
                            </select>
                            <p v-if="transationDetails.errors.carro_id">
                                {{ transationDetails.errors.carro_id[0] }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="novoDataInicio"
                        label="Data de início locação"
                        help="dataInicioHelp"
                        help-text="Opcional. Informe a data de início da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="novoDataInicio"
                                aria-describedby="dataInicioHelp"
                                placeholder="dd/mm/aaaa"
                                v-model="$store.state.item.data_inicio_periodo"
                            />
                            <p
                                v-if="
                                    transationDetails.errors.data_inicio_periodo
                                "
                            >
                                {{
                                    transationDetails.errors
                                        .data_inicio_periodo[0]
                                }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="novoDataPrevisto"
                        label="Data prevista do fim da locação"
                        help="dataPrevistoHelp"
                        help-text="Opcional. Informe a data prevista do fim da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="novoDataPrevisto"
                                aria-describedby="dataInicioHelp"
                                placeholder="dd/mm/aaaa"
                                v-model="
                                    $store.state.item
                                        .data_final_previsto_periodo
                                "
                            />
                            <p
                                v-if="
                                    transationDetails.errors
                                        .data_final_previsto_periodo
                                "
                            >
                                {{
                                    transationDetails.errors
                                        .data_final_previsto_periodo[0]
                                }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        id="novoDataRealizado"
                        label="Data realizado do fim da locação"
                        help="dataRealizadoHelp"
                        help-text="Opcional. Informe a data realizada do fim da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="novoDataRealizado"
                                aria-describedby="dataPrevistoHelp"
                                placeholder="dd/mm/aaaa"
                                v-model="
                                    $store.state.item
                                        .data_final_realizado_periodo
                                "
                            />
                            <p
                                v-if="
                                    transationDetails.errors
                                        .data_final_realizado_periodo
                                "
                            >
                                {{
                                    transationDetails.errors
                                        .data_final_realizado_periodo[0]
                                }}
                            </p>
                        </template>
                    </input-container-component>
                    <input-container-component
                        label="Valor da diária"
                        help="valorDiariaHelp"
                        help-text="Opcional. Informe o valor da diaria da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="number"
                                class="form-control"
                                id="novoValorDiaria"
                                placeholder="0,00"
                                v-model="$store.state.item.valor_diaria"
                            />
                        </template>
                    </input-container-component>
                    <input-container-component
                        label="Quilometragem inicial"
                        help="kmInicialHelp"
                        help-text="Opcional. Informe a quilometragem inicial da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="number"
                                class="form-control"
                                id="novoKmInicial"
                                placeholder="0,00"
                                v-model="$store.state.item.km_inicial"
                            />
                        </template>
                    </input-container-component>
                    <input-container-component
                        label="Quilometragem final"
                        help="kmFinalHelp"
                        help-text="Opcional. Informe a quilometragem final da locação."
                    >
                        <template v-slot:content>
                            <input
                                type="number"
                                class="form-control"
                                id="novoKmFinal"
                                placeholder="0,00"
                                v-model="$store.state.item.km_final"
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
                <button type="button" class="btn btn-primary" @click="edit()">
                    Editar
                </button>
            </template>
        </modal-component>
        <!-- Modal de edição-->
        <!-- Modal de remoção-->
        <modal-component id="modalRemoveLocacao" title="Remover locação">
            <template v-slot:alert v-if="$store.state.transation.status">
                <alert-component
                    :details="$store.state.transation"
                ></alert-component>
            </template>
            <template v-slot:content>
                <input-container-component
                    id="removeCliente"
                    label="Cliente"
                    help="clienteHelp"
                    help-text="Informe o cliente da locação."
                >
                    <template v-slot:content>
                        <select
                            disabled
                            class="form-control"
                            id="removeCliente"
                            aria-describedby="clienteHelp"
                            v-model="$store.state.item.cliente_id"
                        >
                            <option disabled value="">
                                --- Selecione um cliente ---
                            </option>
                            <option
                                v-for="(cliente, index) in clientes"
                                :key="index"
                                :value="cliente.id"
                            >
                                {{ cliente.nome }}
                            </option>
                        </select>
                        <p v-if="transationDetails.errors.cliente_id">
                            {{ transationDetails.errors.cliente_id[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="removeCarro"
                    label="Carro"
                    help="carroHelp"
                    help-text="Informe o carro da locação."
                >
                    <template v-slot:content>
                        <select
                            disabled
                            class="form-control"
                            id="removeCarro"
                            aria-describedby="carroHelp"
                            v-model="$store.state.item.carro_id"
                        >
                            <option disabled value="">
                                --- Selecione um carro ---
                            </option>
                            <option
                                v-for="(carro, index) in carros"
                                :key="index"
                                :value="carro.id"
                            >
                                {{ carro.modelo.nome }}
                            </option>
                        </select>
                        <p v-if="transationDetails.errors.carro_id">
                            {{ transationDetails.errors.carro_id[0] }}
                        </p>
                    </template>
                </input-container-component>
                <input-container-component
                    id="removeDataInicio"
                    label="Data de início locação"
                    help="dataInicioHelp"
                    help-text="Opcional. Informe a data de início da locação."
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="datetime-local"
                            class="form-control"
                            id="removeDataInicio"
                            aria-describedby="dataInicioHelp"
                            placeholder="dd/mm/aaaa"
                            v-model="$store.state.item.data_inicio_periodo"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="removeDataPrevisto"
                    label="Data prevista do fim da locação"
                    help="dataPrevistoHelp"
                    help-text="Opcional. Informe a data prevista do fim da locação."
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="datetime-local"
                            class="form-control"
                            id="removeDataPrevisto"
                            aria-describedby="dataInicioHelp"
                            placeholder="dd/mm/aaaa"
                            v-model="
                                $store.state.item.data_final_previsto_periodo
                            "
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="removeDataRealizado"
                    label="Data realizado do fim da locação"
                    help="dataRealizadoHelp"
                    help-text="Opcional. Informe a data realizada do fim da locação."
                >
                    <template v-slot:content>
                        <input
                            disabled
                            type="datetime-local"
                            class="form-control"
                            id="removeDataRealizado"
                            aria-describedby="dataPrevistoHelp"
                            placeholder="dd/mm/aaaa"
                            v-model="
                                $store.state.item.data_final_realizado_periodo
                            "
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="removeKmInicial"
                    label="Quilometragem inicial"
                >
                    <template v-slot:content>
                        <input
                            type="number"
                            class="form-control"
                            id="removeKmInicial"
                            placeholder="0,00"
                            v-model="$store.state.item.km_inicial"
                        />
                    </template>
                </input-container-component>
                <input-container-component
                    id="removeKmFInal"
                    label="Quilometragem final"
                >
                    <template v-slot:content>
                        <input
                            type="number"
                            class="form-control"
                            id="removeKmFinal"
                            placeholder="0,00"
                            v-model="$store.state.item.km_final"
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
            urlBase: "http://localhost:8000/api/locacao",
            urlCliente: "http://localhost:8000/api/cliente",
            urlCarro: "http://localhost:8000/api/carro",
            urlSinistro: "http://localhost:8000/api/sinistro",
            urlEndLocacao: "http://localhost:8000/api/endLocacao",
            transationDetails: {
                status: "",
                type: "",
                message: "",
                errors: "",
            },
            form: {
                id: "",
                cliente_id: "",
                carro_id: "",
                data_inicio_periodo: "",
                data_final_previsto_periodo: "",
                data_final_realizado_periodo: "",
                valor_diaria: "",
                km_inicial: "",
                km_final: "",
            },
            formSinistro: {
                locacao_id: "",
                motivoCausa: "",
                localidade: "",
                dataHora: "",
                km: "",
            },
            formEndLocacao: {
                id: "",
                data_final_realizado_periodo: "",
                km_final: "",
            },
            locacoes: { data: "" },
            clientes: [],
            carros: [],
            busca: {
                id: "",
                cliente_id: "",
                carro_id: "",
                minData_inicio_periodo: "",
                maxData_inicio_periodo: "",
                minData_final_previsto_periodo: "",
                maxData_final_previsto_periodo: "",
                minData_final_realizado_periodo: "",
                maxData_final_realizado_periodo: "",
                minValor_diaria: "",
                maxValor_diaria: "",
                minKm_inicial: "",
                maxKm_inicial: "",
                minKm_final: "",
                maxKm_final: "",
            },
            urlFiltro: "",
            urlPagination: "",
        };
    },
    computed: {},
    methods: {
        endLocacao() {
            let formData = new FormData();
            formData.append("id", this.$store.state.item.id);
            formData.append("cliente_id", this.$store.state.item.cliente_id);
            formData.append("carro_id", this.$store.state.item.carro_id);
            formData.append(
                "data_inicio_periodo",
                this.$store.state.item.data_inicio_periodo
            );
            formData.append(
                "data_final_previsto_periodo",
                this.$store.state.item.data_final_previsto_periodo
            );
            formData.append(
                "data_final_realizado_periodo",
                this.$store.state.item.data_final_realizado_periodo
            );
            formData.append(
                "valor_diaria",
                this.$store.state.item.valor_diaria
            );
            formData.append("km_inicial", this.$store.state.item.km_inicial);
            formData.append("km_final", this.$store.state.item.km_final);

            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            console.log("Entre isso");
            axios
                .post(this.urlEndLocacao, formData, config)
                .then((response) => {
                    console.log("Resposta", response);
                    this.transationDetails.status = "added";
                    this.transationDetails.type = "success";
                    this.transationDetails.message =
                        "Registro " +
                        response.data[0].id +
                        " adicionado com sucesso.";
                    this.transationDetails.errors = "";
                    this.carregar();
                })
                .catch((errors) => {
                    console.log("Erros", errors);
                    this.transationDetails.status = "error";
                    this.transationDetails.type = "danger";
                    this.transationDetails.message =
                        "Erro ao adicionar registro.";
                    this.transationDetails.errors = errors.response.data.errors;
                });
            console.log("E isso");
        },
        addSinistro() {
            let formData = new FormData();
            formData.append("locacao_id", this.formSinistro.locacao_id);
            formData.append("carro_id", this.formSinistro.carro_id);
            formData.append("motivoCausa", this.formSinistro.motivoCausa);
            formData.append("localidade", this.formSinistro.localidade);
            formData.append("dataHora", this.formSinistro.dataHora);
            formData.append("km", this.formSinistro.km);

            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios
                .post(this.urlSinistro, formData, config)
                .then((response) => {
                    this.transationDetails.status = "added";
                    this.transationDetails.type = "success";
                    this.transationDetails.message =
                        "Registro " +
                        response.data[0].id +
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
        add() {
            let formData = new FormData();
            formData.append("cliente_id", this.form.cliente_id);
            formData.append("carro_id", this.form.carro_id);
            formData.append(
                "data_inicio_periodo",
                this.form.data_inicio_periodo
            );
            formData.append(
                "data_final_previsto_periodo",
                this.form.data_final_previsto_periodo
            );
            formData.append("valor_diaria", this.form.valor_diaria);
            formData.append("km_inicial", this.form.km_inicial);

            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios
                .post(this.urlBase, formData, config)
                .then((response) => {
                    console.log("Response");
                    this.transationDetails.status = "added";
                    this.transationDetails.type = "success";
                    this.transationDetails.message =
                        "Registro " +
                        response.data[0].id +
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
                this.locacoes = response.data;
            });
            axios.get(this.urlCliente, config).then((response) => {
                this.clientes = response.data;
            });
            axios.get(this.urlCarro, config).then((response) => {
                this.carros = response.data;
            });
        },
        edit() {
            let formData = new FormData();
            formData.append("_method", "patch");
            formData.append("cliente_id", this.$store.state.item.cliente_id);
            formData.append("carro_id", this.$store.state.item.carro_id);
            formData.append(
                "data_inicio_periodo",
                this.$store.state.item.data_inicio_periodo
            );
            formData.append(
                "data_final_previsto_periodo",
                this.$store.state.item.data_final_previsto_periodo
            );
            formData.append(
                "data_final_realizado_periodo",
                this.$store.state.item.data_final_realizado_periodo
            );
            formData.append(
                "valor_diaria",
                this.$store.state.item.valor_diaria
            );
            formData.append("km_inicial", this.$store.state.item.km_inicial);
            formData.append("km_final", this.$store.state.item.km_final);

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
        limparCampos() {
            this.transationDetails.type = "";
            this.transationDetails.errors = [];
            console.log(this.transationDetails.errors);
            for (let i in this.form) this.form[i] = "";
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
                    if (this.busca[key] == true) this.busca[key] = 1;
                    if (this.busca[key] == false) this.busca[key] = 0;
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
    },
    mounted() {
        this.carregar();
    },
};
</script>
