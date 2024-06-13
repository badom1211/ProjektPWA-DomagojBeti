<?php include 'header.php'; ?>
<script>
function toggleShowMore(event) {
    const article = event.target.closest('.full-article');
    article.classList.toggle('expanded');
    event.target.textContent = article.classList.contains('expanded') ? 'Show Less' : 'Show More';
}
</script>
<?php
include 'connect.php';

$categories = ['health', 'fitness', 'nutrition'];
foreach ($categories as $category) {
    $query = "SELECT * FROM vijesti WHERE kategorija = '$category' AND arhiva = 1";
    $result = mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<section class="category section-gray' . (array_search($category, $categories) + 1) . '">';
        echo '<h2>' . ucfirst($category) . '</h2>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<article class="full-article">';
            echo '<img src="images/' . $row['slika'] . '" alt="' . $row['naslov'] . '">';
            echo '<h3><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h3>';
            echo '<span>' . $row['datum'] . '</span>';
            echo '<p>' . substr($row['sazetak'], 0, 100) . '...</p>'; // Display a snippet of the summary
            echo '<div class="more-content">' . $row['sazetak'] . '</div>'; // Full summary content
            echo '<button class="show-more-btn" onclick="toggleShowMore(event)">Show More</button>';
            echo '</article>';
        }
        echo '<div class="separator"></div></section>';
    }
}

mysqli_close($dbc);
?>

<?php include 'footer.php'; ?>
