<? $this->header(); ?>
<div class="container">
	<div class="row">
		<div class="span10 offset1 form">
			<form class="form-horizontal" action="index.php?r=Admin/login" method="post">
		    	<div class="control-group">
		    		<label class="control-label" for="inputEmail">Login</label>
		    			<div class="controls">
		    				<input type="text" id="inputEmail" name="login" placeholder="Login">
		    			</div>
		    	</div>
		    	<div class="control-group">
		    		<label class="control-label" for="inputPassword">Password</label>
		    			<div class="controls">
		    				<input type="password" id="inputPassword" name="password" placeholder="Password">
		    			</div>
		    	</div>
		    	<div class="control-group">
		    		<div class="controls">				   
				    	<button type="submit" class="btn">Sign in</button>
		    		</div>
		    	</div>
		    </form>
		</div>
	</div>
</div>
<? $this->footer(); ?>