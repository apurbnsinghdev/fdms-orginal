<template>
    <div>
        <input type="text" v-model="n_requisition">
    </div>
</template>

<script>
    export default {
        data() {
            return {                
                n_requisition:'',
            }
        },                  
        mounted() {
           // this.$validator.errors.clear();
           // this.$validator.errors.remove('serial');
          // $(this.$refs.vuemodal).on("hidden.bs.modal", this.modalClose)
        },
        methods: {
            getRequisition() {
                const data = {
                    n_requisition: this.n_requisition,
                    item_id:laravelObj.common|''                    
                }; 
                
                axios.post(this.$root.host+'items/input-item-serial',data)
                .then(response => {
                    window.location = this.$root.host+'items';
                })
                .catch(error => {
                    this.$setLaravelValidationErrorsFromResponse(error.response.data);
                })  
            }

        }
    }
</script>
