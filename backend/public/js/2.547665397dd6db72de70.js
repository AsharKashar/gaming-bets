webpackJsonp([2],{

/***/ 1211:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1352)
/* template */
var __vue_template__ = __webpack_require__(1353)
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
Component.options.__file = "resources/js/pages/Profile/Withdrawal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-16f06e78", Component.options)
  } else {
    hotAPI.reload("data-v-16f06e78", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1217:
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(1221)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


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

/***/ 1221:
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


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

/***/ 1230:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1231)
}
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1233)
/* template */
var __vue_template__ = __webpack_require__(1234)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-74ea2a35"
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
Component.options.__file = "resources/js/components/VLink.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-74ea2a35", Component.options)
  } else {
    hotAPI.reload("data-v-74ea2a35", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1231:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1232);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1217)("0379f6fa", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-74ea2a35\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/sass-loader/dist/cjs.js!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VLink.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-74ea2a35\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/sass-loader/dist/cjs.js!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VLink.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1232:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(11)(false);
// imports


// module
exports.push([module.i, "\n.styleAvatar[data-v-74ea2a35]{position:relative;margin-left:-55px\n}\n", ""]);

// exports


/***/ }),

/***/ 1233:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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

/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    dark: {
      type: Boolean,
      default: function _default() {
        return false;
      }
    },
    href: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    avatar: {
      type: String,
      default: function _default() {
        return "";
      }
    },
    icon: {
      type: String,
      default: function _default() {
        return "";
      }
    },
    iconColor: {
      type: String,
      default: function _default() {
        return this.dark ? "#fafafa" : "#78909C"; // white or blue-grey lighten-1
      }
    },
    linkColor: {
      type: String,
      default: function _default() {
        return this.dark ? "#fafafa" : "#e3b500"; // white or blue-grey lighten-1
      }
    },
    activeColor: {
      type: String,
      default: function _default() {
        return "#f5c300"; // teal lighten 2
      }
    }
  },
  computed: {
    isActive: function isActive() {
      return this.href === this.$route.path;
    },
    isDark: function isDark() {
      return this.dark === true;
    },
    avatarOn: function avatarOn() {
      return !!this.avatar;
    },
    iconOn: function iconOn() {
      return !!this.icon;
    }
  },
  methods: {
    navigate: function navigate(href) {
      var self = this;
      /* if valid url */
      if (self.isURL(href)) {
        window.open(href);
      } else {
        /* when using vue router path */
        this.$router.push({ path: "" + href });
      }
    },
    isURL: function isURL(str) {
      var urlRegex = "^(?!mailto:)(?:(?:http|https|ftp)://)(?:\\S+(?::\\S*)?@)?(?:(?:(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}(?:\\.(?:[0-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))|(?:(?:[a-z\\u00a1-\\uffff0-9]+-?)*[a-z\\u00a1-\\uffff0-9]+)(?:\\.(?:[a-z\\u00a1-\\uffff0-9]+-?)*[a-z\\u00a1-\\uffff0-9]+)*(?:\\.(?:[a-z\\u00a1-\\uffff]{2,})))|localhost)(?::\\d{2,5})?(?:(/|\\?|#)[^\\s]*)?$";
      var url = new RegExp(urlRegex, "i");
      return str.length < 2083 && url.test(str);
    }
  }
});

/***/ }),

/***/ 1234:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-list-tile",
    {
      class: [{ styleAvatar: _vm.avatarOn }],
      attrs: { avatar: _vm.avatarOn },
      nativeOn: {
        click: function($event) {
          return _vm.navigate(_vm.href)
        }
      }
    },
    [
      _vm.iconOn && !_vm.avatarOn
        ? _c(
            "v-list-tile-action",
            [
              _c(
                "v-icon",
                {
                  style: {
                    color: _vm.isActive ? _vm.activeColor : _vm.iconColor,
                    cursor: _vm.href ? "pointer" : ""
                  }
                },
                [_vm._v(_vm._s(_vm.icon))]
              )
            ],
            1
          )
        : _vm._e(),
      _vm._v(" "),
      _vm.iconOn && _vm.avatarOn
        ? _c("v-list-tile-avatar", [
            _c("img", { attrs: { src: _vm.avatar, alt: "" } })
          ])
        : _vm._e(),
      _vm._v(" "),
      _c(
        "v-list-tile-content",
        [
          _c(
            "v-list-tile-title",
            {
              style: { color: _vm.isActive ? _vm.activeColor : _vm.linkColor }
            },
            [
              _c("span", { style: { cursor: _vm.href ? "pointer" : "" } }, [
                _vm._v(_vm._s(_vm.title))
              ])
            ]
          )
        ],
        1
      ),
      _vm._v(" "),
      _vm.iconOn && _vm.avatarOn
        ? _c(
            "v-list-tile-action",
            [
              _c(
                "v-icon",
                {
                  style: {
                    color: _vm.isActive ? _vm.activeColor : _vm.iconColor,
                    cursor: _vm.href ? "pointer" : ""
                  }
                },
                [_vm._v(_vm._s(_vm.icon))]
              )
            ],
            1
          )
        : _vm._e()
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
    require("vue-hot-reload-api")      .rerender("data-v-74ea2a35", module.exports)
  }
}

