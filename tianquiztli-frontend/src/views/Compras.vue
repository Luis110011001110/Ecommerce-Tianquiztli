<template>
  <v-container>
    <h1>Bienvenido al apartado de Compras</h1>
    <h1>Productos Comprados</h1>
    <v-row class="margin">
      <v-row class="mb-10" 
      justify="center">
        <v-col cols="3">
          <v-card class="max-auto pt-5">
            <v-img class="m-16" 
            src="../assets/hombre.jpg" max-width="auto">
            </v-img>
          </v-card>
        </v-col>
        <v-col cols="5">
          <v-card-text>
            <p>Estado: Entregado</p>
            <p>Nombre del Producto: Sombrero</p>
            <p>Fecha de compra: 02/07/2021</p>
            <p>Precio: $700</p>
            <p>Total de compra: $700</p>
          </v-card-text>
        </v-col>
        <v-col cols="4">
          <router-link to="/">
            <v-btn id="btn-comprar"> Volver a comprar </v-btn>
          </router-link>
        </v-col>
        <br />
      </v-row>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class Compras extends Vue {}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.margin {
  margin-top: 130px !important;
  margin-bottom: 130px !important;
}

#btn-comprar {
  text-decoration: none;
  background-color: #00b91f;
  color: #fff;
}
</style>