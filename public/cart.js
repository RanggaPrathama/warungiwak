function incrementValue() {
    var value = parseInt(document.getElementById('inputNumber').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('inputNumber').value = value;
  }

  function decrementValue() {
    var value = parseInt(document.getElementById('inputNumber').value, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
      value--;
    }
    document.getElementById('inputNumber').value = value;
  }
