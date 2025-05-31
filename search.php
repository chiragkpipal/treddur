<?php 
include 'header.php';
?>
<?php include 'db.php';?>
<?php include 'fetch/autoload.php';?>

<style>
    .main-header {
        background: black !important;
    }
    .form-sl {
        background: transparent;
        box-shadow: none;
        max-width: 1400px;
        padding: 0px;
    }
    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        margin: 40px 0;
        gap: 8px;
    }
    .pagination a {
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        color: #333;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #e0e0e0;
    }
    .pagination a:hover {
        background: #f5f5f5;
        border-color: #ddd;
    }
    .pagination a.active {
        background: #2b8659;
        color: white;
        border-color: #2b8659;
    }
    /* Sort Dropdown */
    .sort-dropdown {
        position: relative;
        margin-bottom: 30px;
    }
    .sort-dropdown select {
        appearance: none;
        -webkit-appearance: none;
        padding: 12px 40px 12px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        background-color: white;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        cursor: pointer;
        transition: all 0.3s ease;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
    }
    .sort-dropdown select:hover {
        border-color: #2b8659;
    }
    /* Fitment Confirmation */
    .fitment-confirmation {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        border-left: 5px solid #2b8659;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .fitment-confirmation h4 {
        color: #2b8659;
        margin-bottom: 8px;
        font-size: 18px;
        font-weight: 700;
    }
    .fitment-confirmation p {
        color: #555;
        font-size: 15px;
        margin: 0;
    }
    /* No Results */
    .no-results {
        text-align: center;
        padding: 40px;
        background: #f8f9fa;
        border-radius: 12px;
        margin: 30px 0;
    }
    .no-results p {
        font-size: 16px;
        color: #666;
        margin-bottom: 20px;
    }
</style>
<?php 
// Initialize search parameters
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$brand = isset($_GET['brand']) ? trim($_GET['brand']) : '';
$width = isset($_GET['width']) ? trim($_GET['width']) : '';
$ratio = isset($_GET['ratio']) ? trim($_GET['ratio']) : '';
$diameter = isset($_GET['diameter']) ? trim($_GET['diameter']) : '';
$make = isset($_GET['make']) ? trim($_GET['make']) : '';
$model = isset($_GET['model']) ? trim($_GET['model']) : '';
$trim = isset($_GET['trim']) ? trim($_GET['trim']) : '';
$size = isset($_GET['tireSize']) ? trim($_GET['tireSize']) : '';

// Initialize pagination variables
$per_page = 12; // Items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// Initialize sorting variables
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'price_asc';
$sort_options = [
    'price_asc' => 'Price: Low to High',
    'price_desc' => 'Price: High to Low',
    'brand_asc' => 'Brand: A to Z',
    'brand_desc' => 'Brand: Z to A',
    'newest' => 'Newest First'
];

// Initialize filter variables
$filter_brand = isset($_GET['filter_brand']) ? $_GET['filter_brand'] : [];
if (!is_array($filter_brand)) {
    $filter_brand = [$filter_brand];
}
$filter_style = isset($_GET['filter_style']) ? $_GET['filter_style'] : [];
if (!is_array($filter_style)) {
    $filter_style = [$filter_style];
}

$type = '';
$result = false;
$total_rows = 0;
$base_query = '';
$where_clauses = [];

// 1. If search query is present
if (!empty($q)) {
    $type = "query";
    $base_query = "SELECT * FROM tires WHERE (name LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%'))";
    $where_clauses[] = "name LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%')";
    $params = ["ss", $q, $q];

// 2. If brand is set
} elseif (!empty($brand)) {
    $tirebuyerSearch = tirebuyerBrandSearch(lcfirst($brand));
    $simpletireBrandSearch = simpletireBrandSearch(lcfirst($brand));
    $type = "brand";
    $base_query = "SELECT * FROM tires WHERE brand = ?";
    $where_clauses[] = "brand = ?";
    $params = ["s", $brand];

// 3. If width, ratio, diameter are set
} elseif (!empty($width) && !empty($ratio) && !empty($diameter)) {
    $vulcantireSearch = vulcantireSearch($width, $ratio, $diameter);
    $simpletireSearch = simpletireSearch($width, $ratio, $diameter);
    $tirebuyerSearch = tirebuyerSearch($width, $ratio, $diameter);
    $type = "size";
    $base_query = "SELECT * FROM tires WHERE width = ? AND ratio = ? AND diameter = ?";
    $where_clauses[] = "width = ?";
    $where_clauses[] = "ratio = ?";
    $where_clauses[] = "diameter = ?";
    $params = ["sss", $width, $ratio, $diameter];

// 4. If model, trim, size are set
} elseif (!empty($model)) {
    $tirebuyerModel = tirebuyerModel($_GET);
    $simpletireModelSearch = simpletireModel($_GET);
    $type = "vehicle";
    $base_query = "SELECT * FROM tires WHERE make = ? AND car_model = ? AND trim = ? AND size = ?";
    $where_clauses[] = "make = ?";
    $where_clauses[] = "car_model = ?";
    $where_clauses[] = "trim = ?";
    $where_clauses[] = "size = ?";
    $params = ["ssss", $make, $model, $trim, $size];
}

