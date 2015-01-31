<?php
if($_POST['submit']!=null)
{
echo "the value is ".$_POST['rating'];
}
?>

<html>
<head>
<script type="text/javascript">
function cal(a)
{
document.getElementById("content").innerHTML=a.value;
}
</script>
</head>
<body>
<form action ="" method="post">
<input type="range" onclick="cal(this);" name="rating" min=1 max=50 value=40><span id="content"></span><br>
<input type="submit" name="submit">
</form>
</body>
</html>
