var empHoursArray = [];
var hourlyWage = 15;
var maxWeeklyHours = 40;
var overtimeRate = 1.5;
var firstEntry = true;
var keepGoing = true;
var hours = 0.0;
var employeeNumber = 1;
var outputString = "";

function getHoursWorked(){
	while (keepGoing){
		hours=prompt("Please enter the hours worked in a week for employee " + employeeNumber + " (Enter a negative number to end)");
		
		if (hours < 0){
			if(firstEntry == true){
				window.alert("At least one person should be present");
			}
			else{
				keepGoing = false;
			}
		}
		else if (!(hours >= 0) || (hours == "")){
			window.alert("That is not a valid number of hours...try again");
		}
		else{
			empHoursArray.push(hours);
			firstEntry = false;
			employeeNumber++;
		}
	}
	generateOutputString();
	document.getElementById("employeeIncome").innerHTML = outputString;
}

function generateOutputString(){
	outputString = "<table border=1><th>Employee Number</th><th>Hours Worked</th><th>Salary</th>";
	var weekIncome = 0;
	var totalWeeklyIncome = 0;
	var weeklyHours = 0;
	var arrayLength = empHoursArray.length;
	for (var i = 0; i < arrayLength; i++) {
		if (empHoursArray[i] > maxWeeklyHours){
			var overtimeHours = empHoursArray[i] - maxWeeklyHours;
			overtimeHours *= overtimeRate;
			weeklyHoursAdjusted = 40 + overtimeHours;
		}
		else {
			weeklyHoursAdjusted = empHoursArray[i];
		}
		weekIncome = weeklyHoursAdjusted * hourlyWage;
		outputString += "<tr><td>"+ (i+1) + "</td>" +
		"<td>" + empHoursArray[i] + "</td>" + 
		"<td>" + weekIncome + "</td>";
		totalWeeklyIncome += weekIncome;
	}
	outputString += "</table>";
	outputString += "<br><br> <b>Total Weekly Income is: $" + totalWeeklyIncome + "</b>";
	
}