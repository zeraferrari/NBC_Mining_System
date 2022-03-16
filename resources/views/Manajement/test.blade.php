<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($result as $item)
        <p>Nama Rhesus {{ $item->Name }}</p>
        <p>Total Data {{ count($item->User_Connection) }}</p>
    @endforeach
</body>
</html>