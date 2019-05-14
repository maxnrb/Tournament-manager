<?php
require_once(dirname(dirname(__DIR__)) . '/assets/tcpdf/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tournament Manager');
$pdf->SetTitle('');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__) . '/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Matches calendar', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$dayNumber = 1;

foreach ($matchLists as $matchList) {

$tbl = <<<EOD


<table border="1" cellpadding="8" cellspacing="2" nobr="true">
 <tr style="background-color:#e17055;color:#ecf0f1;">
  <th colspan="4" align="center">DAY N°$dayNumber</th>
 </tr>
 <tr style="background-color:#dfe6e9;color:#2d3436;">
  <td>Team 1</td>
  <td>Team 2</td>
  <td>Score Team 1</td>
  <td>Score Team 2</td>
 </tr>
EOD;

foreach ($matchList as $match) {
    $name1 = $this->teamList_Model->searchNameById($match->getTeam1Id());
    $name2 = $this->teamList_Model->searchNameById($match->getTeam2Id());
    $score1 = $match->getTeam1Score();
    $score2 = $match->getTeam2Score();

    $tbl .= <<<EOD
 <tr>
  <td>$name1</td>
  <td>$name2</td>
  <td>$score1</td>
  <td>$score2</td>
 </tr>
EOD;
}

$tbl .= <<<EOD
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$dayNumber++;
}

// -----------------------------------------------------------------------------

$md5 = md5(uniqid(rand(), true));

$name = 'TM_Calendar-' . $md5 . '.pdf';

//Close and output PDF document
$pdf->Output($name, 'I');

//============================================================+
// END OF FILE
//============================================================+
