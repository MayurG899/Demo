<?php
class Videotube_upload_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Video Upload";
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
        $CI->load->module('videotube');
		$num_albums = $CI->videotubealbum->where('user_id',$user->id)->count();
		$albums = $CI->videotubealbum->where('user_id',$user->id)->get();
		
		//View
		$output ='<div class="row">	
						<h2 class="text-center">Upload New Video</h2>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<form id="upload" class="upload" method="post" action="'.base_url('videotube/upload_video').'" enctype="multipart/form-data">
								<div id="drop">
									Drop Here
									<a>Browse</a>
									<input type="file" name="upl"/>
								</div>
								<ul>
									<!-- The file uploads will be shown here -->
								</ul>
							</form>
						</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div id="uploadForm" class="video-night-bg" style="display:none;">';
							if($num_albums > 0){
								$output .='<form method="post" id="fors" style="">';
							}
							$output .='<input id="uploadedFile" type="hidden" name="media_file" >
								<style>.control-label{color:#fff;}</style>
								<div class="form-group">';
								if($num_albums > 0){
									$disabled = '';
									$output .='<label class="control-label video-upload-album-label col-md-2 col-sm-2" for="fullname">Select Album:</label>
									<div class="video-upload-album-padding col-md-10 col-sm-10">
											<select name="album_id" style="width:100%;appearance:select;" required>
												<option value="" required>Select Album</option>';
												foreach($albums as $album){
													$output .='<option value="'.$album->id.'">'.str_replace('_',' ',$album->name).'</option>';
												}
										$output .='</select>
									</div>';
								}else{
									$disabled = 'disabled';
									$output .='<label class="control-label video-upload-album-label col-md-2 col-sm-2" for="fullname"></label>
									<div class="video-upload-album-padding col-md-10 col-sm-10">
										<a href="'.base_url('videotube/add_show/first').'" class="btn btn-md video-btn-danger animated infinite flash" style="margin-bottom:15px;animation-duration:1.5s"><i class="fa fa-cloud left"></i>Click here to Create a Show</a>
									</div>';
								}
								$output .='</div>							
								<div class="form-group">
									<label class="control-label video-upload-album-label col-md-2 col-sm-2" for="fullname">Video Title:</label>
									<div class="video-upload-album-padding col-md-10 col-sm-10">
										<input class="form-control" type="text" id="title" name="title" placeholder="Video title" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
								<label class="control-label video-upload-album-label col-md-2 col-sm-2" for="fullname">Description:</label>
									<div class="video-upload-album-padding col-md-10 col-sm-10">
										<script type="text/javascript" src="'.base_url('builderengine/public/ckeditor/ckeditor.js').'"></script>
										<textarea class="textarea form-control" name="text" id="cke" placeholder="Post text" rows="20"></textarea>
										<script>CKEDITOR.replace( "text");</script>
									</div>
								</div>
								<div class="form-group">
								<label class="control-label video-upload-album-label col-md-2 col-sm-2" for="fullname">Tags:</label>
									<div class="video-upload-album-padding col-md-10 col-sm-10">
										<input class="form-control" type="text" id="tags" name="tags" placeholder="Tags (comma separated)" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<input type="hidden" name="groups_allowed" value="Administrators,Members,Guests">
									<input type="hidden" name="status" value="Public">
									<!--
								   <label class="control-label video-upload-album-label col-md-2 col-sm-2" for="status">Video Status:</label>
									<div class="video-upload-album-padding col-md-10 col-sm-10">
										<select id="user-groups-select" name="status">
											<option value="public">Public</option>
											<option value="private">Private</option>
										</select>
									</div>
									-->
									<label class="control-label video-upload-album-label col-md-2 col-sm-2" for="fullname">Allow Comments:</label>
									<div class="video-upload-album-padding col-md-10 col-sm-10">
										<input type="checkbox" name="comments_allowed" style="appearance:checkbox;-webkit-appearance:checkbox;">
									</div>
								</div>				
								<div class="form-group">
								<label class="control-label col-md-12 col-sm-12" for="fullname">&nbsp;</label>
									<div class="col-md-2 col-sm-2">
									</div>
									<div class="col-md-10 col-sm-10">
										<button type="submit" class="btn btn-sm btn-primary '.$disabled.'" name="submit"><i class="fa fa-floppy-o"></i> Publish Video</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
        <hr />';

        return $output;
    }
}
?>