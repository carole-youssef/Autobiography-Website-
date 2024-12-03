<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=close_fullscreen" />
		<link rel="stylesheet" href="styles.css">
		
		<title>Lab08: PHP</title>
</head>

<body style="background-color: #D9E6FF; padding: 0; margin: 0; font-family: Roboto;">
	<header style="text-align: center;">
		<h1>Lab 8: PHP Problems</h1>
		
		<nav style="background-color: #93AFE5; font-size: 1.3rem; text-align: center; padding: 2px; margin: 0;">
			<ul style="font-weight:350; list-style-type: none;">
				<li style= "display: inline; margin-right: 40px;"><a href=#p1 style="color:white;">Problem 1</a></li>
				<li style= "display: inline; margin-right: 40px;"><a href=#p2 style="color:white;">Problem 2</a></li>
				<li style= "display: inline; margin-right: 40px;"><a href=#p3 style="color:white;">Problem 3</a></li>
			</ul>
		</nav>
	</header>
	
	<main>
		<!--Problem 1-->
		<section id="p1" style="display: flex; align-items: center; justify-content: center; flex-direction:column; text-align:center; margin: 0; padding: 0;">	
			<?php
			$hour = date("H");
			$greeting = "";
			$backgroundImage = "";

			if ($hour >= 6 && $hour < 12) {
			    $greeting = "Good morning";
			    $backgroundImage = "morning.jpg"; 
			} elseif ($hour >= 12 && $hour < 18) {
			    $greeting = "Good afternoon";
			    $backgroundImage = "noon.jpg";
			} elseif ($hour >= 18 && $hour < 21) {
			    $greeting = "Good evening";
			    $backgroundImage = "evening.jpg"; 
			} else {
			    $greeting = "Good night";
			    $backgroundImage = "night.jpg";
			}
			?>

			 <div style="width: 100%; height: 100vh; background: url('images/<?php echo $backgroundImage; ?>') no-repeat center center/cover; display: flex; 
			 align-items: flex-start; justify-content: center; color: white; font-size: 2rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); 
			 padding-top: 50px;">
				<?php echo "Problem 1 <br><br>$greeting" ?>
			</div>
		</section>
		
		
		
		<!--Problem 2-->
		<section id="p2" style="display: flex; align-items: center; justify-content: center; flex-direction:column;">
		<h2 style="font-size: 2rem;">Problem 2</h2>

		<form id="form" method="get" action="lab08b.php" target="output">
				<label for="num1">Enter rows (3 to 12):</label>
				<input type="number" id="num1" name="num1" required>

				<label for="num2">Enter columns (3 to 12):</label>
				<input type="number" id="num2" name="num2" required>

				<button type="submit">Generate Table</button>
		 </form>
		 <iframe name="output" style="width: 100%; height: 700px; border: none;"></iframe>
		</section>
		
		
		
		<!--Problem 3-->
		<section id="p3" style="display: flex; align-items: center; justify-content: center; flex-direction:column;">
			<h2 style="font-size: 2rem;">Problem 3</h2>
		<?php
		   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['image'])) {
			   setcookie("selectedImage", $_POST['image'], time() + 86400, "/"); 
			   header("Location: " . $_SERVER['PHP_SELF']); 
		   exit;
			}
			
			$selectedImage = isset($_COOKIE['selectedImage']) ? $_COOKIE['selectedImage'] : '';
		?>	
		
		<?php if (!$selectedImage): ?>
			<p>Welcome! Please select your favorite image below.</p>
        
        <?php else: ?>
			<div class="message">
				<h2>Current image: <strong><?php echo basename($selectedImage); ?></strong></h2>
			</div>
			
			<img id="selected-image" src="images/<?php echo htmlspecialchars($selectedImage); ?>" alt="Selected Image">
		<?php endif; ?>
		
		<form method="post">
            <div class="images">
                <input type="radio" id="image1" name="image" value="corn1.gif" <?php echo $selectedImage == 'corn1.gif' ? 'checked' : ''; ?>>
                <label for="image1"><img src="images/corn1.gif" alt="Corn1"></label>

                <input type="radio" id="image2" name="image" value="turkey1.gif" <?php echo $selectedImage == 'turkey1.gif' ? 'checked' : ''; ?>>
                <label for="image2"><img src="images/turkey1.gif" alt="Turkey1"></label>

                <input type="radio" id="image3" name="image" value="pumpkin1.gif" <?php echo $selectedImage == 'pumpkin1.gif' ? 'checked' : ''; ?>>
                <label for="image3"><img src="images/pumpkin1.gif" alt="Pumpkin1"></label>

                <input type="radio" id="image4" name="image" value="hat1.gif" <?php echo $selectedImage == 'hat1.gif' ? 'checked' : ''; ?>>
                <label for="image4"><img src="images/hat1.gif" alt="hat1"></label>

                <input type="radio" id="image5" name="image" value="leaf1.gif" <?php echo $selectedImage == 'leaf1.gif' ? 'checked' : ''; ?>>
                <label for="image5"><img src="images/leaf1.gif" alt="Leaf1"></label>
            </div>

            <button type="submit">Save Selection</button>
        </form>	
		
	   </section>
	    
	</main>
	 
	<footer style="padding: 10px; position: relative;">
	<p style="text-align: center">&copy; 2024 Carole Youssef. All rights reserved.</p>
	</footer>

</body>
</html>

			

