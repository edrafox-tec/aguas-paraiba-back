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
* h1, h2, h3 , h4 {
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
                    <h3>Relátorio {{$title}} #12</h3></div>
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
                @foreach ($array as $item)
                <tr style="text-align: left">
                    @if ($item['theme'] != 'Setor' && $item['theme'] != 'Data')
                    <th style="text-align: left"><label>{{$item['theme']}}:</label></th>
                    <td>
                        @foreach ( $item['answer'] as $answer)
                        <label>{{$answer['answer']}}</label>
                        @endforeach
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <h6>Foto da assinatura</h6>
        <img style='height:100px; width:294px' src="{{$user->signature}}">
    </div>
</body>

</html>