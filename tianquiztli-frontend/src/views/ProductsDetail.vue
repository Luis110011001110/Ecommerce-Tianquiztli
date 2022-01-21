<template>
  <div>
      <v-row class="mb-15">
        <v-col cols="6" 
        offset="1"
        >
          <v-card max-width="800" class="mb-10">
            <v-img
              height="800"
              :src="this.img"
            ></v-img>
          </v-card>
        </v-col>
        <v-col cols="3" class="text-left">
          <h1>{{product.product_name}}</h1>
          <p>$ {{product.price}}</p>
          <p>Talla</p>
          <p>{{product.size}}</p>
          <p class="mt-5">DESCRIPCIÓN</p>
          <ul>
            <li>Dimensiones: {{product.dimentions}}</li>
            <li>Peso: {{product.product_weight}}</li>
            <li>Hecho en México</li>
          </ul>
          <v-btn @click="addProduct"
          color="cyan"
          block
          class="mt-10"
          >Agregar</v-btn>
        </v-col>
      </v-row>
    </div>
</template>
<script>
import axios from "axios";
import router from "@/router";
export default {
  data() {
    return {
      product: "",
      img: "",
      path: "http://127.0.0.1:8000/api/v1",
      productID: this.$route.params.productID,
    };
  },
  methods: {
    getProducts() {
      axios.get(`${this.path}/products/show/${this.productID}`).then((data) => {
        this.product = data.data.product;
      }).catch((error)=>{
        console.log(error.message);
      });
    },
    getImage() {
      axios.get(`${this.path}/images/index/${this.productID}`).then((data) => {
        this.img = data.data.images[0].img_name;
      });
    },
    addProduct() {
      let products = [];
      if (localStorage.getItem("products")) {
        products = JSON.parse(localStorage.getItem("products"));
      }
      products.push(this.product);
      localStorage.setItem("products", JSON.stringify(products));
    },
    goTo(id){
      router.push({
          name: 'ProductsDetail', 
          params: { productID: id }
      });      
    }
  },
  created() {
    this.getImage();
    this.getProducts();
    
  },
};
</script>

<style scoped>
.text-left {
  text-align: left;
}
</style> 
