webpackJsonp([10],{

/***/ 1202:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1266)
/* template */
var __vue_template__ = __webpack_require__(1267)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/pages/Auth/ForgotPassword.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-134299cc", Component.options)
  } else {
    hotAPI.reload("data-v-134299cc", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1218:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


exports.__esModule = true;

var _assign = __webpack_require__(1222);

var _assign2 = _interopRequireDefault(_assign);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = _assign2.default || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

/***/ }),

/***/ 1219:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = null
/* template */
var __vue_template__ = __webpack_require__(1220)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/layouts/ModalLayout.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-793ff7fa", Component.options)
  } else {
    hotAPI.reload("data-v-793ff7fa", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1220:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("v-app", { attrs: { standalone: "" } }, [
    _c(
      "main",
      [
        _c(
          "v-container",
          {
            staticClass: "pa-0 ma-0 white",
            attrs: { transition: "slide-x-transition", fluid: "" }
          },
          [
            _c(
              "v-card",
              { attrs: { flat: true } },
              [
                _vm._t("toolbar"),
                _vm._v(" "),
                _vm._t("default"),
                _vm._v(" "),
                _vm._t("footer")
              ],
              2
            )
          ],
          1
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-793ff7fa", module.exports)
  }
}

/***/ }),

/***/ 1222:
/***/ (function(module, exports, __webpack_require__) {

module.exports = { "default": __webpack_require__(1223), __esModule: true };

/***/ }),

/***/ 1223:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1224);
module.exports = __webpack_require__(68).Object.assign;


/***/ }),

/***/ 1224:
/***/ (function(module, exports, __webpack_require__) {

// 19.1.3.1 Object.assign(target, source)
var $export = __webpack_require__(106);

$export($export.S + $export.F, 'Object', { assign: __webpack_require__(1225) });


/***/ }),

/***/ 1225:
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 19.1.2.1 Object.assign(target, source, ...)
var DESCRIPTORS = __webpack_require__(96);
var getKeys = __webpack_require__(641);
var gOPS = __webpack_require__(1226);
var pIE = __webpack_require__(1227);
var toObject = __webpack_require__(642);
var IObject = __webpack_require__(643);
var $assign = Object.assign;

// should work with symbols and should have deterministic property order (V8 bug)
module.exports = !$assign || __webpack_require__(398)(function () {
  var A = {};
  var B = {};
  // eslint-disable-next-line no-undef
  var S = Symbol();
  var K = 'abcdefghijklmnopqrst';
  A[S] = 7;
  K.split('').forEach(function (k) { B[k] = k; });
  return $assign({}, A)[S] != 7 || Object.keys($assign({}, B)).join('') != K;
}) ? function assign(target, source) { // eslint-disable-line no-unused-vars
  var T = toObject(target);
  var aLen = arguments.length;
  var index = 1;
  var getSymbols = gOPS.f;
  var isEnum = pIE.f;
  while (aLen > index) {
    var S = IObject(arguments[index++]);
    var keys = getSymbols ? getKeys(S).concat(getSymbols(S)) : getKeys(S);
    var length = keys.length;
    var j = 0;
    var key;
    while (length > j) {
      key = keys[j++];
      if (!DESCRIPTORS || isEnum.call(S, key)) T[key] = S[key];
    }
  } return T;
} : $assign;


/***/ }),

/***/ 1226:
/***/ (function(module, exports) {

exports.f = Object.getOwnPropertySymbols;


/***/ }),

/***/ 1227:
/***/ (function(module, exports) {

exports.f = {}.propertyIsEnumerable;


/***/ }),

