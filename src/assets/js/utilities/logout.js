import Cookies from "js-cookie";
const logoutBtn=$('#logout_btn');
logoutBtn.on("click",function (e) {
    Cookies.remove("token");
})