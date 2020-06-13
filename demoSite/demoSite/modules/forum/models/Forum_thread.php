<?php
    class Forum_thread extends DataMapper 
    {
        var $table = 'be_forum_threads';
/*
        var $has_many = array(
            'forum_comment'
        );

        var $has_one = array(
            'forum_category'
        );
*/
        public function create($data)
        {
            $data = array_map('mysql_real_escape_string', $data);
            $this->title = $data['title'];
            $this->text = stripslashes(str_replace('\r\n', '',$data['text']));
            $this->image = $data['image'];
            $this->category_id = $data['category_id'];
            $this->groups_allowed = $data['groups_allowed'];
            $this->time_created = time();
            $this->user_id = $data['user_id'];
            $this->save();
        }

        public function create_comment($data)
        {
            $comment = new Comment();
            $comment->name = $data['name'];
            $comment->text = $data['text'];
            $comment->time_created = time();
            $comment->save();
            $this->save_comment($comment);
        }

        public function save_in_category($category_id)
        {
            $category = new Category($category_id);
            $this->save_category($category);
        }
    }
?>