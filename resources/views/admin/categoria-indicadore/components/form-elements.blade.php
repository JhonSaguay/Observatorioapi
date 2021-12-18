<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nombre'), 'has-success': this.fields.nombre && this.fields.nombre.valid }">
    <label for="nombre" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.categoria-indicadore.columns.nombre') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nombre" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nombre'), 'form-control-success': this.fields.nombre && this.fields.nombre.valid}" id="nombre" name="nombre" placeholder="{{ trans('admin.categoria-indicadore.columns.nombre') }}">
        <div v-if="errors.has('nombre')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nombre') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('codigo'), 'has-success': this.fields.codigo && this.fields.codigo.valid }">
    <label for="codigo" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.categoria-indicadore.columns.codigo') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.codigo" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('codigo'), 'form-control-success': this.fields.codigo && this.fields.codigo.valid}" id="codigo" name="codigo" placeholder="{{ trans('admin.categoria-indicadore.columns.codigo') }}">
        <div v-if="errors.has('codigo')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('codigo') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('archivo_muestra'), 'has-success': this.fields.archivo_muestra && this.fields.archivo_muestra.valid }">
    <label for="archivo_muestra" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.categoria-indicadore.columns.archivo_muestra') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.archivo_muestra" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('archivo_muestra'), 'form-control-success': this.fields.archivo_muestra && this.fields.archivo_muestra.valid}" id="archivo_muestra" name="archivo_muestra" placeholder="{{ trans('admin.categoria-indicadore.columns.archivo_muestra') }}">
        <div v-if="errors.has('archivo_muestra')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('archivo_muestra') }}</div>
    </div>
</div>


