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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/create_edit.js":
/*!*************************************!*\
  !*** ./resources/js/create_edit.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * subPostの上下入れ替え機能 
 */
function upForm(formNum) {
  if (formNum > 1) {
    // １つ上のsubPostNum
    var refNum = formNum - 1; // 上に挿入される要素の親要素

    var parent = document.getElementById('form_' + refNum).parentNode; //　挿入する要素

    var targetEle = document.getElementById('form_' + formNum); // 上に挿入される要素

    var referenceEle = document.getElementById('form_' + refNum); // 挿入

    parent.insertBefore(targetEle, referenceEle); // referenceEle書き換え
    // 全体div

    var referenceWholeDiv = document.getElementById('form_' + refNum);
    referenceWholeDiv.id = 'form_' + formNum; // contantDiv

    var referenceSubPostDiv = document.getElementById('subPostDiv_' + refNum);
    referenceSubPostDiv.id = 'subPostDiv_' + formNum; // delFlag

    var referenceDelFlag = document.getElementById('delFlag_' + refNum);
    referenceDelFlag.id = 'delFlag_' + formNum;
    referenceDelFlag.name = 'delFlag_' + formNum; // delFlagBtn

    var referenceDelFlagBtn = document.getElementById('delFlagBtn_' + refNum);
    referenceDelFlagBtn.id = 'delFlagBtn_' + formNum;
    referenceDelFlagBtn.setAttribute("onclick", 'delFlagBtn(' + formNum + ')'); // No

    var referenceLabel = document.getElementById('subPostLabel_' + refNum);
    referenceLabel.id = 'subPostLabel_' + formNum;
    referenceLabel.innerHTML = 'No.' + formNum; // photo

    var referencePhotoLabel = document.getElementById('sub_photo_' + refNum + '_label');
    referencePhotoLabel.id = 'sub_photo_' + formNum + '_label';
    referencePhotoLabel.setAttribute("for", 'sub_photo_' + formNum + '_label');
    var referencePhoto = document.getElementById('sub_photo_' + refNum);
    referencePhoto.id = 'sub_photo_' + formNum;
    referencePhoto.name = 'sub_photo_' + formNum; // tag

    var referenceTagLabel = document.getElementById('tag_' + refNum + '_label');
    referenceTagLabel.id = 'tag_' + formNum + '_label';
    referenceTagLabel.setAttribute("for", 'tag_' + formNum + '_label');
    var referenceTag = document.getElementById('tag_' + refNum);
    referenceTag.id = 'tag_' + formNum;
    referenceTag.name = 'tag_' + formNum; // commnet

    var referenceCommentLabel = document.getElementById('comment_' + refNum + '_label');
    referenceCommentLabel.id = 'comment_' + formNum + '_label';
    referenceCommentLabel.setAttribute("for", 'comment_' + formNum + '_label');
    var referenceComment = document.getElementById('comment_' + refNum);
    referenceComment.id = 'comment_' + formNum;
    referenceComment.name = 'comment_' + formNum; //upbutton

    var referenceUpbtn = document.getElementById('upFormbtn_' + refNum);
    referenceUpbtn.id = 'upFormbtn_' + formNum;
    referenceUpbtn.setAttribute("onclick", 'upForm(' + formNum + ')'); //downbutton

    var referenceDownbtn = document.getElementById('downFormbtn_' + refNum);
    referenceDownbtn.id = 'downFormbtn_' + formNum;
    referenceDownbtn.setAttribute("onclick", 'downForm(' + formNum + ')'); // targetEle書き換え
    // 全体div

    var targetWholeDiv = document.getElementById('form_' + formNum);
    targetWholeDiv.id = 'form_' + refNum; //contentDiv

    var targetSubPostDiv = document.getElementById('subPostDiv_' + formNum);
    targetSubPostDiv.id = 'subPostDiv_' + refNum; // delFlag

    var targetDelFlag = document.getElementById('delFlag_' + formNum);
    targetDelFlag.id = 'delFlag_' + refNum;
    targetDelFlag.name = 'delFlag_' + refNum; // delFlagBtn

    var targetDelFlagBtn = document.getElementById('delFlagBtn_' + formNum);
    targetDelFlagBtn.id = 'delFlagBtn_' + refNum;
    targetDelFlagBtn.setAttribute("onclick", 'delFlagBtn(' + refNum + ')'); // No

    var targetLabel = document.getElementById('subPostLabel_' + formNum);
    targetLabel.id = 'subPostLabel_' + refNum;
    targetLabel.innerHTML = 'No.' + refNum; // photo

    var targetPhotoLabel = document.getElementById('sub_photo_' + formNum + '_label');
    targetPhotoLabel.id = 'sub_photo_' + refNum + '_label';
    targetPhotoLabel.setAttribute("for", 'sub_photo_' + refNum + '_label');
    var targetPhoto = document.getElementById('sub_photo_' + formNum);
    targetPhoto.id = 'sub_photo_' + refNum;
    targetPhoto.name = 'sub_photo_' + refNum; // tag

    var targetTagLabel = document.getElementById('tag_' + formNum + '_label');
    targetTagLabel.id = 'tag_' + refNum + '_label';
    targetTagLabel.setAttribute("for", 'tag_' + refNum + '_label');
    var targetTag = document.getElementById('tag_' + formNum);
    targetTag.id = 'tag_' + refNum;
    targetTag.name = 'tag_' + refNum; // commnet

    var targetCommentLabel = document.getElementById('comment_' + formNum + '_label');
    targetCommentLabel.id = 'comment_' + refNum + '_label';
    targetCommentLabel.setAttribute("for", 'comment_' + refNum + '_label');
    var targetComment = document.getElementById('comment_' + formNum);
    targetComment.id = 'comment_' + refNum;
    targetComment.name = 'comment_' + refNum; //upbutton

    var targetUpbtn = document.getElementById('upFormbtn_' + formNum);
    targetUpbtn.id = 'upFormbtn_' + refNum;
    targetUpbtn.setAttribute("onclick", 'upForm(' + refNum + ')'); //downbutton

    var targetDownbtn = document.getElementById('downFormbtn_' + formNum);
    targetDownbtn.id = 'downFormbtn_' + refNum;
    targetDownbtn.setAttribute("onclick", 'downForm(' + refNum + ')');
  }
}

