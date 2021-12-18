@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.indicadore.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">
        
        <indicadore-form
            :action="'{{route('indicadores.store')}}'"
            :locales="{{ json_encode($locales) }}"
            :send-empty-locales="false"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" action="{{route('indicadores.store')}}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method("post")
                <div class="card-header">
                    <i class="fa fa-plus"></i> Nuevo Indicador
                </div>

                <div class="card-body">
                    @include('admin.indicadore.components.form-elements')
                </div>
                                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
                
            </form>

        </indicadore-form>

        </div>

        </div>

    
@endsection