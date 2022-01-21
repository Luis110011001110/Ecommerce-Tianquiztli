<template>
    <v-container>
      <h1>Categorias</h1>
        <v-row 
        class="margin">
          <v-row class="mb-10" 
          justify="center">
            <v-col 
            cols="6"
            v-for="categorie in categories"
            :key="categorie.id">
              <v-card
              class="max-auto pt-10 pb-10 mb-10"
              id="tarjeta"
              >
                <h1>{{categorie.category}}</h1>
                <br>
                <v-card-text>
                  <h3>{{categorie.description}}</h3>
                </v-card-text>
              </v-card>
            </v-col>

          </v-row>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios';
export default {
  data(){
    return {
      categories: "",
      path:'http://127.0.0.1:8000/api/v1'
    }
  },
  methods:{
    getCategories(){
      axios.get(`${this.path}/categories/index/`).then(data => {
        this.categories = data.data.categories;
      }).catch(error => {
        
      });
    }
  },
  mounted(){
    this.getCategories();
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.margin {
  margin-top: 30px !important;
  margin-bottom: 50px !important;
}

h3{
  color: #fff;
}

#tarjeta{
  background-color: #107622;
  color: #fff;
  opacity: 0.9;
}

</style>
