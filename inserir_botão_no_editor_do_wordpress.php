<?php
add_action('admin_head', 'embedShortCode');

function embedShortCode($arr) {
	//Inclui a chamada da url do js do plugin
	add_filter('mce_external_plugins', 'add_js_embeds');

	add_filter('mce_buttons', 'resgistrar_botao_embeds');
}

function add_js_embeds($plugin_array) {
	$plugin_array['sjccembed'] = plugins_url('/botoes-extras-tinymce/plugin.js');
	return $plugin_array;
}

function resgistrar_botao_embeds($buttons) {
	array_push($buttons, 'sjccembed_botao');
	return $buttons;
}

?>


<script>
/**
 * plugin.js
 *
 * Copyright, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

( function() {
    tinymce.PluginManager.add( 'sjccembed', function( editor, url ) {
		editor.addButton( 'sjccembed_botao', {			            
            icon: true,
			image: url + '/icon-embed.png',
			tooltip: 'Inserir embed',
            onclick: function() {
                editor.windowManager.open( {
					width: 400,
					height: 180,
                    title: 'Inserção de embed no post',
                    body: [
							{ 
								type: 'textbox',
								name: 'url',
								label: 'URL*',
								tooltip: 'Insira a url'								
							},
							{
								type: 'listbox', 
								name: 'tipo', 
								label: 'Tipo*', 
								tooltip: 'Selecione o tipo do embed',								
								'values': [
											{text:'Selecione', value:''},
											{text:'UOL Vídeo', value:'1'},
											{text:'UOL Aúdio', value:'2'},
											{text:'Youtube', value:'3'},
											{text:'Issu', value:'4'},
											{text:'Infográfico', value:'5'},
											{text:'SlideShare', value:'6'},
											{text:'Facebook', value:'7'},
										  ]
							},
							{ 
								type: 'textbox',
								size: 3,
								maxLength: 3,
								name: 'altura',
								label: 'Altura',
								tooltip: 'Insira a altura em pixels. Ex: 500',								
								text: '410',
							},
							{ 
								type: 'textbox',
								size: 3,
								maxLength: 3,
								name: 'largura',
								label: 'Largura',
								tooltip: 'Insira a largura em pixels. Ex: 500',
								text: '710'								
							}							
					],
                    onsubmit: function( res ) {
						if(res.data.url == '')
						{
							editor.windowManager.alert('Informe a url');	
							return false;														
						}
						else if(res.data.tipo == '')
						{
							editor.windowManager.alert('Selcione o tipo');	
							return false;							
						}
						else
						{							
							var conteudo = '';
							var tipo = res.data.tipo;
							var url = res.data.url;							
							var altura = res.data.altura;	
							var largura = res.data.largura;								
							var tamanho = '';
							
							if(altura != '')
							{								
								tamanho+= ' '+altura;
							}
							
							if(largura != '')
							{								
								tamanho+= ' '+largura;
							}
									
							switch(res.data.tipo)
							{
									case '1': 
												regra = url.replace(/(.*\/view\/)?(\d)/,'$2');
												conteudo = '[uolmais ' + regra + '' + tamanho + ']';
												break;
									case '2': 
												regra = url.replace(/(.*\/view\/)?(\d)/,'$2');
												conteudo = '[uolmaisaudio ' + regra + '' + tamanho + ']';
												break;	
									case '3': 
												regra = url.replace(/(.*\?v=)([\w|\d]*)(&.*)?/,'$2');
												conteudo = '[youtube ' + regra + '' + tamanho + ']';
												break;
									case '4': 
												regra = url.replace(/(.*\?e=)(.*)/,'$2');
												conteudo = '[issu ' + regra + '' + tamanho + ']';
												break;	
									case '5': 
												regra = url;
												conteudo = '[infografico ' + regra + '' + tamanho + ']';
												break;
									case '6': 
												regra = url.replace(/(.*src=")(.*?)(".*)/, '$2');
												conteudo = '[slideshare ' + regra + '' + tamanho + ']';
												break;
									case '7': 
												regra = url.replace(/(.*\/videos\/)(\d*)(\/.*)/, '$2');
												conteudo = '[slideshare ' + regra + '' + tamanho + ']';
												break;			
									default:
											
							}
							
							editor.insertContent(conteudo);	
						}                        
                    }

                } );
            }

        } );

    } );

} )();
</script>