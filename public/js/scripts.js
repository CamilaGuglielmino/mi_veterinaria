document.addEventListener('DOMContentLoaded', () => {
    const menu = document.getElementById('menu');
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    if (menu && sidebar) { // Verifica que los elementos existen
        menu.addEventListener('click', () => {
            sidebar.classList.toggle('menu-toggle');
            menu.classList.toggle('menu-toggle');
            main.classList.toggle('menu-toggle');
        });
    }
    const content_text = document.querySelectorAll(".content_text");
    const container = document.getElementById("container");

    container.addEventListener("click", (e) => {
        let number = e.target.dataset.number;
        let value = e.target.classList.contains("btn");

        if (value) {
            Speed(number);
            return;
        }
        e.stopPropagation();
    });

    const Speed = (number) => {
        for (let index of content_text) {
            index.classList.remove("block");
            index.dataset.seccion === number ? index.classList.add("block") : "";
        }
    };
});