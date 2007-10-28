/*

inc v1

A super-tiny client-side include JavaScript jQuery plugin

<http://johannburkard.de/blog/programming/javascript/inc-a-super-tiny-client-side-include-javascript-jquery-plugin.html>

MIT license.

Johann Burkard
<http://johannburkard.de>
<mailto:jb@eaio.com>

*/

jQuery.fn.inc = function(url, fn) {
 if (typeof XMLHttpRequest == 'undefined' && (!window.external || !document.namespaces)) {
  return;
 }

 var t = this;

 var transfer = function(txt) {
  if (fn != null) {
   txt = fn(txt);
  }
  t.empty();
  $(txt).appendTo(t);
 }

 if (typeof XMLHttpRequest != 'undefined') {
  var req = new XMLHttpRequest();
  req.onreadystatechange = function() {
   if (req.readyState == 4) {
    transfer(req.responseText);
   }
  }
  req.open("GET", url);
  req.send(null);
 }
 else {

  do {
   var f = "inc" + (Math.round(Math.random() * 999));
  }
  while ($('#' + f).length != 0);

  var iframe = document.createElement('iframe');
  iframe.id = f;
  iframe.src = url;
  iframe.onreadystatechange = function() {
   if (iframe.readyState == 'complete') {
    transfer(document.frames(f).document.body.innerText);
   }
  }
  document.insertBefore(iframe);
 }
};

$(function() {
 $("*[@class~=inc]").each(function() {
  $(this).inc(unescape(this.className.replace(/.*inc:([^ ]+)( .*|$)/, "$1")));
 });
});
