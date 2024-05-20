const answers = document.getElementById('answers');
const answer = document.getElementById('answer');
const addAnswer = document.getElementById('add-answer');
const captchaTable = document.getElementById('captcha-table');
const deleteBtn = document.getElementsByClassName("delete-btn")[0];
const modifyBtn = deleteBtn.cloneNode();

let answerNum = 1;

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

  console.log(element.parentNode.parentNode.childNodes[0].querySelectorAll('tr[answer-id]'));

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

  questionInput.value = captchaQuestion;
  
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
  let form = document.createElement('form');
  let deleteCaptchaBtn = deleteBtn.cloneNode();
  let modifyCaptchaBtn = modifyBtn.cloneNode();

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
  modifyCaptchaBtn.setAttribute('onclick', 'modifyCaptcha(this)');
  deleteCaptchaBtn.textContent = "Supprimer";
  modifyCaptchaBtn.textContent = 'Modifier';

  tableRowHead.appendChild(tableHead);
  tbody.appendChild(tableRowHead);

for (const answer of answers[0]){
  let answerRow = document.createElement('td');
  let rowInput = document.createElement('input');
  let row = document.createElement('tr');

  row.setAttribute("answer-id", answer[2]);
  rowInput.classList.add('form-control');

  if (answer[1] == 1){
    let badge = document.createElement('span');
    badge.classList.add('badge', 'bg-success');
    badge.innerHTML = "Bonne réponse";

    answerRow.classList.add('d-flex', 'justify-content-between', 'table-success');
    rowInput.classList.add('bg-success-subtle', 'border', 'border-1', 'border-secondary-subtle', 'me-2')
    answerRow.appendChild(rowInput);
    answerRow.appendChild(badge);
  }  else {
    answerRow.appendChild(rowInput);
  }

  rowInput.value = answer[0];

  row.appendChild(answerRow);
  tbody.appendChild(row);
}

table.appendChild(tbody);
card.appendChild(table);

form.appendChild(deleteCaptchaBtn);
form.appendChild(modifyCaptchaBtn);

card.appendChild(form);

div.appendChild(card);

return div;

}

let captchaArray = {};

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
      captchaArray[currentQuestion] = [currentAnswers, captchaData[property]['id_captcha']];
      currentCaptcha = captchaData[property]['id_captcha'];
      currentAnswers = [
        [
          captchaData[property]['contenu'],
          captchaData[property]['bonne_reponse'],
          captchaData[property]['id_reponse']
        ]
      ];
      currentQuestion = captchaData[property]['question'];
    }
  }
  captchaArray[currentQuestion] = [currentAnswers, captchaData[property]['id_captcha']];
}

let i = 0;
for (const question in captchaArray){
  captchaTable.appendChild(createCaptchaCard(question, i));
  captchaTable.appendChild(createAnswersCard(captchaArray[question], i));
  i++;
}
