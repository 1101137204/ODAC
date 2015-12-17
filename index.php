<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
    <title>THUNDER點對點</title>
    <meta name="description" content="THUNDER點對點_悲慘專題第四集，馬的希望不要有第五集">
    <meta name="author" content="THUNDER點對點">
	
    <link rel="manifest" href="/android-chrome-manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Montserrat|Varela+Round' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script src="js/wow.min.js"></script>
      <script>
        new WOW().init();

      </script>
     <script src="js/sweetalert2.min.js"></script>
      <link rel="stylesheet" href="css/sweetalert2.css">
      <script src="js/pace.js"></script>  
      <link href="css/pace-theme-flash.min.css" rel="stylesheet" /> 
      
     <!-- <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-35086500-2', 'auto');
        ga('send', 'pageview');

      </script>  -->
  </head>
  
  <body>
      <div class="button-container" id="toggle">
        <span class="top"></span>
        <span class="middle"></span>
        <span class="bottom"></span>
      </div>
      <div class="overlay" id="overlay">
        <nav class="overlay-menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="signup.php">註冊</a></li>
            <li><a href="login.php">登入</a></li>
            <li><a data-scroll id="timer1" href="#timer">查詢</a></li>
            <li><a data-scroll id="maker1" href="#maker">開發人員</a></li>
          </ul>
        </nav>
      </div>
      <!-- Start page content -->
          <header class="container-fluid intro-lg  bkg">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
              <h3 id="supra" class="animated fadeInUp">點對點</h3>
              <h1 id="title" class="animated fadeInUp">Thunder</h1>
              <h3 id="sub" class="animated bounceIn">將重新定義<span >貨物傳輸的</span><span >最短時間</span></h3>
               <div class="divider divider-intro animated bounceIn"></div>
              <a data-scroll id="btn-intro" href="#timer" class="btn btn-custom animated fadeInUp">查詢時刻</a>
            </div>
          </header>
          <div class="expertise">
            <div class="row">
              <div class="col-lg-12">
                <h2 id="services" class="uppercase wow">提供的服務</h2>
                <div class="divider"></div>	
              </div>
            </div>
            <div class="container expertise">
                <div class="col-xs-10 col-xs-offset-2 col-md-10 col-centered">
                  <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 wow fadeIn">
                      <i class="fa fa-rocket fa-5x"></i>
                      <h4 class="uppercase">快速</h4>
                      <div class="divider-small"></div>
                      <p>突破以往動則2~3天的運送時間，將物品流動時間降到最低。</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 wow fadeIn">
                      <i class="fa fa-globe fa-5x"></i>
                      <h4 class="uppercase">環保</h4>
                      <div class="divider-small"></div>
                      <p>全程均使用大眾運輸工具，為我們的地球減少碳排放量！</p>       
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 wow fadeIn">
                      <i class="fa fa-check-square-o fa-5x"></i>
                      <h4 class="uppercase">方便</h4>
                      <div class="divider-small"></div>
                      <p>快去查看時刻表，並且輕易可查出今天幫您送貨的乘客！</p>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          
           <div class="expertise">

           <div class="row">
              <div class="col-lg-12">
                <h2 id="" class="uppercase wow">介紹影片</h2>
                <div class="divider"></div>	
              </div>
            </div>
            
            <div align="center" class="embed-responsive embed-responsive-16by9">
    <video  controls  class="embed-responsive-item">
        <source src="img/in_thunder.mp4" type=video/mp4>
    </video>
