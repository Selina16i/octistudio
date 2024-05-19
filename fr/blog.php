<?php 
<html>
<!DOCTYPE html>
<html lang="fren">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html></html>
header('Content-Type: application/rss+xml')
$bdd = new PDO('','root', '');
$articles = $bdd->query('SELECT * FROM articles ORDER BY date_time_post DESC LIMIT 0,25');

$lastBuildDate = $bdd->query('SELECT date_time_post FROM articles ORDER BY date_time_post DESC LIMIT 0,1');
$lastBuildDate = $lastBuildDate->fetch ()['date_time_post'];
?>
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Mon site</title>
        <description>Ceci est un exemple de flux RSS 2.0</description>
        <lastBuildDate> <?= date(DATE_RSS, strtotime($lastBuildDate)) ?></lastBuildDate>
        <link>http://www.example.org</link>
        <?php while ($a = $articles->fetch ()){ ?>
        <item>
            <title><?= $a ['titre'] ?></title>
            <description><?= $a ['contenu'] ?></description>
            <pubDate><?= date(DATE_RSS, strtotime($a['date_time_post'])) ?></pubDate>
            <link>http://www.example.org/?id=<?= $a['idArticle'] ?></link>
        <image>
            <url>http://www.example.org/miniatures/<?= $a['idArticle'] ?>.jpg</url>
            <link>http://www.example.org/?id=<?= $a['idArticle'] ?></link>
        </image>
        </item>
        <?php } ?>
    </channel>
</rss>