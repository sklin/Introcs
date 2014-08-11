<?php
class Forum_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_forum_group()
    {
        $query = $this->db->get('forum_group_Tab');
        return $query->result_array();
    }

    public function get_forum_board($group_id = FALSE)
    {
        $this->db->from('forum_board_Tab');
        if($group_id !== FALSE)
        {
            $this->db->where('forum_group_id', $group_id); 
        }
        $this->db->order_by("forum_board_title", "asc"); 
        $query = $this->db->get();

        return $query->result_array();
    }
}
