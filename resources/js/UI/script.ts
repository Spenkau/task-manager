const loader: HTMLDivElement = document.querySelector('.spinner-wrapper');
const sidebar: HTMLDivElement | null = document.querySelector('.sidebar');
const timeElement: HTMLSpanElement | null = document.querySelector('.time');
const dateElement: HTMLSpanElement | null = document.querySelector('.date');
const taskCards: NodeListOf<HTMLDivElement> | null = document.querySelectorAll('.task-card');

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        loader.classList.remove('spinner-active')
    }, 0);

})

//header script
if (document.querySelector('.header')) {
    const overlay: HTMLDivElement = document.querySelector('.header__overlay');
    const modal: HTMLDivElement = document.querySelector('.overlay__modal');
    const buttonOpenModal: HTMLButtonElement = document.querySelector('.container-button');
    const changeColorModeButton: HTMLButtonElement = document.querySelector('.button__change-color-mode');
    const formNewTask = document.getElementById('task') as HTMLFormElement;
    const buttonNewTask = document.querySelector('.button__create-task');
    const newTaskContainer: HTMLDivElement | null = document.querySelector('.modal-task_container');
    const observationButton = document.querySelector('.observation-button');
    const newTaskModal = document.getElementById('overlay-task')
    const bodyMainPage = document.querySelector('body')
    const colorModeIcon: HTMLElement = document.querySelector('.button__change-color-mode > i');
    const selectPriority: HTMLDivElement = document.querySelector('.custom-select');
    const selectedOptionPriority: HTMLSpanElement = document.querySelector('.selected-option');
    const optionsPriority: HTMLLIElement = document.querySelector('.options');
    const selectCategory = document.querySelector('.custom-select-category');
    const selectedOptionCategory = document.querySelector('.category-group .selected-option')
    const optionsCategory = document.querySelector('.options-category-list');
    const hiddenCategoryInput = document.querySelector('.input-category') as HTMLInputElement;
    const hiddenInputPriority = document.querySelector('#selected-value') as HTMLInputElement;

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

    const buttonOpenSettingsModal: HTMLButtonElement = document.querySelector('.open-settings-modal');

    buttonOpenSettingsModal.addEventListener('click', () => {
        const userSettingsModal: HTMLDivElement = document.querySelector('.user-settings-modal');
        const buttonUISettings: HTMLButtonElement = document.querySelector('.button-settings-1');
        const buttonProfileSettings: HTMLButtonElement = document.querySelector('.button-settings-2');
        const settingsUI = document.querySelector('.settings-ui');
        const settingsProfile = document.querySelector('.settings-profile');
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

    changeColorModeButton.addEventListener('click', () => {
        colorModeIcon.classList.toggle('icon-sun')
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

    observationButton.addEventListener('click', () => {
        newTaskModal.classList.replace('modal-category_disabled', 'modal-category_active');
        newTaskContainer.classList.replace('modal-category_disabled', 'modal-category_active');
    })

    selectedOptionPriority.addEventListener('click', e => {
        optionsPriority.classList.remove('options_hidden');
        selectPriority.classList.add('custom-select-active');

        optionsPriority.addEventListener('click', e => {
            hiddenInputPriority.value = (e.target as HTMLLIElement).getAttribute('data-value')
            optionsPriority.classList.add('options_hidden');
            selectPriority.classList.remove('custom-select-active')
            selectedOptionPriority.innerHTML = (e.target as HTMLLIElement).innerHTML
        })

    })

    selectedOptionCategory.addEventListener('click', e => {
        optionsCategory.classList.remove('options_hidden');
        selectCategory.classList.add('custom-select-active');

        optionsCategory.addEventListener('click', e => {
            hiddenCategoryInput.value = (e.target as HTMLLIElement).getAttribute('data-value')
            optionsCategory.classList.add('options_hidden');
            selectCategory.classList.remove('custom-select-active')
            selectedOptionCategory.innerHTML = (e.target as HTMLLIElement).innerHTML
        })

    })
}


//sidebar script
if (sidebar) {
    const buttonNewCategory: HTMLButtonElement = document.querySelector('.list__new-category > button');
    const newCategoryModal = document.getElementById('overlay-category');
    const newCategoryContainer: HTMLDivElement = document.querySelector('.modal-category_container')
    const formNewCategory = document.getElementById('category') as HTMLFormElement;
    const categories: NodeListOf<HTMLLIElement> = document.querySelectorAll('.sidebar__list li');

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


}


if (timeElement && dateElement) {
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

}


if (taskCards) {
    const taskDeleteList: NodeListOf<HTMLDivElement> = document.querySelectorAll('.task-delete');
    const taskCompleteList: NodeListOf<HTMLDivElement> = document.querySelectorAll('.task-complete');
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
}

const toggleShowChildTask: HTMLButtonElement | null = document.querySelector('.toggle-show-child');
//tasks child list
if (toggleShowChildTask) {
    const countClid = Number(toggleShowChildTask.querySelector('.count-child').textContent);
    const tasksContainer: HTMLDivElement = document.querySelector('.tasks-container');
    const childList: HTMLUListElement = tasksContainer.querySelector('.task-child-list');
    let regStr: string = `${countClid}`
    if (countClid === 1) {
        regStr += ' подзадача'
    } else if (
        //@ts-ignore
        [2, 3, 4].includes(countClid)
    ) {
        regStr += ' подзадачи'
    } else {
        regStr += ' подзадач'
    }
    toggleShowChildTask.textContent = regStr

    toggleShowChildTask.addEventListener('click', e => {
        tasksContainer.classList.toggle('full-task-card')
        childList.classList.toggle('disabled')
    })
}


















