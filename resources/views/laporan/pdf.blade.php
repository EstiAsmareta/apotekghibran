<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    
    <!-- Custom styles for this template-->
    <link href="{{ asset ('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    </head>
<body>
    <h3 class="text-center text-gray-800">Laporan Penjualan</h3>
    <h6 class="text-center">
        Tanggal {{ tanggal_indonesia($awal, false) }}
        s/d
        Tanggal {{ tanggal_indonesia($akhir, false) }}
    </h6>

    <table class="table table-sm table-bordered text-center">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Penjualan</th>
                <th>Total Obat</th>
                <th>Transaksi</th>
                {{-- <th>Pendapatan</th> --}}
            </tr>
        </thead>
        <tbody>
            <?php
                $totalPenjualan = 0;
                $totalObat = 0;
                $totalTransaksi = 0;
            ?>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $col)
                        <td>{{ $col }}</td>
                    @endforeach
                </tr>
                <?php
                    $totalPenjualan += intval($row['penjualan']);
                    $totalObat += intval($row['total_item']);
                    $totalTransaksi += intval($row['total_transaksi']);
                ?>
            @endforeach
        </tbody>
        <tfoot>
                <td></td>
                <td>Total :</td>
                <td>{{ $totalPenjualan }}</td>
                <td>{{ $totalObat }}</td>
                <td>{{ $totalTransaksi }}</td>
        </tfoot>
    </table>
</body>
</html>