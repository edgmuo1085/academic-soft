const menuBtn = document.querySelector("#as-menu-btn");
const menu = document.querySelector("#as-menu");

menuBtn.addEventListener("click", () => {
    menu.classList.toggle("show-menu");
});

const subMenuBtn = document.querySelectorAll(".as-submenu-btn");

for (let index = 0; index < subMenuBtn.length; index++) {
    subMenuBtn[index].addEventListener("click", () => {

        if (window.innerWidth < 992) {
            const subMenu = subMenuBtn[index].nextElementSibling;
            const height = subMenu.scrollHeight;

            if (subMenu.classList.contains("deploy")) {
                subMenu.classList.remove("deploy");
                subMenu.removeAttribute("style");
            } else {
                subMenu.classList.add("deploy");
                subMenu.style.height = height + "px";
            }
        }
    });

}