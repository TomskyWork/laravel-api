<h1>Data list</h1>

<!-- {{print_r($data)}} -->

<ul>
@foreach($data as $item)
    <li><h3>{{$item['title']}}</h3><p>{{$item['body']}}</p></li>
@endforeach
</ul>