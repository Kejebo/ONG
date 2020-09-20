<?php

require __DIR__ . "/vendor/autoload.php";
require_once('db/db_evento.php');
require_once('db/db_reunion.php');
require_once('db/db_patrocinador.php');
require_once('db/db_joven.php');
require_once('db/db_usuario.php');
$aliado = new db_patrocinio();
$eventos = new db_evento();
$reunion = new db_reunion();
$jovenes = new db_joven();
$usuarios = new db_usuario();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();


$tableHead = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '538ED5'
        ]
    ],
];
//even row
$evenRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '00BDFF'
        ]
    ]
];
//odd row
$oddRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '00EAFF'
        ]
    ]
];

$drawing->setName('Logo Empresa');
$drawing->setDescription('Logo de la Empresa');
$drawing->setPath("assets/861Logo Dale Una Mano.png");
$drawing->setCoordinates('A1');
$drawing->setOffsetX(30);
$drawing->setHeight(60);
$drawing->setRotation(0);
$drawing->getShadow()->setVisible(true);
$drawing->getShadow()->setDirection(45);

switch ($_GET['action']) {
    case 'eventos':
        get_evento($eventos, $tableHead, $drawing);
        break;

    case 'reuniones':
        get_reunion($reunion, $tableHead,$drawing);
        break;

    case 'aliados':
        aliados($aliado, $tableHead,$drawing);
        break;
    case 'jovenes':
        get_jovenes($jovenes, $tableHead, $drawing);
        break;
    case 'usuarios':
        usuarios($usuarios, $tableHead,$drawing);
        break;
}
function get_evento($eventos, $tableHead, $drawing)
{




    $spreadsheet = new Spreadsheet();
    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(10);
    $sheet = $spreadsheet->getActiveSheet();
    $drawing->setWorksheet($sheet);
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()
        ->setCellValue('C1', "Lista de Eventos");

    //merge heading
    $spreadsheet->getActiveSheet()->mergeCells("C1:I3");

    // set font style
    $spreadsheet->getActiveSheet()->getStyle('C1')->getFont()->setSize(20);

    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    $sheet->setCellValue('C4', 'Fecha');
    $sheet->setCellValue('D4', 'Hora Inicio');
    $sheet->setCellValue('E4', 'Hora Final');
    $sheet->setCellValue('F4', 'Nombre');
    $sheet->setCellValue('G4', 'Responsable');
    $sheet->setCellValue('H4', 'Lugar');
    $sheet->setCellValue('I4', 'Incriptos');

    $spreadsheet->getActiveSheet()->getStyle('C4:I4')->applyFromArray($tableHead);

    $auxone = 5;
    $auxtwo = 5;
    $auxthree = 5;
    $auxfour = 5;
    $auxfive = 5;
    $auxsix = 5;
    $auxseven = 5;


    foreach ($eventos->get_eventos() as $lista) {
        $sheet->setCellValue('C' . $auxone, $lista['fecha']);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('D' . $auxtwo, $lista['inicio']);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->setCellValue('E' . $auxthree, $lista['cierre']);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue('F' . $auxfour, $lista['nombre_evento']);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->setCellValue('G' . $auxfive, $lista['mentor']);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->setCellValue('H' . $auxsix, $lista['lugar']);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->setCellValue('I' . $auxseven, $lista['inscriptos']);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $auxone++;
        $auxtwo++;
        $auxthree++;
        $auxfour++;
        $auxfive++;
        $auxsix++;
        $auxseven++;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Evento.xlsx"');
    header('Cache-Control: max-age=0');
    $firstRow = 4;
    $lastRow = $auxfive - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("C" . $firstRow . ":H" . $lastRow);
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}

function get_reunion($reunion, $tableHead, $drawing)
{




    $spreadsheet = new Spreadsheet();
    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(10);
    $sheet = $spreadsheet->getActiveSheet();
    $drawing->setWorksheet($sheet);
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()
        ->setCellValue('C1', "Listado de Reuniones");

    //merge heading
    $spreadsheet->getActiveSheet()->mergeCells("C1:F2");

    // set font style
    $spreadsheet->getActiveSheet()->getStyle('C1')->getFont()->setSize(20);

    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    $sheet->setCellValue('C3', 'Fecha');
    $sheet->setCellValue('D3', '# Reunion');
    $sheet->setCellValue('E3', 'Elaborado');
    $sheet->setCellValue('F3', 'Asunto');

    $spreadsheet->getActiveSheet()->getStyle('C3:F3')->applyFromArray($tableHead);

    $auxone = 4;
    $auxtwo = 4;
    $auxthree = 4;
    $auxfour = 4;



    foreach ($reunion->get_reuniones() as $lista) {
        $sheet->setCellValue('C' . $auxone, $lista['fecha']);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('D' . $auxtwo, $lista['numero']);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->setCellValue('E' . $auxthree, $lista['nombre'] . ' ' . $lista['primer_apellido'] . ' ' . $lista['segundo_apellido']);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue('F' . $auxfour, $lista['objectivo']);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $auxone++;
        $auxtwo++;
        $auxthree++;
        $auxfour++;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Evento.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}

function aliados($aliado, $tableHead, $drawing)
{




    $spreadsheet = new Spreadsheet();
    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(10);
    $sheet = $spreadsheet->getActiveSheet();
    $drawing->setWorksheet($sheet);
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()
        ->setCellValue('C1', "Lista de Aliados");

    //merge heading
    $spreadsheet->getActiveSheet()->mergeCells("C1:I2");

    // set font style
    $spreadsheet->getActiveSheet()->getStyle('C1')->getFont()->setSize(20);

    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    $sheet->setCellValue('C3', 'Institucion');
    $sheet->setCellValue('D3', 'Responsable');
    $sheet->setCellValue('E3', 'Telefono');
    $sheet->setCellValue('F3', 'Cedula Juridica');
    $sheet->setCellValue('G3', 'Correo Electronico');
    $sheet->setCellValue('H3', 'Direccion');
    $sheet->setCellValue('I3', 'Asunto');
    $spreadsheet->getActiveSheet()->getStyle('C3:I3')->applyFromArray($tableHead);

    $auxone = 4;
    $auxtwo = 4;
    $auxthree = 4;
    $auxfour = 4;
    $auxfive = 4;
    $auxsix = 4;
    $auxseven = 4;



    foreach ($aliado->get_patrocinadores() as $lista) {
        $sheet->setCellValue('C' . $auxone, $lista['institucion']);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('D' . $auxtwo, $lista['responsable']);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->setCellValue('E' . $auxthree, $lista['telefono']);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue('F' . $auxfour, $lista['cedula_juridica']);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->setCellValue('G' . $auxfive, $lista['correo']);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->setCellValue('H' . $auxsix, $lista['direccion']);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->setCellValue('I' . $auxseven, $lista['aportes']);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $auxone++;
        $auxtwo++;
        $auxthree++;
        $auxfour++;
        $auxfive++;
        $auxsix++;
        $auxseven++;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Evento.xlsx"');
    header('Cache-Control: max-age=0');
    $firstRow = 3;
    $lastRow = $auxfive - 1;

    $spreadsheet->getActiveSheet()->setAutoFilter("C" . $firstRow . ":I" . $lastRow);
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}

function usuarios($usuarios, $tableHead, $drawing)
{




    $spreadsheet = new Spreadsheet();
    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(10);
    $sheet = $spreadsheet->getActiveSheet();
    $drawing->setWorksheet($sheet);
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()
        ->setCellValue('C1', "Lista de Usuarios");

    //merge heading
    $spreadsheet->getActiveSheet()->mergeCells("C1:I2");

    // set font style
    $spreadsheet->getActiveSheet()->getStyle('C1')->getFont()->setSize(20);

    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    $file = file_get_contents('data_users.json');
    $data = json_decode($file, true);
    foreach ($data as $list) {
        $sheet->setCellValue($list['position'] . '3', $list['name']);
        $sheet->getColumnDimension($list['position'])->setAutoSize(true);
    }
    $spreadsheet->getActiveSheet()->getStyle('B3:O3')->applyFromArray($tableHead);

    $row = 4;
    foreach ($usuarios->get_usuarios() as $lista) {
        $sheet->setCellValue('B' . $row, $lista['nombre']);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->setCellValue('C' . $row, $lista['primer_apellido']);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('D' . $row, $lista['segundo_apellido']);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->setCellValue('E' . $row, $lista['cedula']);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue('F' . $row, $lista['fecha_nacimiento']);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->setCellValue('G' . $row, $lista['edad']);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->setCellValue('H' . $row, $lista['genero']);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->setCellValue('I' . $row, $lista['tipo']);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->setCellValue('J' . $row, $lista['correo']);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->setCellValue('K' . $row, $lista['estado_civil']);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->setCellValue('L' . $row, $lista['canton']);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->setCellValue('M' . $row, $lista['direccion']);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->setCellValue('N' . $row, $lista['nombre_sede']);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->setCellValue('O' . $row, $lista['telefono']);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $row++;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Lista de Usuarios.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}


function get_jovenes($jovenes, $tableHead,$drawing)
{

    $spreadsheet = new Spreadsheet();
    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(10);
    $sheet = $spreadsheet->getActiveSheet();
    $drawing->setWorksheet($sheet);
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()
        ->setCellValue('B1', "Lista de Jovenes Voluntarios");

    //merge heading
    $spreadsheet->getActiveSheet()->mergeCells("B1:I2");

    // set font style
    $spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);

    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    $file = file_get_contents('data_joven.json');
    $data = json_decode($file, true);
    foreach ($data as $list) {
        $sheet->setCellValue($list['position'] . '3', $list['name']);
        $sheet->getColumnDimension($list['position'])->setAutoSize(true);
    }
    $spreadsheet->getActiveSheet()->getStyle('B3:V3')->applyFromArray($tableHead);

    $row = 4;
    foreach ($jovenes->get_jovenes() as $lista) {
        $sheet->setCellValue('B' . $row, $lista['nombre']);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->setCellValue('C' . $row, $lista['primer_apellido']);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('D' . $row, $lista['segundo_apellido']);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->setCellValue('E' . $row, $lista['cedula']);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue('F' . $row, $lista['fecha_nacimiento']);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->setCellValue('G' . $row, $lista['edad']);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->setCellValue('H' . $row, $lista['genero']);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->setCellValue('I' . $row, $lista['estado']);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->setCellValue('J' . $row, $lista['estado_civil']);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->setCellValue('K' . $row, $lista['cant_miembros']);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        if ($lista['ayuda_social'] == 0) {
            $sheet->setCellValue('L' . $row, 'No');
        } else {
            $sheet->setCellValue('L' . $row, 'Si');
        }
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->setCellValue('M' . $row, $lista['provincia']);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->setCellValue('N' . $row, $lista['canton']);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->setCellValue('O' . $row, $lista['distrito']);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->setCellValue('P' . $row, $lista['direccion']);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->setCellValue('Q' . $row, $lista['fecha_registro']);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->setCellValue('R' . $row, $lista['generacion']);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->setCellValue('S' . $row, $lista['nombre_sede']);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->setCellValue('T' . $row, $lista['telefono']);
        $sheet->getColumnDimension('T')->setAutoSize(true);
        $sheet->setCellValue('U' . $row, $lista['nombre_familiar']);
        $sheet->getColumnDimension('U')->setAutoSize(true);
        $sheet->setCellValue('V' . $row, $lista['telefono_familiar']);
        $sheet->getColumnDimension('V')->setAutoSize(true);
        $row++;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Lista de voluntarios.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}
