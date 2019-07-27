<?php
include 'koneksi.php';

if ($_POST) {
    $urlpanjang = $_POST["inputkuy"];
    $pos = strrpos($urlpanjang,'=');
    $url = $pos === false ? $urlpanjang : substr($urlpanjang,$pos + 1);

    $ytkey = "AIzaSyCetx4gWkF-XSCHaIfh8EkPB3rNm3c5ljs";
    $nextPage = " ";

        $str = file_get_contents("https://www.googleapis.com/youtube/v3/commentThreads?key=" . "$ytkey" . "&textFormat=plainText&part=snippet&videoId=" . "$url" . "&maxResults=100&nextPagetoken=" . "$nextPage");

        $json = json_decode($str, true);

        foreach ($json['items'] as $val) {
            $author = $val['snippet']['topLevelComment']['snippet']['authorDisplayName'];
            $comment = $val['snippet']['topLevelComment']['snippet']['textDisplay'];
            $time_publish = $val['snippet']['topLevelComment']['snippet']['publishedAt'];

        $link = mysqli_connect("localhost","root","","db_yutub");
        $sql = "INSERT INTO livedata_komentar (nama_user, komentar, timepublish) VALUES ('$author', '$comment', '$time_publish')";
        mysqli_query($link, $sql);
        }
    }
header("location:index.php");
?>