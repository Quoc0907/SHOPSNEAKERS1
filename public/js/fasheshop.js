document.getElementById("btnSearch").onclick = function () {
    let search = document.getElementsByName("search-product")[0].value;
    window.location.href = "?search=" + search;
}