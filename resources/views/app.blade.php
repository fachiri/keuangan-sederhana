<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>
      @yield('title')
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
  </head>
  <body>

<main class="d-flex flex-nowrap">
  <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <i class="fa-solid fa-coins fs-4"></i>
      <span class="fs-4 ms-2 fw-bold">ADAM MERDEKA</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/" class="nav-link {{ (request()->segment(1) == '') ? 'active' : 'link-dark' }}" aria-current="page">
          <i class="fa-solid fa-house me-2"></i>
          Home
        </a>
      </li>
      <li>
        <a href="pemasukan" class="nav-link {{ (request()->segment(1) == 'pemasukan') ? 'active' : 'link-dark' }}">
          <i class="fa-solid fa-sack-dollar me-2"></i>
          Pemasukan
        </a>
      </li>
      <li>
        <a href="pengeluaran" class="nav-link {{ (request()->segment(1) == 'pengeluaran') ? 'active' : 'link-dark' }}">
          <i class="fa-solid fa-sack-dollar me-2"></i>
          Pengeluaran
        </a>
      </li>
      <li>
        <a href="laporan" class="nav-link {{ (request()->segment(1) == 'laporan') ? 'active' : 'link-dark' }}">
          <i class="fa-solid fa-chart-bar me-2"></i>
          Laporan
        </a>
      </li>
    </ul>
  </div>

  <section class="container py-3 px-4">
    @yield('content')
  </section>
  
</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- datatables --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#table').DataTable();
    } );
    </script>
    <script>
      @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 
      @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!'); 
      @endif
    </script>
    <script>
      document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
        // element.addEventListener('keyup', function(e) {
        // let cursorPostion = this.selectionStart;
        //   let value = parseInt(this.value.replace(/[^,\d]/g, ''));
        //   let originalLenght = this.value.length;
        //   if (isNaN(value)) {
        //     this.value = "";
        //   } else {    
        //     this.value = value.toLocaleString('id-ID', {
        //       currency: 'IDR',
        //       style: 'currency',
        //       minimumFractionDigits: 0
        //     });
        //     cursorPostion = this.value.length - originalLenght + cursorPostion;
        //     this.setSelectionRange(cursorPostion, cursorPostion);
        //   }
        // });
        element.addEventListener('keyup', function(e) {
          element.value = formatRupiah(this.value, 'Rp. ');
        });
      });
      /* Fungsi */
      function formatRupiah(angka, prefix)
      {
          var number_string = angka.replace(/[^,\d]/g, '').toString(),
              split    = number_string.split(','),
              sisa     = split[0].length % 3,
              rupiah     = split[0].substr(0, sisa),
              ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
              
          if (ribuan) {
              separator = sisa ? '.' : '';
              rupiah += separator + ribuan.join('.');
          }
          
          rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
          return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
      }
    </script>
  </body>
</html>
