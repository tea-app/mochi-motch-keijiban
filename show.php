<?php
require_once('function/DataBaseMethod.php');
require_once('function/EnvReader.php');

ini_set( 'display_errors', 1 );

$env_params = EnvReader::getParams('.env');

$dbm = new DataBaseMethod($env_params['HOSTNAME'], $env_params['DATABASE_NAME'], $env_params['USER'], $env_params['PASSWORD'], $env_params['TABLE_NAME']);

$data = $dbm->show();
// foreach ($data as $i => $record) {
//     echo "<pre>";
//     echo $i . "\n";
//     echo $record['created_at'] . "\n";
//     echo $record['name'] . "\n";
//     echo $record['content'] . "\n";
//     echo "</pre>";
// }
?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Suggestion1</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <div class="header">
        <div class="header-logo">
            <img src="assets/img/moti_logo.png" alt="logo" height="200px">
        </div>
    </div>
    <div class="space"></div>
    
    
    <div class="contents">
        <div class="thread" >
            <div class="contribute">
                <h1 class="thread-title">もちもっち</h1>
            </div>
            <?php foreach ($data as $i => $record) : ?>
                <div class="contributer">
                    <div><?php echo $i + 1 . ':  <span class="contributer-name">' . $record['name'] . '</span>';?>  <span class="contribute-date"><?php echo $record['created_at']; ?></span></div>
                    <!-- <h4 class="contribute-date"><?php echo $record['created_at']; ?></h4> -->
                    <div class="contributer-message"><pre><?php echo $record['content']; ?></pre></div>
                    <form class="delete" action="function/keijiban.php" method="post">
                        <input type="hidden" name="function" value="delete">
                        <input type="hidden" name="id" value="<?php echo $i + 1; ?>">
                        <input type="submit" value="削除">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="space"></div>
    
    <div class="menu">
    </div>
    <div class="post-area">
        <div class="post-box">
            <form class="post-form" action="function/keijiban.php" method="post">
                <input type="hidden" name="function" value="insert">
                <input type="text" name="name" value="" maxlength="15" placeholder="ユーザーネームを入力">
                <textarea name="content" rows="8" cols="80" maxlength="200" placeholder="内容を入力"></textarea>
                <input type="submit" value="送信">
            </form>
        </div>
    </div>
</body>
</html>