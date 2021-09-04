<!doctype html>
<html lang="de">
    
   <?php
   require_once 'autoload.php';

    // Define a global basepath
    define('BASEPATH','/Wirzkalender/');
   ?>
<head>
  <meta charset="utf-8">
  <title>submit demo</title>
  <style>
  p {
    margin: 0;
    color: blue;
  }
  div,p {
    margin-left: 10px;
  }
  span {
    color: red;
  }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>
<body>

<form action="javascript">
  <div>
    <input id="searchstring" type="text">
    <input type="submit">
  </div>
</form>
<span></span>
    <div id="texts"></div>
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