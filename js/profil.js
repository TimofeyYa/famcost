'use strict'

window.addEventListener("DOMContentLoaded", ()=>{
    const formPopup = document.querySelector('#formPopup');
    // const diagram = document.querySelector('#diagram');

    formPopup.addEventListener('click', (e)=>{
        if (e.target.classList[0] == 'popup'){
            formPopup.style.display = 'none';
        }
    })

    // diagram.addEventListener('click', (e)=>{

    //     if (e.target.classList[0] == 'popup'){
    //         diagram.style.display = 'none';
    //     }
    //  })
    // const diagBtn = document.querySelector('#diagBtn');
    // diagBtn.addEventListener('click', ()=>{
    //     diagram.style.display = 'flex';
    // })

    const profil__topAccauntsAdd = document.querySelector('.profil__topAccauntsAdd');

    profil__topAccauntsAdd.addEventListener('click',()=>{
        formPopup.style.display = 'flex';
    })

    const addUserForm = document.querySelector('.popup__contentForm form'),
          nameInp = document.querySelector('.nameInp'),
          profil__topBlocks = document.querySelector('.profil__topBlocks');

    addUserForm.addEventListener('submit', (e)=>{
        e.preventDefault();

        const request = new XMLHttpRequest();
        request.open('POST', 'vendor/addNewUser.php');

        let formData = new FormData(addUserForm);

        request.send(formData);

        request.addEventListener('load', () => {
 
            if (request.status === 200) {
                let profil__topBlocksItem = profil__topBlocks.querySelectorAll('.profil__topBlock');

                let block = document.createElement('div');
                block.classList.add('profil__topBlock');
                block.dataset.num = profil__topBlocksItem.length + 1;
                block.innerHTML = `
                <div  onclick="window.location.href = '?user=${nameInp.value}'" class="profil__topBlockName">
                                <h3>${nameInp.value}</h3>
                            </div>
                            <div class="profil__topBlockBudget">
                                <p>Бюджет:<span id="budgetAcc">0</span></p>
                            </div>
                            <div class="profil__topBlockDelite">
                                <p>x</p>
                            </div>
                </div>
                `;
                block.querySelector('.profil__topBlockDelite p').addEventListener('click', ()=>{
                    deliteFunc(block.querySelector('.profil__topBlockDelite p'));
                })
                profil__topBlocks.append(block);
                formPopup.style.display = 'none';

                e.target.reset();
            } else {
                alert('Ошибка сервера, повторите попытку позже');
            }
        })


        
    })

    const profil__topBlockDelite = document.querySelectorAll('.profil__topBlockDelite p');

        profil__topBlockDelite.forEach(item=>{
            item.addEventListener('click', ()=>{
                deliteFunc(item);
            })
        })

        function deliteFunc(item){
            if (confirm("Вы уверены что хотите удалить пользователя?")){
            let data = `data=${item.parentElement.parentElement.dataset.num}`;

            const request = new XMLHttpRequest();
            request.open('POST', 'vendor/deliteUser.php');
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


            
            request.send(data);

            request.addEventListener('load', () => {

            if (request.status === 200) {
                item.parentElement.parentElement.remove();
            } else {
                alert('Ошибка сервера, повторите попытку позже');
            }
    })
        }
    }



    // отправка расоходов и доходов

    const profil__stonksForm = document.querySelector('.profil__stonksAdd form');

    const dohodList = document.querySelector('#dohodList'),
          rashodList = document.querySelector('#rashodList');

    let dohodListItems =  dohodList.querySelectorAll('.profil__stonksBlock');
    let rashodListItems =  rashodList.querySelectorAll('.profil__stonksBlock');
    let userName =  document.querySelector('#userNum');


    const commentInp = document.querySelector('#commentInp'),
          sumInp = document.querySelector('#sumInp'),
          selectorInp = document.querySelector('#selectorInp');

    function serchMaxNam(user, arr){
        let maxNum = 0;
        arr.forEach(item =>{
            if (item.dataset.user == user){
                maxNum = item.dataset.num;
            }
        })
        return  parseInt(maxNum) + 1;
    }

    profil__stonksForm.addEventListener('submit', (e)=>{
        e.preventDefault();

        const request = new XMLHttpRequest();
        request.open('POST', 'vendor/balanceAdd.php');

        let formData = new FormData(profil__stonksForm);

        request.send(formData);

        request.addEventListener('load', () => {
 
            if (request.status === 200) {
                let block = document.createElement('div');
                block.classList.add('profil__stonksBlock');
                if (selectorInp.value == 1)
                block.dataset.num = serchMaxNam(userName.value,dohodListItems);

                if (selectorInp.value == 2)
                block.dataset.num = serchMaxNam(userName.value,rashodListItems);
                block.innerHTML = `
                <div class="profil__stonksBlockCost">
                    <h4>${sumInp.value}</h4>
                </div>
                <div class="profil__stonksBlockComment">
                    <h4>${commentInp.value}</h4>
                </div>
                <div class="profil__stonksBlockDelite">
                    <p>x</p>
                </div>`;

                block.addEventListener('click', ()=>{
                    deliteStonk(block);
                });

                if (selectorInp.value == 1)
                dohodList.append(block);
                if (selectorInp.value == 2)
                rashodList.append(block);
                dohodListItems =  dohodList.querySelectorAll('.profil__stonksBlock');
                e.target.reset();
                selectSum(); // обновление счётчика расходов и доходов
            } else {;
                alert('Ошибка сервера, повторите попытку позже');
            }
        })


    })


    // Расходы удаление

    const profil__stonksBlockDelite = document.querySelectorAll('.profil__stonksBlockDelite p');

    profil__stonksBlockDelite.forEach(item=>{
        item.addEventListener('click', ()=>{
            deliteStonk(item);
        })
    })

    function deliteStonk(item){
        let nam = item.parentElement.parentElement.dataset.num;
            let user = item.parentElement.parentElement.dataset.user;
            let type = item.parentElement.parentElement.dataset.type;

            let data = `num=${nam}&user=${user}&type=${type}`;

            const request = new XMLHttpRequest();
            request.open('POST', 'vendor/deliteStonk.php');
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


            
            request.send(data);

            request.addEventListener('load', () => {

            if (request.status === 200) {
                item.parentElement.parentElement.remove();
                selectSum();
            } else {
                alert('Ошибка сервера, повторите попытку позже');
            }
    })
    }


    const addBtn = document.querySelector('.profil__stonksAdd button'),
          rashod = document.querySelector('#rashod'),
          dohod = document.querySelector('#dohod');

    selectSum();

    function selectSum(){
        const 
        rashodList = document.querySelectorAll('#rashodList .profil__stonksBlock'),
        dohodList = document.querySelectorAll('#dohodList .profil__stonksBlock');

        let sum = 0;
        rashodList.forEach(item =>{
            sum += parseInt(item.querySelector('.profil__stonksBlockCost h4').innerHTML);
        })
        rashod.innerHTML = sum;

        sum = 0;
        dohodList.forEach(item =>{
            sum += parseInt(item.querySelector('.profil__stonksBlockCost h4').innerHTML);
        })
        dohod.innerHTML = sum;
        setNewBudget(dohod.innerHTML,rashod.innerHTML);
    }

    function setNewBudget(dohod,rashod){
        let budget = parseInt(dohod) - parseInt(rashod);
        let user = document.querySelector('#userNum').value;

        let data = `budget=${budget}&user=${user}`;

        const request = new XMLHttpRequest();
        request.open('POST', 'vendor/budget.php');
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


        
        request.send(data);

        request.addEventListener('load', () => {

        if (request.status === 200) {
          
            let profil__topBlock = document.querySelectorAll('.profil__topBlock');
            profil__topBlock.forEach(item =>{
                let name = item.querySelector('#profilsName').textContent;
                console.log(name);
                if (name == user){
                    item.querySelector('#budgetAcc').innerHTML =budget;
                }
            })

        } else {
            alert('Ошибка сервера, повторите попытку позже');
        }
})
    }
})