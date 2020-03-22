<?php

if(file_exists("bingDaily.jpg"))
{
    $time = time();
    //文件修改时间和现在时间相差 24 小时以下的话，直接导向静态文件 jpg，否则重新生成 jpg
    if($time - filemtime("bingDaily.jpg") < 24*60*60 )
    {
        header("Location:/bingDaily.jpg");
      	exit();
    }
}
$str=file_get_contents('https://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');
if (preg_match("/<url>(.+?)<\/url>/is", $str, $matches)) 
{
$imgurl='https://cn.bing.com'.$matches[1];
}
ob_end_clean();
ob_start();
header('Content-Type: image/JPEG');
@readfile($imgurl);
$temp =  ob_get_contents();
@ob_flush();
$fp = fopen("bingDaily.jpg",'w');
fwrite($fp,$temp) or die('写文件错误');
header("Location:/bingDaily.jpg");
exit();
?>
