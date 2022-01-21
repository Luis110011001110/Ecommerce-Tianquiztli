<template>
    <v-container>
      <form @submit.prevent="createNewUser()">
        <h1 align-left 
         justify-left> 
         Completa tus datos</h1>
         <v-row >
           <span>Todos los datos son obligatorios</span>
         </v-row>
          <v-row 
           justify="center"> 
            <v-col cols="6">
               <h3>Nombre</h3>
                <v-text-field
                   label="Nombre"
                   single-line
                   outlined
                   v-model="name"
                   :rules="stringRules">
                </v-text-field>
            </v-col>
            <v-col cols="6">
                   <h3>Apellidos</h3>
                   <v-text-field
                   label="Apellidos"
                   single-line
                   outlined
                   v-model="last_name"
                   :rules="stringRules">
                </v-text-field>
            </v-col>
          </v-row>
          <v-row 
          justify="center"> 
            <v-col cols="6">
                   <h3>Correo electrónico</h3>
               <v-text-field
                   label="Correo electrónico"
                   single-line
                   outlined
                   v-model="email"
                   :rules="emailRules">
               </v-text-field>
            </v-col>
            <v-col cols="6">
                   <h3>Contraseña</h3>
                <v-text-field
                   label="Contraseña"
                   single-line
                   type="password"
                   outlined
                   v-model="password"
                   aria-autocomplete="off">
                </v-text-field>
            </v-col>
          </v-row>
         <v-row 
          justify="left"> 
            <v-col 
            cols="6" 
            class="pt-2 pb-2">
                     <v-checkbox 
                        id="checkArtisan"
                        v-model="checkbox"
                        :label="`Vendedor/Artesano`">
                     </v-checkbox>
            </v-col>
         </v-row>
         <v-row 
          justify="center"
          v-if="this.checkbox==true"
          > 
            <v-col cols="6">
                <h3>Nombre de la Tienda</h3>
                <v-text-field
                  label="Nombre de la Tienda"
                  single-line
                  outlined
                  v-model="shop_name"
                  :rules="stringRules">
                </v-text-field>
            </v-col>
            <v-col cols="6">
                <h3>Descripcion de la Tienda</h3>
                <v-text-field
                  label="Descripcion de la Tienda"
                  single-line
                  outlined
                  v-model="shop_desc"
                  :rules="stringRules">
                </v-text-field>
            </v-col>
          </v-row>
         <v-row 
          justify="center"> 
            <v-col cols="6">
              <v-btn block
                id="btn-registrarme"
                type="submit">
                Registrarme
              </v-btn>
            </v-col>
         </v-row> 
      </form>
    </v-container>
</template>

<script>

import axios from 'axios';
import router from '@/router';

export default{
  data () {
    return {
      checkbox: false,
      name: "",
      last_name: "",
      email: "",
      password: "",
      shop_name: "",
      shop_desc: "",
      path: 'http://127.0.0.1:8000/api/v1',
      emailRules: [ 
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'El correo debe ser valido'
      ],
      stringRules: [ 
        v => /^[a-zA-Z ]+$/.test(v) || 'Solo letras'
      ]
    }
  },
  methods: {
    createNewUser(){
      if(this.checkbox.toString() == "true"){
        let artisan = {
          "shop_name": this.shop_name,
          "shop_desc": this.shop_desc
        } 
        
        axios.post(`${this.path}/artisans/store`, artisan)
        .then(data => {
          let id_artisan = data.data.artisan.id;
          this.storeUser(id_artisan);
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

      }else{
        this.storeUser(null);
      }
    },
    storeUser(id_artisan){
      let user = {
        "name_user": this.name,
        "last_name": this.last_name,
        "email": this.email,
        "password": this.password,
        "id_artisan": id_artisan == null ? "" : id_artisan,
        "artisan": id_artisan == null ? false : true
      }

      axios.post(`${this.path}/users/store`, user)
        .then(data => {
          this.$swal.fire({
            title: 'Guardado',
            text: 'Usuario guardado',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
        
          router.push({ name: "Login"});
         
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
    },
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.margin {
  margin-top: 130px !important;
  margin-bottom: 130px !important;
}

#btn-registrarme {
  background-color: #33AFFF;
  color: #fff;
}

.legend {
  background-color: #107622;
}

a {
  text-decoration: none;
  color: #42b983 !important;
}
</style>