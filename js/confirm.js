var i = 3;
var intervalid;
intervalid = setInterval("fun()", 1000);
function fun() {
    document.getElementById("mes").innerHTML = i;
    i--;
    if (i == 0) {
        //window.location.href = "index.php";
        clearInterval(intervalid);
    }
}