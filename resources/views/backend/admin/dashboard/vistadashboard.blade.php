@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
@stop


    <div class="container" style="">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <h2>Dashboard</h2>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <h4>Hola , {{$usuario}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 mb-3">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-primary" style="font-weight: bold; background-color: #28a745; color: white !important;">Administrar Roles</a>
                </div>
                <div class="col-md-2 mb-3">
                    <a href="{{ route('admin.permisos.index') }}" class="btn btn-secondary" style="text-wrap: nowrap; font-weight: bold; background-color: #28a745; color: white !important;">Administrar Permisos</a>
                </div>
            </div>
        </div>
    </div>

    @section('archivos-js')
    @stop
