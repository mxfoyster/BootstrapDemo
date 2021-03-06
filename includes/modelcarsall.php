<?php
    $queryType = $_POST['queryType']; 
    $queryString = $_POST['queryString'];
    $anotherQueryString = $_POST['queryString2'];
    $searchString = $_POST['searchString'];
    require_once("dbasefunctions.php");

    //choose the database we wish to use
    $dbase = "classicmodels";
    try
    {
        //set up our connection
        $conn = SetUpConnection($dbase);
        $error = ""; //Variable for storing our errors.
        $sql="";   
        
        switch($queryType){
            case "all":
                $sql = "select productCode, productName, productLine, productScale, buyPrice from products"; 		
            break;
            case "allByProductLine":
                $queryString = EscapeInput ($conn,$queryString); //escape input 
                $sql = "select productCode, productName, productLine, productScale, buyPrice from products where productLine like '$queryString'";
            break;
            case "allByProductVendor":
                $queryString = EscapeInput ($conn,$queryString); //escape input 
                $sql = "select productCode, productName, productLine, productScale, buyPrice from products where productVendor like '$queryString'";
            break;
            case "allByLineAndVendor":
                $queryString = EscapeInput ($conn,$queryString); //escape input 
                $anotherQueryString = EscapeInput ($conn,$anotherQueryString); //escape input
                $sql = "select productCode, productName, productLine, productScale, buyPrice from products where productLine like '$queryString' and productVendor like '$anotherQueryString'";
            break;

        }

        //add our search box
        if ($searchString !=""){
            $searchString = EscapeInput ($conn,$searchString); //escape input
            if ($queryType == "all") $sql .= " where productName like '%$searchString%';"; 
            else $sql .= " and productName like '%$searchString%';"; 
        }
        else $sql .= ";";

        //now our clickable result (here so it's CLEAN without the search string)
        if ($queryType == "byID"){
            $queryString = EscapeInput ($conn,$queryString); //escape input 
            $sql = "select * from products where productCode like '$queryString';";
        }
         		
        //We do these two here to save having to worry about them being altered by the search query.
        switch($queryType){
            case "productLine":
                $sql = "select distinct productLine from products;";
            break;
            case "productVendor":
                $sql = "select distinct productVendor from products;"; 
            break;
        }

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