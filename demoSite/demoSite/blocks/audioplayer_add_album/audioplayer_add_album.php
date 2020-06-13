<?php
class Audioplayer_add_album_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Add Album Content";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		
		$albums = $CI->audioplayeralbum->where('user_id',$user->id)->get();
		$num_albums = (array)$albums;
		$first = count($num_albums);
		$first_album = ($first == 0)?'yes':'no';
		
		//View
        $output ='
				<h2 class="text-center">Create New Audio Album</h2>
						<div id="uploadForm" class="audiogallery-video-darker-bg">
							<form method="post" id="fors" style="">
								<input type="hidden" name="image" value="'.base_url('builderengine/public/img/audio_placeholder.png').'">
								<style>.control-label{color:#fff;}</style>
								<div class="form-group">
									<label class="control-label audiogallery-upload-album-label col-md-3 col-sm-3" for="categoryselection">Parent Album:</label>
									<div class="audiogallery-upload-album-padding col-md-7 col-sm-7">								
										<select class="form-control" id="parent_id" name="parent_id" data-parsley-required="true">';
											if($first_album == 'yes'){
												$output .='<option value="0">No Parent</option>';
											}
											else{											
												$output .='<option value="0">No Parent</option>';
												foreach($albums as $parent_album){
													$output .='<option value="'.$parent_album->id.'">'.str_replace('_',' ',$parent_album->name).'</option>';
												}
											}
										$output .='</select>
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label audiogallery-upload-album-label col-md-3 col-sm-3" for="fullname">Album Name:</label>
									<div class="audiogallery-upload-album-padding col-md-7 col-sm-7">
										<input class="form-control" type="text" id="name" name="name" placeholder="Album Name" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
								<label class="control-label audiogallery-upload-album-label col-md-3 col-sm-3" for="fullname">Album Status:</label>
									<div class="audiogallery-upload-album-padding col-md-7 col-sm-7">
										<select id="user-groups-select" name="status">
											<option value="public">Public</option>
											<option value="private">Private</option>
										</select>
									</div>
								</div>
								<input type="hidden" name="groups_allowed" value="Administrators,Members,Guests">
								<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="fullname"></label>
									<div class="col-md-7 col-sm-7">
										<button type="submit" class="btn btn-sm btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Create Album</button>
									</div>
								</div>
							</form>
						</div>
					</div>';

        return $output;
    }
}
?>