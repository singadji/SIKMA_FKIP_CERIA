@extends('layouts.app')

@section('title', 'Laporan Dosen')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h4>
            Ranking Kepuasan Dosen
        </h4>

        <a
            href="#"
            class="btn btn-danger"
        >
            Export PDF
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Ranking</th>
                    <th>Nama Dosen</th>
                    <th>Nilai</th>
                    <th>Total Survey</th>

                </tr>

            </thead>

            <tbody>

                @foreach($dosen as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->nama_dosen }}
                    </td>

                    <td>

                        {{ round($item->rata,2) }}

                    </td>

                    <td>

                        {{ $item->total }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
