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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/plugins/custom/flot/flot.js":
/*!***********************************************!*\
  !*** ./resources/plugins/custom/flot/flot.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// Flot- Flot is a pure JavaScript plotting library for jQuery, with a focus on simple usage, attractive looks and interactive features: https://www.flotcharts.org/\n__webpack_require__(!(function webpackMissingModule() { var e = new Error(\"Cannot find module 'flot/dist/es5/jquery.flot.js'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));\n\n__webpack_require__(!(function webpackMissingModule() { var e = new Error(\"Cannot find module 'flot/source/jquery.flot.resize.js'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));\n\n__webpack_require__(!(function webpackMissingModule() { var e = new Error(\"Cannot find module 'flot/source/jquery.flot.categories.js'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));\n\n__webpack_require__(!(function webpackMissingModule() { var e = new Error(\"Cannot find module 'flot/source/jquery.flot.pie.js'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));\n\n__webpack_require__(!(function webpackMissingModule() { var e = new Error(\"Cannot find module 'flot/source/jquery.flot.stack.js'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));\n\n__webpack_require__(!(function webpackMissingModule() { var e = new Error(\"Cannot find module 'flot/source/jquery.flot.crosshair.js'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));\n\n__webpack_require__(!(function webpackMissingModule() { var e = new Error(\"Cannot find module 'flot/source/jquery.flot.axislabels.js'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvcGx1Z2lucy9jdXN0b20vZmxvdC9mbG90LmpzP2Y5YTQiXSwibmFtZXMiOlsicmVxdWlyZSJdLCJtYXBwaW5ncyI6IkFBQUE7QUFFQUEsbUJBQU8sQ0FBQyxzSkFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLDJKQUFELENBQVA7O0FBQ0FBLG1CQUFPLENBQUMsK0pBQUQsQ0FBUDs7QUFDQUEsbUJBQU8sQ0FBQyx3SkFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLDBKQUFELENBQVA7O0FBQ0FBLG1CQUFPLENBQUMsOEpBQUQsQ0FBUDs7QUFDQUEsbUJBQU8sQ0FBQywrSkFBRCxDQUFQIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL3BsdWdpbnMvY3VzdG9tL2Zsb3QvZmxvdC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIEZsb3QtIEZsb3QgaXMgYSBwdXJlIEphdmFTY3JpcHQgcGxvdHRpbmcgbGlicmFyeSBmb3IgalF1ZXJ5LCB3aXRoIGEgZm9jdXMgb24gc2ltcGxlIHVzYWdlLCBhdHRyYWN0aXZlIGxvb2tzIGFuZCBpbnRlcmFjdGl2ZSBmZWF0dXJlczogaHR0cHM6Ly93d3cuZmxvdGNoYXJ0cy5vcmcvXHJcblxyXG5yZXF1aXJlKCdmbG90L2Rpc3QvZXM1L2pxdWVyeS5mbG90LmpzJyk7XHJcbnJlcXVpcmUoJ2Zsb3Qvc291cmNlL2pxdWVyeS5mbG90LnJlc2l6ZS5qcycpO1xyXG5yZXF1aXJlKCdmbG90L3NvdXJjZS9qcXVlcnkuZmxvdC5jYXRlZ29yaWVzLmpzJyk7XHJcbnJlcXVpcmUoJ2Zsb3Qvc291cmNlL2pxdWVyeS5mbG90LnBpZS5qcycpO1xyXG5yZXF1aXJlKCdmbG90L3NvdXJjZS9qcXVlcnkuZmxvdC5zdGFjay5qcycpO1xyXG5yZXF1aXJlKCdmbG90L3NvdXJjZS9qcXVlcnkuZmxvdC5jcm9zc2hhaXIuanMnKTtcclxucmVxdWlyZSgnZmxvdC9zb3VyY2UvanF1ZXJ5LmZsb3QuYXhpc2xhYmVscy5qcycpO1xyXG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/plugins/custom/flot/flot.js\n");

/***/ }),

/***/ 5:
/*!*****************************************************!*\
  !*** multi ./resources/plugins/custom/flot/flot.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\laravel-metronic-starter\resources\plugins\custom\flot\flot.js */"./resources/plugins/custom/flot/flot.js");


/***/ })

/******/ });