<template>
    <div>       
        <div class="row">
            <div class="col-md-8 text-right mb-sm">
                <span v-if="inputs.length">Total Items type: {{inputs.length}} and Total Items: {{stock}}                	
                </span>
            </div>
        </div>

        <ul id="stock-add">
          <li v-for="(input, index) in inputs" class="mb-sm">
             <input v-if="input.id" class="hidden" :name="'details['+index+'][id]'" :value="input.id"></input>
            <div class="row"> 
                <div class="col-md-2">
                     <select class="form-control" :name="'details['+index+'][brand_id]'" v-model="input.brand_id">
                        <option v-if="input.brand_id==null" value="null">Select Brand</option>
                        <option v-else value="">Select Brand</option>
                        <option v-for="(val,key) in brands" v-bind:value="key">
                            {{ val }}
                        </option>
                     </select>

                </div>
                <div class="col-md-2">
                     <select class="form-control" :name="'details['+index+'][size_id]'" v-model="input.size_id" required="required">
                        <option value="">Select Size</option>
                        <option v-for="(val,key) in sizes" v-bind:value="val">
                            DF-{{ key }}
                        </option>
                     </select>                    
                </div>
                 <div class="col-md-2">
                    <input class="col-md-2 form-control" type="number" placeholder="Input Quantity" :name="'details['+index+'][qty]'" v-model="input.qty" @change="countTotal" min="0" required="required">
                </div>
                 <div class="col-md-2">
                    <input class="col-md-2 form-control" type="number" placeholder="Unit Price" :name="'details['+index+'][unit_price]'" v-model="input.unit_price" min="0">
                    
                </div>
                <div class="col-md-2">        
                    <button v-if="index" class="btn btn-danger" @click="deleteRow(index,$event);">Delete</button>
                </div>
            </div>
          </li>
        </ul>
        <div class="row">
            <div class="col-md-offset-8 col-md-2">
                 <button class="btn btn-success" @click="addRow">Add More</button>
            </div>           
        </div>        
    </div>
</template>

<script>
    export default {
         data() {
            return {
                inputs:[{
                    brand_id: '',
                    size_id: '',
                    qty: '',
                    unit_price: '' 
                }],
                stock:0
            }
        },           
        mounted() {  
            if(this.details.length){
                this.inputs=this.details;
                this.countTotal();
            }
        },
         props: {
           brands: Object,
           sizes: Object,
           details: Array
        },
        methods: {
            addRow(event) {
              event.preventDefault();
              this.inputs.push({
                    brand_id: '',
                    size_id: '',
                    qty: '',
                    unit_price: '' 
                });
               //$(".select2").select2({allowClear: true});
            },
            countTotal(){
                let add=0;
               this.inputs.forEach(function (value, key) {                   
                    if (!isNaN(parseFloat(value.qty)) && isFinite(value.qty)) {
                        add += parseInt(value.qty);
                    }                    
               });
               this.stock=add;
            },
            deleteRow(index,event) {
                event.preventDefault();
                this.inputs.splice(index,1);
                this.countTotal();
            }
        }
}
</script>
<style>
    #stock-add{
        list-style: none;
    }    
</style>
