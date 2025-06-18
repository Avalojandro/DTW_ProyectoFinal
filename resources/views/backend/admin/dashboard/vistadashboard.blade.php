@extends('backend.layouts.admin')

@section('title', 'Panel de Administración')

@section('styles')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-header bg-white border-0 py-3">
                        <h3 class="h5 mb-0 text-primary">
                            Panel de Control
                        </h3>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="alert alert-light border mb-4">
                            <h4 class="h5 mb-0 text-dark">¡Bienvenido, {{$usuario}}!</h4>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex flex-column align-items-center py-4">
                                        <h5 class="card-title text-dark mb-3">Roles</h5>
                                        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary btn-sm px-4">
                                            Administrar
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body d-flex flex-column align-items-center py-4">
                                        <h5 class="card-title text-dark mb-3">Permisos</h5>
                                        <a href="{{ route('admin.permisos.index') }}" class="btn btn-success btn-sm px-4">
                                            Administrar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
