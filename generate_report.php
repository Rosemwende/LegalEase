<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_con/dbCon.php';
    $conn = connect();
    $reportType = $_POST['reportType'];

    /* Fetch data */
    $result = mysqli_query($conn, "SELECT * FROM participants,lawyer WHERE participants.u_id=lawyer.lawyer_id AND participants.status='Active'");

    if ($reportType == 'pdf') {
        require('fpdf/fpdf.php'); // Assuming you have FPDF library for PDF generation
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        
        /* Column headers */
        $pdf->Cell(40, 10, 'First Name');
        $pdf->Cell(40, 10, 'Last Name');
        $pdf->Cell(40, 10, 'Speciality');
        $pdf->Cell(40, 10, 'Practice Length');
        $pdf->Ln();
        
        /* Data */
        while ($row = mysqli_fetch_array($result)) {
            $pdf->Cell(40, 10, $row['first_Name']);
            $pdf->Cell(40, 10, $row['last_Name']);
            $pdf->Cell(40, 10, $row['speciality']);
            $pdf->Cell(40, 10, $row['practise_Length']);
            $pdf->Ln();
        }
        
        $pdf->Output('D', 'report.pdf');
    } elseif ($reportType == 'csv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="report.csv"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, array('First Name', 'Last Name', 'Speciality', 'Practice Length'));
        
        while ($row = mysqli_fetch_array($result)) {
            fputcsv($output, array($row['first_Name'], $row['last_Name'], $row['speciality'], $row['practise_Length']));
        }
        
        fclose($output);
    }
    mysqli_close($conn);
}
?>