</div>
            
            </div>


            <div class="container-fluid recent-work">
              <div id="maker" class="col-xs-12 col-md-8 col-md-offset-2">
                <h3 class="text-center uppercase">開發人員</h3>
                <div class="divider"></div>
                <div class="row">
                  <div class="col-xs-12 col-md-6">
                    <div class="grid wow fadeInLeftSmall">
                      <a href="">
                        <figure class="grid-item">
                          <img src="img/eric.jpg" alt="Personal Brand"/>
                          <figcaption>
                            <h2>Eric</h2>
                            <p>Web Desing</p>
                          </figcaption>			
                        </figure>
                      </a>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="grid wow fadeInRightSmall">
                      <a href="" title="SuperHip">
                        <figure class="grid-item">
                          <img src="img/nan.jpg" alt="Superhip" />
                          <figcaption>
                            <h2>Nan</h2>
                            <p>Web Desing</p>
                          </figcaption>			
                        </figure>
                      </a>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="grid wow fadeInRightSmall">
                      <a href="" title="SuperHip">
                        <figure class="grid-item">
                          <img src="img/gh.jpg" alt="Superhip" />
                          <figcaption>
                            <h2>Alex</h2>
                            <p>後台管理</p>
                          </figcaption>     
                        </figure>
                      </a>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="grid wow fadeInRightSmall">
                      <a href="" title="SuperHip">
                        <figure class="grid-item">
                          <img src="img/door.jpg" alt="Superhip" />
                          <figcaption>
                            <h2>David</h2>
                            <p>郵件設置</p>
                          </figcaption>     
                        </figure>
                      </a>
                    </div>
                  </div>



                 <!-- <div class="col-xs-12 text-center">
                    <a href="portfolio.php" class="btn btn-custom">See all projects <span class="fa fa-chevron-right"></span></a>
                  </div> -->
                </div>
              </div>
          </div>


    
			<div id="timer" class="container-fluid timer ">
			  <h2 class="text-center uppercase">時刻表</h2>
			  <a class="btn btn-default btn-xl wow tada" onclick="callSouthDelivery()" style="visibility: visible; animation-name: tada;">南下</a>
			  <a class="btn btn-default btn-xl wow tada" onclick="callNorthDelivery()" style="visibility: visible; animation-name: tada;">北上</a>
			  <div class="divider"></div>
			  <div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				<!--    Hover Rows  -->
				  <div class="panel panel-default ">
					<div class="panel-body ">
					  <div class="table-responsive">
						<table id="tb" class="table table-hover">
						  <thead>
							<tr>
							  <th>班次</th>
							  <th>起點站</th>
							  <th>出發時間</th>
							  <th>終點站</th>
							  <th>抵達時間</th>
							  <th>可運送人數</th>
							</tr>
						  </thead>
						  <tbody> 
						  </tbody>
						</table>
					  </div>
					</div>
				  </div>
				  <!-- End  Hover Rows  -->
				</div>
			  </div>
			</div>
        <!-- Footer -->
        <footer>
          <ul class="list-inline social">
          <li><a href="https://twitter.com/" target="_blank" class="social-twitter"><i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></i></a></li>
            <li><a href="https://codepen.io/" target="_blank" class="social-codepen"><i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-codepen fa-stack-1x fa-inverse"></i></i></a></li>
          <li><a href="https://dribbble.com/" target="_blank" class="social-dribbble"><i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-dribbble fa-stack-1x fa-inverse"></i></i></a></li>
          <li><a href="mailto:gravity820305@gmail.com" class="social-mail"><i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></i></a></li>
        </ul>
            <p>Made with <span class="fa fa-heart animated pulse"></span> in KUAS MIS.</p>
          <p>&copy; 2015 Eric. All rights reserved.</p>
        </footer>	  
	
    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/smooth-scroll.js"></script>
    <script> smoothScroll.init();</script>
    <script src="js/menu.js"></script>

    <script type="text/javascript">

      function callSouthDelivery()
      {
        $.post("http://fs.mis.kuas.edu.tw/~s1101137249/delivery_API.php",
        {
          path: 'south'
        },
        function(data, status){
			if(status=='success'){
				var newRowContent =''+data;
				$('#tb tbody').empty();
				$("#tb tbody").append(newRowContent);
			}
            else{
				alert("error");
			}
        });
      }

      function callNorthDelivery()
      {
        $.post("http://fs.mis.kuas.edu.tw/~s1101137249/delivery_API.php",
        {
          path: 'north'
        },
        function(data, status){
            if(status=='success'){
				var newRowContent =''+data;
                $('#tb tbody').empty();
				$("#tb tbody").append(newRowContent);
			}
            else{
				alert("error");
            }
        });
      }
	  
	  function phone(obj) {
		swal({   
			title: '尚未登入!',   
			text: '你必須登入會員才能邀請!',   
			type: 'warning',   
			showCancelButton: true,   
			confirmButtonColor: '#3085d6',  
			cancelButtonColor: '#d33',  
			confirmButtonText: '好, 馬上登入!',   
			closeOnConfirm: false 
		}, function() {   
			document.location.href="login.php";
		});
	  }
	  
	  
  </script>
  </body>
</html>