document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.getElementById("main-nav");
    const toggleButton = document.querySelector(".navbar-toggle");

    window.addEventListener("scroll", function() {
        if (window.scrollY > 50) { // You can adjust the scroll value as needed
            navbar.classList.add("collapsed");
        } else {
            navbar.classList.remove("collapsed");
        }
    });
});
