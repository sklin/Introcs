<?PHP
// include 所需檔案，開始。
include_once("inc/website.conf.php");
include_once("inc/shareFunctions.inc.php");
include_once("inc/connDB.inc.php");
include_once("inc/accountFunctions.inc.php");
include_once("admin/inc/forumFunctions.inc.php");
// include 所需檔案，結束。
session_save_path('./session');
session_start( );																				// 啟用 SESSION 功能

// 功能呼叫，開始。
if(isset($_POST['Form_Function'])){
switch($_POST['Form_Function']){
	
	// 新增討論區看版文章，開始。
	case "forum_article_add":
	
		$feedback_forum_article_add = forum_article_add($_POST, $Error_EMail_To);
		showalert($feedback_forum_article_add[1]);
		gotourl("?func=forum_list_article&forum_board_id=".$_POST['Form_Board_ID']."&forum_subject_id=".$_POST['Form_Subject_ID']);
		break;
	// 新增討論區看版文章，結束。
	
	
	// 修改討論區看版主題，開始。
	case "forum_subject_modify":
	
		$feedback_forum_subject_modify = forum_subject_modify($_POST, $Error_EMail_To);
		showalert($feedback_forum_subject_modify[1]);
		gotourl("?func=forum_list_article&forum_board_id=".$_POST['Form_Board_ID']);
		break;
	// 修改討論區看版主題，結束。
	
	// 新增討論區看版主題，開始。
	case "forum_subject_add":
	
		$feedback_forum_subject_add = forum_subject_add($_POST, $Error_EMail_To);
		showalert($feedback_forum_subject_add[1]);
		gotourl("?func=forum_list_article&forum_board_id=".$_POST['Form_Board_ID']);
		break;
	// 新增討論區看版主題，結束。
	
	
	// USER 登入，開始。
	case "login":
	
		$feedback_userlogin = userlogin($_POST);
		showalert($feedback_userlogin[1]);
		break;
	// USER 登入，開始。
	
}
}
// 功能呼叫，結束。


// 主功能頁面載入檔案，開始。
if(isset($_GET['func']))
switch($_GET['func']){
	
	// 修改討論區看版文章，開始。
	case "forum_article_show":
		$feedback_forum_article_status = forum_article_status_modify($_GET, $Error_EMail_To);
		showalert($feedback_forum_article_status[1]);
		gotourl("?func=forum_article_content&forum_board_id=".$_GET['forum_board_id']."&forum_subject_id=".$_GET['forum_subject_id']."&forum_article_id=".$_GET['forum_article_id']);
		break;
	// 修改討論區看版文章，結束。
	
	// 刪除討論區看版文章，開始。
	case "forum_article_del":
		$feedback_forum_article_del = forum_article_del($_GET, $Error_EMail_To);
		showalert($feedback_forum_article_del[1]);
		gotourl("?func=forum_list_article&forum_board_id=".$_GET['forum_board_id']."&forum_subject_id=".$_GET['forum_subject_id']);
		break;
	// 刪除討論區看版文章，結束。
	
	// 刪除討論區看版主題，開始。
	case "forum_subject_del":
		$feedback_forum_subject_del = forum_subject_del($_GET['forum_board_id'], $_GET['forum_subject_id'], $Error_EMail_To);
		showalert($feedback_forum_subject_del[1]);
		gotourl("?func=forum_list_article&forum_board_id=".$_GET['forum_board_id']);
		break;
	// 刪除討論區看版主題，結束。
	
	
	case "logout":
		session_destroy();
		showalert("您已登出系統，期待您下次的光臨！");
		gotourl("index.php");
		break;
	
	default:
		$include_func_file = "announcement.inc.php";
		break;
	
}
else $include_func_file = "announcement.inc.php";

// 主功能頁面載入檔案，結束。

// 主功能頁面載入檔案，開始。
$FUNCTION_FILE = array(																													// 允許作用的主功能頁面
	"announcement",
	"member",
	"class", "class_list_title", "class_content", 
	"forum", "forum_list_article", "forum_article_content", "forum_subject_add", "forum_subject_modify", "forum_article_add",
	"links",
	"download",
	"how_to_login"
	);

if (isset($_GET['func'])){
	
	if (in_array($_GET['func'], $FUNCTION_FILE)){
		
		$include_func_file = $_GET['func'].".inc.php";
		
	}
	
}
// 主功能頁面載入檔案，結束。

echo $WEB_HTML_COPYRIGHT;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?PHP	echo $WEB_TITLE;	?></title>
<link rel="stylesheet" href="inc/font.css.php">
<?PHP
if(isset($_GET['func']))
switch($_GET['func']){
	
	case "member_add":
		$include_func_file = "inc/".$_GET['func'].".js.php";
		include_once($include_func_file);
		break;
		
}
?>
</head>

<body leftmargin="0" topmargin="0" bottommargin="0" bgcolor="<?PHP	echo $BODY_BG_COLOR;	?>">
<div align="center">
  <table height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top" bgcolor="#A4A4A4"><table width="1000" height="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td valign="top" bgcolor="#FFFFFF"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="150"><a href="http://intro.cs.nctu.edu.tw/"><img src="img/title_banner.jpg" alt="歡迎蒞臨計概教學網（回首頁）" width="1000" height="150" border="0"></a></td>
            </tr>
            <tr>
              <td valign="top"><table width="100%" height="100%" border="0" cellspacing="8" cellpadding="0">
                <tr>
                  <td width="180" align="center" valign="top">
                    <br>
                    <?PHP
                    include_once("main_menu.inc.php");													// 載入功能選單
                    ?>
                    <br>
                    <?PHP
                    include_once("user_login.inc.php");													// 載入使用者登入功能表
                    ?>
                    </td>
                  <td width="1" bgcolor="#A4A4A4"><img src="img/bg_space.gif" width="1" height="1"></td>
                  <td align="center" valign="top">
                  	<table width="770" border="0" cellspacing="0" cellpadding="0">
                  		<tr>
                  			<td align="center">
                  				<?PHP
                  				include_once($include_func_file);											// 載入主功能頁面
                  				?>
                  			</td>
                  		</tr>
                  	</table>
                  </td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="40" align="center" valign="top">
              	<?PHP
              	include_once("copyright.inc.php");															// 載入版權宣告
                ?>
              </td>
            </tr>
          </table></td>
        </tr>
        
      </table></td>
    </tr>
  </table>
</div>
</body>
</html>