/***/ }),

/***/ 1235:
/***/ (function(module, exports, __webpack_require__) {

module.exports = { "default": __webpack_require__(1237), __esModule: true };

/***/ }),

/***/ 1236:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony default export */ __webpack_exports__["a"] = ({
  methods: {
    isLoggedIn: function isLoggedIn() {
      return !!this.$store.state.auth.isAuthenticated;
    },
    hasRole: function hasRole(payload) {
      var me = this.$store.getters['auth/getMe'];
      return _.includes(me.roles, payload);
    },
    hasPermission: function hasPermission(payload) {
      var me = this.$store.getters['auth/getMe'];
      return _.includes(me.permissions, payload);
    },
    hasAnyPermission: function hasAnyPermission(permissions) {
      var me = this.$store.getters['auth/getMe'];
      return permissions.some(function (p) {
        return me.permissions.includes(p);
      });
    },
    hasAnyRole: function hasAnyRole(roles) {
      var me = this.$store.getters['auth/getMe'];
      return roles.some(function (r) {
        return me.roles.includes(r);
      });
    },
    hasAllRoles: function hasAllRoles(roles) {
      var me = this.$store.getters['auth/getMe'];
      return _.difference(roles, me.roles).length === 0;
    },
    hasAllPermissions: function hasAllPermissions(permissions) {
      var me = this.$store.getters['auth/getMe'];
      return _.difference(permissions, me.permissions).length === 0;
    },
    can: function can(permission) {
      return this.$store.getters['auth/getMe'].can[permission];
    }
  }
});

/***/ }),

/***/ 1237:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1238);
module.exports = __webpack_require__(68).Object.keys;


/***/ }),

/***/ 1238:
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.14 Object.keys(O)
var toObject = __webpack_require__(642);
var $keys = __webpack_require__(641);

__webpack_require__(1239)('keys', function () {
  return function keys(it) {
    return $keys(toObject(it));
  };
});


/***/ }),

/***/ 1239:
/***/ (function(module, exports, __webpack_require__) {

// most Object methods by ES6 should accept primitives
var $export = __webpack_require__(106);
var core = __webpack_require__(68);
var fails = __webpack_require__(398);
module.exports = function (KEY, exec) {
  var fn = (core.Object || {})[KEY] || Object[KEY];
  var exp = {};
  exp[KEY] = exec(fn);
  $export($export.S + $export.F * fails(function () { fn(1); }), 'Object', exp);
};


/***/ }),

/***/ 1240:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1241)
/* template */
var __vue_template__ = __webpack_require__(1252)
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
Component.options.__file = "resources/js/layouts/BangerLayout.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-41936d53", Component.options)
  } else {
    hotAPI.reload("data-v-41936d53", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1241:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_Partials_Footer__ = __webpack_require__(1242);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_Partials_Footer___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_Partials_Footer__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_Partials_Navbar__ = __webpack_require__(1244);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_Partials_Navbar___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_Partials_Navbar__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_Components_modal_Login__ = __webpack_require__(1249);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_Components_modal_Login___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_Components_modal_Login__);
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





/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    Footer: __WEBPACK_IMPORTED_MODULE_0_Partials_Footer___default.a,
    Navbar: __WEBPACK_IMPORTED_MODULE_1_Partials_Navbar___default.a,
    Login: __WEBPACK_IMPORTED_MODULE_2_Components_modal_Login___default.a
  }
});

/***/ }),

