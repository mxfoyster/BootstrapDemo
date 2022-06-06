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
        <h2>Some random stuff</h2>
        <p>This is just an opportunity I have taken to familiarise myself with Bootstrap. from my journay so far, I have discovered that whilst default styles are prohibitive, there are the possibilities of overriding them (which I have done in one case) and there are many templates available that I might explore later.</p>
        <p>My conclusion is that if I am after a very specific looking design that is optimised for UX, Bootstrap would probably not be my first choice. However, for making reasonable looking front ends quickly for tying into a backend or for the purposes of a functional prototype for a website, I think it is extremely useful.</p>
        <p>For some more serious stuff, check out the <a href="mysqldemo.php">MySQL DEMO</a> with PHP. Here I load and filter some live data from a demo database.</p>
        <h3>Hey, if you're bored, press the button!</h3>
        <button type="button" class="col-sm-2 btn btn-primary btn-lg m-3"  data-bs-toggle="modal" data-bs-target="#exampleModal">Open PopUp</button>
   
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Pop Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Congratulations, you can push a button using a mouse :-) <br> Don't knock it, there's plenty that can't lol...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>      
            </div>
            </div>
        </div>
        </div>

        <!--carousel-->
        <h3>Everyone loves a good carousel lol</h3>
        <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Brampton Mill"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Kings Dyke"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Gunwade Lake"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Margam Park"></button>
              </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/carousel1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"><h5>Brampton Mill</h5></div>
              </div>
              <div class="carousel-item">
                <img src="images/carousel2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"><h5 class="text-info">Kings Dyke</h5></div>
            </div>
              <div class="carousel-item">
                <img src="images/carousel3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"><h5 class="text-danger">Gunwade Lake</h5></div>
              </div>
              <div class="carousel-item">
                  <img src="images/carousel4.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"><h5 class="text-primary">Margam Park</h5></div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
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