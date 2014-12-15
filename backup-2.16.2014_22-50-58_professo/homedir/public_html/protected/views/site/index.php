<script type="text/javascript">
  $(function() {
    var availableTags = [<?php echo $listaProfessores; ?>];
    $('#txtBusca').focus();
    // $( "#txtBusca" ).autocomplete({
      // source: availableTags
    // });
    
    
    var accentMap = {
	  "Á": "a",
	  "Ã": "a",
	  "Â": "a",
      "á": "a",
      "ã": "a",
      "â": "a",
      "É": "e",
      "Ê": "e",
      "é": "e",
      "ê": "e",
      "è": "e",
      "õ": "o",
      "ô": "o",
      "Ô": "o",
      "Ó": "o",
      "Õ": "o",
      "ó": "o",
      "Í": "i",
      "Î": "i",
      "í": "i",
      "î": "i",
      "ì": "i",
      "Ú": "u",
      "Û": "u",
      "ú": "u",
      "û": "u",
      "ù": "u",
    };
    var normalize = function( term ) {
      var ret = "";
      for ( var i = 0; i < term.length; i++ ) {
        ret += accentMap[ term.charAt(i) ] || term.charAt(i);
      }
      return ret;
    };
 
    $( "#txtBusca" ).autocomplete({
   	  select : function(event, ui){
   	  	// alert(ui.item.value);
   	  	$(this).val(ui.item.value);
   	  	$('#enviar').click();
   	  },
      source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
        response( $.grep( availableTags, function( value ) {
          value = value.label || value.value || value;
          return matcher.test( value ) || matcher.test( normalize( value ) );
        }) );
      }
    });
    
    
    $('#formPesquisa').submit(function(){
    	if($('#txtBusca').val().length == 0){
    		$('#txtBusca').focus();
    		return false;
    	}
    });
    
    $('#enviarSugestao').dialog({
    	autoOpen: false,
    	width: 600,
    	height: 450,
    	modal: true,
    });
  });
</script>
<div id="logo">
	<a href="http://<?php echo $_SERVER['SERVER_NAME'].Yii::app()->baseUrl; ?>">
		<img  src="<?php echo Yii::app()->baseUrl; ?>/images/Professor.gif" title="" width="550" height="90" style="padding-top:130px"/>
	</a>
</div>
<form action="professor/buscar" id="formPesquisa" name="pesquisaProfessor" method="post">
	<div id="busca">
		<input placeholder="Digite o nome do professor" name="busca" id="txtBusca" type="text">
	</div>
	<div>
		<input type="submit" name="enviar" id="enviar" value="Pesquisar Professor" class="bt"/>
		<button class="bt" onclick="alert('Desculpa, amigo.\nAluno de C&T não tem sorte.  :\'(');$('#txtBusca').focus();return false;">
			<span>Estou com sorte</span>
		</button>
	</div>
</form>
		</div><div id="gba"></div>
	</div>
	<div class="content" id="main">
		<?php
		$i=0;
		foreach(Yii::app()->user->getFlashes() as $key => $message){
			if($i == 0 ) echo '<div class="'.$key.' mensagem">';
	        echo $message;
			$i++;
	    }
		if($i>0) echo '</div>';
		?>
		<span class="ctr-p" id="body">
			<center>
				<div id="lga" style="height:10px;margin-top:20px">
					
				</div><div style="height:10px"></div>
				<div id="prm-pt" style="font-size:83%;min-height:3.5em">
					<br>
					<div id="sugira">
						<font>
							Conhece um professor que não está listado?<br/><a onclick='$( "#enviarSugestao" ).dialog( "open" );' href="#"><span style="font-size: 20px;font-weight: bold;">Sugira um professor</span></a> para ajudar os companheiros.
						</font>
					</div>
				</div>
			</center>
		</span>
		<div class="lista-professores">
			<h3>Ajude a classificar:</h3>
			<?php
				$jaSaiu = array();
				for($i=0;$i<7;$i++){
				$sorteio = rand(0,count($professoresSorteados)-1);
				if(array_search($sorteio, $jaSaiu) !== FALSE){
					// Se o numero já tiver saído
					$i--;
					continue;
				}
				$jaSaiu[] = $sorteio;
				$value = $professoresSorteados[$sorteio];
				?>
				<a href="<?php echo Yii::app()->baseUrl; ?>/professor/view/<?php echo $value->id_professor; ?>">
					<div class="professor">
					<div class="imagem-professor">
						<img width="70" height="89" src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $value->foto == NULL ? 'semfoto.jpg' : 'professores/'.$value->foto; ?>" /><br />
						<div class="nome-professor"><?php $temp = @split(' ', $value->nome); echo $temp[0] .' '. substr($temp[1], 0, 1); ?>.</div>
					</div>
				</a>
			</div>
		    <?php } ?>
		</div>
		
		<div id="enviarSugestao">
			<h3 style="margin: 4px;">Enviar Sugestao</h3>
			<h5 style="margin: 4px;">Sugira:
				<ul>
					<li>Novos professores</li>
					<li>Melhorias</li>
				</ul>
			</h5>
			<span style="font-size: 14px;">Caso queira receber uma resposta, informe seu e-mail.</span>		
			<form id="sugestoes-form" action="<?php echo Yii::app()->baseUrl; ?>/sugestoes/create" method="post">
				<textarea style="margin-top: 10px;" rows="6" cols="50" name="Sugestoes[sugestao]" id="Sugestoes_sugestao"></textarea>
				<br /><input type="submit" name="yt0" value="Enviar" />			
			</form>
		</div>
		

<!-- FIM DA VIEW -->