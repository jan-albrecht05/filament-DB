let cookiesstatus = false;
function checkforCookies(){
    let cookiesOK = localStorage.getItem('cookiestatus');
    if(cookiesOK){
        document.getElementById('cookies').style.display = 'none';
    }
    else{
        document.getElementById('cookies').style.display = 'flex';
    }
}
function AcceptCookies(){
    localStorage.setItem('cookiestatus', 'true');
    document.getElementById('cookies').style.display = 'none';
}