if (document.querySelector(".nav-links")) {
    const links = document.querySelector(".nav-links")
    const toggler = document.getElementById("nav-mobile")
    function toggleLinks() {
        links.classList.toggle("hidden")
    }

    toggler.addEventListener("click", toggleLinks)
}