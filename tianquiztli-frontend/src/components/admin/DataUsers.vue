<template>
  <v-row 
    justify="center">
    <v-col
      cols="12"
      sm="5"
      md="4"
      lg="10">
      <v-card 
        ref="form">
        <v-card-text>
          <v-text-field
            ref="Nombre"
            v-model="name_user"
            :rules="[() => !!name_user || 'El campo es requerido']"
            :error-messages="errorMessages"
            label="Nombre"
            required>
          </v-text-field>
          <v-text-field
            ref="Apellido"
            v-model="last_name"
            :rules="[() => !!last_name || 'El campo es requerido']"
            :error-messages="errorMessages"
            label="Apellido"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="email"
            :rules="[() => !!email || 'El campo es requerido']"
            label="Correo electroníco"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="phone"
            :rules="[() => !!phone || 'El campo es requerido']"
            label="Número de teléfono"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="zip_code"
            :rules="[() => !!zip_code || 'El campo es requerido']"
            label="Código Postal"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="adress"
            :rules="[() => !!adress || 'El campo es requerido']"
            label="Dirección"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="acount_number"
            :rules="[() => !!acount_number || 'El campo es requerido']"
            label="Número de cuenta"
            required>
            </v-text-field>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="success"
            dark
            large
            @click="saveUser()">
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
import axios from 'axios';
export default {
  data () {
    return {
      path: 'http://127.0.0.1:8000/api/v1',
      name_user:"",
      last_name:"",
      phone:"",
      email:"",
      password:"",
      zip_code:"",
      adress:"",
      acount_number:"",
      user: '',
      token: localStorage.token,
      id_user:localStorage.id
    }
  },
  methods:{
    getUser(){
      axios.get(`${this.path}/users/show/${this.id_user}?token=${this.token}`)
        .then(data => {
          this.user = data.data.user;
          this.name_user = this.user.name_user;
          this.last_name = this.user.last_name;
          this.phone = this.user.phone;
          this.email = this.user.email;
          this.zip_code = this.user.zip_code;
          this.adress = this.user.adress;
          this.acount_number = this.user.acount_number;
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No hay registros!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    saveUser(){
      let user = {
        name_user: this.name_user,
        last_name: this.last_name,
        phone: this.phone,
        email: this.email,
        zip_code: this.zip_code,
        adress:this.adress,
        acount_number:this.acount_number
      }
      axios.put(`${this.path}/users/edit/${this.id_user}?token=${this.token}`, user)
        .then(data => {
          this.$swal.fire({
            title: 'Guardado',
            text: 'Datos de usuario modificados',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
          this.getUser()
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡Por favor intentalo nuevamente!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    
  },
  created(){
    this.getUser()
  },
}
</script>

<style>
.legend {
  background-color: #107622;
}
a {
  text-decoration: none;
  color: #42b983 !important;
}
</style>
