/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/FadeInScroll.js":
/*!********************************!*\
  !*** ./src/js/FadeInScroll.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "FaceInScroll": () => (/* binding */ FaceInScroll)
/* harmony export */ });
const DURATION = 1.5;

class FaceInScroll {
  constructor() {
    // 普通のやつ
    gsap.utils.toArray(".js-fade-in-scroll").forEach(elm => {
      ScrollTrigger.create({
        trigger: elm,
        once: true,
        start: "top-=100px center",
        // markers: true,
        onEnter: () => {
          gsap.to(elm, {
            autoAlpha: 1,
            y: 0,
            duration: DURATION
          });
        }
      });
    }); // リスト

    gsap.utils.toArray(".js-fade-in-scroll-ul").forEach(elm => {
      const delay = elm.dataset.delay ? Number(elm.dataset.delay) : 0.2;
      const delayMax = elm.dataset.delayMax ? Number(elm.dataset.delayMax) : 3;
      ScrollTrigger.create({
        trigger: elm,
        once: true,
        start: "top-=100px center",
        // markers: true,
        onEnter: () => {
          const $list = elm.querySelectorAll(".js-fade-in-scroll-li");
          gsap.utils.toArray($list).forEach((elm2, index) => {
            gsap.to(elm2, {
              autoAlpha: 1,
              y: 0,
              duration: DURATION,
              delay: Math.min(delayMax, index * delay)
            });
          });
        }
      });
    });
  }

}



/***/ }),

/***/ "./src/js/HomeSlide.js":
/*!*****************************!*\
  !*** ./src/js/HomeSlide.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "HomeSlide": () => (/* binding */ HomeSlide)
/* harmony export */ });
gsap.registerPlugin(SplitText);

const unescapeHtml = target => {
  if (typeof target !== "string") return target;
  const patterns = {
    "&lt;": "<",
    "&gt;": ">",
    "&amp;": "&",
    "&quot;": '"',
    "&#x27;": "'",
    "&#x60;": "`"
  };
  return target.replace(/&(lt|gt|amp|quot|#x27|#x60);/g, match => {
    return patterns[match];
  });
};

class HomeSlide {
  constructor() {
    this.active = 0;
    this.disabled = false;
    this.$hero = document.querySelector("#top_hero");

    if (this.$hero && window.homeSlide && window.homeSlide.length) {
      this.$nav = this.$hero.querySelectorAll(".js-nav")[0];
      this.$comments = this.$hero.querySelectorAll(".js-comments")[0];
      this.$reference = this.$hero.querySelectorAll(".js-reference")[0];
      this.$image = this.$hero.querySelectorAll(".js-slide-image")[0];
      this.loadImage().then(() => {
        this.renderNav();
        this.eventBindNav();
        this.navActive();
        this.renderComments();
        this.renderImage();
        this.commentsAnim();
        this.renderReference();
      });
    }
  }

  loadImage() {
    const imageUrl = window.homeSlide[this.active].image;
    return new Promise((resolve, reject) => {
      if (!imageUrl) resolve("");
      const image = new Image();
      image.addEventListener("load", () => {
        resolve(imageUrl);
      });
      image.addEventListener("error", error => {
        reject(error);
      });
      image.src = imageUrl;
    });
  }

  renderNav() {
    let navHtml = "";
    window.homeSlide.forEach((slide, index) => {
      navHtml += `
<button class="p-top-hero__bar" type="button">
<span class="u-visually-hidden">${index + 1}</span>
</button>
`;
    });
    this.$nav.innerHTML = navHtml;
  }

  navActive() {
    gsap.utils.toArray(this.$nav.querySelectorAll("button")).forEach((elm, index) => {
      elm.setAttribute("aria-current", this.active === index);
    });
  }

  eventBindNav() {
    gsap.utils.toArray(this.$nav.querySelectorAll("button")).forEach((elm, index) => {
      elm.addEventListener("click", () => {
        if (index === this.active || this.disabled) return;
        this.setActive(index);
        this.next();
      });
    });
  }

  setActive(index) {
    this.active = index % window.homeSlide.length;
  }

  next() {
    if (this.timerId) {
      clearTimeout(this.timerId);
    }

    this.navActive();
    this.loadImage().then(() => {
      this.renderImage();
      this.renderComments();
      this.commentsAnim();
      this.renderReference();
    });
  }

  renderComments() {
    const slide = window.homeSlide[this.active];
    let commentsHtml = "";
    slide.comments.forEach(comment => {
      commentsHtml += `
<div class="js-comment">${unescapeHtml(comment.text)}</div>
      `;
    });
    this.$comments.innerHTML = commentsHtml;
  }

