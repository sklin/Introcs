                  				<?PHP
                  				$forum_board_id = $_GET['forum_board_id'];
                  				
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				$Query_forum_board = mysql_query("Select `forum_group_id`, `forum_board_title`, `forum_board_manager` 
                  					From `forum_board_Tab` Where `forum_board_id` = '$forum_board_id';");
                  				$Data_forum_board = mysql_fetch_array($Query_forum_board);
                  				
                  				$feedback_is_bm = is_bm($Data_forum_board['forum_board_manager']);
                  				
                  				$Query_forum_group = mysql_query("Select `forum_group_title` From `forum_group_Tab` Where `forum_group_id` = '$Data_forum_board[forum_group_id]';");
                  				$Data_forum_group = mysql_fetch_array($Query_forum_group);
                  				
                  				if ((strlen($Data_forum_board['forum_board_title']) <= 0) and ($feedback_is_bm == "N")){
                  					
                  					closeDB($link_INTRO_DB);														// 關閉資料庫連結
                  					showalert("很抱歉，查無此看版或您沒有管理的權限！");
                  					gotourl("?func=forum");
                  					
                  				}
                  				
                  				?>
                  				<!-- 計概討論區 -- 新增主題，開始。 -->
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
                  							<a href="?func=forum"><font color="#0000FF"><?PHP	echo $Data_forum_group['forum_group_title'];	?></font></a> /
                  							<?PHP echo "<a href=\"?func=forum_list_article&forum_board_id=".$forum_board_id."\"><font color=\"#0000FF\">".$Data_forum_board['forum_board_title']."</font></a>";	?> / 新增主題
                  						</td>
                  					<tr>
                  					<!-- 發表主題、文章，開始。 -->
                  					<tr>
                  						<td align="right">
                  							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  								<tr>
                  									<td class="lfont_1" height="40"></td>
                  								</tr>
                  							</table>
                  						</td>
                  					<tr>
                  					<!-- 發表主題、文章，結束。 -->
                  					<tr>
                  						<td align="center">
                  							<form action="" method="post" name="Form_Forum_Subject_Add" id="Form_Forum_Subject_Add">
                  								<table width="600" border="0" cellspacing="0" cellpadding="0">
                  									<tr>
                  										<td bgcolor="#A4A4A4">
                  											<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  												<tr>
                  													<td width="64" bgcolor="#95ACEC" class="cfont_1" align="center"><font color="#FFFFFF">主題名稱</font></td>
                  													<td bgcolor="#FFFFFF"><input name="Form_Title" type="text" id="Form_Title" size="70" maxlength="30" class="form_1" /></td>
                  												</tr>
                  											</table>
                  										</td>
                  									</tr>
                  									<tr>
                  										<td>
                  											<div align="right"><br />
                  											<input type="hidden" name="Form_Board_ID" id="Form_Board_ID" value="<?PHP	echo $forum_board_id;	?>">
                  											<input type="hidden" name="Form_Function" id="Form_Function" value="forum_subject_add">
                  											<input type="submit" name="button" id="button" value="新增看版主題" />
                  											</div>
                  										</td>
                  									</tr>
                  								</table>
                  							</form>
                  						</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<!-- 計概討論區 -- 新增主題，結束。 -->