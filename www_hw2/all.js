const oneBtn = document.getElementById("calc-one");
const twoBtn = document.getElementById("calc-two");
const threeBtn = document.getElementById("calc-three");
const fourBtn = document.getElementById("calc-four");
const fiveBtn = document.getElementById("calc-five");
const sixBtn = document.getElementById("calc-six");
const sevenBtn = document.getElementById("calc-seven");
const eightBtn = document.getElementById("calc-eight");
const nineBtn = document.getElementById("calc-nine");
const zeroBtn = document.getElementById("calc-zero");

const decimalBtn = document.getElementById("calc-decimal"); 
const clearBtn = document.getElementById("calc-clear"); 
const backspaceBtn = document.getElementById("calc-backspace");
const display = document.getElementById("calc-display"); 
const displayValElement = document.getElementById("calc-display-val"); 

let calcNumBtns = document.getElementsByClassName("calc-btn-num"); 
let calcOperatorBtns = document.getElementsByClassName("calc-btn-operator"); 

let displayVal = "0"; 
let pendingVal = ""; 
let evalStringArray = []; 
 
document.querySelector('.rolling_dice').style.visibility = 'hidden';
display.innerHTML = "Ans= ";

let updateDisplayVal = (clickObj) =>{ 
    const audio = document.createElement("audio");
    audio.src = "./die/clear.mp3";
    audio.play();
    let btnText = clickObj.target.innerHTML; 
    if(displayVal === "0"){
        displayVal = '';
    }
    
    displayVal += btnText;
    displayValElement.innerHTML = displayVal;
}

let performOperation = (clickObj) => {
    let operator = clickObj.target.innerHTML;
    const audio = document.createElement("audio");
    audio.src = "./die/clear.mp3";
    audio.play();
    switch(operator){
        case '+':
            pendingVal = displayVal; 
            displayVal = '0'; 
            displayValElement.innerText = displayVal; 
            evalStringArray.push(pendingVal); 
            evalStringArray.push('+'); 
            break;
        case '-':
            pendingVal = displayVal;
            displayVal = '0';
            displayValElement.innerText = displayVal;
            evalStringArray.push(pendingVal);
            evalStringArray.push('-');
            break;  
        case 'x':
            pendingVal = displayVal;
            displayVal = '0';
            displayValElement.innerText = displayVal;
            evalStringArray.push(pendingVal);
            evalStringArray.push('*');
            break;
        case '÷':
            pendingVal = displayVal;
            displayVal = '0';
            displayValElement.innerText = displayVal;
            evalStringArray.push(pendingVal);
            evalStringArray.push('/');
            break;  
        case '=':
            evalStringArray.push(displayVal); 
            let evaluation = eval(evalStringArray.join(' ')); 
            displayVal = evaluation + '';
            display.innerText = evalStringArray.join("") + "= ";
            displayValElement.innerText = eval(evalStringArray.join(' ')); 
            evalStringArray = []; 
            break; 
        case '√':
            var x=displayVal;
            document.getElementById("calc-square-root").value=Math.sqrt(x);
            display.innerText = "sqrt(" + x + ")=\n";
            displayValElement.innerText = document.getElementById("calc-square-root").value;
            displayVal = Math.sqrt(x);
            break;
        case 'log':
            var x=displayVal;
            document.getElementById("calc-square-root").value=Math.log(x);
            display.innerText = "log(" + x + ")=\n";
            displayValElement.innerText = Math.log(x);
            displayVal = Math.log(x);
            break;
        case 'exp':
            var x=displayVal;
            document.getElementById("calc-square-root").value=Math.exp(x);
            display.innerText = "exp(" + x + ")=\n";
            displayValElement.innerText = Math.exp(x);
            displayVal = Math.exp(x);
            break;
        case 'sin':
            var x=displayVal;
            document.getElementById("calc-square-root").value=Math.sin(x);
            display.innerText = "sin(" + x + ")=\n";
            displayValElement.innerText = Math.sin(x);
            displayVal = Math.sin(x);
            break;
        case 'cos':
            var x=displayVal;
            document.getElementById("calc-square-root").value=Math.sin(x);
            display.innerText = "cos(" + x + ")=\n";
            displayValElement.innerText = Math.cos(x);
            displayVal = Math.cos(x);
            break;
        case 'tan':
            var x=displayVal;
            document.getElementById("calc-square-root").value=Math.sin(x);
            display.innerText = "tan(" + x + ")=\n";
            displayValElement.innerText = Math.tan(x);
            displayVal = Math.tan(x);
            break;
        default:
            break;
    }
}

for(let i=0; i < calcNumBtns.length; i++){ 
    calcNumBtns[i].addEventListener("click",updateDisplayVal,false) 
}

for(let i=0; i < calcOperatorBtns.length; i++){ 
    calcOperatorBtns[i].addEventListener("click",performOperation,false)
}

clearBtn.onclick = () => {
    const audio = document.createElement("audio");
    audio.src = "./die/clear.mp3";
    audio.play();
    displayVal = "0"; 
    pendingVal = undefined; 
    evalStringArray = []; 
    displayValElement.innerHTML = displayVal; 
}

backspaceBtn.onclick = () =>{
    let lengthOfDisplayVal = displayVal.length; 
    displayVal = displayVal.slice(0, lengthOfDisplayVal -1); 
    
    if(displayVal === ""){
        displayVal = "0";
    }
    displayValElement.innerHTML = displayVal;  
    const audio = document.createElement("audio");
    audio.src = "./die/button.mp3";
    audio.play();
}

decimalBtn.onclick = () => {
    if(!displayVal.includes('.')){ 
        displayVal +="."; 
    }
    displayValElement.innerText = displayVal;
}


document.querySelector('.roll').addEventListener('click',function(){
    document.querySelector('.dice').style.visibility = 'hidden';
    document.querySelector('.rolling_dice').style.visibility = 'visible';
    const audio = document.createElement("audio");
    audio.src = "./die/die.mp3";
    audio.play();
    setTimeout(function(){
        document.querySelector('.rolling_dice').style.visibility = 'hidden';
        var dice = Math.floor(Math.random() * 6) + 1;

        if(displayVal === "0"){
            displayVal = '';
        }
        displayVal += dice;
        displayValElement.innerHTML = displayVal;
        document.querySelector('.dice').style.visibility = 'visible';
        document.querySelector('.dice').src = "./die/die_pic/" + dice + ".png";
    }, 2000);

});
