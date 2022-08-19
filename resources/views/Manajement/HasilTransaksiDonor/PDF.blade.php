<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img src="{{ public_path('assets/img/Red-Cross-PMI.png') }}" alt="" style="width: 50px; height: 50px;">
    <table>
        <tbody>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Code_Transaction</th>
                <th>Hemoglobin</th>
                <th>Pressure</th>
                <th>kadal</th>
                <th>kadal</th>
                <th>kadal</th>
                <th>kadal</th>
                <th>kadal</th>
            </tr>
            @foreach ($data_transaction as $rows)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $rows->User_Connection->name }}</td>
                <td>{{ $rows->Code_Transaction }}</td>
                <td>{{ $rows->Code_Transaction }}</td>
                <td>{{ $rows->Code_Transaction }}</td>
                <td>{{ $rows->Code_Transaction }}</td>
                <td>{{ $rows->Code_Transaction }}</td>
                <td>{{ $rows->Code_Transaction }}</td>
                <td>{{ $rows->Code_Transaction }}</td>
                <td>{{ $rows->Hemoglobin }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>