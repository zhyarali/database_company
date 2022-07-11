<?php require_once('header.php'); ?>

<?php 
$client_id=$_GET['client_id'];
$clients = countdata(" SELECT * FROM client WHERE `id`=$client_id");
$data = show(" SELECT * FROM client WHERE `id`=$client_id");

if (empty($data)) {
  direct('index.php');
}else{


foreach ($data as $client) {
    $id = $client['id'];
    $name = $client['name'];
    $image = $client['image'];
    $phone = $client['phone'];
    $date = $client['date_start'];
    $work_place = $client['work_place'];
    $status = $client['status'];
    $bry_para=$client['bry_para'];
    $currency_type=$client['currency_type'];
    $budget_month=$client['budget_month'];

    if ($currency_type=='dinar') {
      $currency_type='دینار';
    }
  
    if ($currency_type=='dollar') {
      $currency_type='دۆلار';
    }
  
    if ($currency_type=='tman') {
      $currency_type='تمەن';
    }


$get_teams=getdata("SELECT * FROM teams WHERE id= '$work_place'");

$team_name='';
if ($get_teams==null) {
  $team_name=$work_place;
}else{
  $team_name='ستافی '.$get_teams['name'];
}


  if (isset($client_id) && $client_id!=3) {
  
      if ($status==0) {
          include_once("client_monthly.php");
      } else{
         include_once("client_daily.php");
      }

      require_once('footer.php');

  }else{
     direct('index.php');
  }

}

}

?>





