<?php
require_once('Librerias/TCPDF/tcpdf.php');
class PDF extends TCPDF {
    public function Header(){
        $archivoImagen = K_PATH_IMAGES.'LogoJuamaDoc1.jpg';
        $this->Image($archivoImagen, 15, 10, 28, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }
    public function Footer(){
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
if(isset($_POST['id'])){
    $modulo = new Controladores\DocusDemos();
    $respuesta = (array)$modulo->ver($_POST['id']);
    foreach ($respuesta as $demo) {
        $titulo = $demo['titulo'];
        $hnombre = $demo['hnombre'];
        $hapellidop = $demo['hapellidop'];
        $hapellidom = $demo['hapellidom'];
        $descripcioncargo = $demo['descripcioncargo'];
        $tipodemo = strtoupper($demo['descripcion']);
        $comentarios = $demo['comentarios'];
        $estado = $demo['estado'];
        $fechasolicitud = $demo['fechasolicitud'];
        $pdescripcion = $demo['pdescripcion'];
        $modelo = $demo['modelo'];
        $nombreh = $demo['nombreh'];
        $tipo = $demo['tipo'];
        $direccionh = $demo['direccionh'];
        $estadoh = $demo['estadoh'];
        $municipioh = $demo['municipioh'];
        $cp = $demo['cp'];
        $coloniah = $demo['coloniah'];
        $telefonoh = $demo['telefonoh'];
    }
    $objetivo = 'Proporcionar capacitación teórico-práctica a usuarios de equipo IRADIMED especializado en el cuidado del paciente en ambientes de Resonancia Magnética.';
    $requisitos = 'Para optimizar los resultados de esta demostración será necesario cumplir con los siguientes requisitos:';
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ing. Daniel Hernandez');
    $pdf->SetTitle('JUAMA');
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
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
    if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
        require_once(dirname(__FILE__).'/lang/spa.php');
        $pdf->setLanguageArray($l);
    }
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 14, '', true);
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
    $pdf->Ln(15);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->MultiCell(95, 5, 'Fecha solicitud:', 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(80, 5, 'Estado:', 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(95, 5, $fechasolicitud, 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(80, 5, $estado, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->MultiCell(95, 5, 'Hospital:', 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(80, 5, 'Contacto:', 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->MultiCell(95, 5, $nombreh, 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(80, 5, $titulo . ' ' . $hnombre . ' ' . $hapellidop . ' ' . $hapellidom, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->MultiCell(95, 5, 'Dirección:', 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(80, 5, 'Teléfono:', 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(95, 5, $direccionh . ', ' . $coloniah, 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(80, 5, $telefonoh, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(130, 5, $cp . ', ' . $municipioh . ', ' . $estadoh, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(15);
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->Cell(0, 3, 'SOLICITUD DE DEMOSTRACION ' . $tipodemo, 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(0, 3, $pdescripcion . ' | Modelo: ' . $modelo, 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 3, 'OBJETIVO', 0, 1, 'L');
    $pdf->Ln(1);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(177, 5, $objetivo, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(15);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 3, 'TEMARIO:', 0, 1, 'L');
    $pdf->Ln(2);
    $pdf->SetFont('helvetica', '', 10);
    $html = '<ul>
        <li>Características del equipo.</li>
        <li>Compatibilidad con RM</li>
        <li>Accesorios y Consumibles.</li>
        <li>Configuración de sistema (parámetros, límites y alarmas).</li>
        <li>Interacción con paciente.</li>
        <li>Inspección física, cuidados y limpieza.</li>
    </ul>';
    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 3, 'REQUISITOS', 0, 1, 'L');
    $pdf->Ln(1);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(177, 5, $requisitos, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(10);
    $html = '<ul>
        <li>Sala RM en operación.</li>
        <li>Programar paciente y/o voluntarios.</li>
        <li>Presencia de personal usuario de RM.</li>
    </ul>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(40);
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->Cell(0, 3, '_____________________', 0, 1, 'C');
    $pdf->Ln(1);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(0, 3, $titulo . '. ' . $hnombre . ' ' . $hapellidop . ' ' . $hapellidom, 0, 1, 'C');
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information
    ob_end_clean();
    $pdf->Output('demodocu.pdf', 'I');
}