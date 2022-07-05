<template>
  <div class="container-fluid">
    <div class="row text-center mt-5">
      <h2>Benvenuto da {{ restaurant.company }}!</h2>
      <h4>
        Ordina i tuoi piatti oppure prenota un ritiro in
        {{ restaurant.address }}
      </h4>
    </div>

    <div class="row text-center mt-3">
      <div class="col-12">
        <span class="t4-orange-text">Categorie:</span>
        <span
          v-for="category in categories"
          :key="category.slug"
          class="t4-badge-category"
        >
          {{ category.name }}
        </span>
      </div>
    </div>

    <div class="row flex-column justify-content-center mt-5">
      <div
        class="
          row
          d-flex
          col-xxl-10 col-xl-10 col-md-11 col-sm-12
          m-auto
          mt-3
          justify-content-center
        "
      >
        <div
          v-for="plate in plates"
          :key="plate.name + plate.id"
          class="row col-sm-10 col-md-5 col-xl-3 d-flex flex-column t4-card"
        >
          <div class="t4-card-img">
            <img :src="'storage/' + plate.image" alt="" />
          </div>
          <div class="t4-card-title">
            <span class="t4-card-label">Nome Piatto</span>
            <p>{{ plate.name }}</p>
          </div>
          <div class="t4-card-description">
            <span class="t4-card-label">Descrizione </span>
            <p>{{ plate.description }}</p>
          </div>

          <div class="t4-card-info d-flex justify-content-between">
            <p><span>Prezzo: </span>{{ plate.price }} &euro;</p>
            <div v-if="plate.visible == 1">
              <p style="color: rgb(4, 165, 4)">Disponibile</p>
            </div>
            <div v-else>
              <p style="color: rgb(165, 4, 4)">Non disponibile</p>
            </div>
          </div>

          <div
            v-if="plate.visible == 1"
            class="t4-card-buttons d-flex justify-content-center"
          >
            <!-- PULSANTE CARRELLO -->
            <a
              v-if="cart.length == 0 || cart[0].user_id == plate.user_id"
              @click.prevent="addItem(plate)"
              href="#"
              class="btn t4-add-btn d-flex align-items-center"
            >
              <span class="me-2">Aggiungi al carrello</span>
              <img src="/images/shopping-bag.png" alt="shopping-bag" />
            </a>

            <p v-else>pijatela nder culo taccogno</p>
          </div>
          <!-- v-else -->
          <div
            v-if="plate.visible == 0"
            class="t4-card-buttons d-flex justify-content-center"
          >
            <!-- PULSANTE CARRELLO -->
            <div class="btn t4-add-btn d-flex align-items-center">
              <span class="me-2">Piatto non disponibile</span>
              <img src="/images/shopping-bag.png" alt="shopping-bag" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="t4-card-buttons d-flex justify-content-end mt-5 mb-2">
      <a
        href="http://127.0.0.1:8000/"
        class="btn t4-add-btn d-flex align-items-center"
      >
        <span class="me-2">Torna alla Home</span>
        <img src="/images/home.png" alt="home" />
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleRestaurant",
  data() {
    return {
      restaurant: [],
      plates: [],
      categories: [],
    };
  },

  props: {
    cart: Array,
  },

  mounted() {
    const slug = this.$route.params.slug;
    console.log(slug);

    window.axios
      .get("http://127.0.0.1:8000/api/users/" + slug)
      .then((results) => {
        console.log("results Single Restaurant->", results);
        if (results.status === 200 && results.data.success) {
          this.restaurant = results.data.results;
          this.plates = this.restaurant.plates;
          this.categories = this.restaurant.categories; //   console.log('category'.)
        }
        console.log(this.restaurant);
      })
      .catch((e) => {
        console.log(e);
      });
  },

  methods: {
    addItem(plate) {
      this.$emit("takeItem", plate);
    },
    removeItem(plate) {
      this.$emit("removeItem", plate);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
