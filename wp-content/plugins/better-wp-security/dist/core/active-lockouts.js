/*! For license information please see active-lockouts.js.LICENSE.txt */
(globalThis.itsecWebpackJsonP=globalThis.itsecWebpackJsonP||[]).push([[8827],{30449:(e,t,r)=>{"use strict";r.r(t),r.d(t,{ActiveLockout:()=>v,ActiveLockoutActions:()=>l,Detail:()=>g,List:()=>b,Search:()=>k,useActiveLockouts:()=>O,useBanLockout:()=>I,useReleaseLockout:()=>D});var n=r(6293),i=r(64893),s=r(95122),o=r(36179),a=r(1528);function l({isReleaseAvailable:e,selectedId:t,releasingIds:r,onRelease:l,isBannable:c,banningIds:u,onBan:d}){return(0,n.createElement)(a.CardFooter,null,(0,n.createElement)(o.Xp,null),e&&(0,n.createElement)("span",null,(0,n.createElement)(i.Button,{variant:"primary","aria-disabled":r.includes(t),isBusy:r.includes(t),onClick:l},(0,s.__)("Release Lockout","better-wp-security"))),c&&(0,n.createElement)("span",null,(0,n.createElement)(i.Button,{variant:"primary","aria-disabled":u.includes(t),isBusy:u.includes(t),onClick:d},(0,s.__)("Ban","better-wp-security"))))}var c=r(71930),u=r(82521),d=r(65813),h=r(52117);const m=(0,h.Z)("div",{target:"e1660rj82"})({name:"wp0fdl",styles:"padding:0.5rem 1.25rem"}),p=(0,h.Z)("li",{target:"e1660rj81"})({name:"a0377c",styles:"display:flex;align-items:center;gap:0.75rem"}),f=(0,h.Z)(c.xv,{target:"e1660rj80"})("background-color:",(({theme:e})=>e.colors.surface.secondary),";padding:11px 6px;border-radius:2px;");function g({master:e={},isVisible:t,fetchLockoutDetails:r}){const i=(0,n.useMemo)((()=>e),[e]),s=(0,n.useCallback)((()=>r(e)),[r,e]),{value:o}=(0,d.r5)(s,t);return(0,n.createElement)(m,null,(0,n.createElement)(v,{master:i}),o&&o.history.length>0&&(0,n.createElement)(y,{history:o.history}))}function v({master:e={}}){return(0,n.createElement)(React.Fragment,null,(0,n.createElement)(i.Tooltip,{text:(0,u.dateI18n)("M d, Y g:s A",e.start_gmt)},(0,n.createElement)("span",null,(0,n.createElement)(c.xv,{as:"time",size:c.yH.SMALL,textTransform:"capitalize",variant:c.rK.MUTED,text:(0,s.sprintf)((0,s.__)("%s ago","better-wp-security"),e.start_gmt_relative)}))),(0,n.createElement)(c.X6,{level:3,size:c.yH.NORMAL,variant:c.rK.DARK,weight:c.fs.HEAVY,text:e.label}),(0,n.createElement)(c.xv,{variant:c.rK.DARK,text:e.description}))}function y({history:e}){return(0,n.createElement)(React.Fragment,null,(0,n.createElement)("hr",null),(0,n.createElement)("div",null,(0,n.createElement)(c.X6,{level:4,size:c.yH.NORMAL,variant:c.rK.DARK,weight:c.fs.HEAVY,text:(0,s.__)("History","better-wp-security")}),(0,n.createElement)("ul",null,e.map((e=>(0,n.createElement)(w,{key:e.id,history:e}))))))}function w({history:e}){if(e.label)return(0,n.createElement)(p,{key:e.id},(0,n.createElement)(f,{as:"code"},e.label),(0,n.createElement)(i.Tooltip,{text:(0,u.dateI18n)("M d, Y g:s A",e.time)},(0,n.createElement)("span",null," ","•"," ",(0,n.createElement)(c.xv,{as:"time",variant:c.rK.DARK,text:(0,s.sprintf)((0,s.__)("%s ago","better-wp-security"),e.time_relative)}))))}function b({lockouts:e,select:t,selectedLockout:r,fetchLockoutDetails:i}){return(0,n.createElement)(c.dy,{masters:e,getId:e=>e.id,isBorderless:!0,isSinglePane:!0,mode:"list",renderMaster:e=>(0,n.createElement)(v,{master:e}),onSelect:t,selectedId:r?.id||0,renderDetail:(e,t)=>(0,n.createElement)(g,{master:e,isVisible:t,fetchLockoutDetails:i})})}const E=(0,h.Z)("div",{target:"exlks1m0"})({name:"1dvcxr3",styles:"padding:1rem"});function k({searchTerm:e,setSearchTerm:t,isQuerying:r,query:i,queryId:o}){return(0,n.createElement)(E,null,(0,n.createElement)(c.lD,{placeholder:(0,s.__)("Search Lockouts","better-wp-security"),value:e,onChange:e=>{t(e),i(o,e?{search:e}:{})},isSearching:r,size:"small"}))}var x=r(48015),L=r(87514),_=r.n(L);function I(e){const[t,r]=(0,n.useState)([]),{createNotice:i,removeNotice:o}=(0,x.useDispatch)("core/notices"),a=e._links["ithemes-security:ban-lockout"]?.[0].href,l=!!a;return[t,(0,n.useCallback)((async e=>{const t=a.replace("{lockout_id}",e),n=`ban-lockout-${t}`;r((t=>[...t,e])),o(n,"ithemes-security");try{return await _()({url:t,method:"POST"}),setTimeout((()=>o(n,"ithemes-security")),5e3),i("success",(0,s.__)("Ban Created","better-wp-security"),{id:n,context:"ithemes-security"}),!0}catch(e){return i("error",(0,s.sprintf)((0,s.__)("Error when banning lockout: %s","better-wp-security"),e.message||(0,s.__)("An unexpected error occurred.","better-wp-security")),{id:n,context:"ithemes-security"}),!1}finally{r((t=>t.filter((t=>t!==e))))}}),[a,i,o]),l]}function D(e){const[t,r]=(0,n.useState)([]),{createNotice:i,removeNotice:o}=(0,x.useDispatch)("core/notices"),a=e._links["ithemes-security:release-lockout"]?.[0].href,l=!!a;return[t,(0,n.useCallback)((async e=>{const t=a.replace("{lockout_id}",e),n=`release-lockout-${t}`;r((t=>[...t,e])),o(n,"ithemes-security");try{return await _()({url:t,method:"DELETE"}),setTimeout((()=>o(n,"ithemes-security")),5e3),i("success",(0,s.__)("Lockout Released","better-wp-security"),{id:n,context:"ithemes-security"}),!0}catch(e){return i("error",(0,s.sprintf)((0,s.__)("Error when releasing lockout: %s","better-wp-security"),e.message||(0,s.__)("An unexpected error occurred.","better-wp-security")),{id:n,context:"ithemes-security"}),!1}finally{r((t=>t.filter((t=>t!==e))))}}),[a,i,o]),l]}function O(e){const[t,r]=(0,n.useState)(0),[i,s]=(0,n.useState)(""),[o,a,l]=I(e),[c,u,d]=D(e),h=(0,n.useCallback)((e=>{if(!e.links.item)return Promise.reject(new Error("No data available."));const t=e.links.item[0].href.replace("{lockout_id}",e.id);return _()({url:t}).then((e=>e.detail))}),[]),{isQuerying:m}=(0,x.useSelect)((t=>({isQuerying:t("ithemes-security/dashboard").isQueryingDashboardCard(e.id)})),[e.id]),{queryDashboardCard:p,refreshDashboardCard:f}=(0,x.useDispatch)("ithemes-security/dashboard");return{selectedId:t,searchTerm:i,setSearchTerm:s,isQuerying:m,query:p,select:e=>r(e),getDetails:h,onBan:async n=>{n.preventDefault();const i=await a(t);await f(e.id),i&&r((e=>e===t?0:e))},onRelease:async n=>{n.preventDefault();const i=await u(t);await f(e.id),i&&r((e=>e===t?0:e))},isBanAvailable:l,isReleaseAvailable:d,releasingIds:c,banningIds:o}}r.p=window.itsecWebpackPublicPath},11984:(e,t,r)=>{"use strict";r.d(t,{Z:()=>i});var n=r(6293);const i=function({icon:e,size:t=24,...r}){return(0,n.cloneElement)(e,{width:t,height:t,...r})}},79526:(e,t,r)=>{"use strict";r.d(t,{Z:()=>s});var n=r(6293),i=r(14776);const s=(0,n.createElement)(i.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,n.createElement)(i.Path,{d:"M7 11.5h10V13H7z"}))},94184:(e,t)=>{var r;!function(){"use strict";var n={}.hasOwnProperty;function i(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var s=typeof r;if("string"===s||"number"===s)e.push(r);else if(Array.isArray(r)){if(r.length){var o=i.apply(null,r);o&&e.push(o)}}else if("object"===s)if(r.toString===Object.prototype.toString)for(var a in r)n.call(r,a)&&r[a]&&e.push(a);else e.push(r.toString())}}return e.join(" ")}e.exports?(i.default=i,e.exports=i):void 0===(r=function(){return i}.apply(t,[]))||(e.exports=r)}()},64239:(e,t,r)=>{"use strict";function n(e){return"object"==typeof e&&null!=e&&1===e.nodeType}function i(e,t){return(!t||"hidden"!==e)&&"visible"!==e&&"clip"!==e}function s(e,t){if(e.clientHeight<e.scrollHeight||e.clientWidth<e.scrollWidth){var r=getComputedStyle(e,null);return i(r.overflowY,t)||i(r.overflowX,t)||function(e){var t=function(e){if(!e.ownerDocument||!e.ownerDocument.defaultView)return null;try{return e.ownerDocument.defaultView.frameElement}catch(e){return null}}(e);return!!t&&(t.clientHeight<e.scrollHeight||t.clientWidth<e.scrollWidth)}(e)}return!1}function o(e,t,r,n,i,s,o,a){return s<e&&o>t||s>e&&o<t?0:s<=e&&a<=r||o>=t&&a>=r?s-e-n:o>t&&a<r||s<e&&a>r?o-t+i:0}function a(e,t){var r=window,i=t.scrollMode,a=t.block,l=t.inline,c=t.boundary,u=t.skipOverflowHiddenElements,d="function"==typeof c?c:function(e){return e!==c};if(!n(e))throw new TypeError("Invalid target");for(var h=document.scrollingElement||document.documentElement,m=[],p=e;n(p)&&d(p);){if((p=p.parentElement)===h){m.push(p);break}null!=p&&p===document.body&&s(p)&&!s(document.documentElement)||null!=p&&s(p,u)&&m.push(p)}for(var f=r.visualViewport?r.visualViewport.width:innerWidth,g=r.visualViewport?r.visualViewport.height:innerHeight,v=window.scrollX||pageXOffset,y=window.scrollY||pageYOffset,w=e.getBoundingClientRect(),b=w.height,E=w.width,k=w.top,x=w.right,L=w.bottom,_=w.left,I="start"===a||"nearest"===a?k:"end"===a?L:k+b/2,D="center"===l?_+E/2:"end"===l?x:_,O=[],A=0;A<m.length;A++){var S=m[A],N=S.getBoundingClientRect(),R=N.height,T=N.width,B=N.top,C=N.right,H=N.bottom,M=N.left;if("if-needed"===i&&k>=0&&_>=0&&L<=g&&x<=f&&k>=B&&L<=H&&_>=M&&x<=C)return O;var W=getComputedStyle(S),V=parseInt(W.borderLeftWidth,10),j=parseInt(W.borderTopWidth,10),K=parseInt(W.borderRightWidth,10),P=parseInt(W.borderBottomWidth,10),z=0,Y=0,Z="offsetWidth"in S?S.offsetWidth-S.clientWidth-V-K:0,X="offsetHeight"in S?S.offsetHeight-S.clientHeight-j-P:0;if(h===S)z="start"===a?I:"end"===a?I-g:"nearest"===a?o(y,y+g,g,j,P,y+I,y+I+b,b):I-g/2,Y="start"===l?D:"center"===l?D-f/2:"end"===l?D-f:o(v,v+f,f,V,K,v+D,v+D+E,E),z=Math.max(0,z+y),Y=Math.max(0,Y+v);else{z="start"===a?I-B-j:"end"===a?I-H+P+X:"nearest"===a?o(B,H,R,j,P+X,I,I+b,b):I-(B+R/2)+X/2,Y="start"===l?D-M-V:"center"===l?D-(M+T/2)+Z/2:"end"===l?D-C+K+Z:o(M,C,T,V,K+Z,D,D+E,E);var q=S.scrollLeft,Q=S.scrollTop;I+=Q-(z=Math.max(0,Math.min(Q+z,S.scrollHeight-R+X))),D+=q-(Y=Math.max(0,Math.min(q+Y,S.scrollWidth-T+Z)))}O.push({el:S,top:z,left:Y})}return O}function l(e){return e===Object(e)&&0!==Object.keys(e).length}r.d(t,{Z:()=>c});const c=function(e,t){var r=e.isConnected||e.ownerDocument.documentElement.contains(e);if(l(t)&&"function"==typeof t.behavior)return t.behavior(r?a(e,t):[]);if(r){var n=function(e){return!1===e?{block:"end",inline:"nearest"}:l(e)?e:{block:"start",inline:"nearest"}}(t);return function(e,t){void 0===t&&(t="auto");var r="scrollBehavior"in document.body.style;e.forEach((function(e){var n=e.el,i=e.top,s=e.left;n.scroll&&r?n.scroll({top:i,left:s,behavior:t}):(n.scrollTop=i,n.scrollLeft=s)}))}(a(e,n),n.behavior)}}},1528:e=>{e.exports=function(){return this.itsec.dashboard.dashboard}()},31600:e=>{e.exports=function(){return this.itsec.packages.data}()},87514:e=>{e.exports=function(){return this.wp.apiFetch}()},64893:e=>{e.exports=function(){return this.wp.components}()},9576:e=>{e.exports=function(){return this.wp.compose}()},48015:e=>{e.exports=function(){return this.wp.data}()},82521:e=>{e.exports=function(){return this.wp.date}()},6293:e=>{e.exports=function(){return this.wp.element}()},95122:e=>{e.exports=function(){return this.wp.i18n}()},81834:e=>{e.exports=function(){return this.wp.isShallowEqual}()},81019:e=>{e.exports=function(){return this.wp.keycodes}()},14776:e=>{e.exports=function(){return this.wp.primitives}()},73470:e=>{e.exports=function(){return this.wp.url}()},99196:e=>{"use strict";e.exports=window.React},92819:e=>{"use strict";e.exports=window.lodash}},e=>{e.O(0,[7271,1930,5307,5257,1511,976,6179],(()=>(30449,e(e.s=30449))));var t=e.O();((window.itsec=window.itsec||{}).core=window.itsec.core||{})["active-lockouts"]=t}]);