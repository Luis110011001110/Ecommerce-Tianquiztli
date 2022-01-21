<template>
  <div class="payment">
    <h3>Ingresa tus datos</h3>
    <div ref="card"></div>
    <v-btn class="mt-10 mb-10" 
    @click="purchase">Pagar</v-btn>
  </div>
</template>

<script>
import router from "@/router";
let stripe = Stripe(
    `pk_test_51JyhMnFJ4bS3OxyyvLEqVjndg7EhW0PhtBXxJHxnBgGvJGJccDGjBXMNQOWfj4s3mbRrA8dUDFsBGIi4hBAEfriV00XCjclIhi`
  ),
  elements = stripe.elements(),
  card = undefined;

export default {
  mounted: function () {
    card = elements.create("card");
    card.mount(this.$refs.card);
  },
  methods: {
    purchase() {
      stripe.createToken(card).then(function (result) {
        if (result.error) {
          this.$swal.fire({
            icon: "error",
            title: "Error",
            text: "¡Por favor inténtalo nuevamente!",
            confirmButtonColor: "#3F51B5",
            timer: 4000,
            timerProgressBar: true,
          });
          self.hasCardErrors = true;
          self.$forceUpdate(); // Forcing the DOM to update so the Stripe Element can update.
          return;
        } else {
          localStorage.removeItem("products");
          router.push({ name: "Compras" });
        }
      });
    },
  },
};
</script>
<style scoped>
.payment {
  background-color: white;
}
</style>