@component('mail::message')
# Oi {{ $productRequest->user_name }},

## até agora não recebemos sua avaliação.

Você tem até amanhã para provar e avaliar {{ $productRequest->product_name }},. Nosso sistema bloqueia quem não faz avaliação do produto recebido.

Quando provar o produto faça a sua avaliação pelo site usando login/senha. Se cadastrou o seu telefone faça pelo WhatsApp respondendo a mensagem que enviamos usando a palavra PRONTA. Só responda o WhatsApp quando sua avaliação estiver realmente PRONTA!

Se tiver dificuldade para fazer sua avaliação, entre em contato pelo e-mail ajuda@belezalab.com.br



Um abraço
Equipe ,<br>
{{ config('app.name') }}
@endcomponent
