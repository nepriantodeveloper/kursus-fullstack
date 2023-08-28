@extends('layouts.app')

@section('title')
    Data Artikel
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('artikel.index') }}">artikel</a></li>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
            <a onclick="deleteAll()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-th"></i>
                </button>

            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-artikel">
                {{ csrf_field() }}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="20"><input type="checkbox" value="1" id="select-all"></th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Gambar</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </form>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    @include('cms.artikel.form')



    <script type="text/javascript">
        var table, save_method;
        $(function() {
            table = $('.table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{!! route('artikel.index') !!}',
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'isi',
                        name: 'isi'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#select-all').click(function() {
                $('input[type="checkbox"]').prop('checked', this.checked);
            });

            $('#modal-form form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    let formData = new FormData(this);
                    var id = $('#id').val();
                    if (save_method == "add") url = "{{ route('artikel.store') }}";
                    else url = "artikel/" + id;
                    //console.log($('#modal-form form').serialize());
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form form').serialize(),
                        // data: formData,
                        // dataType: 'JSON',
                        success: function(data) {
                            if (data.msg == "error") {
                                alert('Kode artikel sudah digunakan!');
                                $('#kode').focus().select();
                            } else {
                                $('#modal-form').modal('hide');
                                table.ajax.reload();
                            }
                        },
                        error: function() {
                            alert("Tidak dapat menyimpan data!");
                        }
                    });
                    return false;
                }
            });
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah artikel');
            $('#kode').attr('readonly', false);
        }

        function editForm(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "artikel/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit artikel');

                    $('#id').val(data.id);
                    $('#kode').val(data.judul);
                    $('#nama').val(data.isi);
                    $('#kategori').val(data.gambar);

                },
                error: function() {
                    alert("Tidak dapat menampilkan data!");
                }
            });
        }

        function deleteData(id) {
            if (confirm("Apakah yakin data akan dihapus?")) {
                $.ajax({
                    url: "artikel/" + id,
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
                    url: "artikel/hapus",
                    type: "POST",
                    data: $('#form-artikel').serialize(),
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak dapat menghapus data!");
                    }
                });
            }
        }

        function printBarcode() {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dicetak!');
            } else {
                $('#form-artikel').attr('target', '_blank').attr('action', "artikel/cetak").submit();
            }
        }
    </script>
@endsection
