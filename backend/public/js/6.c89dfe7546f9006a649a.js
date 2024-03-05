webpackJsonp([6],{

/***/ 1205:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1323)
/* template */
var __vue_template__ = __webpack_require__(1340)
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
Component.options.__file = "resources/js/pages/Home/About.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5af9f606", Component.options)
  } else {
    hotAPI.reload("data-v-5af9f606", Component.options)
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

/***/ 1323:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_Layouts_Main_vue__ = __webpack_require__(1324);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_Layouts_Main_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_Layouts_Main_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    MainLayout: __WEBPACK_IMPORTED_MODULE_0_Layouts_Main_vue___default.a
  },
  data: function data() {
    return {
      contentClass: { grey: true, "lighten-4": true, "accent--text": true },
      values: [{
        color: "primary",
        icon: "fa-eye",
        show: true,
        title: "VISION",
        tagline: App.site.trademark + " aims to be one of the most admired SEO companies around the globe. Armed with a purpose to bring real Solution To Boost SEO Ranking at the Most Efficient and Effective Way ",
        xs: 12,
        sm: 12,
        md: 4,
        lg: 4,
        xl: 4
      }, {
        color: "accent",
        icon: "fa-fa",
        show: true,
        title: "MISSION",
        tagline: App.site.trademark + " objective is to enrich the lives of our customers/users, and the community by providing them with the Best SEO Application That Is Easy To Use and Easy To Manage. ",
        xs: 12,
        sm: 12,
        md: 4,
        lg: 4,
        xl: 4
      }, {
        color: "pink",
        icon: "fa-handshake-o",
        show: true,
        title: "OUR PLEDGE",
        tagline: App.site.trademark + " we\u2019re not just committed to Providing SEO Solutions. But We also recognize our obligation To Our End User To Provide Them Greate Service, Support, Tutorials and Updates.",
        xs: 12,
        sm: 12,
        md: 4,
        lg: 4,
        xl: 4
      }]
    };
  }
});

/***/ }),

/***/ 1324:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1325)
/* template */
var __vue_template__ = __webpack_require__(1339)
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
Component.options.__file = "resources/js/layouts/Main.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-077004c6", Component.options)
  } else {
    hotAPI.reload("data-v-077004c6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1325:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__partials_AppFooter_vue__ = __webpack_require__(1326);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__partials_AppFooter_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__partials_AppFooter_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__partials_AppNavBar_vue__ = __webpack_require__(1331);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__partials_AppNavBar_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__partials_AppNavBar_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__partials_LeftSideBar_vue__ = __webpack_require__(1336);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__partials_LeftSideBar_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__partials_LeftSideBar_vue__);
//
//
//
//
//
//
//
//
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
    AppFooter: __WEBPACK_IMPORTED_MODULE_0__partials_AppFooter_vue___default.a,
    AppNavBar: __WEBPACK_IMPORTED_MODULE_1__partials_AppNavBar_vue___default.a,
    LeftSideBar: __WEBPACK_IMPORTED_MODULE_2__partials_LeftSideBar_vue___default.a
  }
});

/***/ }),

/***/ 1326:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1327)
}
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1329)
/* template */
var __vue_template__ = __webpack_require__(1330)
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
Component.options.__file = "resources/js/partials/AppFooter.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0a529086", Component.options)
  } else {
    hotAPI.reload("data-v-0a529086", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1327:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1328);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1217)("029f3da5", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0a529086\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AppFooter.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0a529086\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AppFooter.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1328:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(11)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 1329:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_Components_VLink_vue__ = __webpack_require__(1230);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_Components_VLink_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_Components_VLink_vue__);
//
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
    VLink: __WEBPACK_IMPORTED_MODULE_0_Components_VLink_vue___default.a
  },
  data: function data() {
    return {
      footerClass: { "white--text": true, red: true, "lighten-2": true },
      year: new Date().getFullYear(),
      domain: "bangergames.com",
      trademark: "mytrademark"
    };
  },
  created: function created() {
    var _this = this;

    /* Emit On a Child Component If You Want This To Be Visible */
    Bus.$on("footer-content-visible", function (visibility) {
      _this.contentVisible = visibility;
    });
  }
});

/***/ }),

/***/ 1330:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-footer",
    { class: [_vm.footerClass], attrs: { app: "" } },
    [
      _c("v-spacer"),
      _vm._v(" "),
      _c("span", [
        _vm._v("© " + _vm._s(_vm.year) + " " + _vm._s(_vm.domain) + " ®™")
      ]),
      _vm._v(" "),
      _c("v-spacer")
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
    require("vue-hot-reload-api")      .rerender("data-v-0a529086", module.exports)
  }
}

/***/ }),

