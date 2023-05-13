/*!
 * show-nav-on-screen.js
 * http://fanseethemes.com/
 *
 * Copyright (c) fanseethemes
 *
 * License: GPL
 * https://www.gnu.org/licenses/gpl-3.0.html
 * 
 */

+(function () {

  var FstShowNavOnScreen = /** @class */ (function () {

      FstShowNavOnScreen = function (selector) {
          var nav = this;

          nav.element = document.querySelectorAll(selector);
          nav.setConfig();
          nav.setWindowWidth();
          nav.listenEvent();
      }


      FstShowNavOnScreen.prototype.setConfig = function () {
          var nav = this;
          nav.subNavPosition = 'right';
          nav.subNavOffsetLeft = null;
          nav.windowWidth = null;
          nav.subNavWidth = null;
      };


      FstShowNavOnScreen.prototype.setWindowWidth = function () {
          var nav = this;
          nav.windowWidth = window.innerWidth;

          window.onresize = function (e) {
              nav.windowWidth = window.innerWidth;
          }
      };


      FstShowNavOnScreen.prototype.setOppositeDirection = function () {
          var nav = this;
          if ('right' === nav.subNavPosition) {
              nav.subNavPosition = 'left';
          } else if ('left' === nav.subNavPosition) {
              nav.subNavPosition = 'right';
          }
      };


      FstShowNavOnScreen.prototype.isNextSubMenuWillFitOnScreen = function () {
          var nav = this;
          switch (nav.subNavPosition) {
              case 'right':
                  return (nav.subNavWidth * 2) + nav.subNavOffsetLeft < nav.windowWidth ? true : false;
              case 'left':
                  return nav.subNavOffsetLeft - nav.subNavWidth > 0 ? true : false;
          };
      };


      FstShowNavOnScreen.prototype.isATag = function (e) {
          return e.target && e.target.nodeName == 'A';
      }


      FstShowNavOnScreen.prototype.applyStyle = function (element) {
          var nav = this;
          var nextNavSubmenu = element.nextElementSibling;

          if (!nextNavSubmenu) return false;

          if ('left' === nav.subNavPosition) {
              nextNavSubmenu.style.left = 'initial';
              nextNavSubmenu.style.right = '100%';
          } else if ('right' === nav.subNavPosition) {
              nextNavSubmenu.style.left = null;
              nextNavSubmenu.style.right = null;
          }
      };


      FstShowNavOnScreen.prototype.handleMouseEnterEvent = function (element) {
          var nav = this;
          var parentUl = element.parentElement.parentElement;
          var parentUlDetail = parentUl.getBoundingClientRect();

          if (!nav.subNavWidth) {
              nav.subNavWidth = parentUlDetail.width;
          }
          nav.subNavOffsetLeft = parentUlDetail.x;

          if (!nav.isNextSubMenuWillFitOnScreen()) {
              nav.setOppositeDirection();
          }
          nav.applyStyle(element);
      };


      FstShowNavOnScreen.prototype.listenEvent = function () {
          var nav = this;
          nav.element.forEach(function (element) {
              element.addEventListener('mouseover', function (e) {
                  if (nav.isATag(e))
                      nav.handleMouseEnterEvent(e.target, nav);
              });
              element.addEventListener('mouseout', function (e) {
                  if (nav.isATag(e))
                      nav.handleMouseEnterEvent(e.target, nav);
              })
          })
      };


      return FstShowNavOnScreen;

  }());

  window.FstShowNavOnScreen = FstShowNavOnScreen;

})()




