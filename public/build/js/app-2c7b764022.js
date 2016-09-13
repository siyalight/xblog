/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("/**\n * @author lufficc\n */\n\n(function ($) {\n    var LufficcBlog = {\n        init: function () {\n            var self = this;\n            $(document).pjax('a:not(a[target=\"_blank\"])', '#lufficc-blog-container', {\n                timeout: 2000,\n                maxCacheLength: 500,\n            });\n            $(document).on('pjax:start', function () {\n                NProgress.start();\n            });\n            $(document).on('pjax:end', function () {\n                NProgress.done();\n                self.bootUp();\n            });\n            $(document).on('pjax:complete', function () {\n                NProgress.done();\n            });\n            self.bootUp();\n        },\n        bootUp: function () {\n            NProgress.configure({showSpinner: false});\n            initMarkdownTarget();\n            initFooterPosition();\n            $(window).resize(initFooterPosition);\n        },\n    };\n\n    function initFooterPosition() {\n        $(\"#footer\").removeClass(\"fixed-bottom\");\n        var contentHeight = document.body.scrollHeight,//网页正文全文高度\n            winHeight = window.innerHeight;//可视窗口高度，不包括浏览器顶部工具栏\n        if (!(contentHeight > winHeight)) {\n            //当网页正文高度小于可视窗口高度时，为footer添加类fixed-bottom\n            $(\"footer\").addClass(\"fixed-bottom\");\n        } else {\n            $(\"footer\").removeClass(\"fixed-bottom\");\n        }\n    }\n\n    function initMarkdownTarget() {\n        $('.markdown-target').each(function (i, element) {\n            element.innerHTML =\n                marked($(element).data(\"markdown\"), {\n                    renderer: new marked.Renderer(),\n                    gfm: true,\n                    tables: true,\n                    breaks: false,\n                    pedantic: false,\n                    smartLists: true,\n                    smartypants: false,\n                    highlight: function (code) {\n                        return hljs.highlightAuto(code).value;\n                    }\n                });\n        });\n    }\n\n    window.LufficcBlog = LufficcBlog;\n})(jQuery);\n$(document).ready(function () {\n    LufficcBlog.init();\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcz84YjY3Il0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogQGF1dGhvciBsdWZmaWNjXG4gKi9cblxuKGZ1bmN0aW9uICgkKSB7XG4gICAgdmFyIEx1ZmZpY2NCbG9nID0ge1xuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB2YXIgc2VsZiA9IHRoaXM7XG4gICAgICAgICAgICAkKGRvY3VtZW50KS5wamF4KCdhOm5vdChhW3RhcmdldD1cIl9ibGFua1wiXSknLCAnI2x1ZmZpY2MtYmxvZy1jb250YWluZXInLCB7XG4gICAgICAgICAgICAgICAgdGltZW91dDogMjAwMCxcbiAgICAgICAgICAgICAgICBtYXhDYWNoZUxlbmd0aDogNTAwLFxuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAkKGRvY3VtZW50KS5vbigncGpheDpzdGFydCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBOUHJvZ3Jlc3Muc3RhcnQoKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJChkb2N1bWVudCkub24oJ3BqYXg6ZW5kJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIE5Qcm9ncmVzcy5kb25lKCk7XG4gICAgICAgICAgICAgICAgc2VsZi5ib290VXAoKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJChkb2N1bWVudCkub24oJ3BqYXg6Y29tcGxldGUnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgTlByb2dyZXNzLmRvbmUoKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgc2VsZi5ib290VXAoKTtcbiAgICAgICAgfSxcbiAgICAgICAgYm9vdFVwOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBOUHJvZ3Jlc3MuY29uZmlndXJlKHtzaG93U3Bpbm5lcjogZmFsc2V9KTtcbiAgICAgICAgICAgIGluaXRNYXJrZG93blRhcmdldCgpO1xuICAgICAgICAgICAgaW5pdEZvb3RlclBvc2l0aW9uKCk7XG4gICAgICAgICAgICAkKHdpbmRvdykucmVzaXplKGluaXRGb290ZXJQb3NpdGlvbik7XG4gICAgICAgIH0sXG4gICAgfTtcblxuICAgIGZ1bmN0aW9uIGluaXRGb290ZXJQb3NpdGlvbigpIHtcbiAgICAgICAgJChcIiNmb290ZXJcIikucmVtb3ZlQ2xhc3MoXCJmaXhlZC1ib3R0b21cIik7XG4gICAgICAgIHZhciBjb250ZW50SGVpZ2h0ID0gZG9jdW1lbnQuYm9keS5zY3JvbGxIZWlnaHQsLy/nvZHpobXmraPmloflhajmlofpq5jluqZcbiAgICAgICAgICAgIHdpbkhlaWdodCA9IHdpbmRvdy5pbm5lckhlaWdodDsvL+WPr+inhueql+WPo+mrmOW6pu+8jOS4jeWMheaLrOa1j+iniOWZqOmhtumDqOW3peWFt+agj1xuICAgICAgICBpZiAoIShjb250ZW50SGVpZ2h0ID4gd2luSGVpZ2h0KSkge1xuICAgICAgICAgICAgLy/lvZPnvZHpobXmraPmlofpq5jluqblsI/kuo7lj6/op4bnqpflj6Ppq5jluqbml7bvvIzkuLpmb290ZXLmt7vliqDnsbtmaXhlZC1ib3R0b21cbiAgICAgICAgICAgICQoXCJmb290ZXJcIikuYWRkQ2xhc3MoXCJmaXhlZC1ib3R0b21cIik7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKFwiZm9vdGVyXCIpLnJlbW92ZUNsYXNzKFwiZml4ZWQtYm90dG9tXCIpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgZnVuY3Rpb24gaW5pdE1hcmtkb3duVGFyZ2V0KCkge1xuICAgICAgICAkKCcubWFya2Rvd24tdGFyZ2V0JykuZWFjaChmdW5jdGlvbiAoaSwgZWxlbWVudCkge1xuICAgICAgICAgICAgZWxlbWVudC5pbm5lckhUTUwgPVxuICAgICAgICAgICAgICAgIG1hcmtlZCgkKGVsZW1lbnQpLmRhdGEoXCJtYXJrZG93blwiKSwge1xuICAgICAgICAgICAgICAgICAgICByZW5kZXJlcjogbmV3IG1hcmtlZC5SZW5kZXJlcigpLFxuICAgICAgICAgICAgICAgICAgICBnZm06IHRydWUsXG4gICAgICAgICAgICAgICAgICAgIHRhYmxlczogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgICAgYnJlYWtzOiBmYWxzZSxcbiAgICAgICAgICAgICAgICAgICAgcGVkYW50aWM6IGZhbHNlLFxuICAgICAgICAgICAgICAgICAgICBzbWFydExpc3RzOiB0cnVlLFxuICAgICAgICAgICAgICAgICAgICBzbWFydHlwYW50czogZmFsc2UsXG4gICAgICAgICAgICAgICAgICAgIGhpZ2hsaWdodDogZnVuY3Rpb24gKGNvZGUpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBobGpzLmhpZ2hsaWdodEF1dG8oY29kZSkudmFsdWU7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgd2luZG93Lkx1ZmZpY2NCbG9nID0gTHVmZmljY0Jsb2c7XG59KShqUXVlcnkpO1xuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICAgIEx1ZmZpY2NCbG9nLmluaXQoKTtcbn0pO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvYXBwLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTs7OztBQUlBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);