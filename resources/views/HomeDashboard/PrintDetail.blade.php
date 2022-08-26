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
    </style>
    <title>Printout</title>
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
                        Dengan ini menyatakan bahwa, transaksi donor dengan Nomor Transaksi <b>{{ $data->Code_Transaction }}</b> yang dilakukan pada tanggal <b>{{ $data->Waktu_Donor }}</b> 
                        di Unit Donor Darah PMI Kota Samarinda yang dilakukan oleh Bapak/Ibu atas nama <b>{{ $data->User_Connection->name }}</b>
                        dengan detail sebagai berikut: 
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 70%; border-collapse: collapse;" align="center" border="1">
        <tbody>
            <tr>
                <td>Nama</td>
                <td>{{ $data->User_Connection->name }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>{{ $data->User_Connection->NIK }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $data->User_Connection->Gender }}</td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>{{ $data->Age }}</td>
            </tr>
            <tr>
                <td>Hemoglobin</td>
                <td>{{ $data->Hemoglobin }} g/dL</td>
            </tr>
            <tr>
                <td>Berat Badan</td>
                <td>{{ $data->Weight }} Kg</td>
            </tr>
            <tr>
                <td>Tekanan Sistole</td>
                <td>{{ $data->Pressure_sistole }} mmHg</td>
            </tr>
            <tr>
                <td>Tekanan Diastole</td>
                <td>{{ $data->Pressure_diastole }} mmHg</td>
            </tr>
            <tr>
                <td>Hasil Klasifikasi</td>
                <td>{{ $data->Status_Transaction }}</td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td>
                    <p style="text-align: justify;">
                        Transaksi pendonor darah dinyatakan <b>{{ $data->Status_Donor }}</b> yang ditangani oleh petugas medis atas nama <b>{{ $data->Petugas_Connection->name }}</b> dan diperbolehkan mendonor kembali pada tanggal <b>{{ $data->Kembali_Donor }}</b> sesuai ketentuan yang berlaku 
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%; margin-top: 50px;">
        <tbody>
            <tr>
                <td style="width: 60%"></td>
                <td style="text-align: center;">Samarinda, {{ \Carbon\Carbon::now()->isoFormat('dddd DD MMMM YYYY') }}</td>
            </tr>
            <tr>
                <td style="width: 60%;"></td>
                <td style="text-align: center; width: 100px; height: 100px;">Tanda tangan here</td>
            </tr>
            <tr>
                <td style="width: 60%;"></td>
                <td style="text-align: center;">{{ $data->Petugas_Connection->name }}</td>
            </tr>
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>
</html>