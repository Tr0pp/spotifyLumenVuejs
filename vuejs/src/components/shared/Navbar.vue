<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark" style="--bs-bg-opacity: .5;">
      <b-navbar-brand href="/">
        <img height="30" src="../../assets/img/logo.png"/>
        Spotify</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item class="nav_item" href="#">Bandas</b-nav-item>
          <b-nav-item href="#" disabled>|</b-nav-item>
          <b-nav-item href="#">Gênero</b-nav-item>
          <b-navbar-nav v-if="isLogged">
            <b-nav-item href="#" disabled>|</b-nav-item>
            <b-nav-item href="#">Músicas favoritas</b-nav-item>
          </b-navbar-nav>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-form>
            <b-form-input size="sm" class="mr-lg-5 search-sptf" placeholder="Música, álbum ou banda"></b-form-input>
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
              Perfil
            </template>
            <b-dropdown-item href="#" v-b-modal.modal-3>Visualizar perfil</b-dropdown-item>
            <b-dropdown-item href="#" @click="logout()">Logout</b-dropdown-item>
            <div v-if="accessLevel > 0">
              <hr/>
              <b-dropdown-item href="/admin">Painel administrativo</b-dropdown-item>
            </div>
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

    <b-modal id="modal-3" hide-footer :title="`Perfil de ${userName}`">
      <b-card>
        <p><strong>Nome:</strong> {{ userName }}</p>
        <p><strong>Email:</strong> {{ userEmail }}</p>
      </b-card>
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
      accessLevel: 0,
    }
  },
  created() {
    this.validateLogin()
  },
  methods: {
    validateLogin(){
      if(sessionStorage.getItem('is_logged')){
        this.isLogged = sessionStorage.getItem('is_logged')
        this.userEmail = sessionStorage.getItem('user_email')
        this.userName = sessionStorage.getItem('user_name')
        this.accessLevel = sessionStorage.getItem('user_access_level')
      }
    },
    logout(){
      this.$axios.post('/auth/logout')
      .then(res => {
        if(res.status == 200){
          sessionStorage.clear()
          location.reload()
        }
      })
    }
  }
}
</script>

<style scoped>
.nv {
  margin-left: 1% !important;
}

.bg-dark {
  background-color: #1c1c1c73 !important;
}

.search-sptf{
  border-radius: 80px;
  opacity: 50%;
  background-color: rgba(58, 52, 52, 0.66);
  -webkit-border-radius: 80px;
  -moz-border-radius: 80px;
  -ms-border-radius: 80px;
  -o-border-radius: 80px;
}
.search-sptf::placeholder {
  color: #ffffff;
}
</style>