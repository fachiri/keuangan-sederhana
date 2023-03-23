@extends('app')
 
@section('title', 'Pemasukan')
 
@section('content')
  <h4 class="mb-4">Ringkasan</h4>
  <div class="table-responsive mb-4">
    <table class="table table-hover">
      <tr>
        <th>Total Pemasukan</th>
        <td>@currency($total)</td>
      </tr>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Pemasukan</h4>
    <div>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#import">
        <i class="fa-regular fa-file-excel"></i>
        Import
      </button>
      <a href="/export/excel/pemasukan" class="btn btn-success">
        <i class="fa-regular fa-file-excel"></i>
        Export
      </a>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
        <i class="fa-solid fa-plus"></i>
        Tambah Data
      </button>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-hover" id="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Tanggal</th>
          <th>Nominal</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pemasukan as $key)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $key->tanggal }}</td>
            <td>@currency($key->nominal)</td>
            <td>{{ $key->keterangan }}</td>
            <td>
              <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{ $key->id }}"><i class="fa-regular fa-pen-to-square"></i></button>
              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $key->id }}"><i class="fa-regular fa-trash-can"></i></button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{-- import modal --}}
  <div class="modal fade" id="import" tabindex="-1" aria-labelledby="importLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="importLabel">Import Pemasukan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <form action="/import/excel/pemasukan" method="POST" class="input-group" enctype="multipart/form-data">
              @csrf
              <input type="file" name="file" id="file" class="form-control">
              <button type="submit" class="btn btn-success">
                <i class="fa-regular fa-file-excel"></i>
                Import
              </button>
            </form>
          </div>
      </div>
    </div>
  </div>
  {{-- add modal--}}
  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addLabel">Tambah Pemasukan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="pemasukan/add" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="nominal" class="form-label">Nominal</label>
              <input type="text" class="form-control" id="nominal" name="nominal" type-currency="IDR" placeholder="Rp">
            </div>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal <small>( bulan / hari / tahun ) </small></label>
              <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d H:i:s') }}">
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea name="keterangan" id="keterangan" cols="10" rows="5" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Tambah Pemasukan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- edit modal --}}
  @foreach ($pemasukan as $key)
    <div class="modal fade" id="edit{{ $key->id }}" tabindex="-1" aria-labelledby="edit{{ $key->id }}Label" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="edit{{ $key->id }}Label">Edit</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="pemasukan/edit/{{ $key->id }}" method="post">
            @csrf
            <div class="modal-body">
              <div class="mb-3">
                <label for="nominal" class="form-label">Nominal</label>
                <input type="text" class="form-control" id="nominal" name="nominal" value="@currency($key->nominal)" type-currency="IDR" placeholder="Rp">
              </div>
              <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal <small>( bulan / hari / tahun ) </small></label>
                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="{{ $key->tanggal }}">
              </div>
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="10" rows="5" class="form-control">{{ $key->keterangan }}</textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-success" type="submit">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endforeach
  {{-- delete modal --}}
  @foreach ($pemasukan as $key)
    <div class="modal fade" id="delete{{ $key->id }}" tabindex="-1" aria-labelledby="delete{{ $key->id }}Label" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="delete{{ $key->id }}Label">Hapus</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="pemasukan/delete/{{ $key->id }}" method="post">
            @csrf
            <div class="modal-body">
              <h6>Anda akan menghapus data berikut:</h6>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Nominal</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $key->tanggal }}</td>
                      <td>@currency($key->nominal)</td>
                      <td>{{ $key->keterangan }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-danger" type="submit">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endforeach
@endsection