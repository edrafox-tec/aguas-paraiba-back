@component('mail::message')   
<h1>Novo Formulário</h1>

<p>Um novo formulário foi feito em seu nome {{ $user->name }}</p>
@component('mail::button', ['url' => 'http://127.0.0.1:8000/api/pdf/(Aqui vai o ID do formulário)</'])
    Baixar PDF
@endcomponent

@endcomponent