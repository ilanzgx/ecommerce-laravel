<template>
  <div>
    <div class="">
        <div class="flex justify-end mx-6">
          <button class="flex bg-purple-400 px-2 py-1 rounded-md" type="button" data-modal-toggle="default-modal">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            <p>Criar um novo produto</p>
          </button>
          
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
export default {
  props: {
    data: Array,
  }
}
</script>