<template>
  <div>
    <div class="">
      <div class="flex justify-end mx-6">
        <button @click="showModal=true" class="flex bg-purple-400 px-2 py-1 rounded-md" type="button" data-modal-toggle="default-modal">
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
          
        </div>
      </div>
    </div>

    <t-modal class="" v-model="showModal">
      <form class="mt-6" @submit.prevent="createNewProduct()">
        <div class="md:flex text-sm">
          <div class="md:w-1/2 flex text-gray-900 px-6 py-2">
            <div v-if="!ProductImage">
              <label class="cursor-pointer" for="text_image">
              <svg class="w-56 h-56" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
              </label>
              <input @change="onFileChange" type="file" id="text_image" class="w-full px-2 py-1 mx-1" placeholder="Digite o nome do produto" hidden>
              
            </div>

            <div v-else>
              <img class="w-36 h-56" :src="ProductImage">
              <button class="bg-red-400 px-2 py-1 rounded-md" @click="removeImage">Remover imagem</button>
            </div>
            
          </div>
          <div class="md:w-1/2 text-gray-900 px-6 py-4 border-l border-gray-700">
            <div class=" my-2">
              <label class="text-gray-900 font-medium" for="">Nome do produto (*)</label>
              <input :class="{'border-red-500': errors != undefined && errors.name}" v-model="ProductName" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="text" name="" id="">
              <div v-if="errors != undefined && errors.name">
                <ul v-for="errors in errors.name" :key="errors.id">
                  <li class="text-red-500 text-sm">{{ errors }}</li>
                </ul>
              </div>
            </div>
            <div class=" my-2">
              <label class="text-gray-900 font-medium" for="">Descrição (*)</label>
              <input :class="{'border-red-500': errors != undefined && errors.description}" v-model="ProductDescription" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="text" name="" id="">
              <div v-if="errors != undefined && errors.description">
                <ul v-for="errors in errors.description" :key="errors.id">
                  <li class="text-red-500 text-sm">{{ errors }}</li>
                </ul>
              </div>
            </div>

            <div class="my-2 flex text-gray-900">
              <div class="w-1/2">
                <label class="text-gray-900 font-medium" for="">Preço (*)</label>
                <input :class="{'border-red-500': errors != undefined && errors.price}" v-model="ProductPrice" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="number" step=".01" name="" id="">
                <div v-if="errors != undefined && errors.price">
                  <ul v-for="errors in errors.price" :key="errors.id">
                    <li class="text-red-500 text-sm">{{ errors }}</li>
                  </ul>
                </div>
              </div>
              
              <div class="w-1/2">
                <label class="text-gray-900 font-medium" for="">Preço antigo</label>
                <input v-model="ProductOldPrice" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1 ml-2" type="number" step=".01" name="" id="">
              </div>
            </div>

            <div class="my-2 flex text-gray-900">
              <div class="w-1/2">
                <label class="text-gray-900 font-medium" for="">Estoque (*)</label>
                <input :class="{'border-red-500': errors != undefined && errors.stock}" v-model="ProductStock" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" min="1" type="number" name="" id="">
                <div v-if="errors != undefined && errors.stock">
                  <ul v-for="errors in errors.stock" :key="errors.id">
                    <li class="text-red-500 text-sm">{{ errors }}</li>
                  </ul>
                </div>
              </div>
              
              <div class="w-1/2 text-gray-900">
                <label class="text-gray-900 font-medium ml-2 block" for="category">Categoria (*)</label>
                
                <select v-model="ProductCategory" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1 ml-2">
                  <option class="bg-gray-700 text-gray-50" :value="null">Selecione uma categoria</option>
                  <option class="bg-gray-700 text-gray-50" v-for="category in categories" :key="category.id" :value="category.id" >{{ category.name }}</option>
                </select>

                <div v-if="errors != undefined && errors.category">
                  <ul v-for="errors in errors.category" :key="errors.id">
                    <li class="text-red-500 text-sm">{{ errors }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="my-2">
          <button class="bg-purple-600 px-2 py-1 rounded-lg w-full font-medium text-lg" type="submit">
            <div v-if="loading" class="flex justify-center items-center">
              <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
            </div>
            <span v-else>Criar produto</span>
          </button>

          <t-alert v-if="response.success" class="my-2" variant="success">
            <span>{{ response.message }}</span>
          </t-alert>
        </div>
      </form>
    </t-modal>
    
    <!--<div class="bg-red-500 my-4">-->
      <h1 class="md:text-2xl text-lg font-semibold uppercase">Produtos no catálogo</h1>
      <t-table :headers="['ID', 'Nome', 'Preço', 'Estoque', 'Visivel', 'Ações']" :data="data" class="text-gray-900">
        <template slot="row" slot-scope="props">
          <tr>
            <td :class="props.tdClass">
              {{ props.row.id }}
            </td>
            <td :class="props.tdClass">
              {{ props.row.name }}
            </td>
            <td :class="props.tdClass">
              {{ props.row.price }}
            </td>
            <td :class="props.tdClass">
              {{ props.row.stock }}
            </td>
            <td :class="props.tdClass">
              {{ (props.row.visible) ? 'Sim' : 'Não'}}
              <button @click="changeProductVisible(props.row.id);props.row.visible= !props.row.visible" class="block bg-purple-600 px-3 py-1 text-sm font-medium text-gray-50 uppercase">
                <span v-if="props.row.visible">Deixar invisivel</span>
                <span v-else>Deixar visivel</span>
              </button>
            </td>
            <td :class="props.tdClass">
              <t-dropdown text="MENU">
                <div slot-scope="{ hide, blurHandler }">
                  <button @click="showRemoveModal=true;removeProductId=props.row.id" class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100" role="menuitem" @blur="blurHandler">
                    Remover
                  </button>

                  <button @click="showEditModal=true;editProductId=props.row.id;getProductData(props.row.id)" class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100" role="menuitem" @blur="blurHandler">
                    Editar
                  </button>

                  <button class="block w-full px-4 py-2 text-sm leading-5 text-red-500 transition duration-150 ease-in-out border-t hover:bg-gray-100 focus:outline-none focus:bg-gray-100" @click="hide">
                    Fechar
                  </button>
                </div>
              </t-dropdown>
            </td>
          </tr>
        </template>
      </t-table>
    
    <!-- edit product -->
    <t-modal class="text-gray-900" v-model="showEditModal">
      <form @submit.prevent="editProduct(editProductId)">
        <div class="md:flex text-sm">
          <div class="md:w-1/2 flex text-gray-900 px-6 py-2">
            <div v-if="!EditProductImage">
              <label class="cursor-pointer" for="text_image">
              <svg class="w-56 h-56" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
              </label>
              <input @change="onFileChange" type="file" id="text_image" class="w-full px-2 py-1 mx-1" placeholder="Digite o nome do produto" hidden>
              
            </div>

            <div v-else>
              <img class="w-36 h-56" :src="EditProductImage">
              <span class="bg-red-400 px-2 py-1 rounded-md cursor-pointer " @click="removeImage">Remover imagem</span>
            </div>
            
          </div>
          <div class="md:w-1/2 text-gray-900 px-6 py-4 border-l border-gray-700">
            <div class=" my-2">
              <label class="text-gray-900 font-medium" for="">Nome do produto (*)</label>
              <input :class="{'border-red-500': editErrors != undefined && editErrors.name}" v-model="EditProductName" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="text" name="" id="">
              <div v-if="editErrors != undefined && editErrors.name">
                <ul v-for="editErrors in editErrors.name" :key="editErrors.id">
                  <li class="text-red-500 text-sm">{{ editErrors }}</li>
                </ul>
              </div>
            </div>
            <div class=" my-2">
              <label class="text-gray-900 font-medium" for="">Descrição (*)</label>
              <input :class="{'border-red-500': editErrors != undefined && editErrors.description}" v-model="EditProductDescription" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="text" name="" id="">
              <div v-if="editErrors != undefined && editErrors.description">
                <ul v-for="editErrors in editErrors.description" :key="editErrors.id">
                  <li class="text-red-500 text-sm">{{ editErrors }}</li>
                </ul>
              </div>
            </div>

            <div class="my-2 flex text-gray-900">
              <div class="w-1/2">
                <label class="text-gray-900 font-medium" for="">Preço (*)</label>
                <input :class="{'border-red-500': editErrors != undefined && editErrors.price}" v-model="EditProductPrice" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" type="number" step=".01" name="" id="">
                <div v-if="editErrors != undefined && editErrors.price">
                  <ul v-for="editErrors in editErrors.price" :key="editErrors.id">
                    <li class="text-red-500 text-sm">{{ editErrors }}</li>
                  </ul>
                </div>
              </div>
              
              <div class="w-1/2">
                <label class="text-gray-900 font-medium" for="">Preço antigo</label>
                <input v-model="EditProductOldPrice" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1 ml-2" type="number" step=".01" name="" id="">
              </div>
            </div>

            <div class="my-2 flex text-gray-900">
              <div class="w-1/2">
                <label class="text-gray-900 font-medium" for="">Estoque (*)</label>
                <input :class="{'border-red-500': editErrors != undefined && editErrors.stock}" v-model="EditProductStock" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1" min="1" type="number" name="" id="">
                <div v-if="editErrors != undefined && editErrors.stock">
                  <ul v-for="editErrors in editErrors.stock" :key="editErrors.id">
                    <li class="text-red-500 text-sm">{{ editErrors }}</li>
                  </ul>
                </div>
              </div>
              
              <div class="w-1/2 text-gray-900">
                <label class="text-gray-900 font-medium ml-2 block" for="category">Categoria (*)</label>
                
                <select v-model="EditProductCategory" class="bg-transparent px-2 py-1 border rounded-md w-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50 mt-1 ml-2">
                  <option class="bg-gray-700 text-gray-50" :value="null">Selecione uma categoria</option>
                  <option class="bg-gray-700 text-gray-50" v-for="category in categories" :key="category.id" :value="category.id" >{{ category.name }}</option>
                </select>

                <div v-if="editErrors != undefined && editErrors.category">
                  <ul v-for="editErrors in editErrors.category" :key="editErrors.id">
                    <li class="text-red-500 text-sm">{{ editErrors }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="my-2">
          <button class="text-gray-50 bg-purple-600 px-2 py-1 rounded-lg w-full font-medium text-lg" type="submit">
            <span>Salvar novos dados</span>
          </button>

          <t-alert v-if="editResponse.success" class="my-2" variant="success">
            <span>{{ editResponse.message }}</span>
          </t-alert>
        </div>
      </form>
    </t-modal>

    <t-modal class="text-gray-900" v-model="showRemoveModal">
      <p class="mb-4">Você tem certeza que deseja remover esse produto da sua loja?</p>
      <button @click="removeProduct(removeProductId)" class="text-gray-50 bg-purple-600 px-2 py-1 rounded-lg w-full font-medium text-lg">
        <span>Tenho certeza, remover</span>
      </button>
    </t-modal>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return {
      errors: {},
      editErrors: {},
      showNewProductModal: false,
      createProduct: false,
      loading: false,
      ProductImage: '',
      ProductName: '',
      ProductDescription: '',
      ProductPrice: '',
      ProductOldPrice: '',
      ProductStock: '',
      ProductCategory: null,
      EditProductImage: '',
      EditProductName: '',
      EditProductDescription: '',
      EditProductPrice: '',
      EditProductOldPrice: '',
      EditProductStock: '',
      EditProductCategory: null,
      showModal: false,
      showEditModal: false,
      showRemoveModal: false,
      response: {},
      editResponse: {},
      removeProductId: null,
      editProductId: null,
    }
  },
  methods: {
    createNewProduct(){
      this.loading = true
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
        this.errors = response.data.errors
        this.loading = false
        if(response.data.success){
          this.response = response.data
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

    removeProduct(productid){
      axios.post('/api/admin/remove/product', {
        id: productid
      }).then((response) => {
        if(response.data.success){
          this.showRemoveModal = false
          window.location.reload()
        }
      })
    },

    editProduct(productid){
      axios.post('/api/admin/edit/product', {
        id: productid,
        image: this.EditProductImage,
        name: this.EditProductName,
        description: this.EditProductDescription,
        price: this.EditProductPrice,
        old_price: this.EditProductOldPrice,
        stock: this.EditProductStock,
        category_id: this.EditProductCategory,
      }).then((response) => {
        this.editErrors = response.data.errors
        if(response.data.success){
          this.editResponse = response.data
          this.EditProductImage = ''
          this.EditProductName = ''
          this.EditProductDescription = ''
          this.EditProductPrice = ''
          this.EditProductOldPrice = ''
          this.EditProductStock = ''
          this.EditProductCategory = ''

          this.showEditModal = false
        }
      })
    },

    getProductData(productid){
      axios.post('/api/admin/get/product', {
        'productid': productid
      }).then((response) => {
        if(response.data.success){
          this.EditProductImage = response.data.image
          this.EditProductName = response.data.name
          this.EditProductDescription = response.data.description
          this.EditProductPrice = response.data.price
          this.EditProductOldPrice = response.data.old_price
          this.EditProductStock = response.data.stock
          this.EditProductCategory = response.data.category_id
        }
      })
    },

    changeProductVisible(productid){
      axios.put('/api/admin/set/produto/visible', {
        id: productid
      }).then((response) => {
        if(response.data.success){

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
        this.EditProductImage = e.target.result;
        this.ProductImage = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage(e) {
      this.ProductImage = ''
      this.EditProductImage = ''
    },

    ShowHideCreateProduct(){
      this.createProduct = !this.createProduct
    }
  },
  props: {
    data: Array,
    categories: Array,
  }
}
</script>