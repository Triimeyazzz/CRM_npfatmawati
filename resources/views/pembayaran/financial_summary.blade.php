@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ringkasan Keuangan</h1>

        <p>Total Pemasukan: {{ $totalPemasukan }}</p>
        <p>Total Tagihan: {{ $totalTagihan }}</p>
        <p>Sisa Tagihan: {{ $sisaTagihan }}</p>

        <h4>Pemasukan Per Bulan:</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tahun</th>
                    <th>Bulan</th>
                    <th>Total Pemasukan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemasukanPerBulan as $pemasukan)
                    <tr>
                        <td>{{ $pemasukan->year }}</td>
                        <td>{{ $pemasukan->month }}</td>
                        <td>{{ $pemasukan->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
