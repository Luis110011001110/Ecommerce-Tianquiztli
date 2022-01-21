<template>
  <v-row
    justify="center">
    <v-container
      cols="12"
      v-if="showTable==true">
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th 
                class="text-center">
                  ID
              </th>
              <th 
                class="text-center">
                  Estado de envio
              </th>
              <th 
                class="text-center">
                  Estado de pago
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(sale,index) in sales"
              :key="sale.id">
              <td>{{ sale.id }}</td>
              <td>{{ sale.send_status }}</td>
              <td>{{ sale.pay_status }}</td>
              <v-btn
                  class="mx-1 mt-2 mr-2"
                  fab
                  x-small
                  dark
                  color="cyan"
                  @click="updateButtonEstado(index)">
                  <v-icon dark>
                    mdi-eye 
                  </v-icon>
                </v-btn>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-container>
    <v-col
      v-if="showTable==false"
      cols="10"
      sm="5"
      md="4"
      lg="10">
      <v-card 
        ref="form">
        <v-card-text>
          <h1>
            Estado actual : {{this.sale.send_status}}
          </h1>
          <v-autocomplete
            ref=""
            v-model="selection"
            :rules="[() => !! selection || 'This field is required']"
            :items="estados"
            item-value= "id"
            label="Estados de envio"
            required>
          </v-autocomplete>
          <v-container
            cols="12">
            <v-simple-table>
              <template 
                v-slot:default>
                <thead>
                  <tr>
                    <th 
                      class="text-center">
                        Nombre
                    </th>
                    <th 
                      class="text-center">
                        Piezas
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(product) in products"
                    :key="product.id">
                    <td>{{ product.product_name }}</td>
                    <td>{{ product.piece}}</td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-container> 
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
          <v-spacer></v-spacer>
          <v-btn
            color="success"
            class="mt-2 mb-2 ml-2 mr-12"
            dark
            large
            @click="updateState()">
            Actualizar estado
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
    token: localStorage.token,
    id_artisan: localStorage.id_artisan,
    sales:'',
    sale:'',
    products:'',
    send_status:'',
    showTable:true,
    estados: [ "Pendiente", 'En Preparacion', 'Enviado']
  }
},
 methods:{
   getSales(){
      axios.get(`${this.path}/sales/index/-1/${this.id_artisan}?token=${this.token}`)
        .then(data => {
          this.sales = data.data.sales;
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No hay ventas!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    showForm () {
      this.showTable = false;
    },
    hideForm () {
      this.showTable = true
    },
    updateButtonEstado(index){
      this.showForm()
      this.sale = this.sales[index];

      this.getProducts()

    },
    getProducts(){
      axios.get(`${this.path}/sale_details/index/${this.sale.id}/-1?token=${this.token}`)
        .then(data => {
          this.products = data.data.sale_detail;
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No hay productos!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    updateState(){
      let sale = {
        "send_status": this.selection,
        "total": this.sale.total,
        "pay_status": this.sale.pay_status
      }
      axios.put(`${this.path}/sales/edit/${this.sale.id}?token=${this.token}`, sale)
        .then(data => {
          this.$swal.fire({
            title: 'Guardado',
            text: 'Estado de venta modificado',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
          this.hideForm();
          this.getSales();
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

    }
  },
  created(){
    this.getSales()
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
