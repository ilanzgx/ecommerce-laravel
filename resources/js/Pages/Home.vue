<template>
  <div class="w-screen h-screen bg-gray-200">
    <Header></Header>
    <Categories></Categories>
  </div>
</template>

<script>
import Header from './../components/Header.vue'
import Categories from './../components/Categories.vue'

export default {
  components:{
    Header, Categories
  }
}
</script>

<style>

</style>