@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Create'))

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
                    <button id="btn-save" type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Exportar
                    </button>
                </div>
                
            </form>
        </div>
    </div>

@endsection
@section('bottom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>

  <script>
    var CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $('.tipoindicador').change(function(){
            if($(this).is(':checked')){
                if ($(this).val() == 0){
                    $('.api').show();
                    $('.csv').hide();
                    $('#file_csv').val('');
                    $('#file_csv').prop('required',false);
                    $('#api_direction').prop('required',true);
                    $('#btn-save').prop('disabled',true);
                }
                else{
                    $('.csv').show();
                    $('.api').hide();
                    $('#file_csv').prop('required',true);
                    $('#api_direction').val('');
                    $('#api_direction').prop('required',false);
                    $('#btn-save').prop('disabled',false);
                }
            }
        });
        $('.csv').hide();
        $('#btn-save').prop('disabled',true);
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
    function functionrestart(){
        $('#btn-save').prop('disabled',true);
        $('#validation_api').val("0");
    }
    function functionrequest(){
        let valor = document.getElementById("api_direction").value;
        var message;
        var tipo;
        if (valor){
            $.ajax({url: valor, 
                success: function(result){
                    message='Todo parece estar bien';
                    tipo='success';
                    $('#validation_api').val("1");
                    $('#btn-save').prop('disabled',false);
                    bootstrapAlert(message,tipo);
                },
                error: function(){
                    message='Esta api no ha podido ser validada';
                    tipo='danger';
                    $('#validation_api').val("0");
                    $('#btn-save').prop('disabled',true);
                    bootstrapAlert(message,tipo);
                }
            });
        }
        else{
            message="Necesita agregar una direccion web";
            tipo="warning";
            bootstrapAlert(message,tipo);
        }
    }
    function bootstrapAlert(message,tipo){
        $(".bootstrap-growl").remove();
        $.bootstrapGrowl(message,{
            type:tipo,
            offset:{from:"top",amount:250},
            align: "rigth",
            delay:3000,
            allow_dismiss: true,
            stackup_spacing:10
        });
    }

  </script>

    
@endsection