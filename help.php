<?php
	/*  indexOf()
	The indexOf() method returns the first index at which a given element can be found in the array, or -1 if it is not present.
	 */

/*
    <script>

      var result_div = document.getElementById("result");
      var volume = document.getElementById("volume");

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

                  // hideSpinner();

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

      var button = document.getElementById("ajax-submit");
      button.addEventListener("click", calculateMeasurements);

    </script>


*/