<!doctype html>
<html lang="en" class="fullscreen-bg">

@include('includes.head')
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box " style="width:30%;">
					<div class="left" style="width:100%">
						<div class="content">
							<div class="header">
								<p class="lead">Login to your account</p>
								 @if(Session::has('error'))
										<div class="alert alert-danger">
											{{session('error')}}
										</div>
								 @endif
							</div>
							<form action="/login" method="post" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="text" name="email" id="signin-email" class="form-control" placeholder="Email Address">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="password" id="signin-password" class="form-control" placeholder="Password">
			 					</div>
								<button type="submit" class="btn btn-success">LOGIN</button>
								<br>
								<div class="bottom">
									<span class="helper-text"><a href="/signup">Signup</a></span>
								</div>
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
