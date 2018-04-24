function showMenu () {
   var navLinks = document.getElementById("links");

   if (navLinks.className === "nav") {
       navLinks.classList.add("responsive")
   } else {
       navLinks.classList.remove("responsive")
   }
}