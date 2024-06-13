<?php include 'header.php'; ?>

<?php
include 'connect.php';
$id = mysqli_real_escape_string($dbc, $_GET['id']);

$query = "SELECT * FROM vijesti WHERE id = '$id'";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<article id="' . str_replace(' ', '-', strtolower($row['naslov'])) . '" class="detailed-article">';
    echo '<h3>' . $row['naslov'] . '</h3>';
    echo '<span>' . 'Datum: ' . $row['datum'] . '</span>';
    echo '<div class="article-image-container"><img src="images/' . $row['slika'] . '" alt="' . $row['naslov'] . '"></div>';
    echo '<hr>';
    echo '<p>' . $row['tekst'] . '</p>';
    echo '<hr>';
    echo '<table>';
    echo '<tr><th>Detail</th><th>Information</th></tr>';
    echo '<tr><td>Category</td><td>' . ucfirst($row['kategorija']) . '</td></tr>';
    echo '<tr><td>Date</td><td>' . $row['datum'] . '</td></tr>';
    echo '</table>';
    echo '</article>';
} else {
    echo '<p>Article not found.</p>';
}

mysqli_close($dbc);
?>

<?php include 'footer.php'; ?>
