@component('mail::message')

# Olá {{ $user->name }}

Sua conta em BelezaLab.com.br foi criada!
Agora você já pode acessar sua conta para provar produtos!

@component('mail::button', ['url' => 'https://belezalab.com.br'])
Belezalab
@endcomponent

Muito obrigado pela atenção,<br>
{{ config('app.name') }}
@endcomponent
