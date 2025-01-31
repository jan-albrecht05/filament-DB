function gridmode(){
    linkcheck();
    if(homepage){
        document.getElementById("modecss").innerHTML = "<link rel='stylesheet' href='assets/css/grid.css'>";
    }else{
        document.getElementById("modecss").innerHTML = "<link rel='stylesheet' href='../assets/css/grid.css'>";
    }
    document.getElementById("listbtn").classList.remove("active");
    document.getElementById("gridbtn").classList.add("active");
    localStorage.setItem("mode", "grid");
    addUserEventListener(); // Re-add event listener after changing mode
}

function listmode(){
    linkcheck();
    if(homepage){
        document.getElementById("modecss").innerHTML = "<link rel='stylesheet' href='assets/css/list.css'>";
    }else{
        document.getElementById("modecss").innerHTML = "<link rel='stylesheet' href='../assets/css/list.css'>";
    }
    document.getElementById("listbtn").classList.add("active");
    document.getElementById("gridbtn").classList.remove("active");
    localStorage.setItem("mode", "list");
    addUserEventListener(); // Re-add event listener after changing mode
}

//checks the current path
//if page is index.php => homepage = true
function linkcheck(){
    link = new URL(window.location.href);
    if (link.pathname.includes("index.php")){
        homepage = true;
    }
    else{
        homepage = false;
    }
}