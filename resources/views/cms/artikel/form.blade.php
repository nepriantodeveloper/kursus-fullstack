<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="modal-form" class="form-horizontal" data-toggle="validator" method="post" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"> &times; </span> </button>

                </div>

                <div class="modal-body">

                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-md-12">
                           

                            <div class="form-group">
                                <label for="nama" class=" control-label">Judul</label>
                                <input id="judul" type="text" class="form-control" name="judul" required>
                                <span class="help-block with-errors"></span>
                            </div>

                           

                            <div class="form-group">
                                <label for="merk" class=" control-label">Isi</label>
                                <textarea name="isi" id="isi" class="form-control"></textarea>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="merk" class=" control-label">Foto</label>
                                <input type="file" id="foto" class="form-control" name="foto">
                                <img src="" alt="" id="fotonya">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i
                            class="fa fa-arrow-circle-left"></i> Batal</button>
                    <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
