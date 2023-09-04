<html>
<head>
<link href="//vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/7.10.2/video.min.js"></script>

<title>Teste PHP</title>

</head>
<body>

<?php

// Ler o arquivo M3U
$playlist_url = 'https://drive.google.com/u/0/uc?id=1BHjArrdABd4d5AHscqtxPt6xi5ksQEq-&export=download';
$m3u_file = file_get_contents($playlist_url);
// $m3u_file = file_get_contents('https://drive.google.com/u/0/uc?id=1BHjArrdABd4d5AHscqtxPt6xi5ksQEq-&export=download');

// Extrair as informações
$regex = '/#EXTINF:(.*),(.*)\n(.*)/';
preg_match_all($regex, $m3u_file, $matches, PREG_SET_ORDER);
$channels = array();
foreach ($matches as $match) {
    $channels[] = array(
        'name' => trim($match[2]),
        'url' => trim($match[3]),
        
    );
}


// Criar a interface do usuário
echo '<ul>';
foreach ($channels as $channel) {
    echo '<li><a href="' . $channel['url'] . '">' . $channel['name']  . '</a></li>';
}
echo '</ul>';

// Reproduzir o stream
if (isset($_GET['url'])) {
    echo '<video src="' . $_GET['url'] . '" autoplay controls></video>';
    
}

?>

<script>
  var player = videojs('iptv-player');
  player.src({
    src: '<?php echo $playlist_url; ?>',
    type: 'application/x-mpegURL'
  });
  player.play();
</script>

<video id="iptv-player" class="video-js vjs-default-skin" controls preload="auto" width="640" height="360">
  <source src="https://drive.google.com/u/0/uc?id=1BHjArrdABd4d5AHscqtxPt6xi5ksQEq-&export=download" type="application/x-mpegURL">
</video>

</body>
</html>
