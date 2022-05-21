<!DOCTYPE html>
<html lang="en">

<?php $title = 'Form'; ?>
<?php require_once('./view/header.php'); ?>

<body>
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

            <button class="btn btn-success" type="submit">Save</button>
        </form>
    </div>
</body>

</html>