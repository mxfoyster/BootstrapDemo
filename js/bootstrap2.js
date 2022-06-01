const tableColStyleListBox = document.getElementById('tableColStyleListBox');
const tableBorderStyleListBox = document.getElementById('tableBorderStyleListBox');
const tableStyleChangeBtn = document.getElementById('tableStyleChangeBtn');
const tableToChange = document.getElementById('tableToChange');

tableStyleChangeBtn.addEventListener('click', changeTableStyle);

var lastTableColClass="";
var lastTableBorderClass="";


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

    //Warning, NAUGHTY HACK!!!
    //now we must force it to re-render or all changes will not be applied
    //this is because the browser in some cases only sees a small change and chooses not to re-render it
    //we force it to by re-loading the table contents, ie, a big chance so it re-renders the table
    tableContent = tableToChange.innerHTML;
    tableToChange.innerHTML = tableContent;
}