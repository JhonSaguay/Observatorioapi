<div class="container bg-overlay-content pb-2 mb-md-2">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">ID</span>
        </div>
        <span class="form-control">{{$indicadore->id}}</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Nombre</span>
        </div>
        <span class="form-control">{{$indicadore->nombre}}</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Tipo Indicador</span>
        </div>
        <span class="form-control">{{$indicadore->categorias->nombre}}</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Api Consulta</span>
        </div>
        <span class="form-control">{{route('api.avaluo.data-list',$indicadore->categoria)}}</span>
    </div>

    
    
    <div class="input-group mb-3 csv">
        {{-- <a id="plantilla" href="#" class="d-none"></a>  --}}
        <a id="plantilla" href="{{route('categoria.download',$indicadore->categoria)}}" class="btn btn-info btn-rounded waves-effect text-white"><i class="fa fa-download"
            aria-hidden="true"></i>Descargar plantilla csv</a> 
    </div>

    
</div>

