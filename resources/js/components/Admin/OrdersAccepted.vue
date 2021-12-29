<template>
  <div>
    <h1 class="md:text-2xl text-lg font-semibold uppercase">Pedidos aprovados</h1>
    <t-table :headers="['ID', 'Comprador', 'Pagamento ID', 'CEP', 'Rua', 'Bairro', 'Numero', 'Ponto de referencia', 'Cidade', 'Pago em', 'Enviado?']" :data="data" class="text-gray-900">
      <template slot="row" slot-scope="props">
        <tr class="text-sm">
          <td :class="props.tdClass">
            {{ props.row.id }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.customer.full_name }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.payment_id }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.address.cep }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.address.logradouro }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.address.district }}. Complemento: {{ props.row.address.complement }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.address.number }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.address.reference_point }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.address.city }} ({{ props.row.address.uf }})
          </td>
          <td :class="props.tdClass">
            {{ props.row.updated_at | formatDate }}
          </td>
          <td :class="props.tdClass">
            <div v-if="props.row.logistic_status == 2">
              <span class="text-red-500 font-medium">Ainda não!</span>
              <button @click="sendedOrder(props.row.id);props.row.logistic_status=3" class="bg-purple-400 px-3 py-1 text-gray-50 font-medium">Pedido enviado</button>
            </div>
            <div v-else-if="props.row.logistic_status == 3">
              <span class="text-purple-400 font-medium">Já foi enviado!</span>
              <button @click="sendedOrder(props.row.id);props.row.logistic_status=2" class="bg-purple-400 px-3 py-1 text-gray-50 font-medium">Cancelar envio</button>
            </div>
            <div v-else-if="props.row.logistic_status == 4">
              <span class="text-purple-400 font-medium">Já foi recebido!</span>
            </div>
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
      response: {}
    }
  },
  props: {
    data: Array,
  },
  methods: {
    sendedOrder(productid){
      axios.put('/api/admin/set/order/status', {
        id: productid
      }).then((response) => {
        if(response.data.success){
          this.response = response.data
        }
      })
    }
  }
}
</script>