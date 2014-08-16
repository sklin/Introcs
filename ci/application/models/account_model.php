<?php
class Account_model extends CI_Model {
    public function is_bm($bm, $user_email = FALSE){ // 檢查是否為版主
        if ($user_email !== FALSE)
        {
            $bm_array = array_unique(explode("##", $bm));
            if (in_array($user_email, $bm_array))
            {
                $feedback_is_bm = "Y";  // 已登入，版主
            }
            else
            {
                $feedback_is_bm = "N";  // 已登入，但非版主
            }
        }
        else
        {
            $feedback_is_bm = "N";  // 未登入
        }

        return $feedback_is_bm;     // 回傳結果、訊息
    }
}
