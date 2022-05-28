const radio = document.getElementsByName("numPerPageOption");
const responseBox = document.getElementById("responseBox");
const numResults = document.getElementById("numResults");
const pgBack = document.getElementById("pgBk");
const pgFwd = document.getElementById("pgFwd");
const pagesInnerList = document.getElementById("pagesInnerList");
const fwdLi = document.getElementById("fwdLi");

for (var i = 0; i < radio.length; i++) radio[i].addEventListener('change', Validate);
pgBack.addEventListener("click",()=>changePage("back"));
pgFwd.addEventListener("click",()=>changePage("fwd"));
var colCounter = 1;
var currentPage = 1;
var numberPerPage;

//Builds our columns according to page number & how many per page
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

//check our radiobuttons (norm. called from listeners)
function Validate() {
    currentPage = 1;
    //Reference the Group of RadioButtons.

    //Set the Valid Flag to False initially.
    var isValid = false;

    //Loop and verify whether at-least one RadioButton is checked.
    for (var i = 0; i < radio.length; i++) {
        if (radio[i].checked) {
            numberPerPage = doubleNumberXtimes(12,i);
            buildPageNumbers();
            UpdateDisplay();
            break;
        }
    }
}

//doubles number by (times) times to get our 12, 24, 48 per page 
function doubleNumberXtimes(number, times){
    for (i=1; i <= times; i++){
        number += number;
    }
    return number;
}

// monitors our page change 'buttons' and responds accordingly
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

//By extracting this, I can refresh without calling the radiobutton validate
function UpdateDisplay(){
    var thisResponse = buildData();
    if (thisResponse.startsWith("undefined")) thisResponse = thisResponse.substring(9,thisResponse.length); //HACK
    responseBox.innerHTML = thisResponse;
    numResults.innerHTML= dBaseResult.length;
}

//populates and adds listeners to the page numbers on the page selection bar
function buildPageNumbers(){
    //erase previous page numbers if they are there
    var listItemsToErase = document.querySelectorAll('.liAddedHandle');
    if (listItemsToErase.length > 0) listItemsToErase.forEach(listItem =>{ listItem.remove();});
    
    var totalNumPages = Math.ceil(dBaseResult.length /numberPerPage); //calculate number of pages needed
    //Loop through and add the tags
    for (i=1; i<= totalNumPages; i++){
        var newElement = document.createElement('li');
        fwdLi.insertAdjacentElement('beforeBegin', newElement);
        newElement.setAttribute('class', 'page-item liAddedHandle');
        var htmlToInsert ="<span class=\"page-link\" >" + i +"</span>";
        newElement.innerHTML = htmlToInsert;
    }

    //now add the listeners
    var listItemsToAddListeners = document.querySelectorAll('.liAddedHandle');
    listItemsToAddListeners.forEach((listItem, listItemIndex) =>{ listItem.addEventListener('click',()=>{
        currentPage = (listItemIndex+1);
        
    UpdateDisplay(); //best show what we've done!
    });});
}

//we set this at the end to get an initial status for the number
//per page.. Defaulted to 12 in the html by radiobutton selected
Validate();

