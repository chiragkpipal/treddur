<?php include 'header.php'; ?>
<?php 
$msg = "";
if (isset($_POST['did'])) {
    $did = $_POST['did'];
    $sql = "DELETE FROM tires WHERE id = '$did'";
    if (mysqli_query($conn, $sql)) {
 $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> - headshot Deleted
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    } else {
 $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error</strong> - headshot not Deleted
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    }
}
?>
 <script>
        function changepage(page) {
            window.location.href = `?page=${page}`;
        }
    </script>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Tires</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                                <li class="breadcrumb-item active">Tires</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">All Tires</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <?php echo $msg; ?>

                                <table class="table table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                          
                                              <th scope="col">ID</th>
                          <th>Brand</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Src</th>
                        <th>Date</th>
                                         
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                   <?php 
$items_per_page = 25;

// Calculate the total number of pages
$total_items_query = "SELECT COUNT(*) as total FROM tires";
$total_items_result = $conn->query($total_items_query);
$total_items_row = $total_items_result->fetch_assoc();
$total_items = $total_items_row['total'];
$total_pages = ceil($total_items / $items_per_page);

// Get the current page from URL or default to 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, min($current_page, $total_pages));

// Calculate the offset for the current page
$offset = ($current_page - 1) * $items_per_page;

// Update the query to include pagination
$query = "SELECT * FROM tires ORDER BY id DESC LIMIT $offset, $items_per_page";
$headshot_result = $conn->query($query);

// Function to create pagination links
function create_pagination_links($current_page, $total_pages) {
    $pagination_html = '<div class="pagination-wrap hstack gap-2">';

    // Previous page link
    $prev_disabled = $current_page <= 1 ? 'disabled' : '';
    $prev_page = $current_page - 1;
    $pagination_html .= '<button class="page-item pagination-prev ' . $prev_disabled . '" onclick="changepage(' . $prev_page . ')">Previous</button>';

    // Page number links
    $pagination_html .= '<ul class="pagination listjs-pagination mb-0">';
    for ($page = 1; $page <= $total_pages; $page++) {
        $active_class = $page == $current_page ? 'active' : '';
        $pagination_html .= '<li class="page-item ' . $active_class . '">';
        $pagination_html .= '<button class="page-link" onclick="changepage(' . $page . ')">' . $page . '</button>';
        $pagination_html .= '</li>';
    }
    $pagination_html .= '</ul>';

    // Next page link
    $next_disabled = $current_page >= $total_pages ? 'disabled' : '';
    $next_page = $current_page + 1;
    $pagination_html .= '<button class="page-item pagination-next ' . $next_disabled . '" onclick="changepage(' . $next_page . ')">Next</button>';

    $pagination_html .= '</div>';

    return $pagination_html;
}

if ($headshot_result->num_rows > 0) {
?>
    <tbody>
        <?php while ($trow = $headshot_result->fetch_assoc()) { 
        ?>
         
       <tr style="border-bottom: 1px solid lightgray">
                                                         <tr style="border-bottom: 1px solid lightgray">
                                                            <td class="id"><a href="" class="fw-medium link-primary">#<?php echo $trow['id']; ?></a></td>
                                                        <td class="product_name"><?php echo $trow['brand']; ?></td>
                                                        <td class="amount"><?php echo $trow['name']; ?></td>
                                                        <td class="amount">$<?php echo $trow['price']; ?></td>
                                                           <td class="amount"><a href="<?php echo $trow['cta']; ?>" target="_blank"><?php echo $trow['src']; ?></a></td>
                                                
                                                       
                                                       <td class="date"><?php echo $trow['time']; ?></td>
                                                         
                                                   
                                                       <td>
       <a target="_blank" href="/tire-detail.php?id=<?php echo $trow['id']; ?>" class="btn btn-sm btn-success">View</a>
       <?php if ($trow['deals']) { ?>
       <a href="deal.php?remove=1&id=<?php echo $trow['id']; ?>" class="btn btn-sm btn-danger">Remove Deal</a>
       <?php } else { ?>
              <a href="deal.php?add=1&id=<?php echo $trow['id']; ?>" class="btn btn-sm btn-success">Add Deal</a>
<?php } ?>
       
                                                           <form action="" method="POST" onsubmit="return confirmDelete(<?php echo $trow['id']; ?>)">
    <input type="hidden" name="did" value="<?php echo $trow['id']; ?>">
    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
</form>

</td>
                                                    </tr><!-- end tr -->
        <?php } ?>
    </tbody>
<?php 
}
?>


                                </table>
                                 <div class="m-2">
                                            <?php echo create_pagination_links($current_page, $total_pages); ?>
                                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<script>
    function confirmDelete(id) {
        return confirm("Do you really want to delete the headshot ?");
    }
</script>

            <?php include 'footer.php'; ?>