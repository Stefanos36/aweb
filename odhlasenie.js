// Nastavenie obsluhy udalostí pre kliknutie na link


//implementovat priamo na tlacidlo- zmenit na funkciu TODO
/*document.getElementById("loginout").addEventListener("click", function(event) {
    // Zastavenie predvolenej akcie pre link
    event.preventDefault(); //musi tam byt inak nefnguje presmerovanie?
  
  window.location.href = "logout.php";
    
});
*/
function odhlas(){
 // event.preventDefault(); //musi tam byt inak nefnguje presmerovanie?
  
  window.location.href = "logout.php";
}

function odhlasma(){
  console.log("zachyr");
  window.location.href = "logout.php";
}