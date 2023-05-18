<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location:index.php");
}
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refer Link</title>
</head>
<body>
    <?php
 $regno = "https://app.ickfamily.com/lead-gen.php?refer_id=".$_SESSION['hh'];
 echo '<a href=.$regno>Link</a>';
echo $regno;
    
?>
    <script>
        function copyText() {
  // Get the element that contains the text to be copied
  var textElement = document.getElementById('text-to-copy');

  // Create a range object and select the text within the element
  var range = document.createRange();
  range.selectNode(textElement);

  // Add the selected text to the clipboard
  window.getSelection().removeAllRanges(); // Clear previous selection
  window.getSelection().addRange(range);
  document.execCommand('copy');
  window.getSelection().removeAllRanges(); // Clear the selection again

  // Optionally, provide feedback to the user
  var copyButton = document.getElementById('copy-button');
  copyButton.textContent = 'Copied!';
  setTimeout(function() {
    copyButton.textContent = 'Copy';
  }, 2000); // Reset the button text after 2 seconds
}

    </script>
</body>
</html>