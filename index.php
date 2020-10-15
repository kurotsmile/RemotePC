<?php
header("Access-Control-Allow-Origin: *");
include "config.php";
include "database.php";
?>
<html>
<head>
<title>Trợ lý ảo Pc carrot</title>
<link rel="shortcut icon" href="<?php echo $url;?>/icon.ico"/>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
</head>
<body>
<div id="log">

</div>

<script type="text/javascript" language="javascript">
        function RunFile() {
		    WshShell = new ActiveXObject("WScript.Shell");
		    WshShell.Run("c:/windows/system32/notepad.exe", 1, false);
        }
</script>

<script type="text/javascript" language="javascript">
function show_log(){
    $.ajax({
        url: '<?php echo $url;?>/ajax.php',
        jsonp: "get_log",
        data: "function=get_log",
        dataType: 'jsonp',
    });
}

get_log = function (data) {
    if(data!=null){
        $("#log").html(data['type']+":"+data['value']);
        if(data['type']=='web'){
            window.open(data['val'],'_blank');
        }

        if(data['type']=='app'){
            //RunFile();
            alert("ss");
        }
    }else{
        $("#log").html("Dang cho lenh tiep theo...");
    }
};

setInterval(show_log, 1000);
RunFile();
</script>
<input type="button" value="Run Notepad" onclick="RunFile();"/>
</body>
</html>