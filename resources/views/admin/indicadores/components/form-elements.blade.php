<div class="container bg-overlay-content pb-2 mb-md-2">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Nombre *</span>
        </div>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre"  required>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Descripción</span>
        </div>
        <input type="text" class="form-control" name="descripcion" placeholder="Descripción" >
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Temporalidad</span>
        </div>
        <input type="text" class="form-control" name="temporalidad" placeholder="Temporalidad" >
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Proveedor del Dato</span>
        </div>
        <input type="text" class="form-control" name="proveedor_dato" placeholder="Proveedor del Dato" >
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Link Fuente</span>
        </div>
        <input type="url" class="form-control" name="direccion_api" placeholder="Fuente" >
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Tipo Indicador *</span>
        </div>
        <select class="custom-select" id=categoria name="categoria" onchange="changecategoria()" required>
            <option disabled value="">Elija una opcion</option>
            @foreach ($categorias as $item)
                <option value="{{$item->codigo}}">{{$item->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Nivel Apertura *</span>
        </div>
        <select class="custom-select" id=nivel_apertura name="nivel_apertura" required>
            <option disabled selected value="">Elija una opcion</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="3">4</option>
            <option value="3">5</option>
        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Tipo Gráfica *</span>
        </div>
        <select class="custom-select" id=tipo_grafica name="tipo_grafica" required>
            <option disabled selected value="">Elija una opcion</option>
            <option value="apilada">Apilada</option>
            <option value="columna">Columna</option>
            <option value="pastel">Pastel</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Variable 1 *</span>
        </div>
        <select class="custom-select" id=variable_1 name="variable_1" required>
            <option disabled selected value="">Elija una opcion</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Variable 2 *</span>
        </div>
        <select class="custom-select" id=variable_2 name="variable_2" required>
            <option disabled selected value="">Elija una opcion</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Variable 3</span>
        </div>
        <select class="custom-select" id=variable_3 name="variable_3">
            <option disabled selected value="">Elija una opcion</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Variable medida *</span>
        </div>
        <select class="custom-select" id=variable_medida name="variable_medida" required>
            <option disabled selected value="">Elija una opcion</option>
            <option value="suma">Sumatoria</option>
            <option value="conteo">Conteo</option>
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



