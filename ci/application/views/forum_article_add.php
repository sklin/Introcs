<?php
    /************************
    /* Set in controller :
    /*  $forum_board_id
    /*  $forum_subject_id
    /*
    /*  $Query_forum_board
    /*  $Query_forum_group
    /*  $forum_subject_id
    /*  $forum_article_id
    /************************/
    //$Query_forum_board;
    //$Query_forum_group;
    //$forum_subject_id = 0;
    //$forum_article_id = 0;
?>
<!-- 計概討論區  發表文章，開始。 -->
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
        <?PHP echo anchor('page/forum', $forum_group_title, 'class="link-class"'); ?> /
        <?PHP echo anchor('page/forum_list_article', $forum_board_title, 'class="link-class"'); ?> /
<?php
    if ($forum_subject_id > 0)
    {
        echo anchor('page/forum_list_article/', $forum_subject_title, 'class="link-class"') . "/";
    }

    #if ($forum_article_id == 0){ echo "發表文章"; } else { echo "回覆文章"; }
    echo "發表文章";
?>
        </td>
    </tr>
    <!-- 發表主題、文章，開始。 -->
    <tr>
        <td align="right">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="lfont_1" height="40"></td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- 發表主題、文章，結束。 -->
    <tr>
        <td align="center">
            <?php
                $attribute = array(
                            'name' => 'Form_Forum_Subject_Add',
                            'id' => 'Form_Forum_Subject_Add'
                            );
                $hidden = array(
                            'Form_Board_ID' => $forum_board_id,
                            'Form_Subject_ID' => $forum_subject_id,
                            'Form_Article_ID' => $forum_article_id
                            );
                $form_title = array(
                            'name' => 'Form_Title',
                            'type' => 'text',
                            'id' => 'Form_Title',
                            'size' => '70',
                            'maxlength' => '30',
                            'class' => 'form_1'
                            );
                if($forum_article_id !== FALSE)
                {
                    $form_title['value'] = $forum_article_title['forum_article_title'];
                }
                $form_content = array(
                            'name' => 'Form_Content',
                            'id' => 'Form_Content',
                            'cols' => '59',
                            'rows' => '30',
                            'class' => 'form_1'
                            );

            ?>
            <?php echo form_open('',$attribute,$hidden); ?>
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td bgcolor="#A4A4A4">
                            <table width="100%" border="0" cellspacing="1" cellpadding="3">
                                <tr>
                                    <td width="64" bgcolor="#95ACEC" class="cfont_1" align="center"><font color="#FFFFFF">文章標題</font><font color="#FFFFFF" class="sfont_1">*</font></td>
                                    <td bgcolor="#FFFFFF">
                                        <?php echo form_input($form_title); ?>
                                    </td>
                                </tr>
                                <tr>
                                <td align="center" valign="top" bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">文章內容</font><font color="#FFFFFF" class="sfont_1">*</font></td>
                                <td bgcolor="#FFFFFF"><?php echo form_textarea($form_content); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="cfont_1">
                            ## 注意：星號 * 為必填欄位
                        <?php if ($feedback_is_bm == "Y") {?>
                            <br><font color=\"red\">## 您是版主，得在 [文章內容] 中自行使用 HTML。</font>
                        <?php }?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="right"><br />
                            <button type="submit">發表文章</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<br>
<!-- 計概討論區  發表文章，結束。 -->