/***/ 1228:
/***/ (function(module, exports, __webpack_require__) {

module.exports =
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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "fb15");
/******/ })
/************************************************************************/
/******/ ({

/***/ "1eb2":
/***/ (function(module, exports, __webpack_require__) {

// This file is imported into lib/wc client bundles.

if (typeof window !== 'undefined') {
  var i
  if ((i = window.document.currentScript) && (i = i.src.match(/(.+\/)[^/]+\.js$/))) {
    __webpack_require__.p = i[1] // eslint-disable-line
  }
}


/***/ }),

/***/ "cebe":
/***/ (function(module, exports) {

module.exports = __webpack_require__(644);

/***/ }),

/***/ "fb15":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);

// EXTERNAL MODULE: ./node_modules/@vue/cli-service/lib/commands/build/setPublicPath.js
var setPublicPath = __webpack_require__("1eb2");

// EXTERNAL MODULE: external "axios"
var external_axios_ = __webpack_require__("cebe");
var external_axios_default = /*#__PURE__*/__webpack_require__.n(external_axios_);

// CONCATENATED MODULE: ./src/util.js
function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/**
 * Deep copy the given object.
 *
 * @param  {Object} obj
 * @return {Object}
 */
function deepCopy(obj) {
  if (obj === null || _typeof(obj) !== 'object') {
    return obj;
  }

  var copy = Array.isArray(obj) ? [] : {};
  Object.keys(obj).forEach(function (key) {
    copy[key] = deepCopy(obj[key]);
  });
  return copy;
}
/**
 * If the given value is not an array, wrap it in one.
 *
 * @param  {Any} value
 * @return {Array}
 */

function arrayWrap(value) {
  return Array.isArray(value) ? value : [value];
}
// CONCATENATED MODULE: ./src/Errors.js
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; var ownKeys = Object.keys(source); if (typeof Object.getOwnPropertySymbols === 'function') { ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) { return Object.getOwnPropertyDescriptor(source, sym).enumerable; })); } ownKeys.forEach(function (key) { _defineProperty(target, key, source[key]); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function Errors_typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { Errors_typeof = function _typeof(obj) { return typeof obj; }; } else { Errors_typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return Errors_typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var Errors_Errors =
/*#__PURE__*/
function () {
  /**
   * Create a new error bag instance.
   */
  function Errors() {
    _classCallCheck(this, Errors);

    this.errors = {};
  }
  /**
   * Set the errors object or field error messages.
   *
   * @param {Object|String} field
   * @param {Array|String|undefined} messages
   */


  _createClass(Errors, [{
    key: "set",
    value: function set(field, messages) {
      if (Errors_typeof(field) === 'object') {
        this.errors = field;
      } else {
        this.set(_objectSpread({}, this.errors, _defineProperty({}, field, arrayWrap(messages))));
      }
    }
    /**
     * Get all the errors.
     *
     * @return {Object}
     */

  }, {
    key: "all",
    value: function all() {
      return this.errors;
    }
    /**
     * Determine if there is an error for the given field.
     *
     * @param  {String} field
     * @return {Boolean}
     */

  }, {
    key: "has",
    value: function has(field) {
      return this.errors.hasOwnProperty(field);
    }
    /**
     * Determine if there are any errors for the given fields.
     *
     * @param  {...String} fields
     * @return {Boolean}
     */

  }, {
    key: "hasAny",
    value: function hasAny() {
      var _this = this;

      for (var _len = arguments.length, fields = new Array(_len), _key = 0; _key < _len; _key++) {
        fields[_key] = arguments[_key];
      }

      return fields.some(function (field) {
        return _this.has(field);
      });
    }
    /**
     * Determine if there are any errors.
     *
     * @return {Boolean}
     */

  }, {
    key: "any",
    value: function any() {
      return Object.keys(this.errors).length > 0;
    }
    /**
     * Get the first error message for the given field.
     *
     * @param  String} field
     * @return {String|undefined}
     */

  }, {
    key: "get",
    value: function get(field) {
      if (this.has(field)) {
        return this.getAll(field)[0];
      }
    }
    /**
     * Get all the error messages for the given field.
     *
     * @param  {String} field
     * @return {Array}
     */

  }, {
    key: "getAll",
    value: function getAll(field) {
      return arrayWrap(this.errors[field] || []);
    }
    /**
     * Get the error message for the given fields.
     *
     * @param  {...String} fields
     * @return {Array}
     */

  }, {
    key: "only",
    value: function only() {
      var _this2 = this;

      var messages = [];

      for (var _len2 = arguments.length, fields = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        fields[_key2] = arguments[_key2];
      }

      fields.forEach(function (field) {
        var message = _this2.get(field);

        if (message) {
          messages.push(message);
        }
      });
      return messages;
    }
    /**
     * Get all the errors in a flat array.
     *
     * @return {Array}
     */

  }, {
    key: "flatten",
    value: function flatten() {
      return Object.values(this.errors).reduce(function (a, b) {
        return a.concat(b);
      }, []);
    }
    /**
     * Clear one or all error fields.
     *
     * @param {String|undefined} field
     */

  }, {
    key: "clear",
    value: function clear(field) {
      var _this3 = this;

      var errors = {};

      if (field) {
        Object.keys(this.errors).forEach(function (key) {
          if (key !== field) {
            errors[key] = _this3.errors[key];
          }
        });
      }

      this.set(errors);
    }
  }]);

  return Errors;
}();


// CONCATENATED MODULE: ./src/Form.js
function Form_typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { Form_typeof = function _typeof(obj) { return typeof obj; }; } else { Form_typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return Form_typeof(obj); }

function Form_objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; var ownKeys = Object.keys(source); if (typeof Object.getOwnPropertySymbols === 'function') { ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) { return Object.getOwnPropertyDescriptor(source, sym).enumerable; })); } ownKeys.forEach(function (key) { Form_defineProperty(target, key, source[key]); }); } return target; }