function downForm(formNum) {
  var totalCount = document.getElementById('totalCount').value;

  if (formNum < totalCount) {
    // １つ下のsubPostNum
    var refNum = formNum + 1; // 上に挿入される要素の親要素

    var parent = document.getElementById('form_' + refNum).parentNode; // console.log(parent);
    //　挿入する要素

    var targetEle = document.getElementById('form_' + formNum); //console.log(targetEle);
    // 上に挿入される要素

    var referenceEle = document.getElementById('form_' + refNum);
    console.log(referenceEle); // 挿入

    parent.insertBefore(targetEle, referenceEle.nextSibling); // targetEle書き換え
    // 全体div

    var targetWholeDiv = document.getElementById('form_' + formNum);
    targetWholeDiv.id = 'form_' + refNum; //contentDiv

    var targetSubPostDiv = document.getElementById('subPostDiv_' + formNum);
    targetSubPostDiv.id = 'subPostDiv_' + refNum; // delFlag

    var targetDelFlag = document.getElementById('delFlag_' + formNum);
    targetDelFlag.id = 'delFlag_' + refNum;
    targetDelFlag.name = 'delFlag_' + refNum; // delFlagBtn

    var targetDelFlagBtn = document.getElementById('delFlagBtn_' + formNum);
    targetDelFlagBtn.id = 'delFlagBtn_' + refNum;
    targetDelFlagBtn.setAttribute("onclick", 'delFlagBtn(' + refNum + ')'); // No

    var targetLabel = document.getElementById('subPostLabel_' + formNum);
    targetLabel.id = 'subPostLabel_' + refNum;
    targetLabel.innerHTML = 'No.' + refNum; // photo

    var targetPhotoLabel = document.getElementById('sub_photo_' + formNum + '_label');
    targetPhotoLabel.id = 'sub_photo_' + refNum + '_label';
    targetPhotoLabel.setAttribute("for", 'sub_photo_' + refNum + '_label');
    var targetPhoto = document.getElementById('sub_photo_' + formNum);
    targetPhoto.id = 'sub_photo_' + refNum;
    targetPhoto.name = 'sub_photo_' + refNum; // tag

    var targetTagLabel = document.getElementById('tag_' + formNum + '_label');
    targetTagLabel.id = 'tag_' + refNum + '_label';
    targetTagLabel.setAttribute("for", 'tag_' + refNum + '_label');
    var targetTag = document.getElementById('tag_' + formNum);
    targetTag.id = 'tag_' + refNum;
    targetTag.name = 'tag_' + refNum; // commnet

    var targetCommentLabel = document.getElementById('comment_' + formNum + '_label');
    targetCommentLabel.id = 'comment_' + refNum + '_label';
    targetCommentLabel.setAttribute("for", 'comment_' + refNum + '_label');
    var targetComment = document.getElementById('comment_' + formNum);
    targetComment.id = 'comment_' + refNum;
    targetComment.name = 'comment_' + refNum; //upbutton

    var targetUpbtn = document.getElementById('upFormbtn_' + formNum);
    targetUpbtn.id = 'upFormbtn_' + refNum;
    targetUpbtn.setAttribute("onclick", 'upForm(' + refNum + ')'); //downbutton

    var targetDownbtn = document.getElementById('downFormbtn_' + formNum);
    targetDownbtn.id = 'downFormbtn_' + refNum;
    targetDownbtn.setAttribute("onclick", 'downForm(' + refNum + ')'); // referenceEle書き換え
    // 全体div

    var referenceWholeDiv = document.getElementById('form_' + refNum);
    referenceWholeDiv.id = 'form_' + formNum; // contantDiv

    var referenceSubPostDiv = document.getElementById('subPostDiv_' + refNum);
    referenceSubPostDiv.id = 'subPostDiv_' + formNum; // delFlag

    var referenceDelFlag = document.getElementById('delFlag_' + refNum);
    referenceDelFlag.id = 'delFlag_' + formNum;
    referenceDelFlag.name = 'delFlag_' + formNum; // delFlagBtn

    var referenceFlagBtn = document.getElementById('delFlagBtn_' + refNum);
    referenceFlagBtn.id = 'delFlagBtn_' + formNum;
    referenceFlagBtn.setAttribute("onclick", 'delFlagBtn(' + formNum + ')'); // No

    var referenceLabel = document.getElementById('subPostLabel_' + refNum);
    referenceLabel.id = 'subPostLabel_' + formNum;
    referenceLabel.innerHTML = 'No.' + formNum; // photo

    var referencePhotoLabel = document.getElementById('sub_photo_' + refNum + '_label');
    referencePhotoLabel.id = 'sub_photo_' + formNum + '_label';
    referencePhotoLabel.setAttribute("for", 'sub_photo_' + formNum + '_label');
    var referencePhoto = document.getElementById('sub_photo_' + refNum);
    referencePhoto.id = 'sub_photo_' + formNum;
    referencePhoto.name = 'sub_photo_' + formNum; // tag

    var referenceTagLabel = document.getElementById('tag_' + refNum + '_label');
    referenceTagLabel.id = 'tag_' + formNum + '_label';
    referenceTagLabel.setAttribute("for", 'tag_' + formNum + '_label');
    var referenceTag = document.getElementById('tag_' + refNum);
    referenceTag.id = 'tag_' + formNum;
    referenceTag.name = 'tag_' + formNum; // commnet

    var referenceCommentLabel = document.getElementById('comment_' + refNum + '_label');
    referenceCommentLabel.id = 'comment_' + formNum + '_label';
    referenceCommentLabel.setAttribute("for", 'comment_' + formNum + '_label');
    var referenceComment = document.getElementById('comment_' + refNum);
    referenceComment.id = 'comment_' + formNum;
    referenceComment.name = 'comment_' + formNum; //upbutton

    var referenceUpbtn = document.getElementById('upFormbtn_' + refNum);
    referenceUpbtn.id = 'upFormbtn_' + formNum;
    referenceUpbtn.setAttribute("onclick", 'upForm(' + formNum + ')'); //downbutton

    var referenceDownbtn = document.getElementById('downFormbtn_' + refNum);
    referenceDownbtn.id = 'downFormbtn_' + formNum;
    referenceDownbtn.setAttribute("onclick", 'downForm(' + formNum + ')');
  }
}
/**
 * preview機能
 */


function previewImage(obj) {
  var fileReader = new FileReader();

  fileReader.onload = function () {
    var canvas = document.getElementById('preview');
    var ctx = canvas.getContext('2d');
    var image = new Image();
    image.src = fileReader.result;

    image.onload = function () {
      canvas.width = image.width;
      canvas.height = image.height;
      ctx.drawImage(image, 0, 0);
    };
  };

  fileReader.readAsDataURL(obj.files[0]);
}

/***/ }),

/***/ 2:
/*!*******************************************!*\
  !*** multi ./resources/js/create_edit.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/tabiripa.jp/resources/js/create_edit.js */"./resources/js/create_edit.js");


/***/ })

/******/ });