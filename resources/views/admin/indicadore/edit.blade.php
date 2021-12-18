@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.indicadore.actions.edit', ['name' => $indicadore->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <indicadore-form
                :action="'{{ $indicadore->resource_url }}'"
                :data="{{ $indicadore->toJsonAllLocales() }}"
                :locales="{{ json_encode($locales) }}"
                :send-empty-locales="false"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.indicadore.actions.edit', ['name' => $indicadore->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.indicadore.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </indicadore-form>

        </div>
    
</div>

@endsection