<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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

        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }
        th{
            background: rgb(194, 194, 194);
            color:black;
        }
        label{
            font-size: 10px;
        }
        #conteiner{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-content: space-between;
  height: 200px;
  width: 100%;
  overflow: hidden;
  resize: horizontal;
}
.item{
  flex-basis: auto;
  width: 198px;
  height: 198px;
  border: solid 1px black;
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
                <div style="background-color: #033D60;color:white;width:400px;padding:1%">Relátorio {{$title}}
                    #12</div>
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
        </table>


        <table>
            <tbody>
                {{$array}}
                <!--@foreach ($array as $item)
                
                <tr style="text-align: left">
                    @if ($item['theme'] != 'Setor' && $item['theme'] != 'Data')
                    <th style="text-align: left"><label>{{$item['theme']}}:</label></th>
                    <td>
                        {{$item['answer'][0]}}
                        @foreach ( $item['answer'] as $answer)
                        <label>{{$answer['answer']}}</label>
                        @endforeach
                    </td>
                    @endif
                </tr>
                @endforeach-->
            </tbody>
        </table>
       <!-- <div class="row">
            @foreach ( $array as $item)
            <div class="col-md-2" style='border:2px solid blue'>
                    <label style='color:red'>{{$item['theme']}}</label>
                    @foreach ( $item['answer'] as $answer)
                        <label>{{$answer['answer']}}</label>
                    @endforeach
                </div>
                @endforeach
        </div>-->
        <h6>Foto da assinatura</h6>
        <img style='height:100px; width:294px' src="{{$user->signature}}">
    </div>
   <!-- <div style="align-content: center;align-items:center;justify-content:center">
        <img style='margin:auto;width:120px;height:120px'
            src='https://1.bp.blogspot.com/-jmJJUvAjHfU/XcNVtjsOkvI/AAAAAAAAbbU/KKvitRbzLcofKhLCwFRYuYk7a6DEGrNWwCLcBGAsYHQ/s1600/Grupo-aguas-do-Brasil-1024x678.jpg'>
    </div>
    <h1>Relátorio {{$title}}</h1>
    <p>Responsavel:{{$user->name}}</p>
    <p>Maricula:{{$user->registration}}</p>
    <h3>Informações</h3>
    @foreach ($array as $item)
    <div>
        <h4>{{$item['theme']}}</h4>
        @foreach ($item['answer'] as $answer)
        @if($answer['type_question'] != 'photo' && $answer['type_question'] != 'draw'&& $answer['type_question'] !=
        'date')
        <label>Resposta: {{$answer['answer']}}</label><br>
        @endif
        @if($answer['type_question'] == 'photo' || $answer['type_question'] == 'draw' && $answer['type_question'] !=
        'date')
        <img style='height:294px; width:594px' src="{{$answer['answer']}}" />
        @endif
        @if($answer['type_question'] == 'date')
        <label>Resposta: {{date('d/m/Y h:m',strtotime($answer['answer']))}}</label><br>
        @endif
        @endforeach
    </div><br>
    @endforeach-->
</body>

</html>