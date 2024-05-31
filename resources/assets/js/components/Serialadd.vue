<template>
    <div>
        <form v-on:submit.prevent @keydown.enter="addSerial">
        	<label class="control-label" for="name">Serial</label>
        	<div class="input-group form-group" v-bind:class="{'has-error' : errors.has('serial')}">
                <span class="input-group-addon" id="pre-serial"></span>
                <input 
                        id="serial" 
                    	type="text" 
                    	name="serial"
                    	class="form-control"
                    	v-model="serial"/>
			</div>
			<p v-show="errors.has('serial')" class="text-danger">{{ errors.first('serial') }}</p>
            <div class="form-group">
                <button class="btn btn-success" @click="addSerial">Submit</button>
            </div>            
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {                
                serial:'',
                preSerial:''
            }
        },                  
        mounted() {
           // this.$validator.errors.clear();
           // this.$validator.errors.remove('serial');
          // $(this.$refs.vuemodal).on("hidden.bs.modal", this.modalClose)
        },
        methods: {
            addSerial() {
                const data = {
                    serial: this.serial || laravelObj.serial,
                    item_id:laravelObj.common || '' ,
                    preSerial:laravelObj.preSerial || ''                   
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
