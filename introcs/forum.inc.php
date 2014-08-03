                  				<!-- 計概討論區，開始。 -->
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
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				$Query_forum_group = mysql_query("Select * From `forum_group_Tab` Order by `forum_group_id`;");
                  				$Rows_forum_group = mysql_num_rows($Query_forum_group);
                  				
                  				for ($i = 0; $i < $Rows_forum_group; $i++){
                  					
                  					$Data_forum_group = mysql_fetch_array($Query_forum_group);
                  					
                  				?>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> <?PHP	echo $Data_forum_group['forum_group_title'];	?></td>
                  					<tr>
                  							<?PHP
                  							if (strlen($Data_forum_group['forum_group_memo']) > 0){
                  							?>
                  					<tr>
                  						<td align="right">
                  							<table width="98%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td class="cfont_1"><font color="#999999"><?PHP	echo $Data_forum_group['forum_group_memo'];	?></font></td>
                  								</tr>
                  							</table>
                  						</td>
                  					<tr>
                  							<?PHP
                  							}
                  							?>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">看版列表</td>
                  								</tr>
                  								<?PHP
                  								$Query_forum_board = mysql_query("Select * From `forum_board_Tab` Where `forum_group_id` = '$Data_forum_group[forum_group_id]' Order by `forum_board_title`;");
                  								$Rows_forum_board = mysql_num_rows($Query_forum_board);
                  								
                  								for ($j = 0; $j < $Rows_forum_board; $j++){
                  									
                  									$Data_forum_board = mysql_fetch_array($Query_forum_board);
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($j % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>">
                  										<!-- 條列看版，開始。 -->
                  										<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  											<!-- 看版名稱，開始。 -->
                  											<tr>
                  												<td class="cfont_1" colspan="2"><?PHP	echo "<a href=\"?func=forum_list_article&forum_board_id=".$Data_forum_board['forum_board_id']."\">".$Data_forum_board['forum_board_title']."</a>";	?></td>
                  											</tr>
                  											<!-- 看版名稱，結束。 -->
                  											<!-- 看版資訊，開始。 -->
                  											<tr>
                  												<td width="20"></td>
                  												<td>
                  													<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  														<!-- 看版說明，開始。 -->
                  														<tr>
                  															<td class="sfont_1" colspan="2"><?PHP echo $Data_forum_board['forum_board_memo'];	?></td>
                  														</tr>
                  														<!-- 看版說明，結束。 -->
                  														<!-- 版主資訊，開始。 -->
                  														<tr>
                  															<td class="sfont_1" width="40" valign="top">版主：</td>
                  															<td class="sfont_1">
                  																<?PHP
                  																$bm_array = array_unique(explode("##", $Data_forum_board['forum_board_manager']));
                  																while(list($bm_key, $bm_value) = each($bm_array)){
                  																	
                  																	if (strlen(trim($bm_value)) > 0){
                  																		
                  																		$bm_value = str_replace("@", " AT ", $bm_value);
                  																		$bm_value = str_replace(".", " DOT ", $bm_value);
                  																		echo $bm_value."　";
                  																		
                  																	}
                  																	
                  																}
                  																?>
                  															</td>
                  														</tr>
                  														<!-- 版主資訊，結束。 -->
                  													</table>
                  												</td>
                  											</tr>
                  											<!-- 看版資訊，結束。 -->
                  										</table>
                  										<!-- 條列看版，結束。 -->
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
                  				<?PHP
                  				}
                  				?>
                  				<!-- 計概討論區，結束。 -->