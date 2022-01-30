      
      window.onload = function() {
        //haetaan linkki id:n perusteella ja tallennetaan se muuttujaan
        const btn = document.getElementById("hamburgerbtn");

        //Jos linkkiä painetaan, ajetaan seuraava koodi
        btn.onclick = function() {

        //etitään laajennettava teksti id:n perusteella ja laitetaan se muuttujaan
        let vElement = document.getElementById("collapsediv");
        let vStyle = window.getComputedStyle(vElement);
        let vVisibility = vStyle.getPropertyValue('visibility');

        if (vVisibility === "hidden"){
          vElement.style.visibility = "visible";
          console.log("set style visible");
        }
        else{
          vElement.style.visibility = "hidden";
          console.log("set style hidden");
        }

        return false;
    }
  }