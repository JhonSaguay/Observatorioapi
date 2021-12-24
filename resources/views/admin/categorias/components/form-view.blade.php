<div class="container bg-overlay-content pb-2 mb-md-2">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Nombre</span>
        </div>
        <input type="hidden" class="form-control" name="nombre" placeholder="Nombre" value="{{$categoriaIndicadore->nombre}}">
        <span class="form-control">{{$categoriaIndicadore->nombre}}</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Codigo</span>
        </div>
        <input type="hidden" class="form-control" name="codigo" placeholder="Codigo" value="{{$categoriaIndicadore->codigo}}">
        <span class="form-control">{{$categoriaIndicadore->codigo}}</span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">Archivo</span>
        
        <input accept="csv" type="file" class="form-control" name='file_csv'>
        
    </div>
    <div class="input-group mb-3 csv">
        {{-- <a id="plantilla" href="#" class="d-none"></a>  --}}
        <a id="plantilla" href="{{route('categoria.download',$categoriaIndicadore->codigo)}}" class="btn btn-info btn-rounded waves-effect text-white"><i class="fa fa-download"
            aria-hidden="true"></i>Descargar plantilla csv</a> 
    </div>

    <button type="submit" class="btn btn-primary" :disabled="submiting">
        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-edit'"></i>
        Editar
    </button>

    <div class="card-footer">
        <h3>Seguimiento</h3>
        <div class="card">
            @if ($categoriaIndicadore->follows)
                @foreach ($categoriaIndicadore->follows as $item)
                    <div class="card-header">
                        {{$item->action}} - {{$item->id}}
                    </div>
                
                    <div class="card-body">
                        <p class="card-text">Nombre: {{$item->indicador->nombre}}
                        </p>
                        <p class="card-text">
                            Fecha de actualizacion: {{$item->created_at}}
                        </p>
                    </div>
                    
                @endforeach
            @endif
                
        </div>
    </div>




    
    