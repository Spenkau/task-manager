const loader:HTMLDivElement = document.querySelector('.spinner-wrapper');


document.addEventListener('DOMContentLoaded',()=>{
    setTimeout(() => {
        loader.classList.remove('spinner-active')
    }, 2000);

})



const isAuth = Boolean((document.getElementById('isAuth') as HTMLInputElement).value);

if (isAuth) {
    const overlay: HTMLDivElement = document.querySelector('.header__overlay');
    const modal: HTMLDivElement = document.querySelector('.overlay__modal');
    const buttonOpenModal: HTMLButtonElement = document.querySelector('.container-button');
    const sidebar: HTMLDivElement = document.querySelector('.sidebar');
    const buttonNewCategory: HTMLButtonElement = document.querySelector('.list__new-category > button');
    const newCategoryModal: HTMLDivElement = document.querySelector('.modal-category__overlay');
    const newCategoryContainer: HTMLDivElement = document.querySelector('.modal-category_container')
    const formNewCategory = document.querySelector('.decor') as HTMLFormElement;

    //modal + overlay
    buttonOpenModal.addEventListener('click', () => {
        overlay.classList.replace("disabled", "active")
    })

    overlay.addEventListener('click', (e) => {
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

    sidebar.addEventListener("mouseleave", () => {
        sidebar.classList.replace('sidebar_active', 'sidebar_hide');
    });

    const categories: NodeListOf<HTMLLIElement> = document.querySelectorAll('.sidebar__list li');

    //active categories
    categories.forEach((category) => {
        category.addEventListener('click', () => {
            category.classList.toggle('active-category')
        })

    })

    //modal add category
    buttonNewCategory.addEventListener('click', () => {
        newCategoryModal.classList.replace('modal-category_disabled', 'modal-category_active');
        newCategoryContainer.classList.replace('modal-category_disabled', 'modal-category_active');
    })

    newCategoryModal.addEventListener('click', () => {
        newCategoryModal.classList.replace('modal-category_active','modal-category_disabled');
        newCategoryContainer.classList.replace('modal-category_active','modal-category_disabled');
    })

    formNewCategory.addEventListener('submit', () => {
        console.log(123)
        newCategoryModal.classList.replace('modal-category_active', 'modal-category_disabled');
        newCategoryContainer.classList.replace('modal-category_active', 'modal-category_disabled');
    })

}

const timeElement: HTMLSpanElement = document.querySelector('.time');
const dateElement: HTMLSpanElement = document.querySelector('.date');
const changeColorModeButton: HTMLButtonElement = document.querySelector('.button__change-color-mode');
const colorModeIcon: HTMLElement = document.querySelector('.button__change-color-mode > i')

changeColorModeButton.addEventListener('click', () => {
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
