<template>
  <div class="">
    <Header></Header>
      <div v-if="state">
        <SignIn v-on:mudarEstado="changeState"></SignIn>
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
import SignIn from '../components/Login/SignIn.vue'
import SignUp from './../components/Login/SignUp.vue'

export default {
  data(){
    return {
      state: 1, // 0 = sem conta; 1 = tem conta; 
    }
  },
  components:{
    Header, Footer, SignIn, SignUp
  },
  methods: {
    changeState(value){
      console.log(value)
      this.state = !value
    },
  },
}
</script>