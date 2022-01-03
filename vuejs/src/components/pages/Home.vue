<template>
  <div>
    <h1 class="text-white pt-5">Música para todos.</h1>
    <h5 class="text-white">Milhões de músicas à sua escolha.</h5>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data(){
    return {
      userLogged: []
    }
  },
  created() {
    this.listUsers()
  },
  methods: {
    listUsers(){
      if(sessionStorage.getItem('is_logged') || sessionStorage.getItem('is_logged') !== undefined){
        this.$axios.defaults.headers.common['Authorization'] = `${sessionStorage.getItem('token_type')} ${sessionStorage.getItem('token')}`
        this.$axios.get(`/users/${sessionStorage.getItem('user_id')}`)
        .then((res) =>{
          this.userLogged = res.data
        })
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
