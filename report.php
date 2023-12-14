<?php
include('connect.php');
include('fpdf/fpdf.php');

function generatePDF($data)
{
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    
    // Add your header content here
    $pdf->Cell(200, 5, "Lyceum of the Philippines University", 0, 0, 'C');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(200, 5, "Makiling, Calamba City", 0, 0, 'C');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(200, 5, "Student Registration List", 0, 0, 'C');
    $pdf->Ln();
    $pdf->Cell(350, 5, "--------------------------------------------------------------------------------------------------------------------------------------");
    $pdf->Ln();

    // Set up header row
    $width_cell = array(30, 50, 50, 60, 50);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetFillColor(193, 229, 252);
    $pdf->Cell($width_cell[0], 10, 'ID', 0, 0, 'C', true);
    $pdf->Cell($width_cell[1], 10, 'First Name', 0, 0, 'A', true);
    $pdf->Cell($width_cell[2], 10, 'Last Name', 0, 0, 'A', true);
    $pdf->Cell($width_cell[3], 10, 'Email Address', 0, 0, 'A', true);
    $pdf->Ln();

    // Set up data rows
    $fill = false;
    $pdf->SetFillColor(235, 236, 236);

    foreach ($data as $row) {
        $pdf->Cell($width_cell[0], 5, $row['id'], 0, 0, 'C', $fill);
        $pdf->Cell($width_cell[1], 5, $row['firstname'], 0, 0, 'A', $fill);
        $pdf->Cell($width_cell[2], 5, $row['lastname'], 0, 0, 'A', $fill);
        $pdf->Cell($width_cell[3], 5, $row['email'], 0, 1, 'A', $fill);
        $fill = !$fill;
    }

    // Output the PDF
    $pdf->Output();
}

// Fetch data from table
$result = mysqli_query($conn, "select * from user_tbl");
$data = array();
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}

// Call the function to generate PDF
generatePDF($data);
?>
