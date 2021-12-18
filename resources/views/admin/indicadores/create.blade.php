@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Create'))

@section('body')

    <div class="container-xl">
        <div class="card">
            <form class="form-horizontal form-create" action="{{route('indicadores.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("post")
                <div class="card-header">
                    <i class="fa fa-plus"></i> Nuevo Indicador
                </div>

                <div class="card-body">
                    @include('admin.indicadores.components.form-elements')
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

  <script>
    var CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
  
        $('.tipoindicador').change(function(){
            if($(this).is(':checked')){
                if ($(this).val() == 0){
                    $('.api').show();
                    $('.csv').hide();
                }
                else{
                    $('.csv').show();
                    $('.api').hide();
                }
            }
        });
        $('.csv').hide();
        changecategoria();
        

  
    });
    function changecategoria(){
        let valor = document.getElementById("categoria").value;
        if (valor){

            valuehtml=$('#plantilla').attr("href");
            $('#plantilla').each(function(){ 
                var oldUrl = $(this).attr("href"); // Get current url
                var valuehtml1="{{route('categoria.download','x-id')}}";
                var newUrl = valuehtml1.replace("x-id", valor); // Create new url
                $(this).attr("href", newUrl); // Set herf value
            });
        }
        
    }

  </script>
    
@endsection