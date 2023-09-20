let tabs = document.querySelectorAll(".tabs li");
let tabContent = document.querySelectorAll(".content");
let pageTitle = document.querySelectorAll(".page-title h1");

tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        tabContent.forEach(content => {
            content.classList.remove("active");
        });
        tabs.forEach(tab => {
            tab.classList.remove("active");
        })
        pageTitle.forEach(title => {
            title.classList.remove("active")
        })
        tabContent[index].classList.add("active");
        tabs[index].classList.add("active");
        pageTitle[index].classList.add("active")
    })
})