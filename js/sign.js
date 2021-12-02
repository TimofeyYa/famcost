'use strict'

window.addEventListener('DOMContentLoaded', ()=>{
    const sign__title = document.querySelector('.sign__title'),
          form__signIn = document.querySelector('.form__signIn'),
          form__signUp = document.querySelector('.form__signUp'),
          sign__btnUp = document.querySelector('.sign__btnUp'),
          sign__btnIn = document.querySelector('.sign__btnIn');

    sign__btnUp.addEventListener('click',()=>{
        form__signIn.style.display = 'none';
        sign__btnUp.style.display = 'none';
        form__signUp.style.display = 'flex';
        sign__btnIn.style.display = 'block';
        
    })
    sign__btnIn.addEventListener('click',()=>{
        sign__btnIn.style.display = 'none';
        sign__btnUp.style.display = 'block';
        form__signUp.style.display = 'none';
        form__signIn.style.display = 'flex';
    })


    // Отправка формы на сервер
    form__signIn.addEventListener('submit', (e) => {
        e.preventDefault();

     
        
        const request = new XMLHttpRequest();
        request.open('POST', 'vendor/signin.php');
     
        let formData = new FormData(form__signIn);
         
        
        request.send(formData);
        
     
        request.addEventListener('load', () => {
     
            if (request.status === 200) {
                window.location.href = 'profil.php?user=admin';
            } else {
                alert('Ошибка сервера, повторите попытку позже');
            }
        })

})


form__signUp.addEventListener('submit', (e) => {
    e.preventDefault();

 
    
    const request = new XMLHttpRequest();
    request.open('POST', 'vendor/signup.php');
 
    let formData = new FormData(form__signUp);
     
    request.send(formData);
    
 
    request.addEventListener('load', () => {
 
        if (request.status === 200) {
            window.location.href = 'signin.php';
        } else {
            alert('Ошибка сервера, повторите попытку позже');
        }
    })

})
})