<!-- 計概討論區，開始。 -->
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
        <?php
            if($forum_board['forum_group_id'] === $forum_group['forum_group_id'])
            {
        ?>
                <tr>
                    <td class="cfont_1" bgcolor="#E2EFFF">
                    <!-- 條列看版，開始。 -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <!-- 看版名稱，開始。 -->
                            <tr>
                                <td class="cfont_1" colspan="2"><?php echo anchor('page/forum_list_article/'.$forum_board['forum_board_id'], $forum_board['forum_board_title']); ?></td>
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
        <?php
            }
        ?>
    <?php endforeach ?>
            </table>
        </td>
    </tr>
</table>
<br>
<?php endforeach ?>
<!-- 計概討論區，結束。 -->
