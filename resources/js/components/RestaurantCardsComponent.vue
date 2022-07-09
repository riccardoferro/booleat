<template>
  <div>
    <div class="container-fluid">
      <h2 class="text-center pt-5">
        In evidenza
        <span class="t4-star">
          <img src="/images/star.png" alt="star" />
        </span>
      </h2>
      <div
        class="
          row
          justify-content-lg-start
          justify-content-sm-center
          justify-content-center
          pt-5
        "
      >
        <!-- inizio card -->
        <div
          class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6 mb-5"
          v-for="user in users"
          :key="user.id"
        >
          <!-- SEZIONE CHE TI PORTA AL SINGOLO RISTORANTE  -->
          <router-link
            :to="{ name: 'single-restaurant', params: { slug: user.slug } }"
            class="
              d-flex
              flex-column
              justify-content-center
              align-items-center
              t4-card-hover t4-img-company
            "
          >
            <!-- FINE SEZIONE SINGOLO RISTORANTE  -->

            <div
              class="col-xxl-10 col-xl-8 col-lg-7 col-md-10 col-sm-12 col-12"
            >
              <img :src="imagePut(user.image)" alt="" />
            </div>
            <div class="mt-3">
              <h6
                class="
                  t4-orange-text t4-fw-6
                  d-flex
                  align-items-center
                  t4-name-company
                "
              >
                {{ user.company }}
              </h6>
              <!-- <h6 class="mb-3 t4-fw-6">
                <span class="t4-orange-text">Categorie:</span>
                <span
                  v-for="category in user.categories"
                  :key="category.slug"
                  class="t4-fw-4"
                >
                  {{ category.name }}
                </span>
              </h6> -->
            </div>
          </router-link>
        </div>
        <!-- fine card -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "RestaurantCardsComponent",
  props: {
    users: Array,
  },
  methods: {
    // Funzione per l'immagine profilo ristoratorante!
    imagePut(string) {
      let newString;

      if (string.includes("uploads")) {
        newString = `/storage/${string}`;
      } else if (string.includes("https")) {
        return string;
      } else {
        newString = `/images/default-restaurant.jpeg`;
        return newString;
      }
    },

    // Funzione immagine categoria
    categoryIcon(string) {
      switch (string) {
        case "Fast Food":
          return (string = "/images/category_img/burger.png");
        case "Pizza":
          return (string = "/images/category_img/pizza.png");
        case "Cinese":
          return (string = "/images/category_img/noodles.png");
        case "Giapponese":
          return (string = "/images/category_img/sushi.png");
        case "Poke":
          return (string = "/images/category_img/rice.png");
        case "Dessert":
          return (string = "/images/category_img/dessert.png");
        case "Tailandese":
          return (string = "/images/category_img/pad-thai.png");
        case "Italiano":
          return (string = "/images/category_img/pasta.png");
        case "Smoothie":
          return (string = "/images/category_img/boba.png");
        case "Gelato":
          return (string = "/images/category_img/ice-cream.png");
        case "Vegano":
          return (string = "/images/category_img/vegan.png");
        case "Gluten Free":
          return (string = "/images/category_img/wheat.png");
        case "Vegetariano":
          return (string = "/images/category_img/vegetarian-food.png");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.t4-card-hover {
  transition: all 0.2s ease-in-out;
  &:hover {
    transform: scale(0.9);
  }
}

.t4-star {
  img {
    width: 35px;
  }
}

.t4-img-company {
  position: relative;
}

.t4-name-company {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 12px 15px;
  -webkit-backdrop-filter: blur(6px);
  backdrop-filter: blur(6px);
  background-color: rgba(0, 0, 0, 0.4);
  border-radius: 20px;
  font-weight: 600;
  color: #fd7d2b;
  text-align: center;
}
</style>
