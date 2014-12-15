<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style1.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/js/rating/jquery.rating.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/js/rating/jquery.rating.pack.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#contato').dialog({
		    	autoOpen: false,
		    	width: 550,
		    	height: 330,
		    	modal: true,
		    });
		});
	</script>
	
	
	<!-- Google Analytics -->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-47209003-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	<!-- Fim Google Analytics -->
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="hp vasq" id="gsr" alink="#dd4b39" bgcolor="#fff" text="#222" vlink="#61c">
<div id="contato">
		<h3 style="margin: 4px;">Enviar mensagem</h3>
		<span style="font-size: 14px;">Caso queira receber uma resposta, informe seu e-mail na mensagem.</span>		
		<form id="contato-form" action="<?php echo Yii::app()->baseUrl; ?>/sugestoes/create" method="post">
			<textarea style="margin-top: 10px;" rows="6" cols="50" name="Contato[contato]" id="contato"></textarea>
			<br /><input type="submit" name="yt0" value="Enviar" />			
		</form>
	</div>
<div class="menu">
	<ul>
		<!-- <li>
			<a href="#" title="Buscar por disciplina" onclick="alert('Em breve.\nPossibilitará a busca a partir da disciplina.');" >Disciplinas</a>
		</li>
		<li>
			<a href="" title="Lista de todos os professores" onclick="alert('Em breve.\nListará todos os professores.');">Professores</a>
		</li> -->
		<li class="destaque">
			<a href="#" onclick="$('#contato').dialog('open');">Contato</a>
		</li>
	</ul>
</div>
<div class="content" id="content" align="center">
			
	<?php echo $content; ?>
	
</div>
			
<div id="footer">
	<a href=""><?php // TODO: Escrever algo aqui ?></a>
</div>
</body>
</html>