  renderImage() {
    const imageUrl = window.homeSlide[this.active].image;

    if (imageUrl) {
      this.$image.innerHTML = `
      <img src="${imageUrl}" alt="" style="opacity: 0;" />
      `;
    } else {
      this.$image.innerHTML = "";
    }
  }

  commentsAnim() {
    if (this.tl) {
      this.tl.kill();
    }

    this.tl = gsap.timeline({
      onComplete: () => {
        this.timerId = setTimeout(() => {
          this.disabled = true;
          this.commentsLeaveAnim();
        }, 3000);
      }
    });
    gsap.utils.toArray(this.$comments.querySelectorAll(".js-comment")).forEach((elm, index) => {
      const splitText = new SplitText(elm);
      const chars = splitText.chars;
      this.tl.from(chars, {
        opacity: 0,
        ease: "power0.easeNone",
        stagger: 0.08,
        duration: 0.8,
        delay: index === 0 ? 0 : 0.8
      });
    }); // 参照の表示

    this.tl.to(this.$reference, {
      opacity: 1,
      ease: "power0.easeNone",
      duration: 1
    }); // 背景画像の表示

    gsap.to(this.$image.querySelector("img"), {
      opacity: 1,
      ease: "power0.easeNone",
      duration: 1
    });
  }

  commentsLeaveAnim() {
    gsap.to(this.$comments.querySelectorAll(".js-comment"), {
      opacity: 0,
      ease: "power0.easeNone",
      onComplete: () => {
        setTimeout(() => {
          this.setActive(this.active + 1);
          this.next();
          this.disabled = false;
        }, 1000);
      }
    });
    gsap.to(this.$reference, {
      opacity: 0,
      ease: "power0.easeNone"
    }); // 背景画像

    gsap.to(this.$image.querySelector("img"), {
      opacity: 0,
      ease: "power0.easeNone",
      duration: 1
    });
  }

  renderReference() {
    this.$reference.classList.remove("-show");
    setTimeout(() => {
      const reference = window.homeSlide[this.active]["reference"];
      const html = `
  <a class="p-top-hero__link" href="${reference.url}">
  ${unescapeHtml(reference.text)}
  </a>
  `;
      this.$reference.innerHTML = html;
    }, 500);
  }

}



/***/ }),

/***/ "./src/js/Modal.js":
/*!*************************!*\
  !*** ./src/js/Modal.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Modal": () => (/* binding */ Modal)
/* harmony export */ });
class Modal {
  constructor() {
    $(".js-modal").magnificPopup({
      type: "inline",
      midClick: true,
      gallery: {
        enabled: true,
        arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%">%title%</button>',
        tPrev: "Back",
        tNext: "Next"
      },
      closeMarkup: '<button title="%title%" type="button" class="mfp-close"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 10.9053L1.11111 19.7942C0.973936 19.9314 0.823045 20 0.658436 20C0.493827 20 0.342936 19.9314 0.205761 19.7942C0.0685871 19.6571 0 19.5062 0 19.3416C0 19.177 0.0685871 19.0261 0.205761 18.8889L9.09465 10L0.205761 1.11111C0.0685871 0.973936 0 0.823045 0 0.658436C0 0.493827 0.0685871 0.342936 0.205761 0.205761C0.342936 0.0685871 0.493827 0 0.658436 0C0.823045 0 0.973936 0.0685871 1.11111 0.205761L10 9.09465L18.8889 0.205761C19.0261 0.0685871 19.177 0 19.3416 0C19.5062 0 19.6571 0.0685871 19.7942 0.205761C19.9314 0.342936 20 0.493827 20 0.658436C20 0.823045 19.9314 0.973936 19.7942 1.11111L10.9053 10L19.7942 18.8889C19.9314 19.0261 20 19.177 20 19.3416C20 19.5062 19.9314 19.6571 19.7942 19.7942C19.6571 19.9314 19.5062 20 19.3416 20C19.177 20 19.0261 19.9314 18.8889 19.7942L10 10.9053Z" fill="white"/></svg>閉じる</button>'
    });
  }

}



/***/ }),

/***/ "./src/js/Tab.js":
/*!***********************!*\
  !*** ./src/js/Tab.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Tab": () => (/* binding */ Tab)
/* harmony export */ });
class Tab {
  constructor() {
    this.tabAll = document.querySelector("#all");
    this.tab = document.querySelectorAll('input[name="tab"]');
    this.tagList = document.querySelector(".p-service-header__tag-list");
    this.currentValue = "";
    this.initialize();
    this.update();
  }

