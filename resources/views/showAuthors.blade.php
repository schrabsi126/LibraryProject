<table id="authors" class="table table-striped">
    <thead>
    <tr>
        <th scope="col"> Id</th>
        <th scope="col"> Name</th>
        <th scope="col"> Age</th>
        <th scope="col"> Address</th>
    </tr>
    </thead>
    <tbody>
    @foreach($authors as $author)
    <tr scope="row">
        <th> {{$author->id}} </th>
        <th> {{$author->name}} </th>
        <th> {{$author->age}} </th>
        <th> {{$author->address}} </th>
    </tr>

    @if($author->books->count()!= 0)
        <tr scope="row">
            <td></td>
            <td>Book Id</td>
            <td>Book Title</td>
            <td>Release Date</td>
        </tr>
        @foreach($author->books as $book)
            <tr scope="row">
                <td></td>
                <td>{{$book->id}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->release_date}}</td>
            </tr>
        @endforeach
        @endif
    @endforeach
    </tbody>
</table>
{!! $authors->render() !!}

