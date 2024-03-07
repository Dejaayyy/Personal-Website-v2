<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMB Registration</title>
    
    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="forms.css"> -->
</head>

<style>

    body {
        font-family: 'Poppins', sans-serif;
        background: #222;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        scroll-behavior: smooth;
        overflow-y: auto;
        position: relative;
    }

    .container {
        width: 90%;
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0px 15px 30px 0px #007ced;
    }

    .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: baseline;
    }

    @media (max-width: 768px) {
        .container {
            /* Adjust top margin for smaller screens */
            position: relative; /* Reset the position */
            width: 80%; /* Adjust width for smaller screens */
        }
    }

    @media (max-width: 580px) {
        .container {
            margin-top: 60%; /* Adjust top margin for smaller screens */
            position: relative; /* Reset the position */
            width: 80%; /* Adjust width for smaller screens */
        }
    }

</style>

<body> 
    <div class="container">
        <?php
            if(isset($_POST["submit"])){
                $lastname = $_POST["lastname"];
                $firstname = $_POST["firstname"];
                $contact = $_POST["contact"];
                $country = $_POST["country"];
                $region = $_POST["region"];
                $stprov = $_POST["stprov"];
                $city = $_POST["city"];
                $brgy = $_POST["brgy"];
                $lot = $_POST["lot"];
                $blk = $_POST["blk"];
                $street = $_POST["street"];
                $phsubd = $_POST["phsubd"];
                
                $email = $_POST["email"];
                $password = $_POST["password"];

                $RepeatPassword = $_POST["repeat_password"];
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $errors = array();

                if (empty($lastname) || empty($firstname) || empty($contact) || empty($country) || empty($region) || empty($stprov) || empty($city) || empty($brgy) || empty($email) || empty($password) || empty($RepeatPassword)) {
                    array_push($errors, "All fields are required");
                }

                if($password!=$RepeatPassword){
                    array_push($errors, "Password does not match");
                }

                if (count($errors)>0){
                    foreach ($errors as $error) {
                        echo"<div class='alert alert-danger'>$error</div>";
                    }

                } else {
                    require_once "db_conn.php";
                    $sql = "INSERT INTO users (lastname, firstname, contact, country, region, stprov, city, brgy, lot, blk, street, phsubd, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($preparestmt) {
                        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $lastname, $firstname,  $contact, $country, $region, $stprov, $city, $brgy, $lot, $blk, $street, $phsubd, $email, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'> You are Registered Successfully! </div>";
                    } else {
                        die("Something went wrong");
                    }
                }            
            }   
        ?>
        
        <form action="registration.php" method="post">
            <h3>Kindly fill up for registration</h3>
            <div class="row">
                <h5>Full Name</h5>
                <div class="col-sm-6">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control" name="lastname" >
                </div>
                <div class="col-sm-6">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control" name="firstname" >
                </div>
            </div>

            <h5>Address</h5>
            <div class="row">
                <div class="col-sm-4">
                    <label for="contact">Contact:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+63</span>
                        </div>
                        <input type="text" class="form-control" maxlength="10" name="contact">
                    </div>
                </div>

                <div class="col-sm-4">
                    <label for="country">Country:</label>
                    <select class="form-select form-select-md-4" name="country">
                        <option selected>--Select Country--</option>
                        <option value="Philippines">Philippines</option>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="country">Region:</label>
                    <select class="form-select form-select-md-4" id="region" name="region">
                        <option selected>--Select Region--</option>
                    </select>
                </div>   
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label for="brgy">State/Province:</label>
                    <select class="form-select form-select-md-4" id="stprov" name="stprov">
                        <option selected>--Select Province--</option>
                        <option></option>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="city">City/Municipality:</label>
                    <select class="form-select form-select-md-4" id="city" name="city">
                        <option selected>--Select City/Municipality--</option>
                        <option></option>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="brgy">Barangay:</label>
                    <select class="form-select form-select-md-4" id="brgy" name="brgy">
                        <option selected>--Select Barangay--</option>
                        <option></option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="lot">Lot</label>
                    <input type="text" class="form-control" name="lot" >
                </div>
                <div class="col-sm-2">
                    <label for="blk">Blk</label>
                    <input type="text" class="form-control" name="blk" >
                </div>
                <div class="col-sm-4">
                    <label for="street">Street</label>
                    <input type="text" class="form-control" name="street" >
                </div>
                <div class="col-sm-4">
                    <label for="phsubd">Phase/Subdivision/Village</label>
                    <input type="text" class="form-control" name="phsubd" >
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <label for="email">Email Address:</label>
                    <input type="email" class="form-control" name="email" >
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" >
                </div>
                <div class="col-sm-6">
                    <label for="repeat_password">Confirm Password:</label>
                    <input type="password" class="form-control" name="repeat_password" >
                </div>
            </div>
            
            <input type="submit" name="submit" class="btn btn-primary" value="Register" placeholder="submit">
            <a href="work.html" class="btn btn-primary">Go back</a>
        </form>

        <div><br><p>Already registered? <a href="login.php">Login Here</a></p></div>  

    </div>

    <script src="script.js"></script>
    <script type="text/javascript" src="phil.min.js"></script>
    <script type="text/javascript">
        // Your existing JavaScript code here
            const regions = Philippines.regions;
            const provinces = Philippines.provinces;
            const municipalities = Philippines.city_mun;
            const barangays = Philippines.barangays;

            // Populate the region drop-down list
            const regionDropdown = document.getElementById('region');
            regions.forEach(region => {
                const option = document.createElement('option');
                option.value = region.reg_code;
                option.textContent = region.name;
                regionDropdown.appendChild(option);
            });

            // Function to populate the province drop-down based on the selected region
            function populateProvinces(regionCode) {
                const provinceDropdown = document.getElementById('stprov');
                provinceDropdown.innerHTML = ''; // Clear previous options

                const provincesInRegion = Philippines.getProvincesByRegion(regionCode);
                provincesInRegion.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.prov_code;
                    option.textContent = province.name;
                    provinceDropdown.appendChild(option);
                });
            }

            // Function to populate the municipality drop-down based on the selected province
            function populateMunicipalities(provinceCode) {
                const municipalityDropdown = document.getElementById('city');
                municipalityDropdown.innerHTML = ''; // Clear previous options

                const municipalitiesInProvince = Philippines.getCityMunByProvince(provinceCode);
                municipalitiesInProvince.forEach(municipality => {
                    const option = document.createElement('option');
                    option.value = municipality.mun_code;
                    option.textContent = municipality.name;
                    municipalityDropdown.appendChild(option);
                });
            }

            // Function to populate the barangay drop-down based on the selected municipality
            function populateBarangays(municipalityCode) {
                const barangayDropdown = document.getElementById('brgy');
                barangayDropdown.innerHTML = ''; // Clear previous options

                const barangaysInMunicipality = Philippines.getBarangayByMun(municipalityCode);
                barangaysInMunicipality.forEach(barangay => {
                    const option = document.createElement('option');
                    option.value = barangay.brgy_code;
                    option.textContent = barangay.name;
                    barangayDropdown.appendChild(option);
                });
            }

            // Event listener for region dropdown change
            regionDropdown.addEventListener('change', function() {
                const selectedRegion = regionDropdown.value;
                populateProvinces(selectedRegion);
            });

            // Event listener for province dropdown change
            const provinceDropdown = document.getElementById('stprov');
            provinceDropdown.addEventListener('change', function() {
                const selectedProvince = provinceDropdown.value;
                populateMunicipalities(selectedProvince);
            });

            // Event listener for municipality dropdown change
            const municipalityDropdown = document.getElementById('city');
            municipalityDropdown.addEventListener('change', function() {
                const selectedMunicipality = municipalityDropdown.value;
                populateBarangays(selectedMunicipality);
            });
        </script>
    </script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>