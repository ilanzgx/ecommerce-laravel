<template>
  <div class="">
    <Header v-on:searchChange="handleSearch"></Header>
    <div class="my-4">
      <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        
        <div v-for="data in products" :key="data.id" class="w-full">
            <Item
              :id="data.id"
              :nome="data.name" 
              :imagem="data.image"
              :descricao="data.description" 
              :categoria="data.category" 
              :preco="data.price" 
              :estoque="data.stock" 
              :promocao="!!data.discount" 
              :preco_antigo="data.old_price">
            </Item>
        </div>

      </div>
    </div>

    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../components/Header.vue'
//import Categories from './../components/Categories.vue'
import Footer from './../components/Footer.vue'
import Item from './../components/Store/Item.vue'

export default {
  name: 'Inicio',
  data(){
    return{
      search: null,
    }
  },
  props:{
    products: Array,
  },
  components:{
    Header, Footer, Item
  },
  methods: {
    handleSearch(event){
      const { value } = event.target;
      this.search = value;
    }
  },
}
</script>