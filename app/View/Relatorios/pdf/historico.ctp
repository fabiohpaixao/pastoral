<?php
<?php
	App::import('Vendor', 'PDF');
	$pdf = new PDF('P','mm','A4');
	 
	$pdf->AddPage();
	$pdf->SetFont("Arial", '', 6.7);
	 
	$pdf->Cell(90,4,'Materias',1,1,'L');
	foreach($disciplinas as $disciplina){
	    $pdf->Cell(90,4,$disciplina['Disciplina']['nome'],1,1,'L');
	}
	 
	$pdf->Output('doc.pdf', 'I');
	//$pdf->Output('doc.pdf', 'D');

?>