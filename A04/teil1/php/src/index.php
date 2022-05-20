<!DOCTYPE html>
<html lang="en">

<?php $title = 'Home'; ?>
<?php require_once('./view/header.php'); ?>

<?php require_once('./controller/PersonController.php') ?>


<body>
    <div class="container mt-2">
        <div class="table-csv">
            <?php
            $personController = new PersonController();
            $personController->displayTable();
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

                <!--BEARBEITEN FORM-->
                <form action="./index.php" method="POST">
                    <div class="modal-body">

                        <!--Workaround da in HTML PUT nicht existiert!-->
                        <input type="hidden" name="_METHOD" value="PUT" />

                        <input type="text" name="id" value="<?php echo $personController->get_selected_person()->get_id() ?>" readonly>

                        <!--Vorname-->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="vorname" placeholder="Vorname" value="<?php echo $personController->get_selected_person()->get_vorname() ?>" required>
                        </div>

                        <!--Nachname-->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="nachname" placeholder="Nachname" value="<?php echo $personController->get_selected_person()->get_nachname() ?>" required>
                        </div>

                        <!--Straße-->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="strasse" placeholder="Straße & Hausnummer" value="<?php echo $personController->get_selected_person()->get_strasse() ?>" required>
                        </div>

                        <!--PLZ-->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="plz" placeholder="PLZ" value="<?php echo $personController->get_selected_person()->get_plz() ?>" required>
                        </div>

                        <!--Ort-->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="ort" placeholder="Ort" value="<?php echo $personController->get_selected_person()->get_ort() ?>" required>
                        </div>

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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="./js/modal.js"></script>
</body>

</html>