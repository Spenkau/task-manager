const loader: HTMLDivElement = document.querySelector('.spinner-wrapper');


document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        loader.classList.remove('spinner-active')
    }, 1700);

})


//const isAuth = Boolean((document.getElementById('isAuth') as HTMLInputElement).value);

const overlay: HTMLDivElement = document.querySelector('.header__overlay');
const modal: HTMLDivElement = document.querySelector('.overlay__modal');
const buttonOpenModal: HTMLButtonElement = document.querySelector('.container-button');
const sidebar: HTMLDivElement = document.querySelector('.sidebar');
const buttonNewCategory: HTMLButtonElement = document.querySelector('.list__new-category > button');
const newCategoryModal = document.getElementById('overlay-category');
const newTaskModal = document.getElementById('overlay-task')
const newCategoryContainer: HTMLDivElement = document.querySelector('.modal-category_container')
const newTaskContainer: HTMLDivElement = document.querySelector('.modal-task_container')
const formNewCategory = document.getElementById('category') as HTMLFormElement;
const formNewTask = document.getElementById('task') as HTMLFormElement;
const buttonNewTask = document.querySelector('.button__create-task');
buttonOpenModal.addEventListener('click', () => {
    overlay.classList.replace("disabled", "active")
})
overlay.addEventListener('click', (e) => {
    if (e.target !== modal) {
        overlay.classList.replace("active", "disabled")
    }

})
document.addEventListener('mousemove', (e) => {
    if (e.clientX <= 40) {
        sidebar.classList.replace('sidebar_hide', 'sidebar_active')
    }
})
sidebar.addEventListener("mouseleave", () => {
    sidebar.classList.replace('sidebar_active', 'sidebar_hide');
});
const categories: NodeListOf<HTMLLIElement> = document.querySelectorAll('.sidebar__list li');
categories.forEach((category) => {
    category.addEventListener('click', () => {
        category.classList.toggle('active-category')
    })

})
buttonNewCategory.addEventListener('click', () => {
    newCategoryModal.classList.replace('modal-category_disabled', 'modal-category_active');
    newCategoryContainer.classList.replace('modal-category_disabled', 'modal-category_active');
})
newCategoryModal.addEventListener('click', () => {
    newCategoryModal.classList.replace('modal-category_active', 'modal-category_disabled');
    newCategoryContainer.classList.replace('modal-category_active', 'modal-category_disabled');
})
formNewCategory.addEventListener('submit', () => {
    newCategoryModal.classList.replace('modal-category_active', 'modal-category_disabled');
    newCategoryContainer.classList.replace('modal-category_active', 'modal-category_disabled');
})
buttonNewTask.addEventListener('click', () => {
    newTaskModal.classList.replace('modal-category_disabled', 'modal-category_active');
    newTaskContainer.classList.replace('modal-category_disabled', 'modal-category_active');
})
newTaskModal.addEventListener('click', () => {
    newTaskModal.classList.replace('modal-category_active', 'modal-category_disabled');
    newTaskContainer.classList.replace('modal-category_active', 'modal-category_disabled');
})
formNewTask.addEventListener('submit', () => {
    newTaskModal.classList.replace('modal-category_active', 'modal-category_disabled');
    newTaskContainer.classList.replace('modal-category_active', 'modal-category_disabled');
})

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


const customSelect: HTMLDivElement = document.querySelector('.custom-select');
const selectedOption: HTMLSpanElement = document.querySelector('.selected-option');
const options: HTMLLIElement = document.querySelector('.options');
const hiddenInput = document.querySelector('#selected-value') as HTMLInputElement;

customSelect.addEventListener('click', () => {
    options.style.display = options.style.display === 'block' ? 'none' : 'block';
});

options.addEventListener('click', (event) => {
    if ((event.target as HTMLLIElement).tagName === 'LI') {
        selectedOption.innerText = (event.target as HTMLLIElement).innerText;
        hiddenInput.value = (event.target as HTMLLIElement).getAttribute('data-value');
        options.style.display = 'none';
    }
});

document.addEventListener('click', (event) => {
    if (!customSelect.contains(event.target as HTMLLIElement)) {
        options.style.display = 'none';
    }
});

const taskCard = document.querySelector('.task-card');
const taskDelete = document.querySelector('.task-delete');
const taskComplete = document.querySelector('.task-complete');



