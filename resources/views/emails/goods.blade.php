@foreach($rows as $row)
    <h3>{{ $row['from'] }} ---- <a href="{!! $row['url'] !!}">{!! $row['title'] !!}</a></h3>
    <h5>商品链接： {{ $row['url'] }} </h5>
    <p>{!! $row['content'] !!}</p>
    <hr />
@endforeach

