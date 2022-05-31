const radio = document.getElementsByName("numPerPageOption");
const responseBox = document.getElementById("responseBox");
const numResults = document.getElementById("numResults");
const pgBack = document.getElementById("pgBk");
const pgFwd = document.getElementById("pgFwd");
const pagesInnerList = document.getElementById("pagesInnerList");
const fwdLi = document.getElementById("fwdLi");
const selectPL = document.getElementById("selectPL");
const selectPV = document.getElementById("selectPV");
const selectPL1stChild = document.getElementById("selectPL1stChild");
const selectPV1stChild = document.getElementById("selectPV1stChild");
const applyButton = document.getElementById("applyButton");
const searchBox = document.getElementById("nameSearch2");
const indivResultID = document.getElementById('indivResultID');
const indivResultData = document.getElementById('indivResultData');
const modalRecordData = document.getElementById('modalRecordData');

for (var i = 0; i < radio.length; i++) radio[i].addEventListener('change', Validate);
pgBack.addEventListener("click",()=>changePage("back"));
pgFwd.addEventListener("click",()=>changePage("fwd"));
applyButton.addEventListener("click",()=>applyFilters());

var colCounter = 1;
var currentPage = 1;
var numberPerPage;
var thisRecord;

function applyFilters(){
    var selectedPL = selectPL.value;
    var selectedPV = selectPV.value
    
    //console.log(dBaseProductLines[2].productLine);
    if (selectedPL != "0" && selectedPV == "0") getData("allByProductLine", selectedPL);
    if (selectedPL == "0" && selectedPV != "0") getData("allByProductVendor", selectedPV);
    if (selectedPL != "0" && selectedPV != "0") getData("allByLineAndVendor", selectedPL, selectedPV);
    if (selectedPL == "0" && selectedPV == "0") getData("all");
}

function populateProductLineListBox(){
//populate product line dropbox
dBaseProductLines.forEach((element, elementIndex) =>{
    var newElement = document.createElement('option');
    selectPL1stChild.insertAdjacentElement('afterEnd', newElement);
    newElement.setAttribute('value', element.productLine);
    var htmlToInsert = element.productLine; //<option value="1">One</option>
    newElement.innerHTML = htmlToInsert;
    });
}

function populateProductVendorListBox(){
    //populate product vendor dropbox
dBaseProductVendor.forEach((element, elementIndex) =>{
    var newElement = document.createElement('option');
    selectPV1stChild.insertAdjacentElement('afterEnd', newElement);
    newElement.setAttribute('value', element.productVendor);
    var htmlToInsert = element.productVendor; //<option value="1">One</option>
    newElement.innerHTML = htmlToInsert;
    });
}

//Builds our columns according to page number & how many per page
const buildData =  () =>{
    var listing; //where we store the listing
    //go through the json data one object at a time
    dBaseResult.forEach((element, elementIndex) => {
    //if correct index for current page
    if (elementIndex >= ((numberPerPage * currentPage) - numberPerPage) && elementIndex < (numberPerPage * currentPage) ){
        //build the string
        var elementColString ="<div class=\"col p-2 m-2 border bg-primary clickable\" id=\"" + element.productCode + "\">\n" + "<b>Model Name:</b> " + element.productName + "<br>" + "<b>Product Line:</b> " + element.productLine + "<br>" + "<b>Scale:</b> " + element.productScale + "<br>" + "<b>Price: </b>£" + element.buyPrice + "</div><br>";
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

function noData(){
    displayString = "<div class=\"row py-2\"><div class=\"col p-2 m-2 border bg-primary\"> SORRY, NO MATCH</div></div>";
    responseBox.innerHTML = displayString;
    numResults.innerHTML= "0";
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
    addListenersToResults(); 
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

//TESTING FETCH TO POST SEARCH OPTIONS
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

//sort out our listerner and handler for click on an individual result
function addListenersToResults(){
    var clickables = document.querySelectorAll(".clickable");
    
    clickables.forEach((clickable, clickableIndex)=>{ 
      
        clickable.addEventListener('click', ()=>{getData("byID", clickable.id); });
    }); 
}

function showItem(){
    indivResultID.innerHTML=thisRecord[0].productCode;
    var modalContent = "<b>Product Name:</b><br><div class=\"text-center\">" + thisRecord[0].productName;
    modalContent += "</div><br><b>Product Line:</b> " + thisRecord[0].productLine;
    modalContent += "&nbsp;&nbsp;&nbsp;<b>Product Scale: </b>" + thisRecord[0].productScale;
    modalContent += "<br><br><b>Product Description:</b><br>" + thisRecord[0].productDescription;
    modalContent += "<br><br><b>Product Vendor:</b><div class=\"text-center\">" + thisRecord[0].productVendor;
    modalContent += "</div><table class=\"table text-center\"><tr class=\"fw-bold\">";
    modalContent += "<td>Qty In Stock</td><td>Wholesale Price</td><td>Retal Price</td>"; 
    modalContent += "<br><tr class=\"text-center\"><td>" + thisRecord[0].quantityInStock + "</td><td>£";
    modalContent += thisRecord[0].buyPrice + "</td><td>£" + thisRecord[0].MSRP + "</td>";
    modalContent += "</tr></table>"
    modalRecordData.innerHTML = modalContent;
    openModal();
}

//open the modal
function openModal() {
    document.getElementById("backdrop").style.display = "block"
    document.getElementById("clickedRecordModal").style.display = "block"
    document.getElementById("clickedRecordModal").className += "show"
}

//close the modal
function closeModal() {
    document.getElementById("backdrop").style.display = "none"
    document.getElementById("clickedRecordModal").style.display = "none"
    document.getElementById("clickedRecordModal").className += document.getElementById("clickedRecordModal").className.replace("show", "")
}
// Get the modal
var modal = document.getElementById('clickedRecordModal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    closeModal()
  }
}

//Populate screen with initial results
getData("all");
//populate selection boxes
getData("productLine");
getData("productVendor");
