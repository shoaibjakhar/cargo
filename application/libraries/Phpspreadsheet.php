<?php
require 'PhpSpreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Writer\Html;
use \PhpOffice\PhpSpreadsheet\Style\Alignment;
use \PhpOffice\PhpSpreadsheet\Style\Borders;
use \PhpOffice\PhpSpreadsheet\Style\Style;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
// use \PhpOffice\PhpWord\Settings::setZipClass(\PhpOffice\PhpWord\Settings::PCLZIP);
// use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
class Phpspreadsheet{
  private $spreadsheet;
  private $sheet;
  public function __construct() {
    $this->spreadsheet = new Spreadsheet();
    $this->sheet = $this->spreadsheet->getActiveSheet();
  }
  public function getInstance(){
    return $this->sheet;
  }
  public function getHTMLHelper() {
    return $this->html_helper;
  }
  public function setCellValue($cell, $value) {
    $this->sheet->setCellValue($cell, $value);
    $letters=range('A','Z');
    $letters[26]='AA';
    $letters[27]='AB';
    $letters[28]='AC';
    $letters[29]='AD';
    $letters[30]='AE';
    $letters[31]='AF';
    $letters[32]='AG';
    $letters[33]='AH';
    $letters[34]='AI';
    $letters[35]='AJ';
    $letters[36]='AK';
    $letters[37]='AL';
    $letters[38]='AM';
    $letters[39]='AN';
    $letters[40]='AO';
    $letters[41]='AP';
    $letters[42]='AQ';
    $letters[43]='AR';
    $letters[44]='AS';
    $letters[45]='AT';
    $letters[46]='AU';
    $letters[47]='AV';
    $letters[48]='AW';
    $letters[49]='AX';
    $letters[50]='AY';
    $letters[51]='AZ';

    $letters[52]='BA';
    $letters[53]='BB';
    $letters[54]='BC';
    $letters[55]='BD';
    $letters[56]='BE';
    $letters[57]='BF';
    $letters[58]='BG';
    $letters[59]='BH';
    $letters[60]='BI';
    $letters[61]='BJ';
    $letters[62]='BK';
    $letters[63]='BL';
    $letters[64]='BM';
    $letters[65]='BN';
    $letters[66]='BO';
    $letters[67]='BP';
    $letters[68]='BQ';
    $letters[69]='BR';
    $letters[70]='BS';
    $letters[71]='BT';
    $letters[72]='BU';
    $letters[73]='BV';
    $letters[74]='BW';
    $letters[75]='BX';
    $letters[76]='BY';
    $letters[77]='BZ';

    $letters[78]='CA';
    $letters[79]='CB';
    $letters[80]='CC';
    $letters[81]='CD';
    $letters[82]='CE';
    $letters[83]='CF';
    $letters[84]='CG';
    $letters[85]='CH';
    $letters[86]='CI';
    $letters[87]='CJ';
    $letters[88]='CK';
    $letters[89]='CL';
    $letters[90]='CM';
    $letters[91]='CN';
    $letters[92]='CO';
    $letters[93]='CP';
    $letters[94]='CQ';
    $letters[95]='CR';
    $letters[96]='CS';
    $letters[97]='CT';
    $letters[98]='CU';
    $letters[99]='CV';
    $letters[100]='CW';
    $letters[101]='CX';
    $letters[102]='CY';
    $letters[103]='CZ';

    $letters[104]='DA';
    $letters[105]='DB';
    $letters[106]='DC';
    $letters[107]='DD';
    $letters[108]='DE';
    $letters[109]='DF';
    $letters[110]='DG';
    $letters[111]='DH';
    $letters[112]='DI';
    $letters[113]='DJ';
    $letters[114]='DK';
    $letters[115]='DL';
    $letters[116]='DM';
    $letters[117]='DN';
    $letters[118]='DO';
    $letters[119]='DP';
    $letters[120]='DQ';
    $letters[130]='DR';
    $letters[131]='DS';
    $letters[132]='DT';
    $letters[133]='DU';
    $letters[134]='DV';
    $letters[135]='DW';
    $letters[136]='DX';
    $letters[137]='DY';
    $letters[138]='DZ';

    $letters[139]='EA';
    $letters[140]='EB';
    $letters[141]='EC';
    $letters[142]='ED';
    $letters[143]='EE';
    $letters[144]='EF';
    $letters[145]='EG';
    $letters[146]='EH';
    $letters[147]='EI';
    $letters[149]='EJ';
    $letters[150]='EK';
    $letters[151]='EL';
    $letters[152]='EM';
    $letters[153]='EN';
    $letters[154]='EO';
    $letters[155]='EP';
    $letters[156]='EQ';
    $letters[157]='ER';
    $letters[158]='ES';
    $letters[159]='ET';
    $letters[160]='EU';
    $letters[161]='EV';
    $letters[162]='EW';
    $letters[163]='EX';
    $letters[164]='EY';
    $letters[165]='EZ';
    $number='1';
    foreach ($letters as $key => $value) {
      $this->sheet->getStyle($value.''.$number)->getFont()->setBold(true);
    }
  }
  public function merge($merge){
    $this->sheet->mergeCells($merge);
  }
    public function readHtml($view){
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->load($view);
    }
    public function default_style(){
      $this->spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
      $this->spreadsheet->getDefaultStyle()->getFont()->setSize(10);
      
    }
    public function styleRotate($coltext){
      $style= new \PhpOffice\PhpSpreadsheet\Style\Fill();
      $spreadsheet=$style->setRotation($coltext,270);
    }
    public function textAlign($col){
      $text=new \PhpOffice\PhpSpreadsheet\Style\Style();
      $spreadsheet=$text->getAlignment($col,'center');
    }
  public function saveFileXml($file_path) {
      $writer = new Xlsx($this->spreadsheet);
      $writer->save($file_path);
      if(file_exists($file_path)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file_path));
          flush(); // Flush system output buffer
          readfile($file_path);
          exit;
      }
  }
  public function readExcel($file_path=null,$extension=null){
    if($file_path!=null){
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($file_path);
        // debug($spreadsheet);
        return $spreadsheet;
        // $sheetData = $spreadsheet->getActiveSheet()->toArray();
        // return $sheetData;
    }
  }
}
?>