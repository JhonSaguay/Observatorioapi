import AppForm from '../app-components/Form/AppForm';

Vue.component('categoria-indicadore-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nombre:  '' ,
                codigo:  '' ,
                archivo_muestra:  '' ,
                file:'',
                
            }
        }
    }

});