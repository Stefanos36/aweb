

function nastavmenubar(){
  var menubar= document.getElementById('menubar');
//    menubar.style.display="none";
//    window.getComputedStyle(menubar).display === "none"
    // console.log(window.getComputedStyle(menubar).display );

    if (window.getComputedStyle(menubar).display=== "none" || menubar.style.display=="none"){
      
        menubar.style.display="inline";
    }
    else if(menubar.style.display=="inline"){
        menubar.style.display="none";
    }

    //menubar.style.display="inline";
    console.log("ok");
}