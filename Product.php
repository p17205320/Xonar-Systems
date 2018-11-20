
<?php
include ("setup.php"); include ("connect.php"); 
?>

  <script type="text/javascript">
      // this function sets all the tables for showing compents up for the tablesorter script which allows sorting for those tables.
      $( document ).ready(function() {
          $("#Product_Details_Table_CPU").tablesorter({sortList: [[1,0]]});
          $("#Product_Details_Table_Case").tablesorter({sortList: [[1,0]]});
          $("#Product_Details_Table_GPU").tablesorter({sortList: [[1,0]]});
          $("#Product_Details_Table_Motherboard").tablesorter({sortList: [[1,0]]});
          $("#Product_Details_Table_PSU").tablesorter({sortList: [[1,0]]});
          $("#Product_Details_Table_RAM").tablesorter({sortList: [[1,0]]});
          $("#Product_Details_Table_Storage").tablesorter({sortList: [[1,0]]});
          $(":input").inputmask();
});
        //this function hides all component tables and shows the one being clicked
    function toggle_product(id) {
        var e = document.getElementById(id);
        $("#Product_Details_CPU").slideUp("fast");
        $("#Product_Details_Case").slideUp("fast");
        $("#Product_Details_GPU").slideUp("fast");
        $("#Product_Details_Motherboard").slideUp("fast");
        $("#Product_Details_RAM").slideUp("fast");
        $("#Product_Details_PSU").slideUp("fast");
        $("#Product_Details_Storage").slideUp("fast");
        $(e).slideDown("fast");
        
    
    };
    // these varibles are used to calulate price
                var total = 0;
                var component_price = 0;
                // this function does multiple things. First it changes the name of the corresponding header to the selected item. then it sets the price of the item selected to an attribute called "data-price". The image on the right is faded out, the source is changed tot he one for the option picked and then faded back in.
                //finally it looks at the data-price attribute for all divs with the class .components. looks up the values of data-price for each of them. adds them up. rounds it  down to 2 decimal places and changes the text of the total price to that.
    function change_name(productspan, name, image, price2, product) {
            $(productspan).text(name);
            $(product).attr("data-price", price2)
            $("#productimg img").attr("src",  image);
            total= 0;
            $(".components").each(function () {
            component_price = 0;
            component_price = $(this).attr("data-price");
            component_price = parseFloat(component_price);
            total = total + component_price;
             });
             $("#Total_Price span").text("£" + total.toFixed(2));
        };
       
        
        
        
               
</script>
<title>Xonar Systems - Product Configurator</title>
<body>
<div id = MainContainer>
    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
    <br>
<!--    sets the default image for the right image -->
    <div id = "productimg">
    <img src="images/question-mark_318-52837.jpg" alt="Product"/>
</div>
    <div id = "Product_Contain">
<!--        creates the form for picking components-->
        <form action="Checkout.php"  method="POST">
            <?php 
            
            $socket = filter_input(INPUT_GET, "Socket");
            for( $i = 0; $i<7; $i++ ) {                
                if ($i == 0) {
                $fill = "CPU";
               	$stmt = $con->prepare("SELECT * FROM `product cpu` WHERE Socket = (?)");
                $stmt->bind_param('s', $socket);
                } elseif ( $i == 1 ) {
                    $fill = "GPU";
                    $stmt = $con->prepare("SELECT * FROM `product gpu`");
                } elseif ( $i == 2 ) {
                    $fill = "Motherboard";
                    $stmt = $con->prepare("SELECT * FROM `product motherboard` WHERE Socket = (?)");
                $stmt->bind_param('s', $socket);
                } elseif ( $i == 3 ) {
                    $fill = "RAM";
                    $stmt = $con->prepare("SELECT * FROM `product ram`");
                } elseif ( $i == 4 ) {
                $fill = "Case";
                $stmt = $con->prepare("SELECT * FROM `product case`");
                }elseif ( $i == 5 ) {
                    $fill = "PSU";
                    $stmt = $con->prepare("SELECT * FROM `product psu`");
                }elseif ( $i == 6 ) {
                    $fill = "Storage";
                    $stmt = $con->prepare("SELECT * FROM `product storage`");
                }
                
                $stmt->execute(); 
                $result = $stmt->get_result();
                  
echo <<<END
 <div id = "Product_$fill" class = "components" data-price="0">
        <table border="0">
            <tbody>
                <tr  href="#" onclick="toggle_product('Product_Details_$fill')">
                    <td align="middle" style = "width: 300px; cursor: pointer;"><h1>$fill</h1></td>
                    <td style = "cursor: pointer;" class = 'top_product' align="middle"><p> <span>Empty ▼</span></p></td>
                </tr>
            </tbody>
        </table>
    </div>
        
         <div id = "Product_Details_$fill">
        <table style="    width: auto; margin: auto;" border="0" class="tablesorter" id = "Product_Details_Table_$fill">
        <thead>
<tr>    <th></th>
	<th>Name</th>
        <th></th>
	<th>Price</th>
</tr>
</thead>
            <tbody>
END;
                 while($row = mysqli_fetch_array($result))
            {    
                     $name = $row[Name];
                     $price = $row[Price];
                     $image = $row[Image];
                     $id = $row[Product_ID];
echo <<<END
              <tr>
                    <td style="width: auto;"href="#" align="middle"><input style = "cursor: pointer;" onclick="change_name('#Product_$fill span', '$name', '$image', '$price', '#Product_$fill')" data-price=$price type="radio" name="$fill" value="$id" required/></td>
                    <td>$name</td>
                    <td>£</td>
                    <td>$price</td>
               </tr>
END;
            }
            
echo <<<END
            </tbody>
        </table>
    </div>

END;

            }
            
echo <<<END
            
 <div style = "background-color: #072569" id = "Total_Price">
        <table border="0">
            <tbody>
                <tr>
                    <td align="middle" style = "width: 300px"><h1 style = "color: white">Total Price</h1></td>
                    <td data-price='0' align="middle"><p><span>£0</span></p></td>
                </tr>
            </tbody>
        </table>
    </div>
END;
            ?>

    </div>  
    <input style ="     font-size: xx-large;
    font-family: BebasNeue;
    width: 50%;
    margin: 0px;
    padding: 0px;" type="submit" value="Go to checkout"/>
<p></p>
        <div id="gd-widget-div"></div><script async type="text/javascript" src="https://www.game-debate.com/system-requirement-js-widget/script?domain=joshua-s.website&theme=light"></script>
<div style: "height: 100px"><p>　</p></div>
    </form>



                        <?php include ("FooterBar.php") ?>
</div>
    
</body>