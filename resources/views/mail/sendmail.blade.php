@component('mail::message')
    <h1>Novo Formulário</h1>
    <p>Você {{ $name }} foi selecionado como técnico em um formulário</p>
    @component('mail::button', ['url' => $pdf_url])
        Baixar PDF
    @endcomponent
@endcomponent