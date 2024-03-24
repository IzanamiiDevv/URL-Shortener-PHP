<?php
if(isset($_POST["submit"])){
  $url = $_POST["inpt"];
require ('data.php');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://hyperhost.ua/tools/pushData');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
"Host: hyperhost.ua",
"x-csrf-token: xicfslpqR90Pc314IgY7drLw9CtN1tQuGVbcKb3k",
"user-agent: Mozilla/5.0 (Linux; Android 8.1.0; CPH1909 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/117.0.0.0 Mobile Safari/537.36",
"content-type: application/x-www-form-urlencoded; charset=UTF-8",
"cookie: ".$cookie."",));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, '_token=xicfslpqR90Pc314IgY7drLw9CtN1tQuGVbcKb3k&url='.$url.'');
curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$result = curl_exec($ch);

$link = explode('"', explode('{"success":"', $result)[1])[0];
$fixed_link = str_replace("\/", "/", $link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Free Shortener</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 id="heading">Free Url Shortener</h2>
    <form method="post">
      <span>Enter Url:</span>
    <input style="text" placeholder="enter url" name="inpt" id="inpt"/><br>
    <button name="submit">Submit</button>
    <button onclick="document.getElementById('inpt').value=''">Clear</button>
    </form>
    <div id="input-result">
      Copy Result
    </div>
    <script>
        document.getElementById("input-result").innerHTML = "<?php echo $fixed_link; ?>";
      </script>
</body>
<footer>copyright &copy Cervantes</footer>
</html>