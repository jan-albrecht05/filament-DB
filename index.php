<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filament DB</title>
    <link rel="icon" href="assets/icons/web-icon.png">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="assets/js/heading.js"></script>
    <script src="assets/js/user.js" defer></script>
    <script src="assets/js/mode.js" defer></script>
</head>
<body>
    <div id="header"><!--Code injectedd via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
    <div id="main">
        <div id="controls">
            <button id="addbtn" onclick="location = 'pages/add.php'">Hinzufügen</button>
            <div id="toggleswitch">
                <button id="listbtn" class="togglebtn active center" onclick="listmode()"><span class="material-symbols-outlined">toc</span></button>
                <button id="gridbtn" class="togglebtn center" onclick="gridmode()"><span class="material-symbols-outlined">view_cozy</span></button>
            </div>
        </div>
        <div id="modecss" hidden><!--CSS for Filament-view gets inserted here via /assets/js/mode.js--></div>
        <div class="filament" id="filamentheading">
            <div class="img center">Bild</div>
            <div class="box">
                <div class="row">
                    <div class="hersteller">Hersteller</div>
                    <div class="material">Material</div>
                    <div class="farbe">Farbe</div>
                    <div class="durchmesser">Durchmesser</div>
                </div>
                <div class="row">
                    <div class="preis">Preis</div>
                    <div class="gewicht">Gewicht</div>
                    <div class="besitzer">Besitzer</div>
                    <div class="anzahl">Anzahl</div>
                    <div class="bedtemp center">Bedtemp.</div>
                    <div class="nozzletemp center">Nozzletemp.</div>
                    <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
        <div id="filament-output">
    	<!--
        A lot of content is added manually to show the looks.
        Can be deleted anytime
        -->
            <!--PHP: Filament-Output-->
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">Ultimaker<!--PHP: Hersteller--></div>
                        <div class="material">PLA <!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>60°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>220°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">Ultimaker<!--PHP: Hersteller--></div>
                        <div class="material">PLA <!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>60°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>220°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
            <div class="filament" id="0001"><!--ID wird mit PHP token eingefügt-->
                <div class="img">
                    <!--Bild wird noch via CSS als Backgroud-image eingefügt-->
                    <!--PHP: Img vom Benchy in der--></div>
                <div class="box">
                    <div class="row">
                        <div class="hersteller">3D Jake<!--PHP: Hersteller--></div>
                        <div class="material">PETG<!--PHP: Material--></div>
                        <div class="farbe">#ff0000
                            <!--PHP: Farbe-->
                            <!--maybe possible to change color to Text?--></div>
                        <div class="durchmesser">1.75mm<!--PHP: Durchmesser--> </div>
                    </div>
                    <div class="row">
                        <div class="preis">17€<!--PHP: Preis--></div>
                        <div class="gewicht">750g<!--PHP: Gewicht--></div>
                        <div class="besitzer">Homburgschule<!--PHP: Besitzer--></div>
                        <div class="anzahl">1<!--PHP: Anzahl--></div>
                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>80°C<!--PHP: Bedtemp--></div>
                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>250°C<!--PHP: Nozzletemp--></div>
                        <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>