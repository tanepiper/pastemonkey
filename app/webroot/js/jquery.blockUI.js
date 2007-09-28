(function(A){A.blockUI=function(D,B,C){A.blockUI.impl.install(window,D,B,C)};A.blockUI.version=1.33;A.unblockUI=function(B){A.blockUI.impl.remove(window,B)};A.fn.block=function(D,B,C){return this.each(function(){if(!this.$pos_checked){if(A.css(this,"position")=="static"){this.style.position="relative"}if(A.browser.msie){this.style.zoom=1}this.$pos_checked=1}A.blockUI.impl.install(this,D,B,C)})};A.fn.unblock=function(B){return this.each(function(){A.blockUI.impl.remove(this,B)})};A.fn.displayBox=function(K,L,I){var E=this[0];if(!E){return }var N=A(E);K=K||{};var M=N.width()||N.attr("width")||K.width||A.blockUI.defaults.displayBoxCSS.width;var J=N.height()||N.attr("height")||K.height||A.blockUI.defaults.displayBoxCSS.height;if(M[M.length-1]=="%"){var H=document.documentElement.clientWidth||document.body.clientWidth;M=parseInt(M)||100;M=(M*H)/100}if(J[J.length-1]=="%"){var F=document.documentElement.clientHeight||document.body.clientHeight;J=parseInt(J)||100;J=(J*F)/100}var G="-"+parseInt(M)/2+"px";var C="-"+parseInt(J)/2+"px";var D=navigator.userAgent.toLowerCase();var B={displayMode:L||1,noalpha:I&&/mac/.test(D)&&/firefox/.test(D)};A.blockUI.impl.install(window,E,{width:M,height:J,marginTop:C,marginLeft:G},B)};A.blockUI.defaults={pageMessage:"<h1>Please wait...<\/h1>",elementMessage:"",overlayCSS:{backgroundColor:"#fff",opacity:"0.5"},pageMessageCSS:{width:"250px",margin:"-50px 0 0 -125px",top:"50%",left:"50%",textAlign:"center",color:"#000",backgroundColor:"#fff",border:"3px solid #aaa"},elementMessageCSS:{width:"250px",padding:"10px",textAlign:"center",backgroundColor:"#fff"},displayBoxCSS:{width:"400px",height:"400px",top:"50%",left:"50%"},ie6Stretch:1,allowTabToLeave:0,closeMessage:"Click to close",fadeOut:1,fadeTime:400};A.blockUI.impl={box:null,boxCallback:null,pageBlock:null,pageBlockEls:[],op8:window.opera&&window.opera.version()<9,ie6:A.browser.msie&&/MSIE 6.0/.test(navigator.userAgent),install:function(D,E,H,B){B=B||{};this.boxCallback=typeof B.displayMode=="function"?B.displayMode:null;this.box=B.displayMode?E:null;var J=(D==window);var O=this.op8||A.browser.mozilla&&/Linux/.test(navigator.platform);if(typeof B.alphaOverride!="undefined"){O=B.alphaOverride==0?1:0}if(J&&this.pageBlock){this.remove(window,{fadeOut:0})}if(E&&typeof E=="object"&&!E.jquery&&!E.nodeType){H=E;E=null}E=E?(E.nodeType?A(E):E):J?A.blockUI.defaults.pageMessage:A.blockUI.defaults.elementMessage;if(B.displayMode){var P=jQuery.extend({},A.blockUI.defaults.displayBoxCSS)}else{var P=jQuery.extend({},J?A.blockUI.defaults.pageMessageCSS:A.blockUI.defaults.elementMessageCSS)}H=jQuery.extend(P,H||{});var I=(A.browser.msie)?A('<iframe class="blockUI" style="z-index:1000;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="javascript:false;"><\/iframe>'):A('<div class="blockUI" style="display:none"><\/div>');var M=A('<div class="blockUI" style="z-index:1001;cursor:wait;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"><\/div>');var F=J?A('<div class="blockUI blockMsg" style="z-index:1002;cursor:wait;padding:0;position:fixed"><\/div>'):A('<div class="blockUI" style="display:none;z-index:1002;cursor:wait;position:absolute"><\/div>');M.css("position",J?"fixed":"absolute");if(E){F.css(H)}if(!O){M.css(A.blockUI.defaults.overlayCSS)}if(this.op8){M.css({width:""+D.clientWidth,height:""+D.clientHeight})}if(A.browser.msie){I.css("opacity","0.0")}A([I[0],M[0],F[0]]).appendTo(J?"body":D);var L=A.browser.msie&&(!A.boxModel||A("object,embed",J?null:D).length>0);if(this.ie6||L){if(J&&A.blockUI.defaults.ie6Stretch&&A.boxModel){A("html,body").css("height","100%")}if((this.ie6||!A.boxModel)&&!J){var N=this.sz(D,"borderTopWidth"),G=this.sz(D,"borderLeftWidth");var K=N?"(0 - "+N+")":0;var C=G?"(0 - "+G+")":0}A.each([I,M,F],function(Q,S){var R=S[0].style;R.position="absolute";if(Q<2){J?R.setExpression("height",'document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + "px"'):R.setExpression("height",'this.parentNode.offsetHeight + "px"');J?R.setExpression("width",'jQuery.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"'):R.setExpression("width",'this.parentNode.offsetWidth + "px"');if(C){R.setExpression("left",C)}if(K){R.setExpression("top",K)}}else{if(J){R.setExpression("top",'(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"')}R.marginTop=0}})}if(B.displayMode){M.css("cursor","default").attr("title",A.blockUI.defaults.closeMessage);F.css("cursor","default");A([I[0],M[0],F[0]]).removeClass("blockUI").addClass("displayBox");A().click(A.blockUI.impl.boxHandler).bind("keypress",A.blockUI.impl.boxHandler)}else{this.bind(1,D)}F.append(E).show();if(E.jquery){E.show()}if(B.displayMode){return }if(J){this.pageBlock=F[0];this.pageBlockEls=A(":input:enabled:visible",this.pageBlock);setTimeout(this.focus,20)}else{this.center(F[0])}},remove:function(D,E){var F=A.extend({},A.blockUI.defaults,E);this.bind(0,D);var C=D==window;var B=C?A("body").children().filter(".blockUI"):A(".blockUI",D);if(C){this.pageBlock=this.pageBlockEls=null}if(F.fadeOut){B.fadeOut(F.fadeTime,function(){if(this.parentNode){this.parentNode.removeChild(this)}})}else{B.remove()}},boxRemove:function(B){A().unbind("click",A.blockUI.impl.boxHandler).unbind("keypress",A.blockUI.impl.boxHandler);if(this.boxCallback){this.boxCallback(this.box)}A("body .displayBox").hide().remove()},handler:function(E){if(E.keyCode&&E.keyCode==9){if(A.blockUI.impl.pageBlock&&!A.blockUI.defaults.allowTabToLeave){var D=A.blockUI.impl.pageBlockEls;var C=!E.shiftKey&&E.target==D[D.length-1];var B=E.shiftKey&&E.target==D[0];if(C||B){setTimeout(function(){A.blockUI.impl.focus(B)},10);return false}}}if(A(E.target).parents("div.blockMsg").length>0){return true}return A(E.target).parents().children().filter("div.blockUI").length==0},boxHandler:function(B){if((B.keyCode&&B.keyCode==27)||(B.type=="click"&&A(B.target).parents("div.blockMsg").length==0)){A.blockUI.impl.boxRemove()}return true},bind:function(B,E){var D=E==window;if(!B&&(D&&!this.pageBlock||!D&&!E.$blocked)){return }if(!D){E.$blocked=B}var C=A(E).find("a,:input");A.each(["mousedown","mouseup","keydown","keypress","click"],function(F,G){C[B?"bind":"unbind"](G,A.blockUI.impl.handler)})},focus:function(B){if(!A.blockUI.impl.pageBlockEls){return }var C=A.blockUI.impl.pageBlockEls[B===true?A.blockUI.impl.pageBlockEls.length-1:0];if(C){C.focus()}},center:function(E){var F=E.parentNode,D=E.style;var B=((F.offsetWidth-E.offsetWidth)/2)-this.sz(F,"borderLeftWidth");var C=((F.offsetHeight-E.offsetHeight)/2)-this.sz(F,"borderTopWidth");D.left=B>0?(B+"px"):"0";D.top=C>0?(C+"px"):"0"},sz:function(B,C){return parseInt(A.css(B,C))||0}}})(jQuery)