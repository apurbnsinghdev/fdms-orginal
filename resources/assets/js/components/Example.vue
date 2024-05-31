<template>
    <div>
        <form v-on:submit.prevent>
        <div class="form-group" v-bind:class="{'has-error' : errors.has('name')}">
            <label for="name">Name</label>
            <input 
                type="text" 
                name="name"
                class="form-control"
                v-model="name"
                v-validate="'required|min:3'" />
            <div v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</div>
        </div>
        <button @click="doValidation">Submit</button>
        </form>
        
    </div>
</template>

<script>
    export default {
        data() {
            return {                
                name:''
            }
        },           
        mounted() {  
            //name:this.name
        },
        methods: {
            doValidation() {
                const data = {
                    name: this.name
                }; 

                console.log(data);

                return new Promise((resolve, reject) =>{
                    axios.post(this.$root.host+'example',data)
                    .then(response => {
                        // JSON responses are automatically parsed.
                       console.log(response.data);
                        resolve(response.data);
                    })
                    .catch(error => {
                        this.$setLaravelValidationErrorsFromResponse(error.response.data);
                        reject(error.response.data);
                    })           
                });          
               
            }
        }
    }
</script>