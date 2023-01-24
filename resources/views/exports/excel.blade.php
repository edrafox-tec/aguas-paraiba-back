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
                
                @endif
                    <td>{{$answer['answer']}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>