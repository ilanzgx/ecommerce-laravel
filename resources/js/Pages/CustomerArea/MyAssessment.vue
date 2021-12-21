<template>
  <div>
    <Header></Header>
    <div class="my-4 mx-2">
      <h1 class="mb-5 text-xl">Avalie: <span class="font-semibold">{{ product_data.name }}</span></h1>

      <form @submit.prevent="sendData">
        <div class="">
          <label class="text-gray-50 text-sm" for="">Quantas estrelas esse produto merece?</label>
          <div class="flex">
            <span @click="stars=1" class="cursor-pointer">
              <svg :class="{'text-purple-500': stars >= 1}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            </span>

            <span @click="stars=2" class="cursor-pointer">
              <svg :class="{'text-purple-500': stars >= 2}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            </span>

            <span @click="stars=3" class="cursor-pointer">
              <svg :class="{'text-purple-500': stars >= 3}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            </span>

            <span @click="stars=4" class="cursor-pointer">
              <svg :class="{'text-purple-500': stars >= 4}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            </span>

            <span @click="stars=5" class="cursor-pointer">
              <svg :class="{'text-purple-500': stars >= 5}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            </span>
          </div>
        </div>

        <div>
          <label class="text-gray-50 text-sm" for="">Titulo</label>
          <input :class="{'border-red-500': errors != undefined && errors.title}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="title" type="text">
          <div v-if="errors != undefined && errors.title">
            <ul v-for="errors in errors.title" :key="errors.id">
              <li class="text-red-500 text-sm">{{ errors }}</li>
            </ul>
          </div>
        </div>

        <div>
          <label class="text-gray-50 text-sm" for="">Texto do que você achou</label>
          <input :class="{'border-red-500': errors != undefined && errors.text}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="text" type="text">
          <div v-if="errors != undefined && errors.text">
            <ul v-for="errors in errors.text" :key="errors.id">
              <li class="text-red-500 text-sm">{{ errors }}</li>
            </ul>
          </div>
        </div>

        <div class="my-6">
          <button class="w-full bg-purple-500 text-gray-50 font-medium px-8 py-4 rounded-md" type="submit">
            <div v-if="loading" class="flex justify-center items-center">
              <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
            </div>
            <span v-else>Salvar</span>
          </button>
        </div>
        
      </form>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../../components/Header.vue'
import Footer from './../../components/Footer.vue'
import axios from 'axios'

export default {
  data(){
    return {
      loading: false,
      errors: {},
      title: '',
      stars: 5,
      text: '',
    }
  },
  props: {
    token: String,
    product_data: Object,
  },
  components: {
    Header, Footer
  },
  methods: {
    sendData(){
      this.loading = true
      axios.post('/api/assessment/create', {
        title: this.title,
        text: this.text,
        stars: this.stars,
        token: this.token
      }).then((response) => {
        this.loading = false
        this.errors = response.data.errors
        if(response.data.success){
          window.location.href = this.$route('customer.orders')
        }
      })
    }
  }
}
</script>

<style>

</style>