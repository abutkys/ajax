<?php
  // You can simulate a slow server with sleep
//   sleep(2);

  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  $length = isset($_POST['length']) ? (int) $_POST['length'] : '';
  $width = isset($_POST['width']) ? (int) $_POST['width'] : '';
  $height = isset($_POST['height']) ? (int) $_POST['height'] : '';
// 5. Create errors array with validation
  $errors = [];
  if ($length == ''){ $errors[] = 'length';}
  if ($width == ''){ $errors[] = 'width';}
  if ($height == ''){ $errors[] = 'height';}
  if (!empty($errors)){
		  if(is_ajax_request()){
// 6. JSON output but it won't work b/c of single quotes 'errors'
//  	echo "{'errors' ". json_encode($errors) . "}";
	      $result_array = array('errors' => $errors);
			  echo json_encode($result_array);
		  } else {
			  echo "<p>There were errors on: ". implode(', ', $errors) . "</p>";
			  echo "<p><a href='index.php'>back</a></p>";
		  }
			  exit;
	  }
  $volume = $length * $width * $height;
  if(is_ajax_request()) {
//  	7. Same as 6.
    echo json_encode(array('volume' => $volume));
  } else {
    echo "<p>Total volume is: ". $volume . "</p>";
    echo "<p><a href='index.php'>back</a></p>";
  }

?>
