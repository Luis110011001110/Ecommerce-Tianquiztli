<template>
  <v-container 
    fluid
    v-if="artisan != 1">
    <v-row :elevation="5">
      <v-col cols="3">
        <v-img
          src="../../assets/logo.jpeg"
          max-width="200px"
          class="image mb-5"
        ></v-img>
      </v-col>
      <v-col 
        cols="4">
        <div class="d-flex justify-center"></div>
      </v-col>
      <v-col 
      cols="2"
      class="mt-5"
      >
        <router-link to="/productos">Productos</router-link>
        |
        <router-link to="/categories">Categorias</router-link>
      </v-col>
      <v-col 
      cols="3"
      class="mt-5 pr-16"
      >
        <div class="d-flex justify-center mb-5">
          <router-link to="/carrito">
            <v-icon c
              class="ml-12 mr-5" 
              color="green darken-2"
              >
              mdi-cart
            </v-icon>
          </router-link>
          <router-link 
          to="/compras"
          v-if="user">
            <v-icon 
              class="ml-5 mr-5" 
              color="green darken-2"
              >
                mdi-shopping
            </v-icon>
          </router-link>
          <router-link 
          to="/Usuarios" 
          v-if="user">
            <v-icon 
              class="ml-5 mr-5" 
              color="green darken-2"
              >
                mdi-account-circle
            </v-icon>
          </router-link>
          <router-link 
          to="/Login" 
          v-if="!user">
            <v-icon 
              class="ml-5 mr-5" 
              color="green darken-2"
              >
                mdi-account-circle
            </v-icon>
          </router-link>
          <v-btn
          v-if="user"
          @click.prevent="logout()">
            <v-icon 
              class="ml-5 mr-5" 
              color="green darken-2"
              >
                mdi-account-arrow-right
            </v-icon>
          </v-btn>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>

import router from '@/router';
import { bus } from '../../main';

export default {
  data(){
    return{
      user: localStorage.name,
      artisan: localStorage.artisan,
      products: localStorage.products
    }
  },
  methods:{
    logout(){
      localStorage.clear();
      this.user = null;
      this.artisan = null;
      router.push({ name: "Login"});
    }
  },
  created() {
    bus.$on('login', function () {
      this.user = localStorage.name;
      this.artisan = localStorage.artisan;
    }.bind(this));

    bus.$on('logout', function () {
      this.logout();
    }.bind(this));
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.image {
  display: block;
  margin: auto !important;
}

a {
  text-decoration: none;
  color: #107622 !important;
}
</style>
