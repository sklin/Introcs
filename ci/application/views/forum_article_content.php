<!-- 計概討論區  看版文章內容，開始。 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" />
      <?php echo anchor('page/forum', $forum_group_title, 'class="link-class"'); ?> /
      <?php echo anchor('page/forum_list_article/'.$forum_board_id, $forum_board_title, 'class="link-class"'); ?> /
      <?php echo anchor('page/forum_list_article/', $forum_subject_title, 'class="link-class"'); ?> /
      <?php echo $forum_article_title; ?>
    </td>
  <tr>
<!-- 發表主題、文章，開始。 -->
  <tr>
    <td align="right">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="lfont_1" height="40"></td>
          <td class="lfont_1" width="80" align="right">
      <?php
          if(isset($_SESSION['user_email']))
          {
            echo "<a href=\"?func=forum_article_add&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."\">發表文章</a>"; 
          }
      ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
<!-- 發表主題、文章，結束。 -->
<!-- 主題列表，開始。 -->
<?php foreach ($forum_article_item as $forum_article): ?>
<?php
    $forum_article['forum_poster_email'] = str_replace("@", " AT ", $forum_article['forum_poster_email']);
    $forum_article['forum_poster_email'] = str_replace(".", " DOT ", $forum_article['forum_poster_email']);
    $forum_article_time = getdate($forum_article['forum_article_time']);
?>
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td bgcolor="#95ACEC" class="cfont_1">
            <font color="#FFFFFF">
              <?php echo "<a name=\"".$forum_article['forum_reply_id']."\"></a>作者：".$forum_article['forum_poster_email']; ?>
            </font>
          </td>
          <td bgcolor="#95ACEC" class="cfont_1" width="140" align="right">
            <font color="#FFFFFF">
              <?php
                  if (TRUE){
#                  if ($feedback_is_bm == "Y"){
                      echo "<a href=\"?func=forum_article_show&status=".$forum_article['forum_on_line_status']."&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."&forum_article_id=".$forum_article_id."&forum_reply_id=".$forum_article['forum_reply_id']."\">";
                      if ($forum_article['forum_on_line_status'] == "Y"){
                          echo "不顯示</a>　";
                      } else {
                          echo "<font color=\"red\">顯示</font></a>　";
                      }
                      echo "<a href=\"?func=forum_article_del&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."&forum_article_id=".$forum_article_id."&forum_reply_id=".$forum_article['forum_reply_id']."\" onClick=\"return confirm('您將刪除這篇文章，確定嗎？')\">刪除</a>";
                  }
              ?>
            </font>
          </td>
        </tr>
        <tr>
          <td bgcolor="#95ACEC" class="cfont_1">
            <font color="#FFFFFF">
              時間：<?php echo $forum_article_time['year']."-".$forum_article_time['mon']."-".$forum_article_time['mday']." ".$forum_article_time['hours'].":".$forum_article_time['minutes'].":".$forum_article_time['seconds']; ?>
            </font>
          </td>
          <td bgcolor="#95ACEC" class="cfont_1">
            <font color="#FFFFFF" align="right">
              來源：<?php echo $forum_article['forum_poster_ip']; ?>
            </font>
          </td>
        </tr>
        <tr>
          <td class="cfont_1" bgcolor="#E2EFFF" colspan="2">
            <?php echo stripslashes(nl2br($forum_article['forum_article_content'])); ?>
          </td>
        </tr>
        <?php
        if (isset($_SESSION['user_email'])){
        ?>
        <tr>
          <td class="cfont_1" bgcolor="#E2EFFF" colspan="2" align="right">
            <?php
            echo "<a href=\"?func=forum_article_add&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."&forum_article_id=".$forum_article_id."\">回應</a>";
            ?>
          </td>
        </tr>
        <?php
        }
        ?>
      </table>
      <br>
    </td>
  </tr>
<?php endforeach ?>
<!-- 主題列表，結束。 -->
</table>
<br>
<!-- 計概討論區  看版文章內容，結束。 -->
