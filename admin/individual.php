<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/11/2019
 * Time: 22:26
 */

require_once '../file_pdf/fpdf.php';
class Reports extends FPDF


{

    /*
     * ticket header
     *
     */
    public function SetTitle($title, $isUTF8=false)
    {
        // Title of document
        $this->metadata['Title'] = $isUTF8 ? $title : utf8_encode($title);
        $this->setCreator("Collins Jumah");
        $this->setAuthor("CollyneJumah");
        $this->setTitle('Kisiipoly Course Applicants');
        $this->setSubject('info@kisiipoly.ac.ke');
        $this->setKeywords('kisiipoly');
        $this->Close();
    }
    public function Header()

    {


//        $this= new FPDF('P','mm','A4');
        $this->SetAutoPageBreak(true,'0');
        // set image scale factor

        $this->Image('../image/knp.jpg', 90, 5, 40, 40);
//        $this->Image('../images/CatholicLogo.jpg', 170, 5, 25, 25);
        $this->Ln(15);
        $this->SetFont('Times','b','13');
        $this->Ln(5);
        $this->Cell(0,45,'Kisii National Polytechnic course Applicants',0,'1','C');



//        $this->Ln(0);
////        $this->Cell(0, 15, "Kisii University", 0, 0, 'C');
//        $this->Ln(10);
//        $this->Cell(0, 15, "Kayati SDA Church Kisii", 0, 0, 'C');

//        $this->Cell(180, 10, "Church Members List", 0, 1, 'C');
        $this->Ln(0);
        $this->SetFont('Times','I',11);
        $this->SetTextColor(25,24,33);
        $this->Cell(0,0,'Total Applicants:....................................');
        // $this->Ln(18);
        $this->SetFont('Times', '', 10);
        $this->Ln(5);
        $this->setTextColor(255,255,255);
        $this->Cell(10, 5, "#", 1, 0, 'L',true,'0');
        $this->Cell(30, 5, "Surname:", 1, 0, 'L',true);
        $this->Cell(30, 5, "Other name:", 1, 0, 'R',true);
        $this->Cell(40, 5, "Course", 1, 0, 'C',true);
        $this->Cell(30, 5, "phone:", 1, 0, 'L',true);
        $this->Cell(20, 5, "Email:", 1, 0, 'L',true);
        $this->Cell(40, 5, "Study Mode:", 1, 0, 'R',true);
        $this->Ln();


    }
    public function Footer()
    {
        $this->SetY(-10);
        $this->SetFontSize( 8);
        $this->AliasNbPages('{pages}');
        $this->SetTextColor(255,255,255);
        $this->Cell(45,10,"info@kisiipoly.co.ke",0,0,'L',true);
        $this->Cell(0, 10, 'Page '. $this->PageNo().'/{pages}', 0,0, 'C',true);

    }

    public function body($conn)
    {

        $this->AddPage();
        $this->SetFont('Times', '', 10);
        $count=1;
        $query=mysqli_query($conn,"select * from knp_data ORDER BY id ASC");

        while($row=mysqli_fetch_array($query)){

            $this->Cell(10, 5, $count, 0, 0, 'L',false);
            $this->Cell(30, 5, $row['surname'], 0, 0, 'L');
            $this->Cell(40, 5, $row['otherName'], 0, 0, 'L');
            $this->Cell(30, 5, $row['course'], 0, 0, 'L');
            $this->Cell(30, 5, $row['phone'], 0, 0, 'L');
            $this->Cell(20, 5, $row['email'], 0, 0, 'L');
            $this->Cell(40, 5,$row['studyMode'], 0, 1, 'R');

//            $this->Cell(30, 10,$row['ssu'], 0, 1, 'L');

            $count+=1;
        }



//
//        $this->SetY(-15);
//        $this->SetFont('Arial',8);
//        $this->Cell(0,10,'page'.$this->PageNo(),0,0,'C');
    }


}


require_once ('connection.php');
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$report=new Reports();

$report->body($conn);

$report->Output();