<template>
  <div>
    <b-alert class="col-md-9 ml-5" v-model="errorRegister" variant="danger" dismissible>
      {{ errMsg }}
    </b-alert>
    <b-form class="col-md-9 ml-5" @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
          id="input-group-1"
          label-for="input-1"
          description="Nunca compartilharemos seu e-mail com mais ninguém."
      >
        <b-form-input
            id="input-1"
            v-model="form.email"
            type="email"
            placeholder="Digite seu email"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label-for="input-2">
        <b-form-input
            id="input-2"
            v-model="form.name"
            placeholder="Digite seu nome"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label-for="input-2">
        <b-form-input
            type="password"
            id="text-password"
            v-model="form.password"
            aria-describedby="password-help-block"
            placeholder="Digite uma senha"
            required
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-2" label-for="input-2">
        <b-form-input
            type="password"
            id="text-password_confirm"
            v-model="form.password_confirm"
            aria-describedby="password-help-block"
            placeholder="Repita a senha"
            required
        ></b-form-input>
        <b-form-text id="password-help-block">
          Sua senha deve ter de 8 a 20 caracteres, conter letras e números, e não
          conter espaços, caracteres especiais, ou emoji.
        </b-form-text>
      </b-form-group>
      <div class="text-center">
        <b-button size="sm" type="submit" variant="success">Inscrever-se</b-button>
      </div>
    </b-form>

<!--    <b-card class="mt-3" header="Form Data Result">-->
<!--      <pre class="m-0">{{ form }}</pre>-->
<!--    </b-card>-->
  </div>
</template>
<script>

export default {
  name: 'FormRegister',

  data() {
    return {
      form: {
        email: '',
        name: '',
        password: '',
        password_confirm: '',
      },
      show: true,
      errorRegister: false,
      errMsg: '',
    }
  },
  methods: {
    onSubmit(event){
      event.preventDefault()
      this.register()
    },
    onReset(event){
      event.preventDefault()
      this.form.email = ''
      this.form.name = ''
      this.form.password = ''
      this.form.password_confirm = ''
      // Trick to reset/clear native browser form validation state
      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    },
    register(){
      this.$axios.post('/auth/register', this.form)
          .then((res) => {
            if(res.data.error == 1){
              this.errorRegister = true
              this.errMsg = res.data.message
            }
          })
          .catch((err) => console.log(err))
    }
  }
}
</script>