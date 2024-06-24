<?php $url = 'http://'. $_SERVER['SERVER_NAME'];?>
<body>
<div style="text-align:center;font-family: arial,sans-serif;position:relative;width:100%;min-width:800px;padding:50px 0;display:inline-block;background:#e40034;
    background: -webkit-linear-gradient(bottom left, #e40034 0%, #da047b 100%);
    background: -o-linear-gradient(bottom left, #e40034 0%, #da047b 100%);
    background: linear-gradient(to top right, #e40034 0%, #da047b 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e40034', endColorstr='#da047b',GradientType=1 );">
<div style="background-color:white;margin:0 auto;width:450px;padding:30px;">
	<img style="display:inline-block;margin-bottom:20px;" height="70" width="auto" src="https://my.eskiz.uz/stylesheets/images/logo_eskiz.png" alt="Eskiz IT Company">
	<p style="color:#e70031;margin-bottom:40px;margin-top:5px;font-size:14px;font-style:italic;">Успей забронировать свое место в интернете!</p>
	<h1 style="font-size:25px;">Обратная связь</h1>	
	<div style="padding:10px 25px;background-color:#eee;margin-top:35px;margin-bottom:35px;text-align:left;font-size:15px;">
		<p>Имя отправителя: <strong><?= $name ?></strong></p>
		<p>Email отправителя: <strong><?= $email ?></strong></p>
		<p>Телефон отправителя: <strong><?= $phone ?></strong></p>		
		<p>Компания отправителя: <strong><?= $company ?></strong></p>
		<p>Cообщение отправителя: <strong><?= $message ?></strong></p>
	</div>	
	
	<div style="text-align:left;margin-top:40px;font-size:13px;">
		<p>--<br>		
 		С уважением,<br>
		команда Eskiz IT Company<br>
		Справочный по телефону:<br>
		+998 71 202-60-60<br>
		help@eskiz.uz | www.eskiz.uz
 		</p>
	</div>
</div>
</div>
</body>