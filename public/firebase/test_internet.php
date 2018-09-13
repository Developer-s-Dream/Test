

<!DOCTYPE html>
<html>
<body>

<div id="demo"></div>
<script>
    function status()
    {
        if(navigator.onLine)
        {
            alert("Browser is online");
        }
        else
        {
            alert("Browser is offline");
        }
    }
</script>
<button onclick="status();">Check connectivity status</button>

<script>
var txt = "";
txt += "<p>Browser CodeName: " + navigator.appCodeName + "</p>";
txt += "<p>Browser Name: " + navigator.appName + "</p>";
txt += "<p>Browser Version: " + navigator.appVersion + "</p>";
txt += "<p>Cookies Enabled: " + navigator.cookieEnabled + "</p>";
txt += "<p>Browser Language: " + navigator.language + "</p>";
txt += "<p>Browser Online: " + navigator.onLine + "</p>";
txt += "<p>Platform: " + navigator.platform + "</p>";
txt += "<p>User-agent header: " + navigator.userAgent + "</p>";

document.getElementById("demo").innerHTML = txt;
</script>

</body>
</html>
