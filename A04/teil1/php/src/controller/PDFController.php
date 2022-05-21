<?php
require('./lib/fpdf/fpdf.php');

class PDFController
{
    private $pdf;

    public function __construct()
    {
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', '', 12);
    }

    public function createPDF()
    {
        // Content
        $this->pdf->Cell(40, 10, 'Hello World!');
        $this->pdf->Output();
    }

    public function csv_to_pdf($csv_array)
    {
        //$this->BasicTable($csv_array[0], $csv_array);
        $header = $csv_array[0];
        $this->pdf->SetFont('Arial', 'B', 16);

        //$this->pdf->SetFont('Arial', '', 12);
        $this->pdf->SetFont('Arial', 'B', 12);
        foreach ($csv_array as $key => $value) {
            if ($key > 0) {
                $this->pdf->SetFont('Arial', '', 12);
            }

            $this->pdf->Cell(10, 7, $value->get_id(), 1);
            $this->pdf->Cell(40, 7, $value->get_vorname(), 1);
            $this->pdf->Cell(40, 7, $value->get_nachname(), 1);
            $this->pdf->Cell(45, 7, $value->get_strasse(), 1);
            $this->pdf->Cell(20, 7, $value->get_plz(), 1);
            $this->pdf->Cell(40, 7, $value->get_ort(), 1);
            $this->pdf->Ln();
        }

        $this->pdf->Output('I', './pdf/myPDF.pdf', true);
    }

    private function BasicTable($header, $data)
    {
        // Header
        foreach ($header as $key => $value)
            $this->pdf->Cell(40, 7, $value->get_vorname(), 1);
        $this->pdf->Ln();

        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->pdf->Cell(40, 6, $col, 1);
            $this->pdf->Ln();
        }
    }
}
