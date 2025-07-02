//everything related to the user preferences saved in the local storage

let usersettigsopen = false;


// Initial call in case the element is already present
document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM fully loaded and parsed");
    addUserEventListener();
    addContent();
    checkColor();
    footer();
    checkTheme();
    if(loggedInUser) {
        document.getElementById('login-button').innerHTML = "Logout <span class='material-symbols-outlined'>logout</span>";
    }
    localStorage.getItem("mode") == "grid" ? gridmode() : listmode();
});

// Function to handle user settings toggle
function usersettings() {
    const userSettingsElement = document.getElementById("user-settings");
    if (userSettingsElement) {
        usersettigsopen = !usersettigsopen;
        userSettingsElement.style.transform = usersettigsopen
            ? "translateY(6rem)"
            : "translateY(-13rem)";
    }
}

// Close user settings when clicking outside its content
document.addEventListener("click", (event) => {
    if (!usersettigsopen) return; // Exit early if already closed

    const userSettingsElement = document.getElementById("user-settings");
    const userElement = document.getElementById("user");

    // Prevent closing if the click is inside #user-settings or the #user element
    if (
        userSettingsElement &&
        (userSettingsElement.contains(event.target) || userElement.contains(event.target))
    ) {
        return;
    }

    // Otherwise, close the user settings
    usersettigsopen = false;
    userSettingsElement.style.transform = "translateY(-13rem)";
});

// Function to add event listener to the #user element
function addUserEventListener() {
    const userElement = document.getElementById("user");
    if (userElement) {
        userElement.addEventListener("click", (event) => {
            event.stopPropagation(); // Prevent triggering the document click
            usersettings();
        });
    }
}

// Use MutationObserver to watch for changes in the DOM
const observer = new MutationObserver((mutations) => {
    for (let mutation of mutations) {
        if (mutation.type === "childList") {
            addUserEventListener();
        }
    }
});

// Start observing the document body for changes
observer.observe(document.body, { childList: true, subtree: true });

//Add content to the user settings
function addContent() {
    const userElement = document.getElementById("user-settings");
    userElement.innerHTML = "<span id='color-input-heading'>Prev. Color: </span><input type='color' id='color-picker' value='#da00bd' onchange='changeColor()'><div id='dark-light' onclick='changetheme()'><span class='material-symbols-outlined'>dark_mode</span><span id='dark-light-toggle'><span id='kugel'></span></span><span class='material-symbols-outlined'>light_mode</span></div><div id='login-button-div'><button id='login-button' class='center' onclick='login()'>login<span class='material-symbols-outlined'>login</span></button></div>";
}
//Let's user set a preferred color
function changeColor() {
    let color = document.getElementById("color-picker").value;
    document.documentElement.style.setProperty('--user-main-color', color);
    localStorage.setItem('user-main-color', color);
};
//Checks if user has set a color before and uses it
function checkColor(){
    let color = localStorage.getItem('user-main-color');
    if (color) {
        document.documentElement.style.setProperty('--user-main-color', color);
        document.getElementById("user-settings").innerHTML = "<span id='color-input-heading'>Pref. Color: </span><input type='color' id='color-picker' value='" + color + "' onchange='changeColor()'><div id='dark-light' onclick='changetheme()'><span class='material-symbols-outlined'>dark_mode</span><span id='dark-light-toggle'><span id='kugel'></span></span><span class='material-symbols-outlined'>light_mode</span></div><div id='login-button-div'><button id='login-button' class='center' onclick='login()'>login<span class='material-symbols-outlined'>login</span></button></div>";
    }
}
function changetheme(){
    let theme = localStorage.getItem('user-theme');
    if (theme == 'light'){
        //set light theme
        setDarkTheme();
    }
    else{
        //set dark theme
        setLightTheme();
    }
}
function checkTheme(){
    let theme = localStorage.getItem('user-theme');
    if (theme == 'dark'){
        setDarkTheme();
    }
    else{
        setLightTheme();
    }
}
function setDarkTheme(){
    document.getElementById("kugel").style.marginLeft ="auto";
    document.getElementById("kugel").style.marginRight= ".1rem";
    document.documentElement.setAttribute('data-theme', 'dark');
    localStorage.setItem('user-theme', 'dark');
}
function setLightTheme(){
    document.getElementById("kugel").style.marginRigt ="auto";
    document.getElementById("kugel").style.marginLeft= ".1rem";
    document.documentElement.setAttribute('data-theme', 'light');
    localStorage.setItem('user-theme', 'light');
}