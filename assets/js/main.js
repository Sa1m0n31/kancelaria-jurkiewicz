const mobileMenu = document.querySelector(".mobileMenu");

const openMobileMenu = () => {
    mobileMenu.style.zIndex = "11000";
    mobileMenu.style.opacity = "1";
}

const closeMobileMenu = () => {
    mobileMenu.style.opacity = "0";
    setTimeout(() => {
        mobileMenu.style.zIndex = "-1";
    }, 500);
}

/* AOS */
AOS.init({
    delay: 100,
    duration: 600
});