<template>
  <div>
    <h1>Productos</h1>
    <v-row class="products">
      <v-col
        :xs="12"
        :sm="12"
        :md="6"
        :lg="4"
        :xl="4"
        v-for="product in this.products"
        :key="product.id"
      >
        <v-card max-width="400" outlined class="mx-auto my-12 mayuscula">
          <v-img
            v-if="product.image"
            height="450"
            :src="product.image"
            alt="Imagen"
          ></v-img>
          <v-img
            v-else
            height="450"
            src="@/assets/camara-no-existe.jpg"
            alt="Imagen"
          ></v-img>
          <v-card-title>
            <strong>
              {{ product.product_name }}
            </strong></v-card-title
          >
          <v-card-text>
            <v-row>
              <v-col cols="6">
                <h2 class="text-left">{{ product.size }}</h2>
              </v-col>
              <v-col cols="6" 
              class="text-right">
                <v-chip color="green" 
                text-color="white">
                  <h3>{{ product.category }}</h3>
                </v-chip>
              </v-col>
            </v-row>
            <v-row align="center">
              <v-col cols="6" 
              class="text-left">
                <strong class="precio">$ {{ product.price }}</strong>
              </v-col>
              <v-col cols="3" 
              class="text-right">
                <v-btn
                  class="mx-2"
                  fab
                  dark
                  color="cyan"
                  @click="addProduct(product)"
                >
                  <v-icon dark>shopping_cart</v-icon>
                </v-btn>
              </v-col>
              <v-col cols="2" 
              class="text-right">
                <v-btn class="mx-2" 
                @click="goTo(product.id)"
                fab>
                  <v-icon dark>mdi-eye</v-icon>
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-dialog v-model="dialogShow"></v-dialog>
  </div>
</template>


<script>
import axios from "axios";
import router from "@/router";
export default {
  data() {
    return {
      products: "",
      img: "",
      path: "http://127.0.0.1:8000/api/v1",
      showProduct: "",
      dialogShow: false
    };
  },
  methods: {
    async getProducts() {
      axios.get(`${this.path}/products/index/-1/-1/`).then((data) => {
        this.products = data.data.products;
        this.filtrar();
      });
    },
    async getImage() {
      axios.get(`${this.path}/images/index/-1/`).then((data) => {
        this.img = data.data.images;
      });
    },
    filtrar() {
      for (var i = 0; i < this.products.length; i++) {
        let imagen = this.img.filter(
          (img) => img.id_product == this.products[i].id
        );
        this.products[i].image = imagen[0].img_name;
      }
    },
    addProduct(product) {
      this.$swal.fire({
        title: 'Producto agregado',
        text: 'Producto agregado con exito al carrito',
        icon: 'success',
        confirmButtonColor: '#3F51B5',
        timer: 4000,
        timerProgressBar: true
        })
      let products = [];
      if (localStorage.getItem("products")) {
        products = JSON.parse(localStorage.getItem("products"));
        console.log(products);
      }
      products.push(product);
      localStorage.setItem("products", JSON.stringify(products));
    },
    goTo(id){
      router.push({
          name: 'ProductsDetail', 
          params: { productID: id }
      });      
    }
  },
  async created() {
    await this.getImage();
    await this.getProducts();
  },
};
</script>

<style scoped>
.products {
  text-align: center;
}
h1 {
  text-align: center;
  margin-left: 20px;
}
.precio {
  font-size: 25px;
}
.mayuscula {
  text-transform: uppercase;
}
</style>