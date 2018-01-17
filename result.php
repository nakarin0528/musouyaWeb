<?php
	//ファイル読み込み
	if(is_readable("./result.csv") && $fp=fopen("./result.csv", "r")){
		flock($fp, LOCK_SH);

		$flag = true;

		/*集計用*/
		//data1
		$cnt1["tk"]=0;
		$cnt1["gk"]=0;
		$cnt1["ms"]=0;
		$cnt1["sy"]=0;
		$cnt1["so"]=0;
		$cnt1["jr"]=0;
		//data2
		$cnt2["st"]=0;
		$cnt2["td"]=0;
		//data3
		$cnt3["LL"]=0;
		$cnt3["L"]=0;
		$cnt3["M"]=0;
		$cnt3["S"]=0;
		$cnt3["SS"]=0;
		//data4
		$shops=array();

		while ($csvline = fgets($fp)) {
			$data = explode(",", trim($csvline, "\n"));
			if (count($data)==5) {
				$taste = (string)$data[1];
				if (isset($cnt1[$taste])) {
					$cnt1[$taste]++;
				}
				$noodles = (string)$data[2];
				if (isset($cnt2[$noodles])) {
					$cnt2[$noodles]++;
				}
				$size = (string)$data[3];
				if (isset($cnt3[$size])) {
					$cnt3[$size]++;
				}
				//一番初めの要素はそのままぶちこむ
				if ($flag){
					$shops[] = $data[4];
					$flag = false;
				} else {
					for ($i = 0; $i < count($shops); $i++) {
	    			$shop = $data[4];
	    			if (!in_array($shop, $shops)) {
	        	$shops[] = $shop;
	    			}
					}
				}
			}
		}



		flock($fp, LOCK_UN);
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
                  <a class="mdl-navigation__link" href="view.php">掲示板</a>
                  <a class="mdl-navigation__link is-active" href="anke.html">アンケート</a>
                  <a class="mdl-navigation__link" href="map.html">アクセス</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer mdl-layout--small-screen-only">
            <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
              <a class="mdl-navigation__link" href="index.html">メニュー</a>
              <a class="mdl-navigation__link" href="twitter.html">ツイッター</a>
              <a class="mdl-navigation__link" href="view.php">掲示板</a>
              <a class="mdl-navigation__link is-active" href="anke.html">アンケート</a>
              <a class="mdl-navigation__link" href="map.html">アクセス</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="mdl-grid musouya-max-width musouya-contact">
                <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">アンケート結果</h2>
                    </div>
                    <div class="mdl-card__media">
                        <img class="article-image" src=" img/contact-image.jpg" border="0" alt="">
                    </div>
                    <div class="mdl-card__supporting-text">
											<?php if (is_readable("./result.csv"))://ファイル読み込み可? ?>
												<h3 class="mdl-card__title-text">現時点でのアンケート結果です</h3>
													<p>
														<h4>好きなラーメンの種類，得票数[票]</h4>
														豚骨，<?php echo $cnt1["tk"]?><br>
														魚介，<?php echo $cnt1["gk"]?><br>
														味噌，<?php echo $cnt1["ms"]?><br>
														醤油，<?php echo $cnt1["sy"]?><br>
														塩，<?php echo $cnt1["so"]?><br>
														二郎系，<?php echo $cnt1["jr"]?><br>
													</p>
													<hr>
													<p>
														<h4>好きな麺の種類，得票数[票]</h4>
														ストレート麺，<?php echo $cnt2["st"]?><br>
														縮れ麺，<?php echo $cnt2["td"]?><br>
													</p>
													<hr>
													<p>
														<h4>好きな麺の太さ，得票数[票]</h4>
														極太麺，<?php echo $cnt3["LL"]?><br>
														太麺，<?php echo $cnt3["L"]?><br>
														中太麺，<?php echo $cnt3["M"]?><br>
														細麺，<?php echo $cnt3["S"]?><br>
														極細麺，<?php echo $cnt3["SS"]?>
													</p>
													<hr>
													<p>
														<h4>好きなラーメン屋として出た名前</h4>
														<?php
															for ($i=0; $i < count($shops); $i++) {
																echo $i+1 . ". " . $shops[$i]?><br>
														<?php
															}
														?>
													</p>
													<p>
														<a href="./anke.html" target="_self">アンケートフォームに戻る</a>
													</p>
												<?php else: ?>
													<p>csvファイルがありません．管理者に問い合わせてください@nakarinrin0528</p>
												<?php endif;?>
                    </div>
                </div>
            </div>
            <footer class="mdl-mini-footer">
                <div class="mdl-mini-footer__left-section">
                  <div class="mdl-logo">
                    らーめん 夢走家
                    <small>　&copy; copyright 2017 nakarin</small>
                  </div>
									<div class="like-box">
										<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F%25E5%25A4%25A2%25E8%25B5%25B0%25E5%25AE%25B6%2F420467224788324%3Ffref%3Dts&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
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
            </footer>
        </main>
    </div>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>

</html>
