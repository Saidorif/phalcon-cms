
Event=(function(){var guid=0;function fixEvent(event){event=event||window.event;if(event.isFixed){return event;}
event.isFixed=true;event.preventDefault=event.preventDefault||function(){this.returnValue=false;};event.stopPropagation=event.stopPropagaton||function(){this.cancelBubble=true;};if(!event.target){event.target=event.srcElement;}
if(!event.relatedTarget&&event.fromElement){event.relatedTarget=event.fromElement===event.target?event.toElement:event.fromElement;}
if(event.pageX===null&&event.clientX!==null){var html=document.documentElement,body=document.body;event.pageX=event.clientX+(html&&html.scrollLeft||body&&body.scrollLeft||0)-(html.clientLeft||0);event.pageY=event.clientY+(html&&html.scrollTop||body&&body.scrollTop||0)-(html.clientTop||0);}
if(!event.which&&event.button){event.which=(event.button&1?1:(event.button&2?3:(event.button&4?2:0)));}
return event;}
function commonHandle(event){event=fixEvent(event);var handlers=this.events[event.type];for(var g in handlers){var handler=handlers[g];var ret=handler.call(this,event);if(ret===false){event.preventDefault();event.stopPropagation();}}}
return{add:function(elem,type,handler){if(elem.setInterval&&(elem!==window&&!elem.frameElement)){elem=window;}
if(!handler.guid){handler.guid=++guid;}
if(!elem.events){elem.events={};elem.handle=function(event){if(typeof Event!=="undefined"){return commonHandle.call(elem,event);}};}
if(!elem.events[type]){elem.events[type]={}
if(elem.addEventListener)
elem.addEventListener(type,elem.handle,false);else if(elem.attachEvent)
elem.attachEvent("on"+type,elem.handle);}
elem.events[type][handler.guid]=handler;},remove:function(elem,type,handler){var handlers=elem.events&&elem.events[type]
if(!handlers)
return;delete handlers[handler.guid];for(var any in handlers)
return;if(elem.removeEventListener)
elem.removeEventListener(type,elem.handle,false);else if(elem.detachEvent)
elem.detachEvent("on"+type,elem.handle);delete elem.events[type];for(var any in elem.events)
return;try{delete elem.handle;delete elem.events;}catch(e){elem.removeAttribute("handle");elem.removeAttribute("events");}}};}());function bindReady(handler){var called=false
function ready(){if(called)
return
called=true
handler()}
if(document.addEventListener){document.addEventListener("DOMContentLoaded",ready,false)}else if(document.attachEvent){try{var isFrame=window.frameElement!=null}catch(e){}
if(document.documentElement.doScroll&&!isFrame){function tryScroll(){if(called)
return
try{document.documentElement.doScroll("left")
ready()}catch(e){setTimeout(tryScroll,10)}}
tryScroll()}
document.attachEvent("onreadystatechange",function(){if(document.readyState==="complete"){ready()}})}
if(window.addEventListener)
window.addEventListener('load',ready,false)
else if(window.attachEvent)
window.attachEvent('onload',ready)
else{var fn=window.onload
window.onload=function(){fn&&fn()
ready()}}}
var readyList=[];function onReady(handler){function executeHandlers(){for(var i=0;i<readyList.length;i++){readyList[i]();}}
if(!readyList.length){bindReady(executeHandlers);}
readyList.push(handler);}
if(!String.prototype.trim){String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,'');};}
$.fn.serializeObject=function()
{var o={};var a=this.serializeArray();$.each(a,function(){if(o[this.name]!==undefined){if(!o[this.name].push){o[this.name]=[o[this.name]];}
o[this.name].push(this.value||'');}else{o[this.name]=this.value||'';}});return o;};function isLocalStorageAvailable(){try{return'localStorage'in window&&window['localStorage']!==null;}catch(e){return false;}};
function Rotation(){var self=this;self.elements=[];self.timerPosition=1;self.init=function(){var elements=document.querySelectorAll('[data-rotation]');for(var i=0;i<elements.length;i++){var elem=elements[i];elem.classList.add('rotation');var config=self.parseConfig(elem.getAttribute('data-rotation'));if(config.target){var targetElements=elem.querySelectorAll(config.target);self.initTargetElements(targetElements);elem.setAttribute('data-count',targetElements.length);elem.setAttribute('data-current','1');if(config.interval){elem.setAttribute('data-trigger','0');}}
var navElement;if(config.nav){navElement=elem.querySelector(config.nav);}else{navElement=elem;}
var prevElement=navElement.querySelector('.prev');if(prevElement){prevElement.addEventListener("click",self.clickPrev,false);}
var nextElement=navElement.querySelector('.next');if(nextElement){nextElement.addEventListener("click",self.clickNext,false);}
if(config.pickerItems){var pickerItems=elem.querySelectorAll(config.pickerItems);for(p=0;p<pickerItems.length;p++){var pickerItemNode=pickerItems[p];if(pickerItemNode){pickerItemNode.addEventListener("click",self.pick,false);}}}
if(config.interval){elem.setAttribute('data-interval',config.interval);}
self.elements.push(elem);self.setVisibleByActive(elem);}
self.initIntervals();};self.initTargetElements=function(targetElements){for(var i=0;i<targetElements.length;i++){var elem=targetElements[i];if(i!=0){elem.style.display='none';elem.style.opacity=0;}}}
self.initIntervals=function(){window.setInterval(function(){for(var i=0;i<self.elements.length;i++){var elem=self.elements[i];var trigger=elem.getAttribute('data-trigger')||0;var interval=elem.getAttribute('data-interval')||0;if(trigger==0){if(interval>0){if(self.timerPosition>=interval&&self.timerPosition%interval==0){self.next(elem);}}}}
self.timerPosition++;},1000);};self.getRoot=function(element){var parent=element.parentNode;if(parent){if(nodeHasClass(parent,'rotation')){return parent;}else{return self.getRoot(parent);}}
return false;};self.parseConfig=function(configString){var config={};$.each(configString.split(';'),function(index,value){var keyVal=value.split(':');if(keyVal[0]&&keyVal[1]){config[keyVal[0].trim()]=keyVal[1].trim();}});return config;};self.clickPrev=function(e){var rootNode=self.getRoot(e.target);self.triggerUp(rootNode);self.prev(rootNode);};self.clickNext=function(e){var rootNode=self.getRoot(e.target);self.triggerUp(rootNode);self.next(rootNode);};self.pick=function(e){var rootNode=self.getRoot(e.target);self.triggerUp(rootNode);var newPosition=e.target.getAttribute('data-pos');self.setPosition(newPosition,rootNode);};self.prev=function(rootNode){var current=self.getCurrent(rootNode);var newPosition=(current===1)?self.getCount(rootNode):current-1;self.setPosition(newPosition,rootNode);};self.next=function(rootNode){var current=self.getCurrent(rootNode);var newPosition=(current===self.getCount(rootNode))?1:current+1;self.setPosition(newPosition,rootNode);};self.triggerUp=function(rootNode){if(rootNode){rootNode.setAttribute('data-trigger','1');}};self.getCurrent=function(rootNode){return parseInt(rootNode.getAttribute('data-current'));};self.getCurrentElement=function(rootNode){var config=self.getConfig(rootNode);var currentElement=rootNode.querySelector(config.nav+' '+config.current);return currentElement;};self.getTargetElements=function(rootNode){var config=self.getConfig(rootNode);var targetElements=rootNode.querySelectorAll(config.target);return targetElements;};self.getTargetRelElements=function(rootNode){var config=self.getConfig(rootNode);var targetRelElements=rootNode.querySelectorAll(config.targetRel);return targetRelElements;};self.getPickerElements=function(rootNode){var config=self.getConfig(rootNode);var pickerElements=rootNode.querySelectorAll(config.pickerItems);return pickerElements;};self.setTargetActive=function(newPosition,rootNode,targetElements,slide){var i,animationSpeed=null;var config=self.getConfig(rootNode);if(config.animationSpeed){animationSpeed=config.animationSpeed;}
for(i=0;i<=targetElements.length;i++){var itemNode=targetElements[i];if((newPosition-1)===i){if(itemNode){itemNode.classList.add('active');if(slide===true){if(animationSpeed!=null){$(itemNode).css('display','block').animate({opacity:1},animationSpeed);}else{itemNode.style.display='block';itemNode.style.opacity=1;}}}}else{if(itemNode){itemNode.classList.remove('active');if(slide===true){if(animationSpeed!=null){$(itemNode).css('display','none').animate({opacity:0},animationSpeed);}else{itemNode.style.display='none';itemNode.style.opacity=0;}}}}}};self.getCount=function(rootNode){return parseInt(rootNode.getAttribute('data-count'));};self.getConfig=function(rootNode){return self.parseConfig(rootNode.getAttribute('data-rotation'));};self.setPosition=function(newPosition,rootNode){rootNode.setAttribute('data-current',newPosition);var currentElement=self.getCurrentElement(rootNode);if(currentElement){currentElement.innerHTML=newPosition;}
self.setTargetActive(newPosition,rootNode,self.getTargetElements(rootNode),true);self.setTargetActive(newPosition,rootNode,self.getTargetRelElements(rootNode),false);self.setTargetActive(newPosition,rootNode,self.getPickerElements(rootNode),false);};self.setVisibleByActive=function(element){var activeItem=element.querySelector('.wrapper > .cluster > .item.active');if(activeItem){var activeParent=activeItem.parentNode;var index=0;while(activeParent=activeParent.previousSibling){if(activeParent.nodeType===1){++index}}
self.setPosition(index,element);}}
return{init:self.init};}
function nodeHasClass(el,clss){return el.className&&new RegExp("(^|\\s)"+clss+"(\\s|$)").test(el.className);};
onReady(function(){var rotation=new Rotation();rotation.init();});;