<?php
 if (isset($_SESSION["edit_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە  گۆڕانکاری لەزانیارییەکان کرا ','success');
     unset($_SESSION["edit_success"]);
 }

 if (isset($_SESSION["add_success"])) {
    msg('سەرکەتووبوو','سەرکەوتووانە زانیارییەکان تۆمارکرا ','success');
     unset($_SESSION["add_success"]);
 }

 if (isset($_SESSION["delete"])) {
    msg('ئاگاداری','سەرکەوتووانە سڕایەوە ','warning');
    unset($_SESSION["delete"]);
 }

 
 ?>
 




<?php 

//  edit clients info
if (post('edit_client')) {
  $id = secure($_POST['id']);
  $name = secure($_POST['name']);
  $image =upload('image','../assets/img/client/');
  $phone = secure($_POST['phone']);
  $work_place = secure($_POST['work_place']);
  $status = secure($_POST['status']);
  $bry_para=secure($_POST['bry_para']);
  $currency_type=secure($_POST['currency_type']);
  if (empty($bry_para)) {
    $bry_para="0";
  }

  if ($image!=null) {
    $get = getdata(" SELECT * FROM client WHERE id='$id'");
    $oldavatar = $get['image'];
    unlink('../assets/img/client/'.$oldavatar);
    execute(" UPDATE client SET `name`='$name',`image`='$image',`phone`='$phone',`work_place`='$work_place',`bry_para`='$bry_para',`status`='$status',`currency_type`='$currency_type' WHERE id='$id'");
    $_SESSION["add_success"] = "";
    direct("view_client.php?client_id=$id"); 
  }else{
    execute(" UPDATE client SET `name`='$name',`phone`='$phone',`work_place`='$work_place',`bry_para`='$bry_para',`status`='$status',`currency_type`='$currency_type' WHERE id='$id'");
    $_SESSION["add_success"] = "";
    direct("view_client.php?client_id=$id"); 
  }


}





// edit

// edit budget month

if (post('edit_budget_month')) {
    $id=secure($_POST['id']);
    $budget = secure($_POST['budget']);
    $debt = secure($_POST['debt']);
    $date_debt = secure($_POST['date_debt']);
    $punish = secure($_POST['punish']);
    $reward = secure($_POST['reward']);
    $work_for = secure($_POST['work_for']);

    if (empty($reward)) {
      $reward=0;
    }
    
    if (empty($punish)) {
      $punish=0;
    }
    


    $sql=execute("UPDATE `budget` SET `budget_amount`='$budget',`punish`='$punish',`reward`='$reward',`work_for`='$work_for' WHERE id_budget = '$id'");

    $_SESSION["edit_success"] = "";
    $loc="view_client.php?client_id=".$client_id;
   direct($loc); 

}


// edit budget daily

if (post('edit_budget_daily')) {
  $id=secure($_POST['id']);
  $client_id=$_GET['client_id'];
  $work_hour = secure($_POST['work_hour']);
  $work_hour_amount = secure($_POST['work_hour_amount']);
  $work_extra = secure($_POST['work_extra']);
  $punish = secure($_POST['punish']);
  $work_for = secure($_POST['work_for']);
  $reward = secure($_POST['reward']);
  

  if (empty($reward)) {
    $reward=0;
  }
  
  if (empty($work_extra)) {
    $work_extra=0;
  }
  
  if (empty($punish)) {
    $punish=0;
  }
  
  // static  calculation  >>> the hour of working daily is 10 and static
  $work_hour_amount=$bry_para/10; 
  
  $all_hour=$work_hour+$work_extra; 
  $budget=$work_hour_amount*$all_hour;
  $budget=(int)$budget+$reward;
  $budget=$budget-$punish;


  $sql=execute("UPDATE `work_daily` SET `work_hour`='$work_hour',`work_hour_amount`='$work_hour_amount',`work_extra`='$work_extra',`budget`='$budget',`punish`='$punish',`reward`='$reward',`work_for`='$work_for' WHERE id_daily = '$id'");

  $_SESSION["edit_success"] = "";
  $loc="view_client.php?client_id=".$client_id;
  direct($loc); 

}



// edit debt monthly

if (post('edit_debt_month')) {
   $client_id=$_GET['client_id'];
   $id = secure($_POST['id']);
    $debt_amount = secure($_POST['debt_amount']);
    $date_debt_start = secure($_POST['date_debt_start']);
    $date_num=secure($_POST['date_end']);
    $date_debt_end=date('Y-m-d', strtotime($date_debt_start. ' + '.$date_num.' days'));
    $gerawa = secure($_POST['gerawa']);
    $mawa=$debt_amount-$gerawa;


  $sql=execute("UPDATE `debt` SET `debt_amount`='$debt_amount',`date_start`='$date_debt_start',`date_end`='$date_debt_end',`gerawa`='$gerawa',`mawa`='$mawa' WHERE id_debt = '$id'");
  $_SESSION["edit_success"] = "";
  $loc="view_client.php?client_id=".$client_id;
 direct($loc); 


}



// delete

// delete month

if (post('del_budget_month')) {
    $id = secure($_POST['id']);
    $sql = execute(" DELETE  FROM budget WHERE id_budget = '$id'");
    $_SESSION["delete"] = "";
    $loc="view_client.php?client_id=".$client_id;
    direct($loc); 
    
}


// delete daily

if (post('del_budget_daily')) {
  $id = secure($_POST['id']);
  $sql = execute(" DELETE  FROM work_daily WHERE id_daily = '$id'");
  $_SESSION["delete"] = "";
  $loc="view_client.php?client_id=".$client_id;
  direct($loc); 
  
}


// delete debt
if (post('del_debt_month')) {
  $id = secure($_POST['id']);
  $sql = execute("DELETE FROM debt WHERE id_debt = '$id'");
  $_SESSION["delete"] = "";
  $loc="view_client.php?client_id=".$client_id;
  direct($loc); 
  
}







// add

// add mangana

if (post('add_budget_month')) {
    $client_id=$_GET['client_id'];
    $budget = secure($_POST['budget']);
    $debt = secure($_POST['debt']);
    $date_budget = secure($_POST['date_budget']);
    $date_debt = secure($_POST['date_debt']);
    $punish = secure($_POST['punish']);

    $date_end=date('Y-m-d', strtotime($date_debt. ' + 28 days'));

  $sql = execute("INSERT INTO `budget` (`budget_amount`,`punish`,`date`,`clientid`) VALUES('$budget','$punish','$date_budget','$client_id')");
//  $result=mysqli_query($conn,$sql);
//  if ($result) {
//     $last_id= mysqli_insert_id($conn);
//     $sql = execute("INSERT INTO `debt` (`debt_amount`,`date_start`,`date_end`,`budgetid`,`clientid`) VALUES('$debt','$date_debt','$date_end','$last_id','$client_id')");
//  }

  $_SESSION["add_success"] = "";
    $loc="view_client.php?client_id=".$client_id;
   direct($loc);

}



// add rozhana

if (post('add_budget_daily')) {
  $client_id=$_GET['client_id'];
  $work_hour = secure($_POST['work_hour']);
  $work_hour_amount = secure($_POST['work_hour_amount']);
  $work_extra = secure($_POST['work_extra']);
  $date = secure($_POST['date']);
  $punish = secure($_POST['punish']);
  
  // calculate budget
  $all_hour=$work_hour+$work_extra;
  $budget=$work_hour_amount*$all_hour;
  $budget=$budget-$punish;


  $sql = execute("INSERT INTO `work_daily` (`work_hour`,`work_hour_amount`,`work_extra`,`budget`,`punish`,`date`,`clientid`) VALUES('$work_hour','$work_hour_amount','$work_extra','$budget','$punish','$date','$client_id')");

  $_SESSION["add_success"] = "";
  $loc="view_client.php?client_id=".$client_id;
  direct($loc);

}


// add debt month

if (post('add_debt_month')) {
    $client_id=$_GET['client_id'];
    $debt_amount = secure($_POST['debt_amount']);
    $date_debt_start = secure($_POST['date_debt_start']);
    $date_num=secure($_POST['date_end']);
    $date_debt_end=date('Y-m-d', strtotime($date_debt_start. ' + '.$date_num.' days'));
   

    $client=getdata(" SELECT * FROM client WHERE id=$client_id");

      $name = $client['name'];
      $phone = $client['phone'];


  $sql = execute("INSERT INTO `debt` (`debt_amount`,`date_start`,`date_end`,`gerawa`,`mawa`,`clientid`,`name`,`phone`) VALUES('$debt_amount','$date_debt_start','$date_debt_end','0','$debt_amount','$client_id','$name','$phone')");

  $_SESSION["add_success"] = "";
    $loc="view_client.php?client_id=".$client_id;
   direct($loc);



}


?>
