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
            <th>جۆری دراو</th>
            <th scope="col">نرخی فرۆشتن</th>
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

$sales = show(" SELECT * FROM sale WHERE customer_id=$user_id AND `status`=-1");
foreach ($sales as $sale) {
$id = $sale['id'];
$customer_id = $sale['customer_id'];
$driver_id = $sale['driver_id'];
$num = $sale['num'];
$cost_t = $sale['cost_t'];
$cost_co = $sale['cost_co'];
$cost_wasl = $sale['cost_wasl'];
$type = $sale['type'];
$cost_mawa = $cost_co-$cost_wasl;
$place = $sale['place'];
$discount = $sale['discount'];
$date = $sale['date'];
$unit = $sale['unit'];
$per=$sale['percentage'];
$product_name=$sale['name_product'];
$sale_type=$sale['sale_type'];

//   koy gshty
$sum_wasl=$sum_wasl+$cost_wasl;
$sum_maway_peshw=$sum_maway_peshw+$cost_mawa;
$sum_gshty=$sum_gshty+$cost_co;
$sum_discount+=$discount;




//   $getdealer = getdata(" SELECT * FROM customer WHERE id='$customer_id' ");
//   $dealer_name = $getdealer['name'];



?>
        <tr>
            <td>
            <?php 
            $sale_type_name='';
            if ($sale_type=="qa3a") {
                $sale_type_name='ئەشیای ناو قاعە';
                echo $sale_type_name."<br>";
                echo $product_name;
            }

            if ($sale_type=="asn") {
                echo 'ئاسن';
            }

            if ($sale_type=="helka") {
                echo 'هێلکە';
            }

            if ($sale_type=="3alaf") {
                echo 'عەلەف';
            }

            
            
            ?> 

            


            </td>
            <td><?=$date?></td>
            <td>
                <?=$num?> <?=$unit?>
                <?php
                if ($sale_type=="3alaf") {
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
           <td><?=$currency_type;?></td>
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
        <form method="post" action="customer_detail.php?id=<?=$user_id?>">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="userId" value="<?=$user_id?>">
            <button type="submit" name="delete_return_sale" class="btn btn-danger" > <i class="fas fa-trash"></i> سڕینەوە</button>
        </form>   
       </td>
       <?php }?>
        
        </tr>
        <?php } ?>
        <!-- <tr class="bg-dark text-white">
            <td class="bg-dark text-white">کۆی گشتی</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?=$sum_wasl?></td>
            <td><?=$sum_discount?></td>
            <td><?=$sum_gshty?></td>
            <td><?=$sum_maway_peshw?></td>
            <td></td>
            <td></td>

        </tr> -->
    </tbody>
</table>

</div>