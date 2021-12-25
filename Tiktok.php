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
    $t = explode("/", $url);
    
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "Accept-language: en\r\n" .
                "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 Edg/96.0.1054.62\r\n"
        ]
    ];
    if ($t[3] == null or $t[5] == null){
       echo(json_encode(array("status" => "Error","msg"=>"Missing URL")));
    } else {
        $context = stream_context_create($opts);
        $file = json_decode(file_get_contents("https://www.tiktok.com/node/share/video/".$t[3]."/".$t[5], true, $context));
        
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
        }
    }
    
/*
$error_codes = array(
                "0" => "OK",
                "450" => "CLIENT_PAGE_ERROR",
                "10000" => "VERIFY_CODE",
                "10101" => "SERVER_ERROR_NOT_500",
                "10102" => "USER_NOT_LOGIN",
                "10111" => "NET_ERROR",
                "10113" => "SHARK_SLIDE",
                "10114" => "SHARK_BLOCK",
                "10119" => "LIVE_NEED_LOGIN",
                "10202" => "USER_NOT_EXIST",
                "10203" => "MUSIC_NOT_EXIST",
                "10204" => "VIDEO_NOT_EXIST",
                "10205" => "HASHTAG_NOT_EXIST",
                "10208" => "EFFECT_NOT_EXIST",
                "10209" => "HASHTAG_BLACK_LIST",
                "10210" => "LIVE_NOT_EXIST",
                "10211" => "HASHTAG_SENSITIVITY_WORD",
                "10212" => "HASHTAG_UNSHELVE",
                "10213" => "VIDEO_LOW_AGE_M",
                "10214" => "VIDEO_LOW_AGE_T",
                "10215" => "VIDEO_ABNORMAL",
                "10216" => "VIDEO_PRIVATE_BY_USER",
                "10217" => "VIDEO_FIRST_REVIEW_UNSHELVE",
                "10218" => "MUSIC_UNSHELVE",
                "10219" => "MUSIC_NO_COPYRIGHT",
                "10220" => "VIDEO_UNSHELVE_BY_MUSIC",
                "10221" => "USER_BAN",
                "10222" => "USER_PRIVATE",
                "10223" => "USER_FTC",
                "10224" => "GAME_NOT_EXIST",
                "10225" => "USER_UNIQUE_SENSITIVITY",
                "10227" => "VIDEO_NEED_RECHECK",
                "10228" => "VIDEO_RISK",
                "10229" => "VIDEO_R_MASK",
                "10230" => "VIDEO_RISK_MASK",
                "10231" => "VIDEO_GEOFENCE_BLOCK",
                "10404" => "FYP_VIDEO_LIST_LIMIT",
                "undefined" => "MEDIA_ERROR"); */
?>
