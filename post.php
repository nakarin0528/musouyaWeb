<?php
	if(isset($_POST["name"]) || isset($_POST["content"])){
		//受け取った内容を保存
		if(strlen($_POST["name"])!=0){
			$name = htmlspecialchars($_POST["name"]);
		} else {
			$name = "no name";
		}
		date_default_timezone_set("Asia/Tokyo");
		$time = date("Y/m/j H:i:s");
		$content = htmlspecialchars($_POST["content"]);
		$content = preg_replace("/(\r\n|\n|\r)/", "<br>", $content);
		$content = str_replace(",", "，", $content);

		//open the log
		$fp = fopen("./log.csv", "a");
		flock($fp, LOCK_EX);

		$line = $name.",".$time.",".$content."\n";
		fputs($fp, $line);

		//close the log
		flock($fp, LOCK_UN);
		fclose($fp);
	}
?>

<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A musouya template that uses Material Design Lite.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>らーめん 夢走家</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.grey-pink.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
      // setTimeout("location.reload()",5000);
    </script>
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header mdl-layout__header--waterfall musouya-header">
            <div class="mdl-layout__header-row musouya-logo-row">
                <span class="mdl-layout__title">
                    <div class="musouya-logo"></div>
                    <span class="mdl-layout__title">らーめん 夢走家</span>
                </span>
            </div>
            <div class="mdl-layout__header-row musouya-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                  <a class="mdl-navigation__link" href="index.html">メニュー</a>
                  <a class="mdl-navigation__link" href="twitter.html">ツイッター</a>
                  <a class="mdl-navigation__link is-active" href="view.php">掲示板</a>
                  <a class="mdl-navigation__link" href="contact.html">アンケート</a>
                  <a class="mdl-navigation__link" href="map.html">アクセス</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer mdl-layout--small-screen-only">
            <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
              <a class="mdl-navigation__link" href="index.html">メニュー</a>
              <a class="mdl-navigation__link" href="twitter.html">ツイッター</a>
              <a class="mdl-navigation__link is-active" href="view.php">掲示板</a>
              <a class="mdl-navigation__link" href="contact.html">アンケート</a>
              <a class="mdl-navigation__link" href="map.html">アクセス</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
					<div class="mdl-grid musouya-max-width musouya-contact">
							<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
									<div class="mdl-card__title">
											<h2 class="mdl-card__title-text">投稿内容</h2>
									</div>
									<div class="mdl-card__media">
											<img class="article-image" src=" images/contact-image.jpg" border="0" alt="">
									</div>
									<div class="mdl-card__supporting-text">
											<p>
                        <?php
	                       if(isset($_POST["name"]) || isset($_POST["content"])){
		                         //ログファイルの中身抽出
		                         echo "<p><b>名前: ".$name."</b>　投稿日時: <time>".$time."</time><br>".$content."</p>";
	                       } else {
		                         echo "不正な投稿";
	                       }
                        ?>
											</p>
                      <p>
			                  <a href="./view.php" target="_self">掲示板に戻る</a><br>
			                  <a href="./index.html" target="_self">トップに戻る</a>
		                  </p>
									</div>
							</div>
					</div>
            <footer class="mdl-mini-footer">
                <div class="mdl-mini-footer__left-section">
                  <div class="mdl-logo">
                    らーめん 夢走家
                    <small>　&copy; copyright 2017 nakarin</small>
                  </div>
                </div>
                <div class="mdl-mini-footer__right-section">
                    <ul class="mdl-mini-footer__link-list">
                      <li><a href="index.html">メニュー</a></li>
                      <li><a href="twitter.html">ツイッター</a></li>
                      <li><a href="view.php">掲示板</a></li>
                      <li><a href="contact.html">アンケート</a></li>
                      <li><a href="map.html">アクセス</a></li>
                    </ul>
                </div>
								<div class="like-box">
                  <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F%25E5%25A4%25A2%25E8%25B5%25B0%25E5%25AE%25B6%2F420467224788324%3Ffref%3Dts&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                </div>
                <div class="follow-box">
                  <a href="https://twitter.com/chofumusouya" class="twitter-follow-button" data-show-count="false">Follow @chofumusouya</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
            </footer>
        </main>
    </div>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>

</html>
