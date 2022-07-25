<div class="row col-lg-12 col-12 m-auto p-4 table-responsive">

<table class="table table-bordered text-center" style="zoom:80%">
    <!-- <caption>List of users</caption> -->
    <thead>
        <tr>
            <th scope="col">ناوی شتوومەک</th>
            <th scope="col">بەروار</th>
            <th scope="col">بڕ</th>
            <th scope="col">جۆر</th>
            <th scope="col">شوێن</th>
            <th scope="col">جۆری دراو</th>
            <th scope="col">نرخی تاک</th>
            <th scope="col">نرخی واسڵکراو</th>
            <th scope="col">نرخی داشکاندن</th>
            <th scope="col">نرخی گشتی</th>
            <th scope="col">نرخی ماوە</th>                   
            <th scope="col">شۆفێر</th>
            <?php if($is_admin == "1") {?>   
             <th scope="col"><i class="fas fa-trash"></i> سڕینەوە</th>
             <?php }?>

        </tr>
    </thead>
    <tbody>



    
<?php 
$sum_wasl=0;
$sum_discount=0;
$sum_gshty=0;
$sum_mawa=0;
$sum_maway_peshw=0;

$buys = show(" SELECT * FROM buy WHERE dealer_id=$user_id AND `status`=-1");





foreach ($buys as $buy) {
$id = $buy['id'];
$dealer_id = $buy['dealer_id'];
$driver_id = $buy['driver_id'];
$num = $buy['num'];
$cost_t = $buy['cost_t'];
$cost_co = $buy['cost_co'];
$cost_wasl = $buy['cost_wasl'];
$type = $buy['type'];

$cost_mawa = $cost_co-$cost_wasl;

$place = $buy['place'];
$cost_froshtn = $buy['cost_fr'];
$discount = $buy['discount'];
$date = $buy['date'];
$unit = $buy['unit'];
$per=$buy['percentage'];
$product_name=$buy['name_product'];
$buy_type=$buy['buy_type'];

//   koy gshty
$sum_wasl=$sum_wasl+$cost_wasl;
$sum_maway_peshw=$sum_maway_peshw+$cost_mawa;
$sum_gshty=$sum_gshty+$cost_co;
$sum_discount+=$discount;
?>


    

        <tr>
            <td>
            <?php 
            $buy_type_name='';
            if ($buy_type=="qa3a") {
                $buy_type_name='ئەشیای ناو قاعە';
                echo $buy_type_name."<br>";
                echo $product_name;}

            if ($buy_type=="asn") {echo 'ئاسن';}

            if ($buy_type=="helka") {echo 'هێلکە';}

            if ($buy_type=="3alaf") {echo 'عەلەف';}
            ?> 
            </td>
            <td><?=$date?></td>
            <td>
                <?=$num?> <?=$unit?>
                <?php
                if ($buy_type=="3alaf") {
                    echo "<br>".$per." کیلۆگرام";
                }
                ?>
            </td>
            <td><?=$type?></td>
            <td>
                <?php
                    if (!empty($place)) {
                        echo $place;
                    }else{
                        echo "-";
                    }
                ?>
           </td>
           <td><?=$currency_type?></td>
            <td><?=$cost_t?></td>
            <td><?=$cost_wasl?></td>
            <td><?=$discount?></td>
            <td><?=$cost_co?></td>
            <td><?=$cost_mawa?></td>
            <td class="driver-info">
                <?php
                if ($driver_id!=0) {
                    $getdriver = getdata(" SELECT * FROM drivers WHERE id='$driver_id' ");
                    $driver_name = $getdriver['name'];
                    $driver_phone = $getdriver['phone'];
                    $driver_car_number = $getdriver['car_number'];
                    echo "<span>$driver_name</span>"."<br>";
                    echo $driver_car_number."<br>";
                    echo $driver_phone."<br>";
                }else{
                    echo "-";
                }
                
                ?>
            </td>
      
            <?php if($is_admin == "1") {?>  
            <td> 
        <form method="post" action="dealer_detail.php?id=<?=$user_id?>">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="userId" value="<?=$user_id?>">
            <button type="submit" name="delete_return_buy" class="btn btn-danger" > <i class="fas fa-trash"></i> سڕینەوە</button>
        </form>   
       </td>
       <?php }?>
    
        </tr>
        <?php } ?>

        
    </tbody>
</table>

<?php 
$buys= show(" SELECT * FROM buy WHERE dealer_id=$user_id AND `status`=-1");

if(empty($buys)){ ?>
    
 <div class="d-flex justify-content-center mt-5">
    <h4>هیچ گەڕاندنەوەیەکی کڕین نییە</h4>
 </div>   

<?php    
}

?>

</div>