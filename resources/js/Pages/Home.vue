<template>
  <div class="">
    <Header v-on:searchChange="handleSearch"></Header>
    <div class="flex justify-center mt-6 mb-6">
      <div class="grid grid-flow-row grid-cols-1 grid-rows-1 md:grid-cols-3 md:grid-rows-3 auto-rows-max gap-2">
        
        <div v-for="data in datas" :key="data.id" class="">
            <Item
              :id="data.id"
              :nome="data.nome" 
              :imagem="data.imagem"
              :descricao="data.descricao" 
              :categoria="data.categoria" 
              :preco="data.preco" 
              :estoque="data.estoque" 
              :promocao="!!data.promocao" 
              :preco_antigo="data.preco_antigo">
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
  components:{
    Header, Footer, Item
  },
  props:{
    datas: Array,
  },
  methods: {
    handleSearch(event){
      const { value } = event.target;
      this.search = value;
    }
  },
}
</script>