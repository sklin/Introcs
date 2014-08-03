                  				<?PHP
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				
                  				$class_info_classification = $_GET['class_info_classification'];
                  				$class_info_group_id = $_GET['class_info_group_id'];
                  				$class_info_sn = $_GET['class_info_sn'];
                  				
                  				// 查詢分類名稱，開始。
                  				$Query_class_info = mysql_query("Select `class_info_title`, `class_content`, `class_info_name` From `class_info_Tab` 
                  					Where `class_info_sn` = '$class_info_sn';");
                  				$Data_class_info = mysql_fetch_array($Query_class_info);
                  				// 查詢分類名稱，結束。
                  				
                  				if (strlen($Data_class_info['class_info_title']) <= 0){
                  					
                  					closeDB($link_INTRO_DB);														// 關閉資料庫連結
                  					showalert("很抱歉，資料庫中查無該資料！");
                  					gotourl("?func=class");
                  					
                  				}
                  				
                  				// 查詢分類名稱，開始。
                  				$Query_class_group = mysql_query("Select `class_info_group_title` From `class_info_group_Tab` 
                  					Where `class_info_classification` = '$class_info_classification' and `class_info_group_id` = '$class_info_group_id';");
                  				$Data_class_group = mysql_fetch_array($Query_class_group);
                  				// 查詢分類名稱，結束。
                  				?>
                  				<!-- 課程及考古題資訊詳細內容，開始。 -->
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
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 
                  							<?PHP
                  							if ($class_info_classification == "class"){	echo "<a href=\"?func=class\"><font color=\"#0000FF\">課程資訊</font></a> / ";	} elseif ($class_info_classification == "exam"){	echo "<a href=\"?func=class\"><font color=\"#0000FF\">考古題資訊</font></a> / ";	}
                  							if ($class_info_group_id != 0){	echo "<a href=\"?func=class_list_title&class_info_classification=".$class_info_classification."&class_info_group_id=".$class_info_group_id."\"><font color=\"#0000FF\">".$Data_class_group['class_info_group_title']."</font></a> / ";	} else {	echo "<a href=\"?func=class_list_title&class_info_classification=".$class_info_classification."&class_info_group_id=0\"><font color=\"#0000FF\">未分類</font></a> / ";	}
                  							echo $Data_class_info['class_info_title'];
                  							?>
                  						</td>
                  					</tr>
                  					<tr>
                  						<td class="sfont_1"><br>
                  							<?PHP
                  							if (strlen(trim($Data_class_info['class_content'])) > 0){
                  								
                  								echo "<font class=\"cfont_1\"><b>內容：</b></font><p>";

                  								echo stripslashes(preg_replace("/\n/","<br />",$Data_class_info['class_content']))."<p>";
                  								
                  							}
                  							
                  							if (strlen(trim($Data_class_info['class_info_name'])) > 0){
                  								
                  								echo "<font class=\"cfont_1\"><b>檔案：</b></font><a href=\"../download/class_info/".$Data_class_info['class_info_name']."\" target=\"_blank\">下載</a>";
                  								
                  							}
                  							?>
                  						</td>
               					  </tr>
                  				</table>
                  				<br>
                  				<!-- 課程及考古題資訊詳細內容，結束。 -->
