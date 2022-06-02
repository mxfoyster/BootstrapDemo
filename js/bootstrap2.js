const tableColStyleListBox = document.getElementById('tableColStyleListBox');
const tableBorderStyleListBox = document.getElementById('tableBorderStyleListBox');
const tableStyleChangeBtn = document.getElementById('tableStyleChangeBtn');
const tableToChange = document.getElementById('tableToChange');
const sizeCheckBox = document.getElementById('sizeCheckBox');
const progressBar = document.getElementById('progressBar');
const progressBarContainer = document.getElementById('progressBarContainer');

tableStyleChangeBtn.addEventListener('click', changeTableStyle);

var lastTableColClass = "";
var lastTableBorderClass = "";
var progressBarPosition = 0;
var progressBarUnwindDelay = 0;

//we call the function to move our progress bar every 60ms if browser can handle it that fast..
setInterval(moveProgressBar, 60);

//handles our form input to change the table layout, triggered by the button
function changeTableStyle(){
    //change table colour
    changeValue = tableColStyleListBox.value;
    if (lastTableColClass != "") tableToChange.classList.remove(lastTableColClass);
    lastTableColClass = changeValue;
    tableToChange.classList.add(changeValue);

    //change border colour
    changeValue = tableBorderStyleListBox.value;
    if (lastTableBorderClass != "") tableToChange.classList.remove(lastTableBorderClass);
    lastTableBorderClass = changeValue;
    tableToChange.classList.add(changeValue);

    //size checkbox
    var containsSmlTableClass = tableToChange.classList.contains("table-sm");

    if (sizeCheckBox.checked && !containsSmlTableClass)  tableToChange.classList.add("table-sm"); 
    
    if (!sizeCheckBox.checked && containsSmlTableClass)  tableToChange.classList.remove("table-sm"); 

    //Warning, NAUGHTY HACK!!!
    //now we must force it to re-render or all changes will not be applied
    //this is because the browser in some cases only sees a small change and chooses not to re-render it
    //we force it to by re-loading the table contents, ie, a big chance so it re-renders the table
    tableContent = tableToChange.innerHTML;
    tableToChange.innerHTML = tableContent;
}

//progress bar function called from our setInterval
function moveProgressBar(){
    //There is some rendering lag as it's animated.
    //to get over this, we wait 20 iterations each site of 100% and 0%
    //to let it catch up.
    if (progressBarPosition == 101) {
        progressBarUnwindDelay ++
        if ( progressBarUnwindDelay == 20){
            progressBar.setAttribute('aria-valuenow', 0);
            progressBar.style.width = "0%";
        }
        if ( progressBarUnwindDelay == 40){
            progressBarUnwindDelay = 0;
            progressBarPosition = -1;
        }
        return
    }
    
    progressBarPosition++
    progressBar.setAttribute('aria-valuenow', progressBarPosition);
    progressBar.style.width = progressBarPosition + "%";
   
}