var myd = document.getElementById('myd');
var hays = document.getElementById('tt');


//toggle formatting
function toggle(action) {
    if (window.getSelection) {
        //non IE
        document.designMode = "on";
        document.execCommand(action, true, null);
        document.designMode = "off";
    } else if (document.selection && document.selection.createRange && document.selection.type != "None") {
        // IE case
        range = document.selection.createRange();
        range.execCommand(action, false, null);
    }
    myd.focus();
}




function isElement(node){
    return node instanceof HTMLElement;
}
function changeFontSize(size) {
    var sel = document.getSelection();
    if(sel.rangeCount > 0){
        document.execCommand("fontSize", false, size);
    }
    myd.focus();
}

function allDescendants(node) {    
    for(var m = node.firstChild; m != null; m = m.nextSibling) {
        allDescendants(m);
        if(isElement(m)){
            doSomethingToNode(m);
        }
    }
}

function doSomethingToNode(child){
    child.removeAttribute("size");
    child.removeAttribute("style");
}

function getSize(selectedN){
    if(selectedN.hasAttribute("size")){
        size = selectedN.getAttribute("size");
    }else{
        size = 3;
    }
    return size;
}
function sizeup(){
    var selectedN = window.getSelection().anchorNode.parentNode;
    var size = 3;
    if(window.getSelection().rangeCount > 0){
        size = getSize(selectedN);
    }
    changeFontSize(++size);
}
function sizedown(){
    var selectedN = window.getSelection().anchorNode.parentNode;
    var size = 3;
    if(window.getSelection().rangeCount > 0){
        size = getSize(selectedN);
    }
    changeFontSize(--size);
}
function clearText(){
    myd.innerHTML = "";
    myd.focus();
}

function addLink(){
    var sel = document.getSelection();
    if(sel.rangeCount > 0){
        var url = prompt('URL: ','https://');
        document.execCommand("createLink", false, url);
        sel.anchorNode.parentElement.target = '_blank';
    }
    myd.focus();
}
function includepost(){
    var sel = document.getSelection();
    if(sel.rangeCount > 0){
        var id = prompt('Skill: ','');
        document.execCommand("insertHTML", false, "<br>");
        document.execCommand("insertHTML", false, "<span onclick='previewpost("+id+")' class='embedded'>@</span>");
    }
    myd.focus();
}
function choosetoembed(){
    $("#chooseModal").modal('toggle');
    $("#chooseIPT").focus();
}


function previewpost(id){
    $("#previewModal").modal('toggle');
    viewPost(id);
}
function breakline(){
    document.execCommand("insertHTML", false, "<br>");
    myd.focus();
}
function boldCommand() {
    const strongElement = document.createElement("strong");
    const userSelection = window.getSelection();
    const selectedTextRange = userSelection.getRangeAt(0);
    selectedTextRange.surroundContents(strongElement);
}
function highLight(color){
    var sel = document.getSelection();
    if(sel.rangeCount > 0){
        document.execCommand("backcolor", false, color);
    }
    myd.focus();
}
function newLine(){
    document.execCommand("insertHTML", false, "&nbsp;");
    document.execCommand('insertParagraph',false); 
    myd.focus();
}
function newCode(){
    var sel = document.getSelection();
    if(sel.rangeCount > 0){
        document.execCommand("insertHTML", false, "<div class='codeCont'><div class='code' contentEditable='true'>//</div></div>");
    }
    myd.focus();
}
function newQoute(){
    var sel = document.getSelection();
    if(sel.rangeCount > 0){
        document.execCommand("insertHTML", false, "“”");
    }
    myd.focus();
}
function insertTab(){
    document.execCommand("insertHTML", false, "&emsp;");
    myd.focus();
}
function insertDash(){
    document.execCommand("insertHTML", false, "&mdash;");
    myd.focus();
}

function hasLargeScreen(){
    if(screen.width > 767) return true;
    else return false;
}
function scrolldame(){
    if(hasLargeScreen()) return;
    document.getElementsByTagName('body')[0].style.overflow = 'hidden';
}
function scrolldouzo(){
    if(hasLargeScreen()) return;
    document.getElementsByTagName('body')[0].style.overflow = 'auto';
}
myd.onkeydown = function(event) {
    switch (event.keyCode) {
        case 09:
            insertTab();
            event.preventDefault();
        break;
        case 189:
            insertDash();
            event.preventDefault();
        break;
    }
};