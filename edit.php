<?php include 'header.php'; ?>

<?php
include 'connect.php';

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($dbc, $_POST['id']);
    $title = mysqli_real_escape_string($dbc, $_POST['title']);
    $summary = mysqli_real_escape_string($dbc, $_POST['summary']);
    $content = mysqli_real_escape_string($dbc, $_POST['content']);
    $category = mysqli_real_escape_string($dbc, $_POST['category']);
    $archived = isset($_POST['archived']) ? 1 : 0;

    $query = "UPDATE vijesti SET naslov = '$title', sazetak = '$summary', tekst = '$content', kategorija = '$category', arhiva = '$archived' WHERE id = '$id'";
    mysqli_query($dbc, $query);
    echo "<p>Article updated successfully.</p>";
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($dbc, $_GET['id']);
    $query = "SELECT * FROM vijesti WHERE id = '$id'";
    $result = mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $row['naslov']; ?>" required>
            <label for="summary">Summary:</label>
            <textarea id="summary" name="summary" required><?php echo $row['sazetak']; ?></textarea>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required><?php echo $row['tekst']; ?></textarea>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="health" <?php if ($row['kategorija'] == 'health') echo 'selected'; ?>>Health</option>
                <option value="fitness" <?php if ($row['kategorija'] == 'fitness') echo 'selected'; ?>>Fitness</option>
                <option value="nutrition" <?php if ($row['kategorija'] == 'nutrition') echo 'selected'; ?>>Nutrition</option>
            </select>
            <label for="archived">Archived:</label>
            <input type="checkbox" id="archived" name="archived" <?php if ($row['arhiva'] == 1) echo 'checked'; ?>>
            <input type="submit" name="update" value="Update">
        </form>
        <?php
    } else {
        echo '<p>Article not found.</p>';
    }
}

mysqli_close($dbc);
?>

<?php include 'footer.php'; ?>
