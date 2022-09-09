function showInputField() {
  var getResponse = document.getElementById("dropdown_value").value;
  if (getResponse == "Yes") {
    document.getElementById("showInput").style.display = "block";
  } else if (getResponse == "No") {
    document.getElementById("showInput").style.display = "none";
  }
}

function showDropDown() {
  var getCheckBoxValue = document.getElementById("showClassDropDown").value;

  if (getCheckBoxValue == "1") {
    document.getElementById("selectClass").style.display = "block";
    document.getElementById("selectIndividualTeacher").style.display = "none";
  } else {
    document.getElementById("selectClass").style.display = "none";
  }

  if (getCheckBoxValue == "4") {
    document.getElementById("selectIndividualTeacher").style.display = "block";
    document.getElementById("selectClass").style.display = "none";
  } else {
    document.getElementById("selectIndividualTeacher").style.display = "none";
  }

  if (getCheckBoxValue == "2") {
    document.getElementById("selectClass").style.display = "none";
    document.getElementById("selectIndividualTeacher").style.display = "none";
  }
  if (getCheckBoxValue == "3") {
    document.getElementById("selectClass").style.display = "none";
    document.getElementById("selectIndividualTeacher").style.display = "none";
  }
}

function Toggle() {
  var temp = document.getElementById("typepass");
  if (temp.type === "password") {
    temp.type = "text";
  } else {
    temp.type = "password";
  }
}

function toggleDrop() {
  var select = document.getElementById("box").value;

  if (select == 1) {
    document.getElementById("boxOne").style.display = "none";
    document.getElementById("boxTwo").style.display = "block";
  } else if (select == 2) {
    document.getElementById("boxOne").style.display = "block";
    document.getElementById("boxTwo").style.display = "none";
  }
}

function readStatus() {
  var getStatus = document.getElementById("endDateCheckBox");

  if (getStatus.checked) {
    console.log("Checked");
    document.getElementById("endDateInput").style.display = "block";
  } else if (!getStatus.checked) {
    console.log("Not Checked");
    document.getElementById("endDateInput").style.display = "none";
  }
}
