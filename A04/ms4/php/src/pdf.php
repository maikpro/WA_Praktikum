<?php

require_once('./controller/PDFController.php');
require_once('./controller/PersonController.php');

$pdfController = new PDFController();
$personController = new PersonController();

//CSV auslesen
$csv_array = $personController->get_personarray();

//$pdfController->createPDF();
$pdfController->csv_to_pdf($csv_array);
