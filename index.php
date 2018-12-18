<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Asynchronous Form</title>
    <style>
      #result {
        display: none;
      }
      /* 10 . add style class erros go up....*/
	.error {
		border: 2px solid red;
	}
	#spinner {
		display: none;
	}
    </style>
  </head>
  <body>

    <div id="measurements">
      <p>Enter measurements below to determine the total volume.</p>
      <form id="measurement-form" action="process_measurements.php" method="POST">
        Length: <input type="text" name="length" value="" /><br />
        <br />
        Width: <input type="text" name="width" value="<?php ?>" /><br />
        <br />
        Height: <input type="text" name="height" value="<?php ?>"/><br />
        <br />
        <input id="html-submit" type="submit" value="Submit" />
        <input id="ajax-submit" type="button" value="Ajax Submit" />
      </form>
    </div>

    <div id="result">
      <p>The total volume is: <span id="volume"></span></p>
    </div>

    <div id = "spinner">
	    <img src = "Double Ring-1s-200px.gif" width = '50' height="50" alt = "">
    </div>

    <script>

      var result_div = document.getElementById("result");
      var volume = document.getElementById("volume");
      var button = document.getElementById("ajax-submit");
      var orig_button_value = button.value;


      function showSpinner(){
          var spinner = document.getElementById('spinner');
          spinner.style.display = 'block';
      }
      function hideSpinner(){
          var spinner = document.getElementById('spinner');
          spinner.style.display = 'none';
      }
      function disableSubmitButton(){
		button.disabled = true;
	    button.value = 'Loading...'
      }
      function enableSubmitButton(){
		button.disabled = false;
        button.value = orig_button_value;

      }


      // 9. displayErrors function
      function displayErrors(errors) {
          var inputs = document.getElementsByTagName('input');
          for(i=0; i < inputs.length; i++) {
              var input = inputs[i];
              if(errors.indexOf(input.name) >= 0) {
                  input.classList.add('error');
              }
          }
      }
      // 10 . add style class errors go up....
      function postResult(value) {
        volume.innerHTML = value;
        result_div.style.display = 'block';
      }

      function clearResult() {
        volume.innerHTML = '';
        result_div.style.display = 'none';
      }

      function clearErrors() {
          var inputs = document.getElementsByTagName('input');
          for(i=0; i < inputs.length; i++) {
              inputs[i].classList.remove('error');
          }
      }
      // 3 gatherFormData(form) omits textareas, select options, checkboxes,radio buttons
      function gatherFormData(form) {
	      var inputs = form.getElementsByTagName('input');
	      var array = [];
	      for (i=0;i<inputs.length;i++) {
	          var inputNameValue = inputs[i].name + '=' + inputs[i].value;
	          array.push(inputNameValue);
	      }
	        return array.join('&');
      }

      function calculateMeasurements() {
        clearResult();
        clearErrors();
        showSpinner();
        disableSubmitButton();
          var form = document.getElementById("measurement-form");
          var action = form.getAttribute("action");

          // gather form data
          var form_data = new FormData(form);
          for ([key, value] of form_data.entries()) {
              console.log(key + ': ' + value);
          }

          var xhr = new XMLHttpRequest();
          xhr.open('POST', action, true);
          // do not set content-type with FormData
          //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
          xhr.onreadystatechange = function () {
              if(xhr.readyState == 4 && xhr.status == 200) {
                  var result = xhr.responseText;
                  console.log('Result: ' + result);

                  hideSpinner();
                  enableSubmitButton();

                  var json = JSON.parse(result);
                  if(json.hasOwnProperty('errors') && json.errors.length > 0) {
                      displayErrors(json.errors);
                  } else {
                      postResult(json.volume);
                  }
              }
          };
          xhr.send(form_data);
      }

      button.addEventListener("click", calculateMeasurements);

    </script>

  </body>
</html>
