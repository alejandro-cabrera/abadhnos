const barraNav = document.querySelector("#barra-nav");
const navToggle = document.querySelector(".mobile-nav-toggle");

navToggle.addEventListener("click", () => {
  const visibilidad = barraNav.getAttribute("visible");
  
  if (visibilidad === "false"){
    barraNav.setAttribute("visible", true);
    
  } else if (visibilidad === "true"){
    barraNav.setAttribute("visible", false);
  }
});