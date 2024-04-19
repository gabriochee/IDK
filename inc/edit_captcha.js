const answers = document.getElementById('answers');
const answer = document.getElementById('answer');
const addAnswer = document.getElementById('add-answer');

let answerNum = 1;

function deleteAnswer(element){
    answerNum--;
    let currentNum = parseInt(element.parentNode.childNodes[1].htmlFor.match(/\d+/)[0]);
    
    Array.from(element.parentNode.parentNode.childNodes).forEach(child => {
        if (child.tagName != undefined){
            let childNum = child.childNodes[1].htmlFor.match(/\d+/)[0];
            let newChildNum = (parseInt(childNum) - 1).toString();

            if (parseInt(childNum) > currentNum){
                child.childNodes[1].htmlFor =  child.childNodes[1].htmlFor.replace(childNum, newChildNum);
                child.childNodes[1].innerHTML = child.childNodes[1].innerHTML.replace(childNum, newChildNum);
                child.childNodes[5].id = child.childNodes[1].id.replace(childNum, newChildNum);
                child.childNodes[5].name = child.childNodes[5].name.replace(childNum, newChildNum);
            }
        }
    });

    element.parentNode.remove();
}

addAnswer.onclick = function (){
    answerNum++;
    let newAnswer = answer.cloneNode(true);
    let childNodes = newAnswer.childNodes;

    childNodes[1].innerHTML = "Réponse ".concat((answerNum).toString());
    let answerNumStr = "answer".concat((answerNum).toString());

    childNodes[1].htmlFor = answerNumStr;
    childNodes[5].id = answerNumStr;
    childNodes[5].name = answerNumStr;
    childNodes[5].value = "";

    newAnswer.removeAttribute('id');

    answers.appendChild(newAnswer);
};
