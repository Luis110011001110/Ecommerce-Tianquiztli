<template>
  <v-row
    justify="center">
    <v-col
      cols="10"
      sm="5"
      md="4"
      lg="10"
      v-if="showTable==false">
      <v-card 
        ref="form">
        <v-card-text>
          <v-text-field
            ref="Nombre"
            v-model="nombre_category"
            :rules="[() => !!nombre_category || 'El campo es requerido']"
            :error-messages="errorMessages"
            label="Nombre"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="descripcion"
            :rules="[() => !!descripcion || 'This field is required']"
            label="Descripción"
            required>
          </v-text-field>
        </v-card-text>
        <v-divider 
          class="mt-2">
        </v-divider>
        <v-card-actions>
          <v-btn
            color="error"
            class="mt-2 mb-2 ml-12 mr-2"
            dark
            large
            @click="hideForm">
            Cancelar
          </v-btn>
          <v-spacer>
          </v-spacer>
          <v-btn
            color="success"
            class="mt-2 mb-2 ml-2 mr-12"
            dark
            large
            v-if="showButton==false"
            @click="saveCategoria()">
            Guardar
          </v-btn>
          <v-btn
            color="success"
            v-if="showButton==true"
            class="mt-2 mb-2 ml-2 mr-12"
            dark
            large
            @click="updateCategory()">
            Actualizar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
    <v-container
      cols="12"
      v-if="showTable==true">
      <v-row
        justify="center">
        <v-btn
          color="cyan"
          class="mt-5 mb-8"
          dark
          large
          @click="showForm(1)" >
            Agregar Categoria
        </v-btn>
      </v-row>
        <v-simple-table>
          <template 
            v-slot:default>
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
                  Descripción
                </th>
                <th 
                class="text-center">
                  
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(category,index) in categories"
                :key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.category }}</td>
                <td>{{ category.description }}</td>
                <v-btn
                  class="mx-1 mt-2 mr-2"
                  fab
                  x-small
                  dark
                  color="cyan"
                  @click="updateButtonCategory(index)">
                  <v-icon dark>
                    mdi-pencil  
                  </v-icon>
                </v-btn>
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
    path: 'http://127.0.0.1:8000/api/v1',
    categories:'',
    category:'',
    nombre_category:'',
    descripcion:'',
    token: localStorage.token,
    showTable: true,
    showButton: false,
    id_category:''
  }
 },
  methods:{
    showForm (type) {
      this.showTable = false;
      if (type == 1){
        this.showButton = false;
      }
    },
    hideForm () {
      this.showTable = true
      this.nombre_category ='';
      this.descripcion='';
    },
    getCategori(){
      axios.get(`${this.path}/categories/index`)
        .then(data => {
          this.categories = data.data.categories;
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No hay categorias!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    updateButtonCategory(index){
      this.showForm();
      this.showButton = true;
      this.category = this.categories[index];
      this.nombre_category = this.category.category
      this.descripcion = this.category.description
      this.id_category = this.category.id
    },
    updateCategory(){
      let category = {
        "category": this.nombre_category,
        "description": this.descripcion,
      }
      axios.put(`${this.path}/categories/edit/${this.id_category}?token=${this.token}`, category)
        .then(data => {
          this.$swal.fire({
            title: 'Guardado',
            text: 'Categoria modificada',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
          this.hideForm();
          this.getCategori();
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
    saveCategoria(){
      let category={
        "category": this.nombre_category,
        "description":this.descripcion
      }
      axios.post(`${this.path}/categories/store?token=${this.token}`, category)
        .then(data => {
          this.$swal.fire({
            title: 'Guardado',
            text: 'Categoría guardada',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
          this.hideForm();
          this.showTable = true;
          this.getCategori();    
    
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
           this.hideForm();
        });
      this.showTable = true
    }
  },
  created(){
    this.getCategori()
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
