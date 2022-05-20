<?php

require_once './view/PersonView.php';
require_once './model/Person.php';

class PersonController
{
    private $personArray;
    private $personView;
    private $csv_path = 'csv.csv';

    private $selected_person;

    public function __construct()
    {
        $this->personArray = array();
        $this->personView = new PersonView();
    }

    public function get_selected_person()
    {
        return $this->selected_person;
    }

    public function displayTable()
    {
        $this->add_row_to_csv($this->csv_path);
        $this->personView->display($this->read_csv_and_create_table($this->csv_path));
        $this->open_edit_modal();

        //Testing..
        $this->get_array_test();
    }



    /**
     * Liest die CSV Datei aus und erstellt aus den Daten eine Tabelle.
     */

    //TODO: Refactor!
    private function read_csv_and_create_table($csv_path)
    {
        $this->read_csv($csv_path);

        // erstelle Tabelle
        $html = '<table class="table table-hover table-striped light-violet">';
        $header = $this->personArray[0];

        $html .= '<thead>';
        $html .= '<th scope="col">' . $header->get_id() . '</th>';
        $html .= '<th scope="col">' . $header->get_vorname() . '</th>';
        $html .= '<th scope="col">' . $header->get_nachname() . '</th>';
        $html .= '<th scope="col">' . $header->get_strasse() . '</th>';
        $html .= '<th scope="col">' . $header->get_plz() . '</th>';
        $html .= '<th scope="col">' . $header->get_ort() . '</th>';
        $html .= '<th scope="col">edit</th>';
        $html .= '</thead>';

        // create table rows
        $html .= '<tbody>';

        foreach ($this->personArray as $key => $person) {
            // header überspringen
            if ($key == 0) {
                continue;
            }

            $html .= '<tr>';

            $html .= '<td>' . $person->get_id() . '</td>';
            $html .= '<td>' . $person->get_vorname() . '</td>';
            $html .= '<td>' . $person->get_nachname() . '</td>';
            $html .= '<td>' . $person->get_strasse() . '</td>';
            $html .= '<td>' . $person->get_plz() . '</td>';
            $html .= '<td>' . $person->get_ort() . '</td>';

            // bearbeiten icon
            $html .= '<td>';
            $html .= '<a href="index.php?edit=' . $key . '">';
            $html .= '<div class="edit"><i class="fa-solid fa-pen"></i></div>';
            $html .= '</a>';
            $html .= '</td>';

            //$tableRowId++;
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;
    }

    private function read_csv($csv_path)
    {
        $this->personArray = [];
        // Open File
        $file = fopen($csv_path, 'r');

        // Durchlaufe alle Zeilen und suche nach der id
        while ($row = fgetcsv($file, 0, ';')) {
            // Unnötige tr vermeiden ;;;;;; am ende der csv
            if (empty($row[0])) {
                break;
            }
            $person = new Person($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
            array_push($this->personArray, $person);
        }
        fclose($file);
    }

    private function write_to_csv($csv_path)
    {
        // Add Row to CSV
        $file = fopen($csv_path, 'w');

        foreach ($this->personArray as $key => $person) {
            $row = array(
                'id' => $person->get_id(),
                'vorname' => $person->get_vorname(),
                'nachname' => $person->get_nachname(),
                'strasse' => $person->get_strasse(),
                'plz' => $person->get_plz(),
                'ort' => $person->get_ort(),
            );
            fputcsv($file, $row, ';');
        }
        fclose($file);
    }

    /**
     * Fügt eine Zeile hinzu, wenn Daten vom Form gesendet werden.
     */
    private function add_row_to_csv($csv_path)
    {
        //ON PUT
        if (isset($_POST["_METHOD"]) && $_POST["_METHOD"] == "PUT" && isset($_POST["id"]) && isset($_POST["vorname"]) && isset($_POST["nachname"]) && isset($_POST["strasse"]) && isset($_POST["plz"]) && isset($_POST["ort"])) {
            echo $_POST["_METHOD"];

            $id = $_POST["id"];
            $vorname = $_POST["vorname"];
            $nachname = $_POST["nachname"];
            $strasse = $_POST["strasse"];
            $plz = $_POST["plz"];
            $ort = $_POST["ort"];

            $personToUpdate = new Person($id, $vorname, $nachname, $strasse, $plz, $ort);
            $this->read_csv($csv_path);

            $toUpdate = array($id => $personToUpdate);
            $this->personArray = array_replace($this->personArray, $toUpdate);
            $this->write_to_csv($csv_path);
        }

        // ON POST
        else if (isset($_POST["vorname"]) && isset($_POST["nachname"]) && isset($_POST["strasse"]) && isset($_POST["plz"]) && isset($_POST["ort"])) {
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
                'id' => $this->get_last_id($csv_path) + 1,
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

    /**
     * Liest die letzte Id aus der CSV Datei aus -> Für die Erstellung von neuen Personen wird die letzte ID genommen und um 1 erhöht.
     */
    private function get_last_id($csv_path)
    {
        $file = file($csv_path); //read only
        $last_row = array_pop($file);
        return $last_row[0]; // id from last row
    }

    private function open_edit_modal()
    {
        if (isset($_GET["edit"])) {
            $id = $_GET["edit"];
            $this->selected_person = $this->personArray[$id];
            echo '<h1>' . $this->selected_person . '</h1>';
        }
    }

    private function get_array_test()
    {
        //var_dump($this->personArray);
        foreach ($this->personArray as $key => $person) {
            echo '<p>' . $person . '</p>';
        }
    }
}
