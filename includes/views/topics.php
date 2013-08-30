<? $this->header(); ?>
<div class="container">
	<div class="row">
		<div class="span10 offset1">
			<? 
				$count=1;
				foreach ($theme as $key => $value) 
				{
				//showing all post which have show=1
					
					$output = "<div class='topic_edit' align='center'>";					
					$output .= "<a class='btn btn-block btn-inverse' href='index.php?r=Site/theme&theme_id=" 
							. $value['id'] . "'>"
							. $count . ". " . $value['name'] . "</a>";
					// $output .= $value['name'];												
					$output .= "</a>";
					$output .= "</div>";													
					echo $output;
					$count++;
				//
				}
			?>
		</div>
	</div>
</div>
<? $this->footer();?>



