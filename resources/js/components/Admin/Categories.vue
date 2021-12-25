<template>
  <div>
    <div class="flex justify-end">
      <button @click="showModal=true" class="flex bg-purple-400 px-2 py-1 rounded-md" type="button" data-modal-toggle="default-modal">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        <p class="px-2">Criar uma nova categoria</p>
      </button>
    </div>
 
    <t-modal class="text-gray-900" v-model="showModal">
      <form @submit.prevent="submitData">
        <div class="my-2">
          <label class="font-medium" for="">Nome (*)</label>
          <input :class="{'border-red-500': errors != undefined && errors.name}" v-model="CategoryName" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="text" name="" id="">
          <div v-if="errors != undefined && errors.name">
            <ul v-for="errors in errors.name" :key="errors.id">
              <li class="text-red-500 text-sm">{{ errors }}</li>
            </ul>
          </div>
        </div>

        <div class="my-2">
          <label class="font-medium" for="">Descrição (*)</label>
          <input :class="{'border-red-500': errors != undefined && errors.description}" v-model="CategoryDescription" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="text" name="" id="">
          <div v-if="errors != undefined && errors.description">
            <ul v-for="errors in errors.description" :key="errors.id">
              <li class="text-red-500 text-sm">{{ errors }}</li>
            </ul>
          </div>
        </div>

        <button class="bg-purple-600 text-gray-50 px-2 py-1 rounded-lg w-full font-medium text-lg" type="submit">
          Criar categoria
        </button>
      </form>

      <t-alert class="my-2" v-if="response.success" variant="success" show>
        <span>{{ response.message }}</span>
      </t-alert>

    </t-modal>

    <h1 class="md:text-2xl text-lg font-semibold uppercase">Categorias</h1>
    <t-table :headers="['ID', 'Categoria', 'Descricao', 'Data criação']" :data="data" class="text-gray-900">
      <template slot="row" slot-scope="props">
        <tr>
          <td :class="props.tdClass">
            {{ props.row.id }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.name }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.description }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.created_at | formatDate }}
          </td>
        </tr>
      </template>
    </t-table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return {
      showModal: false,
      CategoryName: '',
      CategoryDescription: '',
      errors: {},
      response: {},
    }
  },
  props: {
    data: Array,
  },
  methods: {
    submitData(){
      axios.post('/api/admin/create/category', {
        name: this.CategoryName,
        description: this.CategoryDescription
      }).then((response) => {
        this.errors = response.data.errors
        if(response.data.success){
          this.response = response.data
          this.CategoryName = ''
          this.CategoryDescription = ''

          window.location.reload()
        }
      })
    }
  }
}
</script>