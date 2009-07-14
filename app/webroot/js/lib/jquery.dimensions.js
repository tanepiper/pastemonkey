(function(G){var A=G.fn.height,E=G.fn.width;G.fn.extend({height:function(){if(!this[0]){D()}if(this[0]==window){if(G.browser.opera||(G.browser.safari&&parseInt(G.browser.version)>520)){return self.innerHeight-((G(document).height()>self.innerHeight)?B():0)}else{if(G.browser.safari){return self.innerHeight}else{return G.boxModel&&document.documentElement.clientHeight||document.body.clientHeight}}}if(this[0]==document){return Math.max((G.boxModel&&document.documentElement.scrollHeight||document.body.scrollHeight),document.body.offsetHeight)}return A.apply(this,arguments)},width:function(){if(!this[0]){D()}if(this[0]==window){if(G.browser.opera||(G.browser.safari&&parseInt(G.browser.version)>520)){return self.innerWidth-((G(document).width()>self.innerWidth)?B():0)}else{if(G.browser.safari){return self.innerWidth}else{return G.boxModel&&document.documentElement.clientWidth||document.body.clientWidth}}}if(this[0]==document){if(G.browser.mozilla){var J=self.pageXOffset;self.scrollTo(99999999,self.pageYOffset);var I=self.pageXOffset;self.scrollTo(J,self.pageYOffset);return document.body.offsetWidth+I}else{return Math.max(((G.boxModel&&!G.browser.safari)&&document.documentElement.scrollWidth||document.body.scrollWidth),document.body.offsetWidth)}}return E.apply(this,arguments)},innerHeight:function(){if(!this[0]){D()}return this[0]==window||this[0]==document?this.height():this.is(":visible")?this[0].offsetHeight-C(this,"borderTopWidth")-C(this,"borderBottomWidth"):this.height()+C(this,"paddingTop")+C(this,"paddingBottom")},innerWidth:function(){if(!this[0]){D()}return this[0]==window||this[0]==document?this.width():this.is(":visible")?this[0].offsetWidth-C(this,"borderLeftWidth")-C(this,"borderRightWidth"):this.width()+C(this,"paddingLeft")+C(this,"paddingRight")},outerHeight:function(I){if(!this[0]){D()}I=G.extend({margin:false},I||{});return this[0]==window||this[0]==document?this.height():this.is(":visible")?this[0].offsetHeight+(I.margin?(C(this,"marginTop")+C(this,"marginBottom")):0):this.height()+C(this,"borderTopWidth")+C(this,"borderBottomWidth")+C(this,"paddingTop")+C(this,"paddingBottom")+(I.margin?(C(this,"marginTop")+C(this,"marginBottom")):0)},outerWidth:function(I){if(!this[0]){D()}I=G.extend({margin:false},I||{});return this[0]==window||this[0]==document?this.width():this.is(":visible")?this[0].offsetWidth+(I.margin?(C(this,"marginLeft")+C(this,"marginRight")):0):this.width()+C(this,"borderLeftWidth")+C(this,"borderRightWidth")+C(this,"paddingLeft")+C(this,"paddingRight")+(I.margin?(C(this,"marginLeft")+C(this,"marginRight")):0)},scrollLeft:function(I){if(!this[0]){D()}if(I!=undefined){return this.each(function(){if(this==window||this==document){window.scrollTo(I,G(window).scrollTop())}else{this.scrollLeft=I}})}if(this[0]==window||this[0]==document){return self.pageXOffset||G.boxModel&&document.documentElement.scrollLeft||document.body.scrollLeft}return this[0].scrollLeft},scrollTop:function(I){if(!this[0]){D()}if(I!=undefined){return this.each(function(){if(this==window||this==document){window.scrollTo(G(window).scrollLeft(),I)}else{this.scrollTop=I}})}if(this[0]==window||this[0]==document){return self.pageYOffset||G.boxModel&&document.documentElement.scrollTop||document.body.scrollTop}return this[0].scrollTop},position:function(I){return this.offset({margin:false,scroll:false,relativeTo:this.offsetParent()},I)},offset:function(J,P){if(!this[0]){D()}var O=0,N=0,X=0,S=0,Y=this[0],M=this[0],L,I,W=G.css(Y,"position"),V=G.browser.mozilla,Q=G.browser.msie,U=G.browser.opera,a=G.browser.safari,K=G.browser.safari&&parseInt(G.browser.version)>520,R=false,T=false,J=G.extend({margin:true,border:false,padding:false,scroll:true,lite:false,relativeTo:document.body},J||{});if(J.lite){return this.offsetLite(J,P)}if(J.relativeTo.jquery){J.relativeTo=J.relativeTo[0]}if(Y.tagName=="BODY"){O=Y.offsetLeft;N=Y.offsetTop;if(V){O+=C(Y,"marginLeft")+(C(Y,"borderLeftWidth")*2);N+=C(Y,"marginTop")+(C(Y,"borderTopWidth")*2)}else{if(U){O+=C(Y,"marginLeft");N+=C(Y,"marginTop")}else{if((Q&&jQuery.boxModel)){O+=C(Y,"borderLeftWidth");N+=C(Y,"borderTopWidth")}else{if(K){O+=C(Y,"marginLeft")+C(Y,"borderLeftWidth");N+=C(Y,"marginTop")+C(Y,"borderTopWidth")}}}}}else{do{I=G.css(M,"position");O+=M.offsetLeft;N+=M.offsetTop;if((V&&!M.tagName.match(/^t[d|h]$/i))||Q||K){O+=C(M,"borderLeftWidth");N+=C(M,"borderTopWidth");if(V&&I=="absolute"){R=true}if(Q&&I=="relative"){T=true}}L=M.offsetParent||document.body;if(J.scroll||V){do{if(J.scroll){X+=M.scrollLeft;S+=M.scrollTop}if(U&&(G.css(M,"display")||"").match(/table-row|inline/)){X=X-((M.scrollLeft==M.offsetLeft)?M.scrollLeft:0);S=S-((M.scrollTop==M.offsetTop)?M.scrollTop:0)}if(V&&M!=Y&&G.css(M,"overflow")!="visible"){O+=C(M,"borderLeftWidth");N+=C(M,"borderTopWidth")}M=M.parentNode}while(M!=L)}M=L;if(M==J.relativeTo&&!(M.tagName=="BODY"||M.tagName=="HTML")){if(V&&M!=Y&&G.css(M,"overflow")!="visible"){O+=C(M,"borderLeftWidth");N+=C(M,"borderTopWidth")}if(((a&&!K)||U)&&I!="static"){O-=C(L,"borderLeftWidth");N-=C(L,"borderTopWidth")}break}if(M.tagName=="BODY"||M.tagName=="HTML"){if(((a&&!K)||(Q&&G.boxModel))&&W!="absolute"&&W!="fixed"){O+=C(M,"marginLeft");N+=C(M,"marginTop")}if(K||(V&&!R&&W!="fixed")||(Q&&W=="static"&&!T)){O+=C(M,"borderLeftWidth");N+=C(M,"borderTopWidth")}break}}while(M)}var Z=H(Y,J,O,N,X,S);if(P){G.extend(P,Z);return this}else{return Z}},offsetLite:function(Q,L){if(!this[0]){D()}var N=0,M=0,K=0,P=0,O=this[0],J,Q=G.extend({margin:true,border:false,padding:false,scroll:true,relativeTo:document.body},Q||{});if(Q.relativeTo.jquery){Q.relativeTo=Q.relativeTo[0]}do{N+=O.offsetLeft;M+=O.offsetTop;J=O.offsetParent||document.body;if(Q.scroll){do{K+=O.scrollLeft;P+=O.scrollTop;O=O.parentNode}while(O!=J)}O=J}while(O&&O.tagName!="BODY"&&O.tagName!="HTML"&&O!=Q.relativeTo);var I=H(this[0],Q,N,M,K,P);if(L){G.extend(L,I);return this}else{return I}},offsetParent:function(){if(!this[0]){D()}var I=this[0].offsetParent;while(I&&(I.tagName!="BODY"&&G.css(I,"position")=="static")){I=I.offsetParent}return G(I)}});var D=function(){throw"Dimensions: jQuery collection is empty"};var C=function(I,J){return parseInt(G.css(I.jquery?I[0]:I,J))||0};var H=function(M,L,J,N,I,K){if(!L.margin){J-=C(M,"marginLeft");N-=C(M,"marginTop")}if(L.border&&((G.browser.safari&&parseInt(G.browser.version)<520)||G.browser.opera)){J+=C(M,"borderLeftWidth");N+=C(M,"borderTopWidth")}else{if(!L.border&&!((G.browser.safari&&parseInt(G.browser.version)<520)||G.browser.opera)){J-=C(M,"borderLeftWidth");N-=C(M,"borderTopWidth")}}if(L.padding){J+=C(M,"paddingLeft");N+=C(M,"paddingTop")}if(L.scroll&&(!G.browser.opera||M.offsetLeft!=M.scrollLeft&&M.offsetTop!=M.scrollLeft)){I-=M.scrollLeft;K-=M.scrollTop}return L.scroll?{top:N-K,left:J-I,scrollTop:K,scrollLeft:I}:{top:N,left:J}};var F=0;var B=function(){if(!F){var I=G("<div>").css({width:100,height:100,overflow:"auto",position:"absolute",top:-1000,left:-1000}).appendTo("body");F=100-I.append("<div>").find("div").css({width:"100%",height:200}).width();I.remove()}return F}})(jQuery)