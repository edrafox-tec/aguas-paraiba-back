<table>
    <thead>
        <tr>
            <th>Pergunta</th>
            <th>Resposta</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($form as $item)
            <tr>
                <td>{{$item['theme']}}</td>
                @foreach ( $item['answer'] as $answer)
                @if ($answer['type_question'] == 'photo' || $answer['type_question'] == 'draw' && $answer['type_question'] != 'date')
                    <td>{{$answer['answer']}}</td>
                @endif
                @if ($answer['type_question'] == 'date')
                    <td>{{date('d/m/Y h:m',strtotime($answer['answer']))}}</td>
                @endif
                @if ($answer['type_question'] != 'photo' && $answer['type_question'] != 'draw' && $answer['type_question'] != 'date')
                    <td>{{$answer['answer']}}</td>
                @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>