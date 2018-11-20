<script type="text/javascript">
// This function controls the hiding and showing the bars 
    function toggle_navi(id) {
        //hides all bars first
        $("#NaviBarAMD").hide("fast");
        $("#NaviBarIntel").hide("fast");
        //Shows the bar via the ID sent when the menu button was clicked
        $(id).show("fast");   
    }

</script>
<!--This bar contains the top layer of buttons for the navigation bar-->
<div id = NaviBar>
    <a href="index.php">Home</a>
<a id ="amdbutton" href="#" onclick="toggle_navi('#NaviBarAMD')">AMD <span style="font-size: 10px">▼</span>
        </a>
        <a id ="intelbutton" href="#" onclick="toggle_navi('#NaviBarIntel')">Intel <span style="font-size: 10px">▼</span></a>        
    </div>
<!--These are the bars shows when the corresponding button is pressed-->
<div id =NaviBarAMD>
    <a href = "Product.php?Socket=AM4">AM4 (Ryzen)</a>    
</div>

<div id =NaviBarIntel>
    <a href = "Product.php?Socket=LGA1151">LGA 1151 (Skylake, Kabylake)</a>    
    <a href = "Product.php?Socket=LGA2011-3">LGA 2011-3 (Broadwell, Broadwell-E)</a>  
</div>