<?php

session_start();


$photo_size = isset($_POST['photo_size']) ? $_POST['photo_size'] : 60; 
$border_color = '';
$size = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $photo_size = $_POST['photo_size'];
    $border_color = $_POST['border_color'];

    
    $size = intval($photo_size) * 2 . 'px'; 
} else {
    
    $size = '120px'; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peys App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: left; 
        }
        .form-container {
            max-width: 624px; 
            margin-left: 0; 
        }
        label {
            display: inline-block; 
            margin-right: 10px; 
            vertical-align: middle; 
        }
        button {
            margin-top: 20px; 
            padding: 5px 10px; 
            font-size: 14px; 
        }
        .result {
            margin-top: 20px;
            border: 5px solid <?php echo htmlspecialchars($border_color); ?>;
            width: <?php echo htmlspecialchars($size); ?>;
            height: <?php echo htmlspecialchars($size); ?>;
            background-color: lightgray; 
            display: block; 
            position: relative; 
        }
        .image {
            max-width: 100%;
            max-height: 100%;
            position: absolute; 
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); 
        }
        .slider-container {
            display: flex;
            align-items: center; 
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Peys App</h2>
    <form action="" method="POST">
        <div class="slider-container">
            <label for="photo_size">Select Photo Size:</label>
            <input type="range" name="photo_size" id="photo_size" min="10" max="100" value="<?php echo htmlspecialchars($photo_size); ?>" required oninput="this.nextElementSibling.value = this.value">
        </div>

        <label for="border_color">Select Border Color:</label>
        <input type="color" name="border_color" id="border_color" value="<?php echo htmlspecialchars($border_color); ?>" required>

        
        <button type="submit">Process</button>
    </form>

    
    <div class='result'>
        
        <?php if (file_exists("images/harzwel.png")): ?>
            <img src="images/harzwel.png" alt="harzwel Image" class="image">
        <?php else: ?>
            <p style="color:red;">Image not found. Please check the file path.</p>
            <!-- Debugging information -->
            <p>Debugging Info:</p>
            <p>Current Directory: <?php echo getcwd(); ?></p>
            <p>Expected Path: images/harzwel.png</p>
            <p>Full Path: <?php echo realpath("images/harzwel.png"); ?></p>
        <?php endif; ?>
    </div>
</div>

<script>

document.addEventListener('keydown', function(event) {
    const slider = document.getElementById('photo_size');
    
    if (event.key === "ArrowRight") { 
        slider.value = Math.min(100, parseInt(slider.value) + 10); 
        slider.dispatchEvent(new Event('input')); 
    } else if (event.key === "ArrowLeft") { 
        slider.value = Math.max(10, parseInt(slider.value) - 10); 
        slider.dispatchEvent(new Event('input')); 
    }
});


window.onload = function() {
    document.getElementById('photo_size').focus();
};
</script>

</body>
</html>