@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        <div class="card-header">
            <div class="card-header">
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
                <a onclick="deleteAll()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                <a onclick="print()" class="btn btn-warning"><i class="fa fa-barcode"></i> Cetak Data</a>
                <a href="" class="btn btn-info"><i class="fa fa-file-excel-o"></i> Import / Export Excel</a>
    
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-th"></i>
                    </button>
    
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form method="post" id="form-produk">
                    {{ csrf_field() }}
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th width="20"><input type="checkbox" value="1" id="select-all"></th>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                </form>
            </div>
        </div>

    </div>
    @include('cms.kategori.form')
    <script>
        var table, save_method;
        $(function() {
            //untuk fungsi cekist
            $('#select-all').click(function() {
                $('input[type="checkbox"]').prop('checked', this.checked);
            });
            //tampil data ke tabel
            table = $('.table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{!! route('kategori.index') !!}',
                columns: [
                    {
                        data: 'checkbox',
                        name: 'checkbox'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#modal-form form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == "add") url = "{{ route('kategori.store') }}";
                    else url = "kategori/" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form form').serialize(),
                        success: function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        },
                        error: function() {
                            alert("Tidak dapat menyimpan data!");
                        }
                    });
                    return false;
                }
            });
            //untuk  tombol delete
            $('body').on('click', '.delete', function() {
                if (confirm("Delete Record?") == true) {
                    var id = $(this).data('id');
                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('kategori') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('.table').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            });

        });
        //memanggil form
        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Kategori');
        }
        //memanggil form edit
        function editForm(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "kategori/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Kategori');

                    $('#id').val(data.id);
                    $('#nama').val(data.nama_kategori);

                },
                error: function() {
                    alert("Tidak dapat menampilkan data!");
                }
            });
        }
        //untuk menghapus data
        function deleteData(id) {
            if (confirm("Apakah yakin data akan dihapus?")) {
                $.ajax({
                    url: "kategori/" + id,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    },
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak dapat menghapus data!");
                    }
                });
            }
        }

        function deleteAll() {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dihapus!');
            } else if (confirm("Apakah yakin akan menghapus semua data terpilih?")) {
                $.ajax({
                    url: "kategori/hapus",
                    type: "POST",
                    data: $('#form-produk').serialize(),
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak dapat menghapus data!");
                    }
                });
            }
        }

        function print() {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dicetak!');
            } else {
                $('#form-produk').attr('target', '_blank').attr('action', "kategori/cetak").submit();
            }
        }
    </script>
@endsection