/***/ 1331:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1332)
}
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1334)
/* template */
var __vue_template__ = __webpack_require__(1335)
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
Component.options.__file = "resources/js/partials/AppNavBar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-067d18dc", Component.options)
  } else {
    hotAPI.reload("data-v-067d18dc", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1332:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1333);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1217)("7314c725", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-067d18dc\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AppNavBar.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-067d18dc\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AppNavBar.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1333:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(11)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 1334:
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
  data: function data() {
    return {
      extension: false,
      showLogo: false,
      logo: "/img/logo.png",
      showIcon: false,
      title: "TITLE"
    };
  },
  created: function created() {
    var _this = this;

    /* Emit On a Child Component If You Want This To Be Visible */
    Bus.$on("header-extension-visible", function (visibility) {
      _this.extension = visibility;
    });
  },

  methods: {
    toggleDrawer: function toggleDrawer() {
      Bus.$emit("toggleDrawer");
    },
    refresh: function refresh() {
      window.location.reload();
    }
  }
});

/***/ }),

/***/ 1335:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-toolbar",
    { attrs: { color: "red lighten-2", fixed: "", app: "" } },
    [
      _c("v-toolbar-side-icon", {
        staticClass: "white--text",
        nativeOn: {
          click: function($event) {
            $event.stopPropagation()
            return _vm.toggleDrawer()
          }
        }
      }),
      _vm._v(" "),
      _vm.extension
        ? _c(
            "v-toolbar-title",
            {
              staticClass: "text-xs-center ml-0 pl-3",
              class: _vm.$vuetify.breakpoint.width <= 1264 && "pr-3",
              style: _vm.$vuetify.breakpoint.width > 1264 && "width: 300px",
              attrs: { slot: "extension" },
              slot: "extension"
            },
            [
              _vm.showIcon
                ? _c(
                    "v-icon",
                    { staticClass: "ml-3 hidden-md-and-down accent" },
                    [_vm._v(_vm._s(_vm.icon))]
                  )
                : _vm._e(),
              _vm._v(" "),
              _c("span", { staticClass: "hidden-md-and-down" }, [
                _c("span", { staticClass: "white--text" }, [
                  _vm._v(_vm._s(_vm.title))
                ])
              ])
            ],
            1
          )
        : _c(
            "v-toolbar-title",
            { staticClass: "text-xs-center" },
            [
              _vm.showIcon
                ? _c(
                    "v-icon",
                    { staticClass: "ml-3 hidden-md-and-down accent" },
                    [_vm._v(_vm._s(_vm.icon))]
                  )
                : _vm._e(),
              _vm._v(" "),
              _c("span", { staticClass: "hidden-md-and-down" }, [
                _c("span", { staticClass: "white--text" }, [
                  _vm._v(_vm._s(_vm.title))
                ])
              ])
            ],
            1
          ),
      _vm._v(" "),
      _c("v-spacer"),
      _vm._v(" "),
      _vm.showLogo
        ? _c("img", {
            staticClass: "hidden-md-and-up",
            attrs: { src: _vm.logo }
          })
        : _vm._e(),
      _vm._v(" "),
      _c("v-spacer"),
      _vm._v(" "),
      _c(
        "v-btn",
        { attrs: { dark: "", icon: "" }, on: { click: _vm.refresh } },
        [_c("v-icon", [_vm._v("refresh")])],
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
    require("vue-hot-reload-api")      .rerender("data-v-067d18dc", module.exports)
  }
}

/***/ }),

/***/ 1336:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(640)
/* script */
var __vue_script__ = __webpack_require__(1337)
/* template */
var __vue_template__ = __webpack_require__(1338)
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
Component.options.__file = "resources/js/partials/LeftSideBar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0588a9d4", Component.options)
  } else {
    hotAPI.reload("data-v-0588a9d4", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1337:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends__ = __webpack_require__(1218);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_VLink_vue__ = __webpack_require__(1230);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_VLink_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__components_VLink_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_vuex__ = __webpack_require__(397);

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    VLink: __WEBPACK_IMPORTED_MODULE_1__components_VLink_vue___default.a
  },
  data: function data() {
    return {
      drawer: false
    };
  },
  computed: __WEBPACK_IMPORTED_MODULE_0__Users_kenanduman_banger_banger_gaming_node_modules_babel_runtime_helpers_extends___default()({}, mapState({
    isAuthenticated: "isAuthenticated"
  })),
  created: function created() {
    var self = this;
    switch (self.$vuetify.breakpoint.name) {
      case "xs":
        return self.drawer = false;
      case "sm":
        return self.drawer = false;
      case "md":
        return self.drawer = true;
      case "lg":
        return self.drawer = true;
      case "xl":
        return self.drawer = true;
    }
  },
  mounted: function mounted() {
    var self = this;
    Bus.$on("toggleDrawer", function () {
      self.drawer = !self.drawer;
    });
  }
});

/***/ }),

