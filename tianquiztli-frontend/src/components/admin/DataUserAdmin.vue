<template>
  <v-row
    justify="center"
    col=10 
    class = "mt-4">
    <v-container>
      <v-row
        justify="center">
      </v-row>
      <v-simple-table>
      <template >
        <thead>
          <tr>
            <th 
              class="text-center">
              ID
            </th>
            <th 
              class="text-center">
              Nombre
            </th>
            <th 
              class="text-center">
              Apellido
            </th>
            <th 
              class="text-center">
              Tipo
            </th>
            <th 
              class="text-center">
              Dirección
            </th>
            <th 
              class="text-center">
              No. de Cuenta
            </th>

            <th 
              class="text-center">
              Correo electroníco
            </th>

            <th 
              class="text-center">
              Número de teléfono
            </th>
            
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(user) in users"
            :key="user.id">
            <td>{{ user.id}}</td>
            <td>{{ user.name_user }}</td>
            <td>{{ user.last_name }}</td>
            <td>{{ user.artisan}}</td>
            <td>{{ user.adress }}</td>
            <td>{{ user.acount_number }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.phone }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </v-container>
   
  </v-row>
  
</template>

<script>
import axios from 'axios';
export default {
  data () {
    return {
      path:'http://127.0.0.1:8000/api/v1',
      users:'',
      token: localStorage.token,
      id_artisan:localStorage.id_artisan,
    }
  },
  methods:{
    getUser(){
      axios.get(`${this.path}/users/index/-1?token=${this.token}`)
        .then(data => {
          this.users = data.data.users;
          for (let i = 0; i<this.users.length; i++){
            this.users[i]['artisan']  = this.users[i]['artisan'] == 0 ? 'Comprador' : 'Artesano'
          }
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


  },
  created(){
    this.getUser();
  }
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
