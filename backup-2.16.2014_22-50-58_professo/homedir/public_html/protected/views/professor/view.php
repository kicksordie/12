<script type="text/javascript">
  $(function() {
    var availableTags = [<?php echo $listaProfessores; ?>];    
    
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
	  	$('#pesquisaProfessor').submit();
   	  },
      source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
        response( $.grep( availableTags, function( value ) {
          value = value.label || value.value || value;
          return matcher.test( value ) || matcher.test( normalize( value ) );
        }) );
      }
    });
    
    $('#comentario').focus();
    $('.form-comentario').submit(function(){
    	if($('#comentario').val().length <= 10){
    		$('#msg').html('Digite no mínimo 10 caracteres!');
    		return false;
    	}
    });
    
    $('.star').click(function(){
    	var nota = 'nota=' + this.id + '&id_professor=<?php echo $model->id_professor; ?>';
    	$.ajax('<?php echo Yii::app()->baseUrl; ?>/voto/create/',{
    		data : nota,
    		type: 'post',
    		success: function(data){
    			if(data == 'OK'){ // Voto computado
    				$('#statusVoto').html('Voto computado.');
    			}
    			if(data == 'PROIBIDO'){ // Já votou
    				$('#statusVoto').html('Você só pode votar uma vez.');
    			}
    		},
    	});
    });
    $('.rating-cancel').remove();
    
    $('.gostei').click(function(){
    	var id_depoimento = this.id;
    	var nota = 'id_depoimento=' + this.id;
    	$.ajax('<?php echo Yii::app()->baseUrl; ?>/depoimento/gostei/',{
    		data : nota,
    		type: 'post',
    		success: function(data){
    			if(data == 'OK'){ // Voto computado
    				var atual = $('#statusGostei'+id_depoimento).text();
    				$('#statusGostei'+id_depoimento).text(parseInt(atual) + 1);
    			}else{
    				$('#mensagem' + id_depoimento).text('Você já opinou sobre esse comentário.');
    			}
    		},
    	});
    	return false;
    });
    
    $('.naogostei').click(function(){
    	var id_depoimento = this.id;
    	var nota = 'id_depoimento=' + this.id;
    	$.ajax('<?php echo Yii::app()->baseUrl; ?>/depoimento/naogostei/',{
    		data : nota,
    		type: 'post',
    		success: function(data){
    			if(data == 'OK'){ // Voto computado
    				var atual = $('#statusNaoGostei'+id_depoimento).text();
    				$('#statusNaoGostei'+id_depoimento).text(parseInt(atual) + 1);
    			}else{
    				$('#mensagem' + id_depoimento).text('Você já opinou sobre esse comentário.');
    			}
    		},
    	});
    	return false;
    });
  });
</script>
<div id="formTopo">
	<div class="logo-mini">
		<a href="http://<?php echo $_SERVER["SERVER_NAME"] . Yii::app()->baseUrl; ?>">
			<img src="<?php echo Yii::app()->baseUrl; ?>/images/logo-mini.png" />
		</a>
	</div>
	<form action="http://<?php echo $_SERVER['SERVER_NAME'] . Yii::app()->baseUrl; ?>/professor/buscar" id="pesquisaProfessor" name="pesquisaProfessor" method="post">
		<div id="busca">
			<input name="busca" id="txtBusca" type="text" value="<?php echo $model->nome; ?>">
		</div>
	</form>
