const isAuth = Boolean((document.getElementById('isAuth') as HTMLInputElement).value);

if (isAuth) {
    const overlay: HTMLDivElement = document.querySelector('.header__overlay');
    const modal: HTMLDivElement = document.querySelector('.overlay__modal');
    const buttonOpenModal: HTMLButtonElement = document.querySelector('.container-button');
    const sidebar: HTMLDivElement = document.querySelector('.sidebar');
    const buttonNewCategory: HTMLButtonElement = document.querySelector('.list__new-category > button')

    //modal + overlay
    buttonOpenModal.addEventListener('click', (e) => {
        e.preventDefault()
        overlay.classList.replace("disabled", "active")
    })

    overlay.addEventListener('click', (e) => {
        e.preventDefault()
        if (e.target !== modal) {
            overlay.classList.replace("active", "disabled")
        }

    })

    //sidebar
    document.addEventListener('mousemove', (e) => {
        if (e.clientX <= 40) {
            sidebar.classList.replace('sidebar_hide', 'sidebar_active')
        }
    })

    sidebar.addEventListener("mouseleave", (e) => {
        sidebar.classList.replace('sidebar_active', 'sidebar_hide');
    });

    const categories: NodeListOf<HTMLLIElement> = document.querySelectorAll('.sidebar__list li');

    //active categories
    categories.forEach((category) => {
        category.addEventListener('click', (e) => {
            e.preventDefault()
            category.classList.toggle('active-category')
        })

    })

    //modal add category
    buttonNewCategory.addEventListener('click', (e) => {
        e.preventDefault()

    })

}

const timeElement: HTMLSpanElement = document.querySelector('.time');
const dateElement: HTMLSpanElement = document.querySelector('.date');
const changeColorModeButton: HTMLButtonElement = document.querySelector('.button__change-color-mode');
const colorModeIcon: HTMLElement = document.querySelector('.button__change-color-mode > i')

changeColorModeButton.addEventListener('click', (e) => {
    e.preventDefault();
    colorModeIcon.classList.toggle('icon-sun')
})


//time-date-section
const updateDateAndTime = () => {
    const nowDate: Date = new Date();
    const timeOptions = {hour: '2-digit', minute: '2-digit', second: '2-digit'};
    const time = nowDate.toLocaleTimeString(undefined, timeOptions);

    const dateOptions = {year: 'numeric', month: 'long', day: 'numeric'};
    const date = nowDate.toLocaleDateString(undefined, dateOptions);

    timeElement.textContent = `${time}`;
    dateElement.textContent = `${date}`;
}

updateDateAndTime()
setInterval(updateDateAndTime, 1000);


