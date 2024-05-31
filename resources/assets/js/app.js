/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
 
import Vue from 'vue';
import VeeValidate from 'vee-validate';
import VeeValidateLaravel from 'vee-validate-laravel';

Vue.use(VeeValidate);
Vue.use(VeeValidateLaravel);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('stockdetails', require('./components/Stockdetails.vue'));
Vue.component('serialadd', require('./components/Serialadd.vue'));
const app = new Vue({
    el: '#app',
    data: {
    	host:'',
    	division_id: '',
     	district_id:'',
      districts:[],
      thanas:[],
      thana_id:'',
      region_id:'',
      areas:[],
      area_id:'',
      isDistributor:'',
      cvb1:'',
      cvb2:'',
      cvb3:'',
      cvb4:''
    },
    methods: {        
    	getDistricts:function(e){
            this.districts=[];
            var divisionId;
            if(e.target){
            	divisionId= e.target.value;
            }else{
            	divisionId=e;
            }
			return new Promise((resolve, reject) =>{
				axios.post(this.host+'get-district',{division_id:divisionId})
		    	.then(response => {
		      		// JSON responses are automatically parsed.
		      		this.districts = response.data
		      		resolve(response.data);
		    	})
		    	.catch(error => {
		      		alert('Error')
		      		reject(error.response.data);
		    	})    		 
		    });
    	},
    	 getThanas:function(e){
    	 	this.thanas=[];
    	 	var districtId;
    	 	if(e.target){
    	 		districtId= e.target.value;
    	 	} else{
    	 		districtId=e;
    	 	}      
			return new Promise((resolve, reject) =>{
				axios.post(this.host+'get-thanas',{district_id:districtId})
		    	.then(response => {
		      		// JSON responses are automatically parsed.
		      		this.thanas = response.data
		      		resolve(response.data);
		    	})
		    	.catch(error => {
		      		alert('Error')
		      		reject(error.response.data);
		    	})    		 
		    });
    	},
    	getAreas:function(e){
    		this.areas=[]; 
    		var regionId;
    		if(e.target){
    			regionId= e.target.value;
    		}else{
    			regionId=e;
    		}         
			return new Promise((resolve, reject) =>{
				axios.post(this.host+'get-areas',{region_id:regionId})
		    	.then(response => {
		      		// JSON responses are automatically parsed.
		      		this.areas = response.data
		      		resolve(response.data);
		    	})
		    	.catch(error => {
		      		alert('Error')
		      		reject(error.response.data);
		    	})    		 
		    });
    	}
    }, 
     mounted: function () {
     	this.host = laravelObj.appHost+'/';  
      	this.division_id=laravelObj.division_id||'';
      	this.districts=laravelObj.districts || null;
      	if(this.division_id){
      		this.getDistricts(this.division_id);
      	}      	
      	this.district_id=laravelObj.district_id||'';
      	this.thanas=laravelObj.thanas || null;
      	if(this.district_id){
      		this.getThanas(this.district_id);
      	}      	
      	this.thana_id=laravelObj.thana_id||'';
      	this.region_id=laravelObj.region_id||'';
      	this.areas=laravelObj.areas || null;
      	if(this.region_id){
      		this.getAreas(this.region_id);
      	}      	
      	this.area_id=laravelObj.area_id||'';
      	this.isDistributor=Boolean(Number(laravelObj.isDistributor||'0')); //this is boolean value
      	this.cvb1 = laravelObj.cvb1||'';
      	this.cvb2 = laravelObj.cvb2||'';
        this.cvb3 = laravelObj.cvb3||'';
        this.cvb4 = laravelObj.cvb4||'';
	}
});
