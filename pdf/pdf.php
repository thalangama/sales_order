<?php
require('fpdf.php');

class PDF extends FPDF
{
// Load data
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

    function setTable($header, $data, $w)
    {
        $totalArray = [];
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header

        for ($i = 0; $i < count($header); $i++)
            $this->Cell((isset($w[$i]) ? $w[$i] : 40 ), 15, $header[$i]['value'], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $key => $row) {
            for ($i = 0; $i < count($header); $i++) {
                if ($header[$i]['type'] == 'S') {
                    if(!isset($totalArray[$i]))
                        $totalArray[$i] = '';
                    $this->Cell((isset($w[$i]) ? $w[$i] : 40), 8, $row[$i], 'LRTB', 0, 'L', $fill);
                } elseif ($header[$i]['type'] == 'N'){
                    if(!isset($totalArray[$i]))
                        $totalArray[$i] = '';
                    $this->Cell((isset($w[$i]) ? $w[$i] : 40), 8, number_format((int)$row[$i]), 'LRTB', 0, 'R', $fill);
                } elseif ($header[$i]['type'] == 'C'){
                    $this->Cell((isset($w[$i]) ? $w[$i] : 40), 8, number_format((double)$row[$i], 2), 'LRTB', 0, 'R', $fill);
                    if(!isset($totalArray[$i]))
                        $totalArray[$i] = 0;
                    $totalArray[$i] = $totalArray[$i] + (double)$row[$i];
                }
            }
            $this->Ln();
            $fill = !$fill;
        }

        $this->Cell((isset($w[0] ) ? $w[0]  : 40 ), 10, 'Total', 'LRTB', 0, 'L', $fill);
        for ($i = 1; $i < count($header); $i++){
            if ($header[$i]['type'] == 'C'){
                $this->Cell((isset($w[$i]) ? $w[$i] : 40), 10, number_format((double)$totalArray[$i], 2), 'LRTB', 0, 'R', $fill);
            } else {
                $this->Cell((isset($w[$i]) ? $w[$i] : 40 ), 10, $totalArray[$i], 1, 0, 'C', $fill);
            }
        }
        $this->Ln();
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    function setPrintTable($header, $data, $w)
    {
        $totalArray = [];
        // Colors, line width and bold font
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0);
        $this->SetFont('', 'B');
        // Header

        for ($i = 0; $i < count($header); $i++)
            $this->Cell((isset($w[$i]) ? $w[$i] : 40 ), 15, $header[$i]['value'], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $key => $row) {
            for ($i = 0; $i < count($header); $i++) {
                if ($header[$i]['type'] == 'S') {
                    if(!isset($totalArray[$i]))
                        $totalArray[$i] = '';
                    $this->Cell((isset($w[$i]) ? $w[$i] : 40), 8, $row[$i], 'LRTB', 0, 'L', $fill);
                } elseif ($header[$i]['type'] == 'N'){
                    if(!isset($totalArray[$i]))
                        $totalArray[$i] = '';
                    $this->Cell((isset($w[$i]) ? $w[$i] : 40), 8, number_format((int)$row[$i]), 'LRTB', 0, 'R', $fill);
                } elseif ($header[$i]['type'] == 'C'){
                    $this->Cell((isset($w[$i]) ? $w[$i] : 40), 8, number_format((double)$row[$i], 2), 'LRTB', 0, 'R', $fill);
                    if(!isset($totalArray[$i]))
                        $totalArray[$i] = 0;
                    $totalArray[$i] = $totalArray[$i] + (double)$row[$i];
                }
            }
            $this->Ln();
            $fill = !$fill;
        }

        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function setPageTitle($title){
        $this->SetFont('Arial','B',16);
        $this->Cell('100%',10,$title,'', 0, 'C','');
        $this->Ln(15);
    }

    function setSearchFields($feilds){
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        for ($i = 0; $i < count($feilds); $i++) {
            $this->Cell(75, 6, $feilds[$i]['code'], '', 0, 'L', '');
            $this->Cell(2, 6, ':', '', 0, 'L', '');
            $this->Cell(50, 6, $feilds[$i]['value'], '', 0, 'L', '');
            $this->Ln();
        }
        $this->Ln();
    }

    function setText($text){
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        $this->Cell(75, 6, $text, '', 0, 'L', '');
        $this->Ln();
    }
}