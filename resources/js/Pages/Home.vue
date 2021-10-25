<template>
  <div class="w-screen h-screen bg-gray-200">
    <Header></Header>
    <Categories></Categories>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../components/Header.vue'
import Categories from './../components/Categories.vue'
import Footer from './../components/Footer.vue'

export default {
  components:{
    Header, Categories, Footer
  }
}
</script>

<style>

</style>