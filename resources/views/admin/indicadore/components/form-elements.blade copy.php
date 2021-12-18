<div class="row form-inline" style="padding-bottom: 10px;" v-cloak>
    <div :class="{'col-xl-10 col-md-11 text-right': !isFormLocalized, 'col text-center': isFormLocalized, 'hidden': onSmallScreen }">
        <small>{{ trans('brackets/admin-ui::admin.forms.currently_editing_translation') }}<span v-if="!isFormLocalized && otherLocales.length > 1"> {{ trans('brackets/admin-ui::admin.forms.more_can_be_managed') }}</span><span v-if="!isFormLocalized"> | <a href="#" @click.prevent="showLocalization">{{ trans('brackets/admin-ui::admin.forms.manage_translations') }}</a></span></small>
        <i class="localization-error" v-if="!isFormLocalized && showLocalizedValidationError"></i>
    </div>

    <div class="col text-center" :class="{'language-mobile': onSmallScreen, 'has-error': !isFormLocalized && showLocalizedValidationError}" v-if="isFormLocalized || onSmallScreen" v-cloak>
        <small>{{ trans('brackets/admin-ui::admin.forms.choose_translation_to_edit') }}
            <select class="form-control" v-model="currentLocale">
                <option :value="defaultLocale" v-if="onSmallScreen">@{{defaultLocale.toUpperCase()}}</option>
                <option v-for="locale in otherLocales" :value="locale">@{{locale.toUpperCase()}}</option>
            </select>
            <i class="localization-error" v-if="isFormLocalized && showLocalizedValidationError"></i>
            <span>|</span>
            <a href="#" @click.prevent="hideLocalization">Hide Translations</a>
        </small>
    </div>
</div>

<div class="row">
    @foreach($locales as $locale)
        <div class="col-md" v-show="shouldShowLangGroup('{{ $locale }}')" v-cloak>
            <div class="form-group row align-items-center" :class="{'has-danger': errors.has('datos_indicador_{{ $locale }}'), 'has-success': this.fields.datos_indicador_{{ $locale }} && this.fields.datos_indicador_{{ $locale }}.valid }">
                <label for="datos_indicador_{{ $locale }}" class="col-md-2 col-form-label text-md-right">{{ trans('admin.indicadore.columns.datos_indicador') }}</label>
                <div class="col-md-9" :class="{'col-xl-8': !isFormLocalized }">
                    <input type="text" v-model="form.datos_indicador.{{ $locale }}" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('datos_indicador_{{ $locale }}'), 'form-control-success': this.fields.datos_indicador_{{ $locale }} && this.fields.datos_indicador_{{ $locale }}.valid }" id="datos_indicador_{{ $locale }}" name="datos_indicador_{{ $locale }}" placeholder="{{ trans('admin.indicadore.columns.datos_indicador') }}">
                    <div v-if="errors.has('datos_indicador_{{ $locale }}')" class="form-control-feedback form-text" v-cloak>{{'{{'}} errors.first('datos_indicador_{{ $locale }}') }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nombre'), 'has-success': this.fields.nombre && this.fields.nombre.valid }">
    <label for="nombre" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.indicadore.columns.nombre') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nombre" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nombre'), 'form-control-success': this.fields.nombre && this.fields.nombre.valid}" id="nombre" name="nombre" placeholder="{{ trans('admin.indicadore.columns.nombre') }}">
        <div v-if="errors.has('nombre')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nombre') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('categoria'), 'has-success': this.fields.categoria && this.fields.categoria.valid }">
    <label for="categoria" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.indicadore.columns.categoria') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.categoria" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('categoria'), 'form-control-success': this.fields.categoria && this.fields.categoria.valid}" id="categoria" name="categoria" placeholder="{{ trans('admin.indicadore.columns.categoria') }}">
        <div v-if="errors.has('categoria')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('categoria') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('tipo'), 'has-success': this.fields.tipo && this.fields.tipo.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="tipo" type="checkbox" v-model="form.tipo" v-validate="''" data-vv-name="tipo"  name="tipo_fake_element">
        <label class="form-check-label" for="tipo">
            {{ trans('admin.indicadore.columns.tipo') }}
        </label>
        <input type="hidden" name="tipo" :value="form.tipo">
        <div v-if="errors.has('tipo')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tipo') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('direccion_api'), 'has-success': this.fields.direccion_api && this.fields.direccion_api.valid }">
    <label for="direccion_api" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.indicadore.columns.direccion_api') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.direccion_api" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('direccion_api'), 'form-control-success': this.fields.direccion_api && this.fields.direccion_api.valid}" id="direccion_api" name="direccion_api" placeholder="{{ trans('admin.indicadore.columns.direccion_api') }}">
        <div v-if="errors.has('direccion_api')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('direccion_api') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nombre_archivo'), 'has-success': this.fields.nombre_archivo && this.fields.nombre_archivo.valid }">
    <label for="nombre_archivo" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.indicadore.columns.nombre_archivo') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nombre_archivo" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nombre_archivo'), 'form-control-success': this.fields.nombre_archivo && this.fields.nombre_archivo.valid}" id="nombre_archivo" name="nombre_archivo" placeholder="{{ trans('admin.indicadore.columns.nombre_archivo') }}">
        <div v-if="errors.has('nombre_archivo')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nombre_archivo') }}</div>
    </div>
</div>


