


<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                document.write(new Date().getFullYear())
                </script> © Treddur.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by <a target="_blank" href="https://k3.studio">K3 Studio</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

 
<!-- JAVASCRIPT -->
<!-- custom script -->
<script src="script.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

<!--Swiper slider js-->
<script src="assets/libs/swiper/swiper-bundle.min.js"></script>

<!-- Dashboard init -->
<?php if ($page = "homepage") {


$counts = [];



$devicesarray = '[' . implode(',', $counts) . ']';

$dates = [];
for ($i = 6; $i >= 0; $i--) {
    $dates[] = date('Y-m-d', strtotime("-$i days"));
    $l7d[] = date('d M', strtotime("-$i days"));
}

// Initialize arrays for query results
$tires_counts = [];
$users_counts = [];

// Execute queries and collect counts
foreach ($dates as $date) {
    $date = $conn->real_escape_string($date);

    $tires_result = $conn->query("SELECT COUNT(*) FROM tires WHERE DATE(time) = '$date'");
    $tires_counts[] = $tires_result ? $tires_result->fetch_row()[0] : 0;

}


// Format the output
$l7date = '["' . implode('","', $l7d) . '"]';
$l7tires = '[' . implode(',', $tires_counts) . ']';
$l7users = '[' . implode(',', $users_counts) . ']';
?>

<script>
    function getChartColorsArray(e){if(null!==document.getElementById(e)){var t="data-colors"+("-"+document.documentElement.getAttribute("data-theme")??""),t=document.getElementById(e).getAttribute(t)??document.getElementById(e).getAttribute("data-colors");if(t)return(t=JSON.parse(t)).map(function(e){var t=e.replace(" ","");return-1===t.indexOf(",")?getComputedStyle(document.documentElement).getPropertyValue(t)||t:2==(e=e.split(",")).length?"rgba("+getComputedStyle(document.documentElement).getPropertyValue(e[0])+","+e[1]+")":t});console.warn("data-colors attributes not found on",e)}}var worldemapmarkers="",storeVisitsSourceChart="",customerImpressionChart="";function loadCharts(){var e,t=getChartColorsArray("sales-by-locations");t&&(document.getElementById("sales-by-locations").innerHTML="",worldemapmarkers="",worldemapmarkers=new jsVectorMap({map:"world_merc",selector:"#sales-by-locations",zoomOnScroll:!1,zoomButtons:!1,selectedMarkers:[0,5],regionStyle:{initial:{stroke:"#9599ad",strokeWidth:.25,fill:t[0],fillOpacity:1}},markersSelectable:!0,markers:[{name:"Palestine",coords:[31.9474,35.2272]},{name:"Russia",coords:[61.524,105.3188]},{name:"Canada",coords:[56.1304,-106.3468]},{name:"Greenland",coords:[71.7069,-42.6043]}],markerStyle:{initial:{fill:t[1]},selected:{fill:t[2]}},labels:{markers:{render:function(e){return e.name}}}})),(t=getChartColorsArray("customer_impression_charts"))&&(e={series:[{name:"tires",type:"bar",data:<?php echo $l7tires; ?>}],chart:{height:370,type:"line",toolbar:{show:!1}},stroke:{curve:"straight",dashArray:[0,0,8],width:[2,0,2.2]},fill:{opacity:[.1,.9,1]},markers:{size:[0,0,0],strokeWidth:2,hover:{size:4}},xaxis:{categories:<?php echo $l7date; ?>,axisTicks:{show:!1},axisBorder:{show:!1}},grid:{show:!0,xaxis:{lines:{show:!0}},yaxis:{lines:{show:!1}},padding:{top:0,right:-2,bottom:15,left:10}},legend:{show:!0,horizontalAlign:"center",offsetX:0,offsetY:-5,markers:{width:9,height:9,radius:6},itemMargin:{horizontal:10,vertical:0}},plotOptions:{bar:{columnWidth:"30%",barHeight:"70%"}},colors:t,tooltip:{shared:!0,y:[{formatter:function(e){return void 0!==e?e.toFixed(0):e}},{formatter:function(e){return void 0!==e?""+e.toFixed(2)+"":e}},{formatter:function(e){return void 0!==e?e.toFixed(0)+" Sales":e}}]}},""!=customerImpressionChart&&customerImpressionChart.destroy(),(customerImpressionChart=new ApexCharts(document.querySelector("#customer_impression_charts"),e)).render());(t=getChartColorsArray("store-visits-source"))&&(e={series:<?php echo $devicesarray; ?>,labels:["Mobile","Desktop","App"],chart:{height:333,type:"donut"},legend:{position:"bottom"},stroke:{show:!1},dataLabels:{dropShadow:{enabled:!1}},colors:t},""!=storeVisitsSourceChart&&storeVisitsSourceChart.destroy(),(storeVisitsSourceChart=new ApexCharts(document.querySelector("#store-visits-source"),e)).render())}window.onresize=function(){setTimeout(()=>{loadCharts()},0)},loadCharts();var overlay,swiper=new Swiper(".vertical-swiper",{slidesPerView:2,spaceBetween:10,mousewheel:!0,loop:!0,direction:"vertical",autoplay:{delay:2500,disableOnInteraction:!1}}),layoutRightSideBtn=document.querySelector(".layout-rightside-btn");layoutRightSideBtn&&(Array.from(document.querySelectorAll(".layout-rightside-btn")).forEach(function(e){var t=document.querySelector(".layout-rightside-col");e.addEventListener("click",function(){t.classList.contains("d-block")?(t.classList.remove("d-block"),t.classList.add("d-none")):(t.classList.remove("d-none"),t.classList.add("d-block"))})}),window.addEventListener("resize",function(){var e=document.querySelector(".layout-rightside-col");e&&Array.from(document.querySelectorAll(".layout-rightside-btn")).forEach(function(){window.outerWidth<1699||3440<window.outerWidth?e.classList.remove("d-block"):1699<window.outerWidth&&e.classList.add("d-block")}),"semibox"==document.documentElement.getAttribute("data-layout")&&(e.classList.remove("d-block"),e.classList.add("d-none"))}),overlay=document.querySelector(".overlay"))&&document.querySelector(".overlay").addEventListener("click",function(){1==document.querySelector(".layout-rightside-col").classList.contains("d-block")&&document.querySelector(".layout-rightside-col").classList.remove("d-block")}),window.addEventListener("load",function(){var e=document.querySelector(".layout-rightside-col");e&&Array.from(document.querySelectorAll(".layout-rightside-btn")).forEach(function(){window.outerWidth<1699||3440<window.outerWidth?e.classList.remove("d-block"):1699<window.outerWidth&&e.classList.add("d-block")}),"semibox"==document.documentElement.getAttribute("data-layout")&&1699<window.outerWidth&&(e.classList.remove("d-block"),e.classList.add("d-none"))});
</script>
<?php } ?>
<!-- App js -->
<script src="assets/js/app.js"></script>
</body>

</html>