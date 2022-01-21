<template>
  <div>
    <h1>Carrito</h1>
    <v-row class="mt-10 mr-10 ml-10">
      <v-col class="ml-10" 
      :xs="12" 
      :sm="12" 
      :md="8" 
      :lg="8" 
      :xl="8">
        <v-card
          v-for="(product, index) in products"
          :key="index"
          tile
          class="mx-10 mb-10"
        >
          <div class="content-price-product">
            <v-row class="ml-5 mr-5" 
            align="center" 
            justify="center">
              <v-col
                ><p>{{ product.product_name }}</p>
              </v-col>
              <v-col
                ><p>Talla</p>
                <p>{{ product.size }}</p></v-col
              >
              <v-col
                ><p>Precio</p>
                <p>${{ product.price }}</p></v-col
              >
              <v-col>
                <v-btn
                  color="error"
                  fab
                  x-small
                  elevation="1"
                  @click="deleteProduct(index)"
                  >X</v-btn
                ></v-col
              >
            </v-row>
          </div>
        </v-card>
      </v-col>
      <v-col class="ml-10" 
      :xs="12" 
      :sm="12" 
      :md="3" 
      :lg="3" 
      :xl="3">
        <v-card tile 
        class="mb-10">
          <div class="content-price">
            <p>Resumen</p>
            <v-divider />
            <v-row>
              <v-col cols="6"> <p>Total de Artículos:</p></v-col>
              <v-col cols="6"
                ><p>{{ products.length }}</p></v-col
              >
            </v-row>
            <v-divider />
            <v-row>
              <v-col cols="6"> <p>Envío:</p></v-col>
              <v-col cols="6"><p>--</p></v-col>
            </v-row>
            <v-divider />
            <v-row>
              <v-col cols="6"> <p>Total:</p></v-col>
              <v-col cols="6">
                <p>${{ filterPrice }} MXN</p>
                <span>IVA Incluido</span>
              </v-col>
            </v-row>
            <v-divider />
            <v-btn class="mt-5"
            @click="checkout()">Pagar</v-btn>
          </div>
        </v-card>
      </v-col>
    </v-row>
      <v-dialog v-model="dialogVisible">
        <payment-dialog ></payment-dialog>
      </v-dialog>
  </div>
</template>
<script>
import PaymentDialog from "../components/cart/ThePaymentDialog.vue";
import router from "@/router";
export default {
  components: { PaymentDialog },
  data() {
    return {
      products: [],
      dialogVisible: false,
      token: localStorage.token,
    };
  },
  methods: {
    deleteProduct(index) {
      this.products.splice(index,1)
      localStorage.setItem("products", JSON.stringify(this.products));
    },
    async checkout() {
      if(this.products.length>0){
          if(this.token){
            this.dialogVisible = true;
          }else{
            router.push({ name: "Login" });
          }
      }
    },
  },
  computed: {
    filterPrice() {
      let price = 0;
      this.products.forEach((product) => {
        price = price + product.price;
      });
      return price;
    },
  },
  async beforeMount() {
    if (localStorage.getItem("products")) {
      this.products = JSON.parse(localStorage.getItem("products"));
    }
  },
};
</script>
<style scoped>
.content-price {
  padding: 15px 0px;
  align-self: center;
}
.content-price-product {
  padding: 15px 0px;
}
.color-item {
  border-radius: 50%;
  height: 10px;
  width: 10px;
  background-color: black;
  margin-left: 85px;
}
</style>