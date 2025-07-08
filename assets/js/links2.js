document.querySelectorAll(".filament").forEach(item => {
    item.addEventListener("click", function() {
        const clickedElementId = this.id;
        if (clickedElementId != "filamentheading"){
            location.href = "filament.php?id=" + clickedElementId;
        }
    });
});