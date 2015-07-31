<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Qssam Portal</title>
	
	<!-- core CSS -->
    
   
   {{HTML::style('portal1/css/bootstrap.min.css')}}
   {{HTML::style('portal1/css/font-awesome.min.css')}}
    {{HTML::style('portal1/css/animate.min.css')}}
    {{HTML::style('portal1/css/prettyPhoto.css')}}
    {{HTML::style('portal1/css/main.css')}}
    {{HTML::style('portal1/css/responsive.css')}}
    
    


    {{HTML::style('css/tabletools.css')}}
    {{HTML::style('portal1/css/datepicker.min.css')}}   





{{HTML::script('portal1/js/jquery.js')}}
{{HTML::script('portal1/js/bootstrap.min.js')}}
{{HTML::script('portal1/js/jquery.prettyPhoto.js')}}
{{HTML::script('portal1/js/jquery.isotope.min.js')}}

{{HTML::script('portal1/js/wow.min.js')}}


  {{HTML::script('portal1/js/jquery.dataTables.min.js')}}
{{HTML::script('portal1/js/jquery.dataTables.bootstrap.min.js')}}
{{HTML::script('js/dataTables.tableTools.min.js')}}

{{HTML::script('portal1/js/main.js')}}
{{HTML::script('portal1/js/bootstrap-datepicker.min.js')}}
{{HTML::script('portal1/js/ace.min.js')}}
{{HTML::script('portal1/js/bootbox.min.js')}}

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body class="homepage">

    <header id="header">
        

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{URL::to('portal')}}">{{ HTML::image('portal1/images/logo1.png', 'picture',array("width"=>"150") ) }} </a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li id="homeactive"><a href="{{URL::to('portal')}}"><i class="ace-icon fa fa-home icon-animated-bell"></i></a></li>
                        <li id="actividadactive"><a href="{{URL::to('misactividades')}}">Actividades</a></li>
                        <li id="matrizactive"><a href="{{URL::to('matrizportal')}}">Matriz</a></li>
                        <li id="biblioactive"><a href="{{URL::to('bibliotecaportal')}}">Biblioteca</a></li>
                     @if((Auth::user()->perfil == "usuariomantencion") ||  (Auth::user()->perfil == "admin"))   <li id="mantencionactive"><a href="{{URL::to('mantencionportal')}}">Mantencion</a></li> @endif
                       

                        <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-item.html">Blog Single</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="shortcodes.html">Shortcodes</a></li>
                            </ul>
                        </li>-->
                        @if((Auth::user()->perfil == "admin") || (Auth::user()->perfil == "adminprevencion") || (Auth::user()->perfil == "adminmantencion") || (Auth::user()->perfil == "admingerente"))
                         <li><a href="{{URL::to('/')}}">Administracion</a></li> 
                        @endif
                        @if (Auth::check())

                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                                <span class="">{{Alertas::where("personal_id","=",Auth::user()->id)->where("tipo","=","aportal")->count()}}</span>
                            </a>

                            <ul class="dropdown-menu">
                                

                                <li class="">
                                    <ul>
                                        
                                        @foreach(Alertas::where("personal_id","=",Auth::user()->id)->where("tipo","=","aportal")->get() as $alerta)
                                        <li>
                                            <a href="{{URL::to('misactividades')}}">
                                                
                                                {{"<b>".$alerta->personal->nombre."</b> ".$alerta->mensaje}}
                                                
                                            </a>
                                        </li>
                                        @endforeach
                                        

                                    

                                    </ul>
                                </li>

                                <li class="dropdown-footer">
                                    <a href="{{URL::to('evidenciaadmin/eliminarusuario')}}">
                                        Borrar Notificaciones
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        
                            <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle">{{Auth::user()->nombre}} </a>
                            <ul class="dropdown-menu">

                            <li>
                            <a href="{{URL::to('personal/cambiarclave')}}">Cambiar Clave</a>
                            </li> 
                            <li>
                            <a href="{{URL::to('logout')}}">Cerrar Sesión</a>
                            </li> 
                        
                        @endif                       
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->


    

    
    
@yield("contenido")
    

    


    

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2015 - QSSAM
                </div>
               
            </div>
        </div>
    </footer><!--/#footer-->


</body>
</html>