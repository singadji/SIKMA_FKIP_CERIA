<!DOCTYPE html>
<html>

<head>

    <title>
        Laporan SIKMA
    </title>

    <style>

        body{
            font-family: sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table th,
        table td{
            border:1px solid #000;
            padding:8px;
        }

        .text-center{
            text-align:center;
        }

    </style>

</head>

<body>

<h2 class="text-center">

    LAPORAN SURVEY KEPUASAN MAHASISWA

</h2>

<p>
    Indeks Kepuasan Mahasiswa:
    <strong>{{ $ikm }}%</strong>
</p>

<table>

    <thead>

        <tr>

            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Tanggal Survey</th>
            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        @foreach($survey as $item)

        <tr>

            <td>
                {{ $loop->iteration }}
            </td>

            <td>
                {{ $item->mahasiswa->nama }}
            </td>

            <td>
                {{ $item->mahasiswa->nim }}
            </td>

            <td>
                {{ $item->tanggal_survey }}
            </td>

            <td>

                {{ $item->status_selesai
                    ? 'Selesai'
                    : 'Belum'
                }}

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>
