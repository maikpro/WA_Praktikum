<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark violet ">
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
                            <a class="nav-link active" href="./index.php">CSV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./form.php">Form</a>
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
        function read_csv_and_create_table($csv_path)
        {
            $html = '<table class="table table-hover table-striped light-violet">';
            $file = fopen($csv_path, 'r'); //read only

            // create table header
            $header = fgetcsv($file, 0, ';');
            $html .= '<thead>';
            foreach ($header as $key => $value) {
                $html .= '<th scope="col">' . $value . '</th>';
            }
            $html .= '</thead>';

            // create table rows
            $html .= '<tbody>';
            while ($row = fgetcsv($file, 0, ';')) {
                // Unnötige tr vermeiden ;;;;;; am ende der csv
                if (empty($row[0])) {
                    break;
                }

                $html .= '<tr>';
                foreach ($row as $key => $value) {
                    $html .= '<td>' . $value . '</td>';
                }
                $html .= '</tr>';
            }
            fclose($file);
            $html .= '</tbody>';
            $html .= '</table>';
            return $html;
        }

        // funktion aufrufen
        $csv_path = 'csv.csv';
        echo read_csv_and_create_table($csv_path);
        ?>

        <div class="form-data">
            <?php
            if (isset($_POST["vorname"]) && isset($_POST["nachname"]) && isset($_POST["strasse"]) && isset($_POST["plz"]) && isset($_POST["ort"])) {
                echo '<p>' . $_POST["vorname"] . '</p>';
                echo '<p>' . $_POST["nachname"] . '</p>';
                echo '<p>' . $_POST["strasse"] . '</p>';
                echo '<p>' . $_POST["plz"] . '</p>';
                echo '<p>' . $_POST["ort"] . '</p>';


                // Add Row to CSV

            }
            ?>
        </div>

        <a href="./form.php"><button type="button" class="btn btn-success">Go to form</button></a>
    </div>
</body>

</html>