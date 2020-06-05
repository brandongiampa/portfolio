if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
  onLoad();
} else {
  document.addEventListener("DOMContentLoaded", onLoad);
}

var isScrolling = false;
var menuIsShowing = false;
var hasShownModal;
var hasAcceptedCookies;
var modalAd;
var modalAdContent;
var modalAdTimer;
var modalAdTimerMilliseconds = 900000;
var redirect;
var modalNav;
var modalNavContent;
var hamburger;
var hamburgerTop;
var hamburgerBottom;
var xOuts;

function onLoad(){
  setUpDOMVariables();
  hasShownModal = getCookieBoolean("hasShownModal") ? true : false;
  hasAcceptedCookies = getCookieBoolean("hasAcceptedCookies") ? true : false;
  setSmoothScroll();
  if(hasAcceptedCookies){
    document.getElementById("cookie-notice").style.visibility = "hidden";
  }
  animate();
  window.addEventListener('scroll', onScroll);
  window.addEventListener('resize', onResize);

  if(!hasAcceptedCookies) {
    setUpCookieNotice();
  }
  setUpModals();
  if(hasShownModal){
    if(hasAcceptedCookies){
      setCookie("hasShownModal", "true", 30);
    }
  }
  if(redirect !== null){
    setUpRedirect(5);
  }
  fixWorkLinkMobile()
}
function openModal(modal){

  modal.style.zIndex="5";
  modal.style.visibility = "visible";
  modal.style.opacity = 1;
  let modalId = modal.id;console.log(modalId)
  let modalContent = document.querySelector("#" + modalId + " .modal-content");
  modalContent.style.bottom = "0";
  let modalXOut = document.querySelector("#" + modalId + " .modal-content .x-out");
  modalXOut.style.opacity=1;
}
function closeModal(e){
  xOut = e.target.parentElement;
  let modal = xOut.parentElement.parentElement;
  modal.style.opacity = 0;
  let modalId = modal.id;
  let modalContent = document.querySelector("#" + modalId + " .modal-content");
  modalContent.style.bottom = "100%";
  let modalXOut = document.querySelector("#" + modalId + " .x-out");
  modalXOut.style.opacity=0;
  setTimeout(()=>{
    modal.style.zIndex="-1";
    modal.style.visibility = "hidden";
  }, 1200);
  if (xOut.id === "x-out-nav"){
    animateHamburger();
  }
}
function setUpModals(){
  if(!hasShownModal){
    setTimeout(()=>{
      openModal(modalAd);
    }, modalAdTimerMilliseconds);
  }
  hamburger.addEventListener('click', ()=>{
    openModal(modalNav)
  });
  hamburger.addEventListener('click', animateHamburger);
  xOuts = document.getElementsByClassName('x-out-modal');

  for(let i = 0; i < xOuts.length; i++){
    xOuts[i].addEventListener('click', closeModal);
  }
}
function setUpDOMVariables(){
  hamburger = document.getElementById("hamburger");
  hamburgerTop = document.getElementById("hamburger-top");
  hamburgerBottom = document.getElementById("hamburger-bottom");
  modalNavContent = document.getElementById("modal-nav-content");
  modalNav = document.getElementById("modal-nav");
  modalAd = document.getElementById("modal-ad");
  modalAdContent = document.getElementById("modal-ad-content");
  xOuts = document.getElementsByClassName("x-out");
  redirect = document.getElementById("redirect");
}
function fixWorkLinkMobile(){
  let works = document.getElementsByClassName("work");

  for(let i = 0; i < works.length; i++){
    works[i].addEventListener("touch", ()=>{
      works[i].firstChild.nextSibling.style.visibility = "hidden";
    });
  }
}
function setUpRedirect(sec){
  if(sec < 0){
    window.location = "https://brandongiampa.com";
  }
  else {
    setTimeout(()=>{
      redirect.innerText = sec;
      setUpRedirect(sec-1);
    }, 1000);
  }
}
function setSmoothScroll(){
  links = document.querySelectorAll("a");

  for(let i = 0; i < links.length; i++){
    if(links[i].hash !== ""){
      links[i].addEventListener("click", (e)=>{
        e.preventDefault();
        let windowOffset = window.scrollY;
        let destinationElementId =  links[i].hash.substring(1, links[i].hash.length);
        let destinationElement = document.getElementById(destinationElementId);
        smoothScrollTo(destinationElement.offsetTop);
      });
    }
  }
}
function smoothScrollTo(destinationOffsetTop){
  let windowOffset = window.scrollY;
  let travelTimeMs = 10;
  setTimeout(()=>{
    if(destinationOffsetTop - windowOffset < 0){
      window.scrollTo(0, destinationOffsetTop);
    }
    else {
      window.scrollTo(0, windowOffset + 6);
      smoothScrollTo(destinationOffsetTop);
    }
  });
}
function setUpCookieNotice(){
  let acceptCookies = document.getElementById("accept-cookies");
  let rejectCookies = document.getElementById("reject-cookies");
  let xOutCookies = document.getElementById("x-out-cookies");

  acceptCookies.addEventListener("click", closeCookiesNotice);
  acceptCookies.addEventListener("click", ()=>{
    setCookie("hasAcceptedCookies", "true", 90);
    hasAcceptedCookies = true;
    if(hasShownModal){
      setCookie("hasShownModal", "true", 30);
    }
  });
  xOutCookies.addEventListener("click", closeCookiesNotice);
  rejectCookies.addEventListener("click", closeCookiesNotice);
}
function setCookie(cookieName, cookieValue, expireAfterDays){
  let d = new Date()
  d.setTime(d.getTime() + (expireAfterDays * 24 * 60 * 60 *1000));
  let expires = d.toUTCString();
  let output = cookieName + "=" + cookieValue + "; " + "expires=" + expires + "; path=/; sameSite=Strict";
  document.cookie = output;
}
function getCookie(cookieName){
  let name = cookieName + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let cookieStringArray = decodedCookie.split('; ');
  let len = cookieName.length;

  for(let i = 0; i < cookieStringArray.length; i++){
    if(cookieStringArray[i].indexOf(name) == 0){
      return cookieStringArray[i].substring(name.length, cookieStringArray[i].length);
    }
  }
}
function getCookieBoolean(cookieName){
  if(getCookie(cookieName)==="true"){
    return true;
  }
  else if(getCookie(cookieName)==="false"){
    return false;
  }
  else {
    return undefined;
  }
}
function closeCookiesNotice(){
  document.getElementById("cookie-notice").style.transform = "translateY(100%)";
}
function animateHamburger(){
  if(!menuIsShowing){
    hamburgerTop.style.transform = "rotate(-45deg)";
    hamburgerBottom.style.transform = "rotate(45deg)";
    hamburgerTop.style.top = "5px";
    hamburgerBottom.style.top = "-5px";
    hamburgerTop.style.opacity = "0";
    hamburgerBottom.style.opacity = "0";
  }
  else {
    hamburgerTop.style.transform = "rotate(0)";
    hamburgerBottom.style.transform = "rotate(0)";
    hamburgerTop.style.top = "0";
    hamburgerBottom.style.top = "0";
    hamburgerTop.style.opacity = "1";
    hamburgerBottom.style.opacity = "1";
  }
  menuIsShowing = !menuIsShowing;
}

