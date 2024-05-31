import Errors from './Errors'; 

class Form{

	constructor(data){

		this.originalData = data;

		for(let field in data){

			this[field] = data[field];

		}

		this.errors =  new Errors();

	}

	data(){

		let data = {};

		for(let property in this.originalData){

			data[property] = this[property];
		}
		/*
		//object cloning

		let data = Object.assign({}, this);

		delete data.originalData;
		delete data.errors;
		*/
		return data;
	}

	reset(){

		for(let field in this.originalData){

			this[field] = '';
		}

		this.errors.clear();
	}

	post(url){

		return this.submit('post', url);
	}

	get(url){

		return this.submit('get', url);
	}

	put(url){

		return this.submit('put', url);
	}

	patch(url){

		return this.submit('patch', url);
	}

	delete(url){

		return this.submit('delete', url);
	}

	submit(requestType, url){

		return new Promise((resolve, reject) =>{

			axios[requestType](url, this.data())
				.then(response => {

					this.onSuccess(response.data);

					resolve(response.data);

				})
				.catch( error =>{

					//console.log(error.response)
					this.onFail(error.response.data);

					reject(error.response.data);
				})



		});
			

	}

	onSuccess(response){

		this.reset();
	}

	onFail(error){

		this.errors.record(error);
	}
}

export default Form;