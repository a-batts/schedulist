var Vt;function dn(o,e){e===void 0&&(e=!1);var t=o.CSS,n=Vt;if(typeof Vt=="boolean"&&!e)return Vt;var i=t&&typeof t.supports=="function";if(!i)return!1;var r=t.supports("--css-vars","yes"),a=t.supports("(--css-vars: yes)")&&t.supports("color","#00000000");return n=r||a,e||(Vt=n),n}function cn(o,e,t){if(!o)return{x:0,y:0};var n=e.x,i=e.y,r=n+t.left,a=i+t.top,s,l;if(o.type==="touchstart"){var u=o;s=u.changedTouches[0].pageX-r,l=u.changedTouches[0].pageY-a}else{var d=o;s=d.pageX-r,l=d.pageY-a}return{x:s,y:l}}var oe=function(o,e){return oe=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,n){t.__proto__=n}||function(t,n){for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(t[i]=n[i])},oe(o,e)};function v(o,e){if(typeof e!="function"&&e!==null)throw new TypeError("Class extends value "+String(e)+" is not a constructor or null");oe(o,e);function t(){this.constructor=o}o.prototype=e===null?Object.create(e):(t.prototype=e.prototype,new t)}var f=function(){return f=Object.assign||function(e){for(var t,n=1,i=arguments.length;n<i;n++){t=arguments[n];for(var r in t)Object.prototype.hasOwnProperty.call(t,r)&&(e[r]=t[r])}return e},f.apply(this,arguments)};function hn(o,e,t,n){function i(r){return r instanceof t?r:new t(function(a){a(r)})}return new(t||(t=Promise))(function(r,a){function s(d){try{u(n.next(d))}catch(h){a(h)}}function l(d){try{u(n.throw(d))}catch(h){a(h)}}function u(d){d.done?r(d.value):i(d.value).then(s,l)}u((n=n.apply(o,e||[])).next())})}function fn(o,e){var t={label:0,sent:function(){if(r[0]&1)throw r[1];return r[1]},trys:[],ops:[]},n,i,r,a;return a={next:s(0),throw:s(1),return:s(2)},typeof Symbol=="function"&&(a[Symbol.iterator]=function(){return this}),a;function s(u){return function(d){return l([u,d])}}function l(u){if(n)throw new TypeError("Generator is already executing.");for(;a&&(a=0,u[0]&&(t=0)),t;)try{if(n=1,i&&(r=u[0]&2?i.return:u[0]?i.throw||((r=i.return)&&r.call(i),0):i.next)&&!(r=r.call(i,u[1])).done)return r;switch(i=0,r&&(u=[u[0]&2,r.value]),u[0]){case 0:case 1:r=u;break;case 4:return t.label++,{value:u[1],done:!1};case 5:t.label++,i=u[1],u=[0];continue;case 7:u=t.ops.pop(),t.trys.pop();continue;default:if(r=t.trys,!(r=r.length>0&&r[r.length-1])&&(u[0]===6||u[0]===2)){t=0;continue}if(u[0]===3&&(!r||u[1]>r[0]&&u[1]<r[3])){t.label=u[1];break}if(u[0]===6&&t.label<r[1]){t.label=r[1],r=u;break}if(r&&t.label<r[2]){t.label=r[2],t.ops.push(u);break}r[2]&&t.ops.pop(),t.trys.pop();continue}u=e.call(o,t)}catch(d){u=[6,d],i=0}finally{n=r=0}if(u[0]&5)throw u[1];return{value:u[0]?u[1]:void 0,done:!0}}}function O(o){var e=typeof Symbol=="function"&&Symbol.iterator,t=e&&o[e],n=0;if(t)return t.call(o);if(o&&typeof o.length=="number")return{next:function(){return o&&n>=o.length&&(o=void 0),{value:o&&o[n++],done:!o}}};throw new TypeError(e?"Object is not iterable.":"Symbol.iterator is not defined.")}function Ve(o,e){var t=typeof Symbol=="function"&&o[Symbol.iterator];if(!t)return o;var n=t.call(o),i,r=[],a;try{for(;(e===void 0||e-- >0)&&!(i=n.next()).done;)r.push(i.value)}catch(s){a={error:s}}finally{try{i&&!i.done&&(t=n.return)&&t.call(n)}finally{if(a)throw a.error}}return r}function Ge(o,e,t){if(t||arguments.length===2)for(var n=0,i=e.length,r;n<i;n++)(r||!(n in e))&&(r||(r=Array.prototype.slice.call(e,0,n)),r[n]=e[n]);return o.concat(r||Array.prototype.slice.call(e))}/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var D=function(){function o(e){e===void 0&&(e={}),this.adapter=e}return Object.defineProperty(o,"cssClasses",{get:function(){return{}},enumerable:!1,configurable:!0}),Object.defineProperty(o,"strings",{get:function(){return{}},enumerable:!1,configurable:!0}),Object.defineProperty(o,"numbers",{get:function(){return{}},enumerable:!1,configurable:!0}),Object.defineProperty(o,"defaultAdapter",{get:function(){return{}},enumerable:!1,configurable:!0}),o.prototype.init=function(){},o.prototype.destroy=function(){},o}();/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var x=function(){function o(e,t){for(var n=[],i=2;i<arguments.length;i++)n[i-2]=arguments[i];this.root=e,this.initialize.apply(this,Ge([],Ve(n))),this.foundation=t===void 0?this.getDefaultFoundation():t,this.foundation.init(),this.initialSyncWithDOM()}return o.attachTo=function(e){return new o(e,new D({}))},o.prototype.initialize=function(){},o.prototype.getDefaultFoundation=function(){throw new Error("Subclasses must override getDefaultFoundation to return a properly configured foundation class")},o.prototype.initialSyncWithDOM=function(){},o.prototype.destroy=function(){this.foundation.destroy()},o.prototype.listen=function(e,t,n){this.root.addEventListener(e,t,n)},o.prototype.unlisten=function(e,t,n){this.root.removeEventListener(e,t,n)},o.prototype.emit=function(e,t,n){n===void 0&&(n=!1);var i;typeof CustomEvent=="function"?i=new CustomEvent(e,{bubbles:n,detail:t}):(i=document.createEvent("CustomEvent"),i.initCustomEvent(e,n,!1,t)),this.root.dispatchEvent(i)},o}();/**
 * @license
 * Copyright 2019 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */function Q(o){return o===void 0&&(o=window),pn(o)?{passive:!0}:!1}function pn(o){o===void 0&&(o=window);var e=!1;try{var t={get passive(){return e=!0,!1}},n=function(){};o.document.addEventListener("test",n,t),o.document.removeEventListener("test",n,t)}catch{e=!1}return e}/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */function dt(o,e){if(o.closest)return o.closest(e);for(var t=o;t;){if(rt(t,e))return t;t=t.parentElement}return null}function rt(o,e){var t=o.matches||o.webkitMatchesSelector||o.msMatchesSelector;return t.call(o,e)}function En(o){var e=o;if(e.offsetParent!==null)return e.scrollWidth;var t=e.cloneNode(!0);t.style.setProperty("position","absolute"),t.style.setProperty("transform","translate(-9999px, -9999px)"),document.documentElement.appendChild(t);var n=t.scrollWidth;return document.documentElement.removeChild(t),n}/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var mn={BG_FOCUSED:"mdc-ripple-upgraded--background-focused",FG_ACTIVATION:"mdc-ripple-upgraded--foreground-activation",FG_DEACTIVATION:"mdc-ripple-upgraded--foreground-deactivation",ROOT:"mdc-ripple-upgraded",UNBOUNDED:"mdc-ripple-upgraded--unbounded"},An={VAR_FG_SCALE:"--mdc-ripple-fg-scale",VAR_FG_SIZE:"--mdc-ripple-fg-size",VAR_FG_TRANSLATE_END:"--mdc-ripple-fg-translate-end",VAR_FG_TRANSLATE_START:"--mdc-ripple-fg-translate-start",VAR_LEFT:"--mdc-ripple-left",VAR_TOP:"--mdc-ripple-top"},he={DEACTIVATION_TIMEOUT_MS:225,FG_DEACTIVATION_MS:150,INITIAL_ORIGIN_SCALE:.6,PADDING:10,TAP_DELAY_MS:300};/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var fe=["touchstart","pointerdown","mousedown","keydown"],pe=["touchend","pointerup","mouseup","contextmenu"],Gt=[],bt=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.activationAnimationHasEnded=!1,n.activationTimer=0,n.fgDeactivationRemovalTimer=0,n.fgScale="0",n.frame={width:0,height:0},n.initialSize=0,n.layoutFrame=0,n.maxRadius=0,n.unboundedCoords={left:0,top:0},n.activationState=n.defaultActivationState(),n.activationTimerCallback=function(){n.activationAnimationHasEnded=!0,n.runDeactivationUXLogicIfReady()},n.activateHandler=function(i){n.activateImpl(i)},n.deactivateHandler=function(){n.deactivateImpl()},n.focusHandler=function(){n.handleFocus()},n.blurHandler=function(){n.handleBlur()},n.resizeHandler=function(){n.layout()},n}return Object.defineProperty(e,"cssClasses",{get:function(){return mn},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return An},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return he},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},browserSupportsCssVars:function(){return!0},computeBoundingRect:function(){return{top:0,right:0,bottom:0,left:0,width:0,height:0}},containsEventTarget:function(){return!0},deregisterDocumentInteractionHandler:function(){},deregisterInteractionHandler:function(){},deregisterResizeHandler:function(){},getWindowPageOffset:function(){return{x:0,y:0}},isSurfaceActive:function(){return!0},isSurfaceDisabled:function(){return!0},isUnbounded:function(){return!0},registerDocumentInteractionHandler:function(){},registerInteractionHandler:function(){},registerResizeHandler:function(){},removeClass:function(){},updateCssVariable:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){var t=this,n=this.supportsPressRipple();if(this.registerRootHandlers(n),n){var i=e.cssClasses,r=i.ROOT,a=i.UNBOUNDED;requestAnimationFrame(function(){t.adapter.addClass(r),t.adapter.isUnbounded()&&(t.adapter.addClass(a),t.layoutInternal())})}},e.prototype.destroy=function(){var t=this;if(this.supportsPressRipple()){this.activationTimer&&(clearTimeout(this.activationTimer),this.activationTimer=0,this.adapter.removeClass(e.cssClasses.FG_ACTIVATION)),this.fgDeactivationRemovalTimer&&(clearTimeout(this.fgDeactivationRemovalTimer),this.fgDeactivationRemovalTimer=0,this.adapter.removeClass(e.cssClasses.FG_DEACTIVATION));var n=e.cssClasses,i=n.ROOT,r=n.UNBOUNDED;requestAnimationFrame(function(){t.adapter.removeClass(i),t.adapter.removeClass(r),t.removeCssVars()})}this.deregisterRootHandlers(),this.deregisterDeactivationHandlers()},e.prototype.activate=function(t){this.activateImpl(t)},e.prototype.deactivate=function(){this.deactivateImpl()},e.prototype.layout=function(){var t=this;this.layoutFrame&&cancelAnimationFrame(this.layoutFrame),this.layoutFrame=requestAnimationFrame(function(){t.layoutInternal(),t.layoutFrame=0})},e.prototype.setUnbounded=function(t){var n=e.cssClasses.UNBOUNDED;t?this.adapter.addClass(n):this.adapter.removeClass(n)},e.prototype.handleFocus=function(){var t=this;requestAnimationFrame(function(){return t.adapter.addClass(e.cssClasses.BG_FOCUSED)})},e.prototype.handleBlur=function(){var t=this;requestAnimationFrame(function(){return t.adapter.removeClass(e.cssClasses.BG_FOCUSED)})},e.prototype.supportsPressRipple=function(){return this.adapter.browserSupportsCssVars()},e.prototype.defaultActivationState=function(){return{activationEvent:void 0,hasDeactivationUXRun:!1,isActivated:!1,isProgrammatic:!1,wasActivatedByPointer:!1,wasElementMadeActive:!1}},e.prototype.registerRootHandlers=function(t){var n,i;if(t){try{for(var r=O(fe),a=r.next();!a.done;a=r.next()){var s=a.value;this.adapter.registerInteractionHandler(s,this.activateHandler)}}catch(l){n={error:l}}finally{try{a&&!a.done&&(i=r.return)&&i.call(r)}finally{if(n)throw n.error}}this.adapter.isUnbounded()&&this.adapter.registerResizeHandler(this.resizeHandler)}this.adapter.registerInteractionHandler("focus",this.focusHandler),this.adapter.registerInteractionHandler("blur",this.blurHandler)},e.prototype.registerDeactivationHandlers=function(t){var n,i;if(t.type==="keydown")this.adapter.registerInteractionHandler("keyup",this.deactivateHandler);else try{for(var r=O(pe),a=r.next();!a.done;a=r.next()){var s=a.value;this.adapter.registerDocumentInteractionHandler(s,this.deactivateHandler)}}catch(l){n={error:l}}finally{try{a&&!a.done&&(i=r.return)&&i.call(r)}finally{if(n)throw n.error}}},e.prototype.deregisterRootHandlers=function(){var t,n;try{for(var i=O(fe),r=i.next();!r.done;r=i.next()){var a=r.value;this.adapter.deregisterInteractionHandler(a,this.activateHandler)}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}this.adapter.deregisterInteractionHandler("focus",this.focusHandler),this.adapter.deregisterInteractionHandler("blur",this.blurHandler),this.adapter.isUnbounded()&&this.adapter.deregisterResizeHandler(this.resizeHandler)},e.prototype.deregisterDeactivationHandlers=function(){var t,n;this.adapter.deregisterInteractionHandler("keyup",this.deactivateHandler);try{for(var i=O(pe),r=i.next();!r.done;r=i.next()){var a=r.value;this.adapter.deregisterDocumentInteractionHandler(a,this.deactivateHandler)}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}},e.prototype.removeCssVars=function(){var t=this,n=e.strings,i=Object.keys(n);i.forEach(function(r){r.indexOf("VAR_")===0&&t.adapter.updateCssVariable(n[r],null)})},e.prototype.activateImpl=function(t){var n=this;if(!this.adapter.isSurfaceDisabled()){var i=this.activationState;if(!i.isActivated){var r=this.previousActivationEvent,a=r&&t!==void 0&&r.type!==t.type;if(!a){i.isActivated=!0,i.isProgrammatic=t===void 0,i.activationEvent=t,i.wasActivatedByPointer=i.isProgrammatic?!1:t!==void 0&&(t.type==="mousedown"||t.type==="touchstart"||t.type==="pointerdown");var s=t!==void 0&&Gt.length>0&&Gt.some(function(l){return n.adapter.containsEventTarget(l)});if(s){this.resetActivationState();return}t!==void 0&&(Gt.push(t.target),this.registerDeactivationHandlers(t)),i.wasElementMadeActive=this.checkElementMadeActive(t),i.wasElementMadeActive&&this.animateActivation(),requestAnimationFrame(function(){Gt=[],!i.wasElementMadeActive&&t!==void 0&&(t.key===" "||t.keyCode===32)&&(i.wasElementMadeActive=n.checkElementMadeActive(t),i.wasElementMadeActive&&n.animateActivation()),i.wasElementMadeActive||(n.activationState=n.defaultActivationState())})}}}},e.prototype.checkElementMadeActive=function(t){return t!==void 0&&t.type==="keydown"?this.adapter.isSurfaceActive():!0},e.prototype.animateActivation=function(){var t=this,n=e.strings,i=n.VAR_FG_TRANSLATE_START,r=n.VAR_FG_TRANSLATE_END,a=e.cssClasses,s=a.FG_DEACTIVATION,l=a.FG_ACTIVATION,u=e.numbers.DEACTIVATION_TIMEOUT_MS;this.layoutInternal();var d="",h="";if(!this.adapter.isUnbounded()){var p=this.getFgTranslationCoordinates(),c=p.startPoint,E=p.endPoint;d=c.x+"px, "+c.y+"px",h=E.x+"px, "+E.y+"px"}this.adapter.updateCssVariable(i,d),this.adapter.updateCssVariable(r,h),clearTimeout(this.activationTimer),clearTimeout(this.fgDeactivationRemovalTimer),this.rmBoundedActivationClasses(),this.adapter.removeClass(s),this.adapter.computeBoundingRect(),this.adapter.addClass(l),this.activationTimer=setTimeout(function(){t.activationTimerCallback()},u)},e.prototype.getFgTranslationCoordinates=function(){var t=this.activationState,n=t.activationEvent,i=t.wasActivatedByPointer,r;i?r=cn(n,this.adapter.getWindowPageOffset(),this.adapter.computeBoundingRect()):r={x:this.frame.width/2,y:this.frame.height/2},r={x:r.x-this.initialSize/2,y:r.y-this.initialSize/2};var a={x:this.frame.width/2-this.initialSize/2,y:this.frame.height/2-this.initialSize/2};return{startPoint:r,endPoint:a}},e.prototype.runDeactivationUXLogicIfReady=function(){var t=this,n=e.cssClasses.FG_DEACTIVATION,i=this.activationState,r=i.hasDeactivationUXRun,a=i.isActivated,s=r||!a;s&&this.activationAnimationHasEnded&&(this.rmBoundedActivationClasses(),this.adapter.addClass(n),this.fgDeactivationRemovalTimer=setTimeout(function(){t.adapter.removeClass(n)},he.FG_DEACTIVATION_MS))},e.prototype.rmBoundedActivationClasses=function(){var t=e.cssClasses.FG_ACTIVATION;this.adapter.removeClass(t),this.activationAnimationHasEnded=!1,this.adapter.computeBoundingRect()},e.prototype.resetActivationState=function(){var t=this;this.previousActivationEvent=this.activationState.activationEvent,this.activationState=this.defaultActivationState(),setTimeout(function(){return t.previousActivationEvent=void 0},e.numbers.TAP_DELAY_MS)},e.prototype.deactivateImpl=function(){var t=this,n=this.activationState;if(n.isActivated){var i=f({},n);n.isProgrammatic?(requestAnimationFrame(function(){t.animateDeactivation(i)}),this.resetActivationState()):(this.deregisterDeactivationHandlers(),requestAnimationFrame(function(){t.activationState.hasDeactivationUXRun=!0,t.animateDeactivation(i),t.resetActivationState()}))}},e.prototype.animateDeactivation=function(t){var n=t.wasActivatedByPointer,i=t.wasElementMadeActive;(n||i)&&this.runDeactivationUXLogicIfReady()},e.prototype.layoutInternal=function(){var t=this;this.frame=this.adapter.computeBoundingRect();var n=Math.max(this.frame.height,this.frame.width),i=function(){var a=Math.sqrt(Math.pow(t.frame.width,2)+Math.pow(t.frame.height,2));return a+e.numbers.PADDING};this.maxRadius=this.adapter.isUnbounded()?n:i();var r=Math.floor(n*e.numbers.INITIAL_ORIGIN_SCALE);this.adapter.isUnbounded()&&r%2!==0?this.initialSize=r-1:this.initialSize=r,this.fgScale=""+this.maxRadius/this.initialSize,this.updateLayoutCssVars()},e.prototype.updateLayoutCssVars=function(){var t=e.strings,n=t.VAR_FG_SIZE,i=t.VAR_LEFT,r=t.VAR_TOP,a=t.VAR_FG_SCALE;this.adapter.updateCssVariable(n,this.initialSize+"px"),this.adapter.updateCssVariable(a,this.fgScale),this.adapter.isUnbounded()&&(this.unboundedCoords={left:Math.round(this.frame.width/2-this.initialSize/2),top:Math.round(this.frame.height/2-this.initialSize/2)},this.adapter.updateCssVariable(i,this.unboundedCoords.left+"px"),this.adapter.updateCssVariable(r,this.unboundedCoords.top+"px"))},e}(D);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var U=function(o){v(e,o);function e(){var t=o!==null&&o.apply(this,arguments)||this;return t.disabled=!1,t}return e.attachTo=function(t,n){n===void 0&&(n={isUnbounded:void 0});var i=new e(t);return n.isUnbounded!==void 0&&(i.unbounded=n.isUnbounded),i},e.createAdapter=function(t){return{addClass:function(n){return t.root.classList.add(n)},browserSupportsCssVars:function(){return dn(window)},computeBoundingRect:function(){return t.root.getBoundingClientRect()},containsEventTarget:function(n){return t.root.contains(n)},deregisterDocumentInteractionHandler:function(n,i){return document.documentElement.removeEventListener(n,i,Q())},deregisterInteractionHandler:function(n,i){return t.root.removeEventListener(n,i,Q())},deregisterResizeHandler:function(n){return window.removeEventListener("resize",n)},getWindowPageOffset:function(){return{x:window.pageXOffset,y:window.pageYOffset}},isSurfaceActive:function(){return rt(t.root,":active")},isSurfaceDisabled:function(){return Boolean(t.disabled)},isUnbounded:function(){return Boolean(t.unbounded)},registerDocumentInteractionHandler:function(n,i){return document.documentElement.addEventListener(n,i,Q())},registerInteractionHandler:function(n,i){return t.root.addEventListener(n,i,Q())},registerResizeHandler:function(n){return window.addEventListener("resize",n)},removeClass:function(n){return t.root.classList.remove(n)},updateCssVariable:function(n,i){return t.root.style.setProperty(n,i)}}},Object.defineProperty(e.prototype,"unbounded",{get:function(){return Boolean(this.isUnbounded)},set:function(t){this.isUnbounded=Boolean(t),this.setUnbounded()},enumerable:!1,configurable:!0}),e.prototype.activate=function(){this.foundation.activate()},e.prototype.deactivate=function(){this.foundation.deactivate()},e.prototype.layout=function(){this.foundation.layout()},e.prototype.getDefaultFoundation=function(){return new bt(e.createAdapter(this))},e.prototype.initialSyncWithDOM=function(){var t=this.root;this.isUnbounded="mdcRippleIsUnbounded"in t.dataset},e.prototype.setUnbounded=function(){this.foundation.setUnbounded(Boolean(this.isUnbounded))},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Cn={LABEL_FLOAT_ABOVE:"mdc-floating-label--float-above",LABEL_REQUIRED:"mdc-floating-label--required",LABEL_SHAKE:"mdc-floating-label--shake",ROOT:"mdc-floating-label"};/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var We=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.shakeAnimationEndHandler=function(){n.handleShakeAnimationEnd()},n}return Object.defineProperty(e,"cssClasses",{get:function(){return Cn},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},getWidth:function(){return 0},registerInteractionHandler:function(){},deregisterInteractionHandler:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){this.adapter.registerInteractionHandler("animationend",this.shakeAnimationEndHandler)},e.prototype.destroy=function(){this.adapter.deregisterInteractionHandler("animationend",this.shakeAnimationEndHandler)},e.prototype.getWidth=function(){return this.adapter.getWidth()},e.prototype.shake=function(t){var n=e.cssClasses.LABEL_SHAKE;t?this.adapter.addClass(n):this.adapter.removeClass(n)},e.prototype.float=function(t){var n=e.cssClasses,i=n.LABEL_FLOAT_ABOVE,r=n.LABEL_SHAKE;t?this.adapter.addClass(i):(this.adapter.removeClass(i),this.adapter.removeClass(r))},e.prototype.setRequired=function(t){var n=e.cssClasses.LABEL_REQUIRED;t?this.adapter.addClass(n):this.adapter.removeClass(n)},e.prototype.handleShakeAnimationEnd=function(){var t=e.cssClasses.LABEL_SHAKE;this.adapter.removeClass(t)},e}(D);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ke=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.shake=function(t){this.foundation.shake(t)},e.prototype.float=function(t){this.foundation.float(t)},e.prototype.setRequired=function(t){this.foundation.setRequired(t)},e.prototype.getWidth=function(){return this.foundation.getWidth()},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},removeClass:function(i){return t.root.classList.remove(i)},getWidth:function(){return En(t.root)},registerInteractionHandler:function(i,r){return t.listen(i,r)},deregisterInteractionHandler:function(i,r){return t.unlisten(i,r)}};return new We(n)},e}(x);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var ft={LINE_RIPPLE_ACTIVE:"mdc-line-ripple--active",LINE_RIPPLE_DEACTIVATING:"mdc-line-ripple--deactivating"};/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var gn=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.transitionEndHandler=function(i){n.handleTransitionEnd(i)},n}return Object.defineProperty(e,"cssClasses",{get:function(){return ft},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},hasClass:function(){return!1},setStyle:function(){},registerEventHandler:function(){},deregisterEventHandler:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){this.adapter.registerEventHandler("transitionend",this.transitionEndHandler)},e.prototype.destroy=function(){this.adapter.deregisterEventHandler("transitionend",this.transitionEndHandler)},e.prototype.activate=function(){this.adapter.removeClass(ft.LINE_RIPPLE_DEACTIVATING),this.adapter.addClass(ft.LINE_RIPPLE_ACTIVE)},e.prototype.setRippleCenter=function(t){this.adapter.setStyle("transform-origin",t+"px center")},e.prototype.deactivate=function(){this.adapter.addClass(ft.LINE_RIPPLE_DEACTIVATING)},e.prototype.handleTransitionEnd=function(t){var n=this.adapter.hasClass(ft.LINE_RIPPLE_DEACTIVATING);t.propertyName==="opacity"&&n&&(this.adapter.removeClass(ft.LINE_RIPPLE_ACTIVE),this.adapter.removeClass(ft.LINE_RIPPLE_DEACTIVATING))},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var qe=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.activate=function(){this.foundation.activate()},e.prototype.deactivate=function(){this.foundation.deactivate()},e.prototype.setRippleCenter=function(t){this.foundation.setRippleCenter(t)},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},removeClass:function(i){return t.root.classList.remove(i)},hasClass:function(i){return t.root.classList.contains(i)},setStyle:function(i,r){return t.root.style.setProperty(i,r)},registerEventHandler:function(i,r){return t.listen(i,r)},deregisterEventHandler:function(i,r){return t.unlisten(i,r)}};return new gn(n)},e}(x);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var je={NOTCH_ELEMENT_SELECTOR:".mdc-notched-outline__notch"},Ee={NOTCH_ELEMENT_PADDING:8},ae={NO_LABEL:"mdc-notched-outline--no-label",OUTLINE_NOTCHED:"mdc-notched-outline--notched",OUTLINE_UPGRADED:"mdc-notched-outline--upgraded"};/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Tn=function(o){v(e,o);function e(t){return o.call(this,f(f({},e.defaultAdapter),t))||this}return Object.defineProperty(e,"strings",{get:function(){return je},enumerable:!1,configurable:!0}),Object.defineProperty(e,"cssClasses",{get:function(){return ae},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return Ee},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},setNotchWidthProperty:function(){},removeNotchWidthProperty:function(){}}},enumerable:!1,configurable:!0}),e.prototype.notch=function(t){var n=e.cssClasses.OUTLINE_NOTCHED;t>0&&(t+=Ee.NOTCH_ELEMENT_PADDING),this.adapter.setNotchWidthProperty(t),this.adapter.addClass(n)},e.prototype.closeNotch=function(){var t=e.cssClasses.OUTLINE_NOTCHED;this.adapter.removeClass(t),this.adapter.removeNotchWidthProperty()},e}(D);/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Xe=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.initialSyncWithDOM=function(){this.notchElement=this.root.querySelector(je.NOTCH_ELEMENT_SELECTOR);var t=this.root.querySelector("."+We.cssClasses.ROOT);t?(t.style.transitionDuration="0s",this.root.classList.add(ae.OUTLINE_UPGRADED),requestAnimationFrame(function(){t.style.transitionDuration=""})):this.root.classList.add(ae.NO_LABEL)},e.prototype.notch=function(t){this.foundation.notch(t)},e.prototype.closeNotch=function(){this.foundation.closeNotch()},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},removeClass:function(i){return t.root.classList.remove(i)},setNotchWidthProperty:function(i){t.notchElement.style.setProperty("width",i+"px")},removeNotchWidthProperty:function(){t.notchElement.style.removeProperty("width")}};return new Tn(n)},e}(x);/**
 * @license
 * Copyright 2019 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var ze={ROOT:"mdc-text-field-character-counter"},vn={ROOT_SELECTOR:"."+ze.ROOT};/**
 * @license
 * Copyright 2019 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var $e=function(o){v(e,o);function e(t){return o.call(this,f(f({},e.defaultAdapter),t))||this}return Object.defineProperty(e,"cssClasses",{get:function(){return ze},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return vn},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{setContent:function(){}}},enumerable:!1,configurable:!0}),e.prototype.setCounterValue=function(t,n){t=Math.min(t,n),this.adapter.setContent(t+" / "+n)},e}(D);/**
 * @license
 * Copyright 2019 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var In=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},Object.defineProperty(e.prototype,"foundationForTextField",{get:function(){return this.foundation},enumerable:!1,configurable:!0}),e.prototype.getDefaultFoundation=function(){var t=this,n={setContent:function(i){t.root.textContent=i}};return new $e(n)},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var tt={ARIA_CONTROLS:"aria-controls",ARIA_DESCRIBEDBY:"aria-describedby",INPUT_SELECTOR:".mdc-text-field__input",LABEL_SELECTOR:".mdc-floating-label",LEADING_ICON_SELECTOR:".mdc-text-field__icon--leading",LINE_RIPPLE_SELECTOR:".mdc-line-ripple",OUTLINE_SELECTOR:".mdc-notched-outline",PREFIX_SELECTOR:".mdc-text-field__affix--prefix",SUFFIX_SELECTOR:".mdc-text-field__affix--suffix",TRAILING_ICON_SELECTOR:".mdc-text-field__icon--trailing"},zt={DISABLED:"mdc-text-field--disabled",FOCUSED:"mdc-text-field--focused",HELPER_LINE:"mdc-text-field-helper-line",INVALID:"mdc-text-field--invalid",LABEL_FLOATING:"mdc-text-field--label-floating",NO_LABEL:"mdc-text-field--no-label",OUTLINED:"mdc-text-field--outlined",ROOT:"mdc-text-field",TEXTAREA:"mdc-text-field--textarea",WITH_LEADING_ICON:"mdc-text-field--with-leading-icon",WITH_TRAILING_ICON:"mdc-text-field--with-trailing-icon",WITH_INTERNAL_COUNTER:"mdc-text-field--with-internal-counter"},me={LABEL_SCALE:.75},yn=["pattern","min","max","required","step","minlength","maxlength"],Sn=["color","date","datetime-local","month","range","time","week"];/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ae=["mousedown","touchstart"],Ce=["click","keydown"],On=function(o){v(e,o);function e(t,n){n===void 0&&(n={});var i=o.call(this,f(f({},e.defaultAdapter),t))||this;return i.isFocused=!1,i.receivedUserInput=!1,i.valid=!0,i.useNativeValidation=!0,i.validateOnValueChange=!0,i.helperText=n.helperText,i.characterCounter=n.characterCounter,i.leadingIcon=n.leadingIcon,i.trailingIcon=n.trailingIcon,i.inputFocusHandler=function(){i.activateFocus()},i.inputBlurHandler=function(){i.deactivateFocus()},i.inputInputHandler=function(){i.handleInput()},i.setPointerXOffset=function(r){i.setTransformOrigin(r)},i.textFieldInteractionHandler=function(){i.handleTextFieldInteraction()},i.validationAttributeChangeHandler=function(r){i.handleValidationAttributeChange(r)},i}return Object.defineProperty(e,"cssClasses",{get:function(){return zt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return tt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return me},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"shouldAlwaysFloat",{get:function(){var t=this.getNativeInput().type;return Sn.indexOf(t)>=0},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"shouldFloat",{get:function(){return this.shouldAlwaysFloat||this.isFocused||!!this.getValue()||this.isBadInput()},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"shouldShake",{get:function(){return!this.isFocused&&!this.isValid()&&!!this.getValue()},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},hasClass:function(){return!0},setInputAttr:function(){},removeInputAttr:function(){},registerTextFieldInteractionHandler:function(){},deregisterTextFieldInteractionHandler:function(){},registerInputInteractionHandler:function(){},deregisterInputInteractionHandler:function(){},registerValidationAttributeChangeHandler:function(){return new MutationObserver(function(){})},deregisterValidationAttributeChangeHandler:function(){},getNativeInput:function(){return null},isFocused:function(){return!1},activateLineRipple:function(){},deactivateLineRipple:function(){},setLineRippleTransformOrigin:function(){},shakeLabel:function(){},floatLabel:function(){},setLabelRequired:function(){},hasLabel:function(){return!1},getLabelWidth:function(){return 0},hasOutline:function(){return!1},notchOutline:function(){},closeOutline:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){var t,n,i,r;this.adapter.hasLabel()&&this.getNativeInput().required&&this.adapter.setLabelRequired(!0),this.adapter.isFocused()?this.inputFocusHandler():this.adapter.hasLabel()&&this.shouldFloat&&(this.notchOutline(!0),this.adapter.floatLabel(!0),this.styleFloating(!0)),this.adapter.registerInputInteractionHandler("focus",this.inputFocusHandler),this.adapter.registerInputInteractionHandler("blur",this.inputBlurHandler),this.adapter.registerInputInteractionHandler("input",this.inputInputHandler);try{for(var a=O(Ae),s=a.next();!s.done;s=a.next()){var l=s.value;this.adapter.registerInputInteractionHandler(l,this.setPointerXOffset)}}catch(h){t={error:h}}finally{try{s&&!s.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}try{for(var u=O(Ce),d=u.next();!d.done;d=u.next()){var l=d.value;this.adapter.registerTextFieldInteractionHandler(l,this.textFieldInteractionHandler)}}catch(h){i={error:h}}finally{try{d&&!d.done&&(r=u.return)&&r.call(u)}finally{if(i)throw i.error}}this.validationObserver=this.adapter.registerValidationAttributeChangeHandler(this.validationAttributeChangeHandler),this.setcharacterCounter(this.getValue().length)},e.prototype.destroy=function(){var t,n,i,r;this.adapter.deregisterInputInteractionHandler("focus",this.inputFocusHandler),this.adapter.deregisterInputInteractionHandler("blur",this.inputBlurHandler),this.adapter.deregisterInputInteractionHandler("input",this.inputInputHandler);try{for(var a=O(Ae),s=a.next();!s.done;s=a.next()){var l=s.value;this.adapter.deregisterInputInteractionHandler(l,this.setPointerXOffset)}}catch(h){t={error:h}}finally{try{s&&!s.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}try{for(var u=O(Ce),d=u.next();!d.done;d=u.next()){var l=d.value;this.adapter.deregisterTextFieldInteractionHandler(l,this.textFieldInteractionHandler)}}catch(h){i={error:h}}finally{try{d&&!d.done&&(r=u.return)&&r.call(u)}finally{if(i)throw i.error}}this.adapter.deregisterValidationAttributeChangeHandler(this.validationObserver)},e.prototype.handleTextFieldInteraction=function(){var t=this.adapter.getNativeInput();t&&t.disabled||(this.receivedUserInput=!0)},e.prototype.handleValidationAttributeChange=function(t){var n=this;t.some(function(i){return yn.indexOf(i)>-1?(n.styleValidity(!0),n.adapter.setLabelRequired(n.getNativeInput().required),!0):!1}),t.indexOf("maxlength")>-1&&this.setcharacterCounter(this.getValue().length)},e.prototype.notchOutline=function(t){if(!(!this.adapter.hasOutline()||!this.adapter.hasLabel()))if(t){var n=this.adapter.getLabelWidth()*me.LABEL_SCALE;this.adapter.notchOutline(n)}else this.adapter.closeOutline()},e.prototype.activateFocus=function(){this.isFocused=!0,this.styleFocused(this.isFocused),this.adapter.activateLineRipple(),this.adapter.hasLabel()&&(this.notchOutline(this.shouldFloat),this.adapter.floatLabel(this.shouldFloat),this.styleFloating(this.shouldFloat),this.adapter.shakeLabel(this.shouldShake)),this.helperText&&(this.helperText.isPersistent()||!this.helperText.isValidation()||!this.valid)&&this.helperText.showToScreenReader()},e.prototype.setTransformOrigin=function(t){if(!(this.isDisabled()||this.adapter.hasOutline())){var n=t.touches,i=n?n[0]:t,r=i.target.getBoundingClientRect(),a=i.clientX-r.left;this.adapter.setLineRippleTransformOrigin(a)}},e.prototype.handleInput=function(){this.autoCompleteFocus(),this.setcharacterCounter(this.getValue().length)},e.prototype.autoCompleteFocus=function(){this.receivedUserInput||this.activateFocus()},e.prototype.deactivateFocus=function(){this.isFocused=!1,this.adapter.deactivateLineRipple();var t=this.isValid();this.styleValidity(t),this.styleFocused(this.isFocused),this.adapter.hasLabel()&&(this.notchOutline(this.shouldFloat),this.adapter.floatLabel(this.shouldFloat),this.styleFloating(this.shouldFloat),this.adapter.shakeLabel(this.shouldShake)),this.shouldFloat||(this.receivedUserInput=!1)},e.prototype.getValue=function(){return this.getNativeInput().value},e.prototype.setValue=function(t){if(this.getValue()!==t&&(this.getNativeInput().value=t),this.setcharacterCounter(t.length),this.validateOnValueChange){var n=this.isValid();this.styleValidity(n)}this.adapter.hasLabel()&&(this.notchOutline(this.shouldFloat),this.adapter.floatLabel(this.shouldFloat),this.styleFloating(this.shouldFloat),this.validateOnValueChange&&this.adapter.shakeLabel(this.shouldShake))},e.prototype.isValid=function(){return this.useNativeValidation?this.isNativeInputValid():this.valid},e.prototype.setValid=function(t){this.valid=t,this.styleValidity(t);var n=!t&&!this.isFocused&&!!this.getValue();this.adapter.hasLabel()&&this.adapter.shakeLabel(n)},e.prototype.setValidateOnValueChange=function(t){this.validateOnValueChange=t},e.prototype.getValidateOnValueChange=function(){return this.validateOnValueChange},e.prototype.setUseNativeValidation=function(t){this.useNativeValidation=t},e.prototype.isDisabled=function(){return this.getNativeInput().disabled},e.prototype.setDisabled=function(t){this.getNativeInput().disabled=t,this.styleDisabled(t)},e.prototype.setHelperTextContent=function(t){this.helperText&&this.helperText.setContent(t)},e.prototype.setLeadingIconAriaLabel=function(t){this.leadingIcon&&this.leadingIcon.setAriaLabel(t)},e.prototype.setLeadingIconContent=function(t){this.leadingIcon&&this.leadingIcon.setContent(t)},e.prototype.setTrailingIconAriaLabel=function(t){this.trailingIcon&&this.trailingIcon.setAriaLabel(t)},e.prototype.setTrailingIconContent=function(t){this.trailingIcon&&this.trailingIcon.setContent(t)},e.prototype.setcharacterCounter=function(t){if(this.characterCounter){var n=this.getNativeInput().maxLength;if(n===-1)throw new Error("MDCTextFieldFoundation: Expected maxlength html property on text input or textarea.");this.characterCounter.setCounterValue(t,n)}},e.prototype.isBadInput=function(){return this.getNativeInput().validity.badInput||!1},e.prototype.isNativeInputValid=function(){return this.getNativeInput().validity.valid},e.prototype.styleValidity=function(t){var n=e.cssClasses.INVALID;if(t?this.adapter.removeClass(n):this.adapter.addClass(n),this.helperText){this.helperText.setValidity(t);var i=this.helperText.isValidation();if(!i)return;var r=this.helperText.isVisible(),a=this.helperText.getId();r&&a?this.adapter.setInputAttr(tt.ARIA_DESCRIBEDBY,a):this.adapter.removeInputAttr(tt.ARIA_DESCRIBEDBY)}},e.prototype.styleFocused=function(t){var n=e.cssClasses.FOCUSED;t?this.adapter.addClass(n):this.adapter.removeClass(n)},e.prototype.styleDisabled=function(t){var n=e.cssClasses,i=n.DISABLED,r=n.INVALID;t?(this.adapter.addClass(i),this.adapter.removeClass(r)):this.adapter.removeClass(i),this.leadingIcon&&this.leadingIcon.setDisabled(t),this.trailingIcon&&this.trailingIcon.setDisabled(t)},e.prototype.styleFloating=function(t){var n=e.cssClasses.LABEL_FLOATING;t?this.adapter.addClass(n):this.adapter.removeClass(n)},e.prototype.getNativeInput=function(){var t=this.adapter?this.adapter.getNativeInput():null;return t||{disabled:!1,maxLength:-1,required:!1,type:"input",validity:{badInput:!1,valid:!0},value:""}},e}(D);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var nt={HELPER_TEXT_PERSISTENT:"mdc-text-field-helper-text--persistent",HELPER_TEXT_VALIDATION_MSG:"mdc-text-field-helper-text--validation-msg",ROOT:"mdc-text-field-helper-text"},at={ARIA_HIDDEN:"aria-hidden",ROLE:"role",ROOT_SELECTOR:"."+nt.ROOT};/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ye=function(o){v(e,o);function e(t){return o.call(this,f(f({},e.defaultAdapter),t))||this}return Object.defineProperty(e,"cssClasses",{get:function(){return nt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return at},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},hasClass:function(){return!1},getAttr:function(){return null},setAttr:function(){},removeAttr:function(){},setContent:function(){}}},enumerable:!1,configurable:!0}),e.prototype.getId=function(){return this.adapter.getAttr("id")},e.prototype.isVisible=function(){return this.adapter.getAttr(at.ARIA_HIDDEN)!=="true"},e.prototype.setContent=function(t){this.adapter.setContent(t)},e.prototype.isPersistent=function(){return this.adapter.hasClass(nt.HELPER_TEXT_PERSISTENT)},e.prototype.setPersistent=function(t){t?this.adapter.addClass(nt.HELPER_TEXT_PERSISTENT):this.adapter.removeClass(nt.HELPER_TEXT_PERSISTENT)},e.prototype.isValidation=function(){return this.adapter.hasClass(nt.HELPER_TEXT_VALIDATION_MSG)},e.prototype.setValidation=function(t){t?this.adapter.addClass(nt.HELPER_TEXT_VALIDATION_MSG):this.adapter.removeClass(nt.HELPER_TEXT_VALIDATION_MSG)},e.prototype.showToScreenReader=function(){this.adapter.removeAttr(at.ARIA_HIDDEN)},e.prototype.setValidity=function(t){var n=this.adapter.hasClass(nt.HELPER_TEXT_PERSISTENT),i=this.adapter.hasClass(nt.HELPER_TEXT_VALIDATION_MSG),r=i&&!t;r?(this.showToScreenReader(),this.adapter.getAttr(at.ROLE)==="alert"?this.refreshAlertRole():this.adapter.setAttr(at.ROLE,"alert")):this.adapter.removeAttr(at.ROLE),!n&&!r&&this.hide()},e.prototype.hide=function(){this.adapter.setAttr(at.ARIA_HIDDEN,"true")},e.prototype.refreshAlertRole=function(){var t=this;this.adapter.removeAttr(at.ROLE),requestAnimationFrame(function(){t.adapter.setAttr(at.ROLE,"alert")})},e}(D);/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var bn=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},Object.defineProperty(e.prototype,"foundationForTextField",{get:function(){return this.foundation},enumerable:!1,configurable:!0}),e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},removeClass:function(i){return t.root.classList.remove(i)},hasClass:function(i){return t.root.classList.contains(i)},getAttr:function(i){return t.root.getAttribute(i)},setAttr:function(i,r){return t.root.setAttribute(i,r)},removeAttr:function(i){return t.root.removeAttribute(i)},setContent:function(i){t.root.textContent=i}};return new Ye(n)},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var ge={ICON_EVENT:"MDCTextField:icon",ICON_ROLE:"button"},_n={ROOT:"mdc-text-field__icon"};/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Te=["click","keydown"],ve=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.savedTabIndex=null,n.interactionHandler=function(i){n.handleInteraction(i)},n}return Object.defineProperty(e,"strings",{get:function(){return ge},enumerable:!1,configurable:!0}),Object.defineProperty(e,"cssClasses",{get:function(){return _n},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{getAttr:function(){return null},setAttr:function(){},removeAttr:function(){},setContent:function(){},registerInteractionHandler:function(){},deregisterInteractionHandler:function(){},notifyIconAction:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){var t,n;this.savedTabIndex=this.adapter.getAttr("tabindex");try{for(var i=O(Te),r=i.next();!r.done;r=i.next()){var a=r.value;this.adapter.registerInteractionHandler(a,this.interactionHandler)}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}},e.prototype.destroy=function(){var t,n;try{for(var i=O(Te),r=i.next();!r.done;r=i.next()){var a=r.value;this.adapter.deregisterInteractionHandler(a,this.interactionHandler)}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}},e.prototype.setDisabled=function(t){this.savedTabIndex&&(t?(this.adapter.setAttr("tabindex","-1"),this.adapter.removeAttr("role")):(this.adapter.setAttr("tabindex",this.savedTabIndex),this.adapter.setAttr("role",ge.ICON_ROLE)))},e.prototype.setAriaLabel=function(t){this.adapter.setAttr("aria-label",t)},e.prototype.setContent=function(t){this.adapter.setContent(t)},e.prototype.handleInteraction=function(t){var n=t.key==="Enter"||t.keyCode===13;(t.type==="click"||n)&&(t.preventDefault(),this.adapter.notifyIconAction())},e}(D);/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ln=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},Object.defineProperty(e.prototype,"foundationForTextField",{get:function(){return this.foundation},enumerable:!1,configurable:!0}),e.prototype.getDefaultFoundation=function(){var t=this,n={getAttr:function(i){return t.root.getAttribute(i)},setAttr:function(i,r){return t.root.setAttribute(i,r)},removeAttr:function(i){return t.root.removeAttribute(i)},setContent:function(i){t.root.textContent=i},registerInteractionHandler:function(i,r){return t.listen(i,r)},deregisterInteractionHandler:function(i,r){return t.unlisten(i,r)},notifyIconAction:function(){return t.emit(ve.strings.ICON_EVENT,{},!0)}};return new ve(n)},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Qe=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.initialize=function(t,n,i,r,a,s,l){t===void 0&&(t=function(w,_t){return new U(w,_t)}),n===void 0&&(n=function(w){return new qe(w)}),i===void 0&&(i=function(w){return new bn(w)}),r===void 0&&(r=function(w){return new In(w)}),a===void 0&&(a=function(w){return new Ln(w)}),s===void 0&&(s=function(w){return new Ke(w)}),l===void 0&&(l=function(w){return new Xe(w)}),this.input=this.root.querySelector(tt.INPUT_SELECTOR);var u=this.root.querySelector(tt.LABEL_SELECTOR);this.label=u?s(u):null;var d=this.root.querySelector(tt.LINE_RIPPLE_SELECTOR);this.lineRipple=d?n(d):null;var h=this.root.querySelector(tt.OUTLINE_SELECTOR);this.outline=h?l(h):null;var p=Ye.strings,c=this.root.nextElementSibling,E=c&&c.classList.contains(zt.HELPER_LINE),g=E&&c&&c.querySelector(p.ROOT_SELECTOR);this.helperText=g?i(g):null;var A=$e.strings,T=this.root.querySelector(A.ROOT_SELECTOR);!T&&E&&c&&(T=c.querySelector(A.ROOT_SELECTOR)),this.characterCounter=T?r(T):null;var N=this.root.querySelector(tt.LEADING_ICON_SELECTOR);this.leadingIcon=N?a(N):null;var G=this.root.querySelector(tt.TRAILING_ICON_SELECTOR);this.trailingIcon=G?a(G):null,this.prefix=this.root.querySelector(tt.PREFIX_SELECTOR),this.suffix=this.root.querySelector(tt.SUFFIX_SELECTOR),this.ripple=this.createRipple(t)},e.prototype.destroy=function(){this.ripple&&this.ripple.destroy(),this.lineRipple&&this.lineRipple.destroy(),this.helperText&&this.helperText.destroy(),this.characterCounter&&this.characterCounter.destroy(),this.leadingIcon&&this.leadingIcon.destroy(),this.trailingIcon&&this.trailingIcon.destroy(),this.label&&this.label.destroy(),this.outline&&this.outline.destroy(),o.prototype.destroy.call(this)},e.prototype.initialSyncWithDOM=function(){this.disabled=this.input.disabled},Object.defineProperty(e.prototype,"value",{get:function(){return this.foundation.getValue()},set:function(t){this.foundation.setValue(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"disabled",{get:function(){return this.foundation.isDisabled()},set:function(t){this.foundation.setDisabled(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"valid",{get:function(){return this.foundation.isValid()},set:function(t){this.foundation.setValid(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"required",{get:function(){return this.input.required},set:function(t){this.input.required=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"pattern",{get:function(){return this.input.pattern},set:function(t){this.input.pattern=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"minLength",{get:function(){return this.input.minLength},set:function(t){this.input.minLength=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"maxLength",{get:function(){return this.input.maxLength},set:function(t){t<0?this.input.removeAttribute("maxLength"):this.input.maxLength=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"min",{get:function(){return this.input.min},set:function(t){this.input.min=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"max",{get:function(){return this.input.max},set:function(t){this.input.max=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"step",{get:function(){return this.input.step},set:function(t){this.input.step=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"helperTextContent",{set:function(t){this.foundation.setHelperTextContent(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"leadingIconAriaLabel",{set:function(t){this.foundation.setLeadingIconAriaLabel(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"leadingIconContent",{set:function(t){this.foundation.setLeadingIconContent(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"trailingIconAriaLabel",{set:function(t){this.foundation.setTrailingIconAriaLabel(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"trailingIconContent",{set:function(t){this.foundation.setTrailingIconContent(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"useNativeValidation",{set:function(t){this.foundation.setUseNativeValidation(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"prefixText",{get:function(){return this.prefix?this.prefix.textContent:null},set:function(t){this.prefix&&(this.prefix.textContent=t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"suffixText",{get:function(){return this.suffix?this.suffix.textContent:null},set:function(t){this.suffix&&(this.suffix.textContent=t)},enumerable:!1,configurable:!0}),e.prototype.focus=function(){this.input.focus()},e.prototype.layout=function(){var t=this.foundation.shouldFloat;this.foundation.notchOutline(t)},e.prototype.getDefaultFoundation=function(){var t=f(f(f(f(f({},this.getRootAdapterMethods()),this.getInputAdapterMethods()),this.getLabelAdapterMethods()),this.getLineRippleAdapterMethods()),this.getOutlineAdapterMethods());return new On(t,this.getFoundationMap())},e.prototype.getRootAdapterMethods=function(){var t=this;return{addClass:function(n){return t.root.classList.add(n)},removeClass:function(n){return t.root.classList.remove(n)},hasClass:function(n){return t.root.classList.contains(n)},registerTextFieldInteractionHandler:function(n,i){t.listen(n,i)},deregisterTextFieldInteractionHandler:function(n,i){t.unlisten(n,i)},registerValidationAttributeChangeHandler:function(n){var i=function(s){return s.map(function(l){return l.attributeName}).filter(function(l){return l})},r=new MutationObserver(function(s){return n(i(s))}),a={attributes:!0};return r.observe(t.input,a),r},deregisterValidationAttributeChangeHandler:function(n){n.disconnect()}}},e.prototype.getInputAdapterMethods=function(){var t=this;return{getNativeInput:function(){return t.input},setInputAttr:function(n,i){t.input.setAttribute(n,i)},removeInputAttr:function(n){t.input.removeAttribute(n)},isFocused:function(){return document.activeElement===t.input},registerInputInteractionHandler:function(n,i){t.input.addEventListener(n,i,Q())},deregisterInputInteractionHandler:function(n,i){t.input.removeEventListener(n,i,Q())}}},e.prototype.getLabelAdapterMethods=function(){var t=this;return{floatLabel:function(n){t.label&&t.label.float(n)},getLabelWidth:function(){return t.label?t.label.getWidth():0},hasLabel:function(){return Boolean(t.label)},shakeLabel:function(n){t.label&&t.label.shake(n)},setLabelRequired:function(n){t.label&&t.label.setRequired(n)}}},e.prototype.getLineRippleAdapterMethods=function(){var t=this;return{activateLineRipple:function(){t.lineRipple&&t.lineRipple.activate()},deactivateLineRipple:function(){t.lineRipple&&t.lineRipple.deactivate()},setLineRippleTransformOrigin:function(n){t.lineRipple&&t.lineRipple.setRippleCenter(n)}}},e.prototype.getOutlineAdapterMethods=function(){var t=this;return{closeOutline:function(){t.outline&&t.outline.closeNotch()},hasOutline:function(){return Boolean(t.outline)},notchOutline:function(n){t.outline&&t.outline.notch(n)}}},e.prototype.getFoundationMap=function(){return{characterCounter:this.characterCounter?this.characterCounter.foundationForTextField:void 0,helperText:this.helperText?this.helperText.foundationForTextField:void 0,leadingIcon:this.leadingIcon?this.leadingIcon.foundationForTextField:void 0,trailingIcon:this.trailingIcon?this.trailingIcon.foundationForTextField:void 0}},e.prototype.createRipple=function(t){var n=this,i=this.root.classList.contains(zt.TEXTAREA),r=this.root.classList.contains(zt.OUTLINED);if(i||r)return null;var a=f(f({},U.createAdapter(this)),{isSurfaceActive:function(){return rt(n.input,":active")},registerInteractionHandler:function(s,l){n.input.addEventListener(s,l,Q())},deregisterInteractionHandler:function(s,l){n.input.removeEventListener(s,l,Q())}});return t(this.root,new bt(a))},e}(x);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Wt={ICON_BUTTON_ON:"mdc-icon-button--on",ROOT:"mdc-icon-button"},st={ARIA_LABEL:"aria-label",ARIA_PRESSED:"aria-pressed",DATA_ARIA_LABEL_OFF:"data-aria-label-off",DATA_ARIA_LABEL_ON:"data-aria-label-on",CHANGE_EVENT:"MDCIconButtonToggle:change"};/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ze=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.hasToggledAriaLabel=!1,n}return Object.defineProperty(e,"cssClasses",{get:function(){return Wt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return st},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},hasClass:function(){return!1},notifyChange:function(){},removeClass:function(){},getAttr:function(){return null},setAttr:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){var t=this.adapter.getAttr(st.DATA_ARIA_LABEL_ON),n=this.adapter.getAttr(st.DATA_ARIA_LABEL_OFF);if(t&&n){if(this.adapter.getAttr(st.ARIA_PRESSED)!==null)throw new Error("MDCIconButtonToggleFoundation: Button should not set `aria-pressed` if it has a toggled aria label.");this.hasToggledAriaLabel=!0}else this.adapter.setAttr(st.ARIA_PRESSED,String(this.isOn()))},e.prototype.handleClick=function(){this.toggle(),this.adapter.notifyChange({isOn:this.isOn()})},e.prototype.isOn=function(){return this.adapter.hasClass(Wt.ICON_BUTTON_ON)},e.prototype.toggle=function(t){if(t===void 0&&(t=!this.isOn()),t?this.adapter.addClass(Wt.ICON_BUTTON_ON):this.adapter.removeClass(Wt.ICON_BUTTON_ON),this.hasToggledAriaLabel){var n=t?this.adapter.getAttr(st.DATA_ARIA_LABEL_ON):this.adapter.getAttr(st.DATA_ARIA_LABEL_OFF);this.adapter.setAttr(st.ARIA_LABEL,n||"")}else this.adapter.setAttr(st.ARIA_PRESSED,""+t)},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Rn=Ze.strings,Dn=function(o){v(e,o);function e(){var t=o!==null&&o.apply(this,arguments)||this;return t.rippleComponent=t.createRipple(),t}return e.attachTo=function(t){return new e(t)},e.prototype.initialSyncWithDOM=function(){var t=this;this.handleClick=function(){t.foundation.handleClick()},this.listen("click",this.handleClick)},e.prototype.destroy=function(){this.unlisten("click",this.handleClick),this.ripple.destroy(),o.prototype.destroy.call(this)},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},hasClass:function(i){return t.root.classList.contains(i)},notifyChange:function(i){t.emit(Rn.CHANGE_EVENT,i)},removeClass:function(i){return t.root.classList.remove(i)},getAttr:function(i){return t.root.getAttribute(i)},setAttr:function(i,r){return t.root.setAttribute(i,r)}};return new Ze(n)},Object.defineProperty(e.prototype,"ripple",{get:function(){return this.rippleComponent},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"on",{get:function(){return this.foundation.isOn()},set:function(t){this.foundation.toggle(t)},enumerable:!1,configurable:!0}),e.prototype.createRipple=function(){var t=new U(this.root);return t.unbounded=!0,t},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ie={animation:{prefixed:"-webkit-animation",standard:"animation"},transform:{prefixed:"-webkit-transform",standard:"transform"},transition:{prefixed:"-webkit-transition",standard:"transition"}},ye={animationend:{cssProperty:"animation",prefixed:"webkitAnimationEnd",standard:"animationend"},animationiteration:{cssProperty:"animation",prefixed:"webkitAnimationIteration",standard:"animationiteration"},animationstart:{cssProperty:"animation",prefixed:"webkitAnimationStart",standard:"animationstart"},transitionend:{cssProperty:"transition",prefixed:"webkitTransitionEnd",standard:"transitionend"}};function Je(o){return Boolean(o.document)&&typeof o.document.createElement=="function"}function Yt(o,e){if(Je(o)&&e in Ie){var t=o.document.createElement("div"),n=Ie[e],i=n.standard,r=n.prefixed,a=i in t.style;return a?i:r}return e}function Se(o,e){if(Je(o)&&e in ye){var t=o.document.createElement("div"),n=ye[e],i=n.standard,r=n.prefixed,a=n.cssProperty,s=a in t.style;return s?i:r}return e}/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Dt={ANIM_CHECKED_INDETERMINATE:"mdc-checkbox--anim-checked-indeterminate",ANIM_CHECKED_UNCHECKED:"mdc-checkbox--anim-checked-unchecked",ANIM_INDETERMINATE_CHECKED:"mdc-checkbox--anim-indeterminate-checked",ANIM_INDETERMINATE_UNCHECKED:"mdc-checkbox--anim-indeterminate-unchecked",ANIM_UNCHECKED_CHECKED:"mdc-checkbox--anim-unchecked-checked",ANIM_UNCHECKED_INDETERMINATE:"mdc-checkbox--anim-unchecked-indeterminate",BACKGROUND:"mdc-checkbox__background",CHECKED:"mdc-checkbox--checked",CHECKMARK:"mdc-checkbox__checkmark",CHECKMARK_PATH:"mdc-checkbox__checkmark-path",DISABLED:"mdc-checkbox--disabled",INDETERMINATE:"mdc-checkbox--indeterminate",MIXEDMARK:"mdc-checkbox__mixedmark",NATIVE_CONTROL:"mdc-checkbox__native-control",ROOT:"mdc-checkbox",SELECTED:"mdc-checkbox--selected",UPGRADED:"mdc-checkbox--upgraded"},z={ARIA_CHECKED_ATTR:"aria-checked",ARIA_CHECKED_INDETERMINATE_VALUE:"mixed",DATA_INDETERMINATE_ATTR:"data-indeterminate",NATIVE_CONTROL_SELECTOR:".mdc-checkbox__native-control",TRANSITION_STATE_CHECKED:"checked",TRANSITION_STATE_INDETERMINATE:"indeterminate",TRANSITION_STATE_INIT:"init",TRANSITION_STATE_UNCHECKED:"unchecked"},Oe={ANIM_END_LATCH_MS:250};/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var xn=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.currentCheckState=z.TRANSITION_STATE_INIT,n.currentAnimationClass="",n.animEndLatchTimer=0,n.enableAnimationEndHandler=!1,n}return Object.defineProperty(e,"cssClasses",{get:function(){return Dt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return z},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return Oe},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},forceLayout:function(){},hasNativeControl:function(){return!1},isAttachedToDOM:function(){return!1},isChecked:function(){return!1},isIndeterminate:function(){return!1},removeClass:function(){},removeNativeControlAttr:function(){},setNativeControlAttr:function(){},setNativeControlDisabled:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){this.currentCheckState=this.determineCheckState(),this.updateAriaChecked(),this.adapter.addClass(Dt.UPGRADED)},e.prototype.destroy=function(){clearTimeout(this.animEndLatchTimer)},e.prototype.setDisabled=function(t){this.adapter.setNativeControlDisabled(t),t?this.adapter.addClass(Dt.DISABLED):this.adapter.removeClass(Dt.DISABLED)},e.prototype.handleAnimationEnd=function(){var t=this;this.enableAnimationEndHandler&&(clearTimeout(this.animEndLatchTimer),this.animEndLatchTimer=setTimeout(function(){t.adapter.removeClass(t.currentAnimationClass),t.enableAnimationEndHandler=!1},Oe.ANIM_END_LATCH_MS))},e.prototype.handleChange=function(){this.transitionCheckState()},e.prototype.transitionCheckState=function(){if(this.adapter.hasNativeControl()){var t=this.currentCheckState,n=this.determineCheckState();if(t!==n){this.updateAriaChecked();var i=z.TRANSITION_STATE_UNCHECKED,r=Dt.SELECTED;n===i?this.adapter.removeClass(r):this.adapter.addClass(r),this.currentAnimationClass.length>0&&(clearTimeout(this.animEndLatchTimer),this.adapter.forceLayout(),this.adapter.removeClass(this.currentAnimationClass)),this.currentAnimationClass=this.getTransitionAnimationClass(t,n),this.currentCheckState=n,this.adapter.isAttachedToDOM()&&this.currentAnimationClass.length>0&&(this.adapter.addClass(this.currentAnimationClass),this.enableAnimationEndHandler=!0)}}},e.prototype.determineCheckState=function(){var t=z.TRANSITION_STATE_INDETERMINATE,n=z.TRANSITION_STATE_CHECKED,i=z.TRANSITION_STATE_UNCHECKED;return this.adapter.isIndeterminate()?t:this.adapter.isChecked()?n:i},e.prototype.getTransitionAnimationClass=function(t,n){var i=z.TRANSITION_STATE_INIT,r=z.TRANSITION_STATE_CHECKED,a=z.TRANSITION_STATE_UNCHECKED,s=e.cssClasses,l=s.ANIM_UNCHECKED_CHECKED,u=s.ANIM_UNCHECKED_INDETERMINATE,d=s.ANIM_CHECKED_UNCHECKED,h=s.ANIM_CHECKED_INDETERMINATE,p=s.ANIM_INDETERMINATE_CHECKED,c=s.ANIM_INDETERMINATE_UNCHECKED;switch(t){case i:return n===a?"":n===r?p:c;case a:return n===r?l:u;case r:return n===a?d:h;default:return n===r?p:c}},e.prototype.updateAriaChecked=function(){this.adapter.isIndeterminate()?this.adapter.setNativeControlAttr(z.ARIA_CHECKED_ATTR,z.ARIA_CHECKED_INDETERMINATE_VALUE):this.adapter.removeNativeControlAttr(z.ARIA_CHECKED_ATTR)},e}(D);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var be=["checked","indeterminate"],tn=function(o){v(e,o);function e(){var t=o!==null&&o.apply(this,arguments)||this;return t.rippleSurface=t.createRipple(),t}return e.attachTo=function(t){return new e(t)},Object.defineProperty(e.prototype,"ripple",{get:function(){return this.rippleSurface},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"checked",{get:function(){return this.getNativeControl().checked},set:function(t){this.getNativeControl().checked=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"indeterminate",{get:function(){return this.getNativeControl().indeterminate},set:function(t){this.getNativeControl().indeterminate=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"disabled",{get:function(){return this.getNativeControl().disabled},set:function(t){this.foundation.setDisabled(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"value",{get:function(){return this.getNativeControl().value},set:function(t){this.getNativeControl().value=t},enumerable:!1,configurable:!0}),e.prototype.initialize=function(){var t=z.DATA_INDETERMINATE_ATTR;this.getNativeControl().indeterminate=this.getNativeControl().getAttribute(t)==="true",this.getNativeControl().removeAttribute(t)},e.prototype.initialSyncWithDOM=function(){var t=this;this.handleChange=function(){t.foundation.handleChange()},this.handleAnimationEnd=function(){t.foundation.handleAnimationEnd()},this.getNativeControl().addEventListener("change",this.handleChange),this.listen(Se(window,"animationend"),this.handleAnimationEnd),this.installPropertyChangeHooks()},e.prototype.destroy=function(){this.rippleSurface.destroy(),this.getNativeControl().removeEventListener("change",this.handleChange),this.unlisten(Se(window,"animationend"),this.handleAnimationEnd),this.uninstallPropertyChangeHooks(),o.prototype.destroy.call(this)},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},forceLayout:function(){return t.root.offsetWidth},hasNativeControl:function(){return!!t.getNativeControl()},isAttachedToDOM:function(){return Boolean(t.root.parentNode)},isChecked:function(){return t.checked},isIndeterminate:function(){return t.indeterminate},removeClass:function(i){t.root.classList.remove(i)},removeNativeControlAttr:function(i){t.getNativeControl().removeAttribute(i)},setNativeControlAttr:function(i,r){t.getNativeControl().setAttribute(i,r)},setNativeControlDisabled:function(i){t.getNativeControl().disabled=i}};return new xn(n)},e.prototype.createRipple=function(){var t=this,n=f(f({},U.createAdapter(this)),{deregisterInteractionHandler:function(i,r){t.getNativeControl().removeEventListener(i,r,Q())},isSurfaceActive:function(){return rt(t.getNativeControl(),":active")},isUnbounded:function(){return!0},registerInteractionHandler:function(i,r){t.getNativeControl().addEventListener(i,r,Q())}});return new U(this.root,new bt(n))},e.prototype.installPropertyChangeHooks=function(){var t,n,i=this,r=this.getNativeControl(),a=Object.getPrototypeOf(r),s=function(p){var c=Object.getOwnPropertyDescriptor(a,p);if(!_e(c))return{value:void 0};var E=c.get,g={configurable:c.configurable,enumerable:c.enumerable,get:E,set:function(A){c.set.call(r,A),i.foundation.handleChange()}};Object.defineProperty(r,p,g)};try{for(var l=O(be),u=l.next();!u.done;u=l.next()){var d=u.value,h=s(d);if(typeof h=="object")return h.value}}catch(p){t={error:p}}finally{try{u&&!u.done&&(n=l.return)&&n.call(l)}finally{if(t)throw t.error}}},e.prototype.uninstallPropertyChangeHooks=function(){var t,n,i=this.getNativeControl(),r=Object.getPrototypeOf(i);try{for(var a=O(be),s=a.next();!s.done;s=a.next()){var l=s.value,u=Object.getOwnPropertyDescriptor(r,l);if(!_e(u))return;Object.defineProperty(i,l,u)}}catch(d){t={error:d}}finally{try{s&&!s.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}},e.prototype.getNativeControl=function(){var t=z.NATIVE_CONTROL_SELECTOR,n=this.root.querySelector(t);if(!n)throw new Error("Checkbox component requires a "+t+" element");return n},e}(x);function _e(o){return!!o&&typeof o.set=="function"}/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var lt={CLOSING:"mdc-snackbar--closing",OPEN:"mdc-snackbar--open",OPENING:"mdc-snackbar--opening"},Z={ACTION_SELECTOR:".mdc-snackbar__action",ARIA_LIVE_LABEL_TEXT_ATTR:"data-mdc-snackbar-label-text",CLOSED_EVENT:"MDCSnackbar:closed",CLOSING_EVENT:"MDCSnackbar:closing",DISMISS_SELECTOR:".mdc-snackbar__dismiss",LABEL_SELECTOR:".mdc-snackbar__label",OPENED_EVENT:"MDCSnackbar:opened",OPENING_EVENT:"MDCSnackbar:opening",REASON_ACTION:"action",REASON_DISMISS:"dismiss",SURFACE_SELECTOR:".mdc-snackbar__surface"},it={DEFAULT_AUTO_DISMISS_TIMEOUT_MS:5e3,INDETERMINATE:-1,MAX_AUTO_DISMISS_TIMEOUT_MS:1e4,MIN_AUTO_DISMISS_TIMEOUT_MS:4e3,SNACKBAR_ANIMATION_CLOSE_TIME_MS:75,SNACKBAR_ANIMATION_OPEN_TIME_MS:150,ARIA_LIVE_DELAY_MS:1e3};/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Nn=it.ARIA_LIVE_DELAY_MS,Le=Z.ARIA_LIVE_LABEL_TEXT_ATTR;function wn(o,e){e===void 0&&(e=o);var t=o.getAttribute("aria-live"),n=e.textContent.trim();!n||!t||(o.setAttribute("aria-live","off"),e.textContent="",e.innerHTML='<span style="display: inline-block; width: 0; height: 1px;">&nbsp;</span>',e.setAttribute(Le,n),setTimeout(function(){o.setAttribute("aria-live",t),e.removeAttribute(Le),e.textContent=n},Nn))}/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Re=lt.OPENING,De=lt.OPEN,xe=lt.CLOSING,Mn=Z.REASON_ACTION,Jt=Z.REASON_DISMISS,Hn=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.opened=!1,n.animationFrame=0,n.animationTimer=0,n.autoDismissTimer=0,n.autoDismissTimeoutMs=it.DEFAULT_AUTO_DISMISS_TIMEOUT_MS,n.closeOnEscape=!0,n}return Object.defineProperty(e,"cssClasses",{get:function(){return lt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return Z},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return it},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},announce:function(){},notifyClosed:function(){},notifyClosing:function(){},notifyOpened:function(){},notifyOpening:function(){},removeClass:function(){}}},enumerable:!1,configurable:!0}),e.prototype.destroy=function(){this.clearAutoDismissTimer(),cancelAnimationFrame(this.animationFrame),this.animationFrame=0,clearTimeout(this.animationTimer),this.animationTimer=0,this.adapter.removeClass(Re),this.adapter.removeClass(De),this.adapter.removeClass(xe)},e.prototype.open=function(){var t=this;this.clearAutoDismissTimer(),this.opened=!0,this.adapter.notifyOpening(),this.adapter.removeClass(xe),this.adapter.addClass(Re),this.adapter.announce(),this.runNextAnimationFrame(function(){t.adapter.addClass(De),t.animationTimer=setTimeout(function(){var n=t.getTimeoutMs();t.handleAnimationTimerEnd(),t.adapter.notifyOpened(),n!==it.INDETERMINATE&&(t.autoDismissTimer=setTimeout(function(){t.close(Jt)},n))},it.SNACKBAR_ANIMATION_OPEN_TIME_MS)})},e.prototype.close=function(t){var n=this;t===void 0&&(t=""),this.opened&&(cancelAnimationFrame(this.animationFrame),this.animationFrame=0,this.clearAutoDismissTimer(),this.opened=!1,this.adapter.notifyClosing(t),this.adapter.addClass(lt.CLOSING),this.adapter.removeClass(lt.OPEN),this.adapter.removeClass(lt.OPENING),clearTimeout(this.animationTimer),this.animationTimer=setTimeout(function(){n.handleAnimationTimerEnd(),n.adapter.notifyClosed(t)},it.SNACKBAR_ANIMATION_CLOSE_TIME_MS))},e.prototype.isOpen=function(){return this.opened},e.prototype.getTimeoutMs=function(){return this.autoDismissTimeoutMs},e.prototype.setTimeoutMs=function(t){var n=it.MIN_AUTO_DISMISS_TIMEOUT_MS,i=it.MAX_AUTO_DISMISS_TIMEOUT_MS,r=it.INDETERMINATE;if(t===it.INDETERMINATE||t<=i&&t>=n)this.autoDismissTimeoutMs=t;else throw new Error(`
        timeoutMs must be an integer in the range `+n+"–"+i+`
        (or `+r+" to disable), but got '"+t+"'")},e.prototype.getCloseOnEscape=function(){return this.closeOnEscape},e.prototype.setCloseOnEscape=function(t){this.closeOnEscape=t},e.prototype.handleKeyDown=function(t){var n=t.key==="Escape"||t.keyCode===27;n&&this.getCloseOnEscape()&&this.close(Jt)},e.prototype.handleActionButtonClick=function(t){this.close(Mn)},e.prototype.handleActionIconClick=function(t){this.close(Jt)},e.prototype.clearAutoDismissTimer=function(){clearTimeout(this.autoDismissTimer),this.autoDismissTimer=0},e.prototype.handleAnimationTimerEnd=function(){this.animationTimer=0,this.adapter.removeClass(lt.OPENING),this.adapter.removeClass(lt.CLOSING)},e.prototype.runNextAnimationFrame=function(t){var n=this;cancelAnimationFrame(this.animationFrame),this.animationFrame=requestAnimationFrame(function(){n.animationFrame=0,clearTimeout(n.animationTimer),n.animationTimer=setTimeout(t,0)})},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Fn=Z.SURFACE_SELECTOR,Pn=Z.LABEL_SELECTOR,Ne=Z.ACTION_SELECTOR,Bn=Z.DISMISS_SELECTOR,kn=Z.OPENING_EVENT,Un=Z.OPENED_EVENT,Vn=Z.CLOSING_EVENT,Gn=Z.CLOSED_EVENT,en=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.initialize=function(t){t===void 0&&(t=function(){return wn}),this.announce=t()},e.prototype.initialSyncWithDOM=function(){var t=this;this.surfaceEl=this.root.querySelector(Fn),this.labelEl=this.root.querySelector(Pn),this.actionEl=this.root.querySelector(Ne),this.handleKeyDown=function(n){t.foundation.handleKeyDown(n)},this.handleSurfaceClick=function(n){var i=n.target;t.isActionButton(i)?t.foundation.handleActionButtonClick(n):t.isActionIcon(i)&&t.foundation.handleActionIconClick(n)},this.registerKeyDownHandler(this.handleKeyDown),this.registerSurfaceClickHandler(this.handleSurfaceClick)},e.prototype.destroy=function(){o.prototype.destroy.call(this),this.deregisterKeyDownHandler(this.handleKeyDown),this.deregisterSurfaceClickHandler(this.handleSurfaceClick)},e.prototype.open=function(){this.foundation.open()},e.prototype.close=function(t){t===void 0&&(t=""),this.foundation.close(t)},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){t.root.classList.add(i)},announce:function(){t.announce(t.labelEl)},notifyClosed:function(i){return t.emit(Gn,i?{reason:i}:{})},notifyClosing:function(i){return t.emit(Vn,i?{reason:i}:{})},notifyOpened:function(){return t.emit(Un,{})},notifyOpening:function(){return t.emit(kn,{})},removeClass:function(i){return t.root.classList.remove(i)}};return new Hn(n)},Object.defineProperty(e.prototype,"timeoutMs",{get:function(){return this.foundation.getTimeoutMs()},set:function(t){this.foundation.setTimeoutMs(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"closeOnEscape",{get:function(){return this.foundation.getCloseOnEscape()},set:function(t){this.foundation.setCloseOnEscape(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"isOpen",{get:function(){return this.foundation.isOpen()},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"labelText",{get:function(){return this.labelEl.textContent},set:function(t){this.labelEl.textContent=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"actionButtonText",{get:function(){return this.actionEl.textContent},set:function(t){this.actionEl.textContent=t},enumerable:!1,configurable:!0}),e.prototype.registerKeyDownHandler=function(t){this.listen("keydown",t)},e.prototype.deregisterKeyDownHandler=function(t){this.unlisten("keydown",t)},e.prototype.registerSurfaceClickHandler=function(t){this.surfaceEl.addEventListener("click",t)},e.prototype.deregisterSurfaceClickHandler=function(t){this.surfaceEl.removeEventListener("click",t)},e.prototype.isActionButton=function(t){return Boolean(dt(t,Ne))},e.prototype.isActionIcon=function(t){return Boolean(dt(t,Bn))},e}(x);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ft={ANCHOR:"mdc-menu-surface--anchor",ANIMATING_CLOSED:"mdc-menu-surface--animating-closed",ANIMATING_OPEN:"mdc-menu-surface--animating-open",FIXED:"mdc-menu-surface--fixed",IS_OPEN_BELOW:"mdc-menu-surface--is-open-below",OPEN:"mdc-menu-surface--open",ROOT:"mdc-menu-surface"},ot={CLOSED_EVENT:"MDCMenuSurface:closed",CLOSING_EVENT:"MDCMenuSurface:closing",OPENED_EVENT:"MDCMenuSurface:opened",FOCUSABLE_ELEMENTS:["button:not(:disabled)",'[href]:not([aria-disabled="true"])',"input:not(:disabled)","select:not(:disabled)","textarea:not(:disabled)",'[tabindex]:not([tabindex="-1"]):not([aria-disabled="true"])'].join(", ")},xt={TRANSITION_OPEN_DURATION:120,TRANSITION_CLOSE_DURATION:75,MARGIN_TO_EDGE:32,ANCHOR_TO_MENU_SURFACE_WIDTH_RATIO:.67,TOUCH_EVENT_WAIT_MS:30},M;(function(o){o[o.BOTTOM=1]="BOTTOM",o[o.CENTER=2]="CENTER",o[o.RIGHT=4]="RIGHT",o[o.FLIP_RTL=8]="FLIP_RTL"})(M||(M={}));var St;(function(o){o[o.TOP_LEFT=0]="TOP_LEFT",o[o.TOP_RIGHT=4]="TOP_RIGHT",o[o.BOTTOM_LEFT=1]="BOTTOM_LEFT",o[o.BOTTOM_RIGHT=5]="BOTTOM_RIGHT",o[o.TOP_START=8]="TOP_START",o[o.TOP_END=12]="TOP_END",o[o.BOTTOM_START=9]="BOTTOM_START",o[o.BOTTOM_END=13]="BOTTOM_END"})(St||(St={}));/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var ct,ut,m={LIST_ITEM_ACTIVATED_CLASS:"mdc-list-item--activated",LIST_ITEM_CLASS:"mdc-list-item",LIST_ITEM_DISABLED_CLASS:"mdc-list-item--disabled",LIST_ITEM_SELECTED_CLASS:"mdc-list-item--selected",LIST_ITEM_TEXT_CLASS:"mdc-list-item__text",LIST_ITEM_PRIMARY_TEXT_CLASS:"mdc-list-item__primary-text",ROOT:"mdc-list"},Wn=(ct={},ct[""+m.LIST_ITEM_ACTIVATED_CLASS]="mdc-list-item--activated",ct[""+m.LIST_ITEM_CLASS]="mdc-list-item",ct[""+m.LIST_ITEM_DISABLED_CLASS]="mdc-list-item--disabled",ct[""+m.LIST_ITEM_SELECTED_CLASS]="mdc-list-item--selected",ct[""+m.LIST_ITEM_PRIMARY_TEXT_CLASS]="mdc-list-item__primary-text",ct[""+m.ROOT]="mdc-list",ct),Ct=(ut={},ut[""+m.LIST_ITEM_ACTIVATED_CLASS]="mdc-deprecated-list-item--activated",ut[""+m.LIST_ITEM_CLASS]="mdc-deprecated-list-item",ut[""+m.LIST_ITEM_DISABLED_CLASS]="mdc-deprecated-list-item--disabled",ut[""+m.LIST_ITEM_SELECTED_CLASS]="mdc-deprecated-list-item--selected",ut[""+m.LIST_ITEM_TEXT_CLASS]="mdc-deprecated-list-item__text",ut[""+m.LIST_ITEM_PRIMARY_TEXT_CLASS]="mdc-deprecated-list-item__primary-text",ut[""+m.ROOT]="mdc-deprecated-list",ut),_={ACTION_EVENT:"MDCList:action",ARIA_CHECKED:"aria-checked",ARIA_CHECKED_CHECKBOX_SELECTOR:'[role="checkbox"][aria-checked="true"]',ARIA_CHECKED_RADIO_SELECTOR:'[role="radio"][aria-checked="true"]',ARIA_CURRENT:"aria-current",ARIA_DISABLED:"aria-disabled",ARIA_ORIENTATION:"aria-orientation",ARIA_ORIENTATION_HORIZONTAL:"horizontal",ARIA_ROLE_CHECKBOX_SELECTOR:'[role="checkbox"]',ARIA_SELECTED:"aria-selected",ARIA_INTERACTIVE_ROLES_SELECTOR:'[role="listbox"], [role="menu"]',ARIA_MULTI_SELECTABLE_SELECTOR:'[aria-multiselectable="true"]',CHECKBOX_RADIO_SELECTOR:'input[type="checkbox"], input[type="radio"]',CHECKBOX_SELECTOR:'input[type="checkbox"]',CHILD_ELEMENTS_TO_TOGGLE_TABINDEX:`
    .`+m.LIST_ITEM_CLASS+` button:not(:disabled),
    .`+m.LIST_ITEM_CLASS+` a,
    .`+Ct[m.LIST_ITEM_CLASS]+` button:not(:disabled),
    .`+Ct[m.LIST_ITEM_CLASS]+` a
  `,DEPRECATED_SELECTOR:".mdc-deprecated-list",FOCUSABLE_CHILD_ELEMENTS:`
    .`+m.LIST_ITEM_CLASS+` button:not(:disabled),
    .`+m.LIST_ITEM_CLASS+` a,
    .`+m.LIST_ITEM_CLASS+` input[type="radio"]:not(:disabled),
    .`+m.LIST_ITEM_CLASS+` input[type="checkbox"]:not(:disabled),
    .`+Ct[m.LIST_ITEM_CLASS]+` button:not(:disabled),
    .`+Ct[m.LIST_ITEM_CLASS]+` a,
    .`+Ct[m.LIST_ITEM_CLASS]+` input[type="radio"]:not(:disabled),
    .`+Ct[m.LIST_ITEM_CLASS]+` input[type="checkbox"]:not(:disabled)
  `,RADIO_SELECTOR:'input[type="radio"]',SELECTED_ITEM_SELECTOR:'[aria-selected="true"], [aria-current="true"]'},H={UNSET_INDEX:-1,TYPEAHEAD_BUFFER_CLEAR_TIMEOUT_MS:300},Kn="evolution";/**
 * @license
 * Copyright 2020 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var I={UNKNOWN:"Unknown",BACKSPACE:"Backspace",ENTER:"Enter",SPACEBAR:"Spacebar",PAGE_UP:"PageUp",PAGE_DOWN:"PageDown",END:"End",HOME:"Home",ARROW_LEFT:"ArrowLeft",ARROW_UP:"ArrowUp",ARROW_RIGHT:"ArrowRight",ARROW_DOWN:"ArrowDown",DELETE:"Delete",ESCAPE:"Escape",TAB:"Tab"},j=new Set;j.add(I.BACKSPACE);j.add(I.ENTER);j.add(I.SPACEBAR);j.add(I.PAGE_UP);j.add(I.PAGE_DOWN);j.add(I.END);j.add(I.HOME);j.add(I.ARROW_LEFT);j.add(I.ARROW_UP);j.add(I.ARROW_RIGHT);j.add(I.ARROW_DOWN);j.add(I.DELETE);j.add(I.ESCAPE);j.add(I.TAB);var $={BACKSPACE:8,ENTER:13,SPACEBAR:32,PAGE_UP:33,PAGE_DOWN:34,END:35,HOME:36,ARROW_LEFT:37,ARROW_UP:38,ARROW_RIGHT:39,ARROW_DOWN:40,DELETE:46,ESCAPE:27,TAB:9},X=new Map;X.set($.BACKSPACE,I.BACKSPACE);X.set($.ENTER,I.ENTER);X.set($.SPACEBAR,I.SPACEBAR);X.set($.PAGE_UP,I.PAGE_UP);X.set($.PAGE_DOWN,I.PAGE_DOWN);X.set($.END,I.END);X.set($.HOME,I.HOME);X.set($.ARROW_LEFT,I.ARROW_LEFT);X.set($.ARROW_UP,I.ARROW_UP);X.set($.ARROW_RIGHT,I.ARROW_RIGHT);X.set($.ARROW_DOWN,I.ARROW_DOWN);X.set($.DELETE,I.DELETE);X.set($.ESCAPE,I.ESCAPE);X.set($.TAB,I.TAB);var ht=new Set;ht.add(I.PAGE_UP);ht.add(I.PAGE_DOWN);ht.add(I.END);ht.add(I.HOME);ht.add(I.ARROW_LEFT);ht.add(I.ARROW_UP);ht.add(I.ARROW_RIGHT);ht.add(I.ARROW_DOWN);function F(o){var e=o.key;if(j.has(e))return e;var t=X.get(o.keyCode);return t||I.UNKNOWN}/**
 * @license
 * Copyright 2020 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var qn=["input","button","textarea","select"],gt=function(o){var e=o.target;if(e){var t=(""+e.tagName).toLowerCase();qn.indexOf(t)===-1&&o.preventDefault()}};/**
 * @license
 * Copyright 2020 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */function jn(){var o={bufferClearTimeout:0,currentFirstChar:"",sortedIndexCursor:0,typeaheadBuffer:""};return o}function Xn(o,e){for(var t=new Map,n=0;n<o;n++){var i=e(n).trim();if(i){var r=i[0].toLowerCase();t.has(r)||t.set(r,[]),t.get(r).push({text:i.toLowerCase(),index:n})}}return t.forEach(function(a){a.sort(function(s,l){return s.index-l.index})}),t}function se(o,e){var t=o.nextChar,n=o.focusItemAtIndex,i=o.sortedIndexByFirstChar,r=o.focusedItemIndex,a=o.skipFocus,s=o.isItemAtIndexDisabled;clearTimeout(e.bufferClearTimeout),e.bufferClearTimeout=setTimeout(function(){rn(e)},H.TYPEAHEAD_BUFFER_CLEAR_TIMEOUT_MS),e.typeaheadBuffer=e.typeaheadBuffer+t;var l;return e.typeaheadBuffer.length===1?l=zn(i,r,s,e):l=$n(i,s,e),l!==-1&&!a&&n(l),l}function zn(o,e,t,n){var i=n.typeaheadBuffer[0],r=o.get(i);if(!r)return-1;if(i===n.currentFirstChar&&r[n.sortedIndexCursor].index===e){n.sortedIndexCursor=(n.sortedIndexCursor+1)%r.length;var a=r[n.sortedIndexCursor].index;if(!t(a))return a}n.currentFirstChar=i;var s=-1,l;for(l=0;l<r.length;l++)if(!t(r[l].index)){s=l;break}for(;l<r.length;l++)if(r[l].index>e&&!t(r[l].index)){s=l;break}return s!==-1?(n.sortedIndexCursor=s,r[n.sortedIndexCursor].index):-1}function $n(o,e,t){var n=t.typeaheadBuffer[0],i=o.get(n);if(!i)return-1;var r=i[t.sortedIndexCursor];if(r.text.lastIndexOf(t.typeaheadBuffer,0)===0&&!e(r.index))return r.index;for(var a=(t.sortedIndexCursor+1)%i.length,s=-1;a!==t.sortedIndexCursor;){var l=i[a],u=l.text.lastIndexOf(t.typeaheadBuffer,0)===0,d=!e(l.index);if(u&&d){s=a;break}a=(a+1)%i.length}return s!==-1?(t.sortedIndexCursor=s,i[t.sortedIndexCursor].index):-1}function nn(o){return o.typeaheadBuffer.length>0}function rn(o){o.typeaheadBuffer=""}function we(o,e){var t=o.event,n=o.isTargetListItem,i=o.focusedItemIndex,r=o.focusItemAtIndex,a=o.sortedIndexByFirstChar,s=o.isItemAtIndexDisabled,l=F(t)==="ArrowLeft",u=F(t)==="ArrowUp",d=F(t)==="ArrowRight",h=F(t)==="ArrowDown",p=F(t)==="Home",c=F(t)==="End",E=F(t)==="Enter",g=F(t)==="Spacebar";if(t.ctrlKey||t.metaKey||l||u||d||h||p||c||E)return-1;var A=!g&&t.key.length===1;if(A){gt(t);var T={focusItemAtIndex:r,focusedItemIndex:i,nextChar:t.key.toLowerCase(),sortedIndexByFirstChar:a,skipFocus:!1,isItemAtIndexDisabled:s};return se(T,e)}if(!g)return-1;n&&gt(t);var N=n&&nn(e);if(N){var T={focusItemAtIndex:r,focusedItemIndex:i,nextChar:" ",sortedIndexByFirstChar:a,skipFocus:!1,isItemAtIndexDisabled:s};return se(T,e)}return-1}/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */function Yn(o){return o instanceof Array}var ue=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.wrapFocus=!1,n.isVertical=!0,n.isSingleSelectionList=!1,n.selectedIndex=H.UNSET_INDEX,n.focusedItemIndex=H.UNSET_INDEX,n.useActivatedClass=!1,n.useSelectedAttr=!1,n.ariaCurrentAttrValue=null,n.isCheckboxList=!1,n.isRadioList=!1,n.hasTypeahead=!1,n.typeaheadState=jn(),n.sortedIndexByFirstChar=new Map,n}return Object.defineProperty(e,"strings",{get:function(){return _},enumerable:!1,configurable:!0}),Object.defineProperty(e,"cssClasses",{get:function(){return m},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return H},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClassForElementIndex:function(){},focusItemAtIndex:function(){},getAttributeForElementIndex:function(){return null},getFocusedElementIndex:function(){return 0},getListItemCount:function(){return 0},hasCheckboxAtIndex:function(){return!1},hasRadioAtIndex:function(){return!1},isCheckboxCheckedAtIndex:function(){return!1},isFocusInsideList:function(){return!1},isRootFocused:function(){return!1},listItemAtIndexHasClass:function(){return!1},notifyAction:function(){},removeClassForElementIndex:function(){},setAttributeForElementIndex:function(){},setCheckedCheckboxOrRadioAtIndex:function(){},setTabIndexForListItemChildren:function(){},getPrimaryTextAtIndex:function(){return""}}},enumerable:!1,configurable:!0}),e.prototype.layout=function(){this.adapter.getListItemCount()!==0&&(this.adapter.hasCheckboxAtIndex(0)?this.isCheckboxList=!0:this.adapter.hasRadioAtIndex(0)?this.isRadioList=!0:this.maybeInitializeSingleSelection(),this.hasTypeahead&&(this.sortedIndexByFirstChar=this.typeaheadInitSortedIndex()))},e.prototype.getFocusedItemIndex=function(){return this.focusedItemIndex},e.prototype.setWrapFocus=function(t){this.wrapFocus=t},e.prototype.setVerticalOrientation=function(t){this.isVertical=t},e.prototype.setSingleSelection=function(t){this.isSingleSelectionList=t,t&&(this.maybeInitializeSingleSelection(),this.selectedIndex=this.getSelectedIndexFromDOM())},e.prototype.maybeInitializeSingleSelection=function(){var t=this.getSelectedIndexFromDOM();if(t!==H.UNSET_INDEX){var n=this.adapter.listItemAtIndexHasClass(t,m.LIST_ITEM_ACTIVATED_CLASS);n&&this.setUseActivatedClass(!0),this.isSingleSelectionList=!0,this.selectedIndex=t}},e.prototype.getSelectedIndexFromDOM=function(){for(var t=H.UNSET_INDEX,n=this.adapter.getListItemCount(),i=0;i<n;i++){var r=this.adapter.listItemAtIndexHasClass(i,m.LIST_ITEM_SELECTED_CLASS),a=this.adapter.listItemAtIndexHasClass(i,m.LIST_ITEM_ACTIVATED_CLASS);if(r||a){t=i;break}}return t},e.prototype.setHasTypeahead=function(t){this.hasTypeahead=t,t&&(this.sortedIndexByFirstChar=this.typeaheadInitSortedIndex())},e.prototype.isTypeaheadInProgress=function(){return this.hasTypeahead&&nn(this.typeaheadState)},e.prototype.setUseActivatedClass=function(t){this.useActivatedClass=t},e.prototype.setUseSelectedAttribute=function(t){this.useSelectedAttr=t},e.prototype.getSelectedIndex=function(){return this.selectedIndex},e.prototype.setSelectedIndex=function(t,n){var i=n===void 0?{}:n,r=i.forceUpdate;this.isIndexValid(t)&&(this.isCheckboxList?this.setCheckboxAtIndex(t):this.isRadioList?this.setRadioAtIndex(t):this.setSingleSelectionAtIndex(t,{forceUpdate:r}))},e.prototype.handleFocusIn=function(t){t>=0&&(this.focusedItemIndex=t,this.adapter.setAttributeForElementIndex(t,"tabindex","0"),this.adapter.setTabIndexForListItemChildren(t,"0"))},e.prototype.handleFocusOut=function(t){var n=this;t>=0&&(this.adapter.setAttributeForElementIndex(t,"tabindex","-1"),this.adapter.setTabIndexForListItemChildren(t,"-1")),setTimeout(function(){n.adapter.isFocusInsideList()||n.setTabindexToFirstSelectedOrFocusedItem()},0)},e.prototype.handleKeydown=function(t,n,i){var r=this,a=F(t)==="ArrowLeft",s=F(t)==="ArrowUp",l=F(t)==="ArrowRight",u=F(t)==="ArrowDown",d=F(t)==="Home",h=F(t)==="End",p=F(t)==="Enter",c=F(t)==="Spacebar",E=t.key==="A"||t.key==="a";if(this.adapter.isRootFocused()){if(s||h?(t.preventDefault(),this.focusLastElement()):(u||d)&&(t.preventDefault(),this.focusFirstElement()),this.hasTypeahead){var g={event:t,focusItemAtIndex:function(N){r.focusItemAtIndex(N)},focusedItemIndex:-1,isTargetListItem:n,sortedIndexByFirstChar:this.sortedIndexByFirstChar,isItemAtIndexDisabled:function(N){return r.adapter.listItemAtIndexHasClass(N,m.LIST_ITEM_DISABLED_CLASS)}};we(g,this.typeaheadState)}return}var A=this.adapter.getFocusedElementIndex();if(!(A===-1&&(A=i,A<0))){if(this.isVertical&&u||!this.isVertical&&l)gt(t),this.focusNextElement(A);else if(this.isVertical&&s||!this.isVertical&&a)gt(t),this.focusPrevElement(A);else if(d)gt(t),this.focusFirstElement();else if(h)gt(t),this.focusLastElement();else if(E&&t.ctrlKey&&this.isCheckboxList)t.preventDefault(),this.toggleAll(this.selectedIndex===H.UNSET_INDEX?[]:this.selectedIndex);else if((p||c)&&n){var T=t.target;if(T&&T.tagName==="A"&&p||(gt(t),this.adapter.listItemAtIndexHasClass(A,m.LIST_ITEM_DISABLED_CLASS)))return;this.isTypeaheadInProgress()||(this.isSelectableList()&&this.setSelectedIndexOnAction(A),this.adapter.notifyAction(A))}if(this.hasTypeahead){var g={event:t,focusItemAtIndex:function(G){r.focusItemAtIndex(G)},focusedItemIndex:this.focusedItemIndex,isTargetListItem:n,sortedIndexByFirstChar:this.sortedIndexByFirstChar,isItemAtIndexDisabled:function(G){return r.adapter.listItemAtIndexHasClass(G,m.LIST_ITEM_DISABLED_CLASS)}};we(g,this.typeaheadState)}}},e.prototype.handleClick=function(t,n){t!==H.UNSET_INDEX&&(this.adapter.listItemAtIndexHasClass(t,m.LIST_ITEM_DISABLED_CLASS)||(this.isSelectableList()&&this.setSelectedIndexOnAction(t,n),this.adapter.notifyAction(t)))},e.prototype.focusNextElement=function(t){var n=this.adapter.getListItemCount(),i=t+1;if(i>=n)if(this.wrapFocus)i=0;else return t;return this.focusItemAtIndex(i),i},e.prototype.focusPrevElement=function(t){var n=t-1;if(n<0)if(this.wrapFocus)n=this.adapter.getListItemCount()-1;else return t;return this.focusItemAtIndex(n),n},e.prototype.focusFirstElement=function(){return this.focusItemAtIndex(0),0},e.prototype.focusLastElement=function(){var t=this.adapter.getListItemCount()-1;return this.focusItemAtIndex(t),t},e.prototype.focusInitialElement=function(){var t=this.getFirstSelectedOrFocusedItemIndex();return this.focusItemAtIndex(t),t},e.prototype.setEnabled=function(t,n){this.isIndexValid(t)&&(n?(this.adapter.removeClassForElementIndex(t,m.LIST_ITEM_DISABLED_CLASS),this.adapter.setAttributeForElementIndex(t,_.ARIA_DISABLED,"false")):(this.adapter.addClassForElementIndex(t,m.LIST_ITEM_DISABLED_CLASS),this.adapter.setAttributeForElementIndex(t,_.ARIA_DISABLED,"true")))},e.prototype.setSingleSelectionAtIndex=function(t,n){var i=n===void 0?{}:n,r=i.forceUpdate;if(!(this.selectedIndex===t&&!r)){var a=m.LIST_ITEM_SELECTED_CLASS;this.useActivatedClass&&(a=m.LIST_ITEM_ACTIVATED_CLASS),this.selectedIndex!==H.UNSET_INDEX&&this.adapter.removeClassForElementIndex(this.selectedIndex,a),this.setAriaForSingleSelectionAtIndex(t),this.setTabindexAtIndex(t),t!==H.UNSET_INDEX&&this.adapter.addClassForElementIndex(t,a),this.selectedIndex=t}},e.prototype.setAriaForSingleSelectionAtIndex=function(t){this.selectedIndex===H.UNSET_INDEX&&(this.ariaCurrentAttrValue=this.adapter.getAttributeForElementIndex(t,_.ARIA_CURRENT));var n=this.ariaCurrentAttrValue!==null,i=n?_.ARIA_CURRENT:_.ARIA_SELECTED;if(this.selectedIndex!==H.UNSET_INDEX&&this.adapter.setAttributeForElementIndex(this.selectedIndex,i,"false"),t!==H.UNSET_INDEX){var r=n?this.ariaCurrentAttrValue:"true";this.adapter.setAttributeForElementIndex(t,i,r)}},e.prototype.getSelectionAttribute=function(){return this.useSelectedAttr?_.ARIA_SELECTED:_.ARIA_CHECKED},e.prototype.setRadioAtIndex=function(t){var n=this.getSelectionAttribute();this.adapter.setCheckedCheckboxOrRadioAtIndex(t,!0),this.selectedIndex!==H.UNSET_INDEX&&this.adapter.setAttributeForElementIndex(this.selectedIndex,n,"false"),this.adapter.setAttributeForElementIndex(t,n,"true"),this.selectedIndex=t},e.prototype.setCheckboxAtIndex=function(t){for(var n=this.getSelectionAttribute(),i=0;i<this.adapter.getListItemCount();i++){var r=!1;t.indexOf(i)>=0&&(r=!0),this.adapter.setCheckedCheckboxOrRadioAtIndex(i,r),this.adapter.setAttributeForElementIndex(i,n,r?"true":"false")}this.selectedIndex=t},e.prototype.setTabindexAtIndex=function(t){this.focusedItemIndex===H.UNSET_INDEX&&t!==0?this.adapter.setAttributeForElementIndex(0,"tabindex","-1"):this.focusedItemIndex>=0&&this.focusedItemIndex!==t&&this.adapter.setAttributeForElementIndex(this.focusedItemIndex,"tabindex","-1"),!(this.selectedIndex instanceof Array)&&this.selectedIndex!==t&&this.adapter.setAttributeForElementIndex(this.selectedIndex,"tabindex","-1"),t!==H.UNSET_INDEX&&this.adapter.setAttributeForElementIndex(t,"tabindex","0")},e.prototype.isSelectableList=function(){return this.isSingleSelectionList||this.isCheckboxList||this.isRadioList},e.prototype.setTabindexToFirstSelectedOrFocusedItem=function(){var t=this.getFirstSelectedOrFocusedItemIndex();this.setTabindexAtIndex(t)},e.prototype.getFirstSelectedOrFocusedItemIndex=function(){return this.isSelectableList()?typeof this.selectedIndex=="number"&&this.selectedIndex!==H.UNSET_INDEX?this.selectedIndex:Yn(this.selectedIndex)&&this.selectedIndex.length>0?this.selectedIndex.reduce(function(t,n){return Math.min(t,n)}):0:Math.max(this.focusedItemIndex,0)},e.prototype.isIndexValid=function(t){var n=this;if(t instanceof Array){if(!this.isCheckboxList)throw new Error("MDCListFoundation: Array of index is only supported for checkbox based list");return t.length===0?!0:t.some(function(i){return n.isIndexInRange(i)})}else if(typeof t=="number"){if(this.isCheckboxList)throw new Error("MDCListFoundation: Expected array of index for checkbox based list but got number: "+t);return this.isIndexInRange(t)||this.isSingleSelectionList&&t===H.UNSET_INDEX}else return!1},e.prototype.isIndexInRange=function(t){var n=this.adapter.getListItemCount();return t>=0&&t<n},e.prototype.setSelectedIndexOnAction=function(t,n){n===void 0&&(n=!0),this.isCheckboxList?this.toggleCheckboxAtIndex(t,n):this.setSelectedIndex(t)},e.prototype.toggleCheckboxAtIndex=function(t,n){var i=this.getSelectionAttribute(),r=this.adapter.isCheckboxCheckedAtIndex(t);n&&(r=!r,this.adapter.setCheckedCheckboxOrRadioAtIndex(t,r)),this.adapter.setAttributeForElementIndex(t,i,r?"true":"false");var a=this.selectedIndex===H.UNSET_INDEX?[]:this.selectedIndex.slice();r?a.push(t):a=a.filter(function(s){return s!==t}),this.selectedIndex=a},e.prototype.focusItemAtIndex=function(t){this.adapter.focusItemAtIndex(t),this.focusedItemIndex=t},e.prototype.toggleAll=function(t){var n=this.adapter.getListItemCount();if(t.length===n)this.setCheckboxAtIndex([]);else{for(var i=[],r=0;r<n;r++)(!this.adapter.listItemAtIndexHasClass(r,m.LIST_ITEM_DISABLED_CLASS)||t.indexOf(r)>-1)&&i.push(r);this.setCheckboxAtIndex(i)}},e.prototype.typeaheadMatchItem=function(t,n,i){var r=this;i===void 0&&(i=!1);var a={focusItemAtIndex:function(s){r.focusItemAtIndex(s)},focusedItemIndex:n||this.focusedItemIndex,nextChar:t,sortedIndexByFirstChar:this.sortedIndexByFirstChar,skipFocus:i,isItemAtIndexDisabled:function(s){return r.adapter.listItemAtIndexHasClass(s,m.LIST_ITEM_DISABLED_CLASS)}};return se(a,this.typeaheadState)},e.prototype.typeaheadInitSortedIndex=function(){return Xn(this.adapter.getListItemCount(),this.adapter.getPrimaryTextAtIndex)},e.prototype.clearTypeaheadBuffer=function(){rn(this.typeaheadState)},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var on=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return Object.defineProperty(e.prototype,"vertical",{set:function(t){this.foundation.setVerticalOrientation(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"listElements",{get:function(){return Array.from(this.root.querySelectorAll("."+this.classNameMap[m.LIST_ITEM_CLASS]))},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"wrapFocus",{set:function(t){this.foundation.setWrapFocus(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"typeaheadInProgress",{get:function(){return this.foundation.isTypeaheadInProgress()},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"hasTypeahead",{set:function(t){this.foundation.setHasTypeahead(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"singleSelection",{set:function(t){this.foundation.setSingleSelection(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"selectedIndex",{get:function(){return this.foundation.getSelectedIndex()},set:function(t){this.foundation.setSelectedIndex(t)},enumerable:!1,configurable:!0}),e.attachTo=function(t){return new e(t)},e.prototype.initialSyncWithDOM=function(){this.isEvolutionEnabled=Kn in this.root.dataset,this.isEvolutionEnabled?this.classNameMap=Wn:rt(this.root,_.DEPRECATED_SELECTOR)?this.classNameMap=Ct:this.classNameMap=Object.values(m).reduce(function(t,n){return t[n]=n,t},{}),this.handleClick=this.handleClickEvent.bind(this),this.handleKeydown=this.handleKeydownEvent.bind(this),this.focusInEventListener=this.handleFocusInEvent.bind(this),this.focusOutEventListener=this.handleFocusOutEvent.bind(this),this.listen("keydown",this.handleKeydown),this.listen("click",this.handleClick),this.listen("focusin",this.focusInEventListener),this.listen("focusout",this.focusOutEventListener),this.layout(),this.initializeListType(),this.ensureFocusable()},e.prototype.destroy=function(){this.unlisten("keydown",this.handleKeydown),this.unlisten("click",this.handleClick),this.unlisten("focusin",this.focusInEventListener),this.unlisten("focusout",this.focusOutEventListener)},e.prototype.layout=function(){var t=this.root.getAttribute(_.ARIA_ORIENTATION);this.vertical=t!==_.ARIA_ORIENTATION_HORIZONTAL;var n="."+this.classNameMap[m.LIST_ITEM_CLASS]+":not([tabindex])",i=_.FOCUSABLE_CHILD_ELEMENTS,r=this.root.querySelectorAll(n);r.length&&Array.prototype.forEach.call(r,function(s){s.setAttribute("tabindex","-1")});var a=this.root.querySelectorAll(i);a.length&&Array.prototype.forEach.call(a,function(s){s.setAttribute("tabindex","-1")}),this.isEvolutionEnabled&&this.foundation.setUseSelectedAttribute(!0),this.foundation.layout()},e.prototype.getPrimaryText=function(t){var n,i=t.querySelector("."+this.classNameMap[m.LIST_ITEM_PRIMARY_TEXT_CLASS]);if(this.isEvolutionEnabled||i)return(n=i==null?void 0:i.textContent)!==null&&n!==void 0?n:"";var r=t.querySelector("."+this.classNameMap[m.LIST_ITEM_TEXT_CLASS]);return r&&r.textContent||""},e.prototype.initializeListType=function(){var t=this;if(this.isInteractive=rt(this.root,_.ARIA_INTERACTIVE_ROLES_SELECTOR),this.isEvolutionEnabled&&this.isInteractive){var n=Array.from(this.root.querySelectorAll(_.SELECTED_ITEM_SELECTOR),function(s){return t.listElements.indexOf(s)});rt(this.root,_.ARIA_MULTI_SELECTABLE_SELECTOR)?this.selectedIndex=n:n.length>0&&(this.selectedIndex=n[0]);return}var i=this.root.querySelectorAll(_.ARIA_ROLE_CHECKBOX_SELECTOR),r=this.root.querySelector(_.ARIA_CHECKED_RADIO_SELECTOR);if(i.length){var a=this.root.querySelectorAll(_.ARIA_CHECKED_CHECKBOX_SELECTOR);this.selectedIndex=Array.from(a,function(s){return t.listElements.indexOf(s)})}else r&&(this.selectedIndex=this.listElements.indexOf(r))},e.prototype.setEnabled=function(t,n){this.foundation.setEnabled(t,n)},e.prototype.typeaheadMatchItem=function(t,n){return this.foundation.typeaheadMatchItem(t,n,!0)},e.prototype.getDefaultFoundation=function(){var t=this,n={addClassForElementIndex:function(i,r){var a=t.listElements[i];a&&a.classList.add(t.classNameMap[r])},focusItemAtIndex:function(i){var r=t.listElements[i];r&&r.focus()},getAttributeForElementIndex:function(i,r){return t.listElements[i].getAttribute(r)},getFocusedElementIndex:function(){return t.listElements.indexOf(document.activeElement)},getListItemCount:function(){return t.listElements.length},getPrimaryTextAtIndex:function(i){return t.getPrimaryText(t.listElements[i])},hasCheckboxAtIndex:function(i){var r=t.listElements[i];return!!r.querySelector(_.CHECKBOX_SELECTOR)},hasRadioAtIndex:function(i){var r=t.listElements[i];return!!r.querySelector(_.RADIO_SELECTOR)},isCheckboxCheckedAtIndex:function(i){var r=t.listElements[i],a=r.querySelector(_.CHECKBOX_SELECTOR);return a.checked},isFocusInsideList:function(){return t.root!==document.activeElement&&t.root.contains(document.activeElement)},isRootFocused:function(){return document.activeElement===t.root},listItemAtIndexHasClass:function(i,r){return t.listElements[i].classList.contains(t.classNameMap[r])},notifyAction:function(i){t.emit(_.ACTION_EVENT,{index:i},!0)},removeClassForElementIndex:function(i,r){var a=t.listElements[i];a&&a.classList.remove(t.classNameMap[r])},setAttributeForElementIndex:function(i,r,a){var s=t.listElements[i];s&&s.setAttribute(r,a)},setCheckedCheckboxOrRadioAtIndex:function(i,r){var a=t.listElements[i],s=a.querySelector(_.CHECKBOX_RADIO_SELECTOR);s.checked=r;var l=document.createEvent("Event");l.initEvent("change",!0,!0),s.dispatchEvent(l)},setTabIndexForListItemChildren:function(i,r){var a=t.listElements[i],s=_.CHILD_ELEMENTS_TO_TOGGLE_TABINDEX;Array.prototype.forEach.call(a.querySelectorAll(s),function(l){l.setAttribute("tabindex",r)})}};return new ue(n)},e.prototype.ensureFocusable=function(){if(this.isEvolutionEnabled&&this.isInteractive&&!this.root.querySelector("."+this.classNameMap[m.LIST_ITEM_CLASS]+'[tabindex="0"]')){var t=this.initialFocusIndex();t!==-1&&(this.listElements[t].tabIndex=0)}},e.prototype.initialFocusIndex=function(){if(this.selectedIndex instanceof Array&&this.selectedIndex.length>0)return this.selectedIndex[0];if(typeof this.selectedIndex=="number"&&this.selectedIndex!==H.UNSET_INDEX)return this.selectedIndex;var t=this.root.querySelector("."+this.classNameMap[m.LIST_ITEM_CLASS]+":not(."+this.classNameMap[m.LIST_ITEM_DISABLED_CLASS]+")");return t===null?-1:this.getListItemIndex(t)},e.prototype.getListItemIndex=function(t){var n=dt(t,"."+this.classNameMap[m.LIST_ITEM_CLASS]+", ."+this.classNameMap[m.ROOT]);return n&&rt(n,"."+this.classNameMap[m.LIST_ITEM_CLASS])?this.listElements.indexOf(n):-1},e.prototype.handleFocusInEvent=function(t){var n=this.getListItemIndex(t.target);this.foundation.handleFocusIn(n)},e.prototype.handleFocusOutEvent=function(t){var n=this.getListItemIndex(t.target);this.foundation.handleFocusOut(n)},e.prototype.handleKeydownEvent=function(t){var n=this.getListItemIndex(t.target),i=t.target;this.foundation.handleKeydown(t,i.classList.contains(this.classNameMap[m.LIST_ITEM_CLASS]),n)},e.prototype.handleClickEvent=function(t){var n=this.getListItemIndex(t.target),i=t.target,r=!rt(i,_.CHECKBOX_RADIO_SELECTOR);this.foundation.handleClick(n,r)},e}(x);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var vt=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.isSurfaceOpen=!1,n.isQuickOpen=!1,n.isHoistedElement=!1,n.isFixedPosition=!1,n.isHorizontallyCenteredOnViewport=!1,n.maxHeight=0,n.openAnimationEndTimerId=0,n.closeAnimationEndTimerId=0,n.animationRequestId=0,n.anchorCorner=St.TOP_START,n.originCorner=St.TOP_START,n.anchorMargin={top:0,right:0,bottom:0,left:0},n.position={x:0,y:0},n}return Object.defineProperty(e,"cssClasses",{get:function(){return Ft},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return ot},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return xt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"Corner",{get:function(){return St},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},hasClass:function(){return!1},hasAnchor:function(){return!1},isElementInContainer:function(){return!1},isFocused:function(){return!1},isRtl:function(){return!1},getInnerDimensions:function(){return{height:0,width:0}},getAnchorDimensions:function(){return null},getWindowDimensions:function(){return{height:0,width:0}},getBodyDimensions:function(){return{height:0,width:0}},getWindowScroll:function(){return{x:0,y:0}},setPosition:function(){},setMaxHeight:function(){},setTransformOrigin:function(){},saveFocus:function(){},restoreFocus:function(){},notifyClose:function(){},notifyOpen:function(){},notifyClosing:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){var t=e.cssClasses,n=t.ROOT,i=t.OPEN;if(!this.adapter.hasClass(n))throw new Error(n+" class required in root element.");this.adapter.hasClass(i)&&(this.isSurfaceOpen=!0)},e.prototype.destroy=function(){clearTimeout(this.openAnimationEndTimerId),clearTimeout(this.closeAnimationEndTimerId),cancelAnimationFrame(this.animationRequestId)},e.prototype.setAnchorCorner=function(t){this.anchorCorner=t},e.prototype.flipCornerHorizontally=function(){this.originCorner=this.originCorner^M.RIGHT},e.prototype.setAnchorMargin=function(t){this.anchorMargin.top=t.top||0,this.anchorMargin.right=t.right||0,this.anchorMargin.bottom=t.bottom||0,this.anchorMargin.left=t.left||0},e.prototype.setIsHoisted=function(t){this.isHoistedElement=t},e.prototype.setFixedPosition=function(t){this.isFixedPosition=t},e.prototype.isFixed=function(){return this.isFixedPosition},e.prototype.setAbsolutePosition=function(t,n){this.position.x=this.isFinite(t)?t:0,this.position.y=this.isFinite(n)?n:0},e.prototype.setIsHorizontallyCenteredOnViewport=function(t){this.isHorizontallyCenteredOnViewport=t},e.prototype.setQuickOpen=function(t){this.isQuickOpen=t},e.prototype.setMaxHeight=function(t){this.maxHeight=t},e.prototype.isOpen=function(){return this.isSurfaceOpen},e.prototype.open=function(){var t=this;this.isSurfaceOpen||(this.adapter.saveFocus(),this.isQuickOpen?(this.isSurfaceOpen=!0,this.adapter.addClass(e.cssClasses.OPEN),this.dimensions=this.adapter.getInnerDimensions(),this.autoposition(),this.adapter.notifyOpen()):(this.adapter.addClass(e.cssClasses.ANIMATING_OPEN),this.animationRequestId=requestAnimationFrame(function(){t.dimensions=t.adapter.getInnerDimensions(),t.autoposition(),t.adapter.addClass(e.cssClasses.OPEN),t.openAnimationEndTimerId=setTimeout(function(){t.openAnimationEndTimerId=0,t.adapter.removeClass(e.cssClasses.ANIMATING_OPEN),t.adapter.notifyOpen()},xt.TRANSITION_OPEN_DURATION)}),this.isSurfaceOpen=!0))},e.prototype.close=function(t){var n=this;if(t===void 0&&(t=!1),!!this.isSurfaceOpen){if(this.adapter.notifyClosing(),this.isQuickOpen){this.isSurfaceOpen=!1,t||this.maybeRestoreFocus(),this.adapter.removeClass(e.cssClasses.OPEN),this.adapter.removeClass(e.cssClasses.IS_OPEN_BELOW),this.adapter.notifyClose();return}this.adapter.addClass(e.cssClasses.ANIMATING_CLOSED),requestAnimationFrame(function(){n.adapter.removeClass(e.cssClasses.OPEN),n.adapter.removeClass(e.cssClasses.IS_OPEN_BELOW),n.closeAnimationEndTimerId=setTimeout(function(){n.closeAnimationEndTimerId=0,n.adapter.removeClass(e.cssClasses.ANIMATING_CLOSED),n.adapter.notifyClose()},xt.TRANSITION_CLOSE_DURATION)}),this.isSurfaceOpen=!1,t||this.maybeRestoreFocus()}},e.prototype.handleBodyClick=function(t){var n=t.target;this.adapter.isElementInContainer(n)||this.close()},e.prototype.handleKeydown=function(t){var n=t.keyCode,i=t.key,r=i==="Escape"||n===27;r&&this.close()},e.prototype.autoposition=function(){var t;this.measurements=this.getAutoLayoutmeasurements();var n=this.getoriginCorner(),i=this.getMenuSurfaceMaxHeight(n),r=this.hasBit(n,M.BOTTOM)?"bottom":"top",a=this.hasBit(n,M.RIGHT)?"right":"left",s=this.getHorizontalOriginOffset(n),l=this.getVerticalOriginOffset(n),u=this.measurements,d=u.anchorSize,h=u.surfaceSize,p=(t={},t[a]=s,t[r]=l,t);d.width/h.width>xt.ANCHOR_TO_MENU_SURFACE_WIDTH_RATIO&&(a="center"),(this.isHoistedElement||this.isFixedPosition)&&this.adjustPositionForHoistedElement(p),this.adapter.setTransformOrigin(a+" "+r),this.adapter.setPosition(p),this.adapter.setMaxHeight(i?i+"px":""),this.hasBit(n,M.BOTTOM)||this.adapter.addClass(e.cssClasses.IS_OPEN_BELOW)},e.prototype.getAutoLayoutmeasurements=function(){var t=this.adapter.getAnchorDimensions(),n=this.adapter.getBodyDimensions(),i=this.adapter.getWindowDimensions(),r=this.adapter.getWindowScroll();return t||(t={top:this.position.y,right:this.position.x,bottom:this.position.y,left:this.position.x,width:0,height:0}),{anchorSize:t,bodySize:n,surfaceSize:this.dimensions,viewportDistance:{top:t.top,right:i.width-t.right,bottom:i.height-t.bottom,left:t.left},viewportSize:i,windowScroll:r}},e.prototype.getoriginCorner=function(){var t=this.originCorner,n=this.measurements,i=n.viewportDistance,r=n.anchorSize,a=n.surfaceSize,s=e.numbers.MARGIN_TO_EDGE,l=this.hasBit(this.anchorCorner,M.BOTTOM),u,d;l?(u=i.top-s+this.anchorMargin.bottom,d=i.bottom-s-this.anchorMargin.bottom):(u=i.top-s+this.anchorMargin.top,d=i.bottom-s+r.height-this.anchorMargin.top);var h=d-a.height>0;!h&&u>d&&(t=this.setBit(t,M.BOTTOM));var p=this.adapter.isRtl(),c=this.hasBit(this.anchorCorner,M.FLIP_RTL),E=this.hasBit(this.anchorCorner,M.RIGHT)||this.hasBit(t,M.RIGHT),g=!1;p&&c?g=!E:g=E;var A,T;g?(A=i.left+r.width+this.anchorMargin.right,T=i.right-this.anchorMargin.right):(A=i.left+this.anchorMargin.left,T=i.right+r.width-this.anchorMargin.left);var N=A-a.width>0,G=T-a.width>0,w=this.hasBit(t,M.FLIP_RTL)&&this.hasBit(t,M.RIGHT);return G&&w&&p||!N&&w?t=this.unsetBit(t,M.RIGHT):(N&&g&&p||N&&!g&&E||!G&&A>=T)&&(t=this.setBit(t,M.RIGHT)),t},e.prototype.getMenuSurfaceMaxHeight=function(t){if(this.maxHeight>0)return this.maxHeight;var n=this.measurements.viewportDistance,i=0,r=this.hasBit(t,M.BOTTOM),a=this.hasBit(this.anchorCorner,M.BOTTOM),s=e.numbers.MARGIN_TO_EDGE;return r?(i=n.top+this.anchorMargin.top-s,a||(i+=this.measurements.anchorSize.height)):(i=n.bottom-this.anchorMargin.bottom+this.measurements.anchorSize.height-s,a&&(i-=this.measurements.anchorSize.height)),i},e.prototype.getHorizontalOriginOffset=function(t){var n=this.measurements.anchorSize,i=this.hasBit(t,M.RIGHT),r=this.hasBit(this.anchorCorner,M.RIGHT);if(i){var a=r?n.width-this.anchorMargin.left:this.anchorMargin.right;return this.isHoistedElement||this.isFixedPosition?a-(this.measurements.viewportSize.width-this.measurements.bodySize.width):a}return r?n.width-this.anchorMargin.right:this.anchorMargin.left},e.prototype.getVerticalOriginOffset=function(t){var n=this.measurements.anchorSize,i=this.hasBit(t,M.BOTTOM),r=this.hasBit(this.anchorCorner,M.BOTTOM),a=0;return i?a=r?n.height-this.anchorMargin.top:-this.anchorMargin.bottom:a=r?n.height+this.anchorMargin.bottom:this.anchorMargin.top,a},e.prototype.adjustPositionForHoistedElement=function(t){var n,i,r=this.measurements,a=r.windowScroll,s=r.viewportDistance,l=r.surfaceSize,u=r.viewportSize,d=Object.keys(t);try{for(var h=O(d),p=h.next();!p.done;p=h.next()){var c=p.value,E=t[c]||0;if(this.isHorizontallyCenteredOnViewport&&(c==="left"||c==="right")){t[c]=(u.width-l.width)/2;continue}E+=s[c],this.isFixedPosition||(c==="top"?E+=a.y:c==="bottom"?E-=a.y:c==="left"?E+=a.x:E-=a.x),t[c]=E}}catch(g){n={error:g}}finally{try{p&&!p.done&&(i=h.return)&&i.call(h)}finally{if(n)throw n.error}}},e.prototype.maybeRestoreFocus=function(){var t=this,n=this.adapter.isFocused(),i=document.activeElement&&this.adapter.isElementInContainer(document.activeElement);(n||i)&&setTimeout(function(){t.adapter.restoreFocus()},xt.TOUCH_EVENT_WAIT_MS)},e.prototype.hasBit=function(t,n){return Boolean(t&n)},e.prototype.setBit=function(t,n){return t|n},e.prototype.unsetBit=function(t,n){return t^n},e.prototype.isFinite=function(t){return typeof t=="number"&&isFinite(t)},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Qn=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.initialSyncWithDOM=function(){var t=this,n=this.root.parentElement;this.anchorElement=n&&n.classList.contains(Ft.ANCHOR)?n:null,this.root.classList.contains(Ft.FIXED)&&this.setFixedPosition(!0),this.handleKeydown=function(i){t.foundation.handleKeydown(i)},this.handleBodyClick=function(i){t.foundation.handleBodyClick(i)},this.registerBodyClickListener=function(){document.body.addEventListener("click",t.handleBodyClick,{capture:!0})},this.deregisterBodyClickListener=function(){document.body.removeEventListener("click",t.handleBodyClick,{capture:!0})},this.listen("keydown",this.handleKeydown),this.listen(ot.OPENED_EVENT,this.registerBodyClickListener),this.listen(ot.CLOSED_EVENT,this.deregisterBodyClickListener)},e.prototype.destroy=function(){this.unlisten("keydown",this.handleKeydown),this.unlisten(ot.OPENED_EVENT,this.registerBodyClickListener),this.unlisten(ot.CLOSED_EVENT,this.deregisterBodyClickListener),o.prototype.destroy.call(this)},e.prototype.isOpen=function(){return this.foundation.isOpen()},e.prototype.open=function(){this.foundation.open()},e.prototype.close=function(t){t===void 0&&(t=!1),this.foundation.close(t)},Object.defineProperty(e.prototype,"quickOpen",{set:function(t){this.foundation.setQuickOpen(t)},enumerable:!1,configurable:!0}),e.prototype.setIsHoisted=function(t){this.foundation.setIsHoisted(t)},e.prototype.setMenuSurfaceAnchorElement=function(t){this.anchorElement=t},e.prototype.setFixedPosition=function(t){t?this.root.classList.add(Ft.FIXED):this.root.classList.remove(Ft.FIXED),this.foundation.setFixedPosition(t)},e.prototype.setAbsolutePosition=function(t,n){this.foundation.setAbsolutePosition(t,n),this.setIsHoisted(!0)},e.prototype.setAnchorCorner=function(t){this.foundation.setAnchorCorner(t)},e.prototype.setAnchorMargin=function(t){this.foundation.setAnchorMargin(t)},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},removeClass:function(i){return t.root.classList.remove(i)},hasClass:function(i){return t.root.classList.contains(i)},hasAnchor:function(){return!!t.anchorElement},notifyClose:function(){return t.emit(vt.strings.CLOSED_EVENT,{})},notifyClosing:function(){t.emit(vt.strings.CLOSING_EVENT,{})},notifyOpen:function(){return t.emit(vt.strings.OPENED_EVENT,{})},isElementInContainer:function(i){return t.root.contains(i)},isRtl:function(){return getComputedStyle(t.root).getPropertyValue("direction")==="rtl"},setTransformOrigin:function(i){var r=Yt(window,"transform")+"-origin";t.root.style.setProperty(r,i)},isFocused:function(){return document.activeElement===t.root},saveFocus:function(){t.previousFocus=document.activeElement},restoreFocus:function(){t.root.contains(document.activeElement)&&t.previousFocus&&t.previousFocus.focus&&t.previousFocus.focus()},getInnerDimensions:function(){return{width:t.root.offsetWidth,height:t.root.offsetHeight}},getAnchorDimensions:function(){return t.anchorElement?t.anchorElement.getBoundingClientRect():null},getWindowDimensions:function(){return{width:window.innerWidth,height:window.innerHeight}},getBodyDimensions:function(){return{width:document.body.clientWidth,height:document.body.clientHeight}},getWindowScroll:function(){return{x:window.pageXOffset,y:window.pageYOffset}},setPosition:function(i){var r=t.root;r.style.left="left"in i?i.left+"px":"",r.style.right="right"in i?i.right+"px":"",r.style.top="top"in i?i.top+"px":"",r.style.bottom="bottom"in i?i.bottom+"px":""},setMaxHeight:function(i){t.root.style.maxHeight=i}};return new vt(n)},e}(x);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ot={MENU_SELECTED_LIST_ITEM:"mdc-menu-item--selected",MENU_SELECTION_GROUP:"mdc-menu__selection-group",ROOT:"mdc-menu"},et={ARIA_CHECKED_ATTR:"aria-checked",ARIA_DISABLED_ATTR:"aria-disabled",CHECKBOX_SELECTOR:'input[type="checkbox"]',LIST_SELECTOR:".mdc-list,.mdc-deprecated-list",SELECTED_EVENT:"MDCMenu:selected",SKIP_RESTORE_FOCUS:"data-menu-item-skip-restore-focus"},Zn={FOCUS_ROOT_INDEX:-1},It;(function(o){o[o.NONE=0]="NONE",o[o.LIST_ROOT=1]="LIST_ROOT",o[o.FIRST_ITEM=2]="FIRST_ITEM",o[o.LAST_ITEM=3]="LAST_ITEM"})(It||(It={}));/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Jn=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.closeAnimationEndTimerId=0,n.defaultFocusState=It.LIST_ROOT,n.selectedIndex=-1,n}return Object.defineProperty(e,"cssClasses",{get:function(){return Ot},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return et},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return Zn},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClassToElementAtIndex:function(){},removeClassFromElementAtIndex:function(){},addAttributeToElementAtIndex:function(){},removeAttributeFromElementAtIndex:function(){},getAttributeFromElementAtIndex:function(){return null},elementContainsClass:function(){return!1},closeSurface:function(){},getElementIndex:function(){return-1},notifySelected:function(){},getMenuItemCount:function(){return 0},focusItemAtIndex:function(){},focusListRoot:function(){},getSelectedSiblingOfItemAtIndex:function(){return-1},isSelectableItemAtIndex:function(){return!1}}},enumerable:!1,configurable:!0}),e.prototype.destroy=function(){this.closeAnimationEndTimerId&&clearTimeout(this.closeAnimationEndTimerId),this.adapter.closeSurface()},e.prototype.handleKeydown=function(t){var n=t.key,i=t.keyCode,r=n==="Tab"||i===9;r&&this.adapter.closeSurface(!0)},e.prototype.handleItemAction=function(t){var n=this,i=this.adapter.getElementIndex(t);if(!(i<0)){this.adapter.notifySelected({index:i});var r=this.adapter.getAttributeFromElementAtIndex(i,et.SKIP_RESTORE_FOCUS)==="true";this.adapter.closeSurface(r),this.closeAnimationEndTimerId=setTimeout(function(){var a=n.adapter.getElementIndex(t);a>=0&&n.adapter.isSelectableItemAtIndex(a)&&n.setSelectedIndex(a)},vt.numbers.TRANSITION_CLOSE_DURATION)}},e.prototype.handleMenuSurfaceOpened=function(){switch(this.defaultFocusState){case It.FIRST_ITEM:this.adapter.focusItemAtIndex(0);break;case It.LAST_ITEM:this.adapter.focusItemAtIndex(this.adapter.getMenuItemCount()-1);break;case It.NONE:break;default:this.adapter.focusListRoot();break}},e.prototype.setDefaultFocusState=function(t){this.defaultFocusState=t},e.prototype.getSelectedIndex=function(){return this.selectedIndex},e.prototype.setSelectedIndex=function(t){if(this.validatedIndex(t),!this.adapter.isSelectableItemAtIndex(t))throw new Error("MDCMenuFoundation: No selection group at specified index.");var n=this.adapter.getSelectedSiblingOfItemAtIndex(t);n>=0&&(this.adapter.removeAttributeFromElementAtIndex(n,et.ARIA_CHECKED_ATTR),this.adapter.removeClassFromElementAtIndex(n,Ot.MENU_SELECTED_LIST_ITEM)),this.adapter.addClassToElementAtIndex(t,Ot.MENU_SELECTED_LIST_ITEM),this.adapter.addAttributeToElementAtIndex(t,et.ARIA_CHECKED_ATTR,"true"),this.selectedIndex=t},e.prototype.setEnabled=function(t,n){this.validatedIndex(t),n?(this.adapter.removeClassFromElementAtIndex(t,m.LIST_ITEM_DISABLED_CLASS),this.adapter.addAttributeToElementAtIndex(t,et.ARIA_DISABLED_ATTR,"false")):(this.adapter.addClassToElementAtIndex(t,m.LIST_ITEM_DISABLED_CLASS),this.adapter.addAttributeToElementAtIndex(t,et.ARIA_DISABLED_ATTR,"true"))},e.prototype.validatedIndex=function(t){var n=this.adapter.getMenuItemCount(),i=t>=0&&t<n;if(!i)throw new Error("MDCMenuFoundation: No list item at specified index.")},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var ce=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.initialize=function(t,n){t===void 0&&(t=function(i){return new Qn(i)}),n===void 0&&(n=function(i){return new on(i)}),this.menuSurfaceFactory=t,this.listFactory=n},e.prototype.initialSyncWithDOM=function(){var t=this;this.menuSurface=this.menuSurfaceFactory(this.root);var n=this.root.querySelector(et.LIST_SELECTOR);n?(this.list=this.listFactory(n),this.list.wrapFocus=!0):this.list=null,this.handleKeydown=function(i){t.foundation.handleKeydown(i)},this.handleItemAction=function(i){t.foundation.handleItemAction(t.items[i.detail.index])},this.handleMenuSurfaceOpened=function(){t.foundation.handleMenuSurfaceOpened()},this.menuSurface.listen(vt.strings.OPENED_EVENT,this.handleMenuSurfaceOpened),this.listen("keydown",this.handleKeydown),this.listen(ue.strings.ACTION_EVENT,this.handleItemAction)},e.prototype.destroy=function(){this.list&&this.list.destroy(),this.menuSurface.destroy(),this.menuSurface.unlisten(vt.strings.OPENED_EVENT,this.handleMenuSurfaceOpened),this.unlisten("keydown",this.handleKeydown),this.unlisten(ue.strings.ACTION_EVENT,this.handleItemAction),o.prototype.destroy.call(this)},Object.defineProperty(e.prototype,"open",{get:function(){return this.menuSurface.isOpen()},set:function(t){t?this.menuSurface.open():this.menuSurface.close()},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"wrapFocus",{get:function(){return this.list?this.list.wrapFocus:!1},set:function(t){this.list&&(this.list.wrapFocus=t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"hasTypeahead",{set:function(t){this.list&&(this.list.hasTypeahead=t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"typeaheadInProgress",{get:function(){return this.list?this.list.typeaheadInProgress:!1},enumerable:!1,configurable:!0}),e.prototype.typeaheadMatchItem=function(t,n){return this.list?this.list.typeaheadMatchItem(t,n):-1},e.prototype.layout=function(){this.list&&this.list.layout()},Object.defineProperty(e.prototype,"items",{get:function(){return this.list?this.list.listElements:[]},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"singleSelection",{set:function(t){this.list&&(this.list.singleSelection=t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"selectedIndex",{get:function(){return this.list?this.list.selectedIndex:H.UNSET_INDEX},set:function(t){this.list&&(this.list.selectedIndex=t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"quickOpen",{set:function(t){this.menuSurface.quickOpen=t},enumerable:!1,configurable:!0}),e.prototype.setDefaultFocusState=function(t){this.foundation.setDefaultFocusState(t)},e.prototype.setAnchorCorner=function(t){this.menuSurface.setAnchorCorner(t)},e.prototype.setAnchorMargin=function(t){this.menuSurface.setAnchorMargin(t)},e.prototype.setSelectedIndex=function(t){this.foundation.setSelectedIndex(t)},e.prototype.setEnabled=function(t,n){this.foundation.setEnabled(t,n)},e.prototype.getOptionByIndex=function(t){var n=this.items;return t<n.length?this.items[t]:null},e.prototype.getPrimaryTextAtIndex=function(t){var n=this.getOptionByIndex(t);return n&&this.list&&this.list.getPrimaryText(n)||""},e.prototype.setFixedPosition=function(t){this.menuSurface.setFixedPosition(t)},e.prototype.setIsHoisted=function(t){this.menuSurface.setIsHoisted(t)},e.prototype.setAbsolutePosition=function(t,n){this.menuSurface.setAbsolutePosition(t,n)},e.prototype.setAnchorElement=function(t){this.menuSurface.anchorElement=t},e.prototype.getDefaultFoundation=function(){var t=this,n={addClassToElementAtIndex:function(i,r){var a=t.items;a[i].classList.add(r)},removeClassFromElementAtIndex:function(i,r){var a=t.items;a[i].classList.remove(r)},addAttributeToElementAtIndex:function(i,r,a){var s=t.items;s[i].setAttribute(r,a)},removeAttributeFromElementAtIndex:function(i,r){var a=t.items;a[i].removeAttribute(r)},getAttributeFromElementAtIndex:function(i,r){var a=t.items;return a[i].getAttribute(r)},elementContainsClass:function(i,r){return i.classList.contains(r)},closeSurface:function(i){t.menuSurface.close(i)},getElementIndex:function(i){return t.items.indexOf(i)},notifySelected:function(i){t.emit(et.SELECTED_EVENT,{index:i.index,item:t.items[i.index]})},getMenuItemCount:function(){return t.items.length},focusItemAtIndex:function(i){t.items[i].focus()},focusListRoot:function(){t.root.querySelector(et.LIST_SELECTOR).focus()},isSelectableItemAtIndex:function(i){return!!dt(t.items[i],"."+Ot.MENU_SELECTION_GROUP)},getSelectedSiblingOfItemAtIndex:function(i){var r=dt(t.items[i],"."+Ot.MENU_SELECTION_GROUP),a=r.querySelector("."+Ot.MENU_SELECTED_LIST_ITEM);return a?t.items.indexOf(a):-1}};return new Jn(n)},e}(x);/**
 * @license
 * Copyright 2021 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Tt;(function(o){o.PROCESSING="mdc-switch--processing",o.SELECTED="mdc-switch--selected",o.UNSELECTED="mdc-switch--unselected"})(Tt||(Tt={}));var Qt;(function(o){o.RIPPLE=".mdc-switch__ripple"})(Qt||(Qt={}));/**
 * @license
 * Copyright 2021 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */function ti(o,e,t){var n=ei(o,e),i=n.getObservers(e);return i.push(t),function(){i.splice(i.indexOf(t),1)}}var $t=new WeakMap;function ei(o,e){var t=new Map;$t.has(o)||$t.set(o,{isEnabled:!0,getObservers:function(u){var d=t.get(u)||[];return t.has(u)||t.set(u,d),d},installedProperties:new Set});var n=$t.get(o);if(n.installedProperties.has(e))return n;var i=ni(o,e)||{configurable:!0,enumerable:!0,value:o[e],writable:!0},r=f({},i),a=i.get,s=i.set;if("value"in i){delete r.value,delete r.writable;var l=i.value;a=function(){return l},i.writable&&(s=function(u){l=u})}return a&&(r.get=function(){return a.call(this)}),s&&(r.set=function(u){var d,h,p=a?a.call(this):u;if(s.call(this,u),n.isEnabled&&(!a||u!==p))try{for(var c=O(n.getObservers(e)),E=c.next();!E.done;E=c.next()){var g=E.value;g(u,p)}}catch(A){d={error:A}}finally{try{E&&!E.done&&(h=c.return)&&h.call(c)}finally{if(d)throw d.error}}}),n.installedProperties.add(e),Object.defineProperty(o,e,r),n}function ni(o,e){for(var t=o,n;t&&(n=Object.getOwnPropertyDescriptor(t,e),!n);)t=Object.getPrototypeOf(t);return n}function ii(o,e){var t=$t.get(o);t&&(t.isEnabled=e)}/**
 * @license
 * Copyright 2021 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var ri=function(o){v(e,o);function e(t){var n=o.call(this,t)||this;return n.unobserves=new Set,n}return e.prototype.destroy=function(){o.prototype.destroy.call(this),this.unobserve()},e.prototype.observe=function(t,n){var i,r,a=this,s=[];try{for(var l=O(Object.keys(n)),u=l.next();!u.done;u=l.next()){var d=u.value,h=n[d].bind(this);s.push(this.observeProperty(t,d,h))}}catch(c){i={error:c}}finally{try{u&&!u.done&&(r=l.return)&&r.call(l)}finally{if(i)throw i.error}}var p=function(){var c,E;try{for(var g=O(s),A=g.next();!A.done;A=g.next()){var T=A.value;T()}}catch(N){c={error:N}}finally{try{A&&!A.done&&(E=g.return)&&E.call(g)}finally{if(c)throw c.error}}a.unobserves.delete(p)};return this.unobserves.add(p),p},e.prototype.observeProperty=function(t,n,i){return ti(t,n,i)},e.prototype.setObserversEnabled=function(t,n){ii(t,n)},e.prototype.unobserve=function(){var t,n;try{for(var i=O(Ge([],Ve(this.unobserves))),r=i.next();!r.done;r=i.next()){var a=r.value;a()}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}},e}(D);/**
 * @license
 * Copyright 2021 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var oi=function(o){v(e,o);function e(t){var n=o.call(this,t)||this;return n.handleClick=n.handleClick.bind(n),n}return e.prototype.init=function(){this.observe(this.adapter.state,{disabled:this.stopProcessingIfDisabled,processing:this.stopProcessingIfDisabled})},e.prototype.handleClick=function(){this.adapter.state.disabled||(this.adapter.state.selected=!this.adapter.state.selected)},e.prototype.stopProcessingIfDisabled=function(){this.adapter.state.disabled&&(this.adapter.state.processing=!1)},e}(ri),ai=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.prototype.init=function(){o.prototype.init.call(this),this.observe(this.adapter.state,{disabled:this.onDisabledChange,processing:this.onProcessingChange,selected:this.onSelectedChange})},e.prototype.initFromDOM=function(){this.setObserversEnabled(this.adapter.state,!1),this.adapter.state.selected=this.adapter.hasClass(Tt.SELECTED),this.onSelectedChange(),this.adapter.state.disabled=this.adapter.isDisabled(),this.adapter.state.processing=this.adapter.hasClass(Tt.PROCESSING),this.setObserversEnabled(this.adapter.state,!0),this.stopProcessingIfDisabled()},e.prototype.onDisabledChange=function(){this.adapter.setDisabled(this.adapter.state.disabled)},e.prototype.onProcessingChange=function(){this.toggleClass(this.adapter.state.processing,Tt.PROCESSING)},e.prototype.onSelectedChange=function(){this.adapter.setAriaChecked(String(this.adapter.state.selected)),this.toggleClass(this.adapter.state.selected,Tt.SELECTED),this.toggleClass(!this.adapter.state.selected,Tt.UNSELECTED)},e.prototype.toggleClass=function(t,n){t?this.adapter.addClass(n):this.adapter.removeClass(n)},e}(oi);/**
 * @license
 * Copyright 2021 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var si=function(o){v(e,o);function e(t,n){var i=o.call(this,t,n)||this;return i.root=t,i}return e.attachTo=function(t){return new e(t)},e.prototype.initialize=function(){this.ripple=new U(this.root,this.createRippleFoundation())},e.prototype.initialSyncWithDOM=function(){var t=this.root.querySelector(Qt.RIPPLE);if(!t)throw new Error("Switch "+Qt.RIPPLE+" element is required.");this.rippleElement=t,this.root.addEventListener("click",this.foundation.handleClick),this.foundation.initFromDOM()},e.prototype.destroy=function(){o.prototype.destroy.call(this),this.ripple.destroy(),this.root.removeEventListener("click",this.foundation.handleClick)},e.prototype.getDefaultFoundation=function(){return new ai(this.createAdapter())},e.prototype.createAdapter=function(){var t=this;return{addClass:function(n){t.root.classList.add(n)},hasClass:function(n){return t.root.classList.contains(n)},isDisabled:function(){return t.root.disabled},removeClass:function(n){t.root.classList.remove(n)},setAriaChecked:function(n){return t.root.setAttribute("aria-checked",n)},setDisabled:function(n){t.root.disabled=n},state:this}},e.prototype.createRippleFoundation=function(){return new bt(this.createRippleAdapter())},e.prototype.createRippleAdapter=function(){var t=this;return f(f({},U.createAdapter(this)),{computeBoundingRect:function(){return t.rippleElement.getBoundingClientRect()},isUnbounded:function(){return!0}})},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */function ui(o,e,t){return e(o,{initialFocusEl:t})}function li(o){return o?o.scrollHeight>o.offsetHeight:!1}function di(o){return o?o.scrollTop===0:!1}function ci(o){return o?Math.ceil(o.scrollHeight-o.scrollTop)===o.clientHeight:!1}function hi(o){var e=new Set;return[].forEach.call(o,function(t){return e.add(t.offsetTop)}),e.size>1}/**
 * @license
 * Copyright 2020 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var te="mdc-dom-focus-sentinel",fi=function(){function o(e,t){t===void 0&&(t={}),this.root=e,this.options=t,this.elFocusedBeforeTrapFocus=null}return o.prototype.trapFocus=function(){var e=this.getFocusableElements(this.root);if(e.length===0)throw new Error("FocusTrap: Element must have at least one focusable child.");this.elFocusedBeforeTrapFocus=document.activeElement instanceof HTMLElement?document.activeElement:null,this.wrapTabFocus(this.root),this.options.skipInitialFocus||this.focusInitialElement(e,this.options.initialFocusEl)},o.prototype.releaseFocus=function(){[].slice.call(this.root.querySelectorAll("."+te)).forEach(function(e){e.parentElement.removeChild(e)}),!this.options.skipRestoreFocus&&this.elFocusedBeforeTrapFocus&&this.elFocusedBeforeTrapFocus.focus()},o.prototype.wrapTabFocus=function(e){var t=this,n=this.createSentinel(),i=this.createSentinel();n.addEventListener("focus",function(){var r=t.getFocusableElements(e);r.length>0&&r[r.length-1].focus()}),i.addEventListener("focus",function(){var r=t.getFocusableElements(e);r.length>0&&r[0].focus()}),e.insertBefore(n,e.children[0]),e.appendChild(i)},o.prototype.focusInitialElement=function(e,t){var n=0;t&&(n=Math.max(e.indexOf(t),0)),e[n].focus()},o.prototype.getFocusableElements=function(e){var t=[].slice.call(e.querySelectorAll("[autofocus], [tabindex], a, input, textarea, select, button"));return t.filter(function(n){var i=n.getAttribute("aria-disabled")==="true"||n.getAttribute("disabled")!=null||n.getAttribute("hidden")!=null||n.getAttribute("aria-hidden")==="true",r=n.tabIndex>=0&&n.getBoundingClientRect().width>0&&!n.classList.contains(te)&&!i,a=!1;if(r){var s=getComputedStyle(n);a=s.display==="none"||s.visibility==="hidden"}return r&&!a})},o.prototype.createSentinel=function(){var e=document.createElement("div");return e.setAttribute("tabindex","0"),e.setAttribute("aria-hidden","true"),e.classList.add(te),e},o}();/**
 * @license
 * Copyright 2020 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var an=function(){function o(){this.rafIDs=new Map}return o.prototype.request=function(e,t){var n=this;this.cancel(e);var i=requestAnimationFrame(function(r){n.rafIDs.delete(e),t(r)});this.rafIDs.set(e,i)},o.prototype.cancel=function(e){var t=this.rafIDs.get(e);t&&(cancelAnimationFrame(t),this.rafIDs.delete(e))},o.prototype.cancelAll=function(){var e=this;this.rafIDs.forEach(function(t,n){e.cancel(n)})},o.prototype.getQueue=function(){var e=[];return this.rafIDs.forEach(function(t,n){e.push(n)}),e},o}();/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var b={CLOSING:"mdc-dialog--closing",OPEN:"mdc-dialog--open",OPENING:"mdc-dialog--opening",SCROLLABLE:"mdc-dialog--scrollable",SCROLL_LOCK:"mdc-dialog-scroll-lock",STACKED:"mdc-dialog--stacked",FULLSCREEN:"mdc-dialog--fullscreen",SCROLL_DIVIDER_HEADER:"mdc-dialog-scroll-divider-header",SCROLL_DIVIDER_FOOTER:"mdc-dialog-scroll-divider-footer",SURFACE_SCRIM_SHOWN:"mdc-dialog__surface-scrim--shown",SURFACE_SCRIM_SHOWING:"mdc-dialog__surface-scrim--showing",SURFACE_SCRIM_HIDING:"mdc-dialog__surface-scrim--hiding",SCRIM_HIDDEN:"mdc-dialog__scrim--hidden"},Nt={ACTION_ATTRIBUTE:"data-mdc-dialog-action",BUTTON_DEFAULT_ATTRIBUTE:"data-mdc-dialog-button-default",BUTTON_SELECTOR:".mdc-dialog__button",CLOSED_EVENT:"MDCDialog:closed",CLOSE_ACTION:"close",CLOSING_EVENT:"MDCDialog:closing",CONTAINER_SELECTOR:".mdc-dialog__container",CONTENT_SELECTOR:".mdc-dialog__content",DESTROY_ACTION:"destroy",INITIAL_FOCUS_ATTRIBUTE:"data-mdc-dialog-initial-focus",OPENED_EVENT:"MDCDialog:opened",OPENING_EVENT:"MDCDialog:opening",SCRIM_SELECTOR:".mdc-dialog__scrim",SUPPRESS_DEFAULT_PRESS_SELECTOR:["textarea",".mdc-menu .mdc-list-item",".mdc-menu .mdc-deprecated-list-item"].join(", "),SURFACE_SELECTOR:".mdc-dialog__surface"},ee={DIALOG_ANIMATION_CLOSE_TIME_MS:75,DIALOG_ANIMATION_OPEN_TIME_MS:150};/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Zt;(function(o){o.POLL_SCROLL_POS="poll_scroll_position",o.POLL_LAYOUT_CHANGE="poll_layout_change"})(Zt||(Zt={}));var sn=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.dialogOpen=!1,n.isFullscreen=!1,n.animationFrame=0,n.animationTimer=0,n.escapeKeyAction=Nt.CLOSE_ACTION,n.scrimClickAction=Nt.CLOSE_ACTION,n.autoStackButtons=!0,n.areButtonsStacked=!1,n.suppressDefaultPressSelector=Nt.SUPPRESS_DEFAULT_PRESS_SELECTOR,n.animFrame=new an,n.contentScrollHandler=function(){n.handleScrollEvent()},n.windowResizeHandler=function(){n.layout()},n.windowOrientationChangeHandler=function(){n.layout()},n}return Object.defineProperty(e,"cssClasses",{get:function(){return b},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return Nt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return ee},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addBodyClass:function(){},addClass:function(){},areButtonsStacked:function(){return!1},clickDefaultButton:function(){},eventTargetMatches:function(){return!1},getActionFromEvent:function(){return""},getInitialFocusEl:function(){return null},hasClass:function(){return!1},isContentScrollable:function(){return!1},notifyClosed:function(){},notifyClosing:function(){},notifyOpened:function(){},notifyOpening:function(){},releaseFocus:function(){},removeBodyClass:function(){},removeClass:function(){},reverseButtons:function(){},trapFocus:function(){},registerContentEventHandler:function(){},deregisterContentEventHandler:function(){},isScrollableContentAtTop:function(){return!1},isScrollableContentAtBottom:function(){return!1},registerWindowEventHandler:function(){},deregisterWindowEventHandler:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){this.adapter.hasClass(b.STACKED)&&this.setAutoStackButtons(!1),this.isFullscreen=this.adapter.hasClass(b.FULLSCREEN)},e.prototype.destroy=function(){this.animationTimer&&(clearTimeout(this.animationTimer),this.handleAnimationTimerEnd()),this.isFullscreen&&this.adapter.deregisterContentEventHandler("scroll",this.contentScrollHandler),this.animFrame.cancelAll(),this.adapter.deregisterWindowEventHandler("resize",this.windowResizeHandler),this.adapter.deregisterWindowEventHandler("orientationchange",this.windowOrientationChangeHandler)},e.prototype.open=function(t){var n=this;this.dialogOpen=!0,this.adapter.notifyOpening(),this.adapter.addClass(b.OPENING),this.isFullscreen&&this.adapter.registerContentEventHandler("scroll",this.contentScrollHandler),t&&t.isAboveFullscreenDialog&&this.adapter.addClass(b.SCRIM_HIDDEN),this.adapter.registerWindowEventHandler("resize",this.windowResizeHandler),this.adapter.registerWindowEventHandler("orientationchange",this.windowOrientationChangeHandler),this.runNextAnimationFrame(function(){n.adapter.addClass(b.OPEN),n.adapter.addBodyClass(b.SCROLL_LOCK),n.layout(),n.animationTimer=setTimeout(function(){n.handleAnimationTimerEnd(),n.adapter.trapFocus(n.adapter.getInitialFocusEl()),n.adapter.notifyOpened()},ee.DIALOG_ANIMATION_OPEN_TIME_MS)})},e.prototype.close=function(t){var n=this;t===void 0&&(t=""),this.dialogOpen&&(this.dialogOpen=!1,this.adapter.notifyClosing(t),this.adapter.addClass(b.CLOSING),this.adapter.removeClass(b.OPEN),this.adapter.removeBodyClass(b.SCROLL_LOCK),this.isFullscreen&&this.adapter.deregisterContentEventHandler("scroll",this.contentScrollHandler),this.adapter.deregisterWindowEventHandler("resize",this.windowResizeHandler),this.adapter.deregisterWindowEventHandler("orientationchange",this.windowOrientationChangeHandler),cancelAnimationFrame(this.animationFrame),this.animationFrame=0,clearTimeout(this.animationTimer),this.animationTimer=setTimeout(function(){n.adapter.releaseFocus(),n.handleAnimationTimerEnd(),n.adapter.notifyClosed(t)},ee.DIALOG_ANIMATION_CLOSE_TIME_MS))},e.prototype.showSurfaceScrim=function(){var t=this;this.adapter.addClass(b.SURFACE_SCRIM_SHOWING),this.runNextAnimationFrame(function(){t.adapter.addClass(b.SURFACE_SCRIM_SHOWN)})},e.prototype.hideSurfaceScrim=function(){this.adapter.removeClass(b.SURFACE_SCRIM_SHOWN),this.adapter.addClass(b.SURFACE_SCRIM_HIDING)},e.prototype.handleSurfaceScrimTransitionEnd=function(){this.adapter.removeClass(b.SURFACE_SCRIM_HIDING),this.adapter.removeClass(b.SURFACE_SCRIM_SHOWING)},e.prototype.isOpen=function(){return this.dialogOpen},e.prototype.getEscapeKeyAction=function(){return this.escapeKeyAction},e.prototype.setEscapeKeyAction=function(t){this.escapeKeyAction=t},e.prototype.getScrimClickAction=function(){return this.scrimClickAction},e.prototype.setScrimClickAction=function(t){this.scrimClickAction=t},e.prototype.getAutoStackButtons=function(){return this.autoStackButtons},e.prototype.setAutoStackButtons=function(t){this.autoStackButtons=t},e.prototype.getSuppressDefaultPressSelector=function(){return this.suppressDefaultPressSelector},e.prototype.setSuppressDefaultPressSelector=function(t){this.suppressDefaultPressSelector=t},e.prototype.layout=function(){var t=this;this.animFrame.request(Zt.POLL_LAYOUT_CHANGE,function(){t.layoutInternal()})},e.prototype.handleClick=function(t){var n=this.adapter.eventTargetMatches(t.target,Nt.SCRIM_SELECTOR);if(n&&this.scrimClickAction!=="")this.close(this.scrimClickAction);else{var i=this.adapter.getActionFromEvent(t);i&&this.close(i)}},e.prototype.handleKeydown=function(t){var n=t.key==="Enter"||t.keyCode===13;if(n){var i=this.adapter.getActionFromEvent(t);if(!i){var r=t.composedPath?t.composedPath()[0]:t.target,a=this.suppressDefaultPressSelector?!this.adapter.eventTargetMatches(r,this.suppressDefaultPressSelector):!0;n&&a&&this.adapter.clickDefaultButton()}}},e.prototype.handleDocumentKeydown=function(t){var n=t.key==="Escape"||t.keyCode===27;n&&this.escapeKeyAction!==""&&this.close(this.escapeKeyAction)},e.prototype.handleScrollEvent=function(){var t=this;this.animFrame.request(Zt.POLL_SCROLL_POS,function(){t.toggleScrollDividerHeader(),t.toggleScrollDividerFooter()})},e.prototype.layoutInternal=function(){this.autoStackButtons&&this.detectStackedButtons(),this.toggleScrollableClasses()},e.prototype.handleAnimationTimerEnd=function(){this.animationTimer=0,this.adapter.removeClass(b.OPENING),this.adapter.removeClass(b.CLOSING)},e.prototype.runNextAnimationFrame=function(t){var n=this;cancelAnimationFrame(this.animationFrame),this.animationFrame=requestAnimationFrame(function(){n.animationFrame=0,clearTimeout(n.animationTimer),n.animationTimer=setTimeout(t,0)})},e.prototype.detectStackedButtons=function(){this.adapter.removeClass(b.STACKED);var t=this.adapter.areButtonsStacked();t&&this.adapter.addClass(b.STACKED),t!==this.areButtonsStacked&&(this.adapter.reverseButtons(),this.areButtonsStacked=t)},e.prototype.toggleScrollableClasses=function(){this.adapter.removeClass(b.SCROLLABLE),this.adapter.isContentScrollable()&&(this.adapter.addClass(b.SCROLLABLE),this.isFullscreen&&(this.toggleScrollDividerHeader(),this.toggleScrollDividerFooter()))},e.prototype.toggleScrollDividerHeader=function(){this.adapter.isScrollableContentAtTop()?this.adapter.hasClass(b.SCROLL_DIVIDER_HEADER)&&this.adapter.removeClass(b.SCROLL_DIVIDER_HEADER):this.adapter.addClass(b.SCROLL_DIVIDER_HEADER)},e.prototype.toggleScrollDividerFooter=function(){this.adapter.isScrollableContentAtBottom()?this.adapter.hasClass(b.SCROLL_DIVIDER_FOOTER)&&this.adapter.removeClass(b.SCROLL_DIVIDER_FOOTER):this.adapter.addClass(b.SCROLL_DIVIDER_FOOTER)},e}(D);/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var V=sn.strings,kt=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return Object.defineProperty(e.prototype,"isOpen",{get:function(){return this.foundation.isOpen()},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"escapeKeyAction",{get:function(){return this.foundation.getEscapeKeyAction()},set:function(t){this.foundation.setEscapeKeyAction(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"scrimClickAction",{get:function(){return this.foundation.getScrimClickAction()},set:function(t){this.foundation.setScrimClickAction(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"autoStackButtons",{get:function(){return this.foundation.getAutoStackButtons()},set:function(t){this.foundation.setAutoStackButtons(t)},enumerable:!1,configurable:!0}),e.attachTo=function(t){return new e(t)},e.prototype.initialize=function(t){var n,i;t===void 0&&(t=function(u,d){return new fi(u,d)});var r=this.root.querySelector(V.CONTAINER_SELECTOR);if(!r)throw new Error("Dialog component requires a "+V.CONTAINER_SELECTOR+" container element");this.container=r,this.content=this.root.querySelector(V.CONTENT_SELECTOR),this.buttons=[].slice.call(this.root.querySelectorAll(V.BUTTON_SELECTOR)),this.defaultButton=this.root.querySelector("["+V.BUTTON_DEFAULT_ATTRIBUTE+"]"),this.focusTrapFactory=t,this.buttonRipples=[];try{for(var a=O(this.buttons),s=a.next();!s.done;s=a.next()){var l=s.value;this.buttonRipples.push(new U(l))}}catch(u){n={error:u}}finally{try{s&&!s.done&&(i=a.return)&&i.call(a)}finally{if(n)throw n.error}}},e.prototype.initialSyncWithDOM=function(){var t=this;this.focusTrap=ui(this.container,this.focusTrapFactory,this.getInitialFocusEl()||void 0),this.handleClick=this.foundation.handleClick.bind(this.foundation),this.handleKeydown=this.foundation.handleKeydown.bind(this.foundation),this.handleDocumentKeydown=this.foundation.handleDocumentKeydown.bind(this.foundation),this.handleOpening=function(){document.addEventListener("keydown",t.handleDocumentKeydown)},this.handleClosing=function(){document.removeEventListener("keydown",t.handleDocumentKeydown)},this.listen("click",this.handleClick),this.listen("keydown",this.handleKeydown),this.listen(V.OPENING_EVENT,this.handleOpening),this.listen(V.CLOSING_EVENT,this.handleClosing)},e.prototype.destroy=function(){this.unlisten("click",this.handleClick),this.unlisten("keydown",this.handleKeydown),this.unlisten(V.OPENING_EVENT,this.handleOpening),this.unlisten(V.CLOSING_EVENT,this.handleClosing),this.handleClosing(),this.buttonRipples.forEach(function(t){t.destroy()}),o.prototype.destroy.call(this)},e.prototype.layout=function(){this.foundation.layout()},e.prototype.open=function(){this.foundation.open()},e.prototype.close=function(t){t===void 0&&(t=""),this.foundation.close(t)},e.prototype.getDefaultFoundation=function(){var t=this,n={addBodyClass:function(i){return document.body.classList.add(i)},addClass:function(i){return t.root.classList.add(i)},areButtonsStacked:function(){return hi(t.buttons)},clickDefaultButton:function(){t.defaultButton&&!t.defaultButton.disabled&&t.defaultButton.click()},eventTargetMatches:function(i,r){return i?rt(i,r):!1},getActionFromEvent:function(i){if(!i.target)return"";var r=dt(i.target,"["+V.ACTION_ATTRIBUTE+"]");return r&&r.getAttribute(V.ACTION_ATTRIBUTE)},getInitialFocusEl:function(){return t.getInitialFocusEl()},hasClass:function(i){return t.root.classList.contains(i)},isContentScrollable:function(){return li(t.content)},notifyClosed:function(i){return t.emit(V.CLOSED_EVENT,i?{action:i}:{})},notifyClosing:function(i){return t.emit(V.CLOSING_EVENT,i?{action:i}:{})},notifyOpened:function(){return t.emit(V.OPENED_EVENT,{})},notifyOpening:function(){return t.emit(V.OPENING_EVENT,{})},releaseFocus:function(){t.focusTrap.releaseFocus()},removeBodyClass:function(i){return document.body.classList.remove(i)},removeClass:function(i){return t.root.classList.remove(i)},reverseButtons:function(){t.buttons.reverse(),t.buttons.forEach(function(i){i.parentElement.appendChild(i)})},trapFocus:function(){t.focusTrap.trapFocus()},registerContentEventHandler:function(i,r){t.content instanceof HTMLElement&&t.content.addEventListener(i,r)},deregisterContentEventHandler:function(i,r){t.content instanceof HTMLElement&&t.content.removeEventListener(i,r)},isScrollableContentAtTop:function(){return di(t.content)},isScrollableContentAtBottom:function(){return ci(t.content)},registerWindowEventHandler:function(i,r){window.addEventListener(i,r)},deregisterWindowEventHandler:function(i,r){window.removeEventListener(i,r)}};return new sn(n)},e.prototype.getInitialFocusEl=function(){return this.root.querySelector("["+V.INITIAL_FOCUS_ATTRIBUTE+"]")},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var L={ACTIVATED:"mdc-select--activated",DISABLED:"mdc-select--disabled",FOCUSED:"mdc-select--focused",INVALID:"mdc-select--invalid",MENU_INVALID:"mdc-select__menu--invalid",OUTLINED:"mdc-select--outlined",REQUIRED:"mdc-select--required",ROOT:"mdc-select",WITH_LEADING_ICON:"mdc-select--with-leading-icon"},B={ARIA_CONTROLS:"aria-controls",ARIA_DESCRIBEDBY:"aria-describedby",ARIA_SELECTED_ATTR:"aria-selected",CHANGE_EVENT:"MDCSelect:change",HIDDEN_INPUT_SELECTOR:'input[type="hidden"]',LABEL_SELECTOR:".mdc-floating-label",LEADING_ICON_SELECTOR:".mdc-select__icon",LINE_RIPPLE_SELECTOR:".mdc-line-ripple",MENU_SELECTOR:".mdc-select__menu",OUTLINE_SELECTOR:".mdc-notched-outline",SELECTED_TEXT_SELECTOR:".mdc-select__selected-text",SELECT_ANCHOR_SELECTOR:".mdc-select__anchor",VALUE_ATTR:"data-value"},pt={LABEL_SCALE:.75,UNSET_INDEX:-1,CLICK_DEBOUNCE_TIMEOUT_MS:330};/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var pi=function(o){v(e,o);function e(t,n){n===void 0&&(n={});var i=o.call(this,f(f({},e.defaultAdapter),t))||this;return i.disabled=!1,i.isMenuOpen=!1,i.useDefaultValidation=!0,i.customValidity=!0,i.lastSelectedIndex=pt.UNSET_INDEX,i.clickDebounceTimeout=0,i.recentlyClicked=!1,i.leadingIcon=n.leadingIcon,i.helperText=n.helperText,i}return Object.defineProperty(e,"cssClasses",{get:function(){return L},enumerable:!1,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return pt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return B},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},hasClass:function(){return!1},activateBottomLine:function(){},deactivateBottomLine:function(){},getSelectedIndex:function(){return-1},setSelectedIndex:function(){},hasLabel:function(){return!1},floatLabel:function(){},getLabelWidth:function(){return 0},setLabelRequired:function(){},hasOutline:function(){return!1},notchOutline:function(){},closeOutline:function(){},setRippleCenter:function(){},notifyChange:function(){},setSelectedText:function(){},isSelectAnchorFocused:function(){return!1},getSelectAnchorAttr:function(){return""},setSelectAnchorAttr:function(){},removeSelectAnchorAttr:function(){},addMenuClass:function(){},removeMenuClass:function(){},openMenu:function(){},closeMenu:function(){},getAnchorElement:function(){return null},setMenuAnchorElement:function(){},setMenuAnchorCorner:function(){},setMenuWrapFocus:function(){},focusMenuItemAtIndex:function(){},getMenuItemCount:function(){return 0},getMenuItemValues:function(){return[]},getMenuItemTextAtIndex:function(){return""},isTypeaheadInProgress:function(){return!1},typeaheadMatchItem:function(){return-1}}},enumerable:!1,configurable:!0}),e.prototype.getSelectedIndex=function(){return this.adapter.getSelectedIndex()},e.prototype.setSelectedIndex=function(t,n,i){n===void 0&&(n=!1),i===void 0&&(i=!1),!(t>=this.adapter.getMenuItemCount())&&(t===pt.UNSET_INDEX?this.adapter.setSelectedText(""):this.adapter.setSelectedText(this.adapter.getMenuItemTextAtIndex(t).trim()),this.adapter.setSelectedIndex(t),n&&this.adapter.closeMenu(),!i&&this.lastSelectedIndex!==t&&this.handleChange(),this.lastSelectedIndex=t)},e.prototype.setValue=function(t,n){n===void 0&&(n=!1);var i=this.adapter.getMenuItemValues().indexOf(t);this.setSelectedIndex(i,!1,n)},e.prototype.getValue=function(){var t=this.adapter.getSelectedIndex(),n=this.adapter.getMenuItemValues();return t!==pt.UNSET_INDEX?n[t]:""},e.prototype.getDisabled=function(){return this.disabled},e.prototype.setDisabled=function(t){this.disabled=t,this.disabled?(this.adapter.addClass(L.DISABLED),this.adapter.closeMenu()):this.adapter.removeClass(L.DISABLED),this.leadingIcon&&this.leadingIcon.setDisabled(this.disabled),this.disabled?this.adapter.removeSelectAnchorAttr("tabindex"):this.adapter.setSelectAnchorAttr("tabindex","0"),this.adapter.setSelectAnchorAttr("aria-disabled",this.disabled.toString())},e.prototype.openMenu=function(){this.adapter.addClass(L.ACTIVATED),this.adapter.openMenu(),this.isMenuOpen=!0,this.adapter.setSelectAnchorAttr("aria-expanded","true")},e.prototype.setHelperTextContent=function(t){this.helperText&&this.helperText.setContent(t)},e.prototype.layout=function(){if(this.adapter.hasLabel()){var t=this.getValue().length>0,n=this.adapter.hasClass(L.FOCUSED),i=t||n,r=this.adapter.hasClass(L.REQUIRED);this.notchOutline(i),this.adapter.floatLabel(i),this.adapter.setLabelRequired(r)}},e.prototype.layoutOptions=function(){var t=this.adapter.getMenuItemValues(),n=t.indexOf(this.getValue());this.setSelectedIndex(n,!1,!0)},e.prototype.handleMenuOpened=function(){if(this.adapter.getMenuItemValues().length!==0){var t=this.getSelectedIndex(),n=t>=0?t:0;this.adapter.focusMenuItemAtIndex(n)}},e.prototype.handleMenuClosing=function(){this.adapter.setSelectAnchorAttr("aria-expanded","false")},e.prototype.handleMenuClosed=function(){this.adapter.removeClass(L.ACTIVATED),this.isMenuOpen=!1,this.adapter.isSelectAnchorFocused()||this.blur()},e.prototype.handleChange=function(){this.layout(),this.adapter.notifyChange(this.getValue());var t=this.adapter.hasClass(L.REQUIRED);t&&this.useDefaultValidation&&this.setValid(this.isValid())},e.prototype.handleMenuItemAction=function(t){this.setSelectedIndex(t,!0)},e.prototype.handleFocus=function(){this.adapter.addClass(L.FOCUSED),this.layout(),this.adapter.activateBottomLine()},e.prototype.handleBlur=function(){this.isMenuOpen||this.blur()},e.prototype.handleClick=function(t){if(!(this.disabled||this.recentlyClicked)){if(this.setClickDebounceTimeout(),this.isMenuOpen){this.adapter.closeMenu();return}this.adapter.setRippleCenter(t),this.openMenu()}},e.prototype.handleKeydown=function(t){if(!(this.isMenuOpen||!this.adapter.hasClass(L.FOCUSED))){var n=F(t)===I.ENTER,i=F(t)===I.SPACEBAR,r=F(t)===I.ARROW_UP,a=F(t)===I.ARROW_DOWN,s=t.ctrlKey||t.metaKey;if(!s&&(!i&&t.key&&t.key.length===1||i&&this.adapter.isTypeaheadInProgress())){var l=i?" ":t.key,u=this.adapter.typeaheadMatchItem(l,this.getSelectedIndex());u>=0&&this.setSelectedIndex(u),t.preventDefault();return}!n&&!i&&!r&&!a||(r&&this.getSelectedIndex()>0?this.setSelectedIndex(this.getSelectedIndex()-1):a&&this.getSelectedIndex()<this.adapter.getMenuItemCount()-1&&this.setSelectedIndex(this.getSelectedIndex()+1),this.openMenu(),t.preventDefault())}},e.prototype.notchOutline=function(t){if(this.adapter.hasOutline()){var n=this.adapter.hasClass(L.FOCUSED);if(t){var i=pt.LABEL_SCALE,r=this.adapter.getLabelWidth()*i;this.adapter.notchOutline(r)}else n||this.adapter.closeOutline()}},e.prototype.setLeadingIconAriaLabel=function(t){this.leadingIcon&&this.leadingIcon.setAriaLabel(t)},e.prototype.setLeadingIconContent=function(t){this.leadingIcon&&this.leadingIcon.setContent(t)},e.prototype.getUseDefaultValidation=function(){return this.useDefaultValidation},e.prototype.setUseDefaultValidation=function(t){this.useDefaultValidation=t},e.prototype.setValid=function(t){this.useDefaultValidation||(this.customValidity=t),this.adapter.setSelectAnchorAttr("aria-invalid",(!t).toString()),t?(this.adapter.removeClass(L.INVALID),this.adapter.removeMenuClass(L.MENU_INVALID)):(this.adapter.addClass(L.INVALID),this.adapter.addMenuClass(L.MENU_INVALID)),this.syncHelperTextValidity(t)},e.prototype.isValid=function(){return this.useDefaultValidation&&this.adapter.hasClass(L.REQUIRED)&&!this.adapter.hasClass(L.DISABLED)?this.getSelectedIndex()!==pt.UNSET_INDEX&&(this.getSelectedIndex()!==0||Boolean(this.getValue())):this.customValidity},e.prototype.setRequired=function(t){t?this.adapter.addClass(L.REQUIRED):this.adapter.removeClass(L.REQUIRED),this.adapter.setSelectAnchorAttr("aria-required",t.toString()),this.adapter.setLabelRequired(t)},e.prototype.getRequired=function(){return this.adapter.getSelectAnchorAttr("aria-required")==="true"},e.prototype.init=function(){var t=this.adapter.getAnchorElement();t&&(this.adapter.setMenuAnchorElement(t),this.adapter.setMenuAnchorCorner(St.BOTTOM_START)),this.adapter.setMenuWrapFocus(!1),this.setDisabled(this.adapter.hasClass(L.DISABLED)),this.syncHelperTextValidity(!this.adapter.hasClass(L.INVALID)),this.layout(),this.layoutOptions()},e.prototype.blur=function(){this.adapter.removeClass(L.FOCUSED),this.layout(),this.adapter.deactivateBottomLine();var t=this.adapter.hasClass(L.REQUIRED);t&&this.useDefaultValidation&&this.setValid(this.isValid())},e.prototype.syncHelperTextValidity=function(t){if(this.helperText){this.helperText.setValidity(t);var n=this.helperText.isVisible(),i=this.helperText.getId();n&&i?this.adapter.setSelectAnchorAttr(B.ARIA_DESCRIBEDBY,i):this.adapter.removeSelectAnchorAttr(B.ARIA_DESCRIBEDBY)}},e.prototype.setClickDebounceTimeout=function(){var t=this;clearTimeout(this.clickDebounceTimeout),this.clickDebounceTimeout=setTimeout(function(){t.recentlyClicked=!1},pt.CLICK_DEBOUNCE_TIMEOUT_MS),this.recentlyClicked=!0},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Et={ARIA_HIDDEN:"aria-hidden",ROLE:"role"},mt={HELPER_TEXT_VALIDATION_MSG:"mdc-select-helper-text--validation-msg",HELPER_TEXT_VALIDATION_MSG_PERSISTENT:"mdc-select-helper-text--validation-msg-persistent"};/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ei=function(o){v(e,o);function e(t){return o.call(this,f(f({},e.defaultAdapter),t))||this}return Object.defineProperty(e,"cssClasses",{get:function(){return mt},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return Et},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},hasClass:function(){return!1},setAttr:function(){},getAttr:function(){return null},removeAttr:function(){},setContent:function(){}}},enumerable:!1,configurable:!0}),e.prototype.getId=function(){return this.adapter.getAttr("id")},e.prototype.isVisible=function(){return this.adapter.getAttr(Et.ARIA_HIDDEN)!=="true"},e.prototype.setContent=function(t){this.adapter.setContent(t)},e.prototype.setValidation=function(t){t?this.adapter.addClass(mt.HELPER_TEXT_VALIDATION_MSG):this.adapter.removeClass(mt.HELPER_TEXT_VALIDATION_MSG)},e.prototype.setValidationMsgPersistent=function(t){t?this.adapter.addClass(mt.HELPER_TEXT_VALIDATION_MSG_PERSISTENT):this.adapter.removeClass(mt.HELPER_TEXT_VALIDATION_MSG_PERSISTENT)},e.prototype.setValidity=function(t){var n=this.adapter.hasClass(mt.HELPER_TEXT_VALIDATION_MSG);if(n){var i=this.adapter.hasClass(mt.HELPER_TEXT_VALIDATION_MSG_PERSISTENT),r=!t||i;if(r){this.showToScreenReader(),t?this.adapter.removeAttr(Et.ROLE):this.adapter.setAttr(Et.ROLE,"alert");return}this.adapter.removeAttr(Et.ROLE),this.hide()}},e.prototype.showToScreenReader=function(){this.adapter.removeAttr(Et.ARIA_HIDDEN)},e.prototype.hide=function(){this.adapter.setAttr(Et.ARIA_HIDDEN,"true")},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var mi=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},Object.defineProperty(e.prototype,"foundationForSelect",{get:function(){return this.foundation},enumerable:!1,configurable:!0}),e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},removeClass:function(i){return t.root.classList.remove(i)},hasClass:function(i){return t.root.classList.contains(i)},getAttr:function(i){return t.root.getAttribute(i)},setAttr:function(i,r){return t.root.setAttribute(i,r)},removeAttr:function(i){return t.root.removeAttribute(i)},setContent:function(i){t.root.textContent=i}};return new Ei(n)},e}(x);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Me={ICON_EVENT:"MDCSelect:icon",ICON_ROLE:"button"};/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var He=["click","keydown"],Fe=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.savedTabIndex=null,n.interactionHandler=function(i){n.handleInteraction(i)},n}return Object.defineProperty(e,"strings",{get:function(){return Me},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{getAttr:function(){return null},setAttr:function(){},removeAttr:function(){},setContent:function(){},registerInteractionHandler:function(){},deregisterInteractionHandler:function(){},notifyIconAction:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){var t,n;this.savedTabIndex=this.adapter.getAttr("tabindex");try{for(var i=O(He),r=i.next();!r.done;r=i.next()){var a=r.value;this.adapter.registerInteractionHandler(a,this.interactionHandler)}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}},e.prototype.destroy=function(){var t,n;try{for(var i=O(He),r=i.next();!r.done;r=i.next()){var a=r.value;this.adapter.deregisterInteractionHandler(a,this.interactionHandler)}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}},e.prototype.setDisabled=function(t){this.savedTabIndex&&(t?(this.adapter.setAttr("tabindex","-1"),this.adapter.removeAttr("role")):(this.adapter.setAttr("tabindex",this.savedTabIndex),this.adapter.setAttr("role",Me.ICON_ROLE)))},e.prototype.setAriaLabel=function(t){this.adapter.setAttr("aria-label",t)},e.prototype.setContent=function(t){this.adapter.setContent(t)},e.prototype.handleInteraction=function(t){var n=t.key==="Enter"||t.keyCode===13;(t.type==="click"||n)&&this.adapter.notifyIconAction()},e}(D);/**
 * @license
 * Copyright 2018 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ai=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},Object.defineProperty(e.prototype,"foundationForSelect",{get:function(){return this.foundation},enumerable:!1,configurable:!0}),e.prototype.getDefaultFoundation=function(){var t=this,n={getAttr:function(i){return t.root.getAttribute(i)},setAttr:function(i,r){return t.root.setAttribute(i,r)},removeAttr:function(i){return t.root.removeAttribute(i)},setContent:function(i){t.root.textContent=i},registerInteractionHandler:function(i,r){return t.listen(i,r)},deregisterInteractionHandler:function(i,r){return t.unlisten(i,r)},notifyIconAction:function(){return t.emit(Fe.strings.ICON_EVENT,{},!0)}};return new Fe(n)},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var un=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.initialize=function(t,n,i,r,a,s){if(t===void 0&&(t=function(c){return new Ke(c)}),n===void 0&&(n=function(c){return new qe(c)}),i===void 0&&(i=function(c){return new Xe(c)}),r===void 0&&(r=function(c){return new ce(c)}),a===void 0&&(a=function(c){return new Ai(c)}),s===void 0&&(s=function(c){return new mi(c)}),this.selectAnchor=this.root.querySelector(B.SELECT_ANCHOR_SELECTOR),this.selectedText=this.root.querySelector(B.SELECTED_TEXT_SELECTOR),this.hiddenInput=this.root.querySelector(B.HIDDEN_INPUT_SELECTOR),!this.selectedText)throw new Error("MDCSelect: Missing required element: The following selector must be present: "+("'"+B.SELECTED_TEXT_SELECTOR+"'"));if(this.selectAnchor.hasAttribute(B.ARIA_CONTROLS)){var l=document.getElementById(this.selectAnchor.getAttribute(B.ARIA_CONTROLS));l&&(this.helperText=s(l))}this.menuSetup(r);var u=this.root.querySelector(B.LABEL_SELECTOR);this.label=u?t(u):null;var d=this.root.querySelector(B.LINE_RIPPLE_SELECTOR);this.lineRipple=d?n(d):null;var h=this.root.querySelector(B.OUTLINE_SELECTOR);this.outline=h?i(h):null;var p=this.root.querySelector(B.LEADING_ICON_SELECTOR);p&&(this.leadingIcon=a(p)),this.root.classList.contains(L.OUTLINED)||(this.ripple=this.createRipple())},e.prototype.initialSyncWithDOM=function(){var t=this;if(this.handleFocus=function(){t.foundation.handleFocus()},this.handleBlur=function(){t.foundation.handleBlur()},this.handleClick=function(n){t.selectAnchor.focus(),t.foundation.handleClick(t.getNormalizedXCoordinate(n))},this.handleKeydown=function(n){t.foundation.handleKeydown(n)},this.handleMenuItemAction=function(n){t.foundation.handleMenuItemAction(n.detail.index)},this.handleMenuOpened=function(){t.foundation.handleMenuOpened()},this.handleMenuClosed=function(){t.foundation.handleMenuClosed()},this.handleMenuClosing=function(){t.foundation.handleMenuClosing()},this.selectAnchor.addEventListener("focus",this.handleFocus),this.selectAnchor.addEventListener("blur",this.handleBlur),this.selectAnchor.addEventListener("click",this.handleClick),this.selectAnchor.addEventListener("keydown",this.handleKeydown),this.menu.listen(ot.CLOSED_EVENT,this.handleMenuClosed),this.menu.listen(ot.CLOSING_EVENT,this.handleMenuClosing),this.menu.listen(ot.OPENED_EVENT,this.handleMenuOpened),this.menu.listen(et.SELECTED_EVENT,this.handleMenuItemAction),this.hiddenInput){if(this.hiddenInput.value){this.foundation.setValue(this.hiddenInput.value,!0),this.foundation.layout();return}this.hiddenInput.value=this.value}},e.prototype.destroy=function(){this.selectAnchor.removeEventListener("focus",this.handleFocus),this.selectAnchor.removeEventListener("blur",this.handleBlur),this.selectAnchor.removeEventListener("keydown",this.handleKeydown),this.selectAnchor.removeEventListener("click",this.handleClick),this.menu.unlisten(ot.CLOSED_EVENT,this.handleMenuClosed),this.menu.unlisten(ot.OPENED_EVENT,this.handleMenuOpened),this.menu.unlisten(et.SELECTED_EVENT,this.handleMenuItemAction),this.menu.destroy(),this.ripple&&this.ripple.destroy(),this.outline&&this.outline.destroy(),this.leadingIcon&&this.leadingIcon.destroy(),this.helperText&&this.helperText.destroy(),o.prototype.destroy.call(this)},Object.defineProperty(e.prototype,"value",{get:function(){return this.foundation.getValue()},set:function(t){this.foundation.setValue(t)},enumerable:!1,configurable:!0}),e.prototype.setValue=function(t,n){n===void 0&&(n=!1),this.foundation.setValue(t,n)},Object.defineProperty(e.prototype,"selectedIndex",{get:function(){return this.foundation.getSelectedIndex()},set:function(t){this.foundation.setSelectedIndex(t,!0)},enumerable:!1,configurable:!0}),e.prototype.setSelectedIndex=function(t,n){n===void 0&&(n=!1),this.foundation.setSelectedIndex(t,!0,n)},Object.defineProperty(e.prototype,"disabled",{get:function(){return this.foundation.getDisabled()},set:function(t){this.foundation.setDisabled(t),this.hiddenInput&&(this.hiddenInput.disabled=t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"leadingIconAriaLabel",{set:function(t){this.foundation.setLeadingIconAriaLabel(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"leadingIconContent",{set:function(t){this.foundation.setLeadingIconContent(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"helperTextContent",{set:function(t){this.foundation.setHelperTextContent(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"useDefaultValidation",{set:function(t){this.foundation.setUseDefaultValidation(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"valid",{get:function(){return this.foundation.isValid()},set:function(t){this.foundation.setValid(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"required",{get:function(){return this.foundation.getRequired()},set:function(t){this.foundation.setRequired(t)},enumerable:!1,configurable:!0}),e.prototype.layout=function(){this.foundation.layout()},e.prototype.layoutOptions=function(){this.foundation.layoutOptions(),this.menu.layout(),this.menuItemValues=this.menu.items.map(function(t){return t.getAttribute(B.VALUE_ATTR)||""}),this.hiddenInput&&(this.hiddenInput.value=this.value)},e.prototype.getDefaultFoundation=function(){var t=f(f(f(f({},this.getSelectAdapterMethods()),this.getCommonAdapterMethods()),this.getOutlineAdapterMethods()),this.getLabelAdapterMethods());return new pi(t,this.getFoundationMap())},e.prototype.menuSetup=function(t){this.menuElement=this.root.querySelector(B.MENU_SELECTOR),this.menu=t(this.menuElement),this.menu.hasTypeahead=!0,this.menu.singleSelection=!0,this.menuItemValues=this.menu.items.map(function(n){return n.getAttribute(B.VALUE_ATTR)||""})},e.prototype.createRipple=function(){var t=this,n=f(f({},U.createAdapter({root:this.selectAnchor})),{registerInteractionHandler:function(i,r){t.selectAnchor.addEventListener(i,r)},deregisterInteractionHandler:function(i,r){t.selectAnchor.removeEventListener(i,r)}});return new U(this.selectAnchor,new bt(n))},e.prototype.getSelectAdapterMethods=function(){var t=this;return{getMenuItemAttr:function(n,i){return n.getAttribute(i)},setSelectedText:function(n){t.selectedText.textContent=n},isSelectAnchorFocused:function(){return document.activeElement===t.selectAnchor},getSelectAnchorAttr:function(n){return t.selectAnchor.getAttribute(n)},setSelectAnchorAttr:function(n,i){t.selectAnchor.setAttribute(n,i)},removeSelectAnchorAttr:function(n){t.selectAnchor.removeAttribute(n)},addMenuClass:function(n){t.menuElement.classList.add(n)},removeMenuClass:function(n){t.menuElement.classList.remove(n)},openMenu:function(){t.menu.open=!0},closeMenu:function(){t.menu.open=!1},getAnchorElement:function(){return t.root.querySelector(B.SELECT_ANCHOR_SELECTOR)},setMenuAnchorElement:function(n){t.menu.setAnchorElement(n)},setMenuAnchorCorner:function(n){t.menu.setAnchorCorner(n)},setMenuWrapFocus:function(n){t.menu.wrapFocus=n},getSelectedIndex:function(){var n=t.menu.selectedIndex;return n instanceof Array?n[0]:n},setSelectedIndex:function(n){t.menu.selectedIndex=n},focusMenuItemAtIndex:function(n){t.menu.items[n].focus()},getMenuItemCount:function(){return t.menu.items.length},getMenuItemValues:function(){return t.menuItemValues},getMenuItemTextAtIndex:function(n){return t.menu.getPrimaryTextAtIndex(n)},isTypeaheadInProgress:function(){return t.menu.typeaheadInProgress},typeaheadMatchItem:function(n,i){return t.menu.typeaheadMatchItem(n,i)}}},e.prototype.getCommonAdapterMethods=function(){var t=this;return{addClass:function(n){t.root.classList.add(n)},removeClass:function(n){t.root.classList.remove(n)},hasClass:function(n){return t.root.classList.contains(n)},setRippleCenter:function(n){t.lineRipple&&t.lineRipple.setRippleCenter(n)},activateBottomLine:function(){t.lineRipple&&t.lineRipple.activate()},deactivateBottomLine:function(){t.lineRipple&&t.lineRipple.deactivate()},notifyChange:function(n){t.hiddenInput&&(t.hiddenInput.value=n);var i=t.selectedIndex;t.emit(B.CHANGE_EVENT,{value:n,index:i},!0)}}},e.prototype.getOutlineAdapterMethods=function(){var t=this;return{hasOutline:function(){return Boolean(t.outline)},notchOutline:function(n){t.outline&&t.outline.notch(n)},closeOutline:function(){t.outline&&t.outline.closeNotch()}}},e.prototype.getLabelAdapterMethods=function(){var t=this;return{hasLabel:function(){return!!t.label},floatLabel:function(n){t.label&&t.label.float(n)},getLabelWidth:function(){return t.label?t.label.getWidth():0},setLabelRequired:function(n){t.label&&t.label.setRequired(n)}}},e.prototype.getNormalizedXCoordinate=function(t){var n=t.target.getBoundingClientRect(),i=this.isTouchEvent(t)?t.touches[0].clientX:t.clientX;return i-n.left},e.prototype.isTouchEvent=function(t){return Boolean(t.touches)},e.prototype.getFoundationMap=function(){return{helperText:this.helperText?this.helperText.foundationForSelect:void 0,leadingIcon:this.leadingIcon?this.leadingIcon.foundationForSelect:void 0}},e}(x);/**
 * @license
 * Copyright 2020 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var q;(function(o){o.RICH="mdc-tooltip--rich",o.SHOWN="mdc-tooltip--shown",o.SHOWING="mdc-tooltip--showing",o.SHOWING_TRANSITION="mdc-tooltip--showing-transition",o.HIDE="mdc-tooltip--hide",o.HIDE_TRANSITION="mdc-tooltip--hide-transition",o.MULTILINE_TOOLTIP="mdc-tooltip--multiline",o.SURFACE="mdc-tooltip__surface",o.SURFACE_ANIMATION="mdc-tooltip__surface-animation",o.TOOLTIP_CARET_TOP="mdc-tooltip__caret-surface-top",o.TOOLTIP_CARET_BOTTOM="mdc-tooltip__caret-surface-bottom"})(q||(q={}));var W={BOUNDED_ANCHOR_GAP:4,UNBOUNDED_ANCHOR_GAP:8,MIN_VIEWPORT_TOOLTIP_THRESHOLD:8,HIDE_DELAY_MS:600,SHOW_DELAY_MS:500,MIN_HEIGHT:24,MAX_WIDTH:200,CARET_INDENTATION:24,ANIMATION_SCALE:.8},Kt={ARIA_EXPANDED:"aria-expanded",ARIA_HASPOPUP:"aria-haspopup",PERSISTENT:"data-mdc-tooltip-persistent",SCROLLABLE_ANCESTOR:"tooltip-scrollable-ancestor",HAS_CARET:"data-mdc-tooltip-has-caret"},Ci={HIDDEN:"MDCTooltip:hidden"},yt;(function(o){o[o.DETECTED=0]="DETECTED",o[o.START=1]="START",o[o.CENTER=2]="CENTER",o[o.END=3]="END"})(yt||(yt={}));var Bt;(function(o){o[o.DETECTED=0]="DETECTED",o[o.ABOVE=1]="ABOVE",o[o.BELOW=2]="BELOW"})(Bt||(Bt={}));var le;(function(o){o[o.BOUNDED=0]="BOUNDED",o[o.UNBOUNDED=1]="UNBOUNDED"})(le||(le={}));var C={LEFT:"left",RIGHT:"right",CENTER:"center",TOP:"top",BOTTOM:"bottom"},y;(function(o){o[o.DETECTED=0]="DETECTED",o[o.ABOVE_START=1]="ABOVE_START",o[o.ABOVE_CENTER=2]="ABOVE_CENTER",o[o.ABOVE_END=3]="ABOVE_END",o[o.TOP_SIDE_START=4]="TOP_SIDE_START",o[o.CENTER_SIDE_START=5]="CENTER_SIDE_START",o[o.BOTTOM_SIDE_START=6]="BOTTOM_SIDE_START",o[o.TOP_SIDE_END=7]="TOP_SIDE_END",o[o.CENTER_SIDE_END=8]="CENTER_SIDE_END",o[o.BOTTOM_SIDE_END=9]="BOTTOM_SIDE_END",o[o.BELOW_START=10]="BELOW_START",o[o.BELOW_CENTER=11]="BELOW_CENTER",o[o.BELOW_END=12]="BELOW_END"})(y||(y={}));var P;(function(o){o[o.ABOVE=1]="ABOVE",o[o.BELOW=2]="BELOW",o[o.SIDE_TOP=3]="SIDE_TOP",o[o.SIDE_CENTER=4]="SIDE_CENTER",o[o.SIDE_BOTTOM=5]="SIDE_BOTTOM"})(P||(P={}));var S;(function(o){o[o.START=1]="START",o[o.CENTER=2]="CENTER",o[o.END=3]="END",o[o.SIDE_START=4]="SIDE_START",o[o.SIDE_END=5]="SIDE_END"})(S||(S={}));/**
 * @license
 * Copyright 2020 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var gi=q.RICH,ne=q.SHOWN,ie=q.SHOWING,qt=q.SHOWING_TRANSITION,wt=q.HIDE,jt=q.HIDE_TRANSITION,Ti=q.MULTILINE_TOOLTIP,de;(function(o){o.POLL_ANCHOR="poll_anchor"})(de||(de={}));var Pe=typeof window<"u",vi=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.tooltipShown=!1,n.anchorGap=W.BOUNDED_ANCHOR_GAP,n.xTooltipPos=yt.DETECTED,n.yTooltipPos=Bt.DETECTED,n.tooltipPositionWithCaret=y.DETECTED,n.minViewportTooltipThreshold=W.MIN_VIEWPORT_TOOLTIP_THRESHOLD,n.hideDelayMs=W.HIDE_DELAY_MS,n.showDelayMs=W.SHOW_DELAY_MS,n.anchorRect=null,n.parentRect=null,n.frameId=null,n.hideTimeout=null,n.showTimeout=null,n.addAncestorScrollEventListeners=new Array,n.removeAncestorScrollEventListeners=new Array,n.animFrame=new an,n.anchorBlurHandler=function(i){n.handleAnchorBlur(i)},n.documentClickHandler=function(i){n.handleDocumentClick(i)},n.documentKeydownHandler=function(i){n.handleKeydown(i)},n.tooltipMouseEnterHandler=function(){n.handleTooltipMouseEnter()},n.tooltipMouseLeaveHandler=function(){n.handleTooltipMouseLeave()},n.richTooltipFocusOutHandler=function(i){n.handleRichTooltipFocusOut(i)},n.windowScrollHandler=function(){n.handleWindowScrollEvent()},n.windowResizeHandler=function(){n.handleWindowChangeEvent()},n}return Object.defineProperty(e,"defaultAdapter",{get:function(){return{getAttribute:function(){return null},setAttribute:function(){},removeAttribute:function(){},addClass:function(){},hasClass:function(){return!1},removeClass:function(){},getComputedStyleProperty:function(){return""},setStyleProperty:function(){},setSurfaceAnimationStyleProperty:function(){},getViewportWidth:function(){return 0},getViewportHeight:function(){return 0},getTooltipSize:function(){return{width:0,height:0}},getAnchorBoundingRect:function(){return{top:0,right:0,bottom:0,left:0,width:0,height:0}},getParentBoundingRect:function(){return{top:0,right:0,bottom:0,left:0,width:0,height:0}},getAnchorAttribute:function(){return null},setAnchorAttribute:function(){return null},isRTL:function(){return!1},anchorContainsElement:function(){return!1},tooltipContainsElement:function(){return!1},focusAnchorElement:function(){},registerEventHandler:function(){},deregisterEventHandler:function(){},registerAnchorEventHandler:function(){},deregisterAnchorEventHandler:function(){},registerDocumentEventHandler:function(){},deregisterDocumentEventHandler:function(){},registerWindowEventHandler:function(){},deregisterWindowEventHandler:function(){},notifyHidden:function(){},getTooltipCaretBoundingRect:function(){return{top:0,right:0,bottom:0,left:0,width:0,height:0}},setTooltipCaretStyle:function(){},clearTooltipCaretStyles:function(){},getActiveElement:function(){return null}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){this.richTooltip=this.adapter.hasClass(gi),this.persistentTooltip=this.adapter.getAttribute(Kt.PERSISTENT)==="true",this.interactiveTooltip=!!this.adapter.getAnchorAttribute(Kt.ARIA_EXPANDED)&&this.adapter.getAnchorAttribute(Kt.ARIA_HASPOPUP)==="dialog",this.hasCaret=this.richTooltip&&this.adapter.getAttribute(Kt.HAS_CARET)==="true"},e.prototype.isShown=function(){return this.tooltipShown},e.prototype.isRich=function(){return this.richTooltip},e.prototype.isPersistent=function(){return this.persistentTooltip},e.prototype.handleAnchorMouseEnter=function(){var t=this;this.tooltipShown?this.show():(this.clearHideTimeout(),this.showTimeout=setTimeout(function(){t.show()},this.showDelayMs))},e.prototype.handleAnchorTouchstart=function(){var t=this;this.showTimeout=setTimeout(function(){t.show()},this.showDelayMs),this.adapter.registerWindowEventHandler("contextmenu",this.preventContextMenuOnLongTouch)},e.prototype.preventContextMenuOnLongTouch=function(t){t.preventDefault()},e.prototype.handleAnchorTouchend=function(){this.clearShowTimeout(),this.isShown()||this.adapter.deregisterWindowEventHandler("contextmenu",this.preventContextMenuOnLongTouch)},e.prototype.handleAnchorFocus=function(t){var n=this,i=t.relatedTarget,r=i instanceof HTMLElement&&this.adapter.tooltipContainsElement(i);r||(this.showTimeout=setTimeout(function(){n.show()},this.showDelayMs))},e.prototype.handleAnchorMouseLeave=function(){var t=this;this.clearShowTimeout(),this.hideTimeout=setTimeout(function(){t.hide()},this.hideDelayMs)},e.prototype.handleAnchorClick=function(){this.tooltipShown?this.hide():this.show()},e.prototype.handleDocumentClick=function(t){var n=t.target instanceof HTMLElement&&(this.adapter.anchorContainsElement(t.target)||this.adapter.tooltipContainsElement(t.target));this.richTooltip&&this.persistentTooltip&&n||this.hide()},e.prototype.handleKeydown=function(t){var n=F(t);if(n===I.ESCAPE){var i=this.adapter.getActiveElement(),r=i instanceof HTMLElement&&this.adapter.tooltipContainsElement(i);r&&this.adapter.focusAnchorElement(),this.hide()}},e.prototype.handleAnchorBlur=function(t){if(this.richTooltip){var n=t.relatedTarget instanceof HTMLElement&&this.adapter.tooltipContainsElement(t.relatedTarget);if(n||t.relatedTarget===null&&this.interactiveTooltip)return}this.hide()},e.prototype.handleTooltipMouseEnter=function(){this.show()},e.prototype.handleTooltipMouseLeave=function(){var t=this;this.clearShowTimeout(),this.hideTimeout=setTimeout(function(){t.hide()},this.hideDelayMs)},e.prototype.handleRichTooltipFocusOut=function(t){var n=t.relatedTarget instanceof HTMLElement&&(this.adapter.anchorContainsElement(t.relatedTarget)||this.adapter.tooltipContainsElement(t.relatedTarget));n||t.relatedTarget===null&&this.interactiveTooltip||this.hide()},e.prototype.handleWindowScrollEvent=function(){if(this.persistentTooltip){this.handleWindowChangeEvent();return}this.hide()},e.prototype.handleWindowChangeEvent=function(){var t=this;this.animFrame.request(de.POLL_ANCHOR,function(){t.repositionTooltipOnAnchorMove()})},e.prototype.show=function(){var t,n,i=this;if(this.clearHideTimeout(),this.clearShowTimeout(),!this.tooltipShown){this.tooltipShown=!0,this.adapter.removeAttribute("aria-hidden"),this.richTooltip&&(this.interactiveTooltip&&this.adapter.setAnchorAttribute("aria-expanded","true"),this.adapter.registerEventHandler("focusout",this.richTooltipFocusOutHandler)),this.persistentTooltip||(this.adapter.registerEventHandler("mouseenter",this.tooltipMouseEnterHandler),this.adapter.registerEventHandler("mouseleave",this.tooltipMouseLeaveHandler)),this.adapter.removeClass(wt),this.adapter.addClass(ie),this.isTooltipMultiline()&&!this.richTooltip&&this.adapter.addClass(Ti),this.anchorRect=this.adapter.getAnchorBoundingRect(),this.parentRect=this.adapter.getParentBoundingRect(),this.richTooltip?this.positionRichTooltip():this.positionPlainTooltip(),this.adapter.registerAnchorEventHandler("blur",this.anchorBlurHandler),this.adapter.registerDocumentEventHandler("click",this.documentClickHandler),this.adapter.registerDocumentEventHandler("keydown",this.documentKeydownHandler),this.adapter.registerWindowEventHandler("scroll",this.windowScrollHandler),this.adapter.registerWindowEventHandler("resize",this.windowResizeHandler);try{for(var r=O(this.addAncestorScrollEventListeners),a=r.next();!a.done;a=r.next()){var s=a.value;s()}}catch(l){t={error:l}}finally{try{a&&!a.done&&(n=r.return)&&n.call(r)}finally{if(t)throw t.error}}this.frameId=requestAnimationFrame(function(){i.clearAllAnimationClasses(),i.adapter.addClass(ne),i.adapter.addClass(qt)})}},e.prototype.hide=function(){var t,n;if(this.clearHideTimeout(),this.clearShowTimeout(),!!this.tooltipShown){this.frameId&&cancelAnimationFrame(this.frameId),this.tooltipShown=!1,this.adapter.setAttribute("aria-hidden","true"),this.adapter.deregisterEventHandler("focusout",this.richTooltipFocusOutHandler),this.richTooltip&&this.interactiveTooltip&&this.adapter.setAnchorAttribute("aria-expanded","false"),this.persistentTooltip||(this.adapter.deregisterEventHandler("mouseenter",this.tooltipMouseEnterHandler),this.adapter.deregisterEventHandler("mouseleave",this.tooltipMouseLeaveHandler)),this.clearAllAnimationClasses(),this.adapter.addClass(wt),this.adapter.addClass(jt),this.adapter.removeClass(ne),this.adapter.deregisterAnchorEventHandler("blur",this.anchorBlurHandler),this.adapter.deregisterDocumentEventHandler("click",this.documentClickHandler),this.adapter.deregisterDocumentEventHandler("keydown",this.documentKeydownHandler),this.adapter.deregisterWindowEventHandler("scroll",this.windowScrollHandler),this.adapter.deregisterWindowEventHandler("resize",this.windowResizeHandler),this.adapter.deregisterWindowEventHandler("contextmenu",this.preventContextMenuOnLongTouch);try{for(var i=O(this.removeAncestorScrollEventListeners),r=i.next();!r.done;r=i.next()){var a=r.value;a()}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}}},e.prototype.handleTransitionEnd=function(){var t=this.adapter.hasClass(wt);this.adapter.removeClass(ie),this.adapter.removeClass(qt),this.adapter.removeClass(wt),this.adapter.removeClass(jt),t&&this.adapter.notifyHidden()},e.prototype.clearAllAnimationClasses=function(){this.adapter.removeClass(qt),this.adapter.removeClass(jt)},e.prototype.setTooltipPosition=function(t){var n=t.xPos,i=t.yPos,r=t.withCaretPos;if(this.hasCaret&&r){this.tooltipPositionWithCaret=r;return}n&&(this.xTooltipPos=n),i&&(this.yTooltipPos=i)},e.prototype.setAnchorBoundaryType=function(t){t===le.UNBOUNDED?this.anchorGap=W.UNBOUNDED_ANCHOR_GAP:this.anchorGap=W.BOUNDED_ANCHOR_GAP},e.prototype.setShowDelay=function(t){this.showDelayMs=t},e.prototype.setHideDelay=function(t){this.hideDelayMs=t},e.prototype.isTooltipMultiline=function(){var t=this.adapter.getTooltipSize();return t.height>W.MIN_HEIGHT&&t.width>=W.MAX_WIDTH},e.prototype.positionPlainTooltip=function(){var t=this.calculateTooltipStyles(this.anchorRect),n=t.top,i=t.yTransformOrigin,r=t.left,a=t.xTransformOrigin,s=Pe?Yt(window,"transform"):"transform";this.adapter.setSurfaceAnimationStyleProperty(s+"-origin",a+" "+i),this.adapter.setStyleProperty("top",n+"px"),this.adapter.setStyleProperty("left",r+"px")},e.prototype.positionRichTooltip=function(){var t,n,i,r,a=this.adapter.getComputedStyleProperty("width");this.adapter.setStyleProperty("width",a);var s=this.hasCaret?this.calculateTooltipWithCaretStyles(this.anchorRect):this.calculateTooltipStyles(this.anchorRect),l=s.top,u=s.yTransformOrigin,d=s.left,h=s.xTransformOrigin,p=Pe?Yt(window,"transform"):"transform";this.adapter.setSurfaceAnimationStyleProperty(p+"-origin",h+" "+u);var c=d-((n=(t=this.parentRect)===null||t===void 0?void 0:t.left)!==null&&n!==void 0?n:0),E=l-((r=(i=this.parentRect)===null||i===void 0?void 0:i.top)!==null&&r!==void 0?r:0);this.adapter.setStyleProperty("top",E+"px"),this.adapter.setStyleProperty("left",c+"px")},e.prototype.calculateTooltipStyles=function(t){if(!t)return{top:0,left:0};var n=this.adapter.getTooltipSize(),i=this.calculateYTooltipDistance(t,n.height),r=this.calculateXTooltipDistance(t,n.width);return{top:i.distance,yTransformOrigin:i.yTransformOrigin,left:r.distance,xTransformOrigin:r.xTransformOrigin}},e.prototype.calculateXTooltipDistance=function(t,n){var i=!this.adapter.isRTL(),r,a,s,l,u;this.richTooltip?(r=i?t.left-n:t.right,a=i?t.right:t.left-n,l=i?C.RIGHT:C.LEFT,u=i?C.LEFT:C.RIGHT):(r=i?t.left:t.right-n,a=i?t.right-n:t.left,s=t.left+(t.width-n)/2,l=i?C.LEFT:C.RIGHT,u=i?C.RIGHT:C.LEFT);var d=this.richTooltip?this.determineValidPositionOptions(r,a):this.determineValidPositionOptions(s,r,a);if(this.xTooltipPos===yt.START&&d.has(r))return{distance:r,xTransformOrigin:l};if(this.xTooltipPos===yt.END&&d.has(a))return{distance:a,xTransformOrigin:u};if(this.xTooltipPos===yt.CENTER&&d.has(s))return{distance:s,xTransformOrigin:C.CENTER};var h=this.richTooltip?[{distance:a,xTransformOrigin:u},{distance:r,xTransformOrigin:l}]:[{distance:s,xTransformOrigin:C.CENTER},{distance:r,xTransformOrigin:l},{distance:a,xTransformOrigin:u}],p=h.find(function(g){var A=g.distance;return d.has(A)});if(p)return p;if(t.left<0)return{distance:this.minViewportTooltipThreshold,xTransformOrigin:C.LEFT};var c=this.adapter.getViewportWidth(),E=c-(n+this.minViewportTooltipThreshold);return{distance:E,xTransformOrigin:C.RIGHT}},e.prototype.determineValidPositionOptions=function(){for(var t,n,i=[],r=0;r<arguments.length;r++)i[r]=arguments[r];var a=new Set,s=new Set;try{for(var l=O(i),u=l.next();!u.done;u=l.next()){var d=u.value;this.positionHonorsViewportThreshold(d)?a.add(d):this.positionDoesntCollideWithViewport(d)&&s.add(d)}}catch(h){t={error:h}}finally{try{u&&!u.done&&(n=l.return)&&n.call(l)}finally{if(t)throw t.error}}return a.size?a:s},e.prototype.positionHonorsViewportThreshold=function(t){var n=this.adapter.getViewportWidth(),i=this.adapter.getTooltipSize().width;return t+i<=n-this.minViewportTooltipThreshold&&t>=this.minViewportTooltipThreshold},e.prototype.positionDoesntCollideWithViewport=function(t){var n=this.adapter.getViewportWidth(),i=this.adapter.getTooltipSize().width;return t+i<=n&&t>=0},e.prototype.calculateYTooltipDistance=function(t,n){var i=t.bottom+this.anchorGap,r=t.top-(this.anchorGap+n),a=this.determineValidYPositionOptions(r,i);return this.yTooltipPos===Bt.ABOVE&&a.has(r)?{distance:r,yTransformOrigin:C.BOTTOM}:this.yTooltipPos===Bt.BELOW&&a.has(i)?{distance:i,yTransformOrigin:C.TOP}:a.has(i)?{distance:i,yTransformOrigin:C.TOP}:a.has(r)?{distance:r,yTransformOrigin:C.BOTTOM}:{distance:i,yTransformOrigin:C.TOP}},e.prototype.determineValidYPositionOptions=function(t,n){var i=new Set,r=new Set;return this.yPositionHonorsViewportThreshold(t)?i.add(t):this.yPositionDoesntCollideWithViewport(t)&&r.add(t),this.yPositionHonorsViewportThreshold(n)?i.add(n):this.yPositionDoesntCollideWithViewport(n)&&r.add(n),i.size?i:r},e.prototype.yPositionHonorsViewportThreshold=function(t){var n=this.adapter.getViewportHeight(),i=this.adapter.getTooltipSize().height;return t+i+this.minViewportTooltipThreshold<=n&&t>=this.minViewportTooltipThreshold},e.prototype.yPositionDoesntCollideWithViewport=function(t){var n=this.adapter.getViewportHeight(),i=this.adapter.getTooltipSize().height;return t+i<=n&&t>=0},e.prototype.calculateTooltipWithCaretStyles=function(t){this.adapter.clearTooltipCaretStyles();var n=this.adapter.getTooltipCaretBoundingRect();if(!t||!n)return{position:y.DETECTED,top:0,left:0};var i=n.width/W.ANIMATION_SCALE,r=n.height/W.ANIMATION_SCALE/2,a=this.adapter.getTooltipSize(),s=this.calculateYWithCaretDistanceOptions(t,a.height,{caretWidth:i,caretHeight:r}),l=this.calculateXWithCaretDistanceOptions(t,a.width,{caretWidth:i,caretHeight:r}),u=this.validateTooltipWithCaretDistances(s,l);u.size<1&&(u=this.generateBackupPositionOption(t,a,{caretWidth:i,caretHeight:r}));var d=this.determineTooltipWithCaretDistance(u),h=d.position,p=d.xDistance,c=d.yDistance,E=this.setCaretPositionStyles(h,{caretWidth:i,caretHeight:r}),g=E.yTransformOrigin,A=E.xTransformOrigin;return{yTransformOrigin:g,xTransformOrigin:A,top:c,left:p}},e.prototype.calculateXWithCaretDistanceOptions=function(t,n,i){var r=i.caretWidth,a=i.caretHeight,s=!this.adapter.isRTL(),l=t.left+t.width/2,u=t.left-(n+this.anchorGap+a),d=t.right+this.anchorGap+a,h=s?u:d,p=s?d:u,c=l-(W.CARET_INDENTATION+r/2),E=l-(n-W.CARET_INDENTATION-r/2),g=s?c:E,A=s?E:c,T=l-n/2,N=new Map([[S.START,g],[S.CENTER,T],[S.END,A],[S.SIDE_END,p],[S.SIDE_START,h]]);return N},e.prototype.calculateYWithCaretDistanceOptions=function(t,n,i){var r=i.caretWidth,a=i.caretHeight,s=t.top+t.height/2,l=t.bottom+this.anchorGap+a,u=t.top-(this.anchorGap+n+a),d=s-(W.CARET_INDENTATION+r/2),h=s-n/2,p=s-(n-W.CARET_INDENTATION-r/2),c=new Map([[P.ABOVE,u],[P.BELOW,l],[P.SIDE_TOP,d],[P.SIDE_CENTER,h],[P.SIDE_BOTTOM,p]]);return c},e.prototype.repositionTooltipOnAnchorMove=function(){var t=this.adapter.getAnchorBoundingRect();!t||!this.anchorRect||(t.top!==this.anchorRect.top||t.left!==this.anchorRect.left||t.height!==this.anchorRect.height||t.width!==this.anchorRect.width)&&(this.anchorRect=t,this.parentRect=this.adapter.getParentBoundingRect(),this.richTooltip?this.positionRichTooltip():this.positionPlainTooltip())},e.prototype.validateTooltipWithCaretDistances=function(t,n){var i,r,a,s,l,u,d=new Map,h=new Map,p=new Map([[P.ABOVE,[S.START,S.CENTER,S.END]],[P.BELOW,[S.START,S.CENTER,S.END]],[P.SIDE_TOP,[S.SIDE_START,S.SIDE_END]],[P.SIDE_CENTER,[S.SIDE_START,S.SIDE_END]],[P.SIDE_BOTTOM,[S.SIDE_START,S.SIDE_END]]]);try{for(var c=O(p.keys()),E=c.next();!E.done;E=c.next()){var g=E.value,A=t.get(g);if(this.yPositionHonorsViewportThreshold(A))try{for(var T=(a=void 0,O(p.get(g))),N=T.next();!N.done;N=T.next()){var G=N.value,w=n.get(G);if(this.positionHonorsViewportThreshold(w)){var _t=this.caretPositionOptionsMapping(G,g);d.set(_t,{xDistance:w,yDistance:A})}}}catch(Rt){a={error:Rt}}finally{try{N&&!N.done&&(s=T.return)&&s.call(T)}finally{if(a)throw a.error}}else if(this.yPositionDoesntCollideWithViewport(A))try{for(var Ut=(l=void 0,O(p.get(g))),Lt=Ut.next();!Lt.done;Lt=Ut.next()){var G=Lt.value,w=n.get(G);if(this.positionDoesntCollideWithViewport(w)){var _t=this.caretPositionOptionsMapping(G,g);h.set(_t,{xDistance:w,yDistance:A})}}}catch(Rt){l={error:Rt}}finally{try{Lt&&!Lt.done&&(u=Ut.return)&&u.call(Ut)}finally{if(l)throw l.error}}}}catch(Rt){i={error:Rt}}finally{try{E&&!E.done&&(r=c.return)&&r.call(c)}finally{if(i)throw i.error}}return d.size?d:h},e.prototype.generateBackupPositionOption=function(t,n,i){var r=!this.adapter.isRTL(),a,s;if(t.left<0)a=this.minViewportTooltipThreshold+i.caretHeight,s=r?S.END:S.START;else{var l=this.adapter.getViewportWidth();a=l-(n.width+this.minViewportTooltipThreshold+i.caretHeight),s=r?S.START:S.END}var u,d;if(t.top<0)u=this.minViewportTooltipThreshold+i.caretHeight,d=P.BELOW;else{var h=this.adapter.getViewportHeight();u=h-(n.height+this.minViewportTooltipThreshold+i.caretHeight),d=P.ABOVE}var p=this.caretPositionOptionsMapping(s,d);return new Map([[p,{xDistance:a,yDistance:u}]])},e.prototype.determineTooltipWithCaretDistance=function(t){if(t.has(this.tooltipPositionWithCaret)){var n=t.get(this.tooltipPositionWithCaret);return{position:this.tooltipPositionWithCaret,xDistance:n.xDistance,yDistance:n.yDistance}}var i=[y.ABOVE_START,y.ABOVE_CENTER,y.ABOVE_END,y.TOP_SIDE_START,y.CENTER_SIDE_START,y.BOTTOM_SIDE_START,y.TOP_SIDE_END,y.CENTER_SIDE_END,y.BOTTOM_SIDE_END,y.BELOW_START,y.BELOW_CENTER,y.BELOW_END],r=i.find(function(s){return t.has(s)}),a=t.get(r);return{position:r,xDistance:a.xDistance,yDistance:a.yDistance}},e.prototype.caretPositionOptionsMapping=function(t,n){switch(n){case P.ABOVE:if(t===S.START)return y.ABOVE_START;if(t===S.CENTER)return y.ABOVE_CENTER;if(t===S.END)return y.ABOVE_END;break;case P.BELOW:if(t===S.START)return y.BELOW_START;if(t===S.CENTER)return y.BELOW_CENTER;if(t===S.END)return y.BELOW_END;break;case P.SIDE_TOP:if(t===S.SIDE_START)return y.TOP_SIDE_START;if(t===S.SIDE_END)return y.TOP_SIDE_END;break;case P.SIDE_CENTER:if(t===S.SIDE_START)return y.CENTER_SIDE_START;if(t===S.SIDE_END)return y.CENTER_SIDE_END;break;case P.SIDE_BOTTOM:if(t===S.SIDE_START)return y.BOTTOM_SIDE_START;if(t===S.SIDE_END)return y.BOTTOM_SIDE_END;break}throw new Error("MDCTooltipFoundation: Invalid caret position of "+t+", "+n)},e.prototype.setCaretPositionStyles=function(t,n){var i,r,a=this.calculateCaretPositionOnTooltip(t,n);if(!a)return{yTransformOrigin:0,xTransformOrigin:0};this.adapter.clearTooltipCaretStyles(),this.adapter.setTooltipCaretStyle(a.yAlignment,a.yAxisPx),this.adapter.setTooltipCaretStyle(a.xAlignment,a.xAxisPx);var s=a.skew*(Math.PI/180),l=Math.cos(s);this.adapter.setTooltipCaretStyle("transform","rotate("+a.rotation+"deg) skewY("+a.skew+"deg) scaleX("+l+")"),this.adapter.setTooltipCaretStyle("transform-origin",a.xAlignment+" "+a.yAlignment);try{for(var u=O(a.caretCorners),d=u.next();!d.done;d=u.next()){var h=d.value;this.adapter.setTooltipCaretStyle(h,"0")}}catch(p){i={error:p}}finally{try{d&&!d.done&&(r=u.return)&&r.call(u)}finally{if(i)throw i.error}}return{yTransformOrigin:a.yTransformOrigin,xTransformOrigin:a.xTransformOrigin}},e.prototype.calculateCaretPositionOnTooltip=function(t,n){var i=!this.adapter.isRTL(),r=this.adapter.getComputedStyleProperty("width"),a=this.adapter.getComputedStyleProperty("height");if(!(!r||!a||!n)){var s="calc(("+r+" - "+n.caretWidth+"px) / 2)",l="calc(("+a+" - "+n.caretWidth+"px) / 2)",u="0",d=W.CARET_INDENTATION+"px",h="calc("+r+" - "+d+")",p="calc("+a+" - "+d+")",c=35,E=Math.abs(90-c),g=["border-bottom-right-radius","border-top-left-radius"],A=["border-bottom-left-radius","border-top-right-radius"],T=20;switch(t){case y.BELOW_CENTER:return{yAlignment:C.TOP,xAlignment:C.LEFT,yAxisPx:u,xAxisPx:s,rotation:-1*c,skew:-1*T,xTransformOrigin:s,yTransformOrigin:u,caretCorners:g};case y.BELOW_END:return{yAlignment:C.TOP,xAlignment:i?C.RIGHT:C.LEFT,yAxisPx:u,xAxisPx:d,rotation:i?c:-1*c,skew:i?T:-1*T,xTransformOrigin:i?h:d,yTransformOrigin:u,caretCorners:i?A:g};case y.BELOW_START:return{yAlignment:C.TOP,xAlignment:i?C.LEFT:C.RIGHT,yAxisPx:u,xAxisPx:d,rotation:i?-1*c:c,skew:i?-1*T:T,xTransformOrigin:i?d:h,yTransformOrigin:u,caretCorners:i?g:A};case y.TOP_SIDE_END:return{yAlignment:C.TOP,xAlignment:i?C.LEFT:C.RIGHT,yAxisPx:d,xAxisPx:u,rotation:i?E:-1*E,skew:i?-1*T:T,xTransformOrigin:i?u:r,yTransformOrigin:d,caretCorners:i?g:A};case y.CENTER_SIDE_END:return{yAlignment:C.TOP,xAlignment:i?C.LEFT:C.RIGHT,yAxisPx:l,xAxisPx:u,rotation:i?E:-1*E,skew:i?-1*T:T,xTransformOrigin:i?u:r,yTransformOrigin:l,caretCorners:i?g:A};case y.BOTTOM_SIDE_END:return{yAlignment:C.BOTTOM,xAlignment:i?C.LEFT:C.RIGHT,yAxisPx:d,xAxisPx:u,rotation:i?-1*E:E,skew:i?T:-1*T,xTransformOrigin:i?u:r,yTransformOrigin:p,caretCorners:i?A:g};case y.TOP_SIDE_START:return{yAlignment:C.TOP,xAlignment:i?C.RIGHT:C.LEFT,yAxisPx:d,xAxisPx:u,rotation:i?-1*E:E,skew:i?T:-1*T,xTransformOrigin:i?r:u,yTransformOrigin:d,caretCorners:i?A:g};case y.CENTER_SIDE_START:return{yAlignment:C.TOP,xAlignment:i?C.RIGHT:C.LEFT,yAxisPx:l,xAxisPx:u,rotation:i?-1*E:E,skew:i?T:-1*T,xTransformOrigin:i?r:u,yTransformOrigin:l,caretCorners:i?A:g};case y.BOTTOM_SIDE_START:return{yAlignment:C.BOTTOM,xAlignment:i?C.RIGHT:C.LEFT,yAxisPx:d,xAxisPx:u,rotation:i?E:-1*E,skew:i?-1*T:T,xTransformOrigin:i?r:u,yTransformOrigin:p,caretCorners:i?g:A};case y.ABOVE_CENTER:return{yAlignment:C.BOTTOM,xAlignment:C.LEFT,yAxisPx:u,xAxisPx:s,rotation:c,skew:T,xTransformOrigin:s,yTransformOrigin:a,caretCorners:A};case y.ABOVE_END:return{yAlignment:C.BOTTOM,xAlignment:i?C.RIGHT:C.LEFT,yAxisPx:u,xAxisPx:d,rotation:i?-1*c:c,skew:i?-1*T:T,xTransformOrigin:i?h:d,yTransformOrigin:a,caretCorners:i?g:A};default:case y.ABOVE_START:return{yAlignment:C.BOTTOM,xAlignment:i?C.LEFT:C.RIGHT,yAxisPx:u,xAxisPx:d,rotation:i?c:-1*c,skew:i?T:-1*T,xTransformOrigin:i?d:h,yTransformOrigin:a,caretCorners:i?A:g}}}},e.prototype.clearShowTimeout=function(){this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=null)},e.prototype.clearHideTimeout=function(){this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=null)},e.prototype.attachScrollHandler=function(t){var n=this;this.addAncestorScrollEventListeners.push(function(){t("scroll",n.windowScrollHandler)})},e.prototype.removeScrollHandler=function(t){var n=this;this.removeAncestorScrollEventListeners.push(function(){t("scroll",n.windowScrollHandler)})},e.prototype.destroy=function(){var t,n;this.frameId&&(cancelAnimationFrame(this.frameId),this.frameId=null),this.clearHideTimeout(),this.clearShowTimeout(),this.adapter.removeClass(ne),this.adapter.removeClass(qt),this.adapter.removeClass(ie),this.adapter.removeClass(wt),this.adapter.removeClass(jt),this.richTooltip&&this.adapter.deregisterEventHandler("focusout",this.richTooltipFocusOutHandler),this.persistentTooltip||(this.adapter.deregisterEventHandler("mouseenter",this.tooltipMouseEnterHandler),this.adapter.deregisterEventHandler("mouseleave",this.tooltipMouseLeaveHandler)),this.adapter.deregisterAnchorEventHandler("blur",this.anchorBlurHandler),this.adapter.deregisterDocumentEventHandler("click",this.documentClickHandler),this.adapter.deregisterDocumentEventHandler("keydown",this.documentKeydownHandler),this.adapter.deregisterWindowEventHandler("scroll",this.windowScrollHandler),this.adapter.deregisterWindowEventHandler("resize",this.windowResizeHandler);try{for(var i=O(this.removeAncestorScrollEventListeners),r=i.next();!r.done;r=i.next()){var a=r.value;a()}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}this.animFrame.cancelAll()},e}(D);/**
 * @license
 * Copyright 2020 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var ln=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.initialize=function(){var t=this.root.getAttribute("id");if(!t)throw new Error("MDCTooltip: Tooltip component must have an id.");var n=document.querySelector('[data-tooltip-id="'+t+'"]')||document.querySelector('[aria-describedby="'+t+'"]');if(!n)throw new Error("MDCTooltip: Tooltip component requires an anchor element annotated with [aria-describedby] or [data-tooltip-id].");this.anchorElem=n},e.prototype.initialSyncWithDOM=function(){var t=this;this.isTooltipRich=this.foundation.isRich(),this.isTooltipPersistent=this.foundation.isPersistent(),this.handleMouseEnter=function(){t.foundation.handleAnchorMouseEnter()},this.handleFocus=function(n){t.foundation.handleAnchorFocus(n)},this.handleMouseLeave=function(){t.foundation.handleAnchorMouseLeave()},this.handleTransitionEnd=function(){t.foundation.handleTransitionEnd()},this.handleClick=function(){t.foundation.handleAnchorClick()},this.handleTouchstart=function(){t.foundation.handleAnchorTouchstart()},this.handleTouchend=function(){t.foundation.handleAnchorTouchend()},this.isTooltipRich&&this.isTooltipPersistent?this.anchorElem.addEventListener("click",this.handleClick):(this.anchorElem.addEventListener("mouseenter",this.handleMouseEnter),this.anchorElem.addEventListener("focus",this.handleFocus),this.anchorElem.addEventListener("mouseleave",this.handleMouseLeave),this.anchorElem.addEventListener("touchstart",this.handleTouchstart),this.anchorElem.addEventListener("touchend",this.handleTouchend)),this.listen("transitionend",this.handleTransitionEnd)},e.prototype.destroy=function(){this.anchorElem&&(this.isTooltipRich&&this.isTooltipPersistent?this.anchorElem.removeEventListener("click",this.handleClick):(this.anchorElem.removeEventListener("mouseenter",this.handleMouseEnter),this.anchorElem.removeEventListener("focus",this.handleFocus),this.anchorElem.removeEventListener("mouseleave",this.handleMouseLeave),this.anchorElem.removeEventListener("touchstart",this.handleTouchstart),this.anchorElem.removeEventListener("touchend",this.handleTouchend))),this.unlisten("transitionend",this.handleTransitionEnd),o.prototype.destroy.call(this)},e.prototype.setTooltipPosition=function(t){this.foundation.setTooltipPosition(t)},e.prototype.setAnchorBoundaryType=function(t){this.foundation.setAnchorBoundaryType(t)},e.prototype.setShowDelay=function(t){this.foundation.setShowDelay(t)},e.prototype.setHideDelay=function(t){this.foundation.setHideDelay(t)},e.prototype.hide=function(){this.foundation.hide()},e.prototype.isShown=function(){return this.foundation.isShown()},e.prototype.attachScrollHandler=function(t){this.foundation.attachScrollHandler(t)},e.prototype.removeScrollHandler=function(t){this.foundation.removeScrollHandler(t)},e.prototype.getDefaultFoundation=function(){var t=this,n={getAttribute:function(i){return t.root.getAttribute(i)},setAttribute:function(i,r){t.root.setAttribute(i,r)},removeAttribute:function(i){t.root.removeAttribute(i)},addClass:function(i){t.root.classList.add(i)},hasClass:function(i){return t.root.classList.contains(i)},removeClass:function(i){t.root.classList.remove(i)},getComputedStyleProperty:function(i){return window.getComputedStyle(t.root).getPropertyValue(i)},setStyleProperty:function(i,r){t.root.style.setProperty(i,r)},setSurfaceAnimationStyleProperty:function(i,r){var a=t.root.querySelector("."+q.SURFACE_ANIMATION);a==null||a.style.setProperty(i,r)},getViewportWidth:function(){return window.innerWidth},getViewportHeight:function(){return window.innerHeight},getTooltipSize:function(){return{width:t.root.offsetWidth,height:t.root.offsetHeight}},getAnchorBoundingRect:function(){return t.anchorElem?t.anchorElem.getBoundingClientRect():null},getParentBoundingRect:function(){var i,r;return(r=(i=t.root.parentElement)===null||i===void 0?void 0:i.getBoundingClientRect())!==null&&r!==void 0?r:null},getAnchorAttribute:function(i){return t.anchorElem?t.anchorElem.getAttribute(i):null},setAnchorAttribute:function(i,r){var a;(a=t.anchorElem)===null||a===void 0||a.setAttribute(i,r)},isRTL:function(){return getComputedStyle(t.root).direction==="rtl"},anchorContainsElement:function(i){var r;return!!(!((r=t.anchorElem)===null||r===void 0)&&r.contains(i))},tooltipContainsElement:function(i){return t.root.contains(i)},focusAnchorElement:function(){var i;(i=t.anchorElem)===null||i===void 0||i.focus()},registerEventHandler:function(i,r){t.root instanceof HTMLElement&&t.root.addEventListener(i,r)},deregisterEventHandler:function(i,r){t.root instanceof HTMLElement&&t.root.removeEventListener(i,r)},registerAnchorEventHandler:function(i,r){var a;(a=t.anchorElem)===null||a===void 0||a.addEventListener(i,r)},deregisterAnchorEventHandler:function(i,r){var a;(a=t.anchorElem)===null||a===void 0||a.removeEventListener(i,r)},registerDocumentEventHandler:function(i,r){document.body.addEventListener(i,r)},deregisterDocumentEventHandler:function(i,r){document.body.removeEventListener(i,r)},registerWindowEventHandler:function(i,r){window.addEventListener(i,r)},deregisterWindowEventHandler:function(i,r){window.removeEventListener(i,r)},notifyHidden:function(){t.emit(Ci.HIDDEN,{})},getTooltipCaretBoundingRect:function(){var i=t.root.querySelector("."+q.TOOLTIP_CARET_TOP);return i?i.getBoundingClientRect():null},setTooltipCaretStyle:function(i,r){var a=t.root.querySelector("."+q.TOOLTIP_CARET_TOP),s=t.root.querySelector("."+q.TOOLTIP_CARET_BOTTOM);!a||!s||(a.style.setProperty(i,r),s.style.setProperty(i,r))},clearTooltipCaretStyles:function(){var i=t.root.querySelector("."+q.TOOLTIP_CARET_TOP),r=t.root.querySelector("."+q.TOOLTIP_CARET_BOTTOM);!i||!r||(i.removeAttribute("style"),r.removeAttribute("style"))},getActiveElement:function(){return document.activeElement}};return new vi(n)},e}(x);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Ii={NATIVE_CONTROL_SELECTOR:".mdc-radio__native-control"},yi={DISABLED:"mdc-radio--disabled",ROOT:"mdc-radio"};/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Be=function(o){v(e,o);function e(t){return o.call(this,f(f({},e.defaultAdapter),t))||this}return Object.defineProperty(e,"cssClasses",{get:function(){return yi},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return Ii},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},removeClass:function(){},setNativeControlDisabled:function(){}}},enumerable:!1,configurable:!0}),e.prototype.setDisabled=function(t){var n=e.cssClasses.DISABLED;this.adapter.setNativeControlDisabled(t),t?this.adapter.addClass(n):this.adapter.removeClass(n)},e}(D);/**
 * @license
 * Copyright 2016 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Si=function(o){v(e,o);function e(){var t=o!==null&&o.apply(this,arguments)||this;return t.rippleSurface=t.createRipple(),t}return e.attachTo=function(t){return new e(t)},Object.defineProperty(e.prototype,"checked",{get:function(){return this.nativeControl.checked},set:function(t){this.nativeControl.checked=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"disabled",{get:function(){return this.nativeControl.disabled},set:function(t){this.foundation.setDisabled(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"value",{get:function(){return this.nativeControl.value},set:function(t){this.nativeControl.value=t},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"ripple",{get:function(){return this.rippleSurface},enumerable:!1,configurable:!0}),e.prototype.destroy=function(){this.rippleSurface.destroy(),o.prototype.destroy.call(this)},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){return t.root.classList.add(i)},removeClass:function(i){return t.root.classList.remove(i)},setNativeControlDisabled:function(i){return t.nativeControl.disabled=i}};return new Be(n)},e.prototype.createRipple=function(){var t=this,n=f(f({},U.createAdapter(this)),{registerInteractionHandler:function(i,r){t.nativeControl.addEventListener(i,r,Q())},deregisterInteractionHandler:function(i,r){t.nativeControl.removeEventListener(i,r,Q())},isSurfaceActive:function(){return!1},isUnbounded:function(){return!0}});return new U(this.root,new bt(n))},Object.defineProperty(e.prototype,"nativeControl",{get:function(){var t=Be.strings.NATIVE_CONTROL_SELECTOR,n=this.root.querySelector(t);if(!n)throw new Error("Radio component requires a "+t+" element");return n},enumerable:!1,configurable:!0}),e}(x);/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Y={CLOSED_CLASS:"mdc-linear-progress--closed",CLOSED_ANIMATION_OFF_CLASS:"mdc-linear-progress--closed-animation-off",INDETERMINATE_CLASS:"mdc-linear-progress--indeterminate",REVERSED_CLASS:"mdc-linear-progress--reversed",ANIMATION_READY_CLASS:"mdc-linear-progress--animation-ready"},J={ARIA_HIDDEN:"aria-hidden",ARIA_VALUEMAX:"aria-valuemax",ARIA_VALUEMIN:"aria-valuemin",ARIA_VALUENOW:"aria-valuenow",BUFFER_BAR_SELECTOR:".mdc-linear-progress__buffer-bar",FLEX_BASIS:"flex-basis",PRIMARY_BAR_SELECTOR:".mdc-linear-progress__primary-bar"},Mt={PRIMARY_HALF:.8367142,PRIMARY_FULL:2.00611057,SECONDARY_QUARTER:.37651913,SECONDARY_HALF:.84386165,SECONDARY_FULL:1.60277782};/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var re=function(o){v(e,o);function e(t){var n=o.call(this,f(f({},e.defaultAdapter),t))||this;return n.observer=null,n}return Object.defineProperty(e,"cssClasses",{get:function(){return Y},enumerable:!1,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return J},enumerable:!1,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},attachResizeObserver:function(){return null},forceLayout:function(){},getWidth:function(){return 0},hasClass:function(){return!1},setBufferBarStyle:function(){return null},setPrimaryBarStyle:function(){return null},setStyle:function(){},removeAttribute:function(){},removeClass:function(){},setAttribute:function(){}}},enumerable:!1,configurable:!0}),e.prototype.init=function(){var t=this;this.determinate=!this.adapter.hasClass(Y.INDETERMINATE_CLASS),this.adapter.addClass(Y.ANIMATION_READY_CLASS),this.progress=0,this.buffer=1,this.observer=this.adapter.attachResizeObserver(function(n){var i,r;if(!t.determinate)try{for(var a=O(n),s=a.next();!s.done;s=a.next()){var l=s.value;l.contentRect&&t.calculateAndSetDimensions(l.contentRect.width)}}catch(u){i={error:u}}finally{try{s&&!s.done&&(r=a.return)&&r.call(a)}finally{if(i)throw i.error}}}),!this.determinate&&this.observer&&this.calculateAndSetDimensions(this.adapter.getWidth())},e.prototype.setDeterminate=function(t){if(this.determinate=t,this.determinate){this.adapter.removeClass(Y.INDETERMINATE_CLASS),this.adapter.setAttribute(J.ARIA_VALUENOW,this.progress.toString()),this.adapter.setAttribute(J.ARIA_VALUEMAX,"1"),this.adapter.setAttribute(J.ARIA_VALUEMIN,"0"),this.setPrimaryBarProgress(this.progress),this.setBufferBarProgress(this.buffer);return}this.observer&&this.calculateAndSetDimensions(this.adapter.getWidth()),this.adapter.addClass(Y.INDETERMINATE_CLASS),this.adapter.removeAttribute(J.ARIA_VALUENOW),this.adapter.removeAttribute(J.ARIA_VALUEMAX),this.adapter.removeAttribute(J.ARIA_VALUEMIN),this.setPrimaryBarProgress(1),this.setBufferBarProgress(1)},e.prototype.isDeterminate=function(){return this.determinate},e.prototype.setProgress=function(t){this.progress=t,this.determinate&&(this.setPrimaryBarProgress(t),this.adapter.setAttribute(J.ARIA_VALUENOW,t.toString()))},e.prototype.getProgress=function(){return this.progress},e.prototype.setBuffer=function(t){this.buffer=t,this.determinate&&this.setBufferBarProgress(t)},e.prototype.getBuffer=function(){return this.buffer},e.prototype.open=function(){this.adapter.removeClass(Y.CLOSED_CLASS),this.adapter.removeClass(Y.CLOSED_ANIMATION_OFF_CLASS),this.adapter.removeAttribute(J.ARIA_HIDDEN)},e.prototype.close=function(){this.adapter.addClass(Y.CLOSED_CLASS),this.adapter.setAttribute(J.ARIA_HIDDEN,"true")},e.prototype.isClosed=function(){return this.adapter.hasClass(Y.CLOSED_CLASS)},e.prototype.handleTransitionEnd=function(){this.adapter.hasClass(Y.CLOSED_CLASS)&&this.adapter.addClass(Y.CLOSED_ANIMATION_OFF_CLASS)},e.prototype.destroy=function(){o.prototype.destroy.call(this),this.observer&&this.observer.disconnect()},e.prototype.restartAnimation=function(){this.adapter.removeClass(Y.ANIMATION_READY_CLASS),this.adapter.forceLayout(),this.adapter.addClass(Y.ANIMATION_READY_CLASS)},e.prototype.setPrimaryBarProgress=function(t){var n="scaleX("+t+")",i=typeof window<"u"?Yt(window,"transform"):"transform";this.adapter.setPrimaryBarStyle(i,n)},e.prototype.setBufferBarProgress=function(t){var n=t*100+"%";this.adapter.setBufferBarStyle(J.FLEX_BASIS,n)},e.prototype.calculateAndSetDimensions=function(t){var n=t*Mt.PRIMARY_HALF,i=t*Mt.PRIMARY_FULL,r=t*Mt.SECONDARY_QUARTER,a=t*Mt.SECONDARY_HALF,s=t*Mt.SECONDARY_FULL;this.adapter.setStyle("--mdc-linear-progress-primary-half",n+"px"),this.adapter.setStyle("--mdc-linear-progress-primary-half-neg",-n+"px"),this.adapter.setStyle("--mdc-linear-progress-primary-full",i+"px"),this.adapter.setStyle("--mdc-linear-progress-primary-full-neg",-i+"px"),this.adapter.setStyle("--mdc-linear-progress-secondary-quarter",r+"px"),this.adapter.setStyle("--mdc-linear-progress-secondary-quarter-neg",-r+"px"),this.adapter.setStyle("--mdc-linear-progress-secondary-half",a+"px"),this.adapter.setStyle("--mdc-linear-progress-secondary-half-neg",-a+"px"),this.adapter.setStyle("--mdc-linear-progress-secondary-full",s+"px"),this.adapter.setStyle("--mdc-linear-progress-secondary-full-neg",-s+"px"),this.restartAnimation()},e}(D);/**
 * @license
 * Copyright 2017 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var Oi=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},Object.defineProperty(e.prototype,"determinate",{set:function(t){this.foundation.setDeterminate(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"progress",{set:function(t){this.foundation.setProgress(t)},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"buffer",{set:function(t){this.foundation.setBuffer(t)},enumerable:!1,configurable:!0}),e.prototype.open=function(){this.foundation.open()},e.prototype.close=function(){this.foundation.close()},e.prototype.initialSyncWithDOM=function(){var t=this;this.root.addEventListener("transitionend",function(){t.foundation.handleTransitionEnd()})},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){t.root.classList.add(i)},forceLayout:function(){t.root.getBoundingClientRect()},setBufferBarStyle:function(i,r){var a=t.root.querySelector(re.strings.BUFFER_BAR_SELECTOR);a&&a.style.setProperty(i,r)},setPrimaryBarStyle:function(i,r){var a=t.root.querySelector(re.strings.PRIMARY_BAR_SELECTOR);a&&a.style.setProperty(i,r)},hasClass:function(i){return t.root.classList.contains(i)},removeAttribute:function(i){t.root.removeAttribute(i)},removeClass:function(i){t.root.classList.remove(i)},setAttribute:function(i,r){t.root.setAttribute(i,r)},setStyle:function(i,r){t.root.style.setProperty(i,r)},attachResizeObserver:function(i){var r=window.ResizeObserver;if(r){var a=new r(i);return a.observe(t.root),a}return null},getWidth:function(){return t.root.offsetWidth}};return new re(n)},e}(x);/**
 * @license
 * Copyright 2019 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var R={CELL:"mdc-data-table__cell",CELL_NUMERIC:"mdc-data-table__cell--numeric",CONTENT:"mdc-data-table__content",HEADER_CELL:"mdc-data-table__header-cell",HEADER_CELL_LABEL:"mdc-data-table__header-cell-label",HEADER_CELL_SORTED:"mdc-data-table__header-cell--sorted",HEADER_CELL_SORTED_DESCENDING:"mdc-data-table__header-cell--sorted-descending",HEADER_CELL_WITH_SORT:"mdc-data-table__header-cell--with-sort",HEADER_CELL_WRAPPER:"mdc-data-table__header-cell-wrapper",HEADER_ROW:"mdc-data-table__header-row",HEADER_ROW_CHECKBOX:"mdc-data-table__header-row-checkbox",IN_PROGRESS:"mdc-data-table--in-progress",LINEAR_PROGRESS:"mdc-data-table__linear-progress",PAGINATION_ROWS_PER_PAGE_LABEL:"mdc-data-table__pagination-rows-per-page-label",PAGINATION_ROWS_PER_PAGE_SELECT:"mdc-data-table__pagination-rows-per-page-select",PROGRESS_INDICATOR:"mdc-data-table__progress-indicator",ROOT:"mdc-data-table",ROW:"mdc-data-table__row",ROW_CHECKBOX:"mdc-data-table__row-checkbox",ROW_SELECTED:"mdc-data-table__row--selected",SORT_ICON_BUTTON:"mdc-data-table__sort-icon-button",SORT_STATUS_LABEL:"mdc-data-table__sort-status-label",TABLE_CONTAINER:"mdc-data-table__table-container"},ke={ARIA_SELECTED:"aria-selected",ARIA_SORT:"aria-sort"},Pt={COLUMN_ID:"data-column-id",ROW_ID:"data-row-id"},k={CONTENT:"."+R.CONTENT,HEADER_CELL:"."+R.HEADER_CELL,HEADER_CELL_WITH_SORT:"."+R.HEADER_CELL_WITH_SORT,HEADER_ROW:"."+R.HEADER_ROW,HEADER_ROW_CHECKBOX:"."+R.HEADER_ROW_CHECKBOX,PROGRESS_INDICATOR:"."+R.PROGRESS_INDICATOR,ROW:"."+R.ROW,ROW_CHECKBOX:"."+R.ROW_CHECKBOX,ROW_SELECTED:"."+R.ROW_SELECTED,SORT_ICON_BUTTON:"."+R.SORT_ICON_BUTTON,SORT_STATUS_LABEL:"."+R.SORT_STATUS_LABEL},Ue={SORTED_IN_DESCENDING:"Sorted in descending order",SORTED_IN_ASCENDING:"Sorted in ascending order"},At={ARIA_SELECTED:ke.ARIA_SELECTED,ARIA_SORT:ke.ARIA_SORT,DATA_ROW_ID_ATTR:Pt.ROW_ID,HEADER_ROW_CHECKBOX_SELECTOR:k.HEADER_ROW_CHECKBOX,ROW_CHECKBOX_SELECTOR:k.ROW_CHECKBOX,ROW_SELECTED_SELECTOR:k.ROW_SELECTED,ROW_SELECTOR:k.ROW},K;(function(o){o.ASCENDING="ascending",o.DESCENDING="descending",o.NONE="none",o.OTHER="other"})(K||(K={}));var Ht={ROW_CLICK:"MDCDataTable:rowClick",ROW_SELECTION_CHANGED:"MDCDataTable:rowSelectionChanged",SELECTED_ALL:"MDCDataTable:selectedAll",SORTED:"MDCDataTable:sorted",UNSELECTED_ALL:"MDCDataTable:unselectedAll"};/**
 * @license
 * Copyright 2019 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var bi=function(o){v(e,o);function e(t){return o.call(this,f(f({},e.defaultAdapter),t))||this}return Object.defineProperty(e,"defaultAdapter",{get:function(){return{addClass:function(){},addClassAtRowIndex:function(){},getAttributeByHeaderCellIndex:function(){return""},getHeaderCellCount:function(){return 0},getHeaderCellElements:function(){return[]},getRowCount:function(){return 0},getRowElements:function(){return[]},getRowIdAtIndex:function(){return""},getRowIndexByChildElement:function(){return 0},getSelectedRowCount:function(){return 0},getTableContainerHeight:function(){return 0},getTableHeaderHeight:function(){return 0},isCheckboxAtRowIndexChecked:function(){return!1},isHeaderRowCheckboxChecked:function(){return!1},isRowsSelectable:function(){return!1},notifyRowSelectionChanged:function(){},notifySelectedAll:function(){},notifySortAction:function(){},notifyUnselectedAll:function(){},notifyRowClick:function(){},registerHeaderRowCheckbox:function(){},registerRowCheckboxes:function(){},removeClass:function(){},removeClassAtRowIndex:function(){},removeClassNameByHeaderCellIndex:function(){},setAttributeAtRowIndex:function(){},setAttributeByHeaderCellIndex:function(){},setClassNameByHeaderCellIndex:function(){},setHeaderRowCheckboxChecked:function(){},setHeaderRowCheckboxIndeterminate:function(){},setProgressIndicatorStyles:function(){},setRowCheckboxCheckedAtIndex:function(){},setSortStatusLabelByHeaderCellIndex:function(){}}},enumerable:!1,configurable:!0}),e.prototype.layout=function(){this.adapter.isRowsSelectable()&&(this.adapter.registerHeaderRowCheckbox(),this.adapter.registerRowCheckboxes(),this.setHeaderRowCheckboxState())},e.prototype.layoutAsync=function(){return hn(this,void 0,void 0,function(){return fn(this,function(t){switch(t.label){case 0:return this.adapter.isRowsSelectable()?[4,this.adapter.registerHeaderRowCheckbox()]:[3,3];case 1:return t.sent(),[4,this.adapter.registerRowCheckboxes()];case 2:t.sent(),this.setHeaderRowCheckboxState(),t.label=3;case 3:return[2]}})})},e.prototype.getRows=function(){return this.adapter.getRowElements()},e.prototype.getHeaderCells=function(){return this.adapter.getHeaderCellElements()},e.prototype.setSelectedRowIds=function(t){for(var n=0;n<this.adapter.getRowCount();n++){var i=this.adapter.getRowIdAtIndex(n),r=!1;i&&t.indexOf(i)>=0&&(r=!0),this.adapter.setRowCheckboxCheckedAtIndex(n,r),this.selectRowAtIndex(n,r)}this.setHeaderRowCheckboxState()},e.prototype.getRowIds=function(){for(var t=[],n=0;n<this.adapter.getRowCount();n++)t.push(this.adapter.getRowIdAtIndex(n));return t},e.prototype.getSelectedRowIds=function(){for(var t=[],n=0;n<this.adapter.getRowCount();n++)this.adapter.isCheckboxAtRowIndexChecked(n)&&t.push(this.adapter.getRowIdAtIndex(n));return t},e.prototype.handleHeaderRowCheckboxChange=function(){for(var t=this.adapter.isHeaderRowCheckboxChecked(),n=0;n<this.adapter.getRowCount();n++)this.adapter.setRowCheckboxCheckedAtIndex(n,t),this.selectRowAtIndex(n,t);t?this.adapter.notifySelectedAll():this.adapter.notifyUnselectedAll()},e.prototype.handleRowCheckboxChange=function(t){var n=this.adapter.getRowIndexByChildElement(t.target);if(n!==-1){var i=this.adapter.isCheckboxAtRowIndexChecked(n);this.selectRowAtIndex(n,i),this.setHeaderRowCheckboxState();var r=this.adapter.getRowIdAtIndex(n);this.adapter.notifyRowSelectionChanged({rowId:r,rowIndex:n,selected:i})}},e.prototype.handleSortAction=function(t){for(var n=t.columnId,i=t.columnIndex,r=t.headerCell,a=0;a<this.adapter.getHeaderCellCount();a++)a!==i&&(this.adapter.removeClassNameByHeaderCellIndex(a,R.HEADER_CELL_SORTED),this.adapter.removeClassNameByHeaderCellIndex(a,R.HEADER_CELL_SORTED_DESCENDING),this.adapter.setAttributeByHeaderCellIndex(a,At.ARIA_SORT,K.NONE),this.adapter.setSortStatusLabelByHeaderCellIndex(a,K.NONE));this.adapter.setClassNameByHeaderCellIndex(i,R.HEADER_CELL_SORTED);var s=this.adapter.getAttributeByHeaderCellIndex(i,At.ARIA_SORT),l=K.NONE;s===K.ASCENDING?(this.adapter.setClassNameByHeaderCellIndex(i,R.HEADER_CELL_SORTED_DESCENDING),this.adapter.setAttributeByHeaderCellIndex(i,At.ARIA_SORT,K.DESCENDING),l=K.DESCENDING):s===K.DESCENDING?(this.adapter.removeClassNameByHeaderCellIndex(i,R.HEADER_CELL_SORTED_DESCENDING),this.adapter.setAttributeByHeaderCellIndex(i,At.ARIA_SORT,K.ASCENDING),l=K.ASCENDING):(this.adapter.setAttributeByHeaderCellIndex(i,At.ARIA_SORT,K.ASCENDING),l=K.ASCENDING),this.adapter.setSortStatusLabelByHeaderCellIndex(i,l),this.adapter.notifySortAction({columnId:n,columnIndex:i,headerCell:r,sortValue:l})},e.prototype.handleRowClick=function(t){var n=t.rowId,i=t.row;this.adapter.notifyRowClick({rowId:n,row:i})},e.prototype.showProgress=function(){var t=this.adapter.getTableHeaderHeight(),n=this.adapter.getTableContainerHeight()-t,i=t;this.adapter.setProgressIndicatorStyles({height:n+"px",top:i+"px"}),this.adapter.addClass(R.IN_PROGRESS)},e.prototype.hideProgress=function(){this.adapter.removeClass(R.IN_PROGRESS)},e.prototype.setHeaderRowCheckboxState=function(){this.adapter.getSelectedRowCount()===0?(this.adapter.setHeaderRowCheckboxChecked(!1),this.adapter.setHeaderRowCheckboxIndeterminate(!1)):this.adapter.getSelectedRowCount()===this.adapter.getRowCount()?(this.adapter.setHeaderRowCheckboxChecked(!0),this.adapter.setHeaderRowCheckboxIndeterminate(!1)):(this.adapter.setHeaderRowCheckboxIndeterminate(!0),this.adapter.setHeaderRowCheckboxChecked(!1))},e.prototype.selectRowAtIndex=function(t,n){n?(this.adapter.addClassAtRowIndex(t,R.ROW_SELECTED),this.adapter.setAttributeAtRowIndex(t,At.ARIA_SELECTED,"true")):(this.adapter.removeClassAtRowIndex(t,R.ROW_SELECTED),this.adapter.setAttributeAtRowIndex(t,At.ARIA_SELECTED,"false"))},e}(D);/**
 * @license
 * Copyright 2019 Google Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */var _i=function(o){v(e,o);function e(){return o!==null&&o.apply(this,arguments)||this}return e.attachTo=function(t){return new e(t)},e.prototype.initialize=function(t){t===void 0&&(t=function(n){return new tn(n)}),this.checkboxFactory=t},e.prototype.initialSyncWithDOM=function(){var t=this;this.headerRow=this.root.querySelector("."+R.HEADER_ROW),this.handleHeaderRowCheckboxChange=function(){t.foundation.handleHeaderRowCheckboxChange()},this.headerRow.addEventListener("change",this.handleHeaderRowCheckboxChange),this.headerRowClickListener=function(n){t.handleHeaderRowClick(n)},this.headerRow.addEventListener("click",this.headerRowClickListener),this.content=this.root.querySelector("."+R.CONTENT),this.handleContentClick=function(n){var i=dt(n.target,k.ROW);i&&t.foundation.handleRowClick({rowId:t.getRowIdByRowElement(i),row:i})},this.content.addEventListener("click",this.handleContentClick),this.handleRowCheckboxChange=function(n){t.foundation.handleRowCheckboxChange(n)},this.content.addEventListener("change",this.handleRowCheckboxChange),this.layout()},e.prototype.layout=function(){this.foundation.layout()},e.prototype.getHeaderCells=function(){return[].slice.call(this.root.querySelectorAll(k.HEADER_CELL))},e.prototype.getRows=function(){return this.foundation.getRows()},e.prototype.getSelectedRowIds=function(){return this.foundation.getSelectedRowIds()},e.prototype.setSelectedRowIds=function(t){this.foundation.setSelectedRowIds(t)},e.prototype.showProgress=function(){this.getLinearProgress().open(),this.foundation.showProgress()},e.prototype.hideProgress=function(){this.foundation.hideProgress(),this.getLinearProgress().close()},e.prototype.destroy=function(){var t,n;if(this.handleHeaderRowCheckboxChange&&this.headerRow.removeEventListener("change",this.handleHeaderRowCheckboxChange),this.headerRowClickListener&&this.headerRow.removeEventListener("click",this.headerRowClickListener),this.handleRowCheckboxChange&&this.content.removeEventListener("change",this.handleRowCheckboxChange),this.headerRowCheckbox&&this.headerRowCheckbox.destroy(),this.rowCheckboxList)try{for(var i=O(this.rowCheckboxList),r=i.next();!r.done;r=i.next()){var a=r.value;a.destroy()}}catch(s){t={error:s}}finally{try{r&&!r.done&&(n=i.return)&&n.call(i)}finally{if(t)throw t.error}}this.handleContentClick&&this.content.removeEventListener("click",this.handleContentClick)},e.prototype.getDefaultFoundation=function(){var t=this,n={addClass:function(i){t.root.classList.add(i)},removeClass:function(i){t.root.classList.remove(i)},getHeaderCellElements:function(){return t.getHeaderCells()},getHeaderCellCount:function(){return t.getHeaderCells().length},getAttributeByHeaderCellIndex:function(i,r){return t.getHeaderCells()[i].getAttribute(r)},setAttributeByHeaderCellIndex:function(i,r,a){t.getHeaderCells()[i].setAttribute(r,a)},setClassNameByHeaderCellIndex:function(i,r){t.getHeaderCells()[i].classList.add(r)},removeClassNameByHeaderCellIndex:function(i,r){t.getHeaderCells()[i].classList.remove(r)},notifySortAction:function(i){t.emit(Ht.SORTED,i,!0)},getTableContainerHeight:function(){var i=t.root.querySelector("."+R.TABLE_CONTAINER);if(!i)throw new Error("MDCDataTable: Table container element not found.");return i.getBoundingClientRect().height},getTableHeaderHeight:function(){var i=t.root.querySelector(k.HEADER_ROW);if(!i)throw new Error("MDCDataTable: Table header element not found.");return i.getBoundingClientRect().height},setProgressIndicatorStyles:function(i){var r=t.root.querySelector(k.PROGRESS_INDICATOR);if(!r)throw new Error("MDCDataTable: Progress indicator element not found.");r.style.setProperty("height",i.height),r.style.setProperty("top",i.top)},addClassAtRowIndex:function(i,r){t.getRows()[i].classList.add(r)},getRowCount:function(){return t.getRows().length},getRowElements:function(){return[].slice.call(t.root.querySelectorAll(k.ROW))},getRowIdAtIndex:function(i){return t.getRows()[i].getAttribute(Pt.ROW_ID)},getRowIndexByChildElement:function(i){return t.getRows().indexOf(dt(i,k.ROW))},getSelectedRowCount:function(){return t.root.querySelectorAll(k.ROW_SELECTED).length},isCheckboxAtRowIndexChecked:function(i){return t.rowCheckboxList[i].checked},isHeaderRowCheckboxChecked:function(){return t.headerRowCheckbox.checked},isRowsSelectable:function(){return!!t.root.querySelector(k.ROW_CHECKBOX)||!!t.root.querySelector(k.HEADER_ROW_CHECKBOX)},notifyRowSelectionChanged:function(i){t.emit(Ht.ROW_SELECTION_CHANGED,{row:t.getRowByIndex(i.rowIndex),rowId:t.getRowIdByIndex(i.rowIndex),rowIndex:i.rowIndex,selected:i.selected},!0)},notifySelectedAll:function(){t.emit(Ht.SELECTED_ALL,{},!0)},notifyUnselectedAll:function(){t.emit(Ht.UNSELECTED_ALL,{},!0)},notifyRowClick:function(i){t.emit(Ht.ROW_CLICK,i,!0)},registerHeaderRowCheckbox:function(){t.headerRowCheckbox&&t.headerRowCheckbox.destroy();var i=t.root.querySelector(k.HEADER_ROW_CHECKBOX);t.headerRowCheckbox=t.checkboxFactory(i)},registerRowCheckboxes:function(){t.rowCheckboxList&&t.rowCheckboxList.forEach(function(i){i.destroy()}),t.rowCheckboxList=[],t.getRows().forEach(function(i){var r=t.checkboxFactory(i.querySelector(k.ROW_CHECKBOX));t.rowCheckboxList.push(r)})},removeClassAtRowIndex:function(i,r){t.getRows()[i].classList.remove(r)},setAttributeAtRowIndex:function(i,r,a){t.getRows()[i].setAttribute(r,a)},setHeaderRowCheckboxChecked:function(i){t.headerRowCheckbox.checked=i},setHeaderRowCheckboxIndeterminate:function(i){t.headerRowCheckbox.indeterminate=i},setRowCheckboxCheckedAtIndex:function(i,r){t.rowCheckboxList[i].checked=r},setSortStatusLabelByHeaderCellIndex:function(i,r){var a=t.getHeaderCells()[i],s=a.querySelector(k.SORT_STATUS_LABEL);s&&(s.textContent=t.getSortStatusMessageBySortValue(r))}};return new bi(n)},e.prototype.getRowByIndex=function(t){return this.getRows()[t]},e.prototype.getRowIdByIndex=function(t){return this.getRowByIndex(t).getAttribute(Pt.ROW_ID)},e.prototype.handleHeaderRowClick=function(t){var n=dt(t.target,k.HEADER_CELL_WITH_SORT);if(n){var i=n.getAttribute(Pt.COLUMN_ID),r=this.getHeaderCells().indexOf(n);r!==-1&&this.foundation.handleSortAction({columnId:i,columnIndex:r,headerCell:n})}},e.prototype.getSortStatusMessageBySortValue=function(t){switch(t){case K.ASCENDING:return Ue.SORTED_IN_ASCENDING;case K.DESCENDING:return Ue.SORTED_IN_DESCENDING;default:return""}},e.prototype.getLinearProgressElement=function(){var t=this.root.querySelector("."+R.LINEAR_PROGRESS);if(!t)throw new Error("MDCDataTable: linear progress element is not found.");return t},e.prototype.getLinearProgress=function(){if(!this.linearProgress){var t=this.getLinearProgressElement();this.linearProgress=new Oi(t)}return this.linearProgress},e.prototype.getRowIdByRowElement=function(t){return t.getAttribute(Pt.ROW_ID)},e}(x);[].map.call(document.querySelectorAll(".mdc-switch"),function(o){return new si(o)});[].map.call(document.querySelectorAll(".mdc-button"),function(o){return new U(o)});[].map.call(document.querySelectorAll(".mdc-button-ripple"),function(o){return new U(o)});[].map.call(document.querySelectorAll(".mdc-select"),function(o){return new un(o)});[].map.call(document.querySelectorAll(".mdc-text-field:not(.dummy-field)"),function(o){return new Qe(o)});function Li(o){if(document.getElementById(o)!==null)return new Qe(document.getElementById(o))}window.initTextField=Li;[].map.call(document.querySelectorAll(".icontoggle"),function(o){return new Dn(o)});[].map.call(document.querySelectorAll(".mdc-ripple-surface"),function(o){return new U(o)});[].map.call(document.querySelectorAll(".mdc-radio"),function(o){return new Si(o)});if(document.getElementById("confirm-dialog")!==null){let e=function(){o.open()};var delDialog=e;const o=new kt(document.querySelector(".confirm-dialog"));window.delDialog=e,window.confDialog=o}if(document.getElementById("unsub-dialog")!==null){let e=function(){o.open()};var unsubDialog=e;const o=new kt(document.querySelector(".unsub-dialog"));window.unsubDialog=e}[].map.call(document.querySelectorAll(".mdc-icon-button"),function(o){let e=new U(o);return e.unbounded=!0,e});[].map.call(document.querySelectorAll(".mdc-checkbox"),function(o){return new tn(o)});[].map.call(document.querySelectorAll(".mdc-deprecated-list"),function(o){let e=new on(o);return e.listElements.map(t=>new U(t)),e});[].map.call(document.querySelectorAll(".mdc-data-table"),function(o){return new _i(o)});if(document.getElementById("snackbar")!==null){let e=function(t){o.labelText=t,o.open()};var snack=e;const o=new en(document.querySelector(".snackbar"));window.snack=e,window.snackbar=o}if(document.getElementById("refreshpwa")!==null){let e=function(){o.open()};var showRefresh=e;const o=new en(document.querySelector(".refreshpwa"));window.showRefresh=e,window.pwaSnackbar=o}if(document.querySelector(".edit-more-menu")!==null){const o=new ce(document.querySelector(".edit-more-menu"));window.moreMenu=o}if(document.querySelector(".delete-item-confirmation")!==null){let e=function(){o.open()};var openAssignmentDialog=e;const o=new kt(document.querySelector(".delete-item-confirmation"));window.deleteAssignmentDialog=o,window.openAssignmentDialog=e}const Xt=document.querySelector(".delete-schedule-confirmation");if(Xt!==null){const o=new kt(Xt);window.scheduleDeleteDialog=async function(){o.open();const e=Xt.querySelector(".cancel"),t=Xt.querySelector(".confirm");return new Promise((n,i)=>{e.onclick=i,t.onclick=n})}}if(document.querySelector(".suggestions-menu")!==null){const o=new ce(document.querySelector(".suggestions-menu"));window.suggestionsMenu=o}if(document.querySelector(".manage-reminders-dialog")!==null){const o=new kt(document.querySelector(".manage-reminders-dialog"));o.scrimClickAction="",document.getElementById("reminder-button").addEventListener("click",()=>{o.open()})}[].map.call(document.querySelectorAll(".mdc-tooltip"),function(o){try{return new ln(o)}catch{}});function Ri(){setTimeout(()=>{document.querySelectorAll(".mdc-select").forEach(o=>new un(o))},75)}window.regenSelects=Ri;function Di(o){if(document.getElementById(o)!==null)return new ln(document.getElementById(o))}window.initTooltip=Di;
