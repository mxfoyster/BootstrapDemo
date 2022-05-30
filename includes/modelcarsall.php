<?php
    $queryType = $_POST['queryType']; 
    $queryString = $_POST['queryString'];
    $anotherQueryString = $_POST['queryString2'];
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
                $queryString = EscapeInput ($conn,$queryString); //escape input 
                $sql = "select productName, productLine, productScale, buyPrice from products where productLine like '$queryString';";
            break;
            case "allByProductVendor":
                $queryString = EscapeInput ($conn,$queryString); //escape input 
                $sql = "select productName, productLine, productScale, buyPrice from products where productVendor like '$queryString';";
            break;
            case "allByLineAndVendor":
                $queryString = EscapeInput ($conn,$queryString); //escape input 
                $anotherQueryString = EscapeInput ($conn,$anotherQueryString); //escape input
                //$sql = "select productName, productLine, productScale, buyPrice from products where productLine like '$queryString' and productVendor like '$AnotherQueryString';"; 
                $sql = "select productName, productLine, productScale, buyPrice from products where productLine like '$queryString' and productVendor like '$anotherQueryString';";
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
        //echo $e; //*******REMOVE BEFORE UPLOADING*****/
        return false;
    }
?>