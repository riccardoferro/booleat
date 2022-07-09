<template>
  <div class="container-fluid pb-5">
    <!-- Intro Ristorante -->
    <div class="row pt-5 justify-content-center text-sm-center pb-5">
      <div
        class="
          col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-6
          t4-img-restaurant
          d-md-block d-sm-block d-none
          mb-5
        "
      >
        <img :src="imagePut(restaurant.image)" alt="" />
      </div>
      <div
        class="col-xxl-4 col-md-7 col-sm-10 col-12 text-sm-center text-center"
      >
        <h2>
          Benvenuto da {{ restaurant.company }}!
          <span class="t4-icon-company ms-2">
            <img src="/images/posate.png" alt="" />
          </span>
        </h2>
        <h4 class="mt-3 mb-3">{{ restaurant.address }}</h4>
        <span class="t4-orange-text">Categorie:</span>
        <span
          v-for="category in categories"
          :key="category.slug"
          class="t4-badge-category"
        >
          {{ category.name }}
        </span>
        <p class="mt-3">
          Chiude alle ore 23:00 - Consegna gratuita - Minimo d'ordine: 10&euro;
        </p>
        <p>Ordina i tuoi piatti oppure prenota subito un ritiro</p>
      </div>
    </div>
    <!-- Menu Piatti -->
    <div class="row flex-column justify-content-center mt-5">
      <h2 class="text-center">
        Menù
        <span class="t4-menu-food">
          <img src="/images/menu-food.png" alt="" />
        </span>
      </h2>
      <div
        class="
          row
          d-flex
          col-xxl-9 col-xl-10 col-lg-8 col-md-9 col-sm-7 col-9
          m-auto
          mt-3
          justify-content-center
        "
      >
        <!-- Piatti -->
        <div
          v-for="plate in plates"
          :key="plate.name + plate.id"
          class="row col-sm-10 col-md-5 col-xl-3 d-flex flex-column t4-card"
        >
          <!-- Immagine -->
          <div class="t4-card-img">
            <img :src="'storage/' + plate.image" alt="" />
          </div>

          <!-- Nome -->
          <div class="t4-card-title">
            <span class="t4-card-label">Nome Piatto</span>
            <p>{{ plate.name }}</p>
          </div>

          <!--Descrizione  -->
          <div class="t4-card-description">
            <span class="t4-card-label">Descrizione </span>
            <p>{{ plate.description }}</p>
          </div>

          <!-- Disponibile e non disponibile -->
          <div class="t4-card-info d-flex justify-content-between">
            <p><span>Prezzo: </span>{{ plate.price }} &euro;</p>
            <div v-if="plate.visible == 1">
              <p style="color: rgb(4, 165, 4)">Disponibile</p>
            </div>
            <div v-else>
              <p style="color: rgb(165, 4, 4)">Non disponibile</p>
            </div>
          </div>

          <div class="t4-card-buttons d-flex justify-content-center">
            <button
              v-if="addButtonControl(cart, plate) && plate.visible == 1"
              @click="
                () => {
                  currentPlate = plate;
                }
              "
              type="button"
              class="btn t4-add-btn"
              data-bs-toggle="modal"
              data-bs-target="#staticBackdrop"
            >
              <span class="me-2">Aggiungi al carrello</span>
              <img src="/images/shopping-bag.png" alt="shopping-bag" />
            </button>

            <!-- Piatto non disponibile -->
            <div
              v-else-if="plate.visible == 0"
              class="btn t4-add-btn d-flex align-items-center"
            >
              <span class="me-2">Piatto non disponibile</span>
              <img src="/images/sad.png" alt="shopping-bag" />
            </div>

            <div
              class="modal fade"
              id="staticBackdrop"
              data-bs-backdrop="static"
              data-bs-keyboard="false"
              tabindex="-1"
              aria-labelledby="staticBackdropLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content t4-bg-black">
                  <!-- Bottone scegli la quantita' -->
                  <div class="d-flex align-items-center justify-content-center">
                    <h5
                      class="modal-title t4-orange-text text-center"
                      id="staticBackdropLabel"
                    >
                      Scegli la quantità
                    </h5>

                    <button
                      type="button"
                      class="btn t4-btn-add"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    >
                      <span class="t4-close"
                        ><img src="/images/cross.png" alt=""
                      /></span>
                    </button>
                  </div>

                  <div
                    class="
                      modal-body
                      d-flex
                      justify-content-center
                      align-items-center
                    "
                  >
                    <!-- Decrement quantiy -->
                    <div
                      @click="
                        () => {
                          decr();
                        }
                      "
                      class="t4-w10"
                    >
                      <img class="t4-w80" src="/images/minus1.png" alt="" />
                    </div>

                    <div class="t4-w40 text-center">
                      <span class="t4-orange-text t4-fs-1">{{
                        orederQuantity
                      }}</span>
                    </div>

                    <!-- Increment quantity -->
                    <div
                      @click="
                        () => {
                          incr();
                        }
                      "
                      class="t4-w10"
                    >
                      <img class="t4-w80" src="/images/plus1.png" alt="" />
                    </div>
                  </div>

                  <!-- Bottone conferma aggiunta al carrello-->
                  <div
                    class="modal-footer d-flex justify-content-center"
                    data-bs-dismiss="modal"
                  >
                    <button
                      @click="
                        () => {
                          pushToCart(orederQuantity, currentPlate);
                        }
                      "
                      type="button"
                      class="btn t4-add-btn"
                    >
                      <span class="">Conferma</span>
                      <img src="/images/check.png" alt="check" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Fine Piatti -->
      </div>

      <div v-if="last_page !== 1" class="row">
        <div class="d-flex justify-content-center pt-5">
          <button
            :disabled="current_page != 1 ? false : true"
            class="btn t4-add-btn me-3"
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

    <div class="t4-card-buttons d-flex justify-content-center mt-5 mb-2">
      <a
        href="http://127.0.0.1:8000/"
        class="btn t4-add-btn d-flex align-items-center"
      >
        <span class="me-2">Home</span>
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
      orederQuantity: 0,
      currentPlate: {},
      currentPage: "",
      prevPage: "",
      nextPage: "",
      current_page: "",
      last_page: "",
      totalPages: 0,
      url_getUser: "http://127.0.0.1:8000/api/users/",
      slug: this.$route.params.slug,
    };
  },

  props: {
    cart: Array,
  },

  mounted() {
    this.loadPage(this.url_getUser + this.slug);
  },

  methods: {
    loadPage(url) {
      // console.log(slug);
      window.axios
        .get(url)
        .then((results) => {
          console.log("results", results);
          if (results.status === 200 && results.data.success) {
            this.restaurant = results.data.results;
            this.plates = results.data.plates.data;

            this.nextPage = results.data.plates.next_page_url;
            this.prevPage = results.data.plates.prev_page_url;
            this.last_page = results.data.plates.last_page;
            this.current_page = results.data.plates.current_page;
            this.totalPages = results.data.plates.total;
            this.categories = this.restaurant.categories; //   console.log('category'.)
          }
          // console.log(this.restaurant);
        })
        .catch((e) => {
          console.log(e);
        });
    },

    nextPageFunction() {
      this.url_getUser = this.nextPage;
      this.loadPage(this.url_getUser);
    },

    prevPageFunction() {
      this.url_getUser = this.prevPage;
      this.loadPage(this.url_getUser);
    },

    addItem(plate) {
      this.$emit("takeItem", plate);
      //   console.log("carrello", this.cart);
    },
    removeItem(plate) {
      this.$emit("removeItem", plate);
    },
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

    incr() {
      this.orederQuantity++;
    },
    decr() {
      this.orederQuantity--;
    },

    pushToCart(number, elem) {
      for (let index = 0; index < number; index++) {
        elem.quantity = 0;
        this.addItem(elem);
      }
      this.orederQuantity = 0;
    },
    addButtonControl(arr, elem) {
      if (arr.length > 0 && arr[0].user_id == elem.user_id) {
        return true;
      } else if (arr.length == 0) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.t4-img-restaurant {
  img {
    width: 100%;
    border-radius: 20px;
  }
}

.t4-menu-food {
  img {
    width: 50px;
  }
}

.t4-close {
  img {
    width: 35px;
  }
}
</style>
