<div class="left" style="width:100%">
  <!doctype html>
  <html lang="en" class="fullscreen-bg">

  @include('includes.head')
  @section('title', 'Login')

  <body>
  	<!-- WRAPPER -->
  	<div id="wrapper">
  		<div class="vertical-align-wrap">
  			<div class="vertical-align-middle">
  				<div class="auth-box " style="width:30%;">
  					<div class="left" style="width:100%">
  						<div class="content">
  							<div class="header">
  								<p class="lead">Sign Up</p>
  								 @if(session()->has('message'))
  								<div class="alert alert-danger">
  									{{ session()->get('message') }}
  								</div>
  								@endif
  								</div>
  							<form action="/signup" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="signup-first_name" class="control-label sr-only">First Name</label>
                    <input type="text" name="first_name" id="signup-first_name" class="form-control" required placeholder="First Name">
                  </div>
                  <div class="form-group">
                    <label for="signup-last_name" class="control-label sr-only">Last Name</label>
                    <input type="text" name="last_name" id="signup-last_name" class="form-control" required placeholder="Last Name">
                  </div>
  								<div class="form-group">
  									<label for="signup-email" class="control-label sr-only">Email</label>
  									<input type="text" name="email" id="signup-email" class="form-control" required placeholder="Email Address">
  								</div>
  								<div class="form-group">
  									<label for="signup-password" class="control-label sr-only">Password</label>
  									<input type="password" name="password" id="signup-password" class="form-control" required placeholder="Password">
  			 					</div>
                  <div class="form-group">
  									<label for="signup-confirm_password" class="control-label sr-only">Confirm Password</label>
  									<input type="password" name="confirm_password" id="signup-confirm_password" class="form-control" required placeholder="Confirm Password">
  			 					</div>
  								<button type="submit" class="btn btn-success">Submit</button>
                  <a class="btn btn-secondary" href="/login" role="button">Cancel</a>
                </form>
  						</div>
  					</div>

  					<div class="clearfix"></div>
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- END WRAPPER -->

  </body>
  </html>
