<?php include 'header.php'; ?>

<?php 

$msg = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['new'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];


        $query = "INSERT INTO `admins` (username, email, password) VALUES (?,?, ?)";
        $stmt = $conn->prepare($query);

        $stmt->bind_param('sss', $username, $email, $password);

        if ($stmt->execute()) {
            $msg = '<div class="alert alert-success alert-border-left alert-dismissible fade show material-shadow" role="alert">
                        <i class="ri-check-double-line me-3 align-middle"></i> <strong>Success</strong> - Admin added successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        } else {
            $msg = '<div class="alert alert-danger alert-border-left alert-dismissible fade show material-shadow" role="alert">
                        <i class="ri-error-warning-line me-3 align-middle"></i> <strong>Error</strong> - Error adding Admin. ' . htmlspecialchars($stmt->error) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

  

    if (isset($_POST['did'])) {
        $did = $_POST['did'];
        $query = "DELETE FROM `admins` WHERE id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param('i', $did);

        if ($stmt->execute()) {
            $msg = '<div class="alert alert-success alert-border-left alert-dismissible fade show material-shadow" role="alert">
                        <i class="ri-check-double-line me-3 align-middle"></i> <strong>Success</strong> - Admin deleted successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        } else {
            $msg = '<div class="alert alert-danger alert-border-left alert-dismissible fade show material-shadow" role="alert">
                        <i class="ri-error-warning-line me-3 align-middle"></i> <strong>Error</strong> - Unable to delete Admin. ' . htmlspecialchars($stmt->error) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
}

?>

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
                        <h4 class="mb-sm-0">Admins</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Administrator Management</a>
                                </li>
                                <li class="breadcrumb-item active">Admins</li>
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
                            <h4 class="card-title mb-0 flex-grow-1">Admins</h4>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#addadmins"
                                class="btn btn-sm btn-primary">Add Admin</button>
                            <div class="modal fade" id="addadmins" tabindex="-1" aria-labelledby="addadminsLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addadminsLabel">New Admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                                <div class="row g-3">

                                                    <div>
                                                        <label for="username" class="form-label">Username<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="username"
                                                            id="username" placeholder="username" required>
                                                    </div>
                                                    <div>
                                                        <label for="email" class="form-label">Email<span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="email" id="email"
                                                            placeholder="email" required>
                                                    </div>
                                                    <div>
                                                        <label for="password" class="form-label">Password<span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" placeholder="password" required>
                                                    </div>
                                                 

                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button name="new" type="submit"
                                                                class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php echo $msg; ?>
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="cardtableCheck">
                                                    <label class="form-check-label" for="cardtableCheck"></label>
                                                </div>
                                            </th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $query = "SELECT * FROM `admins` ORDER BY id DESC";
                                    $result = $conn->query($query);
                                    if ($result && $result->num_rows > 0) {
                                    ?>
                                    <tbody class="list form-check-all">
                                        <?php 
                                            while ($admins = $result->fetch_assoc()) { 
                                            ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="cardtableCheck01">
                                                    <label class="form-check-label" for="cardtableCheck01"></label>
                                                </div>
                                            </th>
                                            <td><?php echo $admins['id']; ?></td>
                                            <td><?php echo $admins['username']; ?></td>
                                            <td><?php echo $admins['email']; ?></td>
                                           
                                            <td class="d-flex">
                                                <form method="POST"
                                                    onsubmit="return confirm('Do you want to delete this Admin?')">
                                                    <input type="hidden" value="<?php echo $admins['id']; ?>"
                                                        name="did">
                                                    <button type="submit" name="delete" class="btn btn-sm"><i
                                                            class="ri-delete-bin-fill text-danger fs-5"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Admin Modal -->
                                        <!-- End Edit Admin Modal -->
                                        <?php 
                                            } 
                                            ?>
                                    </tbody>
                                    <?php 
                                    } 
                                    ?>
                                </table>
                                <!--end table-->
                            </div>
                            <!--end table-responsive-->
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>

        </div>
        <!-- container-fluid -->
    </div>
</div>

<?php include 'footer.php'; ?>