const radio = document.getElementsByName("numPerPageOption");
const responseBox = document.getElementById("responseBox");
const numResults = document.getElementById("numResults");
const pgBack = document.getElementById("pgBk");
const pgFwd = document.getElementById("pgFwd");

for (var i = 0; i < radio.length; i++) radio[i].addEventListener('change', Validate);
pgBack.addEventListener("click",()=>changePage("back"));
pgFwd.addEventListener("click",()=>changePage("fwd"));
var colCounter = 1;
var currentPage = 1;
var numberPerPage;


const buildData =  () =>{
    var listing; //where we store the listing
    //go through the json data one object at a time
    dBaseResult.forEach((element, elementIndex) => {
    //if correct index for current page
    if (elementIndex >= ((numberPerPage * currentPage) - numberPerPage) && elementIndex < (numberPerPage * currentPage) ){
        //build the string
        var elementColString ="<div class=\"col p-2 m-2 border bg-primary\">\n" + "<b>Model Name:</b> " + element.productName + "<br>" + "<b>Product Line:</b> " + element.productLine + "<br>" + "<b>Scale:</b> " + element.productScale + "<br>" + "<b>Price: </b>£" + element.buyPrice + "</div><br>";
        if (colCounter == 1) listing += "<div class=\"row py-2\">"; //if first row, add start div for it
        listing += elementColString; //whatever column, add the contents from pre-built string
        if (colCounter < 3) {colCounter++;} // if not last column, increment counter
        else { //otherwise add our end div tag and reset counter
            listing +="</div>";
            colCounter = 1;
        }
        
        }
    }); //end of foreach loop
    colCounter = 1; //mustn't forget to reset this!!
    return listing;    
}

//responseBox.innerHTML = buildData(24,5);

function Validate() {
    currentPage = 1;
    //Reference the Group of RadioButtons.

    //Set the Valid Flag to False initially.
    var isValid = false;

    //Loop and verify whether at-least one RadioButton is checked.
    for (var i = 0; i < radio.length; i++) {
        if (radio[i].checked) {
            numberPerPage = doubleNumberXtimes(12,i);
            UpdateDisplay();
            break;
        }
    }
}

function doubleNumberXtimes(number, times){
    for (i=1; i <= times; i++){
        number += number;
    }
    return number;
}

function changePage(direction){
    
    if (direction == "back" && currentPage > 1){
        currentPage--;
        UpdateDisplay();
        console.log(currentPage);
    }
    else if (direction == "fwd" && (currentPage * numberPerPage) < dBaseResult.length){
        currentPage++;
        UpdateDisplay();
        console.log(currentPage);
    }
}

function UpdateDisplay(){
    var thisResponse = buildData();
    if (thisResponse.startsWith("undefined")) thisResponse = thisResponse.substring(9,thisResponse.length); //HACK
    responseBox.innerHTML = thisResponse;
    numResults.innerHTML= dBaseResult.length;
} 
Validate();