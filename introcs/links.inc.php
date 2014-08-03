                  				<!-- 學習資源網，開始。 -->
                  				<br>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td width="7" height="57" background="img/bg_title_bar01.gif">&nbsp;</td>
                  						<td width="40" align="center" background="img/bg_title_bar02.gif"><img src="img/bg_title_bar04.gif" width="26" height="26"></td>
                  						<td background="img/bg_title_bar02.gif" class="tfont_1">學習資源網</td>
                  						<td width="9" background="img/bg_title_bar03.gif">&nbsp;</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<?PHP
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				$Query_links_group = mysql_query("Select `links_group_id`, `links_group_title` From `links_group_Tab` Order by `links_group_id`;");
                  				$Rows_links_group = mysql_num_rows($Query_links_group);
                  				
                  				for ($i = 0; $i < $Rows_links_group; $i++){
                  					
                  					$Data_links_group = mysql_fetch_array($Query_links_group);
                  					
                  				?>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> <?PHP	echo $Data_links_group['links_group_title'];	?></td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">名稱</font></td>
                  								</tr>
                  								<?PHP
                  								$Query_links = mysql_query("Select `links_sn`, `links_title`, `links_url` From `links_Tab` Where `links_group_id` = '$Data_links_group[links_group_id]' Order by `links_title`;");
                  								$Rows_links = mysql_num_rows($Query_links);
                  								
                  								for ($j = 0; $j < $Rows_links; $j++){
                  									
                  									$Data_links = mysql_fetch_array($Query_links);
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($j % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"".$Data_links['links_url']."\" target=\"_blank\">".$Data_links['links_title']."</a>";	?></td>
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
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 未分類</td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  								<tr>
                  									<td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">名稱</font></td>
                  								</tr>
                  								<?PHP
                  								$Query_links = mysql_query("Select `links_sn`, `links_title`, `links_url` From `links_Tab` Where `links_group_id` = '0' Order by `links_title`;");
                  								$Rows_links = mysql_num_rows($Query_links);
                  								
                  								for ($i = 0; $i < $Rows_links; $i++){
                  									
                  									$Data_links = mysql_fetch_array($Query_links);
                  								?>
                  								<tr>
                  									<td class="cfont_1" bgcolor="<?PHP if ($i % 2 == 1){	echo "#E2EFFF";	} else {	echo "#EAEAEA";	}	?>"><?PHP	echo "<a href=\"".$Data_links['links_url']."\" target=\"_blank\">".$Data_links['links_title']."</a>";	?></td>
                  								</tr>
                  								<?PHP
                  								}
                  								
                  								closeDB($link_INTRO_DB);											// 關閉資料庫連結
                  								?>
                  							</table>
                  						</td>
                  					</tr>
                  				</table>
                  				<!-- 學習資源網，結束。 -->