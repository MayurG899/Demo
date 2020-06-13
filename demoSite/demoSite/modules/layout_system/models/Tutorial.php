<?php
class Tutorial extends DataMapper
{
    var $table = 'be_tutorials';

    public function create($data)
    {
        $this->name = $data['name'];
        $this->cancel = $data['cancel'];
        $this->display = $data['display'];
        $this->url = $data['url'];
        $this->save();

        $this->add_steps($data['steps']);
    }

    public function add_steps($steps)
    {
        foreach($steps as $step)
        {
            $new_step = new Tutorial_step();
            $new_step->tutorial_id = $this->id;
            $new_step->content = $step['content'];
            $new_step->position_type = $step['position_type'];
            $new_step->position = $step['position'];
            $new_step->highlighter = $step['highlighter'];
            $new_step->save();
        }
    }
}