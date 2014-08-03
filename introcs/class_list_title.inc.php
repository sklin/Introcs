                  				<?PHP
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				
                  				$class_info_classification = $_GET['class_info_classification'];
                  				$class_info_group_id = $_GET['class_info_group_id'];
                  				
                  				// 查詢所有課程資訊分類名稱，開始。
                  				$Query_class_group = mysql_query("Select `class_info_group_title` From `class_info_group_Tab` 
                  					Where `class_info_classification` = '$class_info_classification' and `class_info_group_id` = '$class_info_group_id';");
                  				$Data_class_group = mysql_fetch_array($Query_class_group);
                  				// 查詢所有課程資訊分類名稱，結束。
                  				
                  				if (($class_info_group_id != 0) and (strlen($Data_class_group['class_info_group_title']) <= 0)){
                  					
                  					closeDB($link_INTRO_DB);														// 關閉資料庫連結
                  					showalert("很抱歉，資料庫中查無該分類！");
                  					gotourl("?func=class");
                  					
                  				}
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
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 
                  							<?PHP
                  							if ($class_info_classification == "class"){	echo "<a href=\"?func=class\"><font color=\"#0000FF\">課程資訊</font></a> / ";	} elseif ($class_info_classification == "exam"){	echo "<a href=\"?func=class\"><font color=\"#0000FF\">考古題資訊</font></a> / ";	}
                  							if ($class_info_group_id != 0){	echo $Data_class_group['class_info_group_title'];	} else {	echo "未分類";	}
                  							?>
                  						</td>
                  					</tr>
                  					<tr>
                  						<td class="cfont_1" align="right">
                  						<?PHP
                  						$Query_class_info = mysql_query("Select `class_info_sn`, `class_info_title` From `class_info_Tab` 
                  							Where `class_info_classification` = '$class_info_classification' and `class_info_group_id` = '$class_info_group_id' Order by `class_info_sn` DESC;");
                  						$Rows_class_info = mysql_num_rows($Query_class_info);
                  						
                  						$num_data = 20;
                  						$num_zone = 1;
                  						$num_each_zone = 20;
                  						$page_list_url = "?func=class_list_title&class_info_classification=".$class_info_classification."&class_info_group_id=".$class_info_group_id;
                  						
                  						if (!isset($_GET['page'])){	$_GET['page'] = 1;	}
                  						$feedback_pages_list = pages_list($_GET['page'], $Rows_class_info, $num_data, $num_zone, $num_each_zone, $page_list_url);
                  						?>
                  						</td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">標題</font></td>
                  								</tr>
                  								<?PHP
                  								if (!isset($feedback_pages_list['num_from'][1])){	$feedback_pages_list['num_from'][1] = 0;	}
                  								if (!isset($feedback_pages_list['num_end'][1])){	$feedback_pages_list['num_end'][1] = $Rows_class_info - 1;	}
                  								
                  								for ($i = $feedback_pages_list['num_from'][1]; $i <= $feedback_pages_list['num_end'][1]; $i++){
                  									
                  									mysql_data_seek($Query_class_info, $i);
                  									$Data_class_info = mysql_fetch_array($Query_class_info);
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"?func=class_content&class_info_classification=".$class_info_classification."&class_info_group_id=".$class_info_group_id."&class_info_sn=".$Data_class_info['class_info_sn']."\">".$Data_class_info['class_info_title']."</a>";	?></td>
                  								</tr>
                  								<?PHP
                  								}
                  								
                  								closeDB($link_INTRO_DB);											// 關閉資料庫連結
                  								?>
                  							</table>
                  						</td>
                  					</tr>
                  				</table>
                  				<!-- 列出所有課程資訊群組，結束。 -->
                  				<br>
                  				<!-- 課程及考古題資訊，結束。 -->