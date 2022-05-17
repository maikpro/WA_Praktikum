<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        $tableRowId = 0;

        function get_last_id($csv_path)
        {
            $file = file($csv_path); //read only
            $last_row = array_pop($file);
            return $last_row[0];
        }

        function read_csv_and_create_table($csv_path)
        {
            global $tableRowId;
            $html = '<table class="table table-hover table-striped light-violet">';
            $file = fopen($csv_path, 'r'); //read only

            // create table header
            $header = fgetcsv($file, 0, ';');
            $html .= '<thead>';
            foreach ($header as $key => $value) {
                $html .= '<th scope="col">' . $value . '</th>';
            }
            $html .= '<th scope="col">edit</th>';
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

                // bearbeiten icon
                // TODO über form.php lösen, dass die daten dort eingeladen werden
                $html .= '<td><div class="edit" id="' . $tableRowId . '" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen"></i></div></td>';

                $tableRowId++;
                $html .= '</tr>';
            }
            fclose($file);
            $html .= '</tbody>';
            $html .= '</table>';
            return $html;
        }

        function add_row_to_csv($csv_path)
        {
            if (isset($_POST["vorname"]) && isset($_POST["nachname"]) && isset($_POST["strasse"]) && isset($_POST["plz"]) && isset($_POST["ort"])) {
                echo '<p>' . $_POST["vorname"] . '</p>';
                echo '<p>' . $_POST["nachname"] . '</p>';
                echo '<p>' . $_POST["strasse"] . '</p>';
                echo '<p>' . $_POST["plz"] . '</p>';
                echo '<p>' . $_POST["ort"] . '</p>';

                $vorname = $_POST["vorname"];
                $nachname = $_POST["nachname"];
                $strasse = $_POST["strasse"];
                $plz = $_POST["plz"];
                $ort = $_POST["ort"];

                // Add Row to CSV
                $file = fopen($csv_path, 'a');
                $newRow = array(
                    'id' => get_last_id($csv_path) + 1,
                    'vorname' => $vorname,
                    'nachname' => $nachname,
                    'strasse' => $strasse,
                    'plz' => $plz,
                    'ort' => $ort,
                );
                fputcsv($file, $newRow, ';');
                fclose($file);
            }
        }
        ?>

        <div class="form-data">
            <?php

            // funktion aufrufen
            add_row_to_csv('csv.csv');

            ?>
        </div>

        <div class="table-csv">
            <?php
            echo read_csv_and_create_table('csv.csv');
            ?>
        </div>

        <a href="./form.php"><button type="button" class="btn btn-success">Go to form</button></a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daten bearbeiten</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!--FORM-->
                <form id="addRow">
                    <div class="modal-body">
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
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Bearbeiten</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/getRow.js"></script>
</body>

</html>