// Apply filters if any
if (!empty($filter_brand)) {
    $placeholders = implode(',', array_fill(0, count($filter_brand), '?'));
    $base_query .= (strpos($base_query, 'WHERE') !== false ? ' AND' : ' WHERE');
    $base_query .= " brand IN ($placeholders)";
    $params[0] .= str_repeat('s', count($filter_brand));
    $params = array_merge($params, $filter_brand);
}


if (!empty($filter_style)) {
    $placeholders = implode(',', array_fill(0, count($filter_style), '?'));
    $base_query .= (strpos($base_query, 'WHERE') !== false ? ' AND' : ' WHERE');
    $base_query .= " style IN ($placeholders)";
    $params[0] .= str_repeat('s', count($filter_style));
    $params = array_merge($params, $filter_style);
}

// Apply sorting
switch ($sort) {
    case 'price_asc':
        $base_query .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $base_query .= " ORDER BY price DESC";
        break;
    case 'brand_asc':
        $base_query .= " ORDER BY brand ASC";
        break;
    case 'brand_desc':
        $base_query .= " ORDER BY brand DESC";
        break;
    case 'newest':
        $base_query .= " ORDER BY created_at DESC";
        break;
    default:
        $base_query .= " ORDER BY price ASC";
}

// Get total count for pagination
$count_query = str_replace('SELECT *', 'SELECT COUNT(*) as total', $base_query);
$count_stmt = $conn->prepare($count_query);
if ($count_stmt) {
    if (!empty($params)) {
        $count_stmt->bind_param(...$params);
    }
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $total_rows = $count_result->fetch_assoc()['total'];
    $count_stmt->close();
}

// Add pagination to query
$base_query .= " LIMIT ? OFFSET ?";
$params[0] .= 'ii';
$params[] = $per_page;
$params[] = $offset;

