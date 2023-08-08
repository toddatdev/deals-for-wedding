<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Wedding Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userDetails as $row)
        <tr>
            <td>{{$row->fname}} {{$row->lname}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->userDetails->number}}</td>

        </tr>
        @endforeach
    </tbody>
</table>