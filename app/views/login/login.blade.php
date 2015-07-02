
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login - Qssam</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

				{{HTML::style('css/bootstrap.min.css')}}
	{{HTML::style('css/bootstrap-responsive.min.css')}}
	{{HTML::style('css/font-awesome.min.css')}}
	{{HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300')}}
	{{HTML::style('css/ace.min.css')}}
	{{HTML::style('css/ace-responsive.min.css')}}
	{{HTML::style('css/ace-skins.min.css')}}
	{{HTML::style('css/chosen.css')}}
	{{HTML::style('css/jquery-ui-1.10.3.custom.min.css')}}
	{{HTML::style('js/TableTools/css/dataTables.tableTools.min.css')}}
	









{{HTML::script('js/jquery-2.0.3.min.js')}}
	{{HTML::script('js/bootstrap.min.js')}}
	{{HTML::script('js/ace-elements.min.js')}}
	{{HTML::script('js/ace.min.js')}}

{{ HTML::script('js/DataTables-1.10.4/media/js/jquery.dataTables.min.js') }} 
{{ HTML::script('js/chosen.jquery.min.js') }} 
{{ HTML::script('js/jquery.maskedinput.min.js') }} 
{{ HTML::script('js/TableTools/js/dataTables.tableTools.min.js') }} 
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body class="login-layout light-login">

	
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									{{ HTML::image('portal1/images/logo1.png', 'picture',array("width"=>"350") ) }}
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-coffee green"></i>
													Ingresa tu información
												</h4>

												<div class="space-6"></div>

											  	{{ Form::open(array('url' => 'login')) }}
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
															

																{{ Form::text('usuario','', array('class'=>"span12","placeholder"=>"Usuario")) }}
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																{{ Form::password('password', array('class'=>"span12","placeholder"=>"Password")) }}
																<i class="icon-lock"></i>
																
															</span>
														</label>

														<div class="space"></div>

														<div class="clearfix">
														

															
																
																 {{ Form::submit("Login", array('class'=>'width-35 pull-right btn btn-small btn-primary'))}}
																{{ Form::close() }}
														</div>
														@if (Session::has('mensaje_login'))
<span>{{ Session::get('mensaje_login') }}</span>
@endif
 

    

														<div class="space-4"></div>
													</fieldset>
												

												

											
											</div><!--/widget-main-->

										
										</div><!--/widget-body-->
									</div><!--/login-box-->

									
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->







	</body>

</html>


    
    
 
