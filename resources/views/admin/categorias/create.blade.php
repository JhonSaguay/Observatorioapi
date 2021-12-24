@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.categoria-indicadore.actions.create'))

@section('body')

    <div class="container-xl">
        @if($errors->all())
              
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif 
        <div class="card">     
            <form class="form-horizontal form-create" action="{{route('categorias.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("post")
                <div class="card-header">
                    <i class="fa fa-plus"></i> Nueva Categoria
                </div>

                <div class="card-body">
                    @include('admin.categorias.components.form-elements')
                </div>
                                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>   
            </form>
        </div>
    </div>

@endsection
