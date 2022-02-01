      
//Kun koko ikkunan kaikki elementit ovat latautuneet
window.onload = function() {
  //haetaan nappi id:n perusteella ja tallennetaan se muuttujaan
  const btn = document.getElementById("hamburger-button");

  //Jos lnappia painetaan, ajetaan seuraava koodi
  btn.onclick = function() {

    //etsitään id:n perusteella pienentyvä div ja haetaan sen tyylit. Tallennetaan nämä tiedot muuttujiin.
    let collapsibleDiv = document.getElementById("collapsible-div");
    let collapsibleDivStyle = window.getComputedStyle(collapsibleDiv);

    //haetaan div navbar-container ja tallennetaan se muuttujaan
    let navbarContent = document.getElementById("navbar-container");

    //Säädetään navbar-containerin ja collapsible divin tyylejä perustuen collapsible divin tyylin
    //display arvoon. Arvo on joko "none" tai "block"
    if (collapsibleDivStyle.getPropertyValue('display') === "none"){
      collapsibleDiv.style.display = "block";
      navbarContent.style.marginBottom = "-325px";
      navbarContent.style.height = "280px";
    }
    else{
      collapsibleDiv.style.display = "none";
      navbarContent.style.marginBottom = "-105px";
      navbarContent.style.height = "60px";
    }

      //koska ei vaihdeta sivua, palautetaan false
      return false;
  }
}
