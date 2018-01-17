<?php
  $boolean = isset($_COOKIE['name']);
  if($boolean){
    $name = $_COOKIE['name'];
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
                  <a class="mdl-navigation__link" href="anke.html">アンケート</a>
                  <a class="mdl-navigation__link" href="map.html">アクセス</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer mdl-layout--small-screen-only">
            <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
              <a class="mdl-navigation__link" href="index.html">メニュー</a>
              <a class="mdl-navigation__link" href="twitter.html">ツイッター</a>
              <a class="mdl-navigation__link is-active" href="view.php">掲示板</a>
              <a class="mdl-navigation__link" href="anke.html">アンケート</a>
              <a class="mdl-navigation__link" href="map.html">アクセス</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
					<div class="mdl-grid musouya-max-width musouya-contact">
							<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
									<div class="mdl-card__title">
											<h2 class="mdl-card__title-text">掲示板</h2>
									</div>
									<div class="mdl-card__media">
											<img class="article-image" src=" img/view.png" border="0" alt="">
									</div>
									<div class="mdl-card__supporting-text">
                      <?php if($boolean):?>
  											<form method="POST" action="./post.php">
                          <p>
                            ようこそ <?php echo $name?> さん
                          </p>
													<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
														<input class="mdl-textfield__input" type="text" name="name" readonly="readonly" value=<?php echo $name?>　>
														<label class="mdl-textfield__label" for="Name">名前</label>
													</div>
													<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
														<textarea class="mdl-textfield__input" name="content" rows="5" cols="40" required></textarea>
														<label class="mdl-textfield__label" for="note">投稿内容</label>
													</div>
													<p>
														<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-color--cyan" type="submit">
																投稿
														</button>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="location.href='logout.php'">
                              ログアウト
                            </button>
													</p>
  											</form>
                      <?php else:?>
                        <p>
                          投稿するにはログインしてください．
                        </p>
                        <p>
                          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-color--cyan" onclick="location.href='login.html'">
                            ログイン
                          </button>
                          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="location.href='regist.html'">
                            新規登録
                          </button>
                        </p>
                      <?php endif;?>
											<p>
												<?php

													if(is_file("./log.csv")) {//ログファイルが存在するか
														if(is_readable("./log.csv")){
															$fp = fopen("./log.csv", "r");
															flock($fp, LOCK_SH);
															$count = 0;

															//中身抽出
															while(!feof($fp)) {
																$line = fgets($fp);
																$record_all[$count] = $line;
																$count++;
																//エラーキャッチ
															}
															while($count>0){
																$content = explode(",", $record_all[$count-1]);
																if(count($content)==3){
																	echo "<p>".($count);
																	echo ":<strong>名前:$content[0]</strong>";
																	echo "投稿日時:<time>$content[1]</time><br>$content[2]</p>\n";
																	echo "<hr>";
																}
																$count--;
															}

															//ログファイルを閉じる
															flock($fp, LOCK_UN);
															fclose($fp);
														} else {
															echo "ファイルが開けません";
														}
													} else {
														echo "誰も投稿していません";
													}

												?>
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
                      <li><a href="anke.html">アンケート</a></li>
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
