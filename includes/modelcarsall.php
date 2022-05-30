<?php
    $queryType = $_POST['queryType'];
    require_once("dbasefunctions.php");

    $driver = new mysqli_driver();
    $dbase = "classicmodels";
    $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
    try
    {
        //set up our connection
        $conn = SetUpConnection($dbase);
        $error = ""; //Variable for storing our errors.
        $sql="";   
        //$carName = EscapeInput ($conn,$carName); //escape input 
        
        switch($queryType){
            case "all":
                $sql = "select productName, productLine, productScale, buyPrice from products;"; 		
            break;
            case "productLine":
                $sql = "select distinct productLine from products;";
            break;
            case "productVendor":
                $sql = "select distinct productVendor from products;"; 
            break;
            case "allByProductLine":
                $sql = "select productName, productLine, productScale, buyPrice from products where productLine like 'Vintage Cars';";
            break;

        }
        
        //$sql = "select productName, productLine, productScale, buyPrice from products;"; 		
        
        $result = mysqli_query($conn,$sql); //do the query
        
        if ($result = mysqli_query($conn,$sql)) //if a valid search
        {
            while($row = $result->fetch_assoc()) 
            {
                $rows[] = $row;
            }
            //header('Content-type: application/json');
            echo json_encode($rows);
        }
        else
        {
            return false;
        }

        
        
    }
    catch (mysqli_sql_exception $e)
    {
        echo "Sorry, an Error occurred <br /> ";
        echo $e; //*******REMOVE BEFORE UPLOADING*****/
        return false;
    }
?>