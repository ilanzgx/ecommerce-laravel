<template>
  <div>
    <Header></Header>
    <div class="my-4 mx-2">
      <form @submit.prevent="submitData">

        <div>
          <label class="text-gray-50 text-sm block" for="">Email</label>
          <input :class="{'border-red-500': errors != undefined && errors.email}" class="md:w-1/2 w-full text-gray-900 px-4 py-2 rounded-md bg-transparent border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-opacity-0 focus:ring-opacity-50" v-model="email" type="text">
          <div v-if="errors != undefined && errors.email">
            <ul v-for="errors in errors.email" :key="errors.id">
              <li class="text-red-500 text-sm">{{ errors }}</li>
            </ul>
          </div>
        </div>

        <div>
          <label class="text-gray-50 text-sm block" for="">Senha nova</label>
          <input :class="{'border-red-500': errors != undefined && errors.password}" class="md:w-1/2 w-full text-gray-900 px-4 py-2 rounded-md bg-transparent border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-opacity-0 focus:ring-opacity-50" v-model="password" type="text">
          <div v-if="errors != undefined && errors.password">
            <ul v-for="errors in errors.password" :key="errors.id">
              <li class="text-red-500 text-sm">{{ errors }}</li>
            </ul>
          </div>
        </div>

        <div>
          <label class="text-gray-50 text-sm block" for="">Confirme a senha</label>
          <input :class="{'border-red-500': errors != undefined && errors.password_confirmation}" class="md:w-1/2 w-full text-gray-900 px-4 py-2 rounded-md bg-transparent border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-opacity-0 focus:ring-opacity-50" v-model="password_confirmation" type="text">
          <div v-if="errors != undefined && errors.password_confirmation">
            <ul v-for="errors in errors.password_confirmation" :key="errors.id">
              <li class="text-red-500 text-sm">{{ errors }}</li>
            </ul>
          </div>
        </div>

        <button class="md:w-1/2 w-full bg-purple-500 text-gray-50 font-medium px-8 py-4 rounded-md mt-8" type="submit">
          Enviar
        </button>

      </form>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../components/Header.vue'
import Footer from './../components/Footer.vue'
import axios from 'axios'

export default {
  data(){
    return {
      errors: {},
      email: '',
      password: '',
      password_confirmation: '',
    }
  },
  components: {
    Header, Footer
  },
  props: {
    token: String,
  },
  methods: {
    submitData(){
      axios.post('/api/password/reset', {
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        token: this.token
      }).then((response) => {
        this.errors = response.data.errors
        if(response.data.success){
          window.location.href = this.$route('login')
        }
      })
    }
  }
}
</script>