function footer(){
    linkcheck();
    if(homepage){
        document.getElementById("footer-content").innerHTML = 
        '<a href="pages/impressum.html">Impressum</a>'+
        '<a  id="githublink" href="https://github.com/jan-albrecht05/filament-DB" target="_blank" title="View this project on GitHub!"></a>'+
        '<span>© Copyright 2025</span>'+
        '<a href="pages/FAQ.php">FAQ</a>'+
        '<a href="pages/admin-panel.php">Admin-Panel</a>';
    }else{
        document.getElementById("footer-content").innerHTML = 
        '<a href="impressum.html">Impressum</a>'+
        '<a id="githublink" href="https://github.com/jan-albrecht05/filament-DB" target="_blank" title="View this project on GitHub!"></a>'+
        '<span>© Copyright 2025</span>'+
        '<a href="FAQ.php">FAQ</a>'+
        '<a href="admin-panel.php">Admin-Panel</a>';
    }
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