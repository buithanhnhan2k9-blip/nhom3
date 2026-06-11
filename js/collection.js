/* =========================
   LOGOUT POPUP
========================= */

function openLogoutPopup(){

    document
    .getElementById("logoutPopup")
    .style.display = "flex";

}

function closeLogoutPopup(){

    document
    .getElementById("logoutPopup")
    .style.display = "none";

}

/* =========================
   CLICK NGOÀI ĐỂ ĐÓNG
========================= */

window.onclick = function(e){

    let popup =
    document.getElementById(
    "logoutPopup"
    );

    if(e.target == popup){

        popup.style.display = "none";

    }

}