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

    <div class="w-full bg-gray-700 text-gray-50 mt-6">
      <div class="text-gray-900">
        <apexchart class="w-full h-6" type="line" :options="options" :series="series"></apexchart>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  data(){
    return{
      options: {
        chart: {
          id: 'vuechart-example'
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
        }
      },
      series: [{
        name: 'series-1',
        data: [30, 40, 45, 50, 49, 60, 70, 91]
      }]
    }
  },
  props: {
    data: Object,
  }
}
</script>

<style>

</style>