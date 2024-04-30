const answers = document.getElementById('answers');
const answer = document.getElementById('answer');
const addAnswer = document.getElementById('add-answer');
const captchaTable = document.getElementById('captcha-table');
const deleteBtn = document.getElementsByClassName("delete-btn")[0];


let answerNum = 1;

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

// Partie pour l'affichage du tableau de captcha

function createCaptchaCard(captchaQuestion, captchaNumber){
  let card = document.createElement('div');
  let cardContent = card.cloneNode();
  let showAnswersBtn = document.createElement('a');

  let btnAttributes = {
    'data-bs-toggle' : 'collapse',
    'href'           : '#collapse' + captchaNumber,
    'role'           : 'button',
    'aria-expended'  : 'false',
    'aria-controls'  : '#collapse' + captchaNumber
  }

  card.classList.add('card');
  cardContent.classList.add('card-body', 'd-flex', 'justify-content-between', 'align-items-center');
  showAnswersBtn.classList.add('btn', 'btn-light');

  cardContent.innerHTML = captchaQuestion;
  
  for (const attr in btnAttributes){
    showAnswersBtn.setAttribute(attr, btnAttributes[attr]);
  }
  showAnswersBtn.innerText = 'Réponses';

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
  let form = document.createElement('form');
  let deleteCaptchaBtn = deleteBtn.cloneNode();

  div.id = 'collapse' + captchaNumber;
  div.classList.add('collapse');
  card.classList.add('card', 'card-body');
  table.classList.add('table', 'table-bordered');
  form.classList.add('needs-validation');
  deleteCaptchaBtn.classList.remove('border-light');

  tableHead.innerHTML = 'Réponses';
  form.action = "./edit_captcha.php";
  form.method = "post";
  deleteCaptchaBtn.setAttribute('onclick', '');
  deleteCaptchaBtn.setAttribute('value', answers[1]);
  deleteCaptchaBtn.setAttribute('name', 'deleteCaptchaId');
  deleteCaptchaBtn.type = "submit";
  deleteCaptchaBtn.innerHTML = "Supprimer";

  tableRowHead.appendChild(tableHead);
  tbody.appendChild(tableRowHead);

for (const answer of answers[0]){
  let answerRow = document.createElement('td');
  if (answer[1] == 1){
    let badge = document.createElement('span');
    badge.classList.add('badge', 'bg-success', 'align-items-center');
    badge.innerHTML = "Bonne réponse";

    answerRow.classList.add('d-flex', 'justify-content-between', 'table-success');
    answerRow.innerHTML = answer[0];
    answerRow.appendChild(badge);
  } else {
    answerRow.innerHTML = answer[0];
  }
  let row = document.createElement('tr');
  row.appendChild(answerRow);
  tbody.appendChild(row);
}

table.appendChild(tbody);
card.appendChild(table);

form.appendChild(deleteCaptchaBtn);

card.appendChild(form);

div.appendChild(card);

return div;

}

let captchaArray = {};

if (captchaData != undefined && captchaData != null) {
  let currentCaptcha = captchaData[0][1];
  let currentQuestion = captchaData[0][0];
  let currentAnswers = [];
  let property;

  for (property in captchaData) {
    if (captchaData[property][1] == currentCaptcha){
      currentAnswers.push(
        [
          captchaData[property][2],
          captchaData[property][3]
        ]
      )
    } else {
      captchaArray[currentQuestion] = [currentAnswers, captchaData[property][1]];
      currentCaptcha = captchaData[property][1];
      currentAnswers = [
        [
          captchaData[property][2],
          captchaData[property][3]
        ]
      ];
      currentQuestion = captchaData[property][0];
    }
  }
  captchaArray[currentQuestion] = [currentAnswers, captchaData[property][1]];
}

let i = 0;
for (const question in captchaArray){
  captchaTable.appendChild(createCaptchaCard(question, i));
  captchaTable.appendChild(createAnswersCard(captchaArray[question], i));
  i++;
}
