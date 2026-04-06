const form = document.querySelector("form");
const nextBtn = form.querySelector(".nextBtn");
const backBtn = form.querySelector(".backBtn");
const allInput = form.querySelectorAll(".first input");

if(nextBtn) {
    nextBtn.addEventListener("click", ()=> {
        allInput.forEach(input => {
            if(input.value != ""){
                form.classList.add('secActive');
            } else {
                form.classList.remove('secActive');
            }
        })
    })
}

if(backBtn) {
    backBtn.addEventListener("click", () => form.classList.remove('secActive'));
}