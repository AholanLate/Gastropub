
//Function returns true if screen is less than 1000px wide otherwise it returns false
function isMobile(){
  return window.matchMedia("(max-width: 1000px)").matches;
}


//This is the function that actually updates all the css based on screen width(isMobile())
//and if the navbar is visible (isVisible)
function updateNavbarStatus(isVisible){

  //Gets collapsibleDiv element and its style and saves those in variables
  let collapsibleDiv = document.getElementById("collapsible-div");
  let collapsibleDivStyle = window.getComputedStyle(collapsibleDiv);
  
  //Gets div navbar-container and saves it in container
  let navbarContent = document.getElementById("navbar-container");

  //Let's get the hidden link and save it in variable
  let hiddenLink = document.getElementById("hidden-link");

  //let's do the actual css modifying.
  if (isVisible){
    if(isMobile()){
      //Mobile and visible
      collapsibleDiv.style.display = "block";
      collapsibleDiv.style.height = "260px";
      navbarContent.style.marginBottom = "-385px";
      navbarContent.style.height = "340px";
      hiddenLink.style.display = "block";
    }
    else
    {
      //Desktop and visible
      collapsibleDiv.style.display = "block";
      collapsibleDiv.style.height = "220px";
      navbarContent.style.marginBottom = "-325px";
      navbarContent.style.height = "280px";
      hiddenLink.style.display = "none";
    }
  }
  else{
      //Hidden
      collapsibleDiv.style.display = "none";
      navbarContent.style.marginBottom = "-105px";
      navbarContent.style.height = "60px";
  }
}


//After the whole window and all elements on page has loaded
window.onload = function() {
  //Let's get the hamburger button and save it to constant variable.
  const btn = document.getElementById("hamburger-button");

  let collapsibleDiv = document.getElementById("collapsible-div");
  let collapsibleDivStyle = window.getComputedStyle(collapsibleDiv);

  //variable for navbar visibility state
  let isNavbarVisible = false;

  //function to update navbar status if someone resizes the window.
  window.onresize = function(){
    updateNavbarStatus(isNavbarVisible);
  };
  
  //If someone presses the button we drive this code
  btn.onclick = function() {
    //if divs css display property is none, we will se navbar status to visible
    if (collapsibleDivStyle.getPropertyValue('display') === "none")
      isNavbarVisible = true;
    else
      isNavbarVisible = false;
      
    updateNavbarStatus(isNavbarVisible);

    //Because we dont change the page we'll return false.
    return false;
  };
}
