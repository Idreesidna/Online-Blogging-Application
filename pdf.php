<?php 
require_once "connection.php";

require_once 'fpdf/fpdf.php';

$fpdf = new fpdf();
$fpdf->addpage();
	$fpdf->setfillcolor(252, 3, 7);
	$fpdf->setfont('Arial','B',20);
	$fpdf->setdrawcolor(0,0,0);
	$fpdf->setfont('Arial','',15);
		$fpdf->ln(10);
	//$fpdf->cell(160,10,'Heading','LTB',0,'C');
	 $fpdf->cell(190,20,' Registeration Data ',1,8,'C');
	//$fpdf->image('index.png',155,44,50,65,);
	$fpdf->settextcolor(0, 0, 0);/*
	$name=$_SESSION['first_name'];
	//$u_address=$_REQUEST['u_address'];
	$last_name=$_SESSION['last_name'];
	$user_email= $_SESSION['email'];
	$user_password=$_SESSION['password'];
	$date_birth=$_SESSION['date_of_birth'];*/
			//$fpdf->addpage();
			$fpdf->setfont('Times','BU',25);
	//fpdf->cell(190,10,''.$fpdf->pageno().' ','LRTB',1,'C');

			$fpdf->setfont('Arial','',15);
			$fpdf->ln(5);
				$fpdf->multicell(180,8, 'Name : '.$_SESSION['first_name']);

			//$fpdf->multicell(190,5,  'name:'.$name,6,5,'C');
			$fpdf->multicell(190,5, 'last_name : ' .$_SESSION['last_name']);
			$fpdf->multicell(190,5,'Email : '  .$_SESSION['email']);
			$fpdf->multicell(190,5, 'Password : '.$_SESSION['password']);
			// $fpdf->multicell(190,5, 'Password : ' .$user_password);
			$fpdf->multicell(190,5, 'Date_birth : ' .$_SESSION['date_of_birth']);
	
	
	$fpdf->output(); die();


 ?>