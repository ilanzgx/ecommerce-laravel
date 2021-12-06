<template>
  <div>
    <Header></Header>
    <Categories></Categories>
    <div>
      Offers
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../../components/Header.vue'
import Footer from './../../components/Footer.vue'
import Categories from './../../components/Categories.vue'

export default {
  components:{
    Header, Footer, Categories
  },

}
</script>