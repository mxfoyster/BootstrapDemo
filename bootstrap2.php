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
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <h2>More random stuff</h2>
        <p>This is just a continuation from the first page, some room to try out more features.</p>
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
      <p>Now select the style you want:</p>
      <div class="row">
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
          <button type="button" class="btn btn-primary" id="tableStyleChangeBtn">Change Table</button>
        </div>
      </div>
      
        
        
    
    </div>
    <div class="row shadow p-3 mb-5 bg-body rounded mt-4">
        <?php include 'includes/footer.php' ?>
    </div>
    
</div>
<!--Loading the Javascript for bootstrap-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    
</body>
</html>