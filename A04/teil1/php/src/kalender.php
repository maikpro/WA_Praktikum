<!DOCTYPE html>
<html lang="de">

<?php $title = 'Kalender'; ?>
<?php require_once('./view/header.php'); ?>
<?php require_once('./controller/KalenderController.php');
$kalenderController = new KalenderController();
?>

<body>
    <div class="container mt-2">

        <div class="kalender-control">
            <!--<a href="./kalender.php"><button type="button" class="btn btn-primary">vorheriges Jahr</button></a>-->
            <a href="./kalender.php"><button type="button" class="btn btn-primary">vorheriger Monat</button></a>
            <a href="./kalender.php"><button type="button" class="btn btn-primary">aktueller Monat</button></a>
            <a href="./kalender.php"><button type="button" class="btn btn-primary">nächster Monat</button></a>
            <!--<a href="./kalender.php"><button type="button" class="btn btn-primary">nächstes Jahr</button></a>-->
        </div>

        <div class="monat mt-4 mb-4">
            <h2><?php echo $kalenderController->get_current_month_string() . " " . $kalenderController->get_current_year() ?><h2>
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
                <!--<tr>
                    <th scope="row">01</th>
                    <td>01</td>
                    <td>02</td>
                    <td>03</td>
                    <td>04</td>
                    <td>05</td>
                    <td>06</td>
                    <td>07</td>
                </tr>-->

                <?php echo $kalenderController->printCalender(); ?>
            </tbody>
        </table>

    </div>
</body>

</html>