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

eval("/**\n * @author lufficc\n */\n\n(function ($) {\n    var LufficcBlog = {\n        init: function () {\n            var self = this;\n            $(document).pjax('a:not(a[target=\"_blank\"])', '#lufficc-blog-container', {\n                timeout: 2000,\n                maxCacheLength: 500,\n            });\n            $(document).on('pjax:start', function () {\n                console.log('pjax:start')\n                NProgress.start();\n            });\n            $(document).on('pjax:end', function () {\n                console.log('pjax:end')\n                NProgress.done();\n                self.bootUp();\n            });\n            $(document).on('pjax:complete', function () {\n                console.log('pjax:complete')\n                NProgress.done();\n            });\n            console.log('LufficcBlog:init')\n            self.bootUp();\n        },\n        bootUp: function () {\n            NProgress.configure({ trickle: false });\n            initMarkdownTarget();\n            initFooterPosition();\n            $(window).resize(initFooterPosition);\n        },\n    };\n\n    function initFooterPosition() {\n        $(\"#footer\").removeClass(\"fixed-bottom\");\n        var contentHeight = document.body.scrollHeight,//网页正文全文高度\n            winHeight = window.innerHeight;//可视窗口高度，不包括浏览器顶部工具栏\n        if (!(contentHeight > winHeight)) {\n            //当网页正文高度小于可视窗口高度时，为footer添加类fixed-bottom\n            $(\"footer\").addClass(\"fixed-bottom\");\n        } else {\n            $(\"footer\").removeClass(\"fixed-bottom\");\n        }\n    }\n\n    function initMarkdownTarget() {\n        var markdownTarget = document.getElementById('markdown-target');\n        if (markdownTarget) {\n            markdownTarget.innerHTML =\n                marked($('#markdown-content').data(\"markdown\"), {\n                    renderer: new marked.Renderer(),\n                    gfm: true,\n                    tables: true,\n                    breaks: false,\n                    pedantic: false,\n                    smartLists: true,\n                    smartypants: false,\n                    highlight: function (code) {\n                        return hljs.highlightAuto(code).value;\n                    }\n                });\n        }\n    }\n\n    window.LufficcBlog = LufficcBlog;\n})(jQuery);\n$(document).ready(function () {\n    console.log('document:ready');\n    LufficcBlog.init();\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcz84YjY3Il0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogQGF1dGhvciBsdWZmaWNjXG4gKi9cblxuKGZ1bmN0aW9uICgkKSB7XG4gICAgdmFyIEx1ZmZpY2NCbG9nID0ge1xuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB2YXIgc2VsZiA9IHRoaXM7XG4gICAgICAgICAgICAkKGRvY3VtZW50KS5wamF4KCdhOm5vdChhW3RhcmdldD1cIl9ibGFua1wiXSknLCAnI2x1ZmZpY2MtYmxvZy1jb250YWluZXInLCB7XG4gICAgICAgICAgICAgICAgdGltZW91dDogMjAwMCxcbiAgICAgICAgICAgICAgICBtYXhDYWNoZUxlbmd0aDogNTAwLFxuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAkKGRvY3VtZW50KS5vbigncGpheDpzdGFydCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygncGpheDpzdGFydCcpXG4gICAgICAgICAgICAgICAgTlByb2dyZXNzLnN0YXJ0KCk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICQoZG9jdW1lbnQpLm9uKCdwamF4OmVuZCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygncGpheDplbmQnKVxuICAgICAgICAgICAgICAgIE5Qcm9ncmVzcy5kb25lKCk7XG4gICAgICAgICAgICAgICAgc2VsZi5ib290VXAoKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJChkb2N1bWVudCkub24oJ3BqYXg6Y29tcGxldGUnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ3BqYXg6Y29tcGxldGUnKVxuICAgICAgICAgICAgICAgIE5Qcm9ncmVzcy5kb25lKCk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKCdMdWZmaWNjQmxvZzppbml0JylcbiAgICAgICAgICAgIHNlbGYuYm9vdFVwKCk7XG4gICAgICAgIH0sXG4gICAgICAgIGJvb3RVcDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgTlByb2dyZXNzLmNvbmZpZ3VyZSh7IHRyaWNrbGU6IGZhbHNlIH0pO1xuICAgICAgICAgICAgaW5pdE1hcmtkb3duVGFyZ2V0KCk7XG4gICAgICAgICAgICBpbml0Rm9vdGVyUG9zaXRpb24oKTtcbiAgICAgICAgICAgICQod2luZG93KS5yZXNpemUoaW5pdEZvb3RlclBvc2l0aW9uKTtcbiAgICAgICAgfSxcbiAgICB9O1xuXG4gICAgZnVuY3Rpb24gaW5pdEZvb3RlclBvc2l0aW9uKCkge1xuICAgICAgICAkKFwiI2Zvb3RlclwiKS5yZW1vdmVDbGFzcyhcImZpeGVkLWJvdHRvbVwiKTtcbiAgICAgICAgdmFyIGNvbnRlbnRIZWlnaHQgPSBkb2N1bWVudC5ib2R5LnNjcm9sbEhlaWdodCwvL+e9kemhteato+aWh+WFqOaWh+mrmOW6plxuICAgICAgICAgICAgd2luSGVpZ2h0ID0gd2luZG93LmlubmVySGVpZ2h0Oy8v5Y+v6KeG56qX5Y+j6auY5bqm77yM5LiN5YyF5ous5rWP6KeI5Zmo6aG26YOo5bel5YW35qCPXG4gICAgICAgIGlmICghKGNvbnRlbnRIZWlnaHQgPiB3aW5IZWlnaHQpKSB7XG4gICAgICAgICAgICAvL+W9k+e9kemhteato+aWh+mrmOW6puWwj+S6juWPr+inhueql+WPo+mrmOW6puaXtu+8jOS4umZvb3Rlcua3u+WKoOexu2ZpeGVkLWJvdHRvbVxuICAgICAgICAgICAgJChcImZvb3RlclwiKS5hZGRDbGFzcyhcImZpeGVkLWJvdHRvbVwiKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICQoXCJmb290ZXJcIikucmVtb3ZlQ2xhc3MoXCJmaXhlZC1ib3R0b21cIik7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBmdW5jdGlvbiBpbml0TWFya2Rvd25UYXJnZXQoKSB7XG4gICAgICAgIHZhciBtYXJrZG93blRhcmdldCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtYXJrZG93bi10YXJnZXQnKTtcbiAgICAgICAgaWYgKG1hcmtkb3duVGFyZ2V0KSB7XG4gICAgICAgICAgICBtYXJrZG93blRhcmdldC5pbm5lckhUTUwgPVxuICAgICAgICAgICAgICAgIG1hcmtlZCgkKCcjbWFya2Rvd24tY29udGVudCcpLmRhdGEoXCJtYXJrZG93blwiKSwge1xuICAgICAgICAgICAgICAgICAgICByZW5kZXJlcjogbmV3IG1hcmtlZC5SZW5kZXJlcigpLFxuICAgICAgICAgICAgICAgICAgICBnZm06IHRydWUsXG4gICAgICAgICAgICAgICAgICAgIHRhYmxlczogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgICAgYnJlYWtzOiBmYWxzZSxcbiAgICAgICAgICAgICAgICAgICAgcGVkYW50aWM6IGZhbHNlLFxuICAgICAgICAgICAgICAgICAgICBzbWFydExpc3RzOiB0cnVlLFxuICAgICAgICAgICAgICAgICAgICBzbWFydHlwYW50czogZmFsc2UsXG4gICAgICAgICAgICAgICAgICAgIGhpZ2hsaWdodDogZnVuY3Rpb24gKGNvZGUpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBobGpzLmhpZ2hsaWdodEF1dG8oY29kZSkudmFsdWU7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHdpbmRvdy5MdWZmaWNjQmxvZyA9IEx1ZmZpY2NCbG9nO1xufSkoalF1ZXJ5KTtcbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgICBjb25zb2xlLmxvZygnZG9jdW1lbnQ6cmVhZHknKTtcbiAgICBMdWZmaWNjQmxvZy5pbml0KCk7XG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7QUFJQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);