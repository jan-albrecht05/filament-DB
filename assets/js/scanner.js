let isCoolingDown = false;
let canvasElement = document.createElement('canvas');
let canvas = canvasElement.getContext('2d');

function startScanning() {
    document.getElementById("animatedline").style.animation = "scan 3s infinite";
    var video = document.getElementById('video');
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } }).then(function (stream) {
            video.srcObject = stream;
            video.onloadedmetadata = function (e) {
                scan();
            };
        }).catch(function (error) {
            console.error('getUserMedia error:', error);
        });
    } else {
        console.error('getUserMedia is not supported');
    }
}
function scan() {
    var video = document.getElementById('video');
    canvasElement.width = video.videoWidth;
    canvasElement.height = video.videoHeight;
    canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
    var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
    var code = jsQR(imageData.data, imageData.width, imageData.height);
    if (code && code.data.length <= 4 && code.data.match(/\d{1,4}$/)){
        let token = code.data;
        console.log(token);
        window.location.href = "../pages/filament.php?id="+encodeURIComponent(token);
    }
    if (!isCoolingDown) {
        isCoolingDown = true;
        setTimeout(function () {
            isCoolingDown = false;
            scan();
        }, 1000);
    } else {
        requestAnimationFrame(scan);
    }
}