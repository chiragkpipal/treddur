<?php include 'header.php'; ?>

            <!-- slider 9 -->
            <div class="mainslider slider home9" style="background-image: url('hero.png');">
                <div class="container relative">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content po-content-two">
                                <div class="heading center">
                                    <!--<div class="sub-title2 fs-20 fw-3 lh-25 text-color-1 wow fadeInUp"-->
                                    <!--    data-wow-delay="0ms" data-wow-duration="1200ms">Find the Best Tires at the Best-->
                                    <!--    Prices-->
                                    <!--</div>-->
                                    <h1 class="wow fadeInUp js-letters text-color-1"
                                        style=" text-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);" data-wow-delay="200ms"
                                        data-wow-duration="1200ms">Find the Right Tire at the Right Price – Instantly
                                    </h1>
                                </div>
                                <!-- filter -->
                                <div class="flat-filter-search home9">
                                    <div class="flat-tabs">
                                        <div class="box-tab style2 center">
                                            <!-- Tabs -->
                                            <ul class="menu-tab tab-title flex justify-center">
                                                <li class="item-title style active" id="vehicle-tab">
                                                    <span onclick="showTab('vehicle')"
                                                        class="inner fs-16 fw-5 lh-20">Vehicle</span>
                                                </li>
                                                <li class="item-title style" id="size-tab">
                                                    <span onclick="showTab('size')"
                                                        class="inner fs-16 fw-5 lh-20">Size</span>
                                                </li>
                                                <li class="item-title style" id="brand-tab">
                                                    <span onclick="showTab('brand')"
                                                        class="inner fs-16 fw-5 lh-20">Brand</span>
                                                </li>
                                            </ul>
                                        </div>


                                        <div class="content-tab style2" id="vehicle-content">
                                            <div class="content-inner">
                                                <div class="form-sl">
                                                    <form method="get" action="search.php">
                                                        <div class="wd-find-select flex">
                                                            <div class="inner-group">

                                                                <!-- Make -->
                                                                <div class="form-group-1">
                                                                    <div class="group-select">
                                                                        <select class="nice-select" tabindex="0" onchange="fetchCarModel(this.value)" required>
                                                                            <option value="" selected disabled>Make
                                                                            </option>
                                                                        <?php
$brands = ["Acura", "Alfa Romeo", "American Motors", "Aston Martin", "Audi", "Avanti", "BMW", "Bentley", "Bertone", "Buick", "Cadillac", "Checker", "Chevrolet", "Chrysler", "Coda", "Daewoo", "Daihatsu", "DeLorean", "Dodge", "Eagle", "Ferrari", "Fiat", "Fisker", "Ford", "Freightliner", "GMC", "Genesis", "Geo", "Honda", "Hummer", "Hyundai", "INEOS", "Infiniti", "International", "Isuzu", "Jaguar", "Jeep", "Karma", "Kia", "Lamborghini", "Lancia", "Land Rover", "Lexus", "Lincoln", "Lordstown Motors", "Lotus", "Lucid", "Maserati", "Maybach", "Mazda", "McLaren", "Mercedes-Benz", "Mercury", "Merkur", "Mini", "Mitsubishi", "Mobility Ventures", "Nissan", "Oldsmobile", "Panoz", "Peugeot", "Pininfarina", "Plymouth", "Polestar", "Pontiac", "Porsche", "RAM", "Renault", "Rivian", "Rolls-Royce", "SRT", "Saab", "Saleen", "Saturn", "Scion", "Smart", "Sterling", "Subaru", "Suzuki", "Tesla", "Toyota", "Triumph", "VPG", "VinFast", "Volkswagen", "Volvo", "Yugo"]; 
?>

    <?php foreach ($brands as $brand): ?>
        <option value="<?php echo htmlspecialchars($brand); ?>">
            <?php echo htmlspecialchars($brand); ?>
        </option>
    <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
