import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
//Configuração de requisições
import axios from "axios"
//Configuração de rotas
import VueRouter from "vue-router"
import routesVue from "./routes/router"

Vue.config.productionTip = false

//Bootstrap
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)

//Configuração de requisições
Vue.prototype.$axios = axios.create({
  baseURL: 'http://localhost:3000'
})

//Configuração de rotas
const router = new VueRouter({
  mode: 'history',
  routes: routesVue
})

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
