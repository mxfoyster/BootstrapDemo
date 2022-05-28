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
        <h2>MySQL Demo with PHP and Bootstrap</h2>
        <p>This is going to be a simple working demo of a database. We will only be covering queries, no insertions or deletions. This saves me having to build an authentication system which is a bit more than I intend to do for a quick demonstration. The database we are using had been downloaded from the <a href="https://www.mysqltutorial.org/mysql-sample-database.aspx">mysqltutorial.org</a> website. It's for a company selling toy vehicles, a bit like "Dinky", "Corgi" etc.</p>
        <h3>Static search</h3>
        <p>For this, we will simply submit a search and have it returned to a separate page. Put part of a name for a model of car into the box below. Press the search button and you will be redirected to a results page. Don't worry, there's a link to get back.</p>
        <form action="mysqlresults.php" method="post">
            <div class="container-sm bg-light">
                <label for="nameSearch" class="form-label">Search for a car name:</label>
                <input class="form-control" type="text" name="carName" id="nameSearch">
                <div id="emailHelp" class="form-text">NOT case sensitive</div>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
               
        
        <h3 class="mt-5">Dynamic selection</h3>
        <p>Now, let's make something a little more complicated. We will stick to the same table within the database. By adding some more controls, we can give the user more options to search through all the listings. The default can be to list everything with a set limit on how many are displayed at once. From there, we can provide tools within our UI to filter the data and change the order which thems are displayed in. Bootstrap should simplify this process.</p>
        <p>To achieve this goal, we now have to change tack and update the data dynamically by manipulating the DOM. We can use JavaScript on the client side. the <i>fetch()</i> api will handle our requests and responses, <i>.innerHTML</i> will allow us to add and remove the contents of elements without reloading.</p>
        
        
        
    </div>
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <?php include 'includes/footer.php' ?>
    </div>
    
</div>
<!--Loading the Javascript for bootstrap-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    
</body>
</html>