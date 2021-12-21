<h1 class="pb-3">Avalie a sua compra</h1>
<p class="mb-2">Você comprou: {{ $product_data->name }}</p>

<p>Sua opinião faz a diferença para nossa equipe e os demais clientes. Compartilhe conosco quais foram as suas impressões sobre o produto abaixo:</p>

<a class="py-3 font-semibold" href="{{ route('customer.myassessment', ['token' => $token]) }}">Avaliar</a>