/***/ 1338:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-navigation-drawer",
    {
      staticClass: "blue-grey",
      attrs: {
        clipped: _vm.$vuetify.breakpoint.width <= 1264 && true,
        fixed: "",
        "hide-overlay": "",
        app: ""
      },
      model: {
        value: _vm.drawer,
        callback: function($$v) {
          _vm.drawer = $$v
        },
        expression: "drawer"
      }
    },
    [
      _c(
        "v-list",
        { staticClass: "blue-grey", attrs: { dense: "" } },
        [
          _c("v-link", {
            attrs: {
              title: "Home",
              href: "/",
              icon: "fa-home",
              "link-color": "white",
              "active-color": "#4db6ac",
              "icon-color": "#fafafa"
            }
          }),
          _vm._v(" "),
          _c("v-link", {
            attrs: {
              href: "/support",
              title: "Support",
              icon: "message",
              "link-color": "white",
              "active-color": "#4db6ac",
              "icon-color": "#fafafa"
            }
          }),
          _vm._v(" "),
          _c("v-subheader", { staticClass: "white--text" }, [
            _vm._v("Members Area")
          ]),
          _vm._v(" "),
          _vm.isAuthenticated
            ? _c("v-link", {
                attrs: {
                  title: "User Management",
                  href: "/users",
                  icon: "supervisor_account",
                  "link-color": "white",
                  "active-color": "#4db6ac",
                  "icon-color": "#fafafa"
                }
              })
            : _vm._e(),
          _vm._v(" "),
          _vm.isAuthenticated
            ? _c("v-link", {
                attrs: {
                  title: "Dashboard",
                  href: "/dashboard",
                  icon: "fa-tachometer",
                  "link-color": "white",
                  "active-color": "#4db6ac",
                  "icon-color": "#fafafa"
                }
              })
            : _vm._e(),
          _vm._v(" "),
          _vm.isAuthenticated
            ? _c("v-link", {
                attrs: {
                  title: "Settings",
                  href: "/settings",
                  icon: "fa-cogs",
                  "link-color": "white",
                  "active-color": "#4db6ac",
                  "icon-color": "#fafafa"
                }
              })
            : _vm._e(),
          _vm._v(" "),
          _vm.isAuthenticated
            ? _c("v-link", {
                attrs: {
                  title: "Logout",
                  href: "/logout",
                  icon: "power_settings_new",
                  "link-color": "white",
                  "active-color": "#4db6ac",
                  "icon-color": "#fafafa"
                }
              })
            : _vm._e(),
          _vm._v(" "),
          !_vm.isAuthenticated
            ? _c("v-link", {
                attrs: {
                  title: "Login",
                  href: "/login",
                  icon: "fa-key",
                  "link-color": "white",
                  "active-color": "#4db6ac",
                  "icon-color": "#fafafa"
                }
              })
            : _vm._e(),
          _vm._v(" "),
          !_vm.isAuthenticated
            ? _c("v-link", {
                attrs: {
                  title: "Register",
                  href: "/register",
                  icon: "fa-user-plus",
                  "link-color": "white",
                  "active-color": "#4db6ac",
                  "icon-color": "#fafafa"
                }
              })
            : _vm._e()
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
    require("vue-hot-reload-api")      .rerender("data-v-0588a9d4", module.exports)
  }
}

/***/ }),

/***/ 1339:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-app",
    { attrs: { id: "inspire" } },
    [
      _c("left-side-bar"),
      _vm._v(" "),
      _c("app-nav-bar"),
      _vm._v(" "),
      _c(
        "v-content",
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
      ),
      _vm._v(" "),
      _c("app-footer")
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
    require("vue-hot-reload-api")      .rerender("data-v-077004c6", module.exports)
  }
}

/***/ }),