function Form_defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function Form_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function Form_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function Form_createClass(Constructor, protoProps, staticProps) { if (protoProps) Form_defineProperties(Constructor.prototype, protoProps); if (staticProps) Form_defineProperties(Constructor, staticProps); return Constructor; }





var Form_Form =
/*#__PURE__*/
function () {
  /**
   * Create a new form instance.
   *
   * @param {Object} data
   */
  function Form() {
    var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    Form_classCallCheck(this, Form);

    this.busy = false;
    this.successful = false;
    this.errors = new Errors_Errors();
    this.originalData = deepCopy(data);
    Object.assign(this, data);
  }
  /**
   * Fill form data.
   *
   * @param {Object} data
   */


  Form_createClass(Form, [{
    key: "fill",
    value: function fill(data) {
      var _this = this;

      this.keys().forEach(function (key) {
        _this[key] = data[key];
      });
    }
    /**
     * Get the form data.
     *
     * @return {Object}
     */

  }, {
    key: "data",
    value: function data() {
      var _this2 = this;

      return this.keys().reduce(function (data, key) {
        return Form_objectSpread({}, data, Form_defineProperty({}, key, _this2[key]));
      }, {});
    }
    /**
     * Get the form data keys.
     *
     * @return {Array}
     */

  }, {
    key: "keys",
    value: function keys() {
      return Object.keys(this).filter(function (key) {
        return !Form.ignore.includes(key);
      });
    }
    /**
     * Start processing the form.
     */

  }, {
    key: "startProcessing",
    value: function startProcessing() {
      this.errors.clear();
      this.busy = true;
      this.successful = false;
    }
    /**
     * Finish processing the form.
     */

  }, {
    key: "finishProcessing",
    value: function finishProcessing() {
      this.busy = false;
      this.successful = true;
    }
    /**
     * Clear the form errors.
     */

  }, {
    key: "clear",
    value: function clear() {
      this.errors.clear();
      this.successful = false;
    }
    /**
     * Reset the form fields.
     */

  }, {
    key: "reset",
    value: function reset() {
      var _this3 = this;

      Object.keys(this).filter(function (key) {
        return !Form.ignore.includes(key);
      }).forEach(function (key) {
        _this3[key] = deepCopy(_this3.originalData[key]);
      });
    }
    /**
     * Submit the form via a GET request.
     *
     * @param  {String} url
     * @param  {Object} config (axios config)
     * @return {Promise}
     */

  }, {
    key: "get",
    value: function get(url) {
      var config = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return this.submit('get', url, config);
    }
    /**
     * Submit the form via a POST request.
     *
     * @param  {String} url
     * @param  {Object} config (axios config)
     * @return {Promise}
     */

  }, {
    key: "post",
    value: function post(url) {
      var config = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return this.submit('post', url, config);
    }
    /**
     * Submit the form via a PATCH request.
     *
     * @param  {String} url
     * @param  {Object} config (axios config)
     * @return {Promise}
     */

  }, {
    key: "patch",
    value: function patch(url) {
      var config = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return this.submit('patch', url, config);
    }
    /**
     * Submit the form via a PUT request.
     *
     * @param  {String} url
     * @param  {Object} config (axios config)
     * @return {Promise}
     */

  }, {
    key: "put",
    value: function put(url) {
      var config = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return this.submit('put', url, config);
    }
    /**
     * Submit the form via a DELETE request.
     *
     * @param  {String} url
     * @param  {Object} config (axios config)
     * @return {Promise}
     */

  }, {
    key: "delete",
    value: function _delete(url) {
      var config = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return this.submit('delete', url, config);
    }
    /**
     * Submit the form data via an HTTP request.
     *
     * @param  {String} method (get, post, patch, put)
     * @param  {String} url
     * @param  {Object} config (axios config)
     * @return {Promise}
     */

  }, {
    key: "submit",
    value: function submit(method, url) {
      var _this4 = this;

      var config = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
      this.startProcessing();
      var data = method === 'get' ? {
        params: this.data()
      } : this.data();
      return new Promise(function (resolve, reject) {
        (Form.axios || external_axios_default.a).request(Form_objectSpread({
          url: _this4.route(url),
          method: method,
          data: data
        }, config)).then(function (response) {
          _this4.finishProcessing();

          resolve(response);
        }).catch(function (error) {
          _this4.busy = false;

          if (error.response) {
            _this4.errors.set(_this4.extractErrors(error.response));
          }

          reject(error);
        });
      });
    }
    /**
     * Extract the errors from the response object.
     *
     * @param  {Object} response
     * @return {Object}
     */

  }, {
    key: "extractErrors",
    value: function extractErrors(response) {
      if (!response.data || Form_typeof(response.data) !== 'object') {
        return {
          error: Form.errorMessage
        };
      }

      if (response.data.errors) {
        return Form_objectSpread({}, response.data.errors);
      }

      if (response.data.message) {
        return {
          error: response.data.message
        };
      }

      return Form_objectSpread({}, response.data);
    }
    /**
     * Get a named route.
     *
     * @param  {String} name
     * @return {Object} parameters
     * @return {String}
     */

  }, {
    key: "route",
    value: function route(name) {
      var parameters = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var url = name;

      if (Form.routes.hasOwnProperty(name)) {
        url = decodeURI(Form.routes[name]);
      }

      if (Form_typeof(parameters) !== 'object') {
        parameters = {
          id: parameters
        };
      }

      Object.keys(parameters).forEach(function (key) {
        url = url.replace("{".concat(key, "}"), parameters[key]);
      });
      return url;
    }
    /**
     * Clear errors on keydown.
     *
     * @param {KeyboardEvent} event
     */

  }, {
    key: "onKeydown",
    value: function onKeydown(event) {
      if (event.target.name) {
        this.errors.clear(event.target.name);
      }
    }
  }]);

  return Form;
}();

