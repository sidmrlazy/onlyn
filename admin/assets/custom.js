function hideInputField() {
  var addressCheckBox = document.getElementById("addressCheckBox");
  var inputField = document.getElementById("communicationAddress");

  if (addressCheckBox.checked) {
    inputField.style.display = "none";
  } else {
    inputField.style.display = "block";
  }
}

function getInput() {
  const inputField = document.getElementById("myInput");
  const outputDiv = document.getElementById("output");

  inputField.addEventListener("input", function () {
    outputDiv.textContent = "₹" + inputField.value;
  });
}

// Get references to the input fields and the output divs
const collectingAmountInput = document.getElementById("collectingAmount");
const discountInput = document.getElementById("discount");
const outputDiv = document.getElementById("output");
const differenceDiv = document.getElementById("difference");

// Add event listeners to the input fields
collectingAmountInput.addEventListener("input", calculateAmount);
discountInput.addEventListener("input", calculateAmount);

function calculateAmount() {
  // Get the values from the input fields
  const collectingAmount = parseFloat(collectingAmountInput.value) || 0;
  const discount = parseFloat(discountInput.value) || 0;

  // Perform the subtraction
  const calculatedAmount = collectingAmount - discount;

  // Calculate the difference
  const difference = collectingAmount - calculatedAmount;

  // Update the content of the output divs
  // outputDiv.textContent = "Grand Total: " + "₹" + calculatedAmount;
  // differenceDiv.textContent = "Discount: " + "₹" + difference;

  outputDiv.textContent = "₹" + calculatedAmount;
  differenceDiv.textContent = "₹" + difference;
}
