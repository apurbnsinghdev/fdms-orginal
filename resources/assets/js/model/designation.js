
new Vue({
    el: '#app',

    data: {
        form: new Form({
            title: '',
            sequence: '',
            status: ''
        }),
        statuses:{}
    },
    
    methods: {
        onSubmit() {
            this.form.post('/designations')
                .then(response => { 
                	//console.log(response);
                	this.statuses = response;
                 } )
                .catch(error=>{
                	
                });
                
        }
    }

    /*
    computed:{

    	response: function(){

    		return Object.keys(this.status).length > 0
    		//this.errors.hasOwnProperty('message');    		
    	}    	

    }
    */
    
});