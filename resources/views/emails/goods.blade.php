@foreach($rows as $row)
    <h3>{!! $row['title'] !!}</h3>
    <p>{!! $row['content'] !!}</p>
    <hr />
@endforeach

