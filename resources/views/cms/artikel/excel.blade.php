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

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-th"></i>
                    </button>

                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('exportproduk') }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="file">File:</label>
                    <input id="file" type="file" name="file" class="form-control">
                </div>
                <div class="form-group">
                    <a class="btn btn-info" href="{{ route('export') }}">Export File</a>
                </div>
                <button class="btn btn-success">Import File</button>
            </form>
        </div>
    </div>
@endsection
