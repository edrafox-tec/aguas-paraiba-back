<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Relatorio {{$title}}</title>
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

<body>
    <div class="boxPapper">
        <table>
            <th style="width:50%;background:white"> <img class="img"
                    src='https://www.revistameucondominio.com.br/wp-content/uploads/2022/04/logo-aguas-do-paraiba.png'>
            </th>
            <th style='width:40%;background:white'>
                <div class="text-center" style="background-color: #033D60;color:white;width:400px;padding:1%">
                    <h3>Relátorio {{$title}}</h3>
                </div>
            </th>
        </table>
        <table class="headForm">
            <tr>
                <th><label>Setor:</label></th>
                <td><label>{{$user->function}}</label></td>
                <th><label>Responsavel:</label></th>
                <td><label>{{$user->name}}</label></td>
                @foreach ($array as $item)
                @if ($item['theme'] == 'Data')
                @foreach ( $item['answer'] as $answer)
                <th><label>Data:</label></th>
                <td><label>{{date('d/m/Y h:m',strtotime($answer['answer']))}}</label></td>
                @endforeach
                @endif
                @endforeach
            </tr>
            <tr>
                @foreach ($array as $item)
                @if ($item['theme'] == 'Equipe' || $item['theme'] == 'Local da inspeção')
                <th><label>{{$item['theme']}}:</label></th>
                @foreach ( $item['answer'] as $answer)
                <td><label>{{$answer['answer']}}</label></td>
                @endforeach
                @endif
                @endforeach
            </tr>
            <tr>
                @foreach ($array as $item)
                @if ($item['theme'] == 'Sobre os projetos e especificações' || $item['theme'] == 'Documentos de
                Referência/Anexos')
                <th><label>{{$item['theme']}}:</label></th>
                @foreach ( $item['answer'] as $answer)
                <td><label>{{$answer['answer']}}</label></td>
                @endforeach
                @endif
                @endforeach
            </tr>
            <tr>
                @foreach ($array as $item)
                @if ($item['theme'] == 'Condições de clima' || $item['theme'] == 'Condições de Segurança das
                Adjacências')
                <th><label>{{$item['theme']}}:</label></th>
                @foreach ( $item['answer'] as $answer)
                <td><label>{{$answer['answer']}}</label></td>
                @endforeach
                @endif
                @endforeach
            </tr>
        </table>

        <table>
            <tbody>
                @foreach ($array as $item)
                <tr style="text-align: left">
                    @if ($item['theme'] !== 'Equipe' && $item['theme'] !== 'Local da inspeção' && $item['theme'] !==
                    'Sobre os projetos e especificações' && $item['theme'] !== 'Documentos de Referência/Anexos' &&
                    $item['theme'] != 'Setor' && $item['theme'] != 'Data' && $item['theme'] !== 'Condições de clima' &&
                    $item['theme'] !== 'Condições de Segurança das Adjacências' )
                    <th style="text-align: left"><label>{{$item['theme']}}:</label></th>
                    <td>
                        @foreach ( $item['answer'] as $answer)
                        @if ($answer['type_question'] == 'photo' || $answer['type_question'] == 'draw' &&
                        $answer['type_question'] != 'date')
                        <img style="width: 40%;height:20%" src='{{$answer['answer']}}'/>
                        <img style="width: 40%;height:20%" src='{{$answer['answer']}}'/>
                        @endif
                        @if ($answer['type_question'] == 'date')
                        <label>{{date('d/m/Y h:m',strtotime($answer['answer']))}}</label>
                        @endif
                        @if ($answer['type_question'] != 'photo' && $answer['type_question'] != 'draw' &&
                        $answer['type_question'] != 'date')
                        <label>{{$answer['answer']}}</label>
                        @endif
                        @endforeach
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <h6>Foto da assinatura</h6>
        <img style='height:100px; width:194px' src="{{$user->signature}}">
    </div>
</body>

</html>