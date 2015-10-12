<?php
$size = getimagesize("testimg.jpg", $info);
if (isset($info["APP13"])) {
    $iptc = iptcparse($info["APP13"]);
    var_dump($iptc);
}
?>

<?php
var_dump(gd_info());
?>