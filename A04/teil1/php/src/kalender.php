<!DOCTYPE html>
<html lang="de">

<?php
date_default_timezone_set('Europe/Berlin');

$title = 'Kalender';
require_once('./view/header.php');
require_once('./controller/KalenderController.php');
$kalenderController = new KalenderController();
?>

<body>
    <div class="container mt-2">

        <div class="kalender-control">
            <a href="./kalender.php?prev_year&month=<?php echo $kalenderController->get_selected_month(); ?>&year=<?php echo $kalenderController->get_prev_year(); ?>"><button type="button" class="btn btn-primary">vorheriges Jahr</button></a>
            <a href="./kalender.php?next_year&month=<?php echo $kalenderController->get_selected_month(); ?>&year=<?php echo $kalenderController->get_next_year(); ?>"><button type="button" class="btn btn-primary">nächstes Jahr</button></a>
        </div>

        <div class="kalender-control mt-3">
            <a href="./kalender.php?prev&month=<?php echo $kalenderController->get_prev_month(); ?>&year=<?php echo $kalenderController->get_prev_month_year(); ?>"><button type="button" class="btn btn-primary">vorheriger Monat</button></a>
            <a href="./kalender.php"><button type="button" class="btn btn-primary">aktueller Monat</button></a>
            <a href="./kalender.php?next&month=<?php echo $kalenderController->get_next_month(); ?>&year=<?php echo $kalenderController->get_next_month_year(); ?>"><button type="button" class="btn btn-primary">nächster Monat</button></a>
        </div>

        <div class="monat mt-4 mb-4">
            <h2><?php echo $kalenderController->get_selected_month_string() . " " . $kalenderController->get_selected_year() ?><h2>
        </div>

        <!--Book Table-->
        <table class="table table-hover table-striped light-violet">
            <thead>
                <tr>
                    <th scope="col">Wochennummer</th>
                    <th scope="col">Montag</th>
                    <th scope="col">Dienstag</th>
                    <th scope="col">Mittwoch</th>
                    <th scope="col">Donnerstag</th>
                    <th scope="col">Freitag</th>
                    <th scope="col">Samstag</th>
                    <th scope="col">Sonntag</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $kalenderController->printCalender($kalenderController->get_selected_month(), $kalenderController->get_selected_year()); ?>
            </tbody>
        </table>

    </div>
</body>

</html>