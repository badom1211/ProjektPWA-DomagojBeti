<?php
session_start();
include 'connect.php';
include 'header.php';

// Path to the image directory
define('UPLPATH', 'img/');

// Initialize variables
$uspjesnaPrijava = false;
$admin = false;
$msg = '';

// Check if the user has come from the login form
if (isset($_POST['prijava'])) {
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];

    // Check if the user exists in the database with SQL injection protection
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);
    }

    // Verify password
    if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
        $uspjesnaPrijava = true;

        // Check if the user is an admin
        if ($levelKorisnika == 1) {
            $admin = true;
            $msg = 'Uspješno ste prijavljeni kao administrator.';
        } else {
            $admin = false;
            $msg = 'Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali nemate administratorska prava.';
        }

        // Set session variables
        $_SESSION['username'] = $imeKorisnika;
        $_SESSION['level'] = $levelKorisnika;
    } else {
        $msg = 'Neispravno korisničko ime ili lozinka.';
    }
    mysqli_stmt_close($stmt);
}

// Check if the user is an administrator
if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {
    // Delete an article if the 'delete' parameter is set
    if (isset($_GET['delete'])) {
        $id = mysqli_real_escape_string($dbc, $_GET['delete']);
        $query = "DELETE FROM vijesti WHERE id = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Article deleted successfully.</p>";
            } else {
                echo "<p>Error deleting article: " . mysqli_error($dbc) . "</p>";
            }
        } else {
            echo "<p>Error preparing query: " . mysqli_error($dbc) . "</p>";
        }
        mysqli_stmt_close($stmt);
    }

    // Fetch and display articles
    $query = "SELECT * FROM vijesti";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="admin-table">';
            echo '<tr><th>Title</th><th>Category</th><th>Date</th><th>Actions</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['naslov'] . '</td>';
                echo '<td>' . ucfirst($row['kategorija']) . '</td>';
                echo '<td>' . $row['datum'] . '</td>';
                echo '<td>';
                echo '<a href="edit.php?id=' . $row['id'] . '">Edit</a> | ';
                echo '<a href="administrator.php?delete=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this article?\')">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No articles found.</p>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Error preparing query: " . mysqli_error($dbc) . "</p>";
    }
    mysqli_close($dbc);
} else if ($uspjesnaPrijava == true && $admin == false) {
    echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
} else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
    echo '<p>Bok ' . $_SESSION['username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
} else if ($uspjesnaPrijava == false) {
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <?php
    // Show message based on login attempt
    if (isset($msg)) echo '<p class="bojaPoruke">' . $msg . '</p>';
    ?>
    <div class="form-container">
        <h2>Prijava</h2>
        <form action="administrator.php" method="post">
            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username" required>
            <label for="lozinka">Lozinka:</label>
            <input type="password" id="lozinka" name="lozinka" required>
            <input type="submit" name="prijava" value="Prijava">
        </form>
        <p>Nemate račun? <a href="registracija.php">Registrirajte se</a></p>
    </div>
    <?php
}
?>
<?php include 'footer.php'; ?>
</body>
</html>
