<h1 class="pb-3">Avalie o pedido: {{ $payment_data['id'] }}</h1>

<p>Sua opinião faz a diferença para nossa equipe e os demais clientes. Compartilhe conosco quais foram as suas impressões sobre o produto abaixo:</p>

<p>{{ $product_data->name }}</p>


<a class="py-3 font-semibold" href="{{ route('customer.myassessment', ['paymentid' => $payment_data['id'], 'productid' => $product_data->id]) }}">Avaliar</a>