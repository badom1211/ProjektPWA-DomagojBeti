<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health and Fitness</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="detailed-container">
        <header>
            <h1>Health and Fitness</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="kategorija.php?category=health">Health</a></li>
                    <li><a href="kategorija.php?category=fitness">Fitness</a></li>
                    <li><a href="kategorija.php?category=nutrition">Nutrition</a></li>
                    <li><a href="unos.php">Add New Article</a></li>
                    <li><a href="administrator.php">Admin</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                <li><a href="logout.php">Odjava</a></li>
            <?php endif; ?>
                </ul>
            </nav>
        </header>
        <main>
