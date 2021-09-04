<!doctype html>
<html lang="de">
    
   <?php
   require_once 'autoload.php';

    // Define a global basepath
    define('BASEPATH','/Wirzkalender/');
   ?>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Digitaler Wirzkaldender</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">agridea</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#suche">Suche</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image -->
                <img class="masthead-avatar mb-5" src="assets/img/kisspng-pig-emoji-sticker-computer-icons-sms-classified-vector-5ad8d31040a221.8512609615241592482648.png" alt="..." />
                <!-- Masthead Heading -->
                <h1 class="masthead-heading text-uppercase mb-0">Digitaler Wirzkalender</h1>
                <!-- Icon Divider -->
                <!-- Masthead Subheading -->
                <p class="masthead-subheading font-weight-light mb-0"></p>
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section suche" id="suche">
            
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto">
                      <h5 class="font-weight-light mb-4 font-italic text-white">Default search bars with input group</h5>
                      <div class="bg-white p-5 rounded shadow">
                
                        <!-- Default search bars with input group -->
                        <form action="">
                          <div class="input-group mb-4">
                              
                            <input type="search" id="searchstring" placeholder="Was mÃ¶chtest du suchen?" aria-describedby="button-addon5" class="form-control">
                            <div class="input-group-append">
                              <button id="button-addon5" type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                          
                        </form>
                        <!-- End -->
                
                      </div>
                    </div>
                  </div>
               <div class="container" >
                    <div id="texts"></div>
               </div>
              
        </section>

        
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script>
            $( "form" ).submit(function( event ) {
              event.preventDefault();
              document.getElementById("texts").innerHTML = "";
              var searchstring = document.getElementById("searchstring").value;   
                                alert(searchstring);
                searchstring = JSON.stringify({searchstring:searchstring});
                fetch( "Configuration/Controller/SearchController.php" , {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json'},
                    body: searchstring
                })
                .then((response) => {
                    if (response.ok) {

                        return response.json();
                    } else {
                        throw new Error("NETWORK RESPONSE ERROR");
                    }
                })
                .then(data => {
                  console.log(data);
                  displayText(data);
                })
                .catch((error) => console.error("FETCH ERROR:", error));

            });

            function displayText(data) {

              const textDiv = document.getElementById("texts");

                for (let i = 0; i < data.length; i++) {
                    var textsContent = data[i]["textpart"];
                    var textsTitle = data[i]["title"];

                    //Schreibe texts in cocktail Div
                   // cocktailDiv.appendChild(texts);

                    const heading = document.createElement("h1");
                    heading.innerHTML = textsTitle;
                    textDiv.appendChild(heading); 

                    var z = document.createElement('p'); // is a node
                    z.innerHTML = textsContent;
                    textDiv.appendChild(z);
                }
             //document.body
            } 

        </script>   
    </body>
</html>

