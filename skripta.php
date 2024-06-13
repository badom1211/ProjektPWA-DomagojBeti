<?php
include 'connect.php'; // Ensure this file contains the database connection details

// Get form data
$title = $_POST['title'];
$summary = $_POST['summary'];
$content = $_POST['content'];
$category = $_POST['category'];
$image = $_FILES['image']['name'];
$display = isset($_POST['display']) ? 1 : 0;
$date = date('Y-m-d H:i:s'); // Current date and time

// Move uploaded image to the target directory
$target_dir = 'images/';
$target_file = $target_dir . basename($image);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
    // Insert data into the database
    $query = "INSERT INTO vijesti (naslov, sazetak, tekst, slika, kategorija, arhiva, datum) VALUES ('$title', '$summary', '$content', '$image', '$category', $display, '$date')";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        // Display the submitted content
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Submission Successful</title>';
        echo '<link rel="stylesheet" href="style.css">';
        echo '</head>';
        echo '<body>';
        echo '<div class="container">';
        echo '<header>';
        echo '<h1>Health and Fitness</h1>';
        echo '<nav>';
        echo '<ul>';
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li><a href="health.html">Health</a></li>';
        echo '<li><a href="fitness.html">Fitness</a></li>';
        echo '<li><a href="nutrition.html">Nutrition</a></li>';
        echo '<li><a href="unos.html">Novi unos +</a></li>';
        echo '</ul>';
        echo '</nav>';
        echo '</header>';
        echo '<main>';
        echo '<section class="category">';
        echo '<article class="full-article">';
        echo '<img src="images/' . $image . '" alt="' . $title . '">';
        echo '<h3>' . $title . '</h3>';
        echo '<span>' . $date . '</span>';
        echo '<p>' . $summary . '</p>';
        echo '<p>' . $content . '</p>';
        echo '</article>';
        echo '</section>';
        echo '</main>';
        echo '<footer>';
        echo '<p>Author: Domagoj Beti | Email: dbeti@tvz.hr | &copy; 2024</p>';
        echo '</footer>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    } else {
        echo 'Error: ' . mysqli_error($dbc);
    }
} else {
    echo 'Error uploading the image.';
}

mysqli_close($dbc);
?>
