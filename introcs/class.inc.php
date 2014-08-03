                  				<?PHP
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				
                  				// 查詢所有課程資訊分類名稱，開始。
                  				$Query_class_group = mysql_query("Select `class_info_group_id`, `class_info_group_title` From `class_info_group_Tab` Where `class_info_classification` = 'class' Order by `class_info_group_id`;");
                  				$Rows_class_group = mysql_num_rows($Query_class_group);
                  				
                  				$class_group_admin[0] = "未分類";
                  				for ($i = 0; $i < $Rows_class_group; $i++){
                  					
                  					$Data_class_group = mysql_fetch_array($Query_class_group);
                  					$class_group_admin[$Data_class_group['class_info_group_id']] = $Data_class_group['class_info_group_title'];
                  					
                  				}
                  				// 查詢所有課程資訊分類名稱，結束。
                  				
                  				// 查詢所有考古題資訊分類名稱，開始。
                  				$Query_exam_group = mysql_query("Select `class_info_group_id`, `class_info_group_title` From `class_info_group_Tab` Where `class_info_classification` = 'exam' Order by `class_info_group_id`;");
                  				$Rows_exam_group = mysql_num_rows($Query_exam_group);
                  				
                  				$exam_group_admin[0] = "未分類";
                  				for ($i = 0; $i < $Rows_exam_group; $i++){
                  					
                  					$Data_exam_group = mysql_fetch_array($Query_exam_group);
                  					$exam_group_admin[$Data_exam_group['class_info_group_id']] = $Data_exam_group['class_info_group_title'];
                  					
                  				}
                  				// 查詢所有考古題資訊分類名稱，結束。
                  				
                  				closeDB($link_INTRO_DB);															// 關閉資料庫連結
                  				?>
                  				<!-- 課程及考古題資訊，開始。 -->
                  				<br>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td width="7" height="57" background="img/bg_title_bar01.gif">&nbsp;</td>
                  						<td width="40" align="center" background="img/bg_title_bar02.gif"><img src="img/bg_title_bar04.gif" width="26" height="26"></td>
                  						<td background="img/bg_title_bar02.gif" class="tfont_1">課程及考古題資訊</td>
                  						<td width="9" background="img/bg_title_bar03.gif">&nbsp;</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<!-- 列出所有課程資訊群組，開始。 -->
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 課程資訊</td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">分類名稱</font></td>
                  								</tr>
                  								<?PHP
                  								$i = 1;
                  								while(list($group_id , $group_title) = each($class_group_admin)) {
                  									
                  									$i++;
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"?func=class_list_title&class_info_classification=class&class_info_group_id=".$group_id."\">".$group_title."</a>";	?></td>
                  								</tr>
                  								<?PHP
                  								}
                  								?>
                  							</table>
                  						</td>
                  					</tr>
                  				</table>
                  				<!-- 列出所有課程資訊群組，結束。 -->
                  				<br>
                  				<!-- 列出所有課程資訊群組，開始。 -->
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 考古題資訊</td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">分類名稱</font></td>
                  								</tr>
                  								<?PHP
                  								$i = 1;
                  								while(list($group_id , $group_title) = each($exam_group_admin)) {
                  									
                  									$i++;
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"?func=class_list_title&class_info_classification=exam&class_info_group_id=".$group_id."\">".$group_title."</a>";	?></td>
                  								</tr>
                  								<?PHP
                  								}
                  								?>
                  							</table>
                  						</td>
                  					</tr>
                  				</table>
                  				<!-- 列出所有課程資訊群組，結束。 -->
                  				<!-- 課程及考古題資訊，結束。 -->