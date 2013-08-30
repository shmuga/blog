<? $this->headerAdmin(); ?>
<div class="container">
	<div class="row">
		<div class="span10 offset1">
			<form class="form-horizontal" action="index.php?r=Admin/topics" method="post">
				<div class="control-group" align="center">					
					<input type="text" name="topic" placeholder="Input theme name...">
					<button class="btn btn-primary">Add Topic</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row">

		<div class="span10 offset1">
			<? 
				foreach ($theme as $key => $value) 
				{
				//showing all post which have show=1
					$output = "<div class='topic_edit'>";					
					$output .= $value['name'];								
					$output .= "<a class='topic_delete' href='index.php?r=Admin/deleteTopic&id=" . $value['id'] 
							. "'<span class='fui-cross'>X</span></a>";
					$output .= "</div>";									
					echo $output;
				//
				}
			?>
		</div>
	</div>
</div>
<? $this->footer();?>