import AppForm from '../app-components/Form/AppForm';

Vue.component('indicadore-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nombre:  '' ,
                categoria:  '' ,
                tipo:  false ,
                direccion_api:  '' ,
                nombre_archivo:  '' ,
                datos_indicador:  this.getLocalizedFormDefaults() ,
                
            }
        }
    }

});