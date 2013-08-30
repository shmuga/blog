<? $this->header();?>
<div class="container">
	<div class="row">
		<div class="span6 offset3 form">
			<form class="form-horizontal" action="index.php?r=Site/search" method="post">
		    	<div class="control-group">
		    		<label class="control-label" for="inputEmail">Search text</label>
		    			<div class="controls">
		    				<input type="text" id="inputEmail" name="search" placeholder="text for search">
		    				<button type="submit" class="btn">Search</button>
		    			</div>
		    	</div>		   		   
		    </form>
		</div>
	</div>
</div>