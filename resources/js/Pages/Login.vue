<template>
  <div class="">
    <Header></Header>
      <div v-if="state">
        <LogIn v-on:mudarEstado="changeState"></LogIn>
      </div>
      <div v-else>
        <SignUp v-on:mudarEstado="changeState"></SignUp>
      </div>
    <Footer></Footer>
  </div>  
</template>

<script>
import Header from './../components/Header.vue'
import Footer from './../components/Footer.vue'
import LogIn from './../components/Login/LogIn.vue'
import SignUp from './../components/Login/SignUp.vue'

export default {
  data(){
    return {
      state: 1, // 0 = sem conta; 1 = tem conta; 
    }
  },
  components:{
    Header, Footer, LogIn, SignUp
  },
  methods: {
    changeState(value){
      console.log(value)
      this.state = !value
    },
  },
}
</script>

<style>

</style>