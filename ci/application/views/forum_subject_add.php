<!-- 計概討論區  新增主題，開始。 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" />
        <?PHP echo anchor('page/forum', $forum_group_title, 'class="link-class"'); ?> /
        <?PHP echo anchor('page/forum_list_article', $forum_board_title, 'class="link-class"'); ?> /
        新增主題
    </td>
  <tr>
<!-- 發表主題、文章，開始。 -->
  <tr>
    <td align="right">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="lfont_1" height="40"></td>
        </tr>
      </table>
    </td>
  <tr>
<!-- 發表主題、文章，結束。 -->
  <tr>
    <td align="center">
      <form action="" method="post" name="Form_Forum_Subject_Add" id="Form_Forum_Subject_Add">
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#A4A4A4">
              <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr>
                  <td width="64" bgcolor="#95ACEC" class="cfont_1" align="center"><font color="#FFFFFF">主題名稱</font></td>
                  <td bgcolor="#FFFFFF"><input name="Form_Title" type="text" id="Form_Title" size="70" maxlength="30" class="form_1" /></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <div align="right"><br />
                <input type="hidden" name="Form_Board_ID" id="Form_Board_ID" value="<?PHP echo $forum_board_id; ?>">
                <input type="hidden" name="Form_Function" id="Form_Function" value="forum_subject_add">
                <input type="submit" name="button" id="button" value="新增看版主題" />
              </div>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
<br>
<!-- 計概討論區  新增主題，結束。 -->
