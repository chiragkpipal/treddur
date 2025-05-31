<?php include 'header.php'; ?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">

                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Welcome, <?php echo $username; ?>!</h4> 
                                        <p class="text-muted mb-0">Here's what's happening with your website today.</p>
                                    </div>
                                    <div class="mt-3 mt-lg-0">
                                        <form action="javascript:void(0);">
                                            <div class="row g-3 mb-0 align-items-center">
                                                <!--end col-->
                                                <div class="col-auto">
                                                    <button type="button"
                                                        class="btn btn-soft-info btn-icon waves-effect material-shadow-none waves-light layout-rightside-btn"><i
                                                            class="ri-pulse-line"></i></button>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                </div><!-- end card header -->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tires</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <?php $ntires = $conn->query("SELECT COUNT(*) FROM tires")->fetch_row()[0]; ?>
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                        class="counter-value" data-target="<?php echo $ntires; ?>">0</span></h4>
                                                <a href="tires.php" class="text-decoration-underline">View</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-success-subtle rounded fs-3">
                                                    <i class="ri-record-circle-fill text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                             <div class="col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tire Deals</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <?php $ntires = $conn->query("SELECT COUNT(*) FROM tires WHERE deals = 1")->fetch_row()[0]; ?>
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                        class="counter-value" data-target="<?php echo $ntires; ?>">0</span></h4>
                                                <a href="tires.php" class="text-decoration-underline">View</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-success-subtle rounded fs-3">
                                                    <i class="ri-record-circle-fill text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                         
                        
                        </div> <!-- end row-->


                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Last 7 days</h4>
                                    </div><!-- end card header -->

                                    <div class="card-header p-0 border-0 bg-light-subtle">
                                        <div class="row g-0 text-center">
                                            <?php 
$n7tires = $conn->query("SELECT COUNT(*) FROM tires WHERE time >= '" . date('Y-m-d H:i:s', strtotime('-7 days')) . "'")->fetch_row()[0];
?>

                                            <div class="col-12">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value"
                                                            data-target="<?php echo $n7tires; ?>">0</span></h5>
                                                    <p class="text-muted mb-0">tires</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                           

                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body p-0 pb-2">
                                        <div class="w-100">
                                            <div id="customer_impression_charts"
                                                data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                                                                    <?php
        // Corrected SQL query
$sql = "SELECT * FROM tires
        ORDER BY id DESC
        LIMIT 10";


        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?> 

        
                       <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Recent Tires</h4>
                                        <div class="flex-shrink-0">
                                            <a href="tires.php" class="btn btn-soft-info btn-sm material-shadow-none">
                                                View All
                                            </a>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table
                                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                <thead class="text-muted table-light">
                                                    <tr>
                                                        <th scope="col">ID</th>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Src</th>
                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
 <?php

while ($trow = mysqli_fetch_assoc($result)) {
    ?>
                                                    <tr style="border-bottom: 1px solid lightgray">
                                                          <td class="id"><a href="" class="fw-medium link-primary">#<?php echo $trow['id']; ?></a></td>
                                                        <td class="product_name"><?php echo $trow['brand']; ?></td>
                                                        <td class="amount"><?php echo $trow['name']; ?></td>
                                                        <td class="amount">$<?php echo $trow['price']; ?></td>
                                                           <td class="amount"><a target="_blank" href="<?php echo $trow['cta']; ?>" target="_blank"><?php echo $trow['src']; ?></a></td>
                                                
                                                       
                                                       <td class="date"><?php echo $trow['time']; ?></td>
                                                    </tr><!-- end tr -->

                                               <?php
} ?>
                    
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div>
                                    </div>
<?php
} else {
    echo "Nothing generated yet.";
}
?>
                                </div> <!-- .card-->
                            </div> <!-- .col-->
                            <!-- end col -->
                        </div>
        


                    </div> <!-- end .h-100-->

                </div> <!-- end col -->

            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>
<!-- end main content-->
<?php include 'footer.php'; ?>