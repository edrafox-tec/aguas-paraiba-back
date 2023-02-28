<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Novo Formulário</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="https://www.revistameucondominio.com.br/wp-content/uploads/2022/04/logo-aguas-do-paraiba.png" alt="logo" width="100" height="50">
                </a>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="boxPapper">
            <h1 class="text-center">Novo Formulário</h1>
            <form>
                <div class="form-group text-center">
                    <label for="name">Um novo formulário foi feito em seu nome:</label>
                    <input type="text" id="name" name="name" class="form-control" readonly value="{{ $name }}">
                    <div class="form-group text-center">
                        <p>Clique no link abaixo para baixar o PDF:</p>
                        <a href="{{ $pdf_url }}">Baixar PDF</a>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>