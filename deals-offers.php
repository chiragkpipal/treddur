<?php include 'header.php'; ?>
<style>
    .main-header {
        background: black !important;
    }
</style>
<?php 
$sql = "SELECT * FROM tires WHERE deals = 1 ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<section class="flat-title">
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

            <!-- widegt List tire -->
            <section class="tf-section3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-section flex align-center justify-space flex-wrap gap-20">
                                <h2 class="wow fadeInUpSmall" data-wow-delay="0.2s" data-wow-duration="1000ms">Latest Deals</h2>
                               
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="flat-tabs themesflat-tabs">
                                <div class="content-tab">
                                    <div class="content-inner tab-content">
                                                <div class="list-car-grid-4 gap-30">
                                                              <?php
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <div class="box-car-list hv-one">
                                                        <div class="image-group relative ">
                                                            <div class="top flex-two">
                                                                <ul class="d-flex gap-8">
                                                                    <li class="flag-tag success">-<?php echo $row['discount']; ?>%</li>
                                                                </ul>
                                                            </div>
                                                            <ul class="change-heart flex">
                                                                <li class="box-icon w-32">
                                                                    <a data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasBottom"
                                                                        aria-controls="offcanvasBottom" class="icon">
                                                                        <svg width="18" height="18" viewBox="0 0 18 18"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M5.25 16.5L1.5 12.75M1.5 12.75L5.25 9M1.5 12.75H12.75M12.75 1.5L16.5 5.25M16.5 5.25L12.75 9M16.5 5.25H5.25"
                                                                                stroke="CurrentColor" stroke-width="1.5"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </svg>
                                                                    </a>
                                                                </li>
                                                                <li class="box-icon w-32">
                                                                    <a href="#" class="icon">
                                                                        <svg width="18" height="16" viewBox="0 0 18 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M16.5 4.875C16.5 2.80417 14.7508 1.125 12.5933 1.125C10.9808 1.125 9.59583 2.06333 9 3.4025C8.40417 2.06333 7.01917 1.125 5.40583 1.125C3.25 1.125 1.5 2.80417 1.5 4.875C1.5 10.8917 9 14.875 9 14.875C9 14.875 16.5 10.8917 16.5 4.875Z"
                                                                                stroke="CurrentColor" stroke-width="1.5"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </svg>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="img-style">
                                                                <img class="lazyload"
                                                                    data-src="<?php echo explode(",",$row['images'])[0]; ?>"
                                                                    src="<?php echo explode(",",$row['images'])[0]; ?>" alt="image">
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <div class="text-address">
                                                                <p class="text-color-3 font"><?php echo $row['brand']; ?></p>
                                                            </div>
                                                            <h5 class="link-style-1">
                                                                <a href="tire-detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                                                            </h5>
                                                            <div class="icon-box flex flex-wrap">
                                                                <div class="icons flex-three">
                                                                    <span>Size: <?php echo $row['size']; ?></span>
                                                                </div>
                                                                <div class="icons flex-three">
                                                                    <span>Style: <?php echo $row['style']; ?></span>
                                                                </div>
                                                                 <div class="icons flex-three">
                                                                    <span>Model: <?php echo $row['car_model']; ?></span>
                                                                </div>
                                                                <div class="icons flex-three">
                                                                    <span>Trim: <?php echo $row['trim']; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="money fs-20 fw-5 lh-25 text-color-3">$<?php echo $row['price']; ?>
                                                            </div>
                                                            <div class="days-box flex justify-space align-center">
                                                                
                                                                <div class="img-author">
                                                                    
                                                                    <span class="font text-color-2 fw-5"><?php echo ucfirst($row['src']); ?></span>
                                                                </div>
                                                                <a href="tire-detail.php?id=<?php echo $row['id']; ?>" class="view-car">View
                                                                    tire</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } } else {
                                                echo "No deals or offers available";
                                                } ?>
                              
                                                </div>
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

         
<?php include 'footer.php'; ?>
