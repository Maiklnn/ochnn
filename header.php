<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<link href="/css/content.css" rel="stylesheet" type="text/css">
<link href="/css/style_slider.css" rel="stylesheet" type="text/css">
<script src="/admin/func/js/jquery.js" type="text/javascript"></script>
<script src="/modules/js/top_slider.js" type="text/javascript"></script>
<?php echo $myrow0["head"].$head; ?>
<!--[if IE]>
  <link rel="stylesheet" href="/css/ie.css" type "text/css" media="screen">
<![endif]-->
<link rel="icon" href="/favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="keywords" content="<?php echo $myrow0["meta_k"]; ?>">
<meta name="description" content="<?php echo $myrow0["meta_d"]; ?>">
<title><?php echo $myrow0["title"]; ?></title>
</head>
<body>
<div id="pages">
		<div id="header">
				<div class="logo"></div>
				<ul class = 'menu'>
					<?php
						$result_s = mysqli_query($db,"SELECT id,name,links FROM pages WHERE enabled=1 and parent = 7 ORDER BY namber");
						$myrow_s = mysqli_fetch_array($result_s); 
						if ($myrow_s > 0 ){
							do {
								if ($myrow_s['id'] == $activ){ $style_m = "id = 'active'"; } else { $style_m = ""; }
								if ($myrow_s['links'] == 'index.php') {$myrow_s['links'] = '';}
								echo "<li><a ".$style_m." href = '/".$myrow_s['links']."'>".$myrow_s['name']."</a></li>";
							} while ($myrow_s = mysqli_fetch_array($result_s));
						}
					?>				</ul>
				<ul class="contact_list"> 	 
					<?php 
						if (!empty($const_r[phone])) { $phone1 = '<li><strong>тел:</strong> '.$const_r[phone].'</li>';}
						if (!empty($const_r[phone2])) { $phone2 = '<li><strong>тел:</strong> '.$const_r[phone2].'</li>';}
						if ($const_r[mail]) { $email = '<li><strong>email:</strong> '.$const_r[mail].'</li>';}
						echo $phone1.$phone2.$email;
					 ?>
					 
				</ul>
				<ul class="brand_list"> 	
					<li><span class="maxi"><img src="/img/brand_1.gif"></span><span>«ТЕХНОЛОГИИ-СЕРВИСА» является авторизованным сервис-партнером компании HOBART GmbH</span> 		</a> 	</li>
					<li><span class="maxi"><img src="/img/brand_2.gif"></span><span>«ТЕХНОЛОГИИ-СЕРВИСА» является авторизованным сервис-партнером компании Rational AG</span> 		</a> 	</li>
					<li><span class="maxi"><img src="/img/brand_3.gif"></span><span>«ТЕХНОЛОГИИ-СЕРВИСА» является авторизованным сервис-партнером компании MENU SYSTEM Промышленное индукционное оборудование</span> 		</a> 	</li>
				</ul>
		</div>
		
		<div id="main">
			<div id="content">