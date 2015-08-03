
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>QSSAM - Admin</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->

		{{HTML::style('css/bootstrap.min.css')}}

{{HTML::style('font-awesome/4.2.0/css/font-awesome.min.css')}}
{{HTML::style('fonts/fonts.googleapis.com.css')}}

{{HTML::style('css/ace.min.css')}}	
{{HTML::style('css/chosen.min.css')}}	
{{HTML::style('css/datepicker.min.css')}}	
{{HTML::style('css/tabletools.css')}}	


{{HTML::script('js/jquery.2.1.1.min.js')}}
{{HTML::script('js/ace-extra.min.js')}}

{{HTML::script('js/bootstrap.min.js')}}
{{HTML::script('js/ace-elements.min.js')}}
{{HTML::script('js/ace.min.js')}}	
{{HTML::script('js/jquery.dataTables.min.js')}}
{{HTML::script('js/jquery.dataTables.bootstrap.min.js')}}
{{HTML::script('js/bootbox.min.js')}}
{{HTML::script('js/chosen.jquery.min.js')}}
{{HTML::script('js/bootstrap-wysiwyg.min.js')}}
{{HTML::script('js/jquery.hotkeys.min.js')}}
{{HTML::script('js/bootstrap-datepicker.min.js')}}
{{HTML::script('js/dataTables.tableTools.min.js')}}


{{HTML::script('js/chartjs/Chart.js')}}





	   







		<!-- page specific plugin styles -->

		<!-- text fonts -->
	

		<!-- ace styles -->

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

	

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!--<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Ace Admin
						</small>
					</a>
				</div>-->

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						


						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">{{Alertas::where("personal_id_admin","=",Auth::user()->id)->where("tipo","=","aadmin")->count()}}</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									Notificaciones
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										
										@foreach(Alertas::where("personal_id_admin","=",Auth::user()->id)->where("tipo","=","aadmin")->get() as $alerta)
										<li>
											<a href="{{URL::to('evidenciaadmin')}}">
												<!--<i class="btn btn-xs btn-primary fa fa-user"></i>-->
												{{$alerta->mensaje}}
												
											</a>
										</li>
										@endforeach
										

									

									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="{{URL::to('evidenciaadmin/eliminar')}}">
										Borrar Notificaciones
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							
								<span class="user-info">
									<small>Bienvenido,</small>
									{{Auth::user()->nombre}}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								

								

								<li class="divider"></li>

								<li>
									<a href="{{URL::to('logout')}}">
										<i class="ace-icon fa fa-power-off"></i>
										Cerrar Sesión
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>


				<ul class="nav nav-list">

				@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "adminmantencion") || (Auth::user()->perfil == "adminprevencion") || (Auth::user()->perfil == "admingerente") || (Auth::user()->perfil == "adminfacturacion"))
					<li class="">
						<a href="{{URL::to('portal')}}"> 
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Portal </span>
						</a>

						<b class="arrow"></b>
					</li>

					@endif


@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "admingerente") || (Auth::user()->perfil == "adminfacturacion"))

					<li class="" id="bibliotecaactive">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text">
								Biblioteca
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="" id="categoriaactive">
								<a href="{{URL::to('categoria')}}" >
									<i class="menu-icon fa fa-caret-right"></i>

									Categoria
									
								</a>

								<b class="arrow"></b>

								
							</li>

							<li class="" id="archivoactive">
								<a href="{{URL::to('archivo')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Archivo
								</a>

								<b class="arrow"></b>
							</li>


							<li class="" id="obsoletoactive">
								<a href="{{URL::to('archivo/archivoobsoleto')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Obsoleto
								</a>

								<b class="arrow"></b>
							</li>

							<!--<li class="">
								<a href="elements.html">
									<i class="menu-icon fa fa-caret-right"></i>
									
								</a>

								<b class="arrow"></b>
							</li>
							-->

							
							
						</ul>
					</li>

				@endif



@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "adminmantencion") || (Auth::user()->perfil == "adminprevencion") || (Auth::user()->perfil == "admingerente") || (Auth::user()->perfil == "adminfacturacion"))

					<li class="" id="actividadactive">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Actividad
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="" id="programadaactive">
								<a href="{{URL::to('actividadprogramada')}}">
									<i class="menu-icon fa fa-caret-right"></i>

									Programada
									
								</a>

								<b class="arrow"></b>

								
							</li>

							<li class="" id="noprogramadaactive">
								<a href="{{URL::to('actividadnoprogramada')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									No Programada
								</a>

								<b class="arrow"></b>
							</li>

						

							

							
							
						</ul>
					</li>
@endif


				@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "adminmantencion") || (Auth::user()->perfil == "adminprevencion") || (Auth::user()->perfil == "admingerente") || (Auth::user()->perfil == "adminfacturacion"))

					<li class="" id="pacactive">
						<a href="{{URL::to('evidenciaadmin')}}">
							<i class="menu-icon fa fa-archive"></i>
							<span class="menu-text"> Evidencia </span>

							
						</a>

						

					</li>

					@endif


									@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "adminmantencion") || (Auth::user()->perfil == "adminprevencion") || (Auth::user()->perfil == "admingerente") || (Auth::user()->perfil == "adminfacturacion"))


					<li class="" id="pacactive">
						<a href="{{URL::to('pac')}}">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> PAC </span>

							
						</a>

						

					</li>

					@endif



				@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "admingerente") || (Auth::user()->perfil == "adminfacturacion"))

					<li class="" id="kpiactive">
						<a href="{{URL::to('kpi')}}">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> KPI </span>

							
						</a>

					

					</li>

					@endif

