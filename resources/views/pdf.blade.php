<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatorio {{$title}}</title>
    <style type="text/css">
        @font-face {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }
        *{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }
    </style>
</head>
<body>
    <div style="align-content: center;align-items:center;justify-content:center">
        <img style='margin:auto;width:120px;height:120px' src='https://1.bp.blogspot.com/-jmJJUvAjHfU/XcNVtjsOkvI/AAAAAAAAbbU/KKvitRbzLcofKhLCwFRYuYk7a6DEGrNWwCLcBGAsYHQ/s1600/Grupo-aguas-do-Brasil-1024x678.jpg'>
    </div>
    <h1>Relátorio {{$title}}</h1>
    <p>Responsavel:{{$user->name}}</p>
    <p>Maricula:{{$user->registration}}</p>
    <h3>Informações</h3>
    @foreach ($array as $item)
    <div>
        <h4>{{$item['theme']}}</h4>
        @foreach ($item['answer'] as $answer)
        @if($answer['type_question'] != 'photo' && $answer['type_question'] != 'draw'&& $answer['type_question'] != 'date')
            <label>Resposta: {{$answer['answer']}}</label>
        @endif
        @if($answer['type_question'] == 'photo' || $answer['type_question'] == 'draw' && $answer['type_question'] != 'date')
            <img src="{{$answer['answer']}}" />
        @endif
        @if($answer['type_question'] == 'date')
            <label >Resposta: {{$answer['answer']}}</label>
        @endif
        @endforeach
    </div><br>
    @endforeach
</body>
</html>