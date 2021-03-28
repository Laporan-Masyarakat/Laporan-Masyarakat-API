<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
      *{
        margin: 0;
        padding: 0;
      }

      table {
        margin-left: -20px;
      }
    </style>
</head>
<body>
    <div class="container mt-5">
    <table class="table table-bordered" >
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Judul Laporan</th>
          <th scope="col">Isi Laporan</th>
          <th scope="col">Tanggal Pengaduan</th>
          <th scope="col">Lokasi Kejadian</th>
          <th scope="col">Instansi Tujuan</th>
          <th scope="col">Kategori Laporan</th>
          <th scope="col">Foto Laporan</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
          @foreach($data as $value)
        <tr>
          <?php $i = 1; ?>
          <th scope="row">{{$i++}}</th>
          <td>{{$value->judul_laporan}}</td>
          <td>{{$value->isi_laporan}}</td>
          <td>{{$value->tgl_pengaduan}}</td>
          <td>{{$value->lokasi_kejadian}}</td>
          <td>{{$value->instansi_tujuan}}</td>
          @foreach($value->laporankategori as $k)
          <td>{{$k->kategori_laporan}}</td>
          @endforeach
          <td><img src="{{base_path() . '/public/upload/fotolaporan' . '/'. explode('fotolaporan/', $value->foto_laporan)[1]}}" alt="gambar_laporan" style="width: 100px"></td>
          @foreach($value->statuslaporan as $u)
          <td>{{$u->status}}</td>
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
</body>
</html>