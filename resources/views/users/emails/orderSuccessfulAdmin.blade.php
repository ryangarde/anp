<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p>
        email: {{ auth()->user()->email }}<br>
        {{ auth()->user()->name }} has ordered this following products:<br>
        <ul>
            @foreach($products as $product)
            <li>{{ $product->quantity }} {{ $product->product->name }} {{ $product->retailsize->name }}</li>
            @endforeach
        </ul>

    </p>
</body>
</html>
