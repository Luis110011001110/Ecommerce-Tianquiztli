<template>
    <v-container fluid>
      <h1>Bienvenido</h1>
        <v-row 
        class="margin">
          <v-row 
          justify="center">
          <v-col cols="4">
            <form @submit.prevent="login">
              <v-card
              class="max-auto"
              max-width="600">
                <h1>Inicio de sesión</h1>
                <br>
                  <v-card-text>
                    <h3>Usuario</h3>
                  </v-card-text>
                  <v-text-field
                  label="Ingresar correo electronico"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="email"
                  :rules="emailRules">
                  </v-text-field>
                    <v-card-text>
                      <h3>Contraseña</h3>
                    </v-card-text>
                  <v-text-field
                  label="Ingresar contraseña"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="password"
                  type="password"
                  aria-autocomplete="off">
                  </v-text-field>
                  <router-link to="/Register">
                    <v-btn
                    class="ma-5"
                    id="btn-registrarme"
                    >
                    Registrarme
                    </v-btn>
                  </router-link>
                    <v-btn
                    class="ma-5"
                    id="btn-entrar"
                    type="submit"
                    >
                    Entrar
                    </v-btn>
              </v-card>
            </form>
             </v-col>
            <v-col cols="6">
              <v-card 
              class="mx-auto p-16"
              max-width="800">
                <v-img
                class="m-16"
                src="../assets/logo.jpeg"
                max-width="auto">
                </v-img>
              </v-card>
            </v-col>
          </v-row>
        </v-row>
    </v-container>
</template>

<script>

import axios from 'axios';
import router from '@/router';
import { bus } from '../main';

export default {
  name: 'login',
  data (){
    return {
      email: "",
      password: "",
      error: false,
      error_message:"",
      emailRules: [ 
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'El correo debe ser valido'
      ]
    }
  },
  methods:{
    login(){
      let json = {
        "email": this.email,
        "password": this.password
      } 
      
      let path = 'http://127.0.0.1:8000/api/v1';
      axios.post(`${path}/users/login`, json)
      .then(data => {
        let dataAPI = data.data;
        localStorage.id = dataAPI['user'][0].id;
        localStorage.name = dataAPI['user'][0].name_user+" "+dataAPI['user'][0].last_name;
        localStorage.artisan = dataAPI['user'][0].artisan;
        localStorage.id_artisan = dataAPI['user'][0].id_artisan;
        localStorage.token = dataAPI.token;

        this.$swal.fire({
          title: '¡Bienvenido!',
          text: 'Inicio de Sesión Exitoso',
          icon: 'success',
          confirmButtonColor: '#3F51B5',
          timer: 4000,
          timerProgressBar: true
        })
        
        if(localStorage.artisan == 0){
          bus.$emit('login');
          router.push({ name: "Products"});
        }else{
          bus.$emit('login');
          router.push({ name: "Home"});
          
        }
        
      })
      .catch(error => {
        this.$swal.fire({
          icon: 'error',
          title: 'Error',
          text: '¡Por favor inténtalo nuevamente!',
          confirmButtonColor: '#3F51B5',
          timer: 4000,
          timerProgressBar: true
        });
      });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.margin {
  margin-top: 30px !important;
  margin-bottom: 50px !important;
}

#btn-entrar {
  background-color: #00B91F;
  color: #fff;
}

#btn-registrarme {
  background-color: #33AFFF;
  color: #fff;
}

</style>
