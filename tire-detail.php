<?php include 'header.php'; ?>
<?php include 'fetch/autoload.php'; ?>
<?php 
$tid = $_GET['id']; 
$src = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tires WHERE id = '$tid'"))['src'];
if ($src == 'vulcantire') {
$updateinfo = vulcantireDetail($tid);
} else if ($src == 'simpletire') {
$updateinfo = simpletireDetail($tid);
} else if ($src == 'tirebuyer') {
$updateinfo = tirebuyerDetail($tid);
}
$sql = "SELECT * FROM tires WHERE id = '$tid'";
$result = mysqli_query($conn, $sql);
$trow = mysqli_fetch_assoc($result);
?>
<style>
    .main-header {
        background: black !important;
    }
</style>

            <section class="flat-title ">
                <div class="container2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-inner style">
                                <div class="title-group fs-12"><a class="home fw-6 text-color-3"
                                        href="index.php">Home</a><span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tf-section3 listing-detail style-1">
                <div class="container">
                    <div class="row">
                        <div class="">
                            <div class="listing-detail-wrap">
                                <div class="row"><center class="col-lg-6">
                                <div class=" swiper mainslider slider home mb-40">
                                    
                                    <div class="swiper-wrapper">
                                        <?php
// Comma-separated string of image paths
$images = $trow['images'];

// Convert the string into an array
$imageArray = explode(",", $images);

// Loop through each image and generate the HTML
foreach ($imageArray as $image) {
    ?>
                                        <div class="swiper-slide">
                                            <div class="image-list-details " >
                                                <a class="image" href="#"  data-fancybox="gallery">
                                                    <img style="max-height: 500px; max-width: 500px" class="lazyload"
                                                        data-src="<?php echo $image; ?>"
                                                        src="<?php echo $image; ?>" alt="image">
                                                </a>
                                            </div>
                                        </div>
                                        <?php
}
?>

                                     
                                    </div>
                                    
                                    <div class="swiper-button-next style-3"></div>
                                    <div class="swiper-button-prev style-3"></div>
                                    
                                </div>
                                </center>
                                <div class="col-xl-6 mt-40"> 
                                      <div class="widget-listing mb-40">
                                    <div class="heading-widget">
                                        <h2 class="title"><?php echo $trow['name']; ?></h2>
                                        <div class="icon-box flex flex-wrap">
                                           <?php if (!empty($trow['size'])): ?>
    <div class="icons flex-three">
        <span>Size: <?php echo $trow['size']; ?></span>
    </div>
<?php endif; ?>

<?php if (!empty($trow['style'])): ?>
    <div class="icons flex-three">
        <span>Style: <?php echo $trow['style']; ?></span>
    </div>
<?php endif; ?>

<?php if (!empty($trow['car_model'])): ?>
    <div class="icons flex-three">
        <span>Model: <?php echo $trow['car_model']; ?></span>
    </div>
<?php endif; ?>

<?php if (!empty($trow['trim'])): ?>
    <div class="icons flex-three">
        <span>Trim: <?php echo $trow['trim']; ?></span>
    </div>