@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "admingerente"))


					<li class="" id="personalactive">
						<a href="{{URL::to('personal')}}">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Personal </span>

							
						</a>

					</li>
	@endif

				
				
				
@if((Auth::user()->perfil == "admin")  || (Auth::user()->perfil == "adminprevencion") || (Auth::user()->perfil == "admingerente"))

					<li class="" id="matrizactive">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tag"></i>
							<span class="menu-text"> Matriz</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="" id="matrizmatrizactive">
								<a href="{{URL::to('matriz')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Matriz
								</a>

								<b class="arrow"></b>
							</li>

							<li class="" id="matrizactividadactive">
								<a href="{{URL::to('matrizActividad')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Actividad
								</a>

								<b class="arrow"></b>
							</li>

							<li class="" id="matrizriesgoactive">
								<a href="{{URL::to('matrizRiesgo')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Riesgo
								</a>

								<b class="arrow"></b>
							</li>

							<li class="" id="matrizpeligroactive">
								<a href="{{URL::to('matrizPeligro')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Peligro
								</a>

								<b class="arrow"></b>
							</li>

							<li class="" id="matrizleyactive">
								<a href="{{URL::to('matrizLey')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Ley
								</a>

								<b class="arrow"></b>
							</li>

							<li class="" id="consecuenciaactive">
								<a href="{{URL::to('clasificacion')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Clasificacion
								</a>

								<b class="arrow"></b>
							</li>

							<li class="" id="criterioactive">
								<a href="{{URL::to('criterio')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Criterio
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>
@endif


@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "adminmantencion") || (Auth::user()->perfil == "adminprevencion") || (Auth::user()->perfil == "admingerente"))

					<li class="" id="noticiaactive">
						<a href="{{URL::to('noticia')}}">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Noticia </span>
						</a>
					</li>
@endif


@if((Auth::user()->perfil == "admin")  || (Auth::user()->perfil == "adminprevencion") || (Auth::user()->perfil == "admingerente"))

					<li class="" id="medicaactive">
						<a href="{{URL::to('medica')}}">
							<i class="menu-icon fa fa-ambulance"></i>
							<span class="menu-text"> Atencion Medica </span>
						</a>
					</li>
@endif

					

@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "adminmantencion")  || (Auth::user()->perfil == "admingerente"))

					<li class="" id="mantencionactive">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-truck"></i>
							<span class="menu-text">Mantención </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>


						<ul class="submenu">
							<li class="" id="vehiculoactive">
								<a href="{{URL::to('vehiculo')}}" >
									<i class="menu-icon fa fa-caret-right"></i>

									Vehiculo
									
								</a>

								<b class="arrow"></b>

								
							</li>

							<!--<li class="" id="mantencionactive">
								<a href="{{URL::to('mantencion')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Ultima Mantencion
								</a>

								<b class="arrow"></b>
							</li>
							-->
						</ul>
					</li>
@endif			


@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "admingerente"))
<!--
					<li class="" id="bodegaactive">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-certificate"></i>
							<span class="menu-text">Bodega </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>


						<ul class="submenu">
							<li class="" id="productoactive">
								<a href="{{URL::to('producto')}}" >
									<i class="menu-icon fa fa-caret-right"></i>

									Producto
									
								</a>

								<b class="arrow"></b>

								
							</li>

							<li class="" id="transaccionactive">
								<a href="{{URL::to('productotransaccion')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Transaccion
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					-->
@endif



@if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "admingerente"))

					<li class="" id="informeactive">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-line-chart"></i>
							<span class="menu-text">Informes </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>


							<ul class="submenu">
							
							<li class="" id="informeactive">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-line-chart"></i>
							<span class="menu-text">Evidencias </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>


								<ul class="submenu">
									<li class="" id="informeevidenciaactive">
										<a href="{{URL::to('informeevidencia')}}" >
											<i class="menu-icon fa fa-caret-right"></i>

											Mensual
											
										</a>

										<b class="arrow"></b>

										
									</li>

									
								</ul>
						</li>
						</ul>


						<ul class="submenu">
							<li class="" id="informeactive">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-line-chart"></i>
							<span class="menu-text">Mantencion </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>


						<ul class="submenu">
							<li class="" id="informeevidenciaactive">
								<a href="{{URL::to('informemantencionmensual')}}" >
									<i class="menu-icon fa fa-caret-right"></i>

									Mensual
									
								</a>

								<b class="arrow"></b>

								
							</li>

							<li class="" id="informemantencionactive">
								<a href="{{URL::to('informemantencionanual')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Anual
								</a>

								<b class="arrow"></b>
							</li>

							<li class="" id="informevehiculoactive">
								<a href="{{URL::to('informemantencionvehiculo')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Vehiculo
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					</ul>


						</ul>
					</li>
@endif




				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					
					</div>

					<div class="page-content">
						

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								@yield("contenido")

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">QSSAM</span>
							Application &copy; 2015 -
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		


	

		<!-- inline scripts related to this page -->
	</body>
</html>


