<template>
  <div>
    <h1 class="md:text-2xl text-lg font-semibold uppercase">Pedidos</h1>
    <t-table :headers="['ID', 'Comprador', 'Pagamento ID', 'Preço', 'Estado', 'Metodo']" :data="data" class="text-gray-900">
      <template slot="row" slot-scope="props">
        <tr>
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
            {{ props.row.total_order_price }}
          </td>
          <td :class="props.tdClass">
            {{ logisticStatus(props.row.logistic_status) }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.payment_method }}
          </td>
        </tr>
      </template>
    </t-table>
  </div>
</template>

<script>
export default {
  props: {
    data: Array,
  },
  methods:{
    logisticStatus(id){
      let res
      switch(id){
        case 1:
          res = 'Aguardando pagamento';
          break
        case 2:
          res = 'Pagamento aprovado'
          break
        case 3:
          res = 'A caminho'
          break
        case 4:
          res = 'Entregue ao cliente'
          break
        case 5:
          res = 'Anulado/Expirado';
          break
      }
      return res;
    }
  }
}
</script>