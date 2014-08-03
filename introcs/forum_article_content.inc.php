                  				<?PHP
                  				$forum_board_id = $_GET['forum_board_id'];
                  				$forum_subject_id = $_GET['forum_subject_id'];
                  				$forum_article_id = $_GET['forum_article_id'];
                  				$forum_reply_id = $_GET['forum_reply_id'];
                  				
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				
                  				// 讀取該看版的名稱及版主資料，開始。
                  				$Query_forum_board = mysql_query("Select `forum_board_title`, `forum_board_manager`, `forum_group_id` 
                  					From `forum_board_Tab` Where `forum_board_id` = '$forum_board_id';");
                  				$Data_forum_board = mysql_fetch_array($Query_forum_board);
                  				
                  				if (strlen($Data_forum_board['forum_board_title']) <= 0){
                  					
                  					closeDB($link_INTRO_DB);														// 關閉資料庫連結
                  					showalert("很抱歉，查無此看版！");
                  					gotourl("?func=forum");
                  					
                  				}
                  				
                  				$feedback_is_bm = is_bm($Data_forum_board['forum_board_manager']);				// 檢查是否為版主
                  				// 讀取該看版的名稱及版主資料，結束。
                  				
                  				// 讀取該看版的群組名稱，開始。
                  				$Query_forum_group = mysql_query("Select `forum_group_title` From `forum_group_Tab` Where `forum_group_id` = '$Data_forum_board[forum_group_id]';");
                  				$Data_forum_group = mysql_fetch_array($Query_forum_group);
                  				// 讀取該看版的群組名稱，結束。
                  				                  				
                  				// 讀取看版主題，開始。
                  				if ($forum_subject_id > 0){
                  					
                  					if ($feedback_is_bm == "Y"){
                  						
                  						$SQL_forum_subject = "Select `forum_subject_title` From `forum_subject_Tab` 
                  							Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id';";
                  						
                  					} else {
                  						
                  						$SQL_forum_subject = "Select `forum_subject_title` From `forum_subject_Tab` 
                  							Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id' and `forum_on_line_status` = 'Y';";
                  						
                  					}
                  					
                  					$Query_forum_subject = mysql_query($SQL_forum_subject);
                  					$Data_forum_subject = mysql_fetch_array($Query_forum_subject);
                  					
                  				} else {
                  					
                  					$Data_forum_subject['forum_subject_title'] = "未分類主題";
                  					
                  				}
                  				// 讀取看版主題，結束。
                  				
                  				// 讀取看版文章，開始。
                  				if ($feedback_is_bm == "Y"){
                  					
                  					$SQL_forum_article = "Select `forum_article_title` From `forum_article_Tab` 
                  						Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id'
                  						and `forum_article_id` = '$forum_article_id' and `forum_reply_id` = '$forum_reply_id';";
                  					
                  				} else {
                  					
                  					$SQL_forum_article = "Select `forum_article_title` From `forum_article_Tab` 
                  						Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id'
                  						and `forum_article_id` = '$forum_article_id' and `forum_reply_id` = '$forum_reply_id' and `forum_on_line_status` = 'Y';";
                  					
                  				}
                  				
                  				$Query_forum_article = mysql_query($SQL_forum_article);
                  				$Data_forum_article = mysql_fetch_array($Query_forum_article);
                  				
                  				if ((strlen($Data_forum_subject['forum_subject_title']) <= 0) and (strlen($Data_forum_article['forum_article_title']) <= 0)){
                  					
                  					closeDB($link_INTRO_DB);														// 關閉資料庫連結
                  					showalert("很抱歉，無該篇文章！");
                  					gotourl("?func=forum_list_article&forum_board_id=".$forum_board_id);
                  					
                  				}
                  				// 讀取看版文章，結束。
                  				?>
                  				<!-- 計概討論區 -- 看版文章內容，開始。 -->
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
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 
                  							<?PHP
                  							echo "<a href=\"?func=forum\"><font color=\"#0000FF\">".$Data_forum_group['forum_group_title']."</font></a> / ";
                  							echo "<a href=\"?func=forum_list_article&forum_board_id=".$forum_board_id."\"><font color=\"#0000FF\">".$Data_forum_board['forum_board_title']."</font></a> / ";
                  							echo "<a href=\"?func=forum_list_article&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."\"><font color=\"#0000FF\">".$Data_forum_subject['forum_subject_title']."</font></a> / ";
                  							echo $Data_forum_article['forum_article_title'];
                  							?>
                  						</td>
                  					<tr>
                  					<!-- 發表主題、文章，開始。 -->
                  					<tr>
                  						<td align="right">
                  							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  								<tr>
                  									<td class="lfont_1" height="40"></td>
                  									<td class="lfont_1" width="80" align="right"><?PHP	if (isset($_SESSION['user_email'])){	echo "<a href=\"?func=forum_article_add&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."\">發表文章</a>";	}	?></td>
                  								</tr>
                  							</table>
                  						</td>
                  					</tr>
                  					<!-- 發表主題、文章，結束。 -->
                  					<?PHP
                  					// 沒有指定主題則列出所有主題，開始。
                  					if ($feedback_is_bm == "Y"){
                  						
                  						$Query_forum_article_content = mysql_query("Select `forum_reply_id`, `forum_article_content`, `forum_article_time`,
                  							`forum_poster_email`, `forum_poster_ip`, `forum_on_line_status` From `forum_article_Tab` 
                  							Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id' 
                  							and `forum_article_id` = '$forum_article_id' Order by `forum_reply_id`;");
                  						
                  					} else {
                  						
                  						$Query_forum_article_content = mysql_query("Select `forum_reply_id`, `forum_article_content`, `forum_article_time`,
                  							`forum_poster_email`, `forum_poster_ip`, `forum_on_line_status` From `forum_article_Tab` 
                  							Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id' 
                  							and `forum_article_id` = '$forum_article_id' and `forum_on_line_status` = 'Y' Order by `forum_reply_id`;");
                  						
                  					}
                  					$Rows_forum_article_content = mysql_num_rows($Query_forum_article_content);
                  					?>
                  					<!-- 主題列表，開始。 -->
                  					<?PHP
                  					for ($i = 0; $i < $Rows_forum_article_content; $i++){
                  						
                  						$Data_forum_article_content = mysql_fetch_array($Query_forum_article_content);
                  						
                  						$Data_forum_article_content['forum_poster_email'] = str_replace("@", " AT ", $Data_forum_article_content['forum_poster_email']);
                  						$Data_forum_article_content['forum_poster_email'] = str_replace(".", " DOT ", $Data_forum_article_content['forum_poster_email']);
                  						
                  						$forum_article_time = getdate($Data_forum_article_content['forum_article_time']);
                  					?>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF"><?PHP	echo "<a name=\"".$Data_forum_article_content['forum_reply_id']."\"></a>作者：".$Data_forum_article_content['forum_poster_email'];	?></td>
                  									<td bgcolor="#95ACEC" class="cfont_1" width="140" align="right"><font color="#FFFFFF">
                  										<?PHP
                  										if ($feedback_is_bm == "Y"){
                  											
                  											echo "<a href=\"?func=forum_article_show&status=".$Data_forum_article_content['forum_on_line_status']."&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."&forum_article_id=".$forum_article_id."&forum_reply_id=".$Data_forum_article_content['forum_reply_id']."\">";
                  											if ($Data_forum_article_content['forum_on_line_status'] == "Y"){	echo "不顯示</a>　";	}	else {	echo "<font color=\"red\">顯示</font></a>　";	}
                  											echo "<a href=\"?func=forum_article_del&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."&forum_article_id=".$forum_article_id."&forum_reply_id=".$Data_forum_article_content['forum_reply_id']."\" onClick=\"return confirm('您將刪除這篇文章，確定嗎？')\">刪除</a>";
                  											
                  										}
                  										?>
                  									</td>
                  								</tr>
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">時間：<?PHP	echo $forum_article_time['year']."-".$forum_article_time['mon']."-".$forum_article_time['mday']." ".$forum_article_time['hours'].":".$forum_article_time['minutes'].":".$forum_article_time['seconds'];	?></td>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF" align="right">來源：<?PHP	echo $Data_forum_article_content['forum_poster_ip'];	?></td>
                  								</tr>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>" colspan="2"><?PHP	echo stripslashes(nl2br($Data_forum_article_content['forum_article_content']));	?></td>
                  								</tr>
                  								<?PHP
                  								if (isset($_SESSION['user_email'])){
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>" colspan="2" align="right">
                  										<?PHP
                  										echo "<a href=\"?func=forum_article_add&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."&forum_article_id=".$forum_article_id."\">回應</a>";
                  										?>
                  									</td>
                  								</tr>
                  								<?PHP
                  								}
                  								?>
                  							</table><br>
                  						</td>
                  					</tr>
                  					<?PHP
                  					}
                  					?>
                  					<!-- 主題列表，結束。 -->
                  				</table>
                  				<br>
                  				<!-- 計概討論區 -- 看版文章內容，結束。 -->