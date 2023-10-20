const loader: HTMLDivElement = document.querySelector('.spinner-wrapper');


document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        loader.classList.remove('spinner-active')
    }, 1700);

})

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
const observationButton = document.querySelector('.observation-button')
const bodyMainPage = document.querySelector('body')
const categories: NodeListOf<HTMLLIElement> = document.querySelectorAll('.sidebar__list li');
const timeElement: HTMLSpanElement = document.querySelector('.time');
const dateElement: HTMLSpanElement = document.querySelector('.date');
const changeColorModeButton: HTMLButtonElement = document.querySelector('.button__change-color-mode');
const colorModeIcon: HTMLElement = document.querySelector('.button__change-color-mode > i')
const selectPriority: HTMLDivElement = document.querySelector('.custom-select');
const selectedOptionPriority: HTMLSpanElement = document.querySelector('.selected-option');
const optionsPriority: HTMLLIElement = document.querySelector('.options');
const selectCategory = document.querySelector('.custom-select.category');
const optionsCategory = document.querySelector('.options-category-list');
const hiddenCategoryInput = document.querySelector('.input-category');
const hiddenInputPriority = document.querySelector('#selected-value') as HTMLInputElement;
const taskCards: NodeListOf<HTMLDivElement> = document.querySelectorAll('.task-card');
const taskDeleteList: NodeListOf<HTMLDivElement> = document.querySelectorAll('.task-delete');
const taskCompleteList: NodeListOf<HTMLDivElement> = document.querySelectorAll('.task-complete');
const buttonOpenSettingsModal: HTMLButtonElement = document.querySelector('.open-settings-modal');

// // Общий обработчик для селектов
// function handleSelect(select, options, hiddenInput) {
//     select.addEventListener('click', () => {
//         if (select.classList.contains('custom-select-active')) {
//             select.classList.remove('custom-select-active');
//             options.classList.add('options_hidden');
//         } else {
//             select.classList.add('custom-select-active');
//             options.classList.remove('options_hidden');
//         }
//     });
//
//     document.addEventListener('click', (e) => {
//         if (!select.contains(e.target)) {
//             select.classList.remove('custom-select-active');
//             options.classList.add('options_hidden');
//         }
//     });
//
//     options.addEventListener('click', (e) => {
//         if (e.target.tagName === 'LI') {
//             select.querySelector('.selected-option').innerHTML = e.target.innerHTML;
//             hiddenInput.value = e.target.getAttribute('data-value');
//             select.classList.remove('custom-select-active');
//             options.classList.add('options_hidden');
//         }
//     });
// }
//
// handleSelect(selectPriority, optionsPriority, hiddenInputPriority);
// handleSelect(selectCategory, optionsCategory, hiddenCategoryInput);


buttonOpenModal.addEventListener('click', () => {
    overlay.classList.replace("disabled", "active")
    bodyMainPage.style.overflowY = 'hidden'
})
overlay.addEventListener('click', (e) => {
    if (e.target !== modal) {
        overlay.classList.replace("active", "disabled")
        bodyMainPage.style.overflowY = 'visible'
    }

})

//user settings modal
buttonOpenSettingsModal.addEventListener('click', () => {
    const userSettingsModal: HTMLDivElement = document.querySelector('.user-settings-modal')
    const buttonUISettings: HTMLButtonElement = document.querySelector('.button-settings-1');
    const buttonProfileSettings: HTMLButtonElement = document.querySelector('.button-settings-2');
    const settingsUI = document.querySelector('.settings-ui')
    const settingsProfile = document.querySelector('.settings-profile')
    userSettingsModal.classList.remove('disabled-settings')

    buttonUISettings.addEventListener('click', () => {
        settingsUI.classList.remove('disabled-settings');
        settingsProfile.classList.add('disabled-settings');
    })

    buttonProfileSettings.addEventListener('click', () => {
        settingsProfile.classList.remove('disabled-settings');
        settingsUI.classList.add('disabled-settings');
    })

    userSettingsModal.addEventListener('click', (e) => {
        if (e.target === userSettingsModal) {
            userSettingsModal.classList.add('disabled-settings')
        }
    })
})


document.addEventListener('mousemove', (e) => {
    if (e.clientX <= 40) {
        sidebar.classList.replace('sidebar_hide', 'sidebar_active')
    }
})
sidebar.addEventListener("mouseleave", () => {
    sidebar.classList.replace('sidebar_active', 'sidebar_hide');
});

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


observationButton.addEventListener('click', () => {
    newTaskModal.classList.replace('modal-category_disabled', 'modal-category_active');
    newTaskContainer.classList.replace('modal-category_disabled', 'modal-category_active');
})

formNewTask.addEventListener('submit', () => {
    newTaskModal.classList.replace('modal-category_active', 'modal-category_disabled');
    newTaskContainer.classList.replace('modal-category_active', 'modal-category_disabled');
})


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



taskCards.forEach((taskCard, key) => {
    taskCard.addEventListener('mousemove', (e: MouseEvent) => {
        if (e.clientX < 170) {
            taskDeleteList[key].classList.add('activate')
        }
        if (e.clientX > 750) {
            taskCompleteList[key].classList.add('activate')
        }
    })
})

taskDeleteList.forEach(taskDelete => {
    taskDelete.addEventListener('mouseleave', () => {
        taskDelete.classList.remove('activate')
    })
})

taskCompleteList.forEach(taskComplete => {
    taskComplete.addEventListener('mouseleave', () => {
        taskComplete.classList.remove('activate')
    })
})


