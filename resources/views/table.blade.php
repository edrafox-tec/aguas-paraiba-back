        
        
        @foreach ( $array as $item )
        <h1>{{$item['MasterTheme']}}</h1>
        @foreach ( $item['AllAnswer'] as $themes )
            <h2>{{$themes['theme']}}</h2>
            @foreach ($themes['answer'] as $answer )
                <h3>{{$answer['answer']}}</h3>
            @endforeach
        @endforeach
    @endforeach
        <!--<table class="headForm">
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
        </table>-->

        <!--<table>
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
        </table>-->