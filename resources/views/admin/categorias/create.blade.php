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
@section('bottom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
{{-- <script>
    $(document).ready(function(){
        getcategoria();
    });
</script> --}}
<script>
    function getcategoria(){
        let valor = document.getElementById("eje").value;
        $("#categoria").empty();
        $("#categoria").append("<option value=''>Elija una opcion</option>");
        if (valor){
            
            $.get('{{route('api.categoria')}}', 
                function(returnedData){
                    $.each(returnedData,function(key, registro) {
                        $("#categoria").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
                    });  
            });
        }
        
    }
</script>
@endsection
