@extends('layouts.app')

@section('title', 'Laporan Prodi')

@section('content')

<div class="card">

    <div class="card-header">

        <h4>
            Ranking Program Studi
        </h4>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Ranking</th>
                    <th>Program Studi</th>
                    <th>Nilai</th>

                </tr>

            </thead>

            <tbody>

                @foreach($prodi as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->nama_prodi }}
                    </td>

                    <td>

                        {{ round($item->rata,2) }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
