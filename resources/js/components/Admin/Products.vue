<template>
  <div>
    <div class="">
      <div class="flex justify-end mx-6">
        <button @click="ShowHideCreateProduct()" class="flex bg-purple-400 px-2 py-1 rounded-md" type="button" data-modal-toggle="default-modal">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
          <p class="px-2">Criar um novo produto</p>
        </button>
      </div>

      <div v-if="createProduct" class="flex justify-center ">
        <div class="">
          <div class="md:flex items-center border-b border-gray-700 py-3">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <h1 class="text-2xl">Adicionar novo produto</h1>
          </div>
          <form class="mt-6" @submit.prevent="createNewProduct()">
            <div class="md:flex">
              <div class="md:w-1/2 flex justify-center px-6 bg-gray-600 py-2">
                <div v-if="!ProductImage">
                  <label class="cursor-pointer" for="text_image">
                  <svg class="w-36 h-56" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                  </label>
                  <input @change="onFileChange" type="file" id="text_image" class="w-full px-2 py-1 mx-1" placeholder="Digite o nome do produto" hidden>
                </div>

                <div v-else>
                  <img class="w-36 h-56" :src="ProductImage">
                  <button class="bg-red-400 px-2 py-1 rounded-md" @click="removeImage">Remover imagem</button>
                </div>
                
              </div>
              <div class="md:w-1/2  px-6 py-4 text-gray-50 bg-gray-600 border-l border-gray-700">
                <div class=" my-2">
                  <label class="text-gray-50 font-medium" for="">Nome do produto (*)</label>
                  <input v-model="ProductName" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="text" name="" id="">
                </div>
                <div class=" my-2">
                  <label class="text-gray-50 font-medium" for="">Descrição (*)</label>
                  <input v-model="ProductDescription" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="text" name="" id="">
                </div>

                <div class="my-2 flex">
                  <div class="w-1/2">
                    <label class="text-gray-50 font-medium" for="">Preço (*)</label>
                    <input v-model="ProductPrice" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="number" step=".01" name="" id="">
                  </div>
                  
                  <div class="w-1/2">
                    <label class="text-gray-50 font-medium" for="">Preço antigo</label>
                    <input v-model="ProductOldPrice" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1 ml-2" type="number" step=".01" name="" id="">
                  </div>
                </div>

                <div class="my-2 flex">
                  <div class="w-1/2">
                    <label class="text-gray-50 font-medium" for="">Estoque total (*)</label>
                    <input v-model="ProductStock" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="number" step=".01" name="" id="">
                  </div>
                  
                  <div class="w-1/2">
                    <label class="text-gray-50 font-medium ml-2" for="">Categoria (*)</label>
                    <input v-model="ProductCategory" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1 ml-2" type="text" name="" id="">
                  </div>
                </div>
              </div>
            </div>
            <div class="my-2">
              <button class="bg-purple-400 px-2 py-1 rounded-lg w-full font-medium text-lg" type="submit">
                Criar produto
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <div class="flex justify-center w-full my-4">
      <table class="table-fixed bg-gray-700">
        <thead>
          <tr>
            <th>Imagem</th>
            <th>Id</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Criado em</th>
            <th>Modificações</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b border-gray-600" v-for="item in data" :key="item.id">
            <td class="px-3">
              <img class="p-4 w-24 h-24" :src="item.image">
            </td>
            <td class="px-3">{{ item.id }}</td>
            <td class="px-3 break-words md:w-36">{{ item.name }}</td>
            <td class="px-3">R${{ item.price }}</td>
            <td class="px-3">{{ item.stock }}</td>
            <td class="px-3">{{ item.created_at }}</td>
            <td class="px-3">
              <button class="bg-red-500 px-2 py-1 rounded-sm">Remover</button>
              <button class="bg-yellow-500 px-2 py-1 rounded-sm">Editar</button>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return {
      showNewProductModal: false,
      createProduct: false,
      ProductImage: '',
      ProductName: '',
      ProductDescription: '',
      ProductPrice: '',
      ProductOldPrice: '',
      ProductStock: '',
      ProductCategory: '',
    }
  },
  methods: {
    createNewProduct(){
      axios.post('/api/admin/create/product', {
        image: this.ProductImage,
        name: this.ProductName,
        description: this.ProductDescription,
        price: this.ProductPrice,
        old_price: this.ProductOldPrice,
        stock: this.ProductStock,
        category: this.ProductCategory,
      }).then((response) => {
        console.log(response.data);
        if(response.data.success){
          this.ProductImage = ''
          this.ProductName = ''
          this.ProductDescription = ''
          this.ProductPrice = ''
          this.ProductOldPrice = ''
          this.ProductStock = ''
          this.ProductCategory = ''
        }
      })
    },

    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        this.ProductImage = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage(e) {
      this.ProductImage = '';
    },

    ShowHideCreateProduct(){
      this.createProduct = !this.createProduct
    }
  },
  components: {
  },
  props: {
    data: Array,
  }
}
</script>