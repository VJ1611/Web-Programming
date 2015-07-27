var mysteryNumber;
var guessCount;
var guessesMadeArray = [];
var guessRange;
var guessRangeFloor;
var guessRangeCeiling;
var guessPass = 0;

function init() {
	document.game.from.value = "";
	document.game.to.value = "";
	document.game.guessInput.value = "";
	document.game.instruction.value = "Please set range of numbers and press the Start button.";
	document.game.guesses.value = "";
	document.game.from.focus();
}

function startGame() {
	guessRangeFloor = parseInt(document.game.from.value,10);
	guessRangeCeiling = parseInt(document.game.to.value,10);
	guessRange = guessRangeCeiling - guessRangeFloor + 1; // range of numbers to guess from
	guessCount = guessesMadeArray.length; // initialize number of guesses made
	document.game.guesses.value = "You have made " + guessCount + " guesses";

	if (guessRange > 1) {
		// generate random number (mysteryNumber) in To-From range (worth 10 points)
		mysteryNumber = guessRangeFloor + Math.floor(Math.random() * guessRange);
		document.game.instruction.value="Please guess a number, enter it, and press Guess."; 
		document.game.guessInput.focus();
		guessPass = 1;
	} else {
		if(guessRange === 1) {
			mysteryNumber = guessRangeFloor;
			document.game.instruction.value = "This range is too easy.  Please choose a higher To number.";
			document.game.to.focus();
			guessPass = 0;
		} else {
			document.game.instruction.value = "The To number must be greater than the From number.";
			document.game.to.focus();
			guessPass = 0;
		}
	}
}   

function guess() {
	var guessedNumber = parseInt(document.game.guessInput.value,10);
	guessesMadeArray.push(guessedNumber);
	guessCount = guessesMadeArray.length;
	var guessMessage = "";
	for (var i = 0; i < guessCount; i++) {
		guessMessage += guessesMadeArray[i] + " ";
	}
	document.game.guesses.value="Number(s) guessed " + guessMessage;
	if(guessedNumber >= guessRangeFloor && guessedNumber <= guessRangeCeiling) {
		if(guessPass === 1) { // valid From-To guessing range
			if(guessedNumber < mysteryNumber) {
				document.game.instruction.value = "My number is greater than " + guessedNumber + ".";
			} else {
				if(guessedNumber > mysteryNumber) {
					document.game.instruction.value = "My number is less than " + guessedNumber + ".";
				} else {
					var attmpt = "";
					if(guessCount === 1){attmpt=" attempt ";} else {attmpt=" attempts ";}
					document.game.instruction.value = "";
					document.game.guesses.value = "";
					window.alert("Correct! It took you " + guessCount + attmpt + "to guess this number.");
					location.reload();
				}
			}
		}
	} else { // number guessed was not in the From-To range
		window.alert("The number you entered is not in the From-To range.  Please enter a valid number.");
	}
	document.game.guessInput.value = "";
	document.game.guessInput.focus();
}