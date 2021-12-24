@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Ver'))

@section('body')

    <div class="container-xl">
        <div class="card">

                <div class="card-header">
                    <i class="fa fa-plus"></i> Ver Indicador
                </div>

                <div class="card-body">
                    @include('admin.indicadores.components.form-view')
                </div>
                                
        </div>
    </div>

@endsection