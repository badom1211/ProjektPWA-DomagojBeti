<?php
include 'connect.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $picture = $_FILES['pphoto']['name'];
    $title = mysqli_real_escape_string($dbc, $_POST['title']);
    $about = mysqli_real_escape_string($dbc, $_POST['about']);
    $content = mysqli_real_escape_string($dbc, $_POST['content']);
    $category = mysqli_real_escape_string($dbc, $_POST['category']);
    $date = date('Y-m-d'); // Automatski generiran datum u formatu 'yyyy-mm-dd'
    $archive = isset($_POST['archive']) ? 1 : 0;
    $target_dir = 'images/' . $picture;

    if (move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir)) {
        $query = "INSERT INTO Vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";
        $result = mysqli_query($dbc, $query) or die('Error querying database.');

        if ($result) {
            $message = '<p class="success-message">Article successfully added.</p>';
        } else {
            $message = '<p class="error-message">Error adding article: ' . mysqli_error($dbc) . '</p>';
        }
    } else {
        $message = '<p class="error-message">Error uploading image.</p>';
    }

    mysqli_close($dbc);
}
?>

<?php include 'header.php'; ?>

<main>
    <div class="form-container">
        <h2>Add New Article</h2>
        <?php if ($message) echo $message; ?>
        <form action="unos.php" method="post" enctype="multipart/form-data" id="articleForm">
            <div class="form-item">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <span id="titleError" class="error-message"></span>
            </div>

            <div class="form-item">
                <label for="about">Summary:</label>
                <textarea id="about" name="about" required></textarea>
                <span id="aboutError" class="error-message"></span>
            </div>

            <div class="form-item">
                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>
                <span id="contentError" class="error-message"></span>
            </div>

            <div class="form-item">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="health">Health</option>
                    <option value="fitness">Fitness</option>
                    <option value="nutrition">Nutrition</option>
                </select>
                <span id="categoryError" class="error-message"></span>
            </div>

            <div class="form-item">
                <label for="pphoto">Image:</label>
                <input type="file" id="pphoto" name="pphoto" accept="image/*" required>
                <span id="pphotoError" class="error-message"></span>
            </div>

            <div class="form-item checkbox-container">
                <input type="checkbox" id="archive" name="archive">
                <label for="archive">Archive</label>
            </div>

            <div class="form-item">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

<script>
document.getElementById("articleForm").onsubmit = function(event) {
    var valid = true;

    // Reset error messages and styles
    document.getElementById("titleError").style.display = "none";
    document.getElementById("aboutError").style.display = "none";
    document.getElementById("contentError").style.display = "none";
    document.getElementById("categoryError").style.display = "none";
    document.getElementById("pphotoError").style.display = "none";
    document.getElementById("title").classList.remove("input-error");
    document.getElementById("about").classList.remove("input-error");
    document.getElementById("content").classList.remove("input-error");
    document.getElementById("category").classList.remove("input-error");
    document.getElementById("pphoto").classList.remove("input-error");

    // Title validation
    var title = document.getElementById("title").value;
    if (title.length < 5 || title.length > 30) {
        valid = false;
        document.getElementById("titleError").style.display = "block";
        document.getElementById("titleError").innerHTML = "Title must be between 5 and 30 characters.";
        document.getElementById("title").classList.add("input-error");
    }

    // Summary validation
    var about = document.getElementById("about").value;
    if (about.length < 10 || about.length > 100) {
        valid = false;
        document.getElementById("aboutError").style.display = "block";
        document.getElementById("aboutError").innerHTML = "Summary must be between 10 and 100 characters.";
        document.getElementById("about").classList.add("input-error");
    }

    // Content validation
    var content = document.getElementById("content").value;
    if (content.length == 0) {
        valid = false;
        document.getElementById("contentError").style.display = "block";
        document.getElementById("contentError").innerHTML = "Content must not be empty.";
        document.getElementById("content").classList.add("input-error");
    }

    // Image validation
    var pphoto = document.getElementById("pphoto").value;
    if (pphoto.length == 0) {
        valid = false;
        document.getElementById("pphotoError").style.display = "block";
        document.getElementById("pphotoError").innerHTML = "Image must be selected.";
        document.getElementById("pphoto").classList.add("input-error");
    }

    // Category validation
    var category = document.getElementById("category").value;
    if (category == "") {
        valid = false;
        document.getElementById("categoryError").style.display = "block";
        document.getElementById("categoryError").innerHTML = "Category must be selected.";
        document.getElementById("category").classList.add("input-error");
    }

    if (!valid) {
        event.preventDefault();
    }
};
</script>
