<template>
  <div>
    <v-footer 
      dark 
      padless 
      id="fondo"
    >
        <v-card 
          class="flex" 
          flat tile id="fondo"
        >
            <v-card-text class="pb-0 white--text">
              Copyright © 2021-{{ new Date().getFullYear() }} tianquiztli.com de
              México S. de R.L. de C.V
            </v-card-text>
    
            <v-card-text class="pb-3 white--text">
              Universidad Autónoma del Estado de México, Paraje el Tejocote, San
              Pedro Tlaltizapan, 52640 Santiago Tianguistenco, Méx.
              <v-spacer></v-spacer>
            </v-card-text>
        </v-card>
    </v-footer>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class Footer extends Vue {}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#fondo {
  background-color: #107622;
}

#fondo2 {
  background-color: #9b9b9b;
}
</style>
