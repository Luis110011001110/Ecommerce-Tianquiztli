<template>
  <v-app id="app">
    <v-main>
      <Header />
      <router-view></router-view>
      <Footer />
    </v-main>
  </v-app>
</template>

<script>

import Header from "@/components/layouts/TheHeader.vue";

export default{
  data(){
    return{
    }
  },
  components: {
    Header,
  }
}
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Arimo&display=swap");

#app {
  font-family: "Arimo", Helvetica, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
