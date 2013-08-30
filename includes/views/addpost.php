<? $this->headerAdmin();?>
<script type="text/javascript" src="plugins/ckeditor/ckeditor.js"></script>
<div class="container">
	<form class="form-horizontal" action="index.php?r=Admin/addPost" method="post">	
		<div class="row">		
			<div class="span10">
				<div class="control-group">
					<label class="control-label">Title</label>
					<div class="controls">
						<input class="span9 offset1" type="text" id="title" name="title">	
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Theme</label>
					<div class="controls">
						<select name="theme_name">
							<?								
								foreach ($theme as $key => $value) {
									$output = "<option value='" . $value['name'] .  "'>" . $value['name'] . "</option>";
									echo $output;
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Text</label>
					<div class="controls">
						<textarea name="text"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button class="btn btn-block btn-info" >Save</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
    CKEDITOR.replace('text',{
    filebrowserUploadUrl: 'index.php?r=Upload/index'
});
</script>


<? $this->footer();?>