var isScrolling = false;
var menuIsShowing = false;
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

console.log( modalAdTimerMilliseconds )
setUpDOMVariables();
setSmoothScroll();
animate();
window.addEventListener('scroll', onScroll);
window.addEventListener('resize', onResize);

setUpModals();

if(redirect !== null){
  setUpRedirect(5);
}
fixWorkLinkMobile()

function openModal(modal){
  console.log( "openmodal")
  modal.style.zIndex="5";
  modal.style.visibility = "visible";
  modal.style.opacity = 1;
  let modalId = modal.id;
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
  console.log(menuIsShowing)
  setTimeout(()=>{
    openModal(modalAd);
  }, modalAdTimerMilliseconds);

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
  console.log("canceltimer")
  clearTimeout(modalAdTimer);
  modalAdTimer = setTimeout(()=>{
    openModal(modalAd);
  }, modalAdTimerMilliseconds);
}