function onResize(){
  animate();
  cancelTimer();
}
function animate(){
  let elementsWithAnimation = document.getElementsByClassName("animated");

  for(let i = 0; i < elementsWithAnimation.length; i++){
    let scrollTop = window.pageYOffset;
    let scrollBottom = scrollTop + window.innerHeight;
    let windowHeight = window.innerHeight;
    let element = elementsWithAnimation[i];
    let elementTop = element.getBoundingClientRect().top + scrollTop;
    let elementBottom = elementTop + element.offsetHeight;
    let elementMiddle = elementBottom - elementTop;
    let elementHeight = element.offsetHeight;
    let elementOneQuarterLine = elementTop + (elementHeight * .25);
    let elementThreeQuarterLine = elementBottom - (elementHeight * .25);

    if((elementOneQuarterLine <= scrollBottom && elementOneQuarterLine > scrollTop) || (elementThreeQuarterLine >= scrollTop && elementThreeQuarterLine < scrollBottom)){

      if(!element.classList.contains("animate")){
        element.style.visibility = "visible";
        element.classList += " animate";
      }
    }

    if(!element.classList.contains("animate")){
      element.style.visibility = "hidden";
    }
  }
}
function onScroll(){
  isScrolling = true;
  setInterval(
    function(){
      if(isScrolling){
        scrolling = false;
        animate();
      }
    },
    250
  );
  cancelTimer();
}
function cancelTimer(){
  clearTimeout(modalAdTimer);
  modalAdTimer = setTimeout(()=>{
    openModal(modalAd);
  }, modalAdTimerMilliseconds);
}
