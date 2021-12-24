<div class="container bg-overlay-content pb-2 mb-md-2">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Nombre</span>
        </div>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre"  required>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Tipo Indicador</span>
        </div>
        <select class="custom-select" id=categoria name="categoria" onchange="changecategoria()" required>
            <option disabled value="">Elija una opcion</option>
            @foreach ($categorias as $item)
                <option value="{{$item->codigo}}">{{$item->nombre}}</option>
            @endforeach
        </select>
    </div>

    
    <div class="row">
        <div class="col-4">
            <div class="custom-control custom-radio">
                <input type="radio" class="tipoindicador custom-control-input" id="customCheck1" name="tipo" value='0' checked>
                <label class="custom-control-label" for="customCheck1">Api</label>
            </div>

        </div>
        <div class="col-4">
            <div class="custom-control custom-radio ">
                <input type="radio" class="tipoindicador custom-control-input" id="customCheck2" name="tipo" value='1'>
                <label class="custom-control-label" for="customCheck2">Csv</label>
            </div>
        </div>
        
    </div>
    <br>
    
    <div class="input-group mb-3 api">
        <input type="hidden" class="form-control" id="validation_api" name="validation_api" value="0" required>

        <input type="text" onkeydown="functionrestart()" class="form-control" id="api_direction" name="api_direction" placeholder="API direccion web">
        <div class="input-group-prepend">
            <button onclick="functionrequest()" class="input-group-text" type="button">Test</button>
        </div>
        
    </div>
    <div class="input-group mb-3 csv">
        {{-- <a id="plantilla" href="#" class="d-none"></a>  --}}
        <a id="plantilla" href="#" class="btn btn-info btn-rounded waves-effect text-white"><i class="fa fa-download"
            aria-hidden="true"></i>Descargar plantilla csv</a> 
    </div>
    <div class="input-group mb-3 csv">
        
        <input type="file" class="form-control" id="file_csv" name='file_csv' placeholder="Archivo csv">
        
    </div>
</div>



