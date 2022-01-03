<template>
  <div>
    <b-form class="col-md-9 ml-5" @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
          id="input-group-1"
          label-for="input-1"
      >
        <b-form-input
            id="input-1"
            v-model="form.email"
            type="email"
            placeholder="Digite seu email"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" class="text-center" label-for="input-2">
        <b-form-input
            type="password"
            id="text-password"
            v-model="form.password"
            aria-describedby="password-help-block"
            placeholder="Digite sua senha"
            required
        ></b-form-input>
      </b-form-group>
      <div class="text-center">
        <b-button size="sm" type="submit" variant="success">Entrar</b-button>
      </div>
    </b-form>

    <!--    <b-card class="mt-3" header="Form Data Result">-->
    <!--      <pre class="m-0">{{ form }}</pre>-->
    <!--    </b-card>-->
  </div>
</template>
<script>

export default {
  name: 'FormLogin',

  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      show: true,
    }
  },
  methods: {
    onSubmit(event){
      event.preventDefault()
      this.login()
    },
    onReset(event){
      event.preventDefault()
      this.form.email = ''
      this.form.password = ''
      // Trick to reset/clear native browser form validation state
      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    },
    login(){
      this.$axios.post('/auth', this.form)
          .then((res) => {
            if(res.status == 200){
              sessionStorage.setItem('user_id', res.data.user_data.user_id)
              sessionStorage.setItem('user_name', res.data.user_data.user_name)
              sessionStorage.setItem('user_email', res.data.user_data.user_email)
              sessionStorage.setItem('user_access_level', res.data.user_data.access_level_user)
              sessionStorage.setItem('token_type', res.data.token_type)
              sessionStorage.setItem('token', res.data.token)
              sessionStorage.setItem('is_logged', res.data.user_data.is_logged)

              location.reload()
            }
          })
          .catch((err) => console.log(err))
    }
  }
}
</script>