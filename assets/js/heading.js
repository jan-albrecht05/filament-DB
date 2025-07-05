let homepage = false;
let logolink, userimglink = "";
window.addEventListener("load", () =>{
    heading();
    if (typeof searchTerm !== "undefined" && searchTerm !== "" && document.getElementById("text-input")) {
        document.getElementById("text-input").value = searchTerm;
    }
    checkforCookies();
});


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
function heading(){
    let heading = ""
    linkcheck();
    //if homepage is true
    if (homepage){
        //leaves the logo-link empty
        logolink = "#";
        imglink = "";
        suche = "";
        userimglink = "";
    }
    else{
        //if homepage is false
        //fills the logo-link with the href to the homepage
        logolink = "../index.php";
        imglink = "../";
        suche = "../";
        userimglink = "../";
    }
    heading = '<div id="inner-header"><a id="logo" href="'+
                logolink+'"class="center"><img id="logoimg" src="'+
                imglink+'assets/icons/filament-DB.png" alt="Filament-DB" title="Home"></a><div id="suche" class="center">'+
                '<form action="'+suche+'pages/search.php" method="GET">'+
                    '<input id="text-input" type="text" name="query" placeholder="Suche oder token eingeben.." oninput="textinput()">'+
                    '<button id="search-btn" type="submit" class="center"><span class="material-symbols-outlined center">search</span></button>'+
                    '</form><button id="scanner-btn" onclick="ToScanner()" class="center"><span class="material-symbols-outlined center">qr_code_scanner</span></button>'+
                    '</div><div id="user" class="center">'+
                '<div id="user-name"></div><div id="user-profile-img"></div></div></div>';
    document.getElementById("header").innerHTML = heading;

    if (loggedInUser) {
        document.getElementById('user-name').textContent = "Hallo " + loggedInUser;
        if (loggedInUserImg !== "null") {
            document.getElementById('user-profile-img').innerHTML = "<img src='" + userimglink + "assets/img/uploads/users/" + loggedInUserImg + "' alt=''>";
        } else {
            document.getElementById('user-profile-img').innerHTML = "<img src='" + userimglink + "assets/icons/user.png' alt=''>";
        }
    }else{
        document.getElementById('user-name').textContent = "Hallo Gast";
        document.getElementById('user-profile-img').innerHTML = "<img src='" + userimglink + "assets/icons/user.png' alt=''>";

    }
}
function login() {
    if (homepage){
        if(loggedInUser !== null){
            window.location.href = "pages/logout.php";
        }else{
            window.location.href = "pages/login.php";
        }
    }
    else{
        if(loggedInUser){
            window.location.href = "../pages/logout.php";
        }
        else{
            window.location.href = "../pages/login.php";
        }
    }
};
function ToScanner(){
    if (homepage){
        window.location.href = "pages/scanner.html";
    }
    else{
        window.location.href = "../pages/scanner.html";
    }
}
function textinput(){
    document.getElementById("search-btn").style.display = "block";
    document.getElementById("scanner-btn").style.display = "none";
}