<?php endif; ?>

                                            
                                            
                                        </div>
                                        <div class="money text-color-3 font"><?php if ($trow['scan_type'] == 'brand') { echo "Starting";} ?> $<?php echo number_format($trow['price'], 2); ?></div>
                                        <div class="price-wrap">
                                            
                                            <p class="fs-12 lh-16"><?php echo $trow['brand']; ?></p>
                                        </div>
                                        <a href="<?php echo $trow['cta']; ?>" target="_blank" class="buttn">
                                               Buy Now
                                            </a>
                                        <ul class="d-none action-icon flex flex-wrap">
                                            <li>
                                                <a href="#" class="icon">
                                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.75 4.1875C14.75 2.32375 13.1758 0.8125 11.234 0.8125C9.78275 0.8125 8.53625 1.657 8 2.86225C7.46375 1.657 6.21725 0.8125 4.76525 0.8125C2.825 0.8125 1.25 2.32375 1.25 4.1875C1.25 9.6025 8 13.1875 8 13.1875C8 13.1875 14.75 9.6025 14.75 4.1875Z"
                                                            stroke="CurrentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="icon">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4.625 14.75L1.25 11.375M1.25 11.375L4.625 8M1.25 11.375H11.375M11.375 1.25L14.75 4.625M14.75 4.625L11.375 8M14.75 4.625H4.625"
                                                            stroke="CurrentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="icon">
                                                    <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4.41276 8.18022C4.23116 7.85345 3.94619 7.59624 3.60259 7.44895C3.25898 7.30167 2.8762 7.27265 2.51432 7.36645C2.15244 7.46025 1.83196 7.67157 1.60317 7.96722C1.37438 8.26287 1.25024 8.62613 1.25024 8.99997C1.25024 9.37381 1.37438 9.73706 1.60317 10.0327C1.83196 10.3284 2.15244 10.5397 2.51432 10.6335C2.8762 10.7273 3.25898 10.6983 3.60259 10.551C3.94619 10.4037 4.23116 10.1465 4.41276 9.81972M4.41276 8.18022C4.54776 8.42322 4.62501 8.70222 4.62501 8.99997C4.62501 9.29772 4.54776 9.57747 4.41276 9.81972M4.41276 8.18022L11.5873 4.19472M4.41276 9.81972L11.5873 13.8052M11.5873 4.19472C11.6924 4.39282 11.8361 4.56797 12.0097 4.70991C12.1834 4.85186 12.3836 4.95776 12.5987 5.02143C12.8138 5.08509 13.0394 5.10523 13.2624 5.08069C13.4853 5.05614 13.7011 4.98739 13.8972 4.87846C14.0933 4.76953 14.2657 4.62261 14.4043 4.44628C14.5429 4.26995 14.645 4.06775 14.7046 3.85151C14.7641 3.63526 14.78 3.40931 14.7512 3.18686C14.7225 2.96442 14.6496 2.74994 14.537 2.55597C14.3151 2.17372 13.952 1.89382 13.5259 1.77643C13.0997 1.65904 12.6445 1.71352 12.2582 1.92818C11.8718 2.14284 11.585 2.50053 11.4596 2.92436C11.3341 3.34819 11.38 3.80433 11.5873 4.19472ZM11.5873 13.8052C11.4796 13.999 11.4112 14.2121 11.3859 14.4323C11.3606 14.6525 11.3789 14.8756 11.4398 15.0887C11.5007 15.3019 11.603 15.5009 11.7408 15.6746C11.8787 15.8482 12.0494 15.9929 12.2431 16.1006C12.4369 16.2082 12.65 16.2767 12.8702 16.302C13.0905 16.3273 13.3135 16.3089 13.5267 16.248C13.7398 16.1871 13.9389 16.0848 14.1125 15.947C14.2861 15.8092 14.4309 15.6385 14.5385 15.4447C14.7559 15.0534 14.809 14.5917 14.686 14.1612C14.563 13.7307 14.274 13.3668 13.8826 13.1493C13.4913 12.9319 13.0296 12.8789 12.5991 13.0019C12.1686 13.1249 11.8047 13.4139 11.5873 13.8052Z"
                                                            stroke="CurrentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </li>
                                           
                                        </ul>
                                    </div>

                                </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                                            <div class="listing-description mb-40">
                                                <div class="tfcl-listing-header ">
                                                    <h2>Description</h2>
                                                </div>
                                                <div class="tfcl-listing-info mt-30">
                                                    <p><?php echo nl2br($trow['description']); ?>
                                                    </p>
                                                   
                                                </div>
                                            </div>
                                            <div class="listing-description footer-col-block" id="scrollspyHeading1">
                                                <div class="footer-heading-desktop ">
                                                    <h2>Tire overview</h2>
                                                </div>
                                                <div class="footer-heading-mobie listing-details-mobie ">
                                                    <h2>Tire overview</h2>
                                                </div>
                                                <div class="tfcl-listing-info tf-collapse-content mt-30">
                                                    <div class="row">
                                                        
                                                        <?php
                                                        $properties = json_decode($trow['properties'], true);
                                                        foreach ($properties as $property => $value) { 
                                                            if ($value != '') { ?>
                                                        <div class="col-xl-6 col-md-6 item">
                                                            <div class="inner listing-infor-box">
                                                                <div class="content-listing-info">
                                                                    <span class="listing-info-title">
                                                                        <?php echo ucfirst($property); ?>:</span>
                                                                    <p class="listing-info-value"><?php echo $value; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     <?php } } ?>
                                                     
                                                    </div>
                                                </div>
                                            </div>
                                       
                                           
                                        </div>                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-40">
                            <div class="overlay-siderbar-mobie"></div>
                            <div class="listing-sidebar">
                              
                                <div class="widget-listing mb-30">
                                    <div class="prolile-info flex-three mb-30">
                                        <!--<div class="image">-->
                                        <!--    <img class="lazyload" data-src="assets/images/author/avt1.jpg"-->
                                        <!--        src="assets/images/author/avt1.jpg" alt="image">-->
                                        <!--</div>-->
                                        <div class="content">
                                            <h4><?php echo ucfirst($trow['src']); ?></h4>
                                            <div class="verified flex-three">
                                                <div class="icon">
                                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5 8.00024L6.5 9.50024L9 6.00024M7 1.30957C5.49049 2.74306 3.48018 3.52929 1.39867 3.50024C1.13389 4.30689 0.999317 5.15057 1 5.99957C1 9.72757 3.54934 12.8596 7 13.7482C10.4507 12.8602 13 9.72824 13 6.00024C13 5.1269 12.86 4.28624 12.6013 3.49957H12.5C10.3693 3.49957 8.43334 2.66757 7 1.30957Z"
                                                            stroke="CurrentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <span class="fs-12 fw-6 lh-16">Verified source</span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="profile-map mb-30">
                                        <div class="list-icon-pf gap-8 flex-three ">
                                            <i class="far fa-map"></i>
                                            <p class="font-1"><?php echo $trow['address']; ?></p>
                                        </div>
                                        <div class="map">
                                      <iframe
  width="600"
  height="450"
  style="border:0"
  loading="lazy"
  allowfullscreen
  referrerpolicy="no-referrer-when-downgrade"
  src="<?php echo $trow['map']; ?>">
</iframe>
                               
                                        </div>
                                    </div>
                                  
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <?php include 'footer.php'; ?>
