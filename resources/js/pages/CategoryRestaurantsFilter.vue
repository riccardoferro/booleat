<template>
  <div class="container-fluid pb-5">
    <h2 class="mt-5 text-center">
      Seleziona una categoria e visualizza i ristoranti disponibili
    </h2>

    <!-- <div class="row">
          <BoxCategoriesFilter :categoriesArr="categoriesArr" :category="category"/>
      </div> -->

    <div class="mt-5">
      <div class="d-flex justify-content-center flex-wrap">
        <div
          class="form-check form-check-inline mb-3"
          v-for="category in categories"
          :key="category.slug"
        >
          <input
            class="btn-check"
            type="checkbox"
            :value="category.slug"
            :id="'category' + category.id"
            :checked="categoriesArr.includes(category.slug)"
            @click="
              () => {
                toggleCheckbox(category.slug);
                getUsersPerCategories(url_getUsers);
              }
            "
          />

          <label class="btn t4-add-btn" :for="'category' + category.id">
            {{ category.name }}
          </label>
        </div>
      </div>
    </div>

    <div
      class="row pt-5 justify-content-center"
      v-if="categoriesArr.length > 0"
    >
      <!-- inizio card -->
      <div
        class="
          col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7 col-10
          mb-5
          d-flex
          flex-column
          align-items-center
          t4-resturant-label
        "
        v-for="user in users"
        :key="user.id"
      >
        <!-- Attraverso il router link verremo riportati in un'altra pagine dove vedremo i dettagli del ristorante -->
        <router-link
          :to="{ name: 'single-restaurant', params: { slug: user.slug } }"
          class="d-flex flex-column align-items-center mt-5 mb-5"
        >
          <div>
            <h6 class="t4-orange-text t4-fw-6 d-flex align-items-center">
              {{ user.company }}
              <span class="t4-icon-company ms-2">
                <img src="/images/posate.png" alt="" />
              </span>
            </h6>

            <h6 class="mb-3 t4-fw-6">
              <span class="t4-orange-text">Categorie:</span>
              <span v-for="category in user.categories" :key="category.slug">
                {{ category.name }}
              </span>
            </h6>
          </div>

          <div
            class="
              col-xxl-8 col-xl-8 col-lg-8 col-md-10 col-sm-12
              t4-img-company
            "
          >
            <img :src="imagePut(user.image)" alt="" class="img-fluid" />
          </div>
        </router-link>
      </div>
      <!-- fine card -->
    </div>
    <div v-else>
      <div class="d-flex justify-content-center align-items-center mt-5">
        <span class="t4-warning me-2">
          <img src="/images/warning.png" alt="warning" />
        </span>
        Seleziona una categoria per visualizzare un ristorante
      </div>
    </div>

    <div v-if="users.length > 0 && categoriesArr.length > 0" class="row">
      <div class="d-flex justify-content-center">
        <button
          :disabled="current_page != 1 ? false : true"
          class="btn t4-add-btn me-3 current_pag"
          @click="
            () => {
              prevPageFunction();
            }
          "
        >
          <span class="t4-icon-btn me-2">
            <img src="/images/left-arrow.png" alt="prev" />
          </span>
          Precedente
        </button>

        <button
          :disabled="current_page != last_page ? false : true"
          class="btn t4-add-btn"
          @click="
            () => {
              nextPageFunction();
            }
          "
        >
          Successivo
          <span class="t4-icon-btn ms-2">
            <img src="/images/right-arrow.png" alt="next" />
          </span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
// import box category filter
import BoxCategoriesFilter from "../components/BoxCategoriesFIlter.vue";

export default {
  name: "CategoryRestaurantsFilter",
  components: {
    BoxCategoriesFilter,
  },

  data() {
    return {
      users: [],
      categories: [],
      selected: [],
      categoriesArr: [this.$route.params.slug],
      currentPage: "",
      prevPage: "",
      nextPage: "",
      url_getUsers: "http://127.0.0.1:8000/api/category/",
      current_page: "",
      last_page: "",
    };
  },
  mounted() {
    this.getUsersPerCategories(this.url_getUsers);
    this.getAllCategories("http://127.0.0.1:8000/api/categories");
  },
  methods: {
    // Prende tutti ristoranti in base alle categorie
    getUsersPerCategories(url) {
      // console.log("this selected", this.categoriesArr);
      window.axios
        .get(url, {
          params: {
            value: this.categoriesArr,
          },
        })
        .then((results) => {
          if (results.status === 200) {
            this.users = results.data.data;
            this.nextPage = results.data.next_page_url;
            this.prevPage = results.data.prev_page_url;
            this.last_page = results.data.last_page;
            this.current_page = results.data.current_page;
            // console.log(this.users);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    // Prende tutte le categoria
    getAllCategories(url) {
      window.axios
        .get(url)
        .then((results2) => {
          if (results2.status === 200 && results2.data.success) {
            this.categories = results2.data.results2;
          }
          //   console.log(this.categories);
        })
        .catch((e) => {
          console.log(e);
        });
    },

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

    toggleCheckbox(el) {
      if (this.categoriesArr.includes(el)) {
        const index = this.categoriesArr.indexOf(el);
        this.categoriesArr.splice(index, 1);
      } else {
        this.categoriesArr.push(el);
      }
    },

    nextPageFunction() {
      this.url_getUsers = this.nextPage;
      this.getUsersPerCategories(this.url_getUsers);
    },

    prevPageFunction() {
      this.url_getUsers = this.prevPage;
      this.getUsersPerCategories(this.url_getUsers);
    },

    //
  },
};
</script>

<style lang="scss" scoped>
.t4-icon-btn {
  img {
    width: 20px;
  }
}
</style>
