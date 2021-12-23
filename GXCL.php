<?php
/*
    MADE BY MEOW
    GITHUB: meowcop
    FB: 100039847550995
    CONTACT: HoangGiap.Contact@gmail.com
    DON'T DELETE. RESPECT THE AUTHOR.
*/
header('Content-Type: application/json');
$limit = 50;
$api_key = ""; // Chèn mã API ở đây (OAuth Consumer Key)
$blog = "gaixinhchonloc"; // id blog

$url = "https://api.tumblr.com/v2/blog/$blog/posts/photo/?api_key=$api_key&limit=$limit&offset=".rand(0,950);

$tumblr = json_decode(file_get_contents($url,true));
$json = array(); $i = 0;
while($i <= $limit){
        array_push($json,$tumblr->response->posts[$i]->photos[0]->original_size->url);
        $i = $i+1;
    }
    echo json_encode(array(
        "photo"=>$json,
        'Data'=> $tumblr->response->blog->title,
        'Made by'=>'MeoCop'),true);
?>