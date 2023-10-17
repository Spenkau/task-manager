const btnEditName = document.querySelector('.user-name>button');
const inputUsername = document.querySelector('.name') as HTMLInputElement;
const btnEditNameIcon = document.querySelector('.user-name>button>i');
const btnEditAbout = document.querySelector('.user-about>button');
const btnEditAboutIcon = document.querySelector('.user-about i');
const avatar = document.getElementById('avatar');
const avatarImg = document.getElementById('avatar-img') as HTMLInputElement;
const avatarInput = document.getElementById('avatar-input');
const changeAvatarButton = document.getElementById('change-avatar');
const aboutLength = document.querySelector('.about-length>span');
const aboutLengthDiv = document.querySelector('.about-length');
const aboutInput = document.querySelector('.user-about textarea') as HTMLTextAreaElement;
aboutLength.textContent = ((aboutInput.value).length).toString();
let stateBtnEditName = true;
let stateBtnEditAbout = true;

btnEditName.addEventListener('click', () => {
    if (stateBtnEditName) {
        inputUsername.removeAttribute('disabled')
        btnEditNameIcon.classList.replace('icon-edit', 'icon-apply')
        stateBtnEditName = false;
    } else {
        inputUsername.setAttribute('disabled', 'disabled')
        btnEditNameIcon.classList.replace('icon-apply', 'icon-edit')
        stateBtnEditName = true;
    }
})

inputUsername.addEventListener('change', (e) => {
    inputUsername.value = (e.target as HTMLInputElement).value
    console.log((e.target as HTMLInputElement).value)
})


btnEditAbout.addEventListener('click', () => {
    if(stateBtnEditAbout){
        aboutInput.removeAttribute('disabled')
        aboutLengthDiv.classList.remove('len-hidden')
        btnEditAboutIcon.classList.replace('icon-edit', 'icon-apply')
        stateBtnEditAbout = false;
    } else {
        aboutInput.setAttribute('disabled', 'disabled')
        aboutLengthDiv.classList.add('len-hidden')
        btnEditAboutIcon.classList.replace('icon-apply', 'icon-edit')
        stateBtnEditAbout = true;
    }
})

avatarInput.addEventListener('change', function (e) {
    const file = (e.target as HTMLInputElement).files[0]
    if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            avatarImg.src = event.target.result as string;
        };
        reader.readAsDataURL(file);
    }
});

avatar.addEventListener('click', () => avatarInput.click());
changeAvatarButton.addEventListener('click', () => avatarInput.click());

aboutInput.addEventListener('input', (e) => {
    aboutLength.textContent = ((aboutInput.value).length).toString()
})
