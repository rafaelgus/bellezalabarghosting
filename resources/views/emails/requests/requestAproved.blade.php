@component('mail::message')
# Oi {{ $productRequest->user_name }},

Seu pedido para provar {{ $productRequest->product_name }} foi aceito e o Código de rastreamento do seu produto seu produto pelos Correios é  {{ $productRequest->request_track }}.

Assim que o seu produto chegar faça a sua avaliação!



Um abraço
Equipe ,<br>
{{ config('app.name') }}
@endcomponent
