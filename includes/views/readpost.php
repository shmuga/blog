<?$this->header();?>
<div class="container">
	<div class="row">
		<div class="span8 offset1">
			<? 
			//showing all the post with id
				$output = "<div class='post'>";
				$output .= "<p class='post_date'> post was created " . $post['date_created'] . " by Mark </p>";
				$output .= "<p>"
						. "<a class='post_title' href='index.php?r=Site/post&post_id=" . $post['post_id'] . "'"
						. "<h3 class='post_title'>" . $post['title'] . "</h3>"
						. "</a>"
						. "</p>";				
				$text=explode("***cut***",$post['text']);			
				$output .= "<p class='post_text'> " . $text[0] . $text[1] . "</p>";
				$output .= "</div>";
				echo $output;
			//
			?>		
		</div>
		<div class="span2" align="center">		
			<?				
				$output = "<div class='date hidden-phone'>";
				$day = date("D");
				$month = date("F");
				$year = date("Y");	
				$output .= "<span class='date_month'>" . $month . "</span><br>";
				$output .= "<span class='wspacer30'></span><span class='date_day'>" . $day . "</span><br>";
				$output .= "<span class='date_year'>" . $year . "</span><br>";
				$output .= "</div>";
				echo $output;			
			?>
			<?
			//showing all the list of themes
				echo "<div class='spacer'></div>";
				$output = "<div class='topic hidden-phone'>";
				$output .= "<p class='topic_title'>Topics: </p>";
				$output .="<ul>";
				foreach ($themes as $key => $value) {							
					$output .= "<li class='topic_name'>";
					$themes_model->id=$value['id'];
					$count=$themes_model->countPostsWithTheme();
					$output .= "<a href='index.php?r=Site/theme&theme_id=" 
							. $value['id'] . "'>"
							. $value['name'] . " (" . $count . ")"  . "</a></li>";
				}
				$output .= "</ul>";
				$output .= "</div>";
				echo $output;
			//
			?>

		</div>
	</div>
</div>
<? $this->footer();?>