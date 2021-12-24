<?php
/*
    MADE BY MEOW
    GITHUB: meowcop
    FB: 100039847550995
    CONTACT: HoangGiap.Contact@gmail.com
    DON'T DELETE. RESPECT THE AUTHOR.
*/
header('Content-Type: application/json');
if (isset($_GET['url'])){
    $url = $_GET['url'];
    $tach = explode("/", $url);
    
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "Accept-language: en\r\n" .
                "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 Edg/96.0.1054.62\r\n"
        ]
    ];

    $context = stream_context_create($opts);
    $file = json_decode(file_get_contents("https://www.tiktok.com/node/share/video/".$tach[3]."/".$tach[5], true, $context));
    
    if ($file->statusCode != null){
            $json = array(
                "statusCode" => $file->statusCode,
                "statusMsg" => $file->statusMsg);
            echo(json_encode($json)); 
        } else {
            $json = array(
                    "title" => $file->seoProps->metaParams->title,
                    "ID" => "@".$file->itemInfo->itemStruct->author->uniqueId,
                    "Video" => $file->itemInfo->itemStruct->video->downloadAddr,
                    "Audio" => $file->itemInfo->itemStruct->music->playUrl,
                    "Link" => $file->seoProps->metaParams->canonicalHref,
                    "stats" => array(
                        "diggCount" => $file->itemInfo->itemStruct->stats->diggCount,
                        "shareCount" => $file->itemInfo->itemStruct->stats->shareCount,
                        "commentCount" => $file->itemInfo->itemStruct->stats->commentCount,
                        "playCount" => $file->itemInfo->itemStruct->stats->playCount),
                    "status" => "OK"
                );
            echo(json_encode($json));
        }
    } else {
        echo(json_encode(array("status" => "Error","msg"=>"Missing URL")));
    }
?>