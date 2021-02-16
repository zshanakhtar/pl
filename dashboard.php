<?php
$canvas_heading='Dashboard - Feedback and Grievance Management System';
session_start();
if(!isset($_SESSION['usertype'])) { // if already login
  header("location: index.php");
}
else{
    extract($_SESSION);
    $nav_type='login';
    if($usertype=='a')
    {
        $menu_heading="Administrator";
        $menu_items=array('approve'=>'Approve Users','accesscode'=>'Generate Access Code','create'=>'Create New User');
        $canvas_paint=$usertype.'/approve.php';
    }
    else if($usertype=='s')
    {
        $menu_heading="Student";
        $menu_items=array('feedback'=>'Feedback','past'=>'Past Feedback');
        $canvas_paint=$usertype.'/feedback.php';
    }
    else if($usertype=='t')
    {
        $menu_heading="Faculty";
        $menu_items=array('feedback'=>'View Feedback','past'=>'View Past Feedback');
        $canvas_paint=$usertype.'/feedback.php';
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Feedback Portal - Mark, Analyse and Review Feedbacks and Grievances</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Validator   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script> 

<!-- universal css -->
<link rel="stylesheet" href="css/universal.css">
<!-- index css -->
<link rel="stylesheet" href="css/index.css">

<!-- universal js -->
<script src="js/universal.js"></script>
<!-- index js -->
<script src="js/index.js"></script>
</head>
<?php
include "php-back/"."connection.php"; //connect the connection page

?>
<body>

<?php
  include 'php-front/ajaxloader.php';
  
  include 'php-front/nav/'.$nav_type.'.php';
  include 'php-front/canvaspainter.php';
  include 'php-front/footer.php'; 
?>
<script>
$( '.z-menubar' ).fragmentLoader();
</script>
</body>
</html>

