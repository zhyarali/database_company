<?php 
require_once("header.php")
?>


<style>
     .currency-row-outer {
     display: flex;
     align-items: center;
     justify-content: center;
     height: 100%
 }

 .currency-converter {
     width: 100%;
     max-width: 480px;
     text-align: center
 }

 input,
 select {
     color: #363636;
     font-size: 1rem;
     height: 2.3em;
     border-radius: 4px;
     max-width: 100%;
     width: calc(100% - 15px);
     margin: auto;
     outline: 0;
     background: #fff;
     border-color: #dbdbdb;
     padding-left: 15px;
     border: 1px solid #00000057;
     box-shadow: inset 0 0.0625em 0.125em rgb(10 10 10 / 5%);
     -webkit-appearance: none
 }

 .field.grid-50-50 {
     display: grid;
     grid-template-columns: 1fr 1fr;
     grid-gap: 15px
 }

 .currency-converter .colmun {
     margin-bottom: 15px
 }

 select.currency {
     border-color: #3273dc;
     width: 100%;
     height: 100%;
     cursor: pointer;
     font-size: 1em;
     max-width: 100%;
     outline: 0;
     display: block
 }

 .currency-converter .select {
     position: relative;
     height: 100%
 }

 h2 {
     padding-bottom: 30px
 }

 .currency-converter .select:after {
     transform: rotate(-45deg);
     transform-origin: center;
     content: "";
     border: 3px solid rgba(0, 0, 0, 0);
     border-radius: 2px;
     border-top: 0;
     border-right: 0;
     display: block;
     height: 0.525em;
     width: 0.525em;
     z-index: 4;
     position: absolute;
     top: 50%;
     right: 1.125em;
     margin-top: -0.4375em
 }

 .select:not(:hover)::after {
     border-color: #3273dc
 }

 .select:hover::after {
     border-color: #363636
 }
</style>

  <div class="currency-row-outer" dir="ltr">
  <form method="post" >
        <div class="currency-converter">
            <h2>Currency Converter</h2>
            <div class="field grid-50-50">
                <div class="colmun col-left"> <input type="number" name="input-num" class="form-input" id="input" placeholder="00000"> </div>
                <div class="colmun col-right">
                    <div class="select">
                         <select name="convert_from" class="currency">
                            <option  value="USD">USD</option>
                            <option  value="IQD">IQD</option>
                            <option  value="IRR">IRR</option>
                         </select>
                    </div>

                </div>
            </div>

            <div class="field grid-50-50">
                <div class="colmun col-left"> <input type="text" name="output-num" class="form-input" id="output" placeholder="00000" disabled> </div>
                <div class="colmun col-right">
                <div class="select">
                         <select name="convert_to" class="currency">
                            <option  value="USD">USD</option>
                            <option  value="IQD">IQD</option>
                            <option  value="IRR">IRR</option>
                         </select>
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" name="convert_currency" value="Convert Currency">

</form>
    </div>

    


    <?php
function currency_converter($from,$to,$input)
{

// gar paraka USD Bw
 if ($from=='USD') {
     if ($to=='USD') {
         $response=$input;
     }
     if ($to=='IQD') {
         $stable=1460.25;
         $response=(float)$input*(float)$stable;
    }
    if ($from=='IRR') {
     
    }
 }


 // gar paraka IQD Bw

 if ($from=='IQD') {
    if ($to=='USD') {
         
    }
    if ($to=='IQD') {
        
   }
   if ($from=='IRR') {
    
   }
}

// gar paraka IRR Bw

if ($from=='IRR') {
    if ($to=='USD') {
         
    }
    if ($to=='IQD') {
        
   }
   if ($from=='IRR') {
    
   }
}

 return $response;
} 

if(isset($_POST['convert_currency']))
{

 $from=$_POST['convert_from'];
 $to=$_POST['convert_to'];
 $input=$_POST['input-num'];
 
	
 $rawData = currency_converter($from,$to,$input);
 $rawData=number_format($rawData,2);

 echo "<script>
 document.getElementById('output').value = '$rawData'
 document.getElementById('input').value = '$input'</script>
 </script>";
}
?>



    <?php 
require_once("footer.php")
?>