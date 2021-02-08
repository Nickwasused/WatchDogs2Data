/**
 * @license
 lozad.js - v1.16.0 - 2020-09-06
 https://github.com/ApoorvSaxena/lozad.js
 Copyright (c) 2020 Apoorv Saxena; Licensed MIT */
 'use strict';
 !function(global, e) {
   if ("object" == typeof exports && "undefined" != typeof module) {
     module.exports = e();
   } else {
     if ("function" == typeof define && define.amd) {
       define(e);
     } else {
       global.lozad = e();
     }
   }
 }(this, function() {
   /**
    * @param {!Node} page
    * @return {undefined}
    */
   function update(page) {
     page.setAttribute("data-loaded", true);
   }
   var g = "undefined" != typeof document && document.documentMode;
   var params = {
     rootMargin : "0px",
     threshold : 0,
     load : function(element) {
       if ("picture" === element.nodeName.toLowerCase()) {
         var preview = element.querySelector("img");
         /** @type {boolean} */
         var r = false;
         if (null === preview) {
           /** @type {!Element} */
           preview = document.createElement("img");
           /** @type {boolean} */
           r = true;
         }
         if (g && element.getAttribute("data-iesrc")) {
           preview.src = element.getAttribute("data-iesrc");
         }
         if (element.getAttribute("data-alt")) {
           preview.alt = element.getAttribute("data-alt");
         }
         if (r) {
           element.append(preview);
         }
       }
       if ("video" === element.nodeName.toLowerCase() && !element.getAttribute("data-src") && element.children) {
         var a = element.children;
         var src_screen_shot = void 0;
         /** @type {number} */
         var i = 0;
         for (; i <= a.length - 1; i++) {
           if (src_screen_shot = a[i].getAttribute("data-src")) {
             a[i].src = src_screen_shot;
           }
         }
         element.load();
       }
       if (element.getAttribute("data-poster")) {
         element.poster = element.getAttribute("data-poster");
       }
       if (element.getAttribute("data-src")) {
         element.src = element.getAttribute("data-src");
       }
       if (element.getAttribute("data-srcset")) {
         element.setAttribute("srcset", element.getAttribute("data-srcset"));
       }
       /** @type {string} */
       var a = ",";
       if (element.getAttribute("data-background-delimiter") && (a = element.getAttribute("data-background-delimiter")), element.getAttribute("data-background-image")) {
         /** @type {string} */
         element.style.backgroundImage = "url('" + element.getAttribute("data-background-image").split(a).join("'),url('") + "')";
       } else {
         if (element.getAttribute("data-background-image-set")) {
           var tags = element.getAttribute("data-background-image-set").split(a);
           var styleValue = tags[0].substr(0, tags[0].indexOf(" ")) || tags[0];
           styleValue = -1 === styleValue.indexOf("url(") ? "url(" + styleValue + ")" : styleValue;
           if (1 === tags.length) {
             element.style.backgroundImage = styleValue;
           } else {
             element.setAttribute("style", (element.getAttribute("style") || "") + "background-image: " + styleValue + "; background-image: -webkit-image-set(" + tags + "); background-image: image-set(" + tags + ")");
           }
         }
       }
       if (element.getAttribute("data-toggle-class")) {
         element.classList.toggle(element.getAttribute("data-toggle-class"));
       }
     },
     loaded : function() {
     }
   };
   /**
    * @param {!Node} target
    * @return {?}
    */
   var check = function(target) {
     return "true" === target.getAttribute("data-loaded");
   };
   /**
    * @param {string} element
    * @return {?}
    */
   var $ = function(element) {
     var doc = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : document;
     return element instanceof Element ? [element] : element instanceof NodeList ? element : doc.querySelectorAll(element);
   };
   return function() {
     var removeFocusRingClass;
     var log;
     var files2 = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : ".lozad";
     var userConfig = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {};
     /** @type {!Object} */
     var config = Object.assign({}, params, userConfig);
     var context = config.root;
     var groupCellClass = config.rootMargin;
     var threshold = config.threshold;
     var fn = config.load;
     var loaded = config.loaded;
     var inviewObserver = void 0;
     if ("undefined" != typeof window && window.IntersectionObserver) {
       /** @type {!IntersectionObserver} */
       inviewObserver = new IntersectionObserver((removeFocusRingClass = fn, log = loaded, function(wrappersTemplates, self) {
         wrappersTemplates.forEach(function(e) {
           if (0 < e.intersectionRatio || e.isIntersecting) {
             self.unobserve(e.target);
             if (!check(e.target)) {
               removeFocusRingClass(e.target);
               update(e.target);
               log(e.target);
             }
           }
         });
       }), {
         root : context,
         rootMargin : groupCellClass,
         threshold : threshold
       });
     }
     var item;
     var files = $(files2, context);
     /** @type {number} */
     var i = 0;
     for (; i < files.length; i++) {
       if ((item = files[i]).getAttribute("data-placeholder-background")) {
         item.style.background = item.getAttribute("data-placeholder-background");
       }
     }
     return {
       observe : function() {
         var files = $(files2, context);
         /** @type {number} */
         var i = 0;
         for (; i < files.length; i++) {
           if (!check(files[i])) {
             if (inviewObserver) {
               inviewObserver.observe(files[i]);
             } else {
               fn(files[i]);
               update(files[i]);
               loaded(files[i]);
             }
           }
         }
       },
       triggerLoad : function(i) {
         if (!check(i)) {
           fn(i);
           update(i);
           loaded(i);
         }
       },
       observer : inviewObserver
     };
   };
 });
 const observer = lozad();
 observer.observe();
 