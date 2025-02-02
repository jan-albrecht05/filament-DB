document.querySelectorAll(".filament").forEach(item => {
    item.addEventListener("click", function() {
        const clickedElementId = this.id;
        console.log("Clicked element ID:", clickedElementId);
        location.href = "pages/filament.php?id=" + clickedElementId;
        // You can add more logic here to handle the click event
    });
});