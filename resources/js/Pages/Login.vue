<template>
  <div class="">
    <Header></Header>
      <div v-if="flash != undefined" class="bg-red-500 text-gray-50 my-2 px-3 py-1">
        <p class="font-medium">{{ flash.new[0] }}</p>
      </div>
      <div v-if="state == 1">
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
import SignIn from './../components/Login/SignIn.vue'
import SignUp from './../components/Login/SignUp.vue'

export default {
  data(){
    return {
      state: this.action, // 0 = sem conta; 1 = tem conta;
    }
  },
  props:{
    action: String,
    flash: Object,
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