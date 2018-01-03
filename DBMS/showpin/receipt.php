<?php 
$seller = $_GET['seller'];
$qty = $_GET['qty'];
$tot = $_GET['tot'];
$time = $_GET['time'];
$date = $_GET['date'];

 if(isset($_POST["create_pdf"]))  
 {  

      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage(); 
      $img = file_get_contents('http://example.com/wp-content/themes/example/map_image_leasing.php/?city=Calgary&suit_type=&min_area=&max_area=');

      $obj_pdf->Image('../images/Travel/tavel1.jpg', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false); 
      $content = '';  
      $content .= '  
      <h3 align="center">Thanks for shopping on Pinstagram!</h3><br /><br />  
     
      <p align="center"><b>Seller</b> :'.$seller.'</p><p align="center"><b>Quantity of item</b> : '.$qty.' </p><p align="center"><b>Total price paid</b> : '.$tot.' Rupees</p>
      <p align="center"><b>Date</b> : '.$date.'</p><p align="center"><b>Time</b> : '.$time.'</p>  
      ';  
      // $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content); 
      ob_end_clean(); 
      $obj_pdf->Output('sample.pdf', 'I');  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Receipt Preview</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>         
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  

<div class="row">
<div class="col-xs-3"></div>  

<div class="col-xs-6"><h3 align="center">Thanks for shopping on Pinstagram!</h3><br />  
   <br />  
           <form method="post">  
            <p align="center"><input type="submit" name="create_pdf" class="btn btn-primary" value="Generate Receipt" /></p>
                                          </form></div>  
                  </div> 
                  <div class="col-xs-3"></div>                 
           </div>  
      </body>  
 </html>  