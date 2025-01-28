function gridmode(){
    document.getElementById("modecss").innerHTML = "<link rel='stylesheet' href='assets/css/grid.css'>";
    document.getElementById("listbtn").classList.remove("active");
    document.getElementById("gridbtn").classList.add("active");
}
function listmode(){
    document.getElementById("modecss").innerHTML = "<link rel='stylesheet' href='assets/css/list.css'>";
    document.getElementById("listbtn").classList.add("active");
    document.getElementById("gridbtn").classList.remove("active");
}