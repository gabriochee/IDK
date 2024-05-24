const answers = document.getElementById('answers');
const answer = document.getElementById('answer');
const addAnswer = document.getElementById('add-answer');
const captchaTable = document.getElementById('captcha-table');
const deleteBtn = document.getElementsByClassName("delete-btn")[0];
const modifyBtn = deleteBtn.cloneNode();

let answerNum = 1;
let isSelectingGoodAnswer = false;
let i = 0;

modifyBtn.classList.remove("border", "border-2", "btn-danger", "delete-btn");
modifyBtn.onclick = 'modifyCaptcha(this)';
modifyBtn.type = 'button';
modifyBtn.classList.add("modify-btn", "btn-warning", "ms-2");

// Partie pour l'éditeur de captcha

function deleteAnswer(element) {
  answerNum--;
  let pNode = element.parentNode;

  pNode.parentNode.parentNode.childNodes.forEach((element) => {
    if (element.tagName != undefined) {
      let currentNum = parseInt(pNode.childNodes[1].childNodes[1].htmlFor.match(/\d+/)[0]);

      let childNum = element.childNodes[1].childNodes[1].childNodes[1].htmlFor.match(/\d+/)[0];
      let newChildNum = (parseInt(childNum) - 1).toString();

      if (parseInt(childNum) > currentNum) {
        element.childNodes[1].childNodes[1].childNodes[1].htmlFor = element.childNodes[1].childNodes[1].childNodes[1].htmlFor.replace(childNum, newChildNum);
        element.childNodes[1].childNodes[1].childNodes[1].innerHTML = element.childNodes[1].childNodes[1].childNodes[1].innerHTML.replace(childNum, newChildNum);
        element.childNodes[3].id = element.childNodes[3].id.replace(childNum, newChildNum);
        element.childNodes[3].name = element.childNodes[3].name.replace(childNum, newChildNum);
      }
    }
  });

  pNode.parentNode.remove();
}

addAnswer.onclick = function (){
    answerNum++;
    let newAnswer = answer.cloneNode(true);
    let childNodes = newAnswer.childNodes;

    childNodes[1].childNodes[1].childNodes[1].innerHTML = "Réponse ".concat((answerNum).toString());
    let answerNumStr = "answer".concat((answerNum).toString());

    childNodes[1].childNodes[1].childNodes[1].htmlFor = answerNumStr;
    childNodes[1].childNodes[1].childNodes[3].checked = false;
    childNodes[3].id = answerNumStr;
    childNodes[3].name = answerNumStr;
    childNodes[3].value = "";

    newAnswer.removeAttribute('id');

    answers.appendChild(newAnswer);
};

function modifyCaptcha(element){
  let question = {};
  let answers = {};

  isSelectingGoodAnswer = false;

  for (const row of element.parentNode.parentNode.childNodes[0].querySelectorAll('tr[answer-id]')){
    let goodAnswer = false;

    if (row.querySelector('span')){
      goodAnswer = true;
    } else if (row.querySelector('input.bigger-radio') != null){
      goodAnswer = row.querySelector('input.bigger-radio').checked;
    }

    answers[row.getAttribute('answer-id')] = [row.querySelector('input').value, goodAnswer];
  };

  question[element.value] = element.parentNode.parentNode.parentNode.previousSibling.querySelector('.form-control').value;

  fetch("http://localhost:3000/inc/php/edit_captcha.php", {
    method : "POST",
    header: {"Content-type": "application/json; charset=UTF-8"},
    body : JSON.stringify({question : question, answers : answers})
  }).then(data => data.text()).then(data => element.parentNode.parentNode.querySelector('table').innerHTML = data);

}

