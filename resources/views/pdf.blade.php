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
        <!--Fist Table Head-->
        <table class="headForm">
            <tr>
                @foreach ( $array as $item )
                @foreach ( $item['AllAnswer'] as $themes )
                @if ($themes['theme'] == 'Setor')
                @foreach ($themes['answer'] as $answer )
                        <th><label>Setor:</label></th>
                            <td><label>{{$answer['answer']}}</label></td>
                        @endforeach
                    @endif
                @endforeach
            @endforeach
                @foreach ( $array as $item )
                    @foreach ( $item['AllAnswer'] as $themes )
                        @if ($themes['theme'] == 'Data')
                            @foreach ($themes['answer'] as $answer )
                                <th><label>Data:</label></th>
                                <td><label>{{date('d/m/Y h:m',strtotime($answer['answer']))}}</label></td>
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            </tr>
            <tr>
            @foreach ( $array as $item )
                @foreach ( $item['AllAnswer'] as $themes )
                    @if ($themes['theme'] == 'Equipe' || $themes['theme'] == 'Local de inspeção')
                        @foreach ($themes['answer'] as $answer )
                            <th><label>{{$themes['theme']}}:</label></th>
                            <td><label>{{$answer['answer']}}</label></td>
                        @endforeach
                    @endif
                @endforeach
            @endforeach
            </tr>
            <tr>
            @foreach ( $array as $item )
                @foreach ( $item['AllAnswer'] as $themes )
                    @if ($themes['theme'] == 'Sobre os projetos e especificações' || $themes['theme'] == 'Documentos de Referência/Anexos')
                        @foreach ($themes['answer'] as $answer )
                            <th><label>{{$themes['theme']}}:</label></th>
                            <td><label>{{$answer['answer']}}</label></td>
                        @endforeach
                    @endif
                @endforeach
            @endforeach
            </tr>
            <tr>
            @foreach ( $array as $item )
                @foreach ( $item['AllAnswer'] as $themes )
                    @if ($themes['theme'] == 'Condições de clima' || $themes['theme'] == 'Condições de Segurança das Adjacências')
                        @foreach ($themes['answer'] as $answer )
                            <th><label>{{$themes['theme']}}:</label></th>
                            <td><label>{{$answer['answer']}}</label></td>
                        @endforeach
                    @endif
                @endforeach
            @endforeach
            </tr>
        </table>
        <!--Fist Table Head-->
        <!-- Table Answer -->
        <table style='width:100%'>
            @foreach ( $array as $item )
            <thead>
                <tr>
                    <th colspan="2"><label>{{$item['MasterTheme']}}</label></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item['AllAnswer'] as $questions)
                @if ($questions['theme'] !== 'Equipe' && $questions['theme'] !== 'Local de inspeção' && $questions['theme'] !==
                'Sobre os projetos e especificações' && $questions['theme'] !== 'Documentos de Referência/Anexos' &&
                $questions['theme'] != 'Setor' && $questions['theme'] != 'Data' && $questions['theme'] !== 'Condições de clima' &&
                $questions['theme'] !== 'Condições de Segurança das Adjacências' )        
                <tr>
                    <td style="width:30%"><label>{{$questions['theme']}}</label></td>
                    <td style="width:70%">
                      @php
                        $showImage = true;
                      @endphp
                      @foreach ($questions['answer'] as $answer )
                        @if ($answer['type_question'] =='photo' && $showImage)
                          <img src="{{$answer['answer']}}"/>
                          @php
                            $showImage = false;
                          @endphp
                        @else
                          <label>{{$answer['answer']}}</label>
                        @endif
                      @endforeach
                    </td>
                  </tr>
                @endif
                @endforeach
            </tbody>
            @endforeach
        </table>
        @if ($title == 'Pós obra')
        <table style="width:100%">
            <tr>
                <td><label>Técnico de fiscalização: <br> {{$user->name}}</label></td>
                <td><img style="margin-left:2%;width:6%;height:10%;transform: rotate(90deg)" src="{{$user->signature}}"></td>
            </tr>
        </table>
        @else
        <table style="width:100%">
            <tr>
                <td><label>Responsavel de produção:</label></td>
                <td><img style="margin-left:2%;width:6%;height:10%;transform: rotate(90deg)" src="{{$user->signature}}"></td>
            </tr>
            <tr>
                <td><label>Tecnico de engenharia (CAP):</label></td>
                <td><img style="margin-left:2%;width:6%;height:10%;transform: rotate(90deg)" src="{{$user->signature}}"></td>
            </tr>
            <tr>
                <td><label>Técnico de fiscalização: <br> {{$user->name}}</label></td>
                <td><img style="margin-left:2%;width:6%;height:10%;transform: rotate(90deg)" src="{{$user->signature}}"></td>
            </tr>
        </table>
        @endif
    </div>
</body>

</html>