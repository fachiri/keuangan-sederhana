@extends('app')
 
@section('title', 'Home')
 
@section('content')
<div class="row">
    <div class="col-6 mb-4">
        <div class="card">
            <h5 class="card-header bg-success text-light">Total Pemasukan</h5>
            <div class="card-body">
                <h5 class="card-title">@currency($totalPemasukan)</h5>
                <span class="d-flex flex-row-reverse">
                    <a href="/pemasukan" class="btn btn-success">
                        <i class="fa-solid fa-coins"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-6 mb-4">
        <div class="card">
            <h5 class="card-header bg-danger text-light">Total Pengeluaran</h5>
            <div class="card-body">
                <h5 class="card-title">@currency($totalPengeluaran)</h5>
                <span class="d-flex flex-row-reverse">
                    <a href="pengeluaran" class="btn btn-danger">
                        <i class="fa-solid fa-coins"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-6 mb-4">
        <div class="card">
            <h5 class="card-header bg-warning">Total Kas</h5>
            <div class="card-body">
                <h5 class="card-title">@currency($totalKas)</h5>
                <span class="d-flex flex-row-reverse">
                    <a href="pengeluaran" class="btn btn-warning">
                        <i class="fa-solid fa-file-lines me-1"></i>
                        Laporan
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
@endsection