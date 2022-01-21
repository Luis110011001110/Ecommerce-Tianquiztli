<template>
  <div>
    <stripe-checkout />
  </div>
</template>
<script>
import { defineComponent } from "@vue/composition-api";
import { StripeCheckout } from "@vue-stripe/vue-stripe";

export default defineComponent({
  components: {
    StripeCheckout,
  },
});
</script>
