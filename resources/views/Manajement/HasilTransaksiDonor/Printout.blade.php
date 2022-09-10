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

        body :nth-child(6), body :nth-child(8), body :nth-child(10), body :nth-child(11),
        body :nth-child(12), body :nth-child(13), body :nth-child(14), body :nth-child(15){
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

        body table:nth-child(10) tbody tr:nth-child(2) td, 
        body table:nth-child(11) tbody tr:nth-child(2) td,
        body table:nth-child(12) tbody tr:nth-child(2) td{
            width: 16.16%;
        }

        body table:nth-child(10) tbody tr:nth-child(2) td:nth-child(n+2), 
        body table:nth-child(10) tbody tr:nth-child(3) td:nth-child(n+2), 
        body table:nth-child(10) tbody tr:nth-child(4) td:nth-child(n+2),
        body table:nth-child(11) tbody tr:nth-child(2) td:nth-child(n+2),
        body table:nth-child(11) tbody tr:nth-child(3) td:nth-child(n+2),
        body table:nth-child(11) tbody tr:nth-child(4) td:nth-child(n+2),
        body table:nth-child(12) tbody tr:nth-child(2) td:nth-child(n+2),
        body table:nth-child(12) tbody tr:nth-child(3) td:nth-child(n+2),
        body table:nth-child(12) tbody tr:nth-child(4) td:nth-child(n+2){
            text-align: center;
        }

        body table:nth-child(13) tbody tr:nth-child(2) td:nth-child(2), body table:nth-child(13) tbody tr:nth-child(3) td:nth-child(2),
        body table:nth-child(14) tbody tr:nth-child(2) td:nth-child(2), body table:nth-child(14) tbody tr:nth-child(3) td:nth-child(2),
        body table:nth-child(15) tbody tr:nth-child(2) td:nth-child(2), body table:nth-child(15) tbody tr:nth-child(3) td:nth-child(2){
            text-align: center;
            width: 50%;
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
                <td>{{ \Carbon\Carbon::parse($data->Waktu_Donor)->isoFormat('dddd, DD MMMM YYYY') }}</td>
            </tr>
            <tr>
                <td>Tanggal Kembali Mendonor Darah</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($data->Kembali_Donor)->isoFormat('dddd, DD MMMM YYYY') }}</td>
            </tr>
        </tbody>
    </table>
    <div class="mt-10"><b>Perhitungan Naive Bayes Classifier</b></div>
    <table border="1">
        <tbody>
            <tr>
                <th colspan="6">Nilai Mean</th>
            </tr>
            <tr>
                <td><b>Attribute</b></td>
                <td>Umur</td>
                <td>Berat Badan</td>
                <td>Hemoglobin</td>
                <td>Tekanan Sistole</td>
                <td>Tekanan Diastole</td>
            </tr>
            <tr>
                <td><b>Class Layak</b></td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Age'] }}</td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Weight'] }}</td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
            </tr>
            <tr>
                <td><b>Class Tidak Layak</b></td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
            </tr>
        </tbody>
    </table>
    <table border="1">
        <tbody>
            <tr>
                <th colspan="6">Nilai Standar Deviasi</th>
            </tr>
            <tr>
                <td><b>Attribute</b></td>
                <td>Umur</td>
                <td>Berat Badan</td>
                <td>Hemoglobin</td>
                <td>Tekanan Sistole</td>
                <td>Tekanan Diastole</td>
            </tr>
            <tr>
                <td><b>Class Layak</b></td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Age'] }}</td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Weight'] }}</td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
            </tr>
            <tr>
                <td><b>Class Tidak Layak</b></td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
            </tr>
        </tbody>
    </table>
    <table border="1">
        <tbody>
            <tr>
                <th colspan="6">Nilai Distribusi Gaussian</th>
            </tr>
            <tr>
                <td><b>Attribute</b></td>
                <td>Umur</td>
                <td>Berat Badan</td>
                <td>Hemoglobin</td>
                <td>Tekanan Sistole</td>
                <td>Tekanan Diastole</td>
            </tr>
            <tr>
                <td><b>Class Layak</b></td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Age'] }}</td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Weight'] }}</td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
            </tr>
            <tr>
                <td><b>Class Tidak Layak</b></td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
            </tr>
        </tbody>
    </table>
    <table border="1">
        <tbody>
            <tr>
                <th colspan="2">Hasil Probabilitas Setiap Attribute Berdasarkan Class</th>
            </tr>
            <tr>
                <td><b>Class Layak</b></td>
                <td>{{ $Result_Classifier[0]->Probability_All_Attribute_Each_Class['Class_Layak'] }}</td>
            </tr>
            <tr>
                <td><b>Class Tidak Layak</b></td>
                <td>{{ $Result_Classifier[0]->Probability_All_Attribute_Each_Class['Class_Tidak_Layak'] }}</td>
            </tr>
        </tbody>
    </table>
    <table border="1">
        <tbody>
            <tr>
                <th colspan="2">Hasil Akhir Probabilitas Berdasarkan Class</th>
            </tr>
            <tr>
                <td><b>Class Layak</b></td>
                <td>{{ $Result_Classifier[0]->Probability_Each_Class_Not_Normalization['Class_Layak'] }}</td>
            </tr>
            <tr>
                <td><b>Class Tidak Layak</b></td>
                <td>{{ $Result_Classifier[0]->Probability_Each_Class_Not_Normalization['Class_Tidak_Layak'] }}</td>
            </tr>
        </tbody>
    </table>
    <table border="1">
        <tbody>
            <tr>
                <th colspan="2">Hasil Normalisasi Berdasarkan Class</th>
            </tr>
            <tr>
                <td><b>Class Layak</b></td>
                <td>{{ $Result_Classifier[0]->Probability_Each_Class_Normalization['Class_Layak'] }}</td>
            </tr>
            <tr>
                <td><b>Class Tidak Layak</b></td>
                <td>{{ $Result_Classifier[0]->Probability_Each_Class_Normalization['Class_Tidak_Layak'] }}</td>
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
</body>
    <script>
        window.print();
    </script>
</html>