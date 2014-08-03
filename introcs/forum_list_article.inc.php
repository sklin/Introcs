                  				<?PHP
                  				$forum_board_id = $_GET['forum_board_id'];
                  				
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				$Query_forum_board = mysql_query("Select `forum_group_id`, `forum_board_title`, `forum_board_manager` 
                  					From `forum_board_Tab` Where `forum_board_id` = '$forum_board_id';");
                  				$Data_forum_board = mysql_fetch_array($Query_forum_board);
                  				                  				
                  				if (strlen($Data_forum_board['forum_board_title']) <= 0){
                  					
                  					closeDB($link_INTRO_DB);														// 關閉資料庫連結
                  					showalert("很抱歉，查無此看版！");
                  					gotourl("?func=forum");
                  					
                  				}
                  				
                  				$feedback_is_bm = is_bm($Data_forum_board['forum_board_manager']);				// 檢查是否為版主
                  				
                  				if (!isset($_GET['forum_subject_id'])){	$forum_subject_id = 0;	} else {	$forum_subject_id = $_GET['forum_subject_id'];	}
                  				
                  				// 讀取看版主題，開始。
                  				if ($forum_subject_id > 0){
                  					
                  					if ($feedback_is_bm == "Y"){
                  						
                  						$Query_forum_subject = mysql_query("Select `forum_subject_title` From `forum_subject_Tab` 
                  							Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id';");
                  						
                  						
                  					} else {
                  						
                  						$Query_forum_subject = mysql_query("Select `forum_subject_title` From `forum_subject_Tab` 
                  							Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id' and `forum_on_line_status` = 'Y';");
                  						
                  					}
                  					
                  					$Data_forum_subject = mysql_fetch_array($Query_forum_subject);
                  					
                  					if (strlen($Data_forum_subject['forum_subject_title']) <= 0){
                  						
                  						closeDB($link_INTRO_DB);													// 關閉資料庫連結
                  						showalert("很抱歉，無此看版主題！");
                  						gotourl("?func=forum_list_article&forum_board_id=".$forum_board_id);
                  						
                  					}
                  					
                  				}
                  				// 讀取看版主題，結束。
                  				?>
                  				<!-- 計概討論區 -- 看版文章列表，開始。 -->
                  				<br>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td width="7" height="57" background="img/bg_title_bar01.gif">&nbsp;</td>
                  						<td width="40" align="center" background="img/bg_title_bar02.gif"><img src="img/bg_title_bar04.gif" width="26" height="26"></td>
                  						<td background="img/bg_title_bar02.gif" class="tfont_1">計概討論區</td>
                  						<td width="9" background="img/bg_title_bar03.gif">&nbsp;</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<?PHP
                  				$Query_forum_group = mysql_query("Select `forum_group_title` From `forum_group_Tab` Where `forum_group_id` = '$Data_forum_board[forum_group_id]';");
                  				$Data_forum_group = mysql_fetch_array($Query_forum_group);
                  				?>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 
                  							<a href="?func=forum"><font color="#0000FF"><?PHP	echo $Data_forum_group['forum_group_title'];	?></font></a> /
                  							<?PHP
                  							if ($forum_subject_id > 0){
                  								
                  								
                  								echo "<a href=\"?func=forum_list_article&forum_board_id=".$forum_board_id."\"><font color=\"#0000FF\">".$Data_forum_board['forum_board_title']."</font></a>";
                  								echo " / ".$Data_forum_subject['forum_subject_title'];
                  								
                  							} else {
                  								
                  								echo $Data_forum_board['forum_board_title'];
                  								
                  							}
                  							?>
                  						</td>
                  					<tr>
                  					<!-- 發表主題、文章，開始。 -->
                  					<tr>
                  						<td align="right">
                  							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  								<tr>
                  									<td class="lfont_1" height="40">
                  										<?PHP
                  										if (($forum_subject_id == 0) and ($feedback_is_bm == "Y")){
                  											
                  											echo "<a href=\"?func=forum_subject_add&forum_board_id=".$forum_board_id."\">新增主題</a>";
                  											
                  										}
                  										?>
                  									</td>
                  									<td class="lfont_1" width="80" align="right"><?PHP	if (isset($_SESSION['user_email'])){	echo "<a href=\"?func=forum_article_add&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."\">發表文章</a>";	}	?></td>
                  								</tr>
                  							</table>
                  						</td>
                  					</tr>
                  					<!-- 發表主題、文章，結束。 -->
                  					<?PHP
                  					if ($forum_subject_id == 0){
                  						
                  						// 沒有指定主題則列出所有主題，開始。
                  						if ($feedback_is_bm == "Y"){
                  							
                  							$Query_forum_subject = mysql_query("Select `forum_subject_id`, `forum_subject_title` From `forum_subject_Tab` 
                  								Where `forum_board_id` = '$forum_board_id' Order by `forum_subject_id` DESC;");
                  							
                  						} else {
                  							
                  							$Query_forum_subject = mysql_query("Select `forum_subject_id`, `forum_subject_title` From `forum_subject_Tab` 
                  								Where `forum_board_id` = '$forum_board_id' and `forum_on_line_status` = 'Y' Order by `forum_subject_id` DESC;");
                  							
                  						}
                  						$Rows_forum_subject = mysql_num_rows($Query_forum_subject);
                  						
                  						if ($Rows_forum_subject > 0){
                  					?>
                  					<!-- 主題列表，開始。 -->
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">主題列表</td>
                  									<?PHP
                  									if ($feedback_is_bm == "Y"){
                  									?>
                  									<td bgcolor="#95ACEC" class="cfont_1" width="40" align="center"><font color="#FFFFFF">設定</td>
                  									<td bgcolor="#95ACEC" class="cfont_1" width="40" align="center"><font color="#FFFFFF">刪除</td>
                  									<?PHP
                  									}
                  									?>
                  								</tr>
                  								<?PHP
                  									for ($i = 0; $i < $Rows_forum_subject; $i++){
                  										
                  										$Data_forum_subject = mysql_fetch_array($Query_forum_subject);
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"?func=forum_list_article&forum_board_id=".$forum_board_id."&forum_subject_id=".$Data_forum_subject['forum_subject_id']."\">".$Data_forum_subject['forum_subject_title']."</a>";	?></td>
                  									<?PHP
                  										if ($feedback_is_bm == "Y"){
                  									?>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>" align="center"><?PHP	echo "<a href=\"?func=forum_subject_modify&forum_board_id=".$forum_board_id."&forum_subject_id=".$Data_forum_subject['forum_subject_id']."\">修改</a>";	?></td>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>" align="center"><?PHP	echo "<a href=\"?func=forum_subject_del&forum_board_id=".$forum_board_id."&forum_subject_id=".$Data_forum_subject['forum_subject_id']."\" onClick=\"return confirm('您將刪除這個看版主題及其所有文章，確定嗎？')\">刪除</a>";	?></td>
                  									<?PHP
                  										}
                  									?>
                  								</tr>
                  								<?PHP
                  									}
                  								?>
                  							</table><br><br>
                  						</td>
                  					</tr>
                  					<!-- 主題列表，結束。 -->
                  					<?PHP 
                  						}
                  						
                  					}
                  					// 沒有指定主題則列出所有主題，結束。
                  					?>
                  					<tr>
                  						<td align="right" class="cfont_1">
                  							<?PHP
                  							if ($feedback_is_bm == "Y"){
                  								
                  								$Query_forum_article = mysql_query("Select `forum_article_id`, `forum_reply_id`, `forum_article_title`, 
                  									`forum_article_time`, `forum_poster_email`, `forum_on_line_status` From `forum_article_Tab` Where `forum_board_id` = '$forum_board_id' 
                  									and `forum_subject_id` = '$forum_subject_id' Order by `forum_article_time` DESC;");
                  								
                  							} else {
                  								
                  								$Query_forum_article = mysql_query("Select `forum_article_id`, `forum_reply_id`, `forum_article_title`, 
                  									`forum_article_time`, `forum_poster_email` From `forum_article_Tab` Where `forum_board_id` = '$forum_board_id' 
                  									and `forum_subject_id` = '$forum_subject_id' and `forum_on_line_status` = 'Y' Order by `forum_article_time` DESC;");
                  								
                  							}
                  							$Rows_forum_article = mysql_num_rows($Query_forum_article);
                  							
                  							$num_data = 20;
                  							$num_zone = 1;
                  							$num_each_zone = 20;
                  							$page_list_url = "?func=forum_list_article&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id;
                  							
                  							if (!isset($_GET['page'])){	$_GET['page'] = 1;	}
                  							$feedback_pages_list = pages_list($_GET['page'], $Rows_forum_article, $num_data, $num_zone, $num_each_zone, $page_list_url);
                  							?>
                  						</td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">文章標題</td>
                  									<td bgcolor="#95ACEC" class="cfont_1" width="100" align="center"><font color="#FFFFFF">作　　者</td>
                  									<td bgcolor="#95ACEC" class="cfont_1" width="80" align="center"><font color="#FFFFFF">時　　間</td>
                  								</tr>
                  								<?PHP
                  									for ($i = $feedback_pages_list['num_from'][1]; $i <= $feedback_pages_list['num_end'][1]; $i++){
                  										
                  										mysql_data_seek($Query_forum_article, $i);
                  										$Data_forum_article = mysql_fetch_array($Query_forum_article);
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"?func=forum_article_content&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."&forum_article_id=".$Data_forum_article['forum_article_id']."&forum_reply_id=".$Data_forum_article['forum_reply_id']."#".$Data_forum_article['forum_reply_id']."\">".$Data_forum_article['forum_article_title']."</a>";	?></td>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>" align="center">
                  										<?PHP
                  										$forum_article_poster = explode("@", $Data_forum_article['forum_poster_email']);
                  										echo $forum_article_poster[0];
                  										?>
                  									</td>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>" align="center">
                  										<?PHP
                  										$forum_article_time = getdate($Data_forum_article['forum_article_time']);
                  										echo $forum_article_time['year']."-".$forum_article_time['mon']."-".$forum_article_time['mday'];
                  										?>
                  									</td>
                  								</tr>
                  								<?PHP
                  									}
                  								?>
                  							</table>
                  						</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<!-- 計概討論區 -- 看版文章列表，結束。 -->