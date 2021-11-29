<template>
  <div>
    <div class="flex h-screen">
      <div class="m-auto bg-gray-200 text-black p-10">
        <form class="items-center" @submit.prevent="submitForm()">
          <div>
            <label for="text_password">Digite a chave mestra:</label><br>
            <input v-model="password" class="px-2" type="password" id="text_password">
          </div>
          <button class="bg-indigo-500 w-full my-2 py-2 rounded-full" type="submit">Confirmar</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return {
      password: null,
      response: null,
    }
  },
  methods: {
    submitForm(){
      axios.post('/api/admin/signin', {
        password: this.password,
      }).then((response) => {
        this.response = response
        console.log(response)
        if(response.data.success){
          window.location.reload()
        }
      }).catch((error) => {
        console.log(error.response.data)
      })

      this.password = null
    },
  },
}
</script>

<style>

</style>