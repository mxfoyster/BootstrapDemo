<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Load bootstrap css-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bootstrap_overrides.css">
        <script src="js\querymodelcars.js" defer></script>
        <title>Bootstrap test</title>
    </head>
<body>

<div class="container">
    <!--Header Here-->
    <?php include 'includes/header.php' ?>
    <!--MODAL POP UP-->
    <div class="modal fade" id="clickedRecordModal" tabindex="-1" aria-labelledby="clickedRecordModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-bg-primary">
          <h5 class="modal-title" id="clickedRecordModalLabel">Stock Number <span id="indivResultID"></span></h5>
          <button type="button btn-primary" class="btn-close" aria-label="Close"  onclick="closeModal()"></button>
        </div>
        <div class="modal-body" id="modalRecordData"> We can load the record data here</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
          
        </div>
      </div>
    </div>
    </div>
    <div class="modal-backdrop fade show" id="backdrop"  style="display: none;"></div>
    <!--End of Modal Popup-->
    
    
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
        
        <div class="container">
        
            <span class="fs-6 fw-bold">Filters:</span>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="fs-6 fw-bold">Choose by Product Line</div>
                    <select class="form-select-sm" id="selectPL" aria-label="Choose by product line" name="ProductLines">
                        <option id="selectPL1stChild" value="0" selected>ALL</option>
                    </select>
                </div>
                <div class="col">
                    <div class="fs-6 fw-bold">Choose by Product Vendor</div>
                    <select class="form-select-sm" id="selectPV" aria-label="Choose by product vendor" name="ProductVendors">
                        <option id="selectPV1stChild" value="0" selected>ALL</option>
                    </select>
                </div>
                <div class="col">
                    <div class="fs-6 fw-bold">Search by Name</div>
                    <input class="form-control" type="text" name="carName" id="nameSearch2">
                    <div id="emailHelp" class="form-text">NOT case sensitive</div>
                    </select>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-sml btn-primary float-end" id="applyButton">Apply</button>
                </div>
            </div><hr>
            <div class="row">
                <span class="col">Number of Results: <span id="numResults"></span></span>
                
                <ul class="pagination col">
                    <li class="page-item" id="backLi"><span class="page-link" id="pgBk">&lt;</span></li>
                    
                    <li class="page-item" id="fwdLi"><span class="page-link" id="pgFwd">&gt;</span></li>
                </ul>
                <form class="col" action=""> 
                    Results per page:&nbsp;                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="numPerPageOption" id="inlineRadio1" value="option1" checked="checked">
                        <label class="form-check-label" for="inlineRadio1">12</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="numPerPageOption" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">24</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="numPerPageOption" id="inlineRadio3" value="option3" >
                        <label class="form-check-label" for="inlineRadio3">48</label>
                    </div>
                </form>
            </div>
            
        </div>
        <hr>
        <script>
        //  dBaseResult = (<?php //include 'includes/modelcarsall.php' ?>);
        // dBaseProductLines = (<?php //include 'includes/modelcarsbyproductline.php' ?>);
        // dBaseProductVendor = (<?php //include 'includes/modelcarsbyproductvendor.php' ?>);
        
        </script>
        <div class="container" id="responseBox"></div>
    </div>
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <?php include 'includes/footer.php' ?>
    </div>
    
</div>
<!--Loading the Javascript for bootstrap-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    
</body>
</html>