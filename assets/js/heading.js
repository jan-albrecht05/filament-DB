let homepage = false;
let logolink, userimglink = "";
window.addEventListener("load", () =>{
    heading();
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
                    '<input id="text-input" type="text" name="query" placeholder="Suche oder token eingeben..">'+
                    '<button id="search-btn" type="submit"><span class="material-symbols-outlined center">search</span></button>'+
                '</form></div><div id="user" class="center">'+
                '<div id="user-name">Hallo <i>Gast</i></div><div id="user-profile-img"><img src="'+
                userimglink+'assets/icons/user.png" title="Gast" alt="Gast"></div></div></div>';
    document.getElementById("header").innerHTML = heading;

}
function login() {
    if (homepage){
        window.location.href = "pages/login.html";
    }
    else{
        window.location.href = "../pages/login.html";
    }
};