</div>
<div id="gba"></div>
	</div>
	<div class="content" id="main">
				<div class="resultado">
					<div class="imagem">
						<?php
						if(empty($model->foto)){
						?>
						<img src="<?php echo Yii::app()->baseUrl; ?>/images/semfoto.jpg" />
						<?php
						}else{?>
							<img src="<?php echo Yii::app()->baseUrl; ?>/images/professores/<?php echo $model->foto; ?>" />
						<?php
						}?>
					</div>
					<div class="nome">
						<h3><?php echo $model->nome; ?></h3>
					</div>
					<div class="estrelas">
						<input type="radio" id="1" name="prof<?php echo $model->id_professor; ?>" class="star <?php echo $nota - floor($nota) >= 0.5 ? '{half:true}' : ''; ?>" <?php echo floor($nota) == 1 ? 'checked="checked"' : ''; ?>/>
						<input type="radio" id="2" name="prof<?php echo $model->id_professor; ?>" class="star <?php echo $nota - floor($nota) >= 0.5 ? '{half:true}' : ''; ?>" <?php echo floor($nota) == 2 ? 'checked="checked"' : ''; ?>/>
						<input type="radio" id="3" name="prof<?php echo $model->id_professor; ?>" class="star <?php echo $nota - floor($nota) >= 0.5 ? '{half:true}' : ''; ?>" <?php echo floor($nota) == 3 ? 'checked="checked"' : ''; ?>/>
						<input type="radio" id="4" name="prof<?php echo $model->id_professor; ?>" class="star <?php echo $nota - floor($nota) >= 0.5 ? '{half:true}' : ''; ?>" <?php echo floor($nota) == 4 ? 'checked="checked"' : ''; ?>/>
						<input type="radio" id="5" name="prof<?php echo $model->id_professor; ?>" class="star <?php echo $nota - floor($nota) >= 0.5 ? '{half:true}' : ''; ?>" <?php echo floor($nota) == 5 ? 'checked="checked"' : ''; ?>/>
					</div>
					<div class="notaInt">
						&nbsp;&nbsp;&nbsp;<?php echo $nota; ?> (<?php echo $quantidadeDeVotos; ?> votos)
						<div id="statusVoto">
							
						</div>
					</div>
						<?php
						$i=0;
						foreach(Yii::app()->user->getFlashes() as $key => $message){
							if($i == 0 ) echo '<div class="success mensagem">';
					        echo $message;
							$i++;
					    }
						if($i>0) echo '</div>';
						?>
					<div class="comentarios">
						<h3>Comentários:</h3>
						<?php
						$i=0;
						foreach ($listaComentarios as $key => $value) { ?>
						<div class="comentario">
							<div class="lateral-direita">
								<div class="ofensivo">
									<a href="#" onclick="alert('Em breve.');" title="Reportar comentário ofensivo">
										<img src="<?php echo Yii::app()->baseUrl; ?>/images/ofensivo.gif" />
									</a>
								</div>
							</div>
							<?php echo str_replace("\n", "<br/>", $value->depoimento); ?>
							<br />
							<div class="thumbs">
								<a href="#" class="gostei" id="<?php echo $value->id_depoimento; ?>" title="Gostei">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/thumbs-up.png" />
									Gostei (<span id="statusGostei<?php echo $value->id_depoimento ?>"><?php echo $value->up ?></span>)
								</a>
								
								<a href="#" class="naogostei" id="<?php echo $value->id_depoimento; ?>" title="Nâo Gostei">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/thumbs-down.png" />
									Não Gostei (<span id="statusNaoGostei<?php echo $value->id_depoimento ?>"><?php echo $value->down ?></span>)
								</a>
								
								<span id="mensagem<?php echo $value->id_depoimento; ?>"></span>
							</div>
						
						</div>
						<?php 
							$i++;
						}
						if($i==0) echo "Nenhum comentário.";
						?>
					</div>
				</div>
			<div class="form-comentario">
				<h4>Deixe seu comentário sobre <?php $temp = explode(" ",$model->nome); echo $temp[0]." ".$temp[1]; ?>:</h4>
				<form name="formComentario" method="post" action="http://<?php echo $_SERVER['SERVER_NAME'] . Yii::app()->baseUrl; ?>/depoimento/create">
					<textarea name="Depoimento[depoimento]" id="comentario"></textarea>
					<input type="hidden" value="<?php echo $model->id_professor; ?>" name="Depoimento[id_professor]"/>
					<input type="submit" name="enviarComentario" value="Enviar" class="bt"/>
					<div id="msg">
						
					</div>
				</form>
			</div>
<!-- FIM DA VIEW -->