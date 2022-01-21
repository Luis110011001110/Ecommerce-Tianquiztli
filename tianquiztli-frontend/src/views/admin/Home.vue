<template>
  <v-row>
    <v-col
      cols="12">
      <v-card >
        <v-card-title 
          class="legend">
          <span 
            class="text-h5">
              Menu
          </span>
          <v-spacer></v-spacer>
          <v-menu
            bottom
            left>
            <template 
              v-slot:activator="{ on, attrs }">
              <v-btn
                dark
                icon
                v-bind="attrs"
                v-on="on">
                <v-icon>
                  mdi-dots-vertical
                </v-icon>
              </v-btn>
            </template>
            <v-list 
              class="cursor">
              <v-list-item>
                <v-list-item-title
                  @click="changeView('data-users')">
                    Mis datos
                </v-list-item-title>
              </v-list-item>
              <v-list-item
                v-if="id_user != 1">
                  <v-list-item-title
                    @click="changeView('data-products')">
                      Mis Productos
                  </v-list-item-title>
              </v-list-item>
                <v-list-item
                  v-if="id_user != 1">
                  <v-list-item-title
                    @click="changeView('data-sales')">
                      Mis Ventas
                  </v-list-item-title>
              </v-list-item>
                <v-list-item
                  v-if="id_user == 1">
                  <v-list-item-title
                    @click="changeView('data-categories')">
                      Categorías
                </v-list-item-title>
              </v-list-item>

              <v-list-item
                 v-if="id_user == 1">
                <v-list-item-title
                  @click="changeView('data-sales-admin')">
                    Ventas
                </v-list-item-title>
              </v-list-item>

              <v-list-item
                v-if="id_user == 1">
                <v-list-item-title
                  @click="changeView('data-user-admin')">
                    Usuarios
                </v-list-item-title>
              </v-list-item>
              
              <v-list-item>
                <v-list-item-title
                  @click="exit()">
                    Cerrar Sesión
                </v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-card-title>
        <v-card-text 
          class="pt-5 pb-5">
          <component 
            v-bind:is="currentComponent">
          </component>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
 
import DataProducts from '@/components/admin/DataProducts.vue';
import DataSales from '@/components/admin/DataSales.vue';
import DataUsers from '@/components/admin/DataUsers.vue';
import DataSalesAdmin from '@/components/admin/DataSalesAdmin.vue';
import DataCategories from '@/components/admin/DataCategories.vue';
import DataUserAdmin from '@/components/admin/DataUserAdmin.vue';
import { bus } from '@/main';


export default {
  data(){
    return{
      id_user:localStorage.id,
      currentComponent:"data-users"
    }
  },
    components:{
      DataUsers, 
      DataProducts,
      DataCategories,
      DataSalesAdmin,
      DataSales,
      DataUserAdmin 
    },
    methods:{
      changeView(etiqueta){
        this.currentComponent = etiqueta
      },
      exit(){
        bus.$emit('logout');
      }
    }
}
</script>

<style scoped>
.cursor{
  cursor: pointer;
}
.legend {
  background-color: #107622;
  color: white;
}

a {
  text-decoration: none;
  color: #42b983 !important;
}
</style>
