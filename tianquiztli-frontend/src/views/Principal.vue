<template>
  <v-container fluid>
    <v-row 
      class="legend pt-1" 
      justify="center"
    >
      <p class="white--text mb-0">Todo nuestros productos son 100% mexicanos</p>
    </v-row>
    <v-row>
      <v-img 
        src="../assets/banner.jpg"
        max-width="auto"></v-img>
    </v-row>
    <!-- Cards de categorias -->
     <v-row class="mt-16 mb-10 d-flex justify-center" >
        <h1 class="text-center">¿PARA QUIÉN COMPRAS?</h1>
      </v-row>
    <v-row class="margin">
      <v-row justify="center">
        <v-col cols="4">
          <router-link to="/hombre">
            <v-card 
            class="mx-auto pt-5" 
            max-width="344"
            >
              <v-card-text>
                <h2>HOMBRE</h2>
              </v-card-text>
              <v-img 
                src="../assets/hombre.jpg" 
                max-width="auto"></v-img>
            </v-card>
          </router-link>
        </v-col>
        <v-col cols="4">
          <router-link to="/mujer">
            <v-card 
              class="mx-auto pt-5" 
              max-width="344"
            >
                <v-card-text>
                  <h2>MUJER</h2>
                </v-card-text>
                <v-img 
                  src="../assets/mujer.jpg" 
                  max-width="auto"></v-img>
            </v-card>
          </router-link>
        </v-col>
        <v-col cols="4">
          <router-link to="/ninos">
            <v-card 
              class="mx-auto pt-5" 
              max-width="344"
            >
              <v-card-text>
                <h2>NIÑOS</h2>
              </v-card-text>
              <v-img 
                src="../assets/nina.jpeg" 
                max-width="auto"></v-img>
            </v-card>
          </router-link>
        </v-col>
      </v-row>
    </v-row>
    <v-row>
      <v-img 
        src="../assets/banner2.jpg" 
        max-width="auto"></v-img>
    </v-row>
    <!-- Cards de informacion -->
    <v-row class="margin">
      <v-col cols="4">
        <v-card 
          class="mx-auto pt-5" 
          max-width="344"
        >
          <v-icon 
            x-large 
            color="green darken-2"
          >
            mdi-credit-card-check
          </v-icon>
          <v-card-text>
            <h2>Elige como pagar</h2>
          </v-card-text>

          <v-card-text>
            En tianquiztli, paga con tarjeta, débito o credito de forma segura. 
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="4">
        <v-card 
          class="mx-auto pt-5 mt-8" 
          max-width="344"
        >
          <v-icon 
            x-large 
            color="green darken-2"> mdi-truck </v-icon>
              <v-card-text>
                <h2>Envios con Fedex</h2>
              </v-card-text>
    
              <v-card-text>
                Con solo estar registrado en Tianquiztli, tienes envíos seguros
                desde la paqueteria de Fedex en todos los productos presentados.
              </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="4">
        <v-card 
          class="mx-auto pt-5" 
          max-width="344"
        >
          <v-icon 
            x-large 
            color="green darken-2"> mdi-shield-lock </v-icon>
          <v-card-text>
            <h2>Seguridad</h2>
          </v-card-text>

          <v-card-text>
            Seguridad, de principio a fin. Nos preocupaos por la
            seguridad de tu dinero y tu producto.
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <Footer/>
  </v-container>
</template>

<script lang="ts">
import Footer from "@/components/layouts/TheFooter.vue";

export default{
    components: { Footer },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.margin {
  margin-top: 130px !important;
  margin-bottom: 130px !important;
  text-align: center;
}

.legend {
  background-color: #107622;
}

a {
  text-decoration: none;
  color: #42b983 !important;
}
</style>