// Execute main query
$stmt = $conn->prepare($base_query);
if ($stmt) {
    if (!empty($params)) {
        $stmt->bind_param(...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
}
?>


<section class="flat-title">
    <div class="container2">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-inner style">
                    <div class="title-group fs-12">
                        <a class="home fw-6 text-color-3" href="index.php">Home</a><span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- widget List tyre -->
<section class="tf-section3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="heading-section flex align-center justify-space flex-wrap gap-20">
                    <h2 class="wow fadeInUpSmall" data-wow-delay="0.2s" data-wow-duration="1000ms">
                        Search
                    </h2>
                </div>
                
                <?php if ($type=="vehicle") { ?>
                <div class="fitment-confirmation">
                    <h4>These tires fit your <?php echo htmlspecialchars($_GET['year'] ?? ''); ?> <?php echo htmlspecialchars($_GET['make'] ?? ''); ?> <?php echo htmlspecialchars($_GET['model'] ?? ''); ?> <?php echo htmlspecialchars($_GET['trim'] ?? ''); ?></h4>
                    <p>Tire Size: <?php echo htmlspecialchars($_GET['tireSize'] ?? ''); ?></p>
                </div>
                <div class="content-inner mb-40">
                    <div class="form-sl">
                        <?php
                        function displayDetail($label, $value) {
                            if (!empty($value)) {
                                echo '<div style="
                                    background: #ffffff;
                                    padding: 15px;
                                    border-radius: 8px;
                                    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
                                    flex: 1 0 calc(20% - 15px);
                                    min-width: 160px;
                                    transition: all 0.3s ease;
                                    box-sizing: border-box;
                                ">
                                    <span style="
                                        font-weight: 600;
                                        color: #555;
                                        font-size: 13px;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        display: block;
                                        margin-bottom: 8px;
                                    ">'.$label.'</span>
                                    <div style="
                                        color: #2b8659;
                                        font-weight: 700;
                                        font-size: 16px;
                                        white-space: nowrap;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                    ">'.strtoupper($value).'</div>
                                </div>';
                            }
                        }
                        ?>

                        <div style="
                            display: flex;
                            flex-wrap: wrap;
                            gap: 15px;
                            margin: 0 auto;
                            padding: 20px;
                            font-family: 'Segoe UI', Roboto, -apple-system, sans-serif;
                        ">
                            <?php
                            displayDetail('Year', $_GET['year'] ?? '');
                            displayDetail('Make', $_GET['make'] ?? '');
                            displayDetail('Model', $_GET['model'] ?? '');
                            displayDetail('Trim', $_GET['trim'] ?? '');
                            displayDetail('Tire Size', $_GET['tireSize'] ?? '');
                            ?>
                        </div>

                        <div class="button-search sc-btn-top mx-1">
                            <a href="index.php" class="sc-button">
                                <span>Search</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } else if ($type == 'brand') { ?>
                <div class="content-inner mb-40">
                    <div class="form-sl">
                        <form method="get" action="search.php">
                            <div class="wd-find-select flex">
                                <div class="inner-group">
                                    <div class="form-group-1">
                                        <div class="group-select">
                                            <select name="brand" class="nice-select" tabindex="0" required>
                                                <option value="" disabled <?= $brand == '' ? 'selected' : '' ?>>Brand</option>
                                                <?php
$brands = ["Accelera", "Accelus", "Achieva", "Achilles", "Advance", "Advanta", "Aeolus", "Ag Plus", "Agstar", "Air-Loc", "Akuret", "Alliance", "American Roadstar", "American Tourer", "Americus", "Ameristeel", "Ameritire", "Amp", "Amulet", "Antares", "Aoteli", "Aplus", "Aptany", "Ardent", "Arisun", "Armour", "Armstrong", "Arroyo", "Ascenso", "Aspen", "Astro", "ATF", "Atlander", "Atlas", "Atturo", "Autogrip", "Bearway", "BKT", "Black Bear", "BlackHawk", "Blacklion", "Bridgestone", "Briway", "Cambridge", "Camso", "Caraway", "Carbon", "Cargo Max", "Carlstar", "Castle Rock", "Cavalry", "Ceat", "Celimo", "Centara", "Centennial", "Coker", "Comforser", "Constellation", "Continental", "Continental-Mitas", "Converse", "Cooper", "Copartner", "Cordovan", "Cosmo", "Countrywide", "Crop Max", "Cropmaster", "Crossmax", "Crosswind", "Dawg Pound", "Dayton", "Dcenti", "Dean", "Deestone", "Del-Nat", "Delinte", "Delium", "Delta", "Demeter", "Dextero", "Diamondback", "Doral", "Double Coin", "Doublestar", "Douglas", "DRC", "Dunlop", "Duramas", "Duraturn", "Duro", "Durun", "Dynamaxx", "Dynamo", "Dynatrail", "Eldorado", "EuroGrip", "Evergreen", "Evoluxx", "Excel", "Falken", "FarmBoy", "Farmking", "Farroad", "Federal", "Ferentino", "Firestone", "Forceland", "Forceum", "Forerunner", "Formula", "Fortune", "Founders", "Freedom Hauler", "Freestar", "Fulda", "Fullrun", "Fullway", "Fury", "Fuzion", "Galaxy", "GBC", "General", "Geo-Trac", "GeoDrive", "Geoquest", "Geostar", "Giovanna", "Gladiator", "Goodride", "Goodtrip", "Goodyear", "Grand Spirit", "Green Max", "Greenball", "Greentrac", "Gremax", "GRI", "Grit King", "Grit Master", "Groundspeed", "GT Radial", "Haida", "Hankook", "Hartland", "Harvest King", "Headway", "Hemisphere", "Hercules", "Heritage", "Hi Run", "Hifly", "Horseshoe", "Husky", "Innova", "Interco", "Invovic", "Iris", "Ironhead", "Ironman", "ITP", "Jetzon", "JK Tire", "Journey", "Joyroad", "K9", "Kanati", "Kapsen", "Kelly", "Kenda", "Keter", "Kinforest", "Kingstar", "Kooler", "Kpatos", "Kumho", "Lancaster", "Lande", "LandFleet", "LandGolden", "Landsail", "Landspider", "Lanvigator", "Laufenn", "Leao", "Lenso", "Lexani", "LingLong", "Lionhart", "Lizetti", "Loadmaxx", "Long March", "Magna", "MarkMa", "Marshal", "Master", "Mastercraft", "Mastertrack", "Matrax", "Maxam", "MaxDura", "Maxtread", "Maxtrek", "Maxxis", "Mazzini", "Mesa", "Mickey Thompson", "Mile Pro", "Mileking", "Milestar", "Miletrip", "Mitas", "Mitco", "Momo", "Montreal", "MRF", "MRL", "Mud Claw", "Multi-Mile", "Nama", "Nanco", "Nankang", "National", "Navitrac", "NeoTerra", "Nereus", "Nexen", "Nika", "Nitto", "Noble", "Nokian", "Nutech", "Obor", "Ohtsu", "Omni", "Omni Trail", "Onyx", "Otani", "OTR", "Pantera", "Paragon", "Patriot", "Performer", "Petlas", "Pinnacle", "Pirelli", "Power King", "Predator", "Premiorri", "Primewell", "Primex", "Prinx", "Pro Armor", "Pro Comp", "Prometer", "Prostar", "Provider", "Quadboss", "Radar", "Ralson", "Rapid", "RBP", "Red Dirt Road", "Red Flame", "Regency", "Remington", "Rhino", "Roadclaw", "Roadcruza", "Roadguider", "Roadlux", "Roadmaster", "RoadOne", "RoadX", "Rodaco", "Rosava", "Rovelo", "RubberMaster", "Rydanz", "Saferich", "Saffiro", "Sailun", "Samson", "Sceptor", "Sigma", "Solar", "Solideal", "Solidway", "Solitek", "Sotera", "Specialty Tires of America", "Speedways", "Sportline", "Starfire", "Starlux", "Starmaxx", "Statewide", "STI", "Sumitomo", "Summit", "Sunny", "Suntek", "Super Cargo", "SuperMax", "Suretrac", "Sutong", "Synergy", "Taskmaster", "Tatko", "TBB", "Telstar", "Terra Raider", "Three-A", "Thunderer", "Tianli", "Tiron", "Titan", "Topstar", "Tornel", "Tourador", "Towmaster", "Towstar", "Toyo", "TracGard", "Trailer King", "Trailer Master", "TransEagle", "Transmax", "Transporter", "Travelstar", "Trazano", "Tredit", "Trelleborg", "Tri-Ace", "Triangle", "Turnpike", "Unicorn", "Valino", "Vanderbilt", "Vanguard", "Vantage", "Vee Rubber", "Veento", "Velocity", "Venezia", "Venom Power", "Vercelli", "Versatire", "Vitour", "Vizzoni", "Vogue", "Vredestein", "Wanda", "Wanli", "Waterfall", "Westlake", "Widetrack", "Wind Power", "Winrun", "Wolf Pack", "Xcellent", "Yatone", "Yellow Sea", "Yokohama", "Zeemax", "Zeetex", "Zenna", "Zestino", "Zeta"]; 

                                                foreach ($brands as $b) {
                                                    $selected = ($brand == $b) ? 'selected' : '';
                                                    echo "<option value=\"$b\" $selected>$b</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-search sc-btn-top mx-1">
                                    <button class="sc-button" type="submit">
                                        <span>Find tyres</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } else if ($type=='size') { ?>
                <div class="content-inner mb-40">
                    <div class="form-sl">
                        <?php
                        $width     = $_GET['width'] ?? '';
                        $ratio     = $_GET['ratio'] ?? '';
                        $diameter  = $_GET['diameter'] ?? '';
                        ?>

                        <form method="get" action="search.php">
                            <div class="wd-find-select flex">
                                <div class="inner-group">
                                    <!-- Width -->
                                    <div class="form-group-1">
                                        <div class="group-select">
                                            <select name="width" class="nice-select" tabindex="0" required>
                                                <option value="" disabled <?= $width == '' ? 'selected' : '' ?>>Width</option>
                                                <?php
                                                $widths = [155, 165, 175, 185, 195, 205, 215, 225, 235, 245];
                                                foreach ($widths as $w) {
                                                    $selected = $width == $w ? 'selected' : '';
                                                    echo "<option value=\"$w\" $selected>$w</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Ratio -->
                                    <div class="form-group-1">
                                        <div class="group-select">
                                            <select name="ratio" class="nice-select" tabindex="0" required>
                                                <option value="" disabled <?= $ratio == '' ? 'selected' : '' ?>>Ratio</option>
                                                <?php
                                                $ratios = [30, 35, 40, 45, 50, 55, 60, 65, 70, 75];
                                                foreach ($ratios as $r) {
                                                    $selected = $ratio == $r ? 'selected' : '';
                                                    echo "<option value=\"$r\" $selected>$r</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Diameter -->
                                    <div class="form-group-1">
                                        <div class="group-select">
                                            <select name="diameter" class="nice-select" tabindex="0" required>
                                                <option value="" disabled <?= $diameter == '' ? 'selected' : '' ?>>Diameter</option>
                                                <?php
                                                $diameters = [13, 14, 15, 16, 17, 18, 19, 20, 21];
                                                foreach ($diameters as $d) {
                                                    $selected = $diameter == $d ? 'selected' : '';
                                                    echo "<option value=\"$d\" $selected>$d</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Button -->
                                <div class="button-search sc-btn-top mx-1">
                                    <button class="sc-button" type="submit">
                                        <span>Find tyres</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="col-lg-12">
                <!-- Sorting and Filtering Controls -->
   <div class="sort-dropdown">
                    <form method="get" action="search.php">
                        <?php foreach ($_GET as $key => $value): ?>
                            <?php if ($key !== 'sort' && $key !== 'page'): ?>
                                <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <select name="sort" onchange="this.form.submit()">
                            <?php foreach ($sort_options as $key => $label): ?>
                                <option value="<?= $key ?>" <?= $sort == $key ? 'selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>

                <div class="flat-tabs themesflat-tabs">
                    <div class="content-tab">
                        <div class="content-inner tab-content">
                            <div class="list-car-grid-4 gap-30">
                                <?php
                                if ($result && $result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <div class="box-car-list hv-one">
                                            <div class="image-group relative ">
                                               <div class="top flex-two">
                                                    <ul class="d-flex gap-8">
                                                        <?php if (!empty($row['discount']) && (int)$row['discount'] > 0): ?>
                                                            <li class="flag-tag success">-<?php echo $row['discount']; ?>%</li>
                                                        <?php endif; ?>
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
                                                    <a href="tyre-detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                                                </h5>
                                                <div class="icon-box flex flex-wrap">
                                                    <?php if (!empty($row['size'])): ?>
                                                        <div class="icons flex-three">
                                                            <span>Size: <?php echo $row['size']; ?></span>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($row['style'])): ?>
                                                        <div class="icons flex-three">
                                                            <span>Style: <?php echo $row['style']; ?></span>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($row['car_model'])): ?>
                                                        <div class="icons flex-three">
                                                            <span>Model: <?php echo $row['car_model']; ?></span>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($row['trim'])): ?>
                                                        <div class="icons flex-three">
                                                            <span>Trim: <?php echo $row['trim']; ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="money fs-20 fw-5 lh-25 text-color-3">$<?php echo $row['price']; ?>
                                                </div>
                                                <div class="days-box flex justify-space align-center">
                                                    
                                                    <div class="img-author">
                                                        
                                                        <span class="font text-color-2 fw-5"><?php echo ucfirst($row['src']); ?></span>
                                                    </div>
                                                    <a href="tyre-detail.php?id=<?php echo $row['id']; ?>" class="view-car">View
                                                        tyre</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } 
                                } else {
                                    echo "<div class='col-lg-12'><p>No results found. Try adjusting your filters.</p></div>";
                                } ?>
                            </div>
                            
                            <!-- Pagination -->
                            <?php if ($total_rows > $per_page): ?>
                                <div class="pagination">
                                    <?php
                                    $total_pages = ceil($total_rows / $per_page);
                                    $query_params = $_GET;
                                    
                                    // Previous page link
                                    if ($page > 1) {
                                        $query_params['page'] = $page - 1;
                                        echo '<a href="?' . http_build_query($query_params) . '">&laquo; Previous</a>';
                                    }
                                    
                                    // Page numbers
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        $query_params['page'] = $i;
                                        $class = ($page == $i) ? 'active' : '';
                                        echo '<a class="' . $class . '" href="?' . http_build_query($query_params) . '">' . $i . '</a>';
                                    }
                                    
                                    // Next page link
                                    if ($page < $total_pages) {
                                        $query_params['page'] = $page + 1;
                                        echo '<a href="?' . http_build_query($query_params) . '">Next &raquo;</a>';
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>