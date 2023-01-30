<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Relatorio</title>
    <style>
        .boxPapper {
            border: 2px solid black;
            width: 100%;
            box-sizing: border-box;
        }

        img {
            width: 200px;
            height: 70px;
        }


        th {
            background: rgb(194, 194, 194);
            color: black;
        }

        label {
            font-size: 10px;
        }

        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }
    </style>
</head>
<table style='width:100%'>
    @foreach ($form as $item)
        <thead>
            <tr>
                <th colspan="2" style="background:grey"><label>{{ $item['MasterTheme'] }}</label></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item['AllAnswer'] as $questions)
                @if (
                    $questions['theme'] !== 'Equipe' &&
                        $questions['theme'] !== 'Local da inspeção' &&
                        $questions['theme'] !== 'Sobre os projetos e especificações' &&
                        $questions['theme'] !== 'Documentos de Referência/Anexos' &&
                        $questions['theme'] != 'Setor' &&
                        $questions['theme'] != 'Data' &&
                        $questions['theme'] !== 'Condições de clima' &&
                        $questions['theme'] !== 'Condições de Segurança das Adjacências')
                    <tr>
                        <td style="width:30%"><label>{{ $questions['theme'] }}</label></td>
                        <td style="width:70%">
                            @foreach ($questions['answer'] as $answer)
                                <label>{{ $answer['answer'] }}</label>
                            @endforeach
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    @endforeach
</table>

</html>
