/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 45);
/******/ })
/************************************************************************/
/******/ ({

/***/ 3:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Errors__ = __webpack_require__(4);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



var Form = function () {
	function Form(data) {
		_classCallCheck(this, Form);

		this.originalData = data;

		for (var field in data) {

			this[field] = data[field];
		}

		this.errors = new __WEBPACK_IMPORTED_MODULE_0__Errors__["a" /* default */]();
	}

	_createClass(Form, [{
		key: 'data',
		value: function data() {

			var data = {};

			for (var property in this.originalData) {

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
	}, {
		key: 'reset',
		value: function reset() {

			for (var field in this.originalData) {

				this[field] = '';
			}

			this.errors.clear();
		}
	}, {
		key: 'post',
		value: function post(url) {

			return this.submit('post', url);
		}
	}, {
		key: 'get',
		value: function get(url) {

			return this.submit('get', url);
		}
	}, {
		key: 'put',
		value: function put(url) {

			return this.submit('put', url);
		}
	}, {
		key: 'patch',
		value: function patch(url) {

			return this.submit('patch', url);
		}
	}, {
		key: 'delete',
		value: function _delete(url) {

			return this.submit('delete', url);
		}
	}, {
		key: 'submit',
		value: function submit(requestType, url) {
			var _this = this;

			return new Promise(function (resolve, reject) {

				axios[requestType](url, _this.data()).then(function (response) {

					_this.onSuccess(response.data);

					resolve(response.data);
				}).catch(function (error) {

					//console.log(error.response.data)
					_this.onFail(error.response.data);

					reject(error.response.data);
				});
			});
		}
	}, {
		key: 'onSuccess',
		value: function onSuccess(response) {

			this.reset();
		}
	}, {
		key: 'onFail',
		value: function onFail(error) {

			this.errors.record(error);
		}
	}]);

	return Form;
}();

/* harmony default export */ __webpack_exports__["default"] = (Form);

/***/ }),

/***/ 4:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Errors = function () {
	function Errors() {
		_classCallCheck(this, Errors);

		this.errors = {};
	}

	_createClass(Errors, [{
		key: "get",
		value: function get(field) {

			if (this.errors[field]) {
				return this.errors[field][0];
			}
		}
	}, {
		key: "has",
		value: function has(field) {

			return this.errors.hasOwnProperty(field);
		}
	}, {
		key: "any",
		value: function any() {

			return Object.keys(this.errors).length > 0;
		}
	}, {
		key: "record",
		value: function record(errors) {
			this.errors = errors;
		}
	}, {
		key: "clear",
		value: function clear(field) {

			if (field) {

				delete this.errors[field];

				return;
			}

			this.errors = {};
		}
	}]);

	return Errors;
}();

/* harmony default export */ __webpack_exports__["a"] = (Errors);

/***/ }),

/***/ 45:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(3);


/***/ })

/******/ });