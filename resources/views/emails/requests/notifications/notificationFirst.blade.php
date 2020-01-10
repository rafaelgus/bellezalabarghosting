@component('mail::message')
# Oi {{ $productRequest->user_name }},

## {{ $productRequest->product_name }} já chegou!

Você tem UM DIA para provar o {{ $productRequest->product_name }} e fazer sua avaliação!
Quando provar o produto faça a sua avaliação pelo site usando login/senha. Se cadastrou o seu telefone faça pelo WhatsApp respondendo a mensagem que enviamos usando a palavra PRONTA. Só responda o WhatsApp quando sua avaliação estiver realmente PRONTA!

Se tiver dificuldade para fazer sua avaliação, entre em contato pelo e-mail ajuda@belezalab.com.br

Um abraço
Equipe ,<br>
{{ config('app.name') }}
@endcomponent
