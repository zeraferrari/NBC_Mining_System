<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .Font-24-b{
            font-size: 24px;
            font-weight: bold;
        }

        .Font-16{
            font-size: 16px;
        }

        body :nth-child(6), body :nth-child(8){
            width: 100%;
            margin: 10px auto; 
            border-collapse: collapse;
        }

        body table:nth-child(6) tbody tr :nth-child(1), body table:nth-child(8) tbody tr :nth-child(1){
            width: 50%;
        }

        body table:nth-child(6) tbody tr :nth-child(2), body table:nth-child(8) tbody tr :nth-child(2){
            text-align: center;
            width: 12px;
        }
        
        body table:nth-child(6) tbody tr :nth-child(3), body table:nth-child(8) tbody tr :nth-child(3){
            padding-left: 10px;
        }

        .mt-10{
            margin-top: 10px;
        }

        </style>
    <title>PrintoutData</title>
</head>
<body>
    <table>
        <tbody>
            <tr align="center">
                <td>
                    <img src="{{ asset('assets/img/Red-Cross-PMI.png') }}" alt="Logo-Palang-Merah-Indonesia" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <div>
                        <span class="Font-24-b">Unit Donor Darah (UDD) PMI Kota Samarinda</span>
                        <br>
                        <span class="Font-16">Jl. Palang Merah Indonesia No.1, Sidodadi, Kec.Samarinda Ulu, Kota Samarinda, Kalimantan Timur 75123</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div align="center">
        <h2 style="text-decoration: underline;">Hasil Klasifikasi Transaksi Donor Darah</h2>
    </div>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td>
                    <p style="text-align: justify;">
                        Hasil klasifikasi menunjukan bahwa hasil transaksi donor darah dengan kode : <b>{{ $data->Code_Transaction }}</b>
                        pada pendonor darah atas nama <b>{{ $data->User_Connection->name }}</b> dinyatakan sebagai <b>{{ $data->Status_Transaction }}</b>
                        donor darah. Dengan rincian data perhitungan sebagai berikut :
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="mt-10"><b>Data Pendonor Darah</b></div>
    <table border="1">
        <tbody>
            <tr>
                <td>Nama Pendonor Darah </td>
                <td>:</td>
                <td>{{ $data->User_Connection->name }}</td>
            </tr>
            <tr>
                <td>Jenis Gender</td>
                <td>:</td>
                <td>{{ $data->User_Connection->Gender }}</td>
            </tr>
            <tr>
                <td>Nomor Induk Kewarganegaraan</td>
                <td>:</td>
                <td>{{ $data->User_Connection->NIK }}</td>
            </tr>
            <tr>
                <td>Jenis Golongan Rhesus</td>
                <td>:</td>
                <td>{{ $data->User_Connection->Rhesus_Connection->Name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $data->User_Connection->email }}</td>
            </tr>
            <tr>
                <td>Nomor Hp/Whatsapp</td>
                <td>:</td>
                <td>{{ $data->User_Connection->phone_number }}</td>
            </tr>
        </tbody>
    </table>
    <div class="mt-10"><b>Data Variable Donor Darah</b></div>
    <table border="1">
        <tbody>
            <tr>
                <td>Hemoglobin</td>
                <td>:</td>
                <td>{{ $data->Hemoglobin }} g/dL</td>
            </tr>
            <tr>
                <td>Berat Badan</td>
                <td>:</td>
                <td>{{ $data->Weight }} Kg</td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>:</td>
                <td>{{ $data->Age }} Tahun</td>
            </tr>
            <tr>
                <td>Tekanan Sistole/Tekanan Atas</td>
                <td>:</td>
                <td>{{ $data->Pressure_sistole }} mmHg</td>
            </tr>
            <tr>
                <td>Tekanan Diastole/Tekanan Bawah</td>
                <td>:</td>
                <td>{{ $data->Pressure_diastole }} mmHg</td>
            </tr>
            <tr>
                <td>Tanggal Mendonor Darah</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($data->Waktu_Donor)->isoFormat('dddd DD MMMM YYYY') }}</td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%; margin-top: 30px;">
        <tbody>
            <tr>
                <td style="width: 60%"></td>
                <td style="text-align: center;">Samarinda, {{ $Waktu_Donor }}</td>
            </tr>
            <tr>
                <td style="width: 60%"></td>
                <td style="text-align: center; height: 100px;">Tanda Tangan Here</td>
            </tr>
            <tr>
                <td style="width: 60%;"></td>
                <td style="text-align: center">Palang Merah Indonesia</td>
            </tr>
        </tbody>
    </table>
    {{ dd($nest) }}
</body>
    <script>
        // window.print();
    </script>
</html>