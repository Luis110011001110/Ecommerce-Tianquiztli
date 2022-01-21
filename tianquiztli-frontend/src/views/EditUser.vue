<template>
  <v-container>
    <!--Seccion de campos  -->
    <v-row class="margin">
      <v-row 
      class="mb-11" 
      justify="center">
        <v-col cols="10">
          <h1>Mi cuenta</h1>
          <span>(Nombre, Apellidos y correo son obligatorios)</span>
          <!--Muestra contorno de la caja para los campos-->
          <v-card 
          class="max-auto pt-5 mt-5" 
          max-width="1700">
            <div class="row pb-2">
              <div class="col-4">
                <v-card-text> <h3>Nombre:</h3> </v-card-text>
                <v-text-field
                  label="Nombre (s) del usuario"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="name"
                  :rules="stringRules"
                >
                </v-text-field>
              </div>

              <div class="col-4">
                <v-card-text> <h3>Apellidos:</h3> </v-card-text>
                <v-text-field
                  label="Apellido paterno y materno"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="last_name"
                  :rules="stringRules"
                >
                </v-text-field>
              </div>

              <div class="col-4">
                <v-card-text> <h3>Telefono:</h3> </v-card-text>
                <v-text-field
                  label="Telefono"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="phone"
                  :rules="numberRules"
                >
                </v-text-field>
              </div>

              <div class="col-4">
                <v-card-text> <h3>Correo:</h3> </v-card-text>
                <v-text-field
                  label="Correo"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="email"
                  :rules="emailRules"
                >
                </v-text-field>
              </div>
              <div class="col-4">
                <v-card-text> <h3>Codigo postal:</h3> </v-card-text>
                <v-text-field
                  label="C.P"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="zipcode"
                  :rules="numberRules"
                >
                </v-text-field>
              </div>

              <div class="col-8">
                <v-card-text> <h3>Dirección:</h3> </v-card-text>
                <v-text-field
                  label="Dirección"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="address"
                >
                </v-text-field>
              </div>

              <div class="col-4">
                <!---->
                <v-card-text> <h3>Numero de Cuenta:</h3> </v-card-text>
                <v-text-field
                  label="Tipo de cuenta"
                  single-line
                  class="mb-5 pl-10 pr-10"
                  outlined
                  v-model="account_number"
                >
                </v-text-field>
              </div>
            </div>
          </v-card>
        </v-col>

        <!--seccion de botones-->
        <v-col cols="6">
          <v-card 
          class="mx-auto p-16" 
          max-width="800">
            <router-link to="/">
            <v-btn 
            class="ma-5" 
            justify="center" 
            id="btn-cancelar">
              Cancelar</v-btn>
            </router-link>
            <v-btn 
            class="ma-5" 
            justify="center" 
            id="btn-cambio"
            @click="updateUser()">
              Aplicar cambios
            </v-btn>
          </v-card>
        </v-col>
      </v-row>
    </v-row>
  </v-container>
</template>

<!--scripts y estilos-->
<script>
import axios from "axios";

export default {
  data() {
    return {
      name:"",
      last_name:"",
      phone:"",
      email:"",
      zipcode:"",
      address:"",
      account_number:"",
      id_user: localStorage.id,
      token: localStorage.token,
      path: 'http://127.0.0.1:8000/api/v1',
       emailRules: [ 
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'El correo debe ser valido'
      ],
      stringRules: [ 
        v => /^[a-zA-Z ]+$/.test(v) || 'Solo letras'
      ],
      numberRules: [ 
        v => /^[0-9]+$/.test(v) || 'Solo numeros'
      ]
    }
  },
  methods:{
  getUser(){
    axios.get(`${this.path}/users/show/${this.id_user}?token=${this.token}`)
      .then(data => {
        let user = data.data.user;
        this.name = user.name_user;
        this.last_name = user.last_name;
        this.phone = user.phone;
        this.email = user.email;
        this.zipcode = user.zip_code;
        this.address = user.adress;
        this.account_number = user.acount_number;
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
  updateUser(){
      let user = {
        "name_user": this.name,
        "last_name": this.last_name,
        "phone": this.phone,
        "email": this.email,
        "zip_code": this.zipcode,
        "adress": this.address,
        "acount_number": this.account_number,
      }

      axios.put(`${this.path}/users/edit/${this.id_user}?token=${this.token}`, user)
        .then(data => {
          this.$swal.fire({
            title: 'Actualizado',
            text: 'Usuario actualizado',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
         
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
  },
  mounted(){
    this.getUser(); 
  }
};
</script>

<style scoped>
#btn-cambio {
  background-color: #00b91f;
  color: #fff;
}

#btn-cancelar {
  background-color: #f31515;
  color: #fff;
}

a {
  text-decoration: none;
}

</style>