/***/ 1340:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "main-layout",
    { class: [_vm.contentClass] },
    [
      _c(
        "v-parallax",
        { attrs: { src: "/img/bg.jpg" } },
        [
          _c(
            "v-layout",
            { attrs: { column: "", "align-center": "", "justify-center": "" } },
            [
              _c("h1", { staticClass: "white--text" }, [
                _vm._v("ABOUT " + _vm._s("" + _vm.App.site.trademark))
              ]),
              _vm._v(" "),
              _c(
                "h2",
                { staticClass: "white--text", attrs: { "text-xs-center": "" } },
                [
                  _vm._v(
                    "A company committed in Providing Solutions To The Latest SEO Needs Of Everone Who Want To Boost Their Google Rank Search."
                  )
                ]
              )
            ]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-container",
        { attrs: { light: "", fluid: "" } },
        [
          _c(
            "v-layout",
            { attrs: { row: "", wrap: "" } },
            [
              _c(
                "v-flex",
                { attrs: { xs12: "", "text-xs-center": "" } },
                [
                  _c("v-avatar", { attrs: { size: "250px" } }, [
                    _c("img", {
                      attrs: { src: "/img/gabriel.jpg", alt: "Owner/CEO" }
                    })
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "v-layout",
            { attrs: { row: "", wrap: "", "pa-5": "" } },
            [
              _c("v-flex", { attrs: { xs12: "", "text-xs-center": "" } }, [
                _c(
                  "h1",
                  { staticClass: "primary--text", attrs: { light: "" } },
                  [_vm._v("CEO/Founder")]
                )
              ]),
              _vm._v(" "),
              _c("v-flex", { attrs: { xs12: "", "text-xs-left": "" } }, [
                _c("p", { staticClass: "headline blue-grey--text" }, [
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v(_vm._s("" + _vm.App.site.trademark))
                  ]),
                  _vm._v(" is a company founded by\n          "),
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v("Gabriel Machuret")
                  ]),
                  _vm._v(" , Runing His Own SEO Agency\n          "),
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v("(Goanna Social)")
                  ]),
                  _vm._v(".\n          "),
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v(_vm._s("" + _vm.App.site.trademark))
                  ]),
                  _vm._v(
                    " Was Develop With The Goal in Mind that is to\n          "
                  ),
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v("Provide Solutions")
                  ]),
                  _vm._v(" To The Ever Changing World Of\n          "),
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v("Google SEO Algorithm Updates")
                  ]),
                  _vm._v(
                    ".\n          While Proving To Be Efficient And Effective,\n          "
                  ),
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v(_vm._s("" + _vm.App.site.trademark))
                  ]),
                  _vm._v(" Also Make Sure Even a\n          "),
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v("Dummy User")
                  ]),
                  _vm._v(" Can Use This App To\n          "),
                  _c("strong", { staticClass: "accent--text" }, [
                    _vm._v("Boost End User SEO Ranking.")
                  ])
                ])
              ])
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "v-layout",
            { attrs: { row: "", wrap: "", "pa-5": "" } },
            [
              _c("v-flex", { attrs: { xs12: "", "text-xs-center": "" } }, [
                _c(
                  "h2",
                  { staticClass: "primary--text", attrs: { light: "" } },
                  [_vm._v("Company Core Values")]
                )
              ]),
              _vm._v(" "),
              _vm._l(_vm.values, function(card) {
                var _obj
                return _c(
                  "v-flex",
                  _vm._b(
                    { key: card.title, staticClass: "pa-2" },
                    "v-flex",
                    ((_obj = {}),
                    (_obj["xs" + card.xs] = true),
                    (_obj["sm" + card.sm] = true),
                    (_obj["md" + card.md] = true),
                    (_obj["lg" + card.lg] = true),
                    (_obj["xl" + card.xl] = true),
                    _obj),
                    false
                  ),
                  [
                    _c("v-card-text", [
                      _c(
                        "p",
                        { staticClass: "text-xs-center" },
                        [
                          card.icon
                            ? _c(
                                "v-btn",
                                { attrs: { color: card.color, icon: "" } },
                                [
                                  _c("v-icon", { attrs: { dark: "" } }, [
                                    _vm._v(_vm._s(card.icon))
                                  ])
                                ],
                                1
                              )
                            : _vm._e()
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "v-card",
                      {
                        staticStyle: { "background-color": "transparent" },
                        attrs: { flat: "" }
                      },
                      [
                        _c(
                          "v-card-actions",
                          [
                            _c("v-spacer"),
                            _vm._v(" "),
                            _c("p", {
                              staticClass: "headline primary--text",
                              domProps: { textContent: _vm._s(card.title) }
                            }),
                            _vm._v(" "),
                            _c("v-spacer"),
                            _vm._v(" "),
                            card.title
                              ? _c(
                                  "v-btn",
                                  {
                                    staticClass: "accent--text",
                                    attrs: { icon: "" },
                                    nativeOn: {
                                      click: function($event) {
                                        card.show = !card.show
                                      }
                                    }
                                  },
                                  [
                                    _c("v-icon", [
                                      _vm._v(
                                        _vm._s(
                                          card.show
                                            ? "keyboard_arrow_up"
                                            : "keyboard_arrow_down"
                                        )
                                      )
                                    ])
                                  ],
                                  1
                                )
                              : _vm._e()
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "v-slide-y-transition",
                          [
                            _c("v-card-text", {
                              directives: [
                                {
                                  name: "show",
                                  rawName: "v-show",
                                  value: card.show,
                                  expression: "card.show"
                                }
                              ],
                              staticClass: "blue-grey--text title",
                              domProps: { textContent: _vm._s(card.tagline) }
                            })
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ],
                  1
                )
              })
            ],
            2
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
    require("vue-hot-reload-api")      .rerender("data-v-5af9f606", module.exports)
  }
}

/***/ })

});