<? $this->headerAdmin();?>
<div class="container">
	<div class="row">
		<div class="span10 offset1">
			<a class="btn btn-block btn-primary" href="index.php?r=Admin/addPostIndex"?>New post</a>
			<? 
				foreach ($post as $key => $value) 
				{
				//showing all post which have show=1
					$output = "<div class='post_edit'>";
					$output .= "<a href='index.php?r=Admin/editPostIndex&post_id=" . $value['post_id'] . "'><span class='post_date'>";
					$output .= $value['date_created'] . "</span> &nbsp; &nbsp;" . $value['title'];			
					$output .= "</a>";
					$output .= "<a class='post_delete' href='index.php?r=Admin/deletePost&post_id=" . $value['post_id'] 
							. "'<span class='fui-cross'>X</span></a>";
					$output .= "</div>";
					
					// $output .= '<img class="edit_img" alt="Pensils" src="images/icons/Pensils@2x.png">';
					echo $output;
				//
				}
			?>
			<? echo $this->pagination('index.php?' . $controler);?>
		</div>
	</div>
</div>
<? $this->footer();?>