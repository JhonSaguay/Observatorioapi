<div class="container bg-overlay-content pb-2 mb-md-2">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Nombre</span>
        </div>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{old('nombre')}}" required>
    </div>
    {{-- <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Codigo</span>
        </div>
        <input type="text" class="form-control" name="codigo" placeholder="Codigo" value="{{old('codigo')}}" required>
    </div> --}}
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Eje *</span>
      </div>
      <select class="custom-select" id=eje name="eje_id" onchange="getcategoria()" required>
      {{-- <select class="custom-select" id=eje name="eje_id" required>     --}}
        <option disabled value="">Elija una opcion</option>
          @foreach ($ejes as $item)
              <option value="{{$item->id}}">{{$item->nombre}}</option>
          @endforeach
      </select>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Categoría *</span>
      </div>
      <select class="custom-select" id=categoria name="categoria_id"  required>
          <option value="">Elija una opcion</option>
          {{-- @foreach ($categorias as $item)
              <option value="{{$item->id}}">{{$item->nombre}}</option>
          @endforeach --}}
      </select>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">Archivo</span>
        
        <input accept="csv" type="file" class="form-control" name='file_csv'>
        
    </div>
</div>