<script>
function fetchCarModel(brand) {
  fetch(`/api/models?brand=${encodeURIComponent(brand)}&queryType=makeModel`)
    .then(response => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then(data => {
                document.getElementById('modeloptions').value="";
                document.getElementById('modelyear').value="";

      const select = document.getElementById('models');
      select.value="";
      select.innerHTML = '<option value="">Select a model</option>'; // Clear and reset

      data.forEach(label => {
        const option = document.createElement('option');
        option.value = label;
        option.textContent = label;
        select.appendChild(option);
      });

      console.log("Car model labels:", data);
    })
    .catch(error => {
      console.error("Fetch error:", error);
    });
}

</script>
                                                                <!-- Model -->
                                                                <div class="form-group-1">
                                                                    <div class="group-select">
                                                                        <select class="nice-select" name="model" id="models" onchange="fetchCarYear(this.value)" tabindex="0" required>
                                                                            <option value="" selected disabled>Model
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
<script>
function fetchCarYear(model) {
  fetch(`/api/models?brand=${encodeURIComponent(model)}&queryType=makeModelYear`)
    .then(response => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then(data => {
        document.getElementById('modeloptions').value="";
      const select = document.getElementById('modelyear');
      select.value="";
      select.innerHTML = '<option value="">Select a Model Year</option>'; // Clear and reset

      data.forEach(label => {
        const option = document.createElement('option');
        option.value = label;
        option.textContent = label;
        select.appendChild(option);
      });

      console.log("Car model labels:", data);
    })
    .catch(error => {
      console.error("Fetch error:", error);
    });
}

</script>
                                                                <!-- Trim -->
                                                                <div class="form-group-1">
                                                                    <div class="group-select">
                                                                        <select class="nice-select" name="modelyear" id="modelyear" onchange="fetchCarOption(this.value)" tabindex="0" required>
                                                                            <option value="" selected disabled>Model Year
                                                                            </option>
                                                                           
                                                                        </select>
                                                                    </div>
                                                                </div>
<script>
let modelOptionData = {}; // Store additional data keyed by name

function fetchCarOption(model) {
  fetch(`/api/models?brand=${encodeURIComponent(model)}&queryType=makeModelYearOption`)
    .then(response => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then(data => {
      const select = document.getElementById('modeloptions');
      select.value = "";
      select.innerHTML = '<option value="">Select a Model Option</option>';
      modelOptionData = {}; // Reset stored data

      data.forEach(entry => {
        if (typeof entry === 'string') {
          const option = document.createElement('option');
          option.value = entry;
          option.textContent = entry;
          select.appendChild(option);
        } else if (typeof entry === 'object' && entry.name && entry.data) {
          const { name, data: extra } = entry;

          const option = document.createElement('option');
          option.value = name;
          option.textContent = name;
          select.appendChild(option);

          modelOptionData[name] = extra; // Store data by name
        }
      });

      console.log("Model options stored data:", modelOptionData);
    })
    .catch(error => {
      console.error("Fetch error:", error);
    });
}
</script>
                                     <!-- Tire Size -->
                                                                <div class="form-group-1">
                                                                    <div class="group-select">
                                                                        <select class="nice-select" id="modeloptions" onchange="redirectToModelOption(this.value)" name="option" tabindex="0" required>
                                                                            <option value="" selected disabled>Model Option
                                                                            </option>
                                                                          
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <script>
function redirectToModelOption(name) {
  const data = modelOptionData[name];
  if (!data) return;

  const params = new URLSearchParams(data).toString();
  const redirectUrl = `/search?${params}`;
console.log(redirectUrl);
  // Redirect
  window.location.href = redirectUrl;
}
</script>
                                                            </div>


                                                          <div class="button-search sc-btn-top mx-1">
                                                               <button class="sc-button" type="submit">
                                                                    <span>Find tires</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- End Job  Search Form-->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-tab style2" id="size-content">
                                            <div class="content-inner">
                                                <div class="form-sl">
                                                    <form method="get" action="search.php">
                                                        <div class="wd-find-select flex">
                                                            <div class="inner-group">
                                                                <!-- Width -->
                                                                <div class="form-group-1">
                                                                    <div class="group-select">
                                                                        <select name="width" class="nice-select" tabindex="0" required>
                                                                            <option value="" selected disabled>Width
                                                                            </option>
                                                                            <option value="155">155</option>
                                                                            <option value="165">165</option>
                                                                            <option value="175">175</option>
                                                                            <option value="185">185</option>
                                                                            <option value="195">195</option>
                                                                            <option value="205">205</option>
                                                                            <option value="215">215</option>
                                                                            <option value="225">225</option>
                                                                            <option value="235">235</option>
                                                                            <option value="245">245</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Ratio -->
                                                                <div class="form-group-1">
                                                                    <div class="group-select">
                                                                        <select name="ratio" class="nice-select" tabindex="0" required>
                                                                            <option value="" selected disabled>Ratio
                                                                            </option>
                                                                            <option value="30">30</option>
                                                                            <option value="35">35</option>
                                                                            <option value="40">40</option>
                                                                            <option value="45">45</option>
                                                                            <option value="50">50</option>
                                                                            <option value="55">55</option>
                                                                            <option value="60">60</option>
                                                                            <option value="65">65</option>
                                                                            <option value="70">70</option>
                                                                            <option value="75">75</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Diameter -->
                                                                <div class="form-group-1">
                                                                    <div class="group-select">
                                                                        <select name="diameter" class="nice-select" tabindex="0" required>
                                                                            <option value="" selected disabled>Diameter
                                                                            </option>
                                                                            <option value="13">13</option>
                                                                            <option value="14">14</option>
                                                                            <option value="15">15</option>
                                                                            <option value="16">16</option>
                                                                            <option value="17">17</option>
                                                                            <option value="18">18</option>
                                                                            <option value="19">19</option>
                                                                            <option value="20">20</option>
                                                                            <option value="21">21</option>
                                                                            <option value="22">22</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="button-search sc-btn-top mx-1">
                                                               <button class="sc-button" type="submit">
                                                                    <span>Find tires</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- End Job  Search Form-->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-tab style2" id="brand-content">
                                            <div class="content-inner">
                                                <div class="form-sl">
                                                    <form method="get" action="search.php">
                                                        <div class="wd-find-select flex">
                                                            <div class="inner-group">
                                                                <div class="form-group-1">
                                                                    <div class="group-select">
                                                                        <select name="brand" class="nice-select" tabindex="0" required>
                                                                            <option value="" selected disabled>Brand
                                                                            </option>
                                                                           <?php
$brands = ["Accelera", "Accelus", "Achieva", "Achilles", "Advance", "Advanta", "Aeolus", "Ag Plus", "Agstar", "Air-Loc", "Akuret", "Alliance", "American Roadstar", "American Tourer", "Americus", "Ameristeel", "Ameritire", "Amp", "Amulet", "Antares", "Aoteli", "Aplus", "Aptany", "Ardent", "Arisun", "Armour", "Armstrong", "Arroyo", "Ascenso", "Aspen", "Astro", "ATF", "Atlander", "Atlas", "Atturo", "Autogrip", "Bearway", "BKT", "Black Bear", "BlackHawk", "Blacklion", "Bridgestone", "Briway", "Cambridge", "Camso", "Caraway", "Carbon", "Cargo Max", "Carlstar", "Castle Rock", "Cavalry", "Ceat", "Celimo", "Centara", "Centennial", "Coker", "Comforser", "Constellation", "Continental", "Continental-Mitas", "Converse", "Cooper", "Copartner", "Cordovan", "Cosmo", "Countrywide", "Crop Max", "Cropmaster", "Crossmax", "Crosswind", "Dawg Pound", "Dayton", "Dcenti", "Dean", "Deestone", "Del-Nat", "Delinte", "Delium", "Delta", "Demeter", "Dextero", "Diamondback", "Doral", "Double Coin", "Doublestar", "Douglas", "DRC", "Dunlop", "Duramas", "Duraturn", "Duro", "Durun", "Dynamaxx", "Dynamo", "Dynatrail", "Eldorado", "EuroGrip", "Evergreen", "Evoluxx", "Excel", "Falken", "FarmBoy", "Farmking", "Farroad", "Federal", "Ferentino", "Firestone", "Forceland", "Forceum", "Forerunner", "Formula", "Fortune", "Founders", "Freedom Hauler", "Freestar", "Fulda", "Fullrun", "Fullway", "Fury", "Fuzion", "Galaxy", "GBC", "General", "Geo-Trac", "GeoDrive", "Geoquest", "Geostar", "Giovanna", "Gladiator", "Goodride", "Goodtrip", "Goodyear", "Grand Spirit", "Green Max", "Greenball", "Greentrac", "Gremax", "GRI", "Grit King", "Grit Master", "Groundspeed", "GT Radial", "Haida", "Hankook", "Hartland", "Harvest King", "Headway", "Hemisphere", "Hercules", "Heritage", "Hi Run", "Hifly", "Horseshoe", "Husky", "Innova", "Interco", "Invovic", "Iris", "Ironhead", "Ironman", "ITP", "Jetzon", "JK Tire", "Journey", "Joyroad", "K9", "Kanati", "Kapsen", "Kelly", "Kenda", "Keter", "Kinforest", "Kingstar", "Kooler", "Kpatos", "Kumho", "Lancaster", "Lande", "LandFleet", "LandGolden", "Landsail", "Landspider", "Lanvigator", "Laufenn", "Leao", "Lenso", "Lexani", "LingLong", "Lionhart", "Lizetti", "Loadmaxx", "Long March", "Magna", "MarkMa", "Marshal", "Master", "Mastercraft", "Mastertrack", "Matrax", "Maxam", "MaxDura", "Maxtread", "Maxtrek", "Maxxis", "Mazzini", "Mesa", "Mickey Thompson", "Mile Pro", "Mileking", "Milestar", "Miletrip", "Mitas", "Mitco", "Momo", "Montreal", "MRF", "MRL", "Mud Claw", "Multi-Mile", "Nama", "Nanco", "Nankang", "National", "Navitrac", "NeoTerra", "Nereus", "Nexen", "Nika", "Nitto", "Noble", "Nokian", "Nutech", "Obor", "Ohtsu", "Omni", "Omni Trail", "Onyx", "Otani", "OTR", "Pantera", "Paragon", "Patriot", "Performer", "Petlas", "Pinnacle", "Pirelli", "Power King", "Predator", "Premiorri", "Primewell", "Primex", "Prinx", "Pro Armor", "Pro Comp", "Prometer", "Prostar", "Provider", "Quadboss", "Radar", "Ralson", "Rapid", "RBP", "Red Dirt Road", "Red Flame", "Regency", "Remington", "Rhino", "Roadclaw", "Roadcruza", "Roadguider", "Roadlux", "Roadmaster", "RoadOne", "RoadX", "Rodaco", "Rosava", "Rovelo", "RubberMaster", "Rydanz", "Saferich", "Saffiro", "Sailun", "Samson", "Sceptor", "Sigma", "Solar", "Solideal", "Solidway", "Solitek", "Sotera", "Specialty Tires of America", "Speedways", "Sportline", "Starfire", "Starlux", "Starmaxx", "Statewide", "STI", "Sumitomo", "Summit", "Sunny", "Suntek", "Super Cargo", "SuperMax", "Suretrac", "Sutong", "Synergy", "Taskmaster", "Tatko", "TBB", "Telstar", "Terra Raider", "Three-A", "Thunderer", "Tianli", "Tiron", "Titan", "Topstar", "Tornel", "Tourador", "Towmaster", "Towstar", "Toyo", "TracGard", "Trailer King", "Trailer Master", "TransEagle", "Transmax", "Transporter", "Travelstar", "Trazano", "Tredit", "Trelleborg", "Tri-Ace", "Triangle", "Turnpike", "Unicorn", "Valino", "Vanderbilt", "Vanguard", "Vantage", "Vee Rubber", "Veento", "Velocity", "Venezia", "Venom Power", "Vercelli", "Versatire", "Vitour", "Vizzoni", "Vogue", "Vredestein", "Wanda", "Wanli", "Waterfall", "Westlake", "Widetrack", "Wind Power", "Winrun", "Wolf Pack", "Xcellent", "Yatone", "Yellow Sea", "Yokohama", "Zeemax", "Zeetex", "Zenna", "Zestino", "Zeta"]; 
?>

    <?php foreach ($brands as $brand): ?>
        <option value="<?php echo htmlspecialchars($brand); ?>">
            <?php echo htmlspecialchars($brand); ?>
        </option>
    <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="button-search sc-btn-top mx-1">
                                                                <button class="sc-button" type="submit">
                                                                    <span>Find tires</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- End Job  Search Form-->
                                                </div>
                                            </div>
                                        </div>



                                        <!-- JavaScript to toggle the tabs -->
                                        <script>
                                        function showTab(tab) {
                                            // Get all tab contents
                                            const tabs = ['vehicle', 'size', 'brand'];

                                            // Hide all content divs
                                            tabs.forEach(function(tabName) {
                                                document.getElementById(tabName + '-content').style.display =
                                                    'none';
                                            });
                                            // Show the selected content div
                                            document.getElementById(tab + '-content').style.display = 'block';
                                        }

                                        // Optional: Automatically show the first tab content on page load
                                        document.addEventListener("DOMContentLoaded", function() {
                                            showTab('vehicle'); // Default to the vehicle tab
                                        });
                                        </script>

                                    </div>
                                </div>
                                <!-- <div class="wrap-icon flex align-center link-style-3 justify-center">
                                    <div class="icon-box text-color-1 font">
                                        <span class="icon-autodeal-suv"></span>
                                        <a href="#">SUV</a>
                                    </div>
                                    <div class="icon-box text-color-1 font">
                                        <span class="icon-autodeal-coupe"></span>
                                        <a href="#">Coupe</a>
                                    </div>
                                    <div class="icon-box text-color-1 font">
                                        <span class="icon-autodeal-hatchback"></span>
                                        <a href="#">Hatchback</a>
                                    </div>
                                    <div class="icon-box text-color-1 font">
                                        <span class="icon-autodeal-hybrid"></span>
                                        <a href="#">Hybrid</a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- icon box -->
            <section class="tf-section d-none">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-section flex align-center justify-space flex-wrap gap-20">
                                <h2 class="wow fadeInUpSmall" data-wow-delay="0.2s" data-wow-duration="1000ms">Search by
                                    Vehicle
                                </h2>
                                <a href="#" class="tf-btn-arrow wow fadeInUpSmall" data-wow-delay="0.2s"
                                    data-wow-duration="1000ms">View all<i class="icon-autodeal-btn-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-12 ">
                        <div class="swiper partner-slide overflow-hidden swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                                <div class="swiper-wrapper" id="swiper-wrapper-20b8cfd25ed58a4e" aria-live="polite" style="transform: translate3d(-2040px, 0px, 0px); transition-duration: 0ms;">
                                    <div class="swiper-slide" role="group" aria-label="1 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner1.png" src="assets/images/partner/partner1.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Land Rover </div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="2 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner2.png" src="assets/images/partner/partner2.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Kia</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="3 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner3.png" src="assets/images/partner/partner3.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Toyota</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="4 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner4.png" src="assets/images/partner/partner4.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Jeep</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="5 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner5.png" src="assets/images/partner/partner5.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Nissan</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="6 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner6.png" src="assets/images/partner/partner6.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Ford</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="7 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner1.png" src="assets/images/partner/partner1.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Land Rover </div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="8 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner2.png" src="assets/images/partner/partner2.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Kia</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="9 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner3.png" src="assets/images/partner/partner3.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Toyota</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide swiper-slide-prev" role="group" aria-label="10 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner4.png" src="assets/images/partner/partner4.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Jeep</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="11 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner5.png" src="assets/images/partner/partner5.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Nissan</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide swiper-slide-next" role="group" aria-label="12 / 12" style="width: 184px; margin-right: 20px;">
                                        <a href="#" class="partner-item style-1">
                                            <div class="image">
                                                <img class="lazyload" data-src="assets/images/partner/partner6.png" src="assets/images/partner/partner6.png" alt="images">
                                            </div>
                                            <div class="content center">
                                                <div class="fs-16 fw-6 title text-color-2 font-2">Ford</div>
                                                <span class="sub-title fs-12 fw-4 font-2">271 Tires</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                            <div class="swiper-pagination4 swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 6"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 7"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 8"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 9"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 10"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 11"></span></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- widegt List tire -->
            <section class="tf-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-section flex align-center justify-space flex-wrap gap-20">
                                <h2 class="wow fadeInUpSmall" data-wow-delay="0.2s" data-wow-duration="1000ms">Latest Deals</h2>
                                <a href="deals-offers.php" class="tf-btn-arrow wow fadeInUpSmall" data-wow-delay="0.2s"
                                    data-wow-duration="1000ms">View all<i class="icon-autodeal-btn-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="flat-tabs themesflat-tabs">
                                <div class="content-tab">
                                    <div class="content-inner tab-content">
                                        <div class="swiper-container tf-sw-mobile3 ">
                                            <div class="swiper-wrapper">
                                                <?php 
$sql = "SELECT * FROM tires WHERE deals = 1 ORDER BY id DESC LIMIT 10";
$result = mysqli_query($conn, $sql);
?>
                                                           <?php
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?> <div class="swiper-slide">
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
                                                    </div></div>
                                                <?php } } else {
                                                echo "No results found";
                                                } ?>
                                               
                                                   
                                                
                                           
                                            </div>
                                        </div>
                                        <div class="swiper-button-next style-2"></div>
                                        <div class="swiper-button-prev style-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- widget -->
            <section class="tf-section3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-section center w-560  m0-auto wow fadeInUpSmall" data-wow-delay="0.2s"
                                data-wow-duration="1000ms">
                                <h2>Get the best deal for tires on Treddur</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="tf-icon-box style-3 mg-42">
                                <div class="inner-wrap flex-three">
                                    <div class="icon">
                                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.9062 19.3124L10.125 18.2812C8.8125 17.9999 7.59375 19.0312 7.59375 20.3437V22.3124C7.59375 23.9062 8.71875 24.2812 10.3125 24.2812H15.75C17.0625 24.2812 17.5312 23.7187 17.5312 22.9687V22.6874C17.625 21.0937 16.5 19.6874 14.9062 19.3124ZM9.375 22.4062V20.3437C9.375 20.1562 9.5625 19.9687 9.75 20.0624L14.5312 21.0937C15.1875 21.2812 15.6562 21.8437 15.75 22.4999C13.3125 22.4062 9.65625 22.4999 9.375 22.4062ZM21.1875 25.2187H33C33.4688 25.2187 33.9375 24.8437 33.9375 24.2812C33.9375 23.7187 33.5625 23.3437 33 23.3437H21.1875C20.7188 23.3437 20.25 23.7187 20.25 24.2812C20.25 24.8437 20.7188 25.2187 21.1875 25.2187Z"
                                                fill="CurrentColor"></path>
                                            <path
                                                d="M59.5312 55.2188L52.9688 44.7188C57.1875 40.4062 58.125 33.6562 54.75 28.4062C53.7188 26.8125 52.4062 25.4062 50.8125 24.375V19.5C50.8125 17.9062 50.3438 16.2188 49.3125 14.8125H51.6562C53.0625 14.8125 54.1875 13.6875 54.1875 12.2812V11.25C54.1875 9.84375 53.0625 8.71875 51.6562 8.71875H50.0625C48.5625 8.71875 47.25 9.46875 46.3125 10.6875L42.6562 3.1875C41.9062 1.3125 40.125 0 38.0625 0H16.125C14.0625 0 12.2812 1.21875 11.5312 3.09375L7.875 10.6875C7.03125 9.46875 5.625 8.71875 4.125 8.71875H2.53125C1.125 8.71875 0 9.84375 0 11.25V12.2812C0 13.6875 1.125 14.8125 2.53125 14.8125H4.875C3.84375 16.125 3.375 17.8125 3.375 19.5V25.125C3.375 27.2812 4.125 29.3438 5.625 31.125V35.3438C5.625 37.2188 7.125 38.7188 9 38.7188H12.4688C14.3438 38.7188 15.8438 37.2188 15.8438 35.3438V33.6562H30.2812C29.9062 36.6562 30.4688 39.75 32.1562 42.4688C35.4375 47.7188 41.8125 49.9688 47.625 48L54.1875 58.5C55.125 60 57 60.375 58.5 59.5312C60 58.5938 60.375 56.7188 59.5312 55.2188ZM50.0625 10.5938H51.6562C52.0312 10.5938 52.3125 10.875 52.3125 11.25V12.2812C52.3125 12.6562 52.0312 12.9375 51.6562 12.9375H47.625C47.5312 12.8438 47.4375 12.6562 47.25 12.4688C47.5312 12.2812 48.1875 10.5938 50.0625 10.5938ZM13.2188 3.84375C13.6875 2.625 14.8125 1.875 16.125 1.875H38.0625C39.375 1.875 40.5 2.625 41.0625 3.9375C41.4375 4.6875 45.2812 12.75 45.75 13.4062H8.53125C8.90625 12.75 8.53125 13.5938 13.2188 3.84375ZM1.875 12.2812V11.25C1.875 10.875 2.15625 10.5938 2.53125 10.5938H4.125C5.0625 10.5938 5.90625 11.0625 6.375 11.8125L6.84375 12.5625C6.75 12.75 6.65625 12.8438 6.46875 13.0312H2.53125C2.15625 12.9375 1.875 12.6562 1.875 12.2812ZM14.0625 35.25C14.0625 36.0938 13.4062 36.75 12.5625 36.75H9C8.15625 36.75 7.5 36.0938 7.5 35.25V32.5312C8.625 33.1875 9.9375 33.5625 11.25 33.5625H14.0625V35.25ZM11.1562 31.7813C7.6875 31.7813 5.15625 28.5 5.15625 25.0312V19.4062C5.15625 17.8125 5.8125 16.3125 6.9375 15.0938H47.1562C48.375 16.3125 48.9375 17.8125 48.9375 19.4062V23.25C48.1875 22.875 47.3438 22.5938 46.5938 22.4062V20.25C46.5938 18.8438 45.2812 17.9062 44.0625 18.1875L39.2812 19.2188C37.7812 19.5938 36.6562 20.9062 36.6562 22.5C36.6562 22.6875 36.5625 23.25 37.0312 23.7188L36.4688 24C35.1562 24.8438 34.125 25.7812 33.1875 26.9062H21.1875C20.7188 26.9062 20.25 27.2812 20.25 27.8438C20.25 28.4062 20.625 28.7812 21.1875 28.7812H31.875C31.3125 29.7188 30.9375 30.75 30.6562 31.6875H11.1562V31.7813ZM40.5 22.5H38.4375C38.5312 21.8438 39 21.2812 39.6562 21.1875C39.75 21.1875 39.75 21.1875 39.6562 21.1875L44.5312 20.1562C44.7188 20.1562 44.9062 20.25 44.9062 20.4375V22.3125C43.4062 22.0312 41.9062 22.125 40.5 22.5ZM33.75 41.4375C30.375 36.0938 32.0625 28.9688 37.4062 25.5938C42.75 22.2188 49.875 23.9062 53.25 29.25C56.625 34.5938 54.9375 41.7188 49.5938 45.0938C44.1562 48.4688 37.125 46.875 33.75 41.4375ZM57.5625 57.9375C57 58.3125 56.1562 58.125 55.7812 57.5625L49.4062 47.3438C49.7812 47.1562 50.1562 46.9688 50.5312 46.6875C50.9062 46.5 51.2812 46.2188 51.5625 45.9375L57.9375 56.1562C58.3125 56.8125 58.125 57.5625 57.5625 57.9375Z"
                                                fill="CurrentColor"></path>
                                        </svg>
                                    </div>
                                    <h3><a href="#">Are you looking for a tire?</a></h3>

                                </div>

                                <div class="content">

                                    <p>Save time and money as you no longer need to visit multiple stores to find the
                                        best tire.</p>
                                
                                </div>


                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="image">
                                <img class="lazyload w-100" data-src="transparent_tires.png"
                                    src="transparent_tires.png" alt="images">

                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="tf-icon-box style-3 mg-42">
                                <div class="inner-wrap flex-three">
                                    <div class="icon">
                                        <svg width="58" height="60" viewBox="0 0 58 60" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.9688 39.5624L10.9062 38.4374C9.5 38.1562 8.28125 39.1874 8.28125 40.5937V42.7499C8.28125 44.4374 9.59375 44.7187 11.1875 44.8124H17C18.0312 44.8124 18.875 44.4374 18.875 43.4062V43.1249C18.7812 41.3437 17.6562 39.9374 15.9688 39.5624ZM10.0625 42.8437V40.4999C10.0625 40.2187 10.25 40.0312 10.5313 40.1249L15.6875 41.2499C16.4375 41.4374 17 42.0937 17.0937 42.8437C16.9062 42.9374 10.1563 42.9374 10.0625 42.8437ZM47.0938 38.4374L41.9375 39.5624C40.25 39.9374 39.125 41.3437 39.125 43.0312C39.125 43.1249 38.9375 44.3437 40.25 44.6249C40.9062 44.8124 45.125 44.7187 46.9062 44.7187C48.5 44.7187 49.7187 44.3437 49.7187 42.6562V40.4999C49.8125 39.1874 48.5 38.1562 47.0938 38.4374ZM47.9375 42.8437C47.6562 42.9374 41.0938 42.9374 41 42.9374C41.0938 42.1874 41.5625 41.5312 42.3125 41.3437L47.4688 40.2187C47.75 40.1249 47.9375 40.3124 47.9375 40.5937V42.8437ZM35.2812 43.8749H22.7187C22.25 43.8749 21.7812 44.2499 21.7812 44.8124C21.7812 45.3749 22.1562 45.7499 22.7187 45.7499H35.2812C35.75 45.7499 36.2188 45.3749 36.2188 44.8124C36.2188 44.2499 35.8438 43.8749 35.2812 43.8749ZM35.2812 47.7187H22.7187C22.25 47.7187 21.7812 48.0937 21.7812 48.6562C21.7812 49.2187 22.1562 49.5937 22.7187 49.5937H35.2812C35.75 49.5937 36.2188 49.2187 36.2188 48.6562C36.2188 48.0937 35.8438 47.7187 35.2812 47.7187Z"
                                                fill="CurrentColor"></path>
                                            <path
                                                d="M55.25 28.3125H53.5625C51.9688 28.3125 50.4688 29.0625 49.625 30.4688L47.9375 27.0938C52.8125 24.8438 56.1875 19.9688 56.1875 14.25C56.0938 6.375 49.7188 0 41.9375 0C34.1562 0 27.7812 6.375 27.7812 14.1562C27.7812 15.8438 28.0625 17.4375 28.625 18.9375H17.2812C15.125 18.9375 13.1562 20.25 12.4062 22.2188L8.46875 30.375C7.625 29.0625 6.125 28.2188 4.53125 28.2188H2.75C1.34375 28.2188 0.125 29.4375 0.125 30.8438V31.9687C0.125 33.375 1.25 34.5938 2.75 34.5938H5.46875C4.34375 36 3.78125 37.7812 3.78125 39.6562V45.6562C3.78125 47.9062 4.625 50.1562 6.21875 52.0312V56.5312C6.21875 58.5 7.8125 60 9.6875 60H13.4375C15.4062 60 16.9062 58.4062 16.9062 56.5312V54.75H41V56.5312C41 58.5 42.5938 60 44.4688 60H48.2188C50.1875 60 51.6875 58.4062 51.6875 56.5312V52.0312C53.2812 50.25 54.125 48.0938 54.125 45.75V39.75C54.125 38.625 53.8438 37.4062 53.375 36.375C53.0938 35.8125 52.8125 35.25 52.3438 34.6875H55.25C56.6562 34.6875 57.875 33.5625 57.875 32.0625V30.9375C57.7812 29.4375 56.6562 28.3125 55.25 28.3125ZM41.9375 1.875C48.7812 1.875 54.3125 7.40625 54.3125 14.1562C54.3125 20.9062 48.7812 26.4375 42.0312 26.4375C35.2812 26.4375 29.75 20.9062 29.75 14.1562C29.75 7.40625 35.1875 1.875 41.9375 1.875ZM14.0938 22.9688C14.5625 21.6562 15.875 20.8125 17.2812 20.8125H29.4688C31.8125 25.3125 36.5 28.3125 41.9375 28.3125C43.4375 28.3125 44.8438 28.125 46.1562 27.6562C46.25 27.75 48.5 32.5312 48.875 33.1875H9.03125C9.40625 32.625 8.84375 33.9375 14.0938 22.9688ZM2 31.9687V30.8438C2 30.375 2.375 30 2.75 30H4.4375C6.5 30 7.25 31.875 7.4375 32.1562C7.34375 32.3438 7.15625 32.5312 7.0625 32.7188H2.75C2.375 32.7188 2 32.4375 2 31.9687ZM15.125 56.4375C15.125 57.375 14.375 58.125 13.4375 58.125H9.6875C8.75 58.125 8 57.375 8 56.4375V53.4375C9.21875 54.1875 10.625 54.5625 12.0312 54.5625H15.125V56.4375ZM48.3125 58.125H44.5625C43.625 58.125 42.875 57.375 42.875 56.4375V54.6562H45.9687C47.375 54.6562 48.7812 54.2812 50 53.5312V56.5312C50 57.375 49.25 58.125 48.3125 58.125ZM52.4375 45.5625C52.4375 49.3125 49.7187 52.7812 45.9687 52.7812H12.0312C8.28125 52.7812 5.5625 49.2188 5.5625 45.5625V39.5625C5.5625 37.875 6.21875 36.1875 7.53125 34.9688H50.5625C51.125 35.5312 51.5938 36.1875 51.9688 36.9375C52.3438 37.7812 52.5312 38.7188 52.5312 39.5625V45.5625H52.4375ZM56 31.9687C56 32.4375 55.625 32.7188 55.25 32.7188H50.9375C50.75 32.5312 50.6562 32.3438 50.5625 32.1562C50.8438 31.875 51.5 30 53.5625 30H55.25C55.7188 30 56 30.375 56 30.75V31.9687Z"
                                                fill="CurrentColor"></path>
                                            <path
                                                d="M39.125 17.9062C39.125 17.4375 38.75 16.9687 38.1875 16.9687C37.625 16.9687 37.25 17.3437 37.25 17.9062C37.25 20.1562 38.8438 22.0312 41 22.4062V23.625C41 24.0938 41.375 24.5625 41.9375 24.5625C42.5 24.5625 42.875 24.1875 42.875 23.625V22.4062C45.0312 21.9375 46.625 20.1562 46.625 17.9062C46.625 15.6562 45.0312 13.7812 42.875 13.4062V7.78125C44 8.15625 44.75 9.1875 44.75 10.4062C44.75 10.875 45.125 11.3438 45.6875 11.3438C46.25 11.3438 46.625 10.9688 46.625 10.4062C46.625 8.15625 45.0312 6.28125 42.875 5.90625V4.6875C42.875 4.21875 42.5 3.75 41.9375 3.75C41.375 3.75 41 4.125 41 4.6875V5.90625C38.8438 6.375 37.25 8.15625 37.25 10.4062C37.25 12.6562 38.8438 14.5312 41 14.9062V20.4375C39.9688 20.1562 39.125 19.125 39.125 17.9062ZM44.75 17.9062C44.75 19.125 43.9062 20.1562 42.875 20.5312V15.2812C44 15.5625 44.75 16.6875 44.75 17.9062ZM39.125 10.4062C39.125 9.1875 39.9688 8.15625 41 7.78125V13.125C39.9688 12.6562 39.125 11.625 39.125 10.4062Z"
                                                fill="CurrentColor"></path>
                                        </svg>
                                    </div>
                                    <h3><a href="#">Tired of browsing multiple websites or stores?</a></h3>
                                </div>

                                <div class="content">
                                    <p>Find your perfect tire match and compare through multiple providers and get the best price.</p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </section>

            <section class="loan-calculator inner-7" style="background-image: url('https://www.tirerack.com/content/dam/tirerack/desktop/components/hero/s23_Home.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading center">
                                <h1 class="text-color-1 wow fadeInUpSmall mb-2" style="font-weight: 800" data-wow-delay="0.2s"
                                    data-wow-duration="1000ms">Why Choose Treddur</h1>
                                <p class="text-color-1 wow fadeInUpSmall" data-wow-delay="0.2s"
                                    data-wow-duration="1000ms">We do the heavy lifting so you can focus on what matters—getting the best deal. Here's why thousands of drivers trust us
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tf-section3">
                <div class="container">
                    <div class="row  section-icon-list z-2 relative">
                        <div class="col-lg-12">
                            <div class="swiper-container overflow-visible tf-sw-mobile4" data-preview="4"
                                data-space="30">
                                <div class="swiper-wrapper grid-sw-3">
                                    <div class="swiper-slide">
                                        <div class="tf-icon-box style-1">
                                            <div class="icon">
                                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14.9062 19.3124L10.125 18.2812C8.8125 17.9999 7.59375 19.0312 7.59375 20.3437V22.3124C7.59375 23.9062 8.71875 24.2812 10.3125 24.2812H15.75C17.0625 24.2812 17.5312 23.7187 17.5312 22.9687V22.6874C17.625 21.0937 16.5 19.6874 14.9062 19.3124ZM9.375 22.4062V20.3437C9.375 20.1562 9.5625 19.9687 9.75 20.0624L14.5312 21.0937C15.1875 21.2812 15.6562 21.8437 15.75 22.4999C13.3125 22.4062 9.65625 22.4999 9.375 22.4062ZM21.1875 25.2187H33C33.4688 25.2187 33.9375 24.8437 33.9375 24.2812C33.9375 23.7187 33.5625 23.3437 33 23.3437H21.1875C20.7188 23.3437 20.25 23.7187 20.25 24.2812C20.25 24.8437 20.7188 25.2187 21.1875 25.2187Z"
                                                        fill="CurrentColor" />
                                                    <path
                                                        d="M59.5312 55.2188L52.9688 44.7188C57.1875 40.4062 58.125 33.6562 54.75 28.4062C53.7188 26.8125 52.4062 25.4062 50.8125 24.375V19.5C50.8125 17.9062 50.3438 16.2188 49.3125 14.8125H51.6562C53.0625 14.8125 54.1875 13.6875 54.1875 12.2812V11.25C54.1875 9.84375 53.0625 8.71875 51.6562 8.71875H50.0625C48.5625 8.71875 47.25 9.46875 46.3125 10.6875L42.6562 3.1875C41.9062 1.3125 40.125 0 38.0625 0H16.125C14.0625 0 12.2812 1.21875 11.5312 3.09375L7.875 10.6875C7.03125 9.46875 5.625 8.71875 4.125 8.71875H2.53125C1.125 8.71875 0 9.84375 0 11.25V12.2812C0 13.6875 1.125 14.8125 2.53125 14.8125H4.875C3.84375 16.125 3.375 17.8125 3.375 19.5V25.125C3.375 27.2812 4.125 29.3438 5.625 31.125V35.3438C5.625 37.2188 7.125 38.7188 9 38.7188H12.4688C14.3438 38.7188 15.8438 37.2188 15.8438 35.3438V33.6562H30.2812C29.9062 36.6562 30.4688 39.75 32.1562 42.4688C35.4375 47.7188 41.8125 49.9688 47.625 48L54.1875 58.5C55.125 60 57 60.375 58.5 59.5312C60 58.5938 60.375 56.7188 59.5312 55.2188ZM50.0625 10.5938H51.6562C52.0312 10.5938 52.3125 10.875 52.3125 11.25V12.2812C52.3125 12.6562 52.0312 12.9375 51.6562 12.9375H47.625C47.5312 12.8438 47.4375 12.6562 47.25 12.4688C47.5312 12.2812 48.1875 10.5938 50.0625 10.5938ZM13.2188 3.84375C13.6875 2.625 14.8125 1.875 16.125 1.875H38.0625C39.375 1.875 40.5 2.625 41.0625 3.9375C41.4375 4.6875 45.2812 12.75 45.75 13.4062H8.53125C8.90625 12.75 8.53125 13.5938 13.2188 3.84375ZM1.875 12.2812V11.25C1.875 10.875 2.15625 10.5938 2.53125 10.5938H4.125C5.0625 10.5938 5.90625 11.0625 6.375 11.8125L6.84375 12.5625C6.75 12.75 6.65625 12.8438 6.46875 13.0312H2.53125C2.15625 12.9375 1.875 12.6562 1.875 12.2812ZM14.0625 35.25C14.0625 36.0938 13.4062 36.75 12.5625 36.75H9C8.15625 36.75 7.5 36.0938 7.5 35.25V32.5312C8.625 33.1875 9.9375 33.5625 11.25 33.5625H14.0625V35.25ZM11.1562 31.7813C7.6875 31.7813 5.15625 28.5 5.15625 25.0312V19.4062C5.15625 17.8125 5.8125 16.3125 6.9375 15.0938H47.1562C48.375 16.3125 48.9375 17.8125 48.9375 19.4062V23.25C48.1875 22.875 47.3438 22.5938 46.5938 22.4062V20.25C46.5938 18.8438 45.2812 17.9062 44.0625 18.1875L39.2812 19.2188C37.7812 19.5938 36.6562 20.9062 36.6562 22.5C36.6562 22.6875 36.5625 23.25 37.0312 23.7188L36.4688 24C35.1562 24.8438 34.125 25.7812 33.1875 26.9062H21.1875C20.7188 26.9062 20.25 27.2812 20.25 27.8438C20.25 28.4062 20.625 28.7812 21.1875 28.7812H31.875C31.3125 29.7188 30.9375 30.75 30.6562 31.6875H11.1562V31.7813ZM40.5 22.5H38.4375C38.5312 21.8438 39 21.2812 39.6562 21.1875C39.75 21.1875 39.75 21.1875 39.6562 21.1875L44.5312 20.1562C44.7188 20.1562 44.9062 20.25 44.9062 20.4375V22.3125C43.4062 22.0312 41.9062 22.125 40.5 22.5ZM33.75 41.4375C30.375 36.0938 32.0625 28.9688 37.4062 25.5938C42.75 22.2188 49.875 23.9062 53.25 29.25C56.625 34.5938 54.9375 41.7188 49.5938 45.0938C44.1562 48.4688 37.125 46.875 33.75 41.4375ZM57.5625 57.9375C57 58.3125 56.1562 58.125 55.7812 57.5625L49.4062 47.3438C49.7812 47.1562 50.1562 46.9688 50.5312 46.6875C50.9062 46.5 51.2812 46.2188 51.5625 45.9375L57.9375 56.1562C58.3125 56.8125 58.125 57.5625 57.5625 57.9375Z"
                                                        fill="CurrentColor" />
                                                </svg>
                                            </div>
                                            <div class="content">
                                                <h3><a href="#">Best Price Guarantee</a></h3>
                                                <p>We scour the internet to find you the lowest tire prices.</p>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tf-icon-box style-1">
                                            <div class="icon">
                                                <svg width="58" height="60" viewBox="0 0 58 60" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.9688 39.5624L10.9062 38.4374C9.5 38.1562 8.28125 39.1874 8.28125 40.5937V42.7499C8.28125 44.4374 9.59375 44.7187 11.1875 44.8124H17C18.0312 44.8124 18.875 44.4374 18.875 43.4062V43.1249C18.7812 41.3437 17.6562 39.9374 15.9688 39.5624ZM10.0625 42.8437V40.4999C10.0625 40.2187 10.25 40.0312 10.5313 40.1249L15.6875 41.2499C16.4375 41.4374 17 42.0937 17.0937 42.8437C16.9062 42.9374 10.1563 42.9374 10.0625 42.8437ZM47.0938 38.4374L41.9375 39.5624C40.25 39.9374 39.125 41.3437 39.125 43.0312C39.125 43.1249 38.9375 44.3437 40.25 44.6249C40.9062 44.8124 45.125 44.7187 46.9062 44.7187C48.5 44.7187 49.7187 44.3437 49.7187 42.6562V40.4999C49.8125 39.1874 48.5 38.1562 47.0938 38.4374ZM47.9375 42.8437C47.6562 42.9374 41.0938 42.9374 41 42.9374C41.0938 42.1874 41.5625 41.5312 42.3125 41.3437L47.4688 40.2187C47.75 40.1249 47.9375 40.3124 47.9375 40.5937V42.8437ZM35.2812 43.8749H22.7187C22.25 43.8749 21.7812 44.2499 21.7812 44.8124C21.7812 45.3749 22.1562 45.7499 22.7187 45.7499H35.2812C35.75 45.7499 36.2188 45.3749 36.2188 44.8124C36.2188 44.2499 35.8438 43.8749 35.2812 43.8749ZM35.2812 47.7187H22.7187C22.25 47.7187 21.7812 48.0937 21.7812 48.6562C21.7812 49.2187 22.1562 49.5937 22.7187 49.5937H35.2812C35.75 49.5937 36.2188 49.2187 36.2188 48.6562C36.2188 48.0937 35.8438 47.7187 35.2812 47.7187Z"
                                                        fill="CurrentColor" />
                                                    <path
                                                        d="M55.25 28.3125H53.5625C51.9688 28.3125 50.4688 29.0625 49.625 30.4688L47.9375 27.0938C52.8125 24.8438 56.1875 19.9688 56.1875 14.25C56.0938 6.375 49.7188 0 41.9375 0C34.1562 0 27.7812 6.375 27.7812 14.1562C27.7812 15.8438 28.0625 17.4375 28.625 18.9375H17.2812C15.125 18.9375 13.1562 20.25 12.4062 22.2188L8.46875 30.375C7.625 29.0625 6.125 28.2188 4.53125 28.2188H2.75C1.34375 28.2188 0.125 29.4375 0.125 30.8438V31.9687C0.125 33.375 1.25 34.5938 2.75 34.5938H5.46875C4.34375 36 3.78125 37.7812 3.78125 39.6562V45.6562C3.78125 47.9062 4.625 50.1562 6.21875 52.0312V56.5312C6.21875 58.5 7.8125 60 9.6875 60H13.4375C15.4062 60 16.9062 58.4062 16.9062 56.5312V54.75H41V56.5312C41 58.5 42.5938 60 44.4688 60H48.2188C50.1875 60 51.6875 58.4062 51.6875 56.5312V52.0312C53.2812 50.25 54.125 48.0938 54.125 45.75V39.75C54.125 38.625 53.8438 37.4062 53.375 36.375C53.0938 35.8125 52.8125 35.25 52.3438 34.6875H55.25C56.6562 34.6875 57.875 33.5625 57.875 32.0625V30.9375C57.7812 29.4375 56.6562 28.3125 55.25 28.3125ZM41.9375 1.875C48.7812 1.875 54.3125 7.40625 54.3125 14.1562C54.3125 20.9062 48.7812 26.4375 42.0312 26.4375C35.2812 26.4375 29.75 20.9062 29.75 14.1562C29.75 7.40625 35.1875 1.875 41.9375 1.875ZM14.0938 22.9688C14.5625 21.6562 15.875 20.8125 17.2812 20.8125H29.4688C31.8125 25.3125 36.5 28.3125 41.9375 28.3125C43.4375 28.3125 44.8438 28.125 46.1562 27.6562C46.25 27.75 48.5 32.5312 48.875 33.1875H9.03125C9.40625 32.625 8.84375 33.9375 14.0938 22.9688ZM2 31.9687V30.8438C2 30.375 2.375 30 2.75 30H4.4375C6.5 30 7.25 31.875 7.4375 32.1562C7.34375 32.3438 7.15625 32.5312 7.0625 32.7188H2.75C2.375 32.7188 2 32.4375 2 31.9687ZM15.125 56.4375C15.125 57.375 14.375 58.125 13.4375 58.125H9.6875C8.75 58.125 8 57.375 8 56.4375V53.4375C9.21875 54.1875 10.625 54.5625 12.0312 54.5625H15.125V56.4375ZM48.3125 58.125H44.5625C43.625 58.125 42.875 57.375 42.875 56.4375V54.6562H45.9687C47.375 54.6562 48.7812 54.2812 50 53.5312V56.5312C50 57.375 49.25 58.125 48.3125 58.125ZM52.4375 45.5625C52.4375 49.3125 49.7187 52.7812 45.9687 52.7812H12.0312C8.28125 52.7812 5.5625 49.2188 5.5625 45.5625V39.5625C5.5625 37.875 6.21875 36.1875 7.53125 34.9688H50.5625C51.125 35.5312 51.5938 36.1875 51.9688 36.9375C52.3438 37.7812 52.5312 38.7188 52.5312 39.5625V45.5625H52.4375ZM56 31.9687C56 32.4375 55.625 32.7188 55.25 32.7188H50.9375C50.75 32.5312 50.6562 32.3438 50.5625 32.1562C50.8438 31.875 51.5 30 53.5625 30H55.25C55.7188 30 56 30.375 56 30.75V31.9687Z"
                                                        fill="CurrentColor" />
                                                    <path
                                                        d="M39.125 17.9062C39.125 17.4375 38.75 16.9687 38.1875 16.9687C37.625 16.9687 37.25 17.3437 37.25 17.9062C37.25 20.1562 38.8438 22.0312 41 22.4062V23.625C41 24.0938 41.375 24.5625 41.9375 24.5625C42.5 24.5625 42.875 24.1875 42.875 23.625V22.4062C45.0312 21.9375 46.625 20.1562 46.625 17.9062C46.625 15.6562 45.0312 13.7812 42.875 13.4062V7.78125C44 8.15625 44.75 9.1875 44.75 10.4062C44.75 10.875 45.125 11.3438 45.6875 11.3438C46.25 11.3438 46.625 10.9688 46.625 10.4062C46.625 8.15625 45.0312 6.28125 42.875 5.90625V4.6875C42.875 4.21875 42.5 3.75 41.9375 3.75C41.375 3.75 41 4.125 41 4.6875V5.90625C38.8438 6.375 37.25 8.15625 37.25 10.4062C37.25 12.6562 38.8438 14.5312 41 14.9062V20.4375C39.9688 20.1562 39.125 19.125 39.125 17.9062ZM44.75 17.9062C44.75 19.125 43.9062 20.1562 42.875 20.5312V15.2812C44 15.5625 44.75 16.6875 44.75 17.9062ZM39.125 10.4062C39.125 9.1875 39.9688 8.15625 41 7.78125V13.125C39.9688 12.6562 39.125 11.625 39.125 10.4062Z"
                                                        fill="CurrentColor" />
                                                </svg>
                                            </div>
                                            <div class="content">
                                                <h3><a href="#">No Hidden Fees</a></h3>
                                                <p> The price you see is the price you pay, with no surprises.</p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tf-icon-box style-1">
                                            <div class="icon">
                                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.2187 11.3438L10.9688 11.4375C10.5938 11.9062 10.4062 12.5625 10.5 13.2188L11.0625 22.3125C11.1563 23.1562 11.625 23.9062 12.2813 24.2812V25.7812C12.2813 27.0938 13.3125 28.125 14.625 28.125H18.5625C19.875 28.125 20.9062 27.0938 20.9062 25.7812V24.6562H36.6562V25.7812C36.6562 27.0938 37.6875 28.125 39 28.125H42.9375C44.25 28.125 45.2812 27.0938 45.2812 25.7812V24.0938C45.8438 23.625 46.2188 23.0625 46.2188 22.3125L46.7812 13.2188C46.875 12.5625 46.5938 12 46.3125 11.4375L47.1562 11.3438C48.6562 11.1562 49.875 9.84375 49.7812 8.15625C49.5937 6.75 48.375 5.71875 46.9687 5.625H44.625C43.875 5.625 43.125 5.90625 42.5625 6.46875C41.9062 4.96875 41.0625 3.5625 40.3125 2.34375C39.4688 0.9375 37.875 0 36.2812 0H21.1875C19.5 0 18 0.84375 17.0625 2.34375C16.125 3.84375 15.4688 5.0625 14.8125 6.46875C14.3438 5.90625 13.5938 5.625 12.8438 5.625L10.5 5.71875C8.90625 5.71875 7.6875 7.03125 7.6875 8.53125C7.6875 9.9375 8.8125 11.25 10.2187 11.3438ZM14.7188 10.5H42.6562C42.9375 10.875 43.2188 11.1562 43.5 11.4375C39.9375 12.0938 37.6875 13.875 36.375 15.5625C35.7187 16.4062 34.7812 16.7812 33.8437 16.7812H23.4375C22.5 16.7812 21.5625 16.3125 20.9062 15.5625C19.5937 13.9688 17.3438 12.0938 13.7812 11.4375C14.1562 11.1562 14.4375 10.7812 14.7188 10.5ZM43.7812 22.875H13.5938C13.2188 22.875 12.8438 22.5938 12.8438 22.2188L12.5625 17.5312C12.8438 17.5312 16.5938 19.7812 19.3125 16.5C20.3438 17.7188 21.5625 18.6562 23.4375 18.6562H33.9375C35.7188 18.6562 36.9375 17.8125 38.0625 16.5C39.375 18.0938 41.625 18.75 43.5938 18L44.7188 17.5312L44.4375 22.2188C44.5312 22.5938 44.1562 22.875 43.7812 22.875ZM18 15.1875C16.125 17.7188 13.125 15.6562 12.4688 15.5625L12.375 13.125C14.9062 13.2188 16.6875 14.1563 18 15.1875ZM45 13.125L44.9062 15.5625C44.25 15.6562 41.25 17.7188 39.375 15.1875C40.6875 14.1563 42.4688 13.2188 45 13.125ZM19.125 25.875C19.125 26.1562 18.8437 26.4375 18.5625 26.4375H14.625C14.3438 26.4375 14.0625 26.1562 14.0625 25.875V24.75H19.0312V25.875H19.125ZM43.0312 26.3438H39.0938C38.8125 26.3438 38.5312 26.0625 38.5312 25.7812V24.6562H43.5V25.7812C43.5 26.1562 43.3125 26.3438 43.0312 26.3438ZM44.625 7.5H46.9687C47.5312 7.5 48 7.875 48 8.34375C48 8.4375 48.0938 9.375 47.0625 9.46875L44.625 9.75C43.5 8.625 43.7812 8.4375 43.7812 8.34375C43.5938 7.875 44.0625 7.5 44.625 7.5ZM18.6562 3.28125C19.125 2.4375 20.1563 1.875 21.1875 1.875H36.2812C37.3125 1.875 38.25 2.4375 38.8125 3.28125C40.875 6.75 40.7812 6.84375 41.625 8.71875H15.8438C16.6875 6.75 16.5 6.75 18.6562 3.28125ZM10.5 7.5H12.8438C13.9688 7.40625 13.6875 8.625 13.7812 8.71875C13.5 9.1875 13.2188 9.5625 12.8438 9.84375L10.4063 9.5625C9.84375 9.46875 9.375 9.09375 9.375 8.53125C9.5625 8.4375 9.5625 7.59375 10.5 7.5Z"
                                                        fill="CurrentColor" />
                                                    <path
                                                        d="M58.6875 26.4374C56.9062 23.9062 53.25 23.9999 51.5625 26.2499L39 39.5624C38.1562 37.7812 36.375 36.5624 34.4062 36.5624H23.25C22.2188 36.5624 21.2812 36.3749 20.3438 35.9062C15.6563 33.6562 10.0312 34.3124 6 37.6874L0.84375 41.9999C0.46875 42.2812 0.375 42.9374 0.75 43.3124C1.03125 43.6874 1.6875 43.7812 2.0625 43.4062L7.21875 39.0937C10.6875 36.1874 15.5625 35.6249 19.5938 37.5937C20.7188 38.1562 22.0312 38.4374 23.3438 38.4374H34.5C36.1875 38.4374 37.7812 39.7499 37.7812 41.7187C37.7812 43.4999 36.4688 44.9062 34.6875 44.9062H22.5938C22.125 44.9062 21.6562 45.2812 21.6562 45.8437C21.6562 46.4062 22.0312 46.7812 22.5938 46.7812H34.5C37.125 46.7812 39.375 44.7187 39.375 41.8124L52.9688 27.4687C54 26.0624 56.1562 26.0624 57.1875 27.5624C57.8438 28.4999 57.8438 29.8124 57.0938 30.7499L46.4062 44.8124C39.1875 54.3749 26.8125 57.1874 16.2187 53.9062C13.3125 52.9687 8.71875 53.6249 6 55.2187L0.9375 58.3124C0.46875 58.5937 0.375 59.1562 0.65625 59.5312C0.84375 59.9999 1.40625 60.0937 1.875 59.8124L7.125 56.7187C9.375 55.3124 13.4062 54.8437 15.8438 55.5937C27.0938 59.0624 40.2188 56.0624 48 45.8437L58.6875 31.7812C59.8125 30.1874 59.8125 28.0312 58.6875 26.4374Z"
                                                        fill="CurrentColor" />
                                                </svg>
                                            </div>
                                            <div class="content">
                                                <h3><a href="#">Local Tire Shops</a></h3>
                                                <p>Get results from both online stores and nearby shops.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="swiper-pagination3"></div>
                        </div>
                    </div>
                </div>
            </section>

        
           
            <!-- widegt tetimonial -->
            <section class="tf-section bg-1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-section center">
                                <h2 class="wow fadeInUpSmall" data-wow-delay="0.2s" data-wow-duration="1000ms">We love
                                    our clients</h2>
                                <p class="mt-18 wow fadeInUpSmall" data-wow-delay="0.2s" data-wow-duration="1000ms">
                                    Discover exceptional experiences through testimonials from our satisfied customers.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="swiper-container carousel-7 overflow-hidden">
                                <div class="swiper-wrapper ">
                                    <div class="swiper-slide">
                                        <div class="tf-testimonial style-2 box-tes">
                                            <p class="fs-16 lh-22 text-color-2">"My experience with property management
                                                services has exceeded expectations. They efficiently manage properties
                                                with a professional and attentive approach in every situation. I feel
                                                reassured that any issue will
                                                be resolved promptly and effectively."</p>
                                            <div class="author-box flex">
                                                <div class="images">
                                                    <img class=" ls-is-cached lazyloaded"
                                                        data-src="assets/images/author/avt-cm1.jpg"
                                                        src="assets/images/author/avt-cm1.jpg" alt="images">
                                                </div>
                                                <div class="content">
                                                    <h5>Arlene McCoy</h5>
                                                    <p class="fs-12 lh-16">CEO Themesflat</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tf-testimonial style-2 box-tes">
                                            <p class="fs-16 lh-22 text-color-2">"My experience with property management
                                                services has exceeded expectations. They efficiently manage properties
                                                with a professional and attentive approach in every situation. I feel
                                                reassured that any issue will
                                                be resolved promptly and effectively."</p>
                                            <div class="author-box flex">
                                                <div class="images">
                                                    <img class=" ls-is-cached lazyloaded"
                                                        data-src="https://cdn.discounttire.com/sys-master/images/hd4/hc4/9492926922782/PRODUCT_202010270456_tire_42857_1000_angle.png_dt-product-desktop"
                                                        src="https://cdn.discounttire.com/sys-master/images/hd4/hc4/9492926922782/PRODUCT_202010270456_tire_42857_1000_angle.png_dt-product-desktop" alt="images">
                                                </div>
                                                <div class="content">
                                                    <h5>Arlene McCoy</h5>
                                                    <p class="fs-12 lh-16">CEO Themesflat</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tf-testimonial style-2 box-tes">
                                            <p class="fs-16 lh-22 text-color-2">"My experience with property management
                                                services has exceeded expectations. They efficiently manage properties
                                                with a professional and attentive approach in every situation. I feel
                                                reassured that any issue will
                                                be resolved promptly and effectively."</p>
                                            <div class="author-box flex">
                                                <div class="images">
                                                    <img class=" ls-is-cached lazyloaded"
                                                        data-src="assets/images/author/avt2.jpg"
                                                        src="assets/images/author/avt2.jpg" alt="images">
                                                </div>
                                                <div class="content">
                                                    <h5>Arlene McCoy</h5>
                                                    <p class="fs-12 lh-16">CEO Themesflat</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination3"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </section>

        

            <!-- logo -->
            <section class="flat-brand tf-section3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mt-4">
                            <div class="title-section center wow fadeInUpSmall" data-wow-delay="0.2s"
                                data-wow-duration="1000ms">
                                <h2>Our partners</h2>
                            </div>
                            <div class="swiper-container carousel-5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="slogan-logo">
                                            <a href="#">
                                                <img class="lazyload" data-src="assets/images/partner/par1.png"
                                                    src="assets/images/partner/par1.png" alt="images">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slogan-logo">
                                            <a href="#">
                                                <img class="lazyload" data-src="assets/images/partner/par2.png"
                                                    src="assets/images/partner/par2.png" alt="images">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slogan-logo">
                                            <a href="#">
                                                <img class="lazyload" data-src="assets/images/partner/par3.png"
                                                    src="assets/images/partner/par3.png" alt="images">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slogan-logo">
                                            <a href="#">
                                                <img class="lazyload" data-src="assets/images/partner/par4.png"
                                                    src="assets/images/partner/par4.png" alt="images">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slogan-logo">
                                            <a href="#">
                                                <img class="lazyload" data-src="assets/images/partner/par5.png"
                                                    src="assets/images/partner/par5.png" alt="images">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="slogan-logo">
                                            <a href="#">
                                                <img class="lazyload" data-src="assets/images/partner/par6.png"
                                                    src="assets/images/partner/par6.png" alt="images">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<?php include 'footer.php'; ?>