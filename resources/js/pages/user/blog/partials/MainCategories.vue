<template>
  <div class="container lv-con-sect-categories">
    <!-- MAIN CATEGORIES: WRITTEN ARTICLES, AUDIO AND VIDEO, SECTION START -->
    <div v-for="category in main_categories"
         :key="category.id"
         class="card"
         style="width: 20rem;"
    >
      <div class="card-body">
        <h5 class="card-title">
          {{ category.card_title }}
        </h5>
      </div>
      <router-link :to="{ name: category.img_redirect_to }">
        <img :src="category.img_src" class="d-block w-100" alt="...">
      </router-link>
      <div class="card-body">
        <p class="card-text">
          {{ category.card_body }}
        </p>
      </div>
      <div class="card-body">
        <a v-for="subcategory in category.subcategories"
           :key="subcategory.id"
           :href="subcategory.url"
        >
          {{ subcategory.name }}
        </a>
      </div>
    </div>
    <!-- MAIN CATEGORIES: WRITTEN ARTICLES, AUDIO AND VIDEO, SECTION END -->
  </div>
</template>

<script>
export default {
  name: 'MainCategories',
  components: {},
  data: function () {
    return {
      main_categories: [
        {
          id: 1,
          card_title: 'ARTICOLE',
          img_redirect_to: 'article.index',
          img_src: '/images/cards/Card-img0.png',
          card_body: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.',
          subcategories: [
            {
              id: 1,
              url: 'article.index',
              name: 'Subcategorie 1'
            },
            {
              id: 2,
              url: 'article.index',
              name: 'Subcategorie 2'
            },
            {
              id: 3,
              url: 'article.index',
              name: 'Subcategorie 3'
            }
          ]
        },
        {
          id: 2,
          card_title: 'AUDIO',
          img_redirect_to: 'audio.index',
          img_src: '/images/cards/Card-img1.png',
          card_body: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.',
          subcategories: [
            {
              id: 1,
              url: 'audio.index',
              name: 'Subcategorie 1'
            },
            {
              id: 2,
              url: 'audio.index',
              name: 'Subcategorie 2'
            },
            {
              id: 3,
              url: 'audio.index',
              name: 'Subcategorie 3'
            }
          ]
        },
        {
          id: 3,
          card_title: 'VIDEO',
          img_redirect_to: 'video.index',
          img_src: '/images/cards/Card-img2.png',
          card_body: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.',
          subcategories: [
            {
              id: 1,
              url: 'video.index',
              name: 'Subcategorie 1'
            },
            {
              id: 2,
              url: 'video.index',
              name: 'Subcategorie 2'
            },
            {
              id: 3,
              url: 'video.index',
              name: 'Subcategorie 3'
            }
          ]
        }
      ]
    }
  },
  computed: {}
}
</script>
