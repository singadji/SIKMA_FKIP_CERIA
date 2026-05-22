@extends('layouts.app')

@section('title', 'SERVQUAL')

@section('content')

<div class="card">

    <div class="card-header">

        <h4>
            Analisis SERVQUAL
        </h4>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Nilai</th>

                </tr>

            </thead>

            <tbody>

                @foreach($servqual as $item)

                <tr>

                    <td>
                        {{ $item->nama_kategori }}
                    </td>

                    <td>
                        {{ $item->deskripsi }}
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
