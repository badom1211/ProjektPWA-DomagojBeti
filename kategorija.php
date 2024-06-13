<?php include 'header.php'; ?>

<?php
include 'connect.php';
$category = mysqli_real_escape_string($dbc, $_GET['category']);

$query = "SELECT * FROM vijesti WHERE kategorija = '$category'";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<section class="category-detalj section-gray">';
    echo '<h2>' . ucfirst($category) . '</h2>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<article class="full-article-detalj">';
        echo '<img src="images/' . $row['slika'] . '" alt="' . $row['naslov'] . '">';
        echo '<h3><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h3>';
        echo '<span>' . 'Datum: ' . $row['datum'] . '</span>';
        echo '<p>' . 'Sažetak: ' . $row['sazetak'] . '</p>';
        echo '<div>' . $row['tekst'] . '</div>';
        echo '</article>';
    }
    echo '<div class="separator"></div></section>';
} else {
    echo '<p>No news available for this category.</p>';
}

mysqli_close($dbc);
?>

<?php include 'footer.php'; ?>
