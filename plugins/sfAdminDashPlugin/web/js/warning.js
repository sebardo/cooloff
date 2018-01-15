var br1 = "Internet Explorer 7+";
var br2 = "Firefox 3+";
var br3 = "Safari 3+";
var br4 = "Opera 9.5+";
var br5 = "Chrome 2.0+";
var url1 = "http://www.microsoft.com/windows/Internet-explorer/default.aspx";
var url2 = "http://www.mozilla.com/firefox/";
var url3 = "http://www.apple.com/safari/download/";
var url4 = "http://www.opera.com/download/";
var url5 = "http://www.google.com/chrome";
var imgPath;

function e(str) {
imgPath = str;
var _body = document.getElementsByTagName('body')[0];
var _d = document.createElement('div');
var _l = document.createElement('div');
var _h = document.createElement('h1');
var _p1 = document.createElement('p');
var _p2 = document.createElement('p');
var _ul = document.createElement('ul');
var _li1 = document.createElement('li');
var _li2 = document.createElement('li');
var _li3 = document.createElement('li');
var _li4 = document.createElement('li');
var _li5 = document.createElement('li');
var _ico1 = document.createElement('div');
var _ico2 = document.createElement('div');
var _ico3 = document.createElement('div');
var _ico4 = document.createElement('div');
var _ico5 = document.createElement('div');
var _lit1 = document.createElement('div');
var _lit2 = document.createElement('div');
var _lit3 = document.createElement('div');
var _lit4 = document.createElement('div');
var _lit5 = document.createElement('div');

_body.appendChild(_l);
_body.appendChild(_d);
_d.appendChild(_h);
_d.appendChild(_p1);
_d.appendChild(_p2);
_d.appendChild(_ul);
_ul.appendChild(_li1);
_ul.appendChild(_li2);
_ul.appendChild(_li3);
_ul.appendChild(_li4);
_ul.appendChild(_li5);
_li1.appendChild(_ico1);
_li2.appendChild(_ico2);
_li3.appendChild(_ico3);
_li4.appendChild(_ico4);
_li5.appendChild(_ico5);
_li1.appendChild(_lit1);
_li2.appendChild(_lit2);
_li3.appendChild(_lit3);
_li4.appendChild(_lit4);
_li5.appendChild(_lit5);

_d.setAttribute('id','_d');
_l.setAttribute('id','_l');
_h.setAttribute('id','_h');
_p1.setAttribute('id','_p1');
_p2.setAttribute('id','_p2');
_ul.setAttribute('id','_ul');
_li1.setAttribute('id','_li1');
_li2.setAttribute('id','_li2');
_li3.setAttribute('id','_li3');
_li4.setAttribute('id','_li4');
_li5.setAttribute('id','_li5');
_ico1.setAttribute('id','_ico1');
_ico2.setAttribute('id','_ico2');
_ico3.setAttribute('id','_ico3');
_ico4.setAttribute('id','_ico4');
_ico5.setAttribute('id','_ico5');
_lit1.setAttribute('id','_lit1');
_lit2.setAttribute('id','_lit2');
_lit3.setAttribute('id','_lit3');
_lit4.setAttribute('id','_lit4');
_lit5.setAttribute('id','_lit5');

var _width = document.documentElement.clientWidth;
var _height = document.documentElement.clientHeight;

var _dl = document.getElementById('_l');
_dl.style.width =  _width+"px";
_dl.style.height = _height+"px";
_dl.style.filter = "alpha(opacity=50)";

var _dd = document.getElementById('_d');
_ddw = 650;
_ddh = 260;
_dd.style.top = ((_height-_ddh)/2)+"px";
_dd.style.left = ((_width-_ddw)/2)+"px";

_h.appendChild(document.createTextNode(msg1));
_p1.appendChild(document.createTextNode(msg2));
_p2.appendChild(document.createTextNode(msg3));

var _li1d = document.getElementById('_li1');
var _li2d = document.getElementById('_li2');
var _li3d = document.getElementById('_li3');
var _li4d = document.getElementById('_li4');
var _li5d = document.getElementById('_li5');
_li1d.onclick = function() {window.location = url1 }; 
_li2d.onclick = function() {window.location = url2 }; 
_li3d.onclick = function() {window.location = url3 }; 
_li4d.onclick = function() {window.location = url4 }; 
_li5d.onclick = function() {window.location = url5 }; 

_lit1.appendChild(document.createTextNode(br1));
_lit2.appendChild(document.createTextNode(br2));
_lit3.appendChild(document.createTextNode(br3));
_lit4.appendChild(document.createTextNode(br4));
_lit5.appendChild(document.createTextNode(br5));
}