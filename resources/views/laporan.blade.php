@extends('app')
 
@section('title', 'Laporan')
 
@section('content')
  <h4 class="mb-4">Ringkasan</h4>
  <div class="table-responsive mb-4">
    <table class="table table-hover">
      <tr>
        <th>Total Pemasukan</th>
        <td>@currency($totalPemasukan)</td>
      </tr>
      <tr>
        <th>Total Pengeluaran</th>
        <td>@currency($totalPengeluaran)</td>
      </tr>
      <tr>
        <th>Total Kas</th>
        <td>@currency($totalKas)</td>
      </tr>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Laporan</h4>
    <a href="/export/excel/laporan" class="btn btn-success">
      <i class="fa-regular fa-file-excel"></i>
      Excel
    </a>
  </div>
  <div>
    <table class="table table-hover" id="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Tanggal</th>
          <th>Kas</th>
          <th>Pemasukan</th>
          <th>Pengeluaran</th>
          <th>Jenis</th>
          <th>Penerima</th>
          <th>Akun</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($laporan as $key)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $key->tanggal }}</td>
            <td>@currency($key->kas)</td>
            <td>@currency($key->pemasukan)</td>
            <td>@currency($key->pengeluaran)</td>
            <td>{{ $key->jenis }}</td>
            <td>{{ $key->penerima }}</td>
            <td>{{ $key->akun }}</td>
            <td>{{ $key->keterangan }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection