<!-- 計概討論區  看版文章列表，開始。 -->
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
      <?php echo anchor('page/forum',$forum_group_item[0]['forum_group_title']) ?> /
            <?PHP
            if ($forum_subject_id !== FALSE){
                echo anchor('page/forum_list_article/'.$forum_board_id,$forum_board_item[0]['forum_board_title'],'class="link-class"');
                echo " / ".$forum_subject_title;

            } else {
                echo $forum_board_item[0]['forum_board_title'];
            }
            ?>
    </td>
  </tr>
<!-- 發表主題、文章，開始。 -->
  <tr>
    <td align="right">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="lfont_1" height="40">
                        <?PHP
                        if (($forum_subject_id === FALSE) and ($feedback_is_bm == "Y"))
                        {
                            echo "<a href=\"?func=forum_subject_add&forum_board_id=".$forum_board_id."\">新增主題</a>";
                        }
                        ?>
          </td>
          <td class="lfont_1" width="80" align="right">
            <?PHP
                if(TRUE)
#                if(isset($_SESSION['user_email']))
                {
                    echo anchor('page/forum_article_add/'.$forum_board_id.'/'.$forum_subject_id,'發表文章');
                }
                ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
<!-- 發表主題、文章，結束。 -->
<!-- 主題列表，開始。 -->
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">主題列表</td>
          <?PHP
            if ($feedback_is_bm == "Y"){
          ?>
          <td bgcolor="#95ACEC" class="cfont_1" width="40" align="center"><font color="#FFFFFF">設定</td>
          <td bgcolor="#95ACEC" class="cfont_1" width="40" align="center"><font color="#FFFFFF">刪除</td>
          <?PHP
            }
          ?>
        </tr>
          <?php if($forum_subject_item !== NULL){ ?>
            <?php foreach ($forum_subject_item as $forum_subject): ?>
        <tr>
          <td class="cfont_1" bgcolor="#E2EFFF">
              <?php echo anchor('page/forum_list_article/'.$forum_board_id.'/'.$forum_subject['forum_subject_id'],$forum_subject['forum_subject_title'],'class="link-class"'); ?>
          </td>
              <?php if ($feedback_is_bm == "Y"){ ?>
          <td class="cfont_1" bgcolor="#E2EFFF" align="center"><a href="page/forum_subject_modify">修改</a></td>
          <td class="cfont_1" bgcolor="#E2EFFF" align="center"><a href="forum_subject_del">刪除</a></td>
              <?php } ?>
        </tr>
            <?php endforeach ?>
      </table>
      <br>
      <br>
    </td>
  </tr>
<!-- 主題列表，結束。 -->
          <?php } ?>
  
  <tr>
    <td align="right" class="cfont_1">
      page : 1 2 3 4 5 ... 20
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">文章標題</td>
          <td bgcolor="#95ACEC" class="cfont_1" width="100" align="center"><font color="#FFFFFF">作　　者</td>
          <td bgcolor="#95ACEC" class="cfont_1" width="80" align="center"><font color="#FFFFFF">時　　間</td>
        </tr>
        <?php foreach ($forum_article_item as $forum_article): ?>
        <tr>
          <td class="cfont_1" bgcolor="#E2EFFF">
            <?php echo anchor('page/forum_article_content',$forum_article['forum_article_title']); ?>
          </td>
          <td class="cfont_1" bgcolor="#E2EFFF" align="center">
            <?PHP
              $forum_article_poster = explode("@", $forum_article['forum_poster_email']);
              echo $forum_article_poster[0];
            ?>
          </td>
          <td class="cfont_1" bgcolor="#E2EFFF" align="center">
            <?PHP
              $forum_article_time = getdate($forum_article['forum_article_time']);
              echo $forum_article_time['year']."-".$forum_article_time['mon']."-".$forum_article_time['mday'];
            ?>
          </td>
        </tr>
        <?php endforeach ?>
      </table>
    </td>
  </tr>
</table>
<br>
<!-- 計概討論區  看版文章列表，結束。 -->
