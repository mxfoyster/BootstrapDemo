<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Load bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap_overrides.css">
    <script src="js/bootstrap2.js" defer></script>
    <title>Bootstrap test</title>
</head>
<body>
<div class="container">
    <!--Header Here-->
    <?php include 'includes/header.php' ?>
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4"> <!--MID CONTAINER-->
    
        <h2>More random stuff</h2>
        <p>This is just a continuation from the first page, some room to try out more features.</p>
        <h4 class="text-danger">BEWARE, FLASHING STUFF BELOW!!</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <h3>How about a nice table?</h3>
        <table class="table table-hover table-bordered w-auto mx-auto" id="tableToChange"> 
        <thead>
          <tr>
              <td>First Row</td> <td>Second Row</td>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr>
            <td>Cell A1</td> <td>Cell A2 has more text in</td>
          </tr>
          <tr>
            <td>Cell B1</td> <td>Cell B2 has more text in</td>
          </tr>
          <tr>
            <td>Cell C1</td> <td>Cell C2 has more text in</td>
          </tr>
        </tbody>
        
        
      </table>
      <p>Now select the style you want using some form controls:</p>
      <div class="row mb-1">
        <div class="col">
          <div class="fs-6 fw-bold">Table Colour</div>
          <select class="form-select" id="tableColStyleListBox" aria-label="Default select example">
            <option value="table-primary" selected>Primary</option>
            <option value="table-secondary">Secondary</option>
            <option value="table-success">Success</option>
            <option value="table-danger">Danger</option>
            <option value="table-warning">Warning</option>
            <option value="table-info">Info</option>
            <option value="table-light">Light</option>
            <option value="table-dark">Dark</option>
          </select>
        </div>
        <div class="col">
          <div class="fs-6 fw-bold">Border Colour</div>
          <select class="form-select" id="tableBorderStyleListBox" aria-label="Default select example">
            <option value="border-primary" selected>Primary</option>
            <option value="border-secondary">Secondary</option>
            <option value="border-success">Success</option>
            <option value="border-danger">Danger</option>
            <option value="border-warning">Warning</option>
            <option value="border-info">Info</option>
            <option value="border-light">Light</option>
            <option value="border-dark">Dark</option>
          </select>
        </div>
        <div class="col">
          <div class="fs-6 fw-bold">&nbsp;</div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="sizeCheckBox">
            <label class="form-check-label" for="flexCheckDefault">Small Table</label>
          </div>
        </div>
        <div class="col">
          <div class="fs-6 fw-bold">&nbsp;</div>
          <button type="button" class="btn btn-primary" id="tableStyleChangeBtn">Change Table</button>
        </div>
      </div>
      <p></p>
      <h3>Entertainment while waiting</h3>
      <p class="mt-1">Loading a lot of data? How about some spinners while we wait!</p>
      <div class="row text-center">
        <div class="col-sm p-2">
          <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-border text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
            <div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-border text-warning" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-border text-info" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="bg-primary col-sm p-2">
          <div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-border text-dark" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
      </div>
      <p class="mt-1">These spinners don't spin, they grow!!</p>
      <div class="row text-center">
        <div class="col-sm p-2">
          <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-grow text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-grow text-success" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
            <div class="spinner-grow text-danger" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-grow text-warning" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-grow text-info" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="bg-primary col-sm p-2">
          <div class="spinner-grow text-light" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
        <div class="col-sm p-2">
          <div class="spinner-grow text-dark" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
      </div>
      <p>Sometimes, it's good to progress with a progress bar:</p>
      <div class="progress" id="progressBarContainer">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressBar"></div>
      </div>
      <h3 class="my-5">Can you play the Accordion?</h3>
      <p>What better way to demonstrate an accordion feature than by featuring it's instrument counterpart? So, Can you play?</p>
          
      <!-- ACCORDION STARTS HERE -->
      <div class="accordion" id="accordionExample">
        <!-- FIRST ITEM -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Yes I Can.</button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <h4 class="text-success">Congratulations, feel free to join in!</h4> 
              <figure class="figure mx-auto d-block">
                <img src="images/accordion.gif" class="rounded mx-auto d-block">
                <figcaption class="figure-caption figure text-center d-block">He's having fun!.</figcaption>
              </figure>
              <p>Bonus feature, notice the image caption using the <code>figure</code> system within bootstrap</p>
            </div>
          </div>
        </div>
        <!-- SECOND ITEM -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            No, I cannot.
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <h4 class="text-danger">Best get learning!</h4> 
              <iframe width="280" height="157" class="mx-auto d-block" src="https://www.youtube.com/embed/CgjshEzhU6c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              <p>Confession time, nor can I.</p>
            </div>
          </div>
        </div>
      </div><!--End of accordion-->
      <p class="my-5">I think that demonstrates quite a few features, There will be more used within the MySQL project...</p>
      
    </div><!--END OF MID CONTAINER-->
    
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <?php include 'includes/footer.php' ?>
    </div>
    
    
</div><!--End of overall container-->
<!--Loading the Javascript for bootstrap-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    
</body>
</html>