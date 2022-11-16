/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

import { createApp } from "vue";
import { createStore } from "vuex";

// Create a new store instance.
const store = createStore({
    state: {
        item: {
            marca_id: "",
            modelo_id: "",
        },
        transation: {
            status: "",
            type: "",
            message: "",
            errors: "",
        },
    },
});

const app = createApp({
    el: "#app",
    store,
});

app.config.globalProperties.$filters = {
    formataDataTempo(d) {
        if (!d) return "";

        d = d.split("T");
        let data = d[0];
        data = data.split("-");
        data = data[2] + "/" + data[1] + "/" + data[0];

        let tempo = d[1];
        tempo = tempo.split(".");
        tempo = tempo[0];

        return data + " " + tempo;
    },
    formataDataTempoMySQL(d) {
        if (!d) return "";

        d = d.split(" ");
        let data = d[0];
        data = data.split("-");
        data = data[2] + "/" + data[1] + "/" + data[0];

        return data;
    },
};

// Install the store instance as a plugin
app.use(store);

import Login from "./components/Login.vue";
app.component("login", Login);
import Home from "./components/Home.vue";
app.component("home", Home);
import Clientes from "./components/Clientes.vue";
app.component("clientes", Clientes);
import Marcas from "./components/Marcas.vue";
app.component("marcas", Marcas);
import Modelos from "./components/Modelos.vue";
app.component("modelos", Modelos);
import Carros from "./components/Carros.vue";
app.component("carros", Carros);
import Locacoes from "./components/Locacoes.vue";
app.component("locacoes", Locacoes);
import InputContainer from "./components/InputContainer.vue";
app.component("input-container-component", InputContainer);
import TableComponent from "./components/Table.vue";
app.component("table-component", TableComponent);
import CardComponent from "./components/Card.vue";
app.component("card-component", CardComponent);
import ModalComponent from "./components/Modal.vue";
app.component("modal-component", ModalComponent);
import AlertComponent from "./components/Alert.vue";
app.component("alert-component", AlertComponent);
import PaginateComponent from "./components/Paginate.vue";
app.component("paginate-component", PaginateComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount("#app");
