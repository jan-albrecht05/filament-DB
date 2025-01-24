let homepage = false;

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
        heading = '<div id="inner-header"><a id="logo" href="#" class="center"><img id="logoimg" src="assets/icons/filament-DB.png" alt="Filament-DB" title="Home"></a><div id="suche" class="center"><input id="text-input" type="text" placeholder="Suche oder token eingeben.."><button id="search-btn"><span class="material-symbols-outlined center">search</span></button></div><div id="user" class="center"><div id="user-name">Hallo <i>Gast</i></div><div id="user-profile-img"><img src="assets/icons/user.png" title="Gast" alt="Gast"></div></div></div>';
        document.getElementById("header").innerHTML = heading;
    }
    else{
        //if homepage is false
        //fills the logo-link with the href to the homepage
        heading = '<div id="inner-header"><a id="logo" href="../index.php" class="center"><img id="logoimg" src="../assets/icons/filament-DB.png" alt="Filament-DB" title="Home"></a><div id="suche" class="center"><input id="text-input" type="text" placeholder="Suche oder token eingeben.."><button id="search-btn"><span class="material-symbols-outlined center">search</span></button></div><div id="user" class="center"><div id="user-name">Hallo <i>Gast</i></div><div id="user-profile-img"><img src="../assets/icons/user.png" title="Gast" alt="Gast"></div></div></div>';
        document.getElementById("header").innerHTML = heading;
    }
}
window.onload = heading;