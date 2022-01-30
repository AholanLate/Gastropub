      
      //Kun koko ikkunan kaikki elementit ovat latautuneet
      window.onload = function() {
        //haetaan nappi id:n perusteella ja tallennetaan se muuttujaan
        const btn = document.getElementById("hamburgerbtn");

        //Jos lnappia painetaan, ajetaan seuraava koodi
        btn.onclick = function() {

        //etitään laajennettava div id:n perusteella ja tallennetaan se muuttujaan
        let vElement = document.getElementById("collapsediv");
        //Haetaan divin tyylit
        let vStyle = window.getComputedStyle(vElement);
        //Haetaan tyyleistä visibilityn arvo ja tallennetaan se muuttujaan
        let vVisibility = vStyle.getPropertyValue('visibility');

        //jos arvo on hidden vaihdetaan se visible, muuten asetetaan arvoksi hidden
        if (vVisibility === "hidden"){
          vElement.style.visibility = "visible";
        }
        else{
          vElement.style.visibility = "hidden";
        }

        //koska ei vaihdeta sivua
        return false;
    }
  }