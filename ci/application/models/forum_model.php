<?php
class Forum_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_forum_group($group_id = FALSE)  /// 獲得"討論區群組"分類, e.g. 交大計概課程討論區, 99學年度課程討論區
    {
        $this->db->from('forum_group_Tab');
        if($group_id !== FALSE)
        {
            $this->db->where('forum_group_id', $group_id); 
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_forum_board($board_id = FALSE)  /// 獲得"看版"分類, e.g. 初學者討論區, 進階學習討論區
    {
        $this->db->from('forum_board_Tab');
        if($board_id !== FALSE)
        {
            $this->db->where('forum_board_id', $board_id); 
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_forum_subject($board_id, $subject_id = FALSE)   /// 獲得"主題"分類
    {
        $this->db->from('forum_subject_Tab');
        $this->db->where('forum_board_id',$board_id);
        if($subject_id !== FALSE)
        {
            $this->db->where('forum_subject_id',$subject_id);
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_forum_title($board_id, $subject_id = FALSE) /// 獲得"文章標題", 可根據subject_id參數來篩選符合該主題的文章
    {
        $this->db->select(array('forum_article_title','forum_article_time','forum_poster_email'));
        $this->db->from('forum_article_Tab');
        $this->db->where('forum_board_id',$board_id);
        if($subject_id !== FALSE)
        {
            $this->db->where('forum_subject_id',$subject_id);
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_forum_article($article_id)    /// 獲得文章內容
    {
        $this->db->from('forum_article_Tab');
        $this->db->where('forum_article_id', $article_id); 
        $query = $this->db->get();

        return $query->result_array();
    }
}
