@component('mail::message')
# Oi {{ $productRequest->user_name }},



Recebemos e estamos analisando o seu pedido para provar {{ $productRequest->product_name }}.

Te avisaremos assim que sua análise estiver pronta!



Um abraço
Equipe ,<br>
{{ config('app.name') }}
<br>
<br>
Não responda esse e-mail*
@endcomponent
