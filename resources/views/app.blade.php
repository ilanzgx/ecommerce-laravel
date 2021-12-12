<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    @routes
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <title>Ecommerce</title>
  </head>
  <body class="bg-gray-800 text-gray-50">
    @inertia
    <script src="https://sdk.mercadopago.com/js/v2"></script>
  </body>
</html>