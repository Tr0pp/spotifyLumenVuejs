<template>
  <div id="app">
    <Navbar/>
    <router-view></router-view>
  </div>
</template>

<script>

import Navbar from "./components/shared/Navbar";
export default {
  name: 'App',
  components: {Navbar},
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;

  background-image: url(assets/img/bg.png);
  display: block;
  background-repeat: no-repeat;
  background-attachment: fixed;
}
</style>
