<template>
  <div class="mx-6 my-2">
    <div class="md:flex ">
      <div class="md:w-1/3 flex bg-gray-700 items-center text-gray-50 mx-0">
        <div class="bg-purple-400 py-2 px-2 flex items-center">
          <svg class=" w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div class="bg-gray-700 py-2 px-2">
          <p class="text-center text-lg font-medium">{{ data.customers_count }}</p>
          <p class="text-sm">Usuários cadastrados</p>
        </div>
      </div>

      <div class="md:w-1/3 flex bg-gray-700 items-center text-gray-50 md:ml-1 mx-0">
        <div class="bg-purple-400 py-2 px-2 flex items-center">
          <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div class="bg-gray-700 py-2 px-2">
          <p class="text-center text-lg font-medium">R${{ data.total_value }}</p>
          <p class="text-sm">Arrecadado aproximadamente</p>
        </div>
      </div>

     <div class="md:w-1/3 flex bg-gray-700 items-center text-gray-50 md:ml-1 mx-0">
        <div class="bg-purple-400 py-2 px-2 flex items-center">
          <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <div class="bg-gray-700 py-2 px-2">
          <p class="text-center text-lg font-medium">xx/xx/xxxx</p>
          <p class="text-sm">Data da reunião</p>
        </div>
      </div>
    </div>

    <div class="w-full mt-6">
      <div class="text-gray-900">
        
      </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return{
      /*
      loaded: false,
      options: null,
      chartdata: null*/
    }
  },
  /*
  async mounted(){
    this.loaded = false
    await axios.get('/api/admin/charts').then((response) => {
      console.log(response)
      this.loaded = true
      this.chartdata = {
        labels: ['Male', 'Female'],
        datasets: [
          {
            label: '#users',
            data: [5, 10],
            backgroundColor: ["rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)"],
            borderColor: ["rgba(255, 99, 132, .2)", "rgba(54, 162, 235, .2)"],
            borderWidth: 1
          }
        ]
      }

      this.options = {

      }

    }).catch((error) => {
      console.log(error)
    })
  },*/
  props: {
    data: Object,
  },
}
</script>

<style>

</style>