Form_Form.routes = {};
Form_Form.errorMessage = 'Something went wrong. Please try again.';
Form_Form.ignore = ['busy', 'successful', 'errors', 'originalData'];
/* harmony default export */ var src_Form = (Form_Form);
// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js?{"cacheDirectory":"node_modules//.cache//vue-loader","cacheIdentifier":"d2817be2-vue-loader-template"}!./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/cache-loader/dist/cjs.js??ref--0-0!./node_modules/vue-loader/lib??vue-loader-options!./src/components/HasError.vue?vue&type=template&id=fcc9e406&
var render = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return (_vm.form.errors.has(_vm.field))?_c('div',{staticClass:"help-block invalid-feedback",domProps:{"innerHTML":_vm._s(_vm.form.errors.get(_vm.field))}}):_vm._e()}
var staticRenderFns = []


// CONCATENATED MODULE: ./src/components/HasError.vue?vue&type=template&id=fcc9e406&

// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js??ref--12-0!./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./src/components/HasError.vue?vue&type=script&lang=js&
//
//
//
//
/* harmony default export */ var HasErrorvue_type_script_lang_js_ = ({
  name: 'has-error',
  props: {
    form: {
      type: Object,
      required: true
    },
    field: {
      type: String,
      required: true
    }
  }
});
// CONCATENATED MODULE: ./src/components/HasError.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_HasErrorvue_type_script_lang_js_ = (HasErrorvue_type_script_lang_js_); 
// CONCATENATED MODULE: ./node_modules/vue-loader/lib/runtime/componentNormalizer.js
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}

