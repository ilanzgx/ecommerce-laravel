<template>
  <div>
    <Header></Header>
    <div>
      <div>
        <img class=" w-64 h-64" :src="'data:image/png;base64,' + data.qr_code_base64" alt="">
      </div>
      
      <p>{{  data.qr_code }}</p>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../../components/Header.vue'
import Footer from './../../components/Footer.vue'

export default {
  components: {
    Header, Footer
  },
  props: {
    data: Object,
  },
}
</script>

<style>

</style>