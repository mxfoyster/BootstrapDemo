<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Load bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap_overrides.css">
    <title>Bootstrap test</title>
</head>
<body>
<div class="container">
    <!--Header Here-->
    <?php include 'includes/header.php' ?>
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <h2></h2>
        <?php
            require_once("includes/dbasefunctions.php");

            $driver = new mysqli_driver();
            $dbase = "classicmodels";
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
            try
            {
                //set up our connection
                $conn = SetUpConnection($dbase);
                $error = ""; //Variable for storing our errors.   

                if(isset($_POST["carName"]))
                {
                    $carName = $_POST['carName'];
                    $carName = EscapeInput ($conn,$carName); //escape input 
                    
                    $sql = "select productName, productLine, productScale, buyPrice from products where productName like '%$carName%';"; 		
			        $result = mysqli_query($conn,$sql); //do the query
                    
                    if ($result = mysqli_query($conn,$sql)) //if a valid search
			        {
                    echo "<h4>Toy Car Search Results</h4>\n<br>\n";
                    echo "<table class=\"table table-striped table-bordered border-secondary\">";
                    echo "<tr>\n\t<td><b>VEHICLE NAME</b></td><td><b>VEHICLE TYPE</b></td><td><b>SCALE</b></td><td><b>PRICE</b></td>\n</tr>\n";
                        while($row = $result->fetch_assoc()) 
                        {
                        echo "<tr>\n";
                        echo "\t<td>" . $row["productName"] . " </td>\n";
                        echo "\t<td>" . $row["productLine"] . " </td>\n";
                        echo "\t<td>" . $row["productScale"] . " </td>\n";
                        echo "\t<td>" . $row["buyPrice"] . " </td>\n";
                        echo "</tr>";
                        }
                    echo "</table>";
                    }
                    else
                    {
                        return false;
                    }

                }
                
            }
            catch (mysqli_sql_exception $e)
            {
                echo "Sorry, an Error occurred <br /> ";
                echo $e; //*******REMOVE BEFORE UPLOADING*****/
                return false;
            }
        ?>
        
       
        
        <a class="btn btn-success" href="mysqldemo.php" role="button">Back to Demo</a>
        
    </div>
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <?php include 'includes/footer.php' ?>
    </div>
    
</div>
<!--Loading the Javascript for bootstrap-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    
</body>
</html>