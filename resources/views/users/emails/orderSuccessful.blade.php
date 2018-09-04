<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p>
        Dear Costumer,<br><br>
        Thank you for shopping via ANP online.<br><br>
        We have received your order of:<br>
        <ul>
            @foreach($products as $product)
            <li>{{ $product->quantity }} {{ $product->product->name }} {{ $product->retailsize->name }}</li>
            @endforeach
        </ul>
        We are currently checking the availability of your chosen item.  ANP will inform the via phone call
        how much is the total cost of the order and the next steps to be taken (where to pay, delivery address, etc)
        <br><br>
        Thank you and good day.
    </p>
</body>
</html>
