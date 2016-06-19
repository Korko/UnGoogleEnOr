<!DOCTYPE html>
<html>
    <head>
        <title>Un Google en Or - Admin</title>
    </head>
    <body>
        <ul>
        @foreach($questions as $question)
            <li>
                << ucfirst($question->text) >> --
                <select>
                @foreach($question->answers as $i => $answer)
                    <option><< ($i+1) >>. << $answer->text >></option>
                @endforeach
                </select>
            </li>
        @endforeach
        </ul>
        <a href="/admin/add">Ajouter</a>
    </body>
</html>


