if (document.querySelector(".nav-links")) {
    const links = document.querySelector(".nav-links")
    const toggler = document.getElementById("nav-mobile")
    function toggleLinks() {
        links.classList.toggle("hidden")
    }

    function getBrowserWidth() {
        const width = window.innerWidth;
        if (width > 768) {
            if (links.classList.contains('hidden')) {
                links.classList.remove('hidden')
            }
        }
        if (width < 768) {
            if (!links.classList.contains('hidden')) {
                links.classList.add('hidden')
            }
        }
    }

    window.onload = getBrowserWidth
    window.onresize = getBrowserWidth
    toggler.addEventListener("click", toggleLinks)
}