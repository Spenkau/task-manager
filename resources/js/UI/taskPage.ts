const inputCommit = document.querySelector('.input-commit') as HTMLInputElement;
const inputSubmitCommit = document.querySelector('.input-submit-commit') as HTMLInputElement;

inputCommit.addEventListener('click', ()=>{
    inputSubmitCommit.classList.remove('disabled')
})
