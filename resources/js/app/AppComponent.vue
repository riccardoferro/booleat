<template>
  <div>
    <div>
      <HeaderComponent @takeItem="addItem" :cart="cart" />

      <router-view @takeItem="addItem" :cart="cart"></router-view>
    </div>
  </div>
</template>

<script>
import HeaderComponent from "../components/HeaderComponent.vue";

export default {
  name: "AppComponent",
  components: {
    HeaderComponent,
  },
  data() {
    return {
      cart: [],
      newPlate: null,
    };
  },

  methods: {
    // creazione oggetto

    addItem(plate) {
      let value = plate;

      if (this.cart.length == 0 && value) {
        this.cart.push(value);
        this.saveCart(this.cart);
      } else {
        if (value.user_id == this.cart[0].user_id) {
          this.cart.push(value);
          this.saveCart(this.cart);
        }
      }

      console.log("valore ", value);
      console.log("id-user", value.user_id);
      // console.log("carrello",this.cart);
    },

    saveCart() {
      const parsed = JSON.stringify(this.cart);
      localStorage.setItem("cart", parsed);
    },
  },

  mounted() {
    if (localStorage.getItem("cart")) {
      try {
        this.cart = JSON.parse(localStorage.getItem("cart"));
      } catch (error) {
        console.log(error);
        localStorage.removeItem("cart");
      }
    }
  },
};
</script>

<style>
</style>
