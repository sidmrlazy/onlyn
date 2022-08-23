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
