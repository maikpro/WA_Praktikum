<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark violet">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.html">
                    <div class="logo">
                        <i class="fa-solid fa-book"></i> PHP
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">CSV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./form.php">Form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kalender</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!--NAVIGATION-->
    </header>

    <div class="container mt-2">
        <?php
        echo '<h3>Form: Add Row to CSV</h3>';

        ?>

        <form action="./index.php" method="post">
            <!--Vorname-->
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="vorname" placeholder="Vorname" required>
            </div>

            <!--Nachname-->
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="nachname" placeholder="Nachname" required>
            </div>

            <!--Straße-->
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="strasse" placeholder="Straße & Hausnummer" required>
            </div>

            <!--PLZ-->
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="plz" placeholder="PLZ" required>
            </div>

            <!--Ort-->
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="ort" placeholder="Ort" required>
            </div>

            <button class="btn btn-success" type="submit">Add Row</button>
        </form>
    </div>
</body>

</html>