  initialize() {
    if (!this.tabAll) return;
    this.tabAll.checked = true;
    this.currentValue = this.tabAll.value;
    this.tagList.hidden = false;
  }

  update() {
    this.tab.forEach(r => r.addEventListener("change", e => {
      this.currentValue = e.target.value;

      if (this.currentValue !== "value1") {
        this.tagList.hidden = true;
      } else {
        this.tagList.hidden = false;
      }
    }));
  }

}



/***/ }),

/***/ "./src/js/common/config.js":
/*!*********************************!*\
  !*** ./src/js/common/config.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "MOBILE_WIDTH": () => (/* binding */ MOBILE_WIDTH)
/* harmony export */ });
const MOBILE_WIDTH = 768;

/***/ }),

/***/ "./src/js/common/utils/isMobileSize.js":
/*!*********************************************!*\
  !*** ./src/js/common/utils/isMobileSize.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "isMobileSize": () => (/* binding */ isMobileSize)
/* harmony export */ });
/* harmony import */ var _config__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../config */ "./src/js/common/config.js");

const isMobileSize = () => {
  return window.innerWidth <= _config__WEBPACK_IMPORTED_MODULE_0__.MOBILE_WIDTH;
};

/***/ }),

/***/ "./src/js/mobileMenu.js":
/*!******************************!*\
  !*** ./src/js/mobileMenu.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "MobileMenu": () => (/* binding */ MobileMenu)
/* harmony export */ });
/* harmony import */ var _common_utils_isMobileSize__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./common/utils/isMobileSize */ "./src/js/common/utils/isMobileSize.js");


class MobileMenu {
  constructor() {
    this.button = document.querySelector('[aria-label="メイン"] button');
    this.menu = this.button.nextElementSibling; //リサイズハンドリング

    window.addEventListener("resize", this.initialize.bind(this)); //初回アップデート

    this.initialize();
    this.update();
  }

  initialize() {
    if (!(0,_common_utils_isMobileSize__WEBPACK_IMPORTED_MODULE_0__.isMobileSize)()) {
      this.button.removeAttribute("aria-expanded");
      this.button.hidden = true;
      this.menu.hidden = false;
      return;
    }

    this.button.setAttribute("aria-expanded", "false");
    this.button.hidden = false;
    this.menu.hidden = true;
  }

  update() {
    this.button.addEventListener("click", function () {
      // メニューの表示／非表示を切り替える
      const expanded = this.getAttribute("aria-expanded") === "true";
      this.setAttribute("aria-expanded", String(!expanded));
      this.nextElementSibling.hidden = expanded;
    });
  }

}



/***/ }),

/***/ "./src/js/semiModal.js":
/*!*****************************!*\
  !*** ./src/js/semiModal.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "semiModal": () => (/* binding */ semiModal)
/* harmony export */ });
class semiModal {
  constructor() {
    this.openButton = document.querySelector(".js-open-modal");
    this.closeButton = document.querySelector(".js-close-modal");
    this.dialog = document.querySelector("dialog");
    if (!this.openButton) return;
    this.openButton.addEventListener("click", () => {
      if (typeof this.dialog.showModal === "function") {
        this.dialog.showModal();
      }
    });
    this.closeButton.addEventListener("click", () => {
      this.dialog.close();
    });
  }

}



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mobileMenu__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./mobileMenu */ "./src/js/mobileMenu.js");
/* harmony import */ var _Modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Modal */ "./src/js/Modal.js");
/* harmony import */ var _Tab__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Tab */ "./src/js/Tab.js");
/* harmony import */ var _semiModal__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./semiModal */ "./src/js/semiModal.js");
/* harmony import */ var _FadeInScroll__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./FadeInScroll */ "./src/js/FadeInScroll.js");
/* harmony import */ var _HomeSlide__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./HomeSlide */ "./src/js/HomeSlide.js");







const init = () => {
  new _mobileMenu__WEBPACK_IMPORTED_MODULE_0__.MobileMenu();
  new _Modal__WEBPACK_IMPORTED_MODULE_1__.Modal();
  new _Tab__WEBPACK_IMPORTED_MODULE_2__.Tab();
  new _semiModal__WEBPACK_IMPORTED_MODULE_3__.semiModal();
  new _FadeInScroll__WEBPACK_IMPORTED_MODULE_4__.FaceInScroll();
  new _HomeSlide__WEBPACK_IMPORTED_MODULE_5__.HomeSlide();
};

window.addEventListener("DOMContentLoaded", () => {
  init();
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!****************************!*\
  !*** ./src/scss/main.scss ***!
  \****************************/
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin

})();

/******/ })()
;
//# sourceMappingURL=main.js.map