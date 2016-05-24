var i = 3;
var intervalid;
intervalid = setInterval("fun()", 1000);
function fun() {
    if (i == 0) {
        //window.location.href = "father_module.php";
        clearInterval(intervalid);
    }
    document.getElementById("mes").innerHTML = i;
    i--;
}