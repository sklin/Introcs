<?PHP
/**********************************************************************************************************************
 * NCTU INTRO - http://intro.cs.nctu.edu.tw/																						Share Functions Include File	*
 * Develop environment: Apache 2.0.40 & PHP 4.2.2																				Programmer: JasonChung				*
 **********************************************************************************************************************
 * Date: 2008/09/08																																																		*
 **********************************************************************************************************************
 * List:																																																							*
 * function gotourl($url_addr): JasonChung, 2008/09/08																																*
 * function showalert($msg): JasonChung, 2008/09/08																																		*
 * function pages_list($read_page, $rows_data, $num_data, $num_zone, $num_each_zone, $url): JasonChung, 2008/09/08		*
 * function check_datetime($year, $month, $day, $hour, $minute, $second): Youlin Dong, 2008/09/08											*
 **********************************************************************************************************************/

// === JavaScript Go To URL Function (by JasonChung, 2008/09/08) ================================================
function gotourl($url_addr) {
	
	echo "<script language=\"JavaScript\">location.href = '".$url_addr."';</script>\n";
	
}


// === JavaScript Alert Function (by JasonChung, 2008/09/08) ====================================================
function showalert($msg) {
	
	echo "<script language=\"JavaScript\">"."alert("."\"".$msg."\"".")"."</script>\n";
	
}


// === Album Pages List Function (by JasonChung, 2008/09/08) ====================================================
function pages_list($read_page, $rows_data, $num_data, $num_zone, $num_each_zone, $url){
	
	/************************************************************************************************************
	 * function 傳入參數說明：								* function 回傳結果說明：																					*
	 *																				* 																																*
	 * $read_page:		讀取的頁數							* $feedback_pages_list['num_from']: 每頁呈現各區塊起始 Array			*
	 * $rows_data:		資料庫中資料總數				* $feedback_pages_list['num_end']:	每頁呈現各區塊結束 Array			*																													*
	 * $num_data:			每頁的資料總數					*																																	*
	 * $num_zone:			每頁呈現的區塊數				*																																	*
	 * $num_each_zone:每頁呈現區塊中的資料數	*																																	*
	 * $url:					分頁跳頁的 URL					*																																	*
	 ************************************************************************************************************/
	
	$time_counter = time();																																											// 程式計時開始。
	unset($feedback_pages_list);																																								// 刪除 feedback 變數，以確保最後回傳值。
	
	if(!$read_page){	$read_page = 1;	}																																					// 無 $read_page 預設為第一頁
	
	$temp1 = $rows_data % $num_data;																																						// 餘數
	$temp2 = $rows_data - $temp1;																																								// 扣除餘數後的 $rows_data
	$temp3 = $temp2 / $num_data;																																								// 整除
	$temp4 = $rows_data / $num_data;
	
	
	if ($rows_data <= $num_data){																																								// 計算總頁數 ($total_pages)，以 1 為起始頁，開始。

		$total_pages = 1;
		
	} else {
		
		if ($temp1 != 0){
			
			$total_pages = $temp3 + 1;
			
		} else {
			
			$total_pages = $temp4;
			
		}
		
	}																																																						// 計算總頁數 ($total_pages)，以 1 為起始頁，結束。
	
	
	echo "                <form name=\"select_page\" method=\"post\" action=\"\">\n";
	echo "                  共 <font color=\"#CC3300\">".$total_pages."</font> 頁　目前在第\n";									// 輸出總頁數
	
	echo "                  <select name=\"Form_Page\" id=\"Form_Page\" onchange=\"window.location.href=(this.options[this.selectedIndex].value);\">\n";													// 輸出下拉式選單的跳頁，開始。
	echo "                    <option value=\"".$url."&page=".$read_page."\">".$read_page."</option>\n";				// 下拉式選單中的目前頁數
	echo "                    <option value=\"".$url."&page=".$read_page."\">----</option>\n";									// 下拉式選單中的分隔線， value 為目前頁數。
	for ($i = 1; $i <= $total_pages; $i++){
		
		echo "                    <option value=\"".$url."&page=".$i."\">".$i."</option>\n";
	
	}
	echo "                  </select> 頁　\n";																																	// 輸出下拉式選單的跳頁，結束。
	
	echo "                  <a href=\"".$url."\">第一頁</a>　";																									// 輸出第一頁、上一頁、下一頁、最後一頁，開始。
	if ($read_page - 1 != 0){	echo "<a href=\"".$url."&page=".($read_page - 1)."\">上一頁</a>　";	}
	if ($total_pages > $read_page){	echo "<a href=\"".$url."&page=".($read_page + 1)."\">下一頁</a>　";	}
	echo "<a href=\"".$url."&page=".$total_pages."\">最後一頁</a>\n";																						// 輸出第一頁、上一頁、下一頁、最後一頁，結束。
	echo "                </form>\n";
	
	$page = $read_page - 1;																																											// 實際的計算頁數（以 0 為起始頁）
	$num_from[1] = $page * $num_data;																																						// 本頁起始的第一筆
	
	$num_end[$num_zone] = $num_from[1] + ($num_data - 1);																												// 本頁的最後一筆，開始。
	if ($num_end[$num_zone] >= $rows_data){
		
		$num_end[$num_zone] = $rows_data - 1;
		
	}																																																						// 本頁的最後一筆，結束。
	
	for ($i = 1; $i <= $num_zone; $i++){																																				// 計算每個 Zone 的起始及結束，開始。
		
		if ($i != 1){	$num_from[$num_zone] = $num_from[$i - 1] + $num_each_zone;	}
		
		if (($num_from[$i] + ($num_each_zone - 1)) > $num_end[$num_zone]){
			$num_end[$i] = $num_end[$num_zone];
		} else {
			$num_end[$i] = $num_from[$i] + ($num_each_zone - 1);
		}
	
	}																																																						// 計算每個 Zone 的起始及結束，結束。

	$feedback_pages_list['num_from'] = $num_from;																																// 儲存結果，開始。
	$feedback_pages_list['num_end'] = $num_end;																																	// 儲存結果，結束。
	
	//$feedback_pages_list[1] = $feedback_pages_list[1]."（程式執行共計小於 ".(time() - $time_counter + 1)." 秒）";
	return $feedback_pages_list;																																								// 回傳結果、訊息
	
}


// === Check Datatime Function (by Youlin Dong, 2008/09/08) =====================================================
function check_datetime($year, $month, $day, $hour, $minute, $second){
	
	/************************************************************************************************************
	 * function 傳入參數說明：																																									*
	 * 回傳正確可用的 date & time, error 發生則傳回現在時間, 根據個別變數檢查修改 															*
	 * 不是數字, 數字範圍錯誤(小數負數), 位數不足時補零																													*
   * $feedback_datetime['year']."-".$feedback_datetime['month']."-".$feedback_datetime['day'];                *
   * $feedback_datetime['hour'].":".$feedback_datetime['minute'].":".$feedback_datetime['second'];            *
	 ************************************************************************************************************/
	
	unset($feedback_datetime);
	 
	//若日期錯誤取現在date
	if (!$month or !$day or !$year or checkdate($month,$day,$year) == false){
	
		$feedback_datetime['year'] = date("Y");
		$feedback_datetime['month'] = date("m");
		$feedback_datetime['day'] = date("d");
	
	}else{
	
		$feedback_datetime['year'] = $year;
		$feedback_datetime['month'] = $month;
		$feedback_datetime['day'] = $day;
	
	}
	
	//若時間錯誤取現在time
	
	//不是數字或位數錯誤

	if ((is_numeric($hour) != 1) or (strlen($hour) > 2) or $hour > 23 or $hour < 0){	
		$feedback_datetime['hour'] = date("H");	
	} elseif (is_numeric($hour) and strlen((int)$hour) == 1){
		$feedback_datetime['hour'] = "0".(int)$hour; 																//加(int)避免此種輸入 like "6."
	} else {
		$feedback_datetime['hour'] = $hour;
	}
	
	if ((is_numeric($minute) != 1) or (strlen($minute) > 2) or $minute > 59 or $minute < 0){	
		$feedback_datetime['minute'] = date("i");	
	} elseif (is_numeric($minute) and strlen((int)$minute) == 1){
		$feedback_datetime['minute'] = "0".(int)$minute;
	} else {
		$feedback_datetime['minute'] = $minute;
	}

	if ((is_numeric($second) != 1) or (strlen($second) > 2) or $second > 59 or $second < 0){	
		$feedback_datetime['second'] = date("s");	
	} elseif (is_numeric($second) and strlen((int)$second) == 1){
		$feedback_datetime['second'] = "0".(int)$second;
	} else {
		$feedback_datetime['second'] = $second;
	}
			
	return $feedback_datetime;
}
?>