                  				<!-- 常用工具下載，開始。 -->
                  				<br>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td width="7" height="57" background="img/bg_title_bar01.gif">&nbsp;</td>
                  						<td width="40" align="center" background="img/bg_title_bar02.gif"><img src="img/bg_title_bar04.gif" width="26" height="26"></td>
                  						<td background="img/bg_title_bar02.gif" class="tfont_1">常用工具下載</td>
                  						<td width="9" background="img/bg_title_bar03.gif">&nbsp;</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<?PHP
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				$Query_file_group = mysql_query("Select `file_group_id`, `file_group_title` From `file_group_Tab` Order by `file_group_id`;");
                  				$Rows_file_group = mysql_num_rows($Query_file_group);
                  				
                  				for ($i = 0; $i < $Rows_file_group; $i++){
                  					
                  					$Data_file_group = mysql_fetch_array($Query_file_group);
                  					
                  				?>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> <?PHP	echo $Data_file_group['file_group_title'];	?></td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">名稱</font></td>
                  									<td width="40" align="center" bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">來源</font></td>
                  								</tr>
                  								<?PHP
                  								$Query_file = mysql_query("Select `file_sn`, `file_title`, `file_name`, `file_source` From `file_Tab` Where `file_group_id` = '$Data_file_group[file_group_id]' Order by `file_title`;");
                  								$Rows_file = mysql_num_rows($Query_file);
                  								
                  								for ($j = 0; $j < $Rows_file; $j++){
                  									
                  									$Data_file = mysql_fetch_array($Query_file);
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($j % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"download_file.php?file_sn=".$Data_file['file_sn']."\" target=\"_blank\">".$Data_file['file_title']."</a>";	?></td>
                  									<td class="cfont_1" align="center" bgcolor="<?PHP if ($j % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	if (strlen($Data_file['file_source']) > 0){	echo "<a href=\"".$Data_file['file_source']."\" target=\"_blank\">前往</a>";	} else {	echo "無";	}	?></td>
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
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 其他相關工具</td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">名稱</font></td>
                  									<td width="40" align="center" bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">來源</font></td>
                  								</tr>
                  								<?PHP
                  								$Query_file = mysql_query("Select `file_sn`, `file_title`, `file_name`, `file_source` From `file_Tab` Where `file_group_id` = '0' Order by `file_title`;");
                  								$Rows_file = mysql_num_rows($Query_file);
                  								
                  								for ($i = 0; $i < $Rows_file; $i++){
                  									
                  									$Data_file = mysql_fetch_array($Query_file);
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"download_file.php?file_sn=".$Data_file['file_sn']."\" target=\"_blank\">".$Data_file['file_title']."</a>";	?></td>
                  									<td class="cfont_1" align="center" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	if (strlen($Data_file['file_source']) > 0){	echo "<a href=\"".$Data_file['file_source']."\" target=\"_blank\">前往</a>";	} else {	echo "無";	}	?></td>
                  								</tr>
                  								<?PHP
                  								}
                  								
                  								closeDB($link_INTRO_DB);											// 關閉資料庫連結
                  								?>
                  							</table>
                  						</td>
                  					</tr>
                  				</table>
                  				<!-- 常用工具下載，結束。 -->