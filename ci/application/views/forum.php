<!-- 計概討論區，開始。 -->
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
<?php foreach ($forum_group_item as $forum_group): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> <?PHP echo $forum_group['forum_group_title']; ?></td>
    <tr>
    <?PHP
    if (strlen($forum_group['forum_group_memo']) > 0){
    ?>
    <tr>
        <td align="right">
            <table width="98%" border="0" cellspacing="1" cellpadding="3">
                <tr>
                    <td class="cfont_1"><font color="#999999"><?PHP echo $forum_group['forum_group_memo']; ?></font></td>
                </tr>
            </table>
        </td>
    <tr>
    <?PHP
    }
    ?>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr>
                    <td bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">看版列表</font></td>
                </tr>
    <?php foreach ($forum_board_item as $forum_board): ?>
                <tr>
                    <td class="cfont_1" bgcolor="#E2EFFF">
                    <!-- 條列看版，開始。 -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <!-- 看版名稱，開始。 -->
                            <tr>
                                <td class="cfont_1" colspan="2"><a><?php echo $forum_board['forum_board_title']; ?></a></td>
                            </tr>
                            <!-- 看版名稱，結束。 -->
                            <!-- 看版資訊，開始。 -->
                            <tr>
                                <td width="20"></td>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <!-- 看版說明，開始。 -->
                                        <tr>
                                            <td class="sfont_1" colspan="2"><?PHP echo $forum_board['forum_board_memo']; ?></td>
                                        </tr>
                                        <!-- 看版說明，結束。 -->
                                        <!-- 版主資訊，開始。 -->
                                        <tr>
                                            <td class="sfont_1" width="40" valign="top">版主：</td>
                                            <td class="sfont_1">
                                            <?php
                                                $bm_array = array_unique(explode("##", $forum_board['forum_board_manager']));
                                                while(list($bm_key, $bm_value) = each($bm_array)){

                                                    if (strlen(trim($bm_value)) > 0){

                                                        $bm_value = str_replace("@", " AT ", $bm_value);
                                                        $bm_value = str_replace(".", " DOT ", $bm_value);
                                                        echo $bm_value." ";

                                                    }

                                                }
                                            ?>
                                            </td>
                                            </tr>
                                            <!-- 版主資訊，結束。 -->
                                        </table>
                                    </td>
                                </tr>
                                <!-- 看版資訊，結束。 -->
                            </table>
                            <!-- 條列看版，結束。 -->
                        </td>
                    </tr>
    <?php endforeach ?>
            </table>
        </td>
    </tr>
</table>
<br>
<?php endforeach ?>
<!-- 計概討論區，結束。 -->
