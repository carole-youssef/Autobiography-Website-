<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=close_fullscreen" />
	<link rel="stylesheet" href="styles.css">
	
</head>

<body>
<?php

    $rows = isset($_GET['num1']) ? intval($_GET['num1']) : 0;
    $cols = isset($_GET['num2']) ? intval($_GET['num2']) : 0;
 
    if ($rows < 3 || $rows > 12 || $cols < 3 || $cols > 12) {
         echo "<p class='error'>Error: Please enter numbers between 3 and 12 for both rows and columns.</p>";
		 echo "<script>
				window.onload = function() {
				const form = window.parent.document.getElementById('form');
				if (form) {
					form.elements['num1'].value = '';  // Reset rows input
					form.elements['num2'].value = '';  // Reset columns input
				}
			};
			</script>";

		exit;
 
    } else {

        echo "<h3>Multiplication Table ($rows x $cols)</h3>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";

        for ($i = 1; $i <= $rows; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $cols; $j++) {
                $result = $i * $j;
                echo "<td>$result</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
?>
</body>
</html>
