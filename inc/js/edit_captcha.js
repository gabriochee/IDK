const answers = document.getElementById('answers');
const answer = document.getElementById('answer');
const addAnswer = document.getElementById('add-answer');

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

console.log(captchaData)

let captchaArray = {};

if (captchaData != undefined && captchaData != null) {
  let currentCaptcha = captchaData[0][1];
  let currentQuestion = captchaData[0][0];
  let currentAnswers = [];
  for (const property in captchaData) {
    if (captchaData[property][1] == currentCaptcha){
      currentAnswers.push(captchaData[property][2])
    } else {
      captchaArray[currentQuestion] = currentAnswers;
      currentCaptcha = captchaData[property][1];
      currentAnswers = [captchaData[property][2]];
      currentQuestion = captchaData[property][0];
    }
  }
  captchaArray[currentQuestion] = currentAnswers;
}

console.log(captchaArray);