// CONCATENATED MODULE: ./src/components/HasError.vue





/* normalize component */

var component = normalizeComponent(
  components_HasErrorvue_type_script_lang_js_,
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

component.options.__file = "HasError.vue"
/* harmony default export */ var HasError = (component.exports);
// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js?{"cacheDirectory":"node_modules//.cache//vue-loader","cacheIdentifier":"d2817be2-vue-loader-template"}!./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/cache-loader/dist/cjs.js??ref--0-0!./node_modules/vue-loader/lib??vue-loader-options!./src/components/AlertError.vue?vue&type=template&id=5610eddd&
var AlertErrorvue_type_template_id_5610eddd_render = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return (_vm.form.errors.any())?_c('div',{staticClass:"alert alert-danger alert-dismissible",attrs:{"role":"alert"}},[(_vm.dismissible)?_c('button',{staticClass:"close",attrs:{"type":"button","aria-label":"Close"},on:{"click":_vm.dismiss}},[_c('span',{attrs:{"aria-hidden":"true"}},[_vm._v("×")])]):_vm._e(),_vm._t("default",[(_vm.form.errors.has('error'))?_c('div',{domProps:{"innerHTML":_vm._s(_vm.form.errors.get('error'))}}):_c('div',{domProps:{"innerHTML":_vm._s(_vm.message)}})])],2):_vm._e()}
var AlertErrorvue_type_template_id_5610eddd_staticRenderFns = []


// CONCATENATED MODULE: ./src/components/AlertError.vue?vue&type=template&id=5610eddd&

// CONCATENATED MODULE: ./src/components/Alert.js
/* harmony default export */ var Alert = ({
  props: {
    form: {
      type: Object,
      required: true
    },
    dismissible: {
      type: Boolean,
      default: true
    }
  },
  methods: {
    dismiss: function dismiss() {
      if (this.dismissible) {
        this.form.clear();
      }
    }
  }
});
// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js??ref--12-0!./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./src/components/AlertError.vue?vue&type=script&lang=js&
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ var AlertErrorvue_type_script_lang_js_ = ({
  name: 'alert-error',
  extends: Alert,
  props: {
    message: {
      type: String,
      default: 'There were some problems with your input.'
    }
  }
});
// CONCATENATED MODULE: ./src/components/AlertError.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_AlertErrorvue_type_script_lang_js_ = (AlertErrorvue_type_script_lang_js_); 
// CONCATENATED MODULE: ./src/components/AlertError.vue





/* normalize component */

var AlertError_component = normalizeComponent(
  components_AlertErrorvue_type_script_lang_js_,
  AlertErrorvue_type_template_id_5610eddd_render,
  AlertErrorvue_type_template_id_5610eddd_staticRenderFns,
  false,
  null,
  null,
  null
  
)

AlertError_component.options.__file = "AlertError.vue"
/* harmony default export */ var AlertError = (AlertError_component.exports);
// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js?{"cacheDirectory":"node_modules//.cache//vue-loader","cacheIdentifier":"d2817be2-vue-loader-template"}!./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/cache-loader/dist/cjs.js??ref--0-0!./node_modules/vue-loader/lib??vue-loader-options!./src/components/AlertErrors.vue?vue&type=template&id=40d77fd7&
var AlertErrorsvue_type_template_id_40d77fd7_render = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return (_vm.form.errors.any())?_c('div',{staticClass:"alert alert-danger alert-dismissible",attrs:{"role":"alert"}},[(_vm.dismissible)?_c('button',{staticClass:"close",attrs:{"type":"button","aria-label":"Close"},on:{"click":_vm.dismiss}},[_c('span',{attrs:{"aria-hidden":"true"}},[_vm._v("×")])]):_vm._e(),(_vm.message)?_c('div',{domProps:{"innerHTML":_vm._s(_vm.message)}}):_vm._e(),_c('ul',_vm._l((_vm.form.errors.flatten()),function(error){return _c('li',{domProps:{"innerHTML":_vm._s(error)}})}))]):_vm._e()}
var AlertErrorsvue_type_template_id_40d77fd7_staticRenderFns = []


// CONCATENATED MODULE: ./src/components/AlertErrors.vue?vue&type=template&id=40d77fd7&

// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js??ref--12-0!./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./src/components/AlertErrors.vue?vue&type=script&lang=js&
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ var AlertErrorsvue_type_script_lang_js_ = ({
  name: 'alert-errors',
  extends: Alert,
  props: {
    message: {
      type: String,
      default: 'There were some problems with your input.'
    }
  }
});
// CONCATENATED MODULE: ./src/components/AlertErrors.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_AlertErrorsvue_type_script_lang_js_ = (AlertErrorsvue_type_script_lang_js_); 
// CONCATENATED MODULE: ./src/components/AlertErrors.vue





/* normalize component */

var AlertErrors_component = normalizeComponent(
  components_AlertErrorsvue_type_script_lang_js_,
  AlertErrorsvue_type_template_id_40d77fd7_render,
  AlertErrorsvue_type_template_id_40d77fd7_staticRenderFns,
  false,
  null,
  null,
  null
  
)

AlertErrors_component.options.__file = "AlertErrors.vue"
/* harmony default export */ var AlertErrors = (AlertErrors_component.exports);
// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js?{"cacheDirectory":"node_modules//.cache//vue-loader","cacheIdentifier":"d2817be2-vue-loader-template"}!./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/cache-loader/dist/cjs.js??ref--0-0!./node_modules/vue-loader/lib??vue-loader-options!./src/components/AlertSuccess.vue?vue&type=template&id=fd18e236&
var AlertSuccessvue_type_template_id_fd18e236_render = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return (_vm.form.successful)?_c('div',{staticClass:"alert alert-success alert-dismissible",attrs:{"role":"alert"}},[(_vm.dismissible)?_c('button',{staticClass:"close",attrs:{"type":"button","aria-label":"Close"},on:{"click":_vm.dismiss}},[_c('span',{attrs:{"aria-hidden":"true"}},[_vm._v("×")])]):_vm._e(),_vm._t("default",[_c('div',{domProps:{"innerHTML":_vm._s(_vm.message)}})])],2):_vm._e()}
var AlertSuccessvue_type_template_id_fd18e236_staticRenderFns = []


// CONCATENATED MODULE: ./src/components/AlertSuccess.vue?vue&type=template&id=fd18e236&

// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js??ref--12-0!./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./src/components/AlertSuccess.vue?vue&type=script&lang=js&
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ var AlertSuccessvue_type_script_lang_js_ = ({
  name: 'alert-success',
  extends: Alert,
  props: {
    message: {
      type: String,
      default: ''
    }
  }
});
// CONCATENATED MODULE: ./src/components/AlertSuccess.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_AlertSuccessvue_type_script_lang_js_ = (AlertSuccessvue_type_script_lang_js_); 
// CONCATENATED MODULE: ./src/components/AlertSuccess.vue





/* normalize component */

var AlertSuccess_component = normalizeComponent(
  components_AlertSuccessvue_type_script_lang_js_,
  AlertSuccessvue_type_template_id_fd18e236_render,
  AlertSuccessvue_type_template_id_fd18e236_staticRenderFns,
  false,
  null,
  null,
  null
  
)

AlertSuccess_component.options.__file = "AlertSuccess.vue"
/* harmony default export */ var AlertSuccess = (AlertSuccess_component.exports);
// CONCATENATED MODULE: ./src/index.js







// CONCATENATED MODULE: ./node_modules/@vue/cli-service/lib/commands/build/entry-lib.js
/* concated harmony reexport Form */__webpack_require__.d(__webpack_exports__, "Form", function() { return src_Form; });
/* concated harmony reexport Errors */__webpack_require__.d(__webpack_exports__, "Errors", function() { return Errors_Errors; });
/* concated harmony reexport HasError */__webpack_require__.d(__webpack_exports__, "HasError", function() { return HasError; });
/* concated harmony reexport AlertError */__webpack_require__.d(__webpack_exports__, "AlertError", function() { return AlertError; });
/* concated harmony reexport AlertErrors */__webpack_require__.d(__webpack_exports__, "AlertErrors", function() { return AlertErrors; });
/* concated harmony reexport AlertSuccess */__webpack_require__.d(__webpack_exports__, "AlertSuccess", function() { return AlertSuccess; });


/* harmony default export */ var entry_lib = __webpack_exports__["default"] = (src_Form);



/***/ })

/******/ });

/***/ }),

/***/ 1229:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony default export */ __webpack_exports__["a"] = ({
  /* this mixins is responsible for concatinating error messages from vform and vee-validate  */
  methods: {
    /* errorBag is relataed to veeValidate config name*/
    /* form is related to vform */
    errorMessages: function errorMessages(field) {
      return this.errors.collect(field).concat(this.form.errors.only(field));
    },
    hasErrors: function hasErrors(field) {
      var errors = this.errors.collect(field).concat(this.form.errors.only(field));
      if (errors.length > 0) {
        return true;
      }
      return false;
    }
  }
});

/***/ }),

/***/ 1266:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends__ = __webpack_require__(1218);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_Layouts_ModalLayout_vue__ = __webpack_require__(1219);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_Layouts_ModalLayout_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_Layouts_ModalLayout_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_vuex__ = __webpack_require__(397);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_Mixins_validation_error__ = __webpack_require__(1229);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_vform__ = __webpack_require__(1228);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_vform___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4_vform__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_sweetalert2__ = __webpack_require__(646);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_sweetalert2___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_sweetalert2__);

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




var _createNamespacedHelp = Object(__WEBPACK_IMPORTED_MODULE_2_vuex__["b" /* createNamespacedHelpers */])("auth"),
    mapState = _createNamespacedHelp.mapState;





/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    ModalLayout: __WEBPACK_IMPORTED_MODULE_1_Layouts_ModalLayout_vue___default.a
  },
  mixins: [__WEBPACK_IMPORTED_MODULE_3_Mixins_validation_error__["a" /* default */]],
  data: function data() {
    return {
      form: new __WEBPACK_IMPORTED_MODULE_4_vform__["Form"]({
        email: ""
      })
    };
  },
  computed: __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends___default()({}, mapState({
    isAuthenticated: "isAuthenticated"
  })),
  mounted: function mounted() {
    var self = this;
    /* Make Sure We Only Load Forgot Password Page If Not Authenticated */
    if (self.isAuthenticated) {
      /* nextick make sure our modal would'nt be visible before redirect */
      return self.$nextTick(function () {
        return self.$router.go(-1);
      });
    }
  },

  methods: {
    goHome: function goHome() {
      var self = this;
      self.$nextTick(function () {
        return self.$router.push({ name: "home" });
      });
    },
    redirectBack: function redirectBack() {
      var self = this;
      return self.$nextTick(function () {
        return self.$router.go(-1);
      });
    },
    sendEmail: function sendEmail() {
      var self = this;
      self.$validator.validateAll();
      if (!self.errors.any()) {
        self.form.busy = true;
        self.form.post(route("api.auth.forgotpassword")).then(function (response) {
          self.form.busy = false;
          var modal = __WEBPACK_IMPORTED_MODULE_5_sweetalert2___default.a.mixin({
            confirmButtonClass: "v-btn blue-grey  subheading white--text",
            buttonsStyling: false
          });
          modal.fire({
            title: "Success!",
            html: "<p class=\"title\">" + response.data.message + "</p>",
            type: "success",
            confirmButtonText: "Back"
          });
        }).catch(function (error) {
          self.form.busy = false;
          if (error.response.status === 429) {
            var modal = __WEBPACK_IMPORTED_MODULE_5_sweetalert2___default.a.mixin({
              confirmButtonClass: "v-btn blue-grey  subheading white--text",
              buttonsStyling: false
            });
            modal.fire({
              title: "Validation Error!",
              html: "<p class=\"title\">" + error.response.data.message + "</p>",
              type: "error",
              confirmButtonText: "Back"
            });
          }
        });
      }
    }
  }
});

/***/ }),

/***/ 1267:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "modal-layout",
    { staticClass: "white" },
    [
      _c(
        "v-card",
        { attrs: { flat: true } },
        [
          _c(
            "v-toolbar",
            { staticClass: "primary" },
            [
              _c(
                "v-btn",
                {
                  attrs: { flat: "", icon: "", color: "white" },
                  nativeOn: {
                    click: function($event) {
                      return _vm.redirectBack()
                    }
                  }
                },
                [_c("v-icon", [_vm._v("arrow_back")])],
                1
              ),
              _vm._v(" "),
              _c("v-spacer"),
              _vm._v(" "),
              _c(
                "v-toolbar-title",
                { staticClass: "text-xs-center white--text" },
                [_vm._v("\n        Reset Password\n      ")]
              ),
              _vm._v(" "),
              _c("v-spacer"),
              _vm._v(" "),
              _c(
                "v-toolbar-items",
                [
                  _c(
                    "v-btn",
                    {
                      attrs: { flat: "", color: "white" },
                      nativeOn: {
                        click: function($event) {
                          return _vm.goHome()
                        }
                      }
                    },
                    [_c("v-icon", [_vm._v("fa-home")])],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "v-card-text",
            { staticStyle: { "padding-top": "200px" } },
            [
              _c("v-container", { attrs: { fluid: "" } }, [
                _c(
                  "form",
                  {
                    on: {
                      submit: function($event) {
                        $event.preventDefault()
                        return _vm.sendEmail()
                      }
                    }
                  },
                  [
                    _c(
                      "v-layout",
                      { attrs: { row: "" } },
                      [
                        _c(
                          "v-flex",
                          {
                            attrs: {
                              xs12: "",
                              sm12: "",
                              md4: "",
                              "offset-md4": "",
                              lg4: "",
                              "offset-lg4": "",
                              xl4: "",
                              "offset-xl4": ""
                            }
                          },
                          [
                            _c("v-text-field", {
                              directives: [
                                {
                                  name: "validate",
                                  rawName: "v-validate",
                                  value: "required|email",
                                  expression: "'required|email'"
                                }
                              ],
                              staticClass: "primary--text",
                              class: { "error--text": _vm.hasErrors("email") },
                              attrs: {
                                "error-messages": _vm.errorMessages("email"),
                                name: "email",
                                label: "Type Your Registered Email",
                                "prepend-icon": "email",
                                "data-vv-name": "email",
                                counter: "255"
                              },
                              model: {
                                value: _vm.form.email,
                                callback: function($$v) {
                                  _vm.$set(_vm.form, "email", $$v)
                                },
                                expression: "form.email"
                              }
                            })
                          ],
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "v-flex",
                      {
                        attrs: {
                          xs12: "",
                          sm12: "",
                          md4: "",
                          "offset-md4": "",
                          lg4: "",
                          "offset-lg4": "",
                          xl4: "",
                          "offset-xl4": ""
                        }
                      },
                      [
                        _c(
                          "v-btn",
                          {
                            class: {
                              primary: !_vm.form.busy,
                              error: _vm.form.busy
                            },
                            attrs: {
                              loading: _vm.form.busy,
                              disabled: _vm.errors.any(),
                              type: "submit",
                              block: ""
                            }
                          },
                          [
                            _vm._v(
                              "\n              Send Password Reset Email\n            "
                            )
                          ]
                        )
                      ],
                      1
                    )
                  ],
                  1
                )
              ])
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-134299cc", module.exports)
  }
}

/***/ })

});