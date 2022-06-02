<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Load bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap_overrides.css">
    <!--Includes for highlight.js (embessed code highlighting)-->    
    <link rel="stylesheet" href="highlight/darcula.min.css">
    <script src="highlight/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <!--End of highlight.js includes-->
    <title>Bootstrap test</title>
</head>
<body>
<div class="container">
    <!--Header Here-->
    <?php include 'includes/header.php' ?>
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <h2>How it works!</h2>
        <p>We can now discuss how the MySQL demo functions. To summarise before we get into depth, there are a number of technologies working here. On the browser (client side), we are using <b><i>HTML</i></b> to display the information on the screen. This is styled with <b><i>CSS</i></b> which in our case for the most part is handled by <b><i>Bootstrap</i></b>. In the case of the second demo where the content of the data is rendered dynamically (without re-directing to a new page) within the browser window, <b><i>JavaScript</i></b> plays the important role of handling the interaction with the user and the server.</p>
        <p>The server uses <b><i>PHP</i></b> to communicate with the <b><i>JavaScript</i></b> from the client. In turn, it interacts with the <b><i>MySQL</i></b> database, extracting the necessary infomration and returning it to the <b><i>JavaScript</i></b> on the client side. I will explain the design pattern we have implemented in more detail below.</p>

        <h3>The Structure</h3>
        <p>The easiest way to illustrate the design pattern used is with a diagram:</p>
        <div class="col">
            <img src="images/sqldemomodel.png" class="mx-auto my-5 d-block" alt="The design pattern" width="600" height= "451">
        </div>
        <p>We can say that the design pattern roughly aligns to <b>MVC</b> (Model View Controller). The View is rendered in the browser window with our HTML and Bootstrap. This provides the necessary features and facets for the user to interact with the data. </p>
       <p>Back on the server, we have the <b>MySQL</b> database that stores all the data we wish the user to have access to. This is our <b>MODEL</b>. The view and the model have no direct interaction whatsoever, this not only simplifies the user experience, it provides the necessary abstraction to preserve data security.</p>
       <p>However, we still need a way to connect the data to the user in the appropriate format. This is where the <b>CONTROLLER</b> comes in. In our case, I consider this role to be split over client and server side. The <b>JavaScript</b> on the client machine acts to all intents and purposes like an <b>API</b> (Application Programming Interface) It allows the <i>REQUEST</i> made within the <b>HTML DOM</b> (Document Object Model) to be passed to the <b>PHP</b> application running on the server. In a similar manner, the PHP is able to send a <i>RESPONSE</i>back to the JavaScript containing the appropriate data which is then sent back to the HTML DOM.</p> 
       <p>In a similar manner, again loosely speaking, the <b>PHP</b> on the server acts as our server based API, enabling bi-directional communication between the <b>MySQL</b> database and the JavaScript running on the client machine.</p>
       <p><b>NOTE:</b> In respect of security, the only worthwhile abstraction is provided by PHP, <b>NOT</b> JavaScript.</p>

       <h3>Let's talk code!</h3>
       <p>That's the theory over with, let's get our hands dirty with some code. I am not going to put every line of code on here, If you want to see the whole project line by line, it is available on <a href="https://github.com/mxfoyster/BootstrapDemo">this GitHub repository</a>. It's public, so anyone can have a look. Disclaimer, this is just an exercise and there is significant room for improvement, but it works!</p>

       <p>Let's start with the JavaScript that communicates with the server. For this we use the <code>fetch()</code> API:</p>

        <pre><code>
        function getData(opts, stringToQuery="", anotherStringToQuery="") {
            var formData = new FormData();
            formData.append('queryType', opts);
            formData.append('queryString', stringToQuery);
            formData.append('queryString2', anotherStringToQuery);
            var searchString = searchBox.value;
            formData.append ('searchString', searchString);
            fetch('includes/modelcarsall.php', {
            method: 'post',
            body: formData
            }).then(function(response) {
                return response.json();
            }).then(function(response) {
                switch (opts){
                    case "productLine":
                        dBaseProductLines = response;
                        populateProductLineListBox();
                        break;
                    case "productVendor":
                        dBaseProductVendor = response;
                        populateProductVendorListBox();
                        break;
                    case "byID":
                        thisRecord = response;
                        showItem();
                        break;
                    case "all":
                    case "allByProductLine":
                    case "allByProductVendor":
                    case "allByLineAndVendor":
                        dBaseResult = response;
                        Validate();
                        break;
                }

            }).catch (function (error){
                noData();
            });
        }
        </code></pre>
        <p>The main thing to notice here is that at <b>NO</b> stage do I use <b>SQL</b> statements within the JavaScript. This makes it a little harder to know exactly what's going on server side. There are technologies nowadays that can tell the curious what is running on the backend, but I have no wish to volunteer that information.</p>
        
        <p>The <code>fetch()</code> API is very useful. Not only does it make handling the response asynchronously much easier by automatically obtaining a <code>Promise()</code>, It provides us with an easy way to receive the data in the form of a <b>JSON</b> (JavaScript Object Notation) which we can now store locally within the client to access and render in the DOM when we are ready.</p>
        
        <p>Before any of this can happen of course, we need to communicate the kind of information we wish to request. We do this by building a post request into a <code>FormData()</code> object. This gives us a 'virtual' form which we can use to send <b>POST</b> data to the server in the usual <i>name: value</i> pairs. As you can see, I use <code>queryType</code>, <code>queryString</code>, <code>queryString2</code> and <code>searchString</code> names to send this information.</p>
        
        <p>The code that can only be resolved when the data is successfully received is handled in the LAST <code>.then()</code> statement. The former one simply receives the JSON and allows us to store it.</p>
        <p>The final noteworthy part of the code here is the <code>.catch()</code> segment. Here, I simply call a function (<code>noData()</code>) that enters one result to the display, prompting the user that no data was received, like this:</p>

        <pre><code>
        function noData(){
            displayString = "&lt;div class=\"row py-2\"&gt;&lt;div class=\"col p-2 m-2 border bg-primary\"&gt; SORRY, NO MATCH&lt;/div&gt;&lt;/div&gt;";
            responseBox.innerHTML = displayString;
            numResults.innerHTML= "0";
        }
        </code></pre>

        <p>The rest of the code either listens to the DOM for user inputs to resolve the nature of the request or serves to render the response received.</p>

        <h4>The PHP Code</h4>
        <p>Now, let's consider the server side. We need to receive the post request and then send back a response, we'll get the post data first:</p>
        <pre><code>
            $queryType = $_POST['queryType']; 
            $queryString = $_POST['queryString'];
            $anotherQueryString = $_POST['queryString2'];
            $searchString = $_POST['searchString'];
        </code></pre>
        <p>We do need to connect to the database, so I have a separate PHP file to do that. I use <code>require_once()</code> to import it and start setting up some other connection details next: </p>
        <pre><code>
            require_once("dbasefunctions.php");
            $driver = new mysqli_driver();
            $dbase = "classicmodels";
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
        </code></pre>

        <p>This file handles a bulk of the connection AND provides a mechanism to escape any strings sent by <b>POST</b> that will be embedded directly into a <b>SQL</b> statement. Something, you will note I keep to the minimum. I will discuss that file more later. The rest of the code sets up our <code>mysqli_driver()</code>. This is a nice and relatively secure API within PHP for connecting to MySQL databases. Next we set a variable for the database name and finally provide some more configuration information for the <i>mysqli</i> API.</p>
        <p>Now for the rest of the code. I'll display that in one go, it's easier to explain that way:</p>
        <pre><code>
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
                //echo $e; //*******REMOVE BEFORE UPLOADING*****/
                return false;
            }
        </code></pre>
        <p>NOTE: This whole last section is encapsulated within a <code>try(), catch()</code> block. The <code>catch()</code> block allows us to stop PHP from crashing entirely and displaying information we do not want the user to see. Note, I have a commented out <code>echo ""</code> statement that I used for debugging purposes to display any errors during development.</p>
        <p>within the <code>try()</code> block, first we use our imported <code>SetUpConnection()</code> function to make a connection to the database. Next a <code>switch()</code> block followed by some <code>if()</code> statements help build up a <b>SQL</b> query statement for us to use later. Where we embed our variables obtained through a <b>POST</b>, we use another function imported, <code>EscapeInput ()</code>. 
        </p>

        <p>Drawing to a close, we make our query, again using the <code>mysqli</code> API, this time <code>mysqli_query()</code> that we then build into an <i>associated array</i> using a <code>while()</code> loop. The last stop is to use <code>json_encode()</code> to turn our associated array into a <b>JSON</b> which we <code>echo</code> out. The echo statement quite nicely gives us a response which back in our JavaScript our <code>fetch()</code> API can handle.</p>

        <h4>The dbasefunctions file</h4>
        <p>This is very simple really:</p>
        <pre><code>
            function  SetUpConnection($dbase)
            {
            
                $server = "localhost";
                $user = "root";
                $password = "";
                $driver = new mysqli_driver();
                //set report mode for errors
                $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
                try
                {
                    $conn = mysqli_connect($server, $user, $password, $dbase);		
                }
                catch (mysqli_sql_exception $e)
                {
                    //echo "Sorry, an Error occurred <br />";
                    return false;
                }
                
                return $conn;
            }
            
            function EscapeInput($conn, $input)
            {
                $escapedInput = $conn->real_escape_string($input);
                return $escapedInput;
            }
        </code></pre>
        <p>It just specifies the connection detalis like username and password for the database (a good reason to have it 'twice removed' from the client!) and makes the connection. Note, as I write this, I see I have some duplicated code which I can remove from the main file. The <code>$driver</code> is set up twice at present, as is the <i>report mode.</i> That will have to be corrected.</p>

        <p>The second function (<code>escapeInput()</code>) just takes a string and uses the <code>mysqli</code> API function to escape the input thus helping avoid any <b><i>SQL Injection</i></b> attacks.</p>

        <p>That covers the bulk of what is happening here.</p>

        
       
    
    </div>
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <?php include 'includes/footer.php' ?>
    </div>
    
</div>
<!--Loading the Javascript for bootstrap-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    
</body>
</html>