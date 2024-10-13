<?php

if ($_SESSION['id_inventario']=='' || $_SESSION['nombres_inventario']=='' || $_SESSION['tipo_inventario']=='') {
    session_unset();
    session_destroy();
    
} else {

    require_once("./config/config.php");
    require_once(BASE_URL . "librerias/tcpdf/tcpdf.php");
    require_once '../model/consultorioModel.php';
    $objConsulta = new ConsultorioModel();


    setlocale(LC_ALL, "es_ES");
    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF
    {
        // Page footer
        public function Footer()
        {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, '´Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle("Reporte Primeros Puestos - " . $r_b_pe['nombre'] . " - " . $r_b_sem['descripcion']);
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(true);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->AddPage('P', 'A3');

    $content = '';
    $arrConsulta = $objConsulta->getConsultasReporte($_SESSION['id_inventario'], '2024-10-01');
    if (!empty($arrConsulta)) {
        for ($i = 0; $i < count($arrConsulta); $i++) {
            $id_consulta = $arrConsulta[$i]->id;

            $content .= '
<table border="1" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <th rowspan="5">' . $arrConsulta[$i]->id . '</th>
            <th colspan="3">NOMBRES Y APELLIDOS DEL PACIENTE</th>
            <td colspan="3"></td>
            <th colspan="2">FECHA DE NACIMIENTO</th>
            <td></td>
        </tr>
        <tr>
            <th>FECHA</th>
            <th>DNI/CIP</th>
            <th>EDAD</th>
            <th>CIA</th>
            <th>GRADO</th>
            <th>SEXO</th>
            <th>TALLA</th>
            <th>PESO</th>
            <th>DIAGNOSTICO</th>
        </tr>
        <tr>
            <td>1</td>
            <td>' . BASE_URL . '</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th colspan="5">MOTIVO DE CONSULTA</th>
            <th colspan="4">TRATAMIENTO</th>
        </tr>
        <tr>
            <td colspan="5">1</td>
            <td colspan="4"></td>
        </tr>
    </table><br><br>';
        }
    }

    $pdf->writeHTML($content);
    $pdf->Output('Reporte Primeros Puestos - ' . $r_b_pe['nombre'] . ' ' . $r_b_sem['descripcion'] . '.pdf', 'I');
}
