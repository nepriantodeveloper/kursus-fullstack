<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Kategori</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <h1>Data Kategori</h1>
    <table width="100%" border="1" class="table table-bordered">
        @foreach ($datakategori as $data)
        <tr>
            <td>{{ $data->nama_kategori }}</td>
        </tr>
        @endforeach
        </tr>
    </table>
</body>

</html>
