<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="#">
        <img height="30" src="../../assets/img/logo.png"/>
        Spotify</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item href="#">Bandas</b-nav-item>
          <b-nav-item href="#" disabled>|</b-nav-item>
          <b-nav-item href="#">Gênero</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-form>
            <b-form-input size="sm" class="mr-lg-5" placeholder="Música, álbum ou banda"></b-form-input>
          </b-nav-form>

          <b-navbar-nav right v-if="!isLogged">
            <b-navbar-nav>
              <b-nav-item href="#" v-b-modal.modal-1>Inscreva-se</b-nav-item>
              <b-nav-item href="#" disabled>|</b-nav-item>
              <b-nav-item href="#" v-b-modal.modal-2>Entrar</b-nav-item>
            </b-navbar-nav>
          </b-navbar-nav>

          <b-nav-item-dropdown right v-else>
            <!-- Using 'button-content' slot -->
            <template #button-content>
              {{ userName }}
            </template>
            <b-dropdown-item href="#">Profile</b-dropdown-item>
            <b-dropdown-item href="#" @click="logout()">Sign Out</b-dropdown-item>
          </b-nav-item-dropdown>

        </b-navbar-nav>
      </b-collapse>
    </b-navbar>

    <b-modal id="modal-1" hide-footer title="Inscreva-se">
      <FormRegister/>
    </b-modal>

    <b-modal id="modal-2" hide-footer title="Inscreva-se">
      <FormLogin/>
    </b-modal>
  </div>
</template>
<script>

import FormRegister from "../FormRegister";
import FormLogin from "../FormLogin";
export default {
  name: 'Navbar',
  components: {
    FormLogin,
    FormRegister
  },
  data(){
    return {
      isLogged: false,
      userName: '',
      userEmail: '',
    }
  },
  created() {
    this.validateLogin()
  },
  methods: {
    validateLogin(){
      if(sessionStorage.getItem('user_email')){
        this.isLogged = true
        this.userEmail = sessionStorage.getItem('user_email')
        this.userName = sessionStorage.getItem('user_name')
      }
    },
    logout(){
      sessionStorage.clear()
      location.reload()
    }
  }
}
</script>

<style scoped>
.nv {
  margin-left: 1% !important;
}
</style>