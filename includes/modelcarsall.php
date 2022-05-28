<?php
    //get post data to help us resolve query string
    // $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

    // if ($contentType === "application/json") {
    //     //Receive the RAW post data.
    //     $content = trim(file_get_contents("php://input"));

    //     $decoded = json_decode($content, true);

    //     //If json_decode failed, the JSON is invalid.
    //     if(! is_array($decoded)) {

    //     } else {
    //         // Send error back to user.
    //     }
    // }


    
    require_once("includes/dbasefunctions.php");

    $driver = new mysqli_driver();
    $dbase = "classicmodels";
    $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
    try
    {
        //set up our connection
        $conn = SetUpConnection($dbase);
        $error = ""; //Variable for storing our errors.   
        //$carName = EscapeInput ($conn,$carName); //escape input 
        
        $sql = "select productName, productLine, productScale, buyPrice from products;"; 		
        $result = mysqli_query($conn,$sql); //do the query
        
        if ($result = mysqli_query($conn,$sql)) //if a valid search
        {
            while($row = $result->fetch_assoc()) 
            {
                $rows[] = $row;
            }
            //header('Content-type: application/json');
            echo json_encode($rows);
            //echo "test";
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