function changeGoodAnswer(element){

  if (isSelectingGoodAnswer){
    alert("Veuillez terminer la sélection en cours avant d'en commencer une nouvelle.");
  } else {
    isSelectingGoodAnswer = true;
    element.parentNode.querySelector("span").remove();
    element.parentNode.querySelector("input").classList.remove('bg-success-subtle');
    element.parentNode.classList.remove('table-success');

    for (const row of element.parentNode.parentNode.parentNode.querySelectorAll('td')) {
      let radio = document.createElement('input');
      radio.type = 'radio';
      radio.name = 'isGoodAnswer';
      radio.classList.add('form-check-label', 'bigger-radio', 'ms-2');

      if (row == element.parentNode) {
        radio.checked = true;
      }

      row.classList.add('d-flex')
      row.appendChild(radio);
    }

    element.remove();
  }
}

function deleteCaptcha(element){
  fetch("http://localhost:3000/inc/php/delete_captcha.php?" + new URLSearchParams({deleteCaptchaId : element.value}))
  .then(data => data.text()).then(data => console.log(data));

  element.parentNode.parentNode.parentNode.previousSibling.remove();
  element.parentNode.parentNode.parentNode.remove();

  i--;

}

function createCaptcha(element){
  let answers = [];
  let question;
  let goodAnswerSelected = false;

  for (const answer of element.parentNode.querySelectorAll('input[type="text"]')){
    if (answer.name == "question"){

      if (answer.value == ""){
        alert("Le champ de la question est vide.");
        return;
      }

      question = answer.value;
    } else {

      if (answer.value == ""){
        alert("Un ou plusieurs champs réponses sont vides.");
        return;
      }

      let goodAnswer = answer.parentNode.querySelector('input[type="radio"]').checked;

      if (goodAnswer){
        goodAnswerSelected = true;
      }

      answers.push(
        {
          answer      : answer.value, 
          good_answer : goodAnswer
        }
      );

    }
  }

  if (!goodAnswerSelected){
    alert("Vous devez sélectionnez obligatoirement une bonne réponse.");
    return;
  }

  i++;

  fetch("http://localhost:3000/inc/php/create_captcha.php", {
    method : "POST",
    header: {"Content-type": "application/json; charset=UTF-8"},
    body : JSON.stringify({question : question, answers : answers})
  }).then(data => data.text()).then(data => {
    data = data.replace(/collapse0/g, "collapse".concat(i.toString()));
    console.log(data);
    captchaTable.insertAdjacentHTML('beforeend', data);
  });

}

// Partie pour l'affichage du tableau de captcha

function createCaptchaCard(captchaQuestion, captchaNumber){
  let card = document.createElement('div');
  let cardContent = card.cloneNode();
  let questionInput = document.createElement('input');
  let showAnswersBtn = document.createElement('a');

  let btnAttributes = {
    'data-bs-toggle' : 'collapse',
    'href'           : '#collapse' + captchaNumber,
    'role'           : 'button',
    'aria-expended'  : 'false',
    'aria-controls'  : '#collapse' + captchaNumber
  }

  card.classList.add('card');
  cardContent.classList.add('card-body', 'd-flex', 'justify-content-between');
  questionInput.classList.add('form-control', 'me-2');
  showAnswersBtn.classList.add('btn', 'btn-light');

  questionInput.setAttribute('maxlength', 150);
  questionInput.value = (new DOMParser().parseFromString(captchaQuestion, "text/html")).documentElement.textContent;
  
  for (const attr in btnAttributes){
    showAnswersBtn.setAttribute(attr, btnAttributes[attr]);
  }
  showAnswersBtn.innerText = 'Réponses';

  cardContent.appendChild(questionInput);
  cardContent.appendChild(showAnswersBtn);
  card.appendChild(cardContent);

  return card;

}

function createAnswersCard(answers, captchaNumber){
  let div = document.createElement('div');
  let card = div.cloneNode();
  let table = document.createElement('table');
  let tbody = document.createElement('tbody');
  let tableRowHead = document.createElement('tr');
  let tableHead = document.createElement('th');
  let btnsContainer = document.createElement('div');
  let deleteCaptchaBtn = deleteBtn.cloneNode();
  let modifyCaptchaBtn = modifyBtn.cloneNode();

  div.id = 'collapse' + captchaNumber;
  div.classList.add('collapse');
  card.classList.add('card', 'card-body');
  table.classList.add('table', 'table-bordered');
  deleteCaptchaBtn.classList.remove('border-light');

  tableHead.innerHTML = 'Réponses';
  deleteCaptchaBtn.setAttribute('onclick', 'deleteCaptcha(this)');
  deleteCaptchaBtn.setAttribute('value', answers[1]);
  modifyCaptchaBtn.setAttribute('onclick', 'modifyCaptcha(this)');
  modifyCaptchaBtn.setAttribute('value', answers[1]);
  deleteCaptchaBtn.textContent = "Supprimer";
  modifyCaptchaBtn.textContent = 'Modifier';

  tableRowHead.appendChild(tableHead);
  tbody.appendChild(tableRowHead);

for (const answer of answers[0]){
  let answerRow = document.createElement('td');
  let rowInput = document.createElement('input');
  let row = document.createElement('tr');

  row.setAttribute("answer-id", answer[2]);
  rowInput.setAttribute('maxlength', 150);
  rowInput.classList.add('form-control');

  if (answer[1] == 1){
    let badge = document.createElement('span');
    let removeBadgeButton = document.createElement('button');
    let removeIcon = document.createElement('i');

    badge.classList.add('badge', 'bg-success', 'ms-2', 'me-2');
    badge.innerHTML = "Bonne réponse";

    removeBadgeButton.classList.add("btn", "btn-secondary");
    removeBadgeButton.type = 'button';
    removeBadgeButton.title = 'Changer de bonne réponse';
    removeBadgeButton.setAttribute('onclick', 'changeGoodAnswer(this)');

    removeIcon.classList.add('bi', 'bi-x-lg');

    answerRow.classList.add('d-flex', 'justify-content-between', 'table-success');
    rowInput.classList.add('bg-success-subtle', 'border', 'border-1', 'border-secondary-subtle')

    removeBadgeButton.appendChild(removeIcon);

    answerRow.appendChild(rowInput);
    answerRow.appendChild(badge);
    answerRow.appendChild(removeBadgeButton);
  }  else {
    answerRow.appendChild(rowInput);
  }

  rowInput.value = (new DOMParser().parseFromString(answer[0], "text/html")).documentElement.textContent;

  row.appendChild(answerRow);
  tbody.appendChild(row);
}

table.appendChild(tbody);
card.appendChild(table);

btnsContainer.appendChild(deleteCaptchaBtn);
btnsContainer.appendChild(modifyCaptchaBtn);

card.appendChild(btnsContainer);

div.appendChild(card);

return div;

}

let captchaArray = {};

console.log(captchaData)

if (Array.isArray(captchaData) && captchaData.length) {
  let currentCaptcha = captchaData[0]['id_captcha'];
  let currentQuestion = captchaData[0]['question'];
  let currentAnswers = [];
  let property;

  for (property in captchaData) {
    if (captchaData[property]['id_captcha'] == currentCaptcha){
      currentAnswers.push(
        [
          captchaData[property]['contenu'],
          captchaData[property]['bonne_reponse'],
          captchaData[property]['id_reponse']
        ]
      )
    } else {
      captchaArray[currentQuestion] = [currentAnswers, currentCaptcha];
      currentCaptcha = captchaData[property]['id_captcha'];
      currentQuestion = captchaData[property]['question'];
      currentAnswers = [
        [
          captchaData[property]['contenu'],
          captchaData[property]['bonne_reponse'],
          captchaData[property]['id_reponse']
        ]
      ];
    }
  }

  captchaArray[currentQuestion] = [currentAnswers, captchaData[property]['id_captcha']];
}

for (const question in captchaArray){
  captchaTable.appendChild(createCaptchaCard(question, i));
  captchaTable.appendChild(createAnswersCard(captchaArray[question], i));
  i++;
}