/***/ 1242:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = null
/* template */
var __vue_template__ = __webpack_require__(1243)
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
Component.options.__file = "resources/js/partials/Footer.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-37fc134a", Component.options)
  } else {
    hotAPI.reload("data-v-37fc134a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1243:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("section", { staticStyle: { "background-color": "#010432" } }, [
      _c(
        "section",
        {
          staticStyle: {
            "border-bottom": "3px solid #bf1338",
            "border-top": "3px solid #bf1338"
          }
        },
        [
          _c("div", { staticClass: "container" }, [
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-lg-3 col-sm-3" }, [
                _c("div", { staticStyle: { width: "100%", height: "80px" } }, [
                  _c("img", {
                    staticStyle: {
                      display: "inline-block",
                      height: "100%",
                      width: "60%",
                      "margin-top": "0px",
                      "border-radius": "4px",
                      "background-repeat": "no-repeat",
                      "background-position": "center",
                      "background-size": "cover"
                    },
                    attrs: {
                      src: "assets/images/Sponsors/Origins-Logo-WHITE.png",
                      alt: ""
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-3 col-sm-3" }, [
                _c("div", { staticStyle: { width: "100%", height: "80px" } }, [
                  _c("img", {
                    staticStyle: {
                      display: "inline-block",
                      height: "100%",
                      width: "60%",
                      "margin-top": "0px",
                      "border-radius": "4px",
                      "background-repeat": "no-repeat",
                      "background-position": "center",
                      "background-size": "cover"
                    },
                    attrs: {
                      src: "assets/images/Sponsors/rent4wearlogoWHITE.png",
                      alt: ""
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-3 col-sm-3" }, [
                _c("div", { staticStyle: { width: "100%", height: "80px" } }, [
                  _c("img", {
                    staticStyle: {
                      display: "inline-block",
                      height: "100%",
                      width: "60%",
                      "margin-top": "0px",
                      "border-radius": "4px",
                      "background-repeat": "no-repeat",
                      "background-position": "center",
                      "background-size": "cover"
                    },
                    attrs: {
                      src: "assets/images/Sponsors/TydloslogoWHITE.png",
                      alt: ""
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-3 col-sm-3" }, [
                _c("div", { staticStyle: { width: "100%", height: "80px" } }, [
                  _c("img", {
                    staticStyle: {
                      display: "inline-block",
                      height: "100%",
                      width: "60%",
                      "margin-top": "0px",
                      "border-radius": "4px",
                      "background-repeat": "no-repeat",
                      "background-position": "center",
                      "background-size": "cover"
                    },
                    attrs: {
                      src: "assets/images/Sponsors/bee-logo-WHITE.png",
                      alt: ""
                    }
                  })
                ])
              ])
            ])
          ])
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "copy-bg" }, [
        _c("div", { staticClass: "container" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-lg-7 col-sm-7" }, [
              _c("p", { staticClass: "footer-text1" }, [
                _vm._v("©Copy Right Banger Games, 2020 ")
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-lg-5 col-sm-5" }, [
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-lg-6 col-sm-6" }, [
                  _c("p", { staticClass: "footer-options-1" }, [
                    _vm._v("HELP ")
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "footer-options" }, [_vm._v("FAQ")]),
                  _vm._v(" "),
                  _c("p", { staticClass: "footer-options" }, [
                    _vm._v("CONTACT ")
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "footer-options" }, [
                    _vm._v("SPONSORS ")
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-lg-6 col-sm-6" }, [
                  _c("p", { staticClass: "footer-options-1" }, [
                    _vm._v("HOW IT WORKS ")
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "footer-options" }, [
                    _vm._v("PRIVACY POLICY ")
                  ]),
                  _vm._v(" "),
                  _c(
                    "p",
                    {
                      staticClass: "footer-options",
                      staticStyle: {
                        "margin-top": "-23px",
                        "line-height": "21px"
                      }
                    },
                    [_vm._v("TERMS & CONDITIONS ")]
                  ),
                  _vm._v(" "),
                  _c("p", { staticClass: "footer-options" }, [
                    _c(
                      "a",
                      {
                        staticStyle: { cursor: "pointer", color: "#a1afd3" },
                        attrs: { href: "/cash-withdrawal" }
                      },
                      [_vm._v("WITHDRWALS")]
                    )
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-lg-7 col-sm-7" }, [
                _c("p", { staticClass: "footer-text-m" }, [
                  _vm._v("©Copy Right Banger Games, 2020 ")
                ])
              ])
            ])
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-37fc134a", module.exports)
  }
}

/***/ }),

/***/ 1244:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1245)
}
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1247)
/* template */
var __vue_template__ = __webpack_require__(1248)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
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
Component.options.__file = "resources/js/partials/Navbar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-52a39182", Component.options)
  } else {
    hotAPI.reload("data-v-52a39182", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1245:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1246);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1217)("2dcbdb3e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-52a39182\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Navbar.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-52a39182\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Navbar.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1246:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(11)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 1247:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends__ = __webpack_require__(1218);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_core_js_object_keys__ = __webpack_require__(1235);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_core_js_object_keys___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_core_js_object_keys__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_Mixins_acl__ = __webpack_require__(1236);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_Components_VLink__ = __webpack_require__(1230);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_Components_VLink___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_Components_VLink__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_vuex__ = __webpack_require__(397);


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





var _createNamespacedHelp = Object(__WEBPACK_IMPORTED_MODULE_4_vuex__["b" /* createNamespacedHelpers */])('auth'),
    mapActions = _createNamespacedHelp.mapActions,
    mapState = _createNamespacedHelp.mapState;

/* harmony default export */ __webpack_exports__["default"] = ({
  mixins: [__WEBPACK_IMPORTED_MODULE_2_Mixins_acl__["a" /* default */]],
  components: {
    VLink: __WEBPACK_IMPORTED_MODULE_3_Components_VLink___default.a
  },
  data: function data() {
    return {
      games: null,
      listdisplay: false,
      temp: null
    };
  },
  mounted: function mounted() {
    var _this = this;

    axios.get('/api/getgames').then(function (response) {
      _this.temp = response.data;
      __WEBPACK_IMPORTED_MODULE_1__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_core_js_object_keys___default()(_this.temp).forEach(function (key) {
        _this.temp[key].href = '/tournaments-' + _this.temp[key].id;
      });
      _this.games = _this.temp;
      // console.log(this.games);
    });
  },


  methods: __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends___default()({
    tog: function tog() {
      this.listdisplay = !this.listdisplay;
    }
  }, mapActions({
    logout: 'logout'
  }))
});

/***/ }),

/***/ 1248:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("header", { staticClass: "header" }, [
    _c("section", { staticClass: "top-header" }, [
      _c("div", { staticClass: "container" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-lg-12" }, [
            _c("div", { staticClass: "content" }, [
              _vm._m(0),
              _vm._v(" "),
              _c("div", { staticClass: "right-content" }, [
                _c("ul", { staticClass: "right-list" }, [
                  _vm._m(1),
                  _vm._v(" "),
                  !this.isLoggedIn()
                    ? _c(
                        "li",
                        [
                          _c(
                            "b-button",
                            {
                              staticClass: "sign-in",
                              on: {
                                click: function($event) {
                                  return this.Bus.$emit("open-login")
                                }
                              }
                            },
                            [
                              _c("i", { staticClass: "fas fa-user" }),
                              _vm._v(" Sign In\n                  ")
                            ]
                          )
                        ],
                        1
                      )
                    : _c(
                        "li",
                        [
                          _c(
                            "b-button",
                            {
                              staticClass: "sign-in",
                              on: {
                                click: function($event) {
                                  return _vm.logout()
                                }
                              }
                            },
                            [
                              _c("i", { staticClass: "fas fa-user-lock" }),
                              _vm._v(" Log Out\n                  ")
                            ]
                          )
                        ],
                        1
                      )
                ])
              ])
            ])
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _c(
      "nav",
      {
        staticClass: "mobile-nav",
        staticStyle: { "margin-left": "30px" },
        attrs: { role: "navigation" }
      },
      [
        _vm._m(2),
        _vm._v(" "),
        _c(
          "ul",
          { staticClass: "mobile-ul" },
          [
            _c(
              "li",
              [
                _c(
                  "router-link",
                  {
                    staticClass: "mobile-nav-list",
                    attrs: { to: { name: "home" } }
                  },
                  [_vm._v("Home")]
                )
              ],
              1
            ),
            _vm._v(" "),
            _vm._m(3),
            _vm._v(" "),
            _vm._m(4),
            _vm._v(" "),
            _vm._m(5),
            _vm._v(" "),
            _c("li", [
              _c(
                "a",
                {
                  staticClass: "mobile-nav-list",
                  attrs: { id: "" },
                  on: {
                    click: function($event) {
                      return _vm.tog()
                    }
                  }
                },
                [_vm._v("Game")]
              )
            ]),
            _vm._v(" "),
            _vm._l(_vm.games, function(game) {
              return _c(
                "li",
                {
                  key: game.name,
                  staticStyle: { diplay: "block" },
                  attrs: { id: "game-name" }
                },
                [
                  _vm.listdisplay
                    ? _c(
                        "a",
                        {
                          staticClass: "mobile-nav-list",
                          attrs: { href: game.href }
                        },
                        [_vm._v(_vm._s(game.name))]
                      )
                    : _vm._e()
                ]
              )
            }),
            _vm._v(" "),
            _vm._m(6),
            _vm._v(" "),
            _vm._m(7),
            _vm._v(" "),
            _c(
              "li",
              [
                _c(
                  "router-link",
                  {
                    staticClass: "mobile-nav-list",
                    attrs: { to: { name: "profile" } }
                  },
                  [_vm._v("Profile")]
                )
              ],
              1
            )
          ],
          2
        )
      ]
    ),
    _vm._v(" "),
    _c("div", { staticClass: "mainmenu-area" }, [
      _c("div", { staticClass: "container-fluid" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-lg-12 col-sm-12" }, [
            _c("div", { staticClass: "row" }, [
              _vm._m(8),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-2 col-sm-2" }, [
                _c("ul", { staticClass: "navbar-nav1" }, [
                  _c(
                    "li",
                    { staticClass: "nav-item active" },
                    [
                      _c(
                        "router-link",
                        {
                          staticClass: "nav-link",
                          attrs: { to: { name: "home" } }
                        },
                        [_vm._v("Home")]
                      ),
                      _vm._v(" "),
                      _c(
                        "router-link",
                        {
                          staticClass: "nav-link",
                          staticStyle: { "margin-top": "-20px" },
                          attrs: { to: { name: "sponsors" } }
                        },
                        [_vm._v("Sponsors")]
                      ),
                      _vm._v(" "),
                      _c(
                        "router-link",
                        {
                          staticClass: "nav-link",
                          staticStyle: { "margin-top": "-20px" },
                          attrs: { to: { name: "leaderboards" } }
                        },
                        [_vm._v("Leaderboards")]
                      ),
                      _vm._v(" "),
                      _c(
                        "router-link",
                        {
                          staticClass: "nav-link",
                          staticStyle: { "margin-top": "-20px" },
                          attrs: { to: { name: "about" } }
                        },
                        [_vm._v("About")]
                      )
                    ],
                    1
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-2 col-sm-2" }, [
                _c("ul", { staticClass: "navbar-nav1" }, [
                  _c(
                    "li",
                    { staticClass: "nav-item" },
                    [
                      _c(
                        "router-link",
                        {
                          staticClass: "nav-link ",
                          staticStyle: { cursor: "pointer" },
                          attrs: { to: { name: "game" }, id: "game" },
                          on: {
                            click: function($event) {
                              return _vm.tog()
                            }
                          }
                        },
                        [_vm._v("Game")]
                      ),
                      _vm._v(" "),
                      _c(
                        "router-link",
                        {
                          staticClass: "nav-link",
                          staticStyle: { "margin-top": "-20px" },
                          attrs: { to: { name: "bomb-coins" } }
                        },
                        [_vm._v("Bomb Coins")]
                      ),
                      _vm._v(" "),
                      _c(
                        "router-link",
                        {
                          staticClass: "nav-link",
                          staticStyle: { "margin-top": "-20px" },
                          attrs: { to: { name: "membership" } }
                        },
                        [_vm._v("Membership")]
                      ),
                      _vm._v(" "),
                      this.isLoggedIn()
                        ? _c(
                            "router-link",
                            {
                              staticClass: "nav-link",
                              staticStyle: { "margin-top": "-20px" },
                              attrs: { to: { name: "profile" } }
                            },
                            [_vm._v("Profile")]
                          )
                        : _vm._e()
                    ],
                    1
                  )
                ])
              ]),
              _vm._v(" "),
              _vm.listdisplay
                ? _c("div", { staticClass: "col-lg-2 col-sm-2" }, [
                    _c(
                      "ul",
                      {
                        staticClass: "navbar-nav1",
                        attrs: { id: "gameslist" }
                      },
                      _vm._l(_vm.games, function(game) {
                        return _c(
                          "li",
                          {
                            key: game.name,
                            staticClass: "nav-item",
                            staticStyle: { "margin-top": "8px", height: "15px" }
                          },
                          [
                            _c(
                              "a",
                              {
                                staticClass: "nav-link1",
                                attrs: { href: game.href }
                              },
                              [_vm._v(_vm._s(game.name))]
                            )
                          ]
                        )
                      }),
                      0
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm._m(9)
            ])
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "left-content" }, [
      _c("ul", { staticClass: "left-list" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c("div", { staticClass: "cart-icon tm-dropdown" }, [
        _c("a", { attrs: { href: "/awards" } }, [
          _c("img", {
            staticStyle: { "margin-bottom": "2px" },
            attrs: { src: "/assets/images/awards/cart.png", alt: "" }
          }),
          _vm._v("  Buy")
        ]),
        _vm._v("\n                      /  \n                    "),
        _c(
          "a",
          { staticClass: "link-btn", attrs: { href: "/cash-withdrawal" } },
          [
            _c("img", {
              staticStyle: { width: "20px" },
              attrs: { src: "assets/images/limas@2x.png", alt: "" }
            }),
            _vm._v(" 0 Limas")
          ]
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "a",
      { staticStyle: { width: "300px" }, attrs: { href: "#", id: "toggle" } },
      [
        _c("i", {
          staticClass: "fas fa-bars fa-lg",
          staticStyle: { color: "#bf1438" }
        }),
        _c("img", {
          staticStyle: { width: "60%", "margin-left": "10%" },
          attrs: { src: "assets/images/bangers-logo.png", alt: "" }
        })
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c("a", { staticClass: "mobile-nav-list", attrs: { href: "/cart" } }, [
        _vm._v("Sponsors")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c(
        "a",
        { staticClass: "mobile-nav-list", attrs: { href: "/leaderboards" } },
        [_vm._v("Leaderboards")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c("a", { staticClass: "mobile-nav-list", attrs: { href: "/about" } }, [
        _vm._v("About")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c("a", { staticClass: "mobile-nav-list", attrs: { href: "/awards" } }, [
        _vm._v("Bomb Coins")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c(
        "a",
        { staticClass: "mobile-nav-list", attrs: { href: "/membership" } },
        [_vm._v("Membership")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-lg-3 col-sm-3" }, [
      _c("a", { staticClass: "navbar-brand", attrs: { href: "/index" } }, [
        _c("img", { staticClass: "site-logo", attrs: { alt: "" } })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-lg-3 col-sm-3" }, [
      _c("div", { staticClass: "topbtn" })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-52a39182", module.exports)
  }
}

/***/ }),

/***/ 1249:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1250)
/* template */
var __vue_template__ = __webpack_require__(1251)
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
Component.options.__file = "resources/js/components/modal/Login.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-280c80ec", Component.options)
  } else {
    hotAPI.reload("data-v-280c80ec", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1250:
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
    mapActions = _createNamespacedHelp.mapActions,
    mapState = _createNamespacedHelp.mapState;




/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    ModalLayout: __WEBPACK_IMPORTED_MODULE_1_Layouts_ModalLayout_vue___default.a
  },
  mixins: [__WEBPACK_IMPORTED_MODULE_3_Mixins_validation_error__["a" /* default */]],
  data: function data() {
    return {
      dialog: false,
      form: new __WEBPACK_IMPORTED_MODULE_4_vform__["Form"]({
        email: "",
        password: "",
        remember: false
      }),
      password_visible: false
    };
  },
  computed: __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends___default()({
    icon: function icon() {
      return this.password_visible ? "visibility" : "visibility_off";
    }
  }, mapState({
    isAuthenticated: "isAuthenticated"
  })),
  mounted: function mounted() {
    var _this = this;

    Bus.$on("open-login", function () {
      _this.dialog = true;
    });
    Bus.$on("close-login", function () {
      _this.dialog = false;
    });
  },

  methods: __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends___default()({
    resetPassword: function resetPassword() {
      var self = this;
      self.$nextTick(function () {
        return self.$router.push({ name: "forgotpassword" });
      });
    },
    goHome: function goHome() {
      var self = this;
      self.$nextTick(function () {
        return self.$router.push({ name: "home" });
      });
    },
    goToRegister: function goToRegister() {
      var self = this;
      self.$nextTick(function () {
        return self.$router.push({ name: "register" });
      });
    },
    login: function login() {
      var self = this;
      self.$validator.validateAll();
      if (!self.errors.any()) {
        self.submit(self.form);
      }
    }
  }, mapActions({
    submit: "login"
  }))
});

/***/ }),

/***/ 1251:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-dialog",
    {
      attrs: { width: "500" },
      model: {
        value: _vm.dialog,
        callback: function($$v) {
          _vm.dialog = $$v
        },
        expression: "dialog"
      }
    },
    [
      _c(
        "v-card",
        [
          _c(
            "v-card-title",
            { staticClass: "headline error", attrs: { dark: "" } },
            [_c("span", { staticClass: "white--text" }, [_vm._v("Login")])]
          ),
          _vm._v(" "),
          _c(
            "v-card-text",
            [
              _c(
                "v-container",
                { attrs: { fluid: "" } },
                [
                  _c(
                    "form",
                    {
                      on: {
                        submit: function($event) {
                          $event.preventDefault()
                          return _vm.login()
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
                                class: {
                                  "error--text": _vm.hasErrors("email")
                                },
                                attrs: {
                                  "error-messages": _vm.errorMessages("email"),
                                  name: "email",
                                  label: "Type Your Account Email",
                                  "data-vv-name": "email",
                                  "prepend-icon": "email",
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
                                    value: "required|min:6",
                                    expression: "'required|min:6'"
                                  }
                                ],
                                staticClass: "primary--text",
                                class: {
                                  "error--text": _vm.hasErrors("password")
                                },
                                attrs: {
                                  "append-icon": _vm.icon,
                                  type: !_vm.password_visible
                                    ? "password"
                                    : "text",
                                  "error-messages": _vm.errorMessages(
                                    "password"
                                  ),
                                  name: "password",
                                  label: "Enter your password",
                                  hint: "At least 6 characters",
                                  "data-vv-name": "password",
                                  counter: "255",
                                  "prepend-icon": "fa-key"
                                },
                                on: {
                                  "click:append": function() {
                                    return (_vm.password_visible = !_vm.password_visible)
                                  }
                                },
                                model: {
                                  value: _vm.form.password,
                                  callback: function($$v) {
                                    _vm.$set(_vm.form, "password", $$v)
                                  },
                                  expression: "form.password"
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
                            "offset-xl4": "",
                            "text-xs-center": ""
                          }
                        },
                        [
                          _c(
                            "v-btn",
                            {
                              attrs: {
                                loading: _vm.form.busy,
                                disabled: _vm.errors.any(),
                                block: "",
                                type: "submit",
                                color: "primary"
                              }
                            },
                            [
                              _vm._v(
                                "\n                            Sign In\n                            "
                              ),
                              _c("v-icon", { attrs: { right: "" } }, [
                                _vm._v(
                                  "\n                                fa-sign-in\n                            "
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
                  ),
                  _vm._v(" "),
                  _c(
                    "v-layout",
                    { attrs: { row: "", wrap: "" } },
                    [
                      _c(
                        "v-flex",
                        {
                          attrs: {
                            xs6: "",
                            md2: "",
                            "offset-md4": "",
                            "pa-0": ""
                          }
                        },
                        [
                          _c(
                            "v-btn",
                            {
                              attrs: {
                                dark: "",
                                block: "",
                                color: "secondary"
                              },
                              nativeOn: {
                                click: function($event) {
                                  return _vm.goToRegister()
                                }
                              }
                            },
                            [
                              _vm._v(
                                "\n                            No Account Yet?\n                        "
                              )
                            ]
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "v-flex",
                        { attrs: { xs6: "", md2: "", "pa-0": "" } },
                        [
                          _c(
                            "v-btn",
                            {
                              attrs: { dark: "", block: "", color: "error" },
                              nativeOn: {
                                click: function($event) {
                                  return _vm.resetPassword()
                                }
                              }
                            },
                            [
                              _vm._v(
                                "\n                            Forgot Password?\n                        "
                              )
                            ]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
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
    require("vue-hot-reload-api")      .rerender("data-v-280c80ec", module.exports)
  }
}

/***/ }),

/***/ 1252:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("v-app", {}, [
    _c(
      "main",
      [
        _c("notifications", {
          attrs: { group: "error", position: "top center", duration: 15000 }
        }),
        _vm._v(" "),
        _c("login"),
        _vm._v(" "),
        _c("navbar"),
        _vm._v(" "),
        _c(
          "v-container",
          {
            attrs: {
              transition: "slide-x-transition",
              fluid: "",
              "pa-0": "",
              "ma-0": ""
            }
          },
          [_vm._t("default")],
          2
        )
      ],
      1
    ),
    _vm._v(" "),
    _c("footer")
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-41936d53", module.exports)
  }
}

/***/ }),

/***/ 1253:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1254)
}
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1256)
/* template */
var __vue_template__ = __webpack_require__(1257)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-5fd334b7"
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
Component.options.__file = "resources/js/partials/ProfileHeader.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5fd334b7", Component.options)
  } else {
    hotAPI.reload("data-v-5fd334b7", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1254:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1255);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1217)("33e0d69f", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5fd334b7\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProfileHeader.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5fd334b7\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProfileHeader.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1255:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(11)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 1256:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'ProfileHeader'
});

/***/ }),

/***/ 1257:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "b-container",
    { staticClass: "profile-page" },
    [
      _c(
        "b-row",
        [
          _c(
            "b-col",
            { attrs: { cols: "3" } },
            [
              _c("b-avatar", {
                attrs: { src: "https://placekitten.com/300/300", size: "6rem" }
              }),
              _vm._v(" "),
              _c("p", [
                _c("span", { staticClass: "username" }, [_vm._v("Username")])
              ])
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-col",
            { attrs: { cols: "6" } },
            [
              _c(
                "b-nav",
                { staticClass: "w-25", attrs: { vertical: "" } },
                [
                  _c(
                    "b-nav-item",
                    [
                      _c(
                        "router-link",
                        { attrs: { to: { name: "profile" } } },
                        [_vm._v("Profile")]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-nav-item",
                    [
                      _c(
                        "router-link",
                        { attrs: { to: { name: "profile-payment" } } },
                        [_vm._v("Payment")]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-nav-item",
                    [
                      _c(
                        "router-link",
                        { attrs: { to: { name: "profile-tournament" } } },
                        [_vm._v("Tournament")]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-nav-item",
                    [
                      _c(
                        "router-link",
                        { attrs: { to: { name: "profile-cash" } } },
                        [_vm._v("Cash")]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-nav-item",
                    [
                      _c(
                        "router-link",
                        { attrs: { to: { name: "profile-withdrawal" } } },
                        [_vm._v("Withdrawal")]
                      )
                    ],
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
            "b-col",
            { attrs: { cols: "3" } },
            [
              _c(
                "b-list-group",
                [
                  _c(
                    "b-list-group-item",
                    {
                      staticClass:
                        "d-flex justify-content-between align-items-center"
                    },
                    [
                      _vm._v(
                        "\n                    Cras justo odio\n                    "
                      ),
                      _c(
                        "b-badge",
                        { attrs: { variant: "primary", pill: "" } },
                        [_vm._v("14")]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-list-group-item",
                    {
                      staticClass:
                        "d-flex justify-content-between align-items-center"
                    },
                    [
                      _vm._v(
                        "\n                    Dapibus ac facilisis in\n                    "
                      ),
                      _c(
                        "b-badge",
                        { attrs: { variant: "primary", pill: "" } },
                        [_vm._v("2")]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-list-group-item",
                    {
                      staticClass:
                        "d-flex justify-content-between align-items-center"
                    },
                    [
                      _vm._v(
                        "\n                    Morbi leo risus\n                    "
                      ),
                      _c(
                        "b-badge",
                        { attrs: { variant: "primary", pill: "" } },
                        [_vm._v("1")]
                      )
                    ],
                    1
                  )
                ],
                1
              )
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
    require("vue-hot-reload-api")      .rerender("data-v-5fd334b7", module.exports)
  }
}

/***/ }),

/***/ 1352:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_Layouts_BangerLayout__ = __webpack_require__(1240);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_Layouts_BangerLayout___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_Layouts_BangerLayout__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_Partials_ProfileHeader__ = __webpack_require__(1253);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_Partials_ProfileHeader___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_Partials_ProfileHeader__);
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




/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    ProfileHeader: __WEBPACK_IMPORTED_MODULE_1_Partials_ProfileHeader___default.a,
    BangerLayout: __WEBPACK_IMPORTED_MODULE_0_Layouts_BangerLayout___default.a
  },
  data: function data() {
    return {
      contentClass: { grey: true, 'lighten-4': true, 'accent--text': true }
    };
  }
});

/***/ }),

/***/ 1353:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "banger-layout",
    { class: [_vm.contentClass] },
    [
      _c("profile-header"),
      _vm._v(" "),
      _c("b-container", [_c("b-row", [_vm._v("\n      Withdrawal\n    ")])], 1)
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
    require("vue-hot-reload-api")      .rerender("data-v-16f06e78", module.exports)
  }
}

/***/ })

});