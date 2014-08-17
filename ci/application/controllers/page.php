<?php
class Page extends CI_Controller {

    public function index()
    {

        $this->load->view('templates/header');
        $this->load->view('main');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function member()
    {

        $this->load->view('templates/header');
        $this->load->view('member');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function course()
    {

        $this->load->view('templates/header');
        $this->load->view('course');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function forum()
    {

        $this->load->model('forum_model');           /// Load model

        $data['forum_group_item'] = $this->forum_model->get_forum_group();
        $data['forum_board_item'] = $this->forum_model->get_forum_board();
        $data['title'] = '計概討論區';

        $this->load->view('templates/header');
        $this->load->view('templates/title',$data);
        $this->load->view('forum',$data);
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function forum_list_article($forum_board_id = FALSE,$forum_subject_id = FALSE)
    {
        $data['forum_board_id'] = $forum_board_id;
        $data['forum_subject_id'] = $forum_subject_id;
        $data['title'] = '計概討論區';

        if($forum_board_id === FALSE)   /// 若沒有board資訊，跳回forum頁面
        {
            redirect('page/forum', 'location', 301);
        }

        /// Load model
        $this->load->model('forum_model');
        $this->load->model('account_model');

        $data['forum_board_item'] = $this->forum_model->get_forum_board($forum_board_id);   /// 獲得該看版資訊
        $data['forum_group_item'] = $this->forum_model->get_forum_group($data['forum_board_item'][0]['forum_group_id']);    /// 獲得該討論區資訊
        $data['forum_subject_item'] = $this->forum_model->get_forum_subject($forum_board_id);   /// 獲得主題列表

        $data['feedback_is_bm'] = $this->account_model->is_bm($data['forum_board_item'][0]['forum_board_manager']);  /// 檢查是否為版主
        
        if($forum_subject_id !== FALSE) /// 篩選特定主題 (subject)
        {
            $forum_subject_selected = $this->forum_model->get_forum_subject($forum_board_id,$forum_subject_id);
            if(count($forum_subject_selected) === 0)    /// 沒有該主題
            {
                redirect('page/forum', '', 301);
            }
            else{
                $data['forum_subject_title'] = $forum_subject_selected[0]['forum_subject_title'];   /// 得到該主題名稱 (subject title)
                $data['forum_article_item'] = $this->forum_model->get_forum_title($forum_board_id,$forum_subject_id);   /// 列出該主題的文章
            }
        }
        else    /// 列出所有文章，不篩選主題
        {
            $data['forum_article_item'] = $this->forum_model->get_forum_title($forum_board_id); /// 列出所有文章
        }
        
        $this->load->view('templates/header');
        $this->load->view('templates/title',$data);
        $this->load->view('forum_list_article',$data);
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');
    }

    public function forum_article_add($forum_board_id = FALSE, $forum_subject_id = FALSE, $forum_article_id = FALSE)
    {
        $data['forum_board_id'] = $forum_board_id;
        $data['forum_subject_id'] = $forum_subject_id;
        $data['forum_article_id'] = $forum_article_id;
        $data['title'] = '計概討論區';

        if($forum_board_id === FALSE)
        {
            redirect('page/forum', 'location', 301);
        }

        /// Load model
        $this->load->model('forum_model');           /// Load model
        $this->load->model('account_model');           /// Load model

        $data['forum_board_item'] = $this->forum_model->get_forum_board($forum_board_id);   /// 獲得該看版資訊
        $data['forum_group_item'] = $this->forum_model->get_forum_group($data['forum_board_item'][0]['forum_group_id']);    /// 獲得該討論區資訊
        $data['forum_board_title'] = $data['forum_board_item'][0]['forum_board_title'];    /// 獲得該討論區名稱
        $data['forum_group_title'] = $data['forum_group_item'][0]['forum_group_title'];    /// 獲得該討論區名稱

        $data['feedback_is_bm'] = $this->account_model->is_bm($data['forum_board_item'][0]['forum_board_manager']);  // 檢查是否為版主
        if($forum_subject_id !== FALSE AND $forum_subject_id != 0) /// 篩選特定主題
        {
            $forum_subject_selected = $this->forum_model->get_forum_subject($forum_board_id,$forum_subject_id);
            if(count($forum_subject_selected) === 0)    /// 沒有該主題
            {
                redirect('page/forum', '', 301);
            }
            else{
                $data['forum_subject_title'] = $forum_subject_selected[0]['forum_subject_title'];   /// 得到該主題名稱 (subject title)
            }
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Form_Title','','required');
        $this->form_validation->set_rules('Form_Content','','required');
        $this->form_validation->set_rules('Form_Board_ID','','required');
        #$this->form_validation->set_rules('Form_Subject_ID','','required');
        #$this->form_validation->set_rules('Form_Article_ID','','required');
        #$this->form_validation->set_rules('Form_Function','','required');

        if($this->form_validation->run() == FALSE)
        {
            // do nothing ?
            echo 'Do nothing?';
        }
        else
        {
            // insert
            echo 'Insert to table!!!';
        }

        /// url : index.php/page/forum_article_add/[forum_board_id]/[forum_subject_id]

        $this->load->view('templates/header');
        $this->load->view('templates/title',$data);
        $this->load->view('forum_article_add',$data);
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function forum_subject_add($forum_board_id = FALSE)
    {
        if($forum_board_id === FALSE)
        {
            redirect('page/forum', 'location', 301);
        }

        $data['forum_board_id'] = $forum_board_id;
        $data['title'] = '計概討論區';

        /// Load model
        $this->load->model('forum_model');           /// Load model
        $this->load->model('account_model');           /// Load model

        $data['forum_board_item'] = $this->forum_model->get_forum_board($forum_board_id);   /// 獲得該看版資訊
        $data['forum_group_item'] = $this->forum_model->get_forum_group($data['forum_board_item'][0]['forum_group_id']);    /// 獲得該討論區資訊
        $data['forum_board_title'] = $data['forum_board_item'][0]['forum_board_title'];    /// 獲得該討論區名稱
        $data['forum_group_title'] = $data['forum_group_item'][0]['forum_group_title'];    /// 獲得該討論區名稱

        $data['feedback_is_bm'] = $this->account_model->is_bm($data['forum_board_item'][0]['forum_board_manager']);  // 檢查是否為版主

        $this->load->helper('form');
        $this->load->library('form_validation');

        #$this->form_validation->set_rules('Form_Title','','required');
        #$this->form_validation->set_rules('Form_Content','','required');
        #$this->form_validation->set_rules('Form_Board_ID','','required');
        #$this->form_validation->set_rules('Form_Subject_ID','','required');
        #$this->form_validation->set_rules('Form_Article_ID','','required');
        #$this->form_validation->set_rules('Form_Function','','required');

        if($this->form_validation->run() == FALSE)
        {
            // do nothing ?
        }
        else
        {
            // insert
        }

        /// url : index.php/page/forum_article_add/[forum_board_id]/[forum_subject_id]

        $this->load->view('templates/header');
        $this->load->view('templates/title',$data);
        $this->load->view('forum_subject_add',$data);
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');
    }

    public function forum_subject_modify($forum_board_id = FALSE, $forum_subject_id = FALSE)
    {
        if($forum_board_id === FALSE OR $forum_subject_id === FALSE)
        {
            redirect('page/forum', 'location', 301);
        }

        $data['forum_board_id'] = $forum_board_id;
        $data['forum_subject_id'] = $forum_subject_id;
        $data['title'] = '計概討論區';

        /// Load model
        $this->load->model('forum_model');           /// Load model
        $this->load->model('account_model');           /// Load model

        $data['forum_board_item'] = $this->forum_model->get_forum_board($forum_board_id);   /// 獲得該看版資訊
        $data['forum_group_item'] = $this->forum_model->get_forum_group($data['forum_board_item'][0]['forum_group_id']);    /// 獲得該討論區資訊
        $data['forum_board_title'] = $data['forum_board_item'][0]['forum_board_title'];    /// 獲得該討論區名稱
        $data['forum_group_title'] = $data['forum_group_item'][0]['forum_group_title'];    /// 獲得該討論區名稱

        $forum_subject_selected = $this->forum_model->get_forum_subject($forum_board_id,$forum_subject_id);
        if(count($forum_subject_selected) === 0)    /// 沒有該主題
        {
            redirect('page/forum', '', 301);
        }
        $data['forum_subject_selected'] = $forum_subject_selected[0];

        $data['feedback_is_bm'] = $this->account_model->is_bm($data['forum_board_item'][0]['forum_board_manager']);  // 檢查是否為版主

        $this->load->helper('form');
        $this->load->library('form_validation');

        #$this->form_validation->set_rules('Form_Title','','required');
        #$this->form_validation->set_rules('Form_Content','','required');
        #$this->form_validation->set_rules('Form_Board_ID','','required');
        #$this->form_validation->set_rules('Form_Subject_ID','','required');
        #$this->form_validation->set_rules('Form_Article_ID','','required');
        #$this->form_validation->set_rules('Form_Function','','required');

        if($this->form_validation->run() == FALSE)
        {
            // do nothing ?
        }
        else
        {
            // insert
        }

        /// url : index.php/page/forum_article_add/[forum_board_id]/[forum_subject_id]

        $this->load->view('templates/header');
        $this->load->view('templates/title',$data);
        $this->load->view('forum_subject_modify',$data);
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');
    }

    public function links()
    {

        $this->load->view('templates/header');
        $this->load->view('links');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function download()
    {

        $this->load->view('templates/header');
        $this->load->view('download');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function how_to_login()
    {

        $this->load->view('templates/header');
        $this->load->view('how_to_login');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
