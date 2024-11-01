<?php
/*
Plugin Name: Wln Chat Litle
Description: Este plugin insere um ícone do mensageiro de forma fácil no seu site Wordpress.
Author: Roberto Lima
Version: 2.5.1
Requires at least: 4.4
Tested up to: 5.6
*/

// Include mfp-functions.php, use require_once to stop the script if mfp-functions.php is not found
//require_once plugin_dir_path(__FILE__).'style/style.php';
//require_once plugin_dir_path(__FILE__).'includes/gtag_event.php';

// create plugin menu admin
add_action('admin_menu', 'wln_chat_create_menu');

// Hook the 'wp_footer' action hook, add the function named 'Wln_Add_Text'
add_action("wp_footer", "Wln_Add_Text");

function wln_chat_create_menu() {
	//create new top-level menu
	add_menu_page(
        'Wln Chat Lite', //Title Page Admin
        'Wln Chat', //Title Menu 
        'administrator', 'wln-chat.php', // Page Admin
        // 'administrator',(__FILE__),
        'wln_settings_page',
        plugins_url('/images/icon.png', __FILE__) // URL Icon
    );

	//call register settings function
	add_action( 'admin_init', 'wln_register_plugin_settings' );
}

function wln_register_plugin_settings() {
	//register our settings
	register_setting( 'wln-plugin-settings-group-fields', 'message_option' );
	register_setting( 'wln-plugin-settings-group-fields', 'phone_option' );
    register_setting( 'wln-plugin-settings-group-fields', 'texticon_option' );
    register_setting( 'wln-plugin-settings-group-fields', 'position_option' );
    register_setting( 'wln-plugin-settings-group-fields', 'position_option_v' );
}
// Define 'Wln_Add_Text'
function Wln_Add_Text(){ ?>
    <style type='text/css'>
        .whatsapp {
            /*background: url(<?php echo plugins_url('/images/whatsapp-icone.png', __FILE__);  ?>);*/
            background-repeat: no-repeat;
            background-position: center center;
            position: fixed!important;
            bottom: 3%;
            width: auto;
            height: 50px;
            display: block;
            margin: 7px 10px;
            <?php echo esc_attr( get_option('position_option') ); ?>;
            margin-bottom:<?php echo esc_attr( get_option('position_option_v') ); ?>px;
            z-index: 99999;
        }

        .span-text-zap{
            float: left;
            background: #2db842;
            margin: 10px -17px 0 0;
            padding: 13px 25px 13px 20px;
            z-index: -2;
            border-radius: 26px 0;
            color: #fff;
        }

        .whatsapp {
          animation-duration: 1s;
          animation-name: slidein;
          }.whatsapp:hover{filter: drop-shadow(2px 4px 6px #0000009e); }
          @keyframes slidein {
            from {transform: translateX(100px);}
            to {transform: translateX(0);}
        }
        @media only screen and (max-width: 768px) {
         .zap-desk{display: none;}
  }
  @media only screen and (min-width: 769px) {
    .zap-mob{display: none;}
}
</style>

<script>
/**
https://support.google.com/analytics/answer/7478520?hl=pt-BR
* Função que acompanha um clique em um link externo no Google Analytics.
* Essa função processa uma string de URL válida como um argumento e usa essa string de URL
* como o rótulo do evento. Ao definir o método de transporte como 'beacon', o hit é enviado
* usando 'navigator.sendBeacon' em um navegador compatível.
*/

// Register Dsktop
var trackOutboundLink = function(url) {
  gtag('event', 'click', {
    'event_category': 'outbound',
    'event_label': 'Whatsapp-Web',
    'transport_type': 'beacon',
    'event_callback': function(){document.location = url;}
});
}

//Register Mobile
var trackOutboundLinkMob = function(url) {
  gtag('event', 'click', {
    'event_category': 'outbound',
    'event_label': 'Whatsapp-Mob',
    'transport_type': 'beacon',
    'event_callback': function(){document.location = url;}
});

}
</script>

<!-- <?php echo get_permalink($post->ID); ?> -->

<a target="_blank" href='https://web.whatsapp.com/send?phone=<?php echo esc_attr( get_option('phone_option') ); ?>&text=<?php echo esc_attr( get_option('message_option') ); ?>' rel='noopener noreferrer' class="zap-desk" onclick="trackOutboundLink('<?php echo get_permalink($post->ID); ?> '); return true;">

    <div class='whatsapp'>
        <img src="<?php echo plugins_url('/images/whatsapp-icone.png', __FILE__);  ?>">
        <?php 
        if( get_option('texticon_option') === ""){

        }else{ ?>
            <span class="span-text-zap">
                <?php echo esc_attr( get_option('texticon_option') ); ?></span>
        <?php }
        ?>
    </div>
</a>

<a href='https://wa.me/<?php echo esc_attr( get_option('phone_option') ); ?>&text=<?php echo esc_attr( get_option('message_option') ); ?>' target='_blank' rel='noopener noreferrer' class="zap-mob"  onclick="trackOutboundLinkMob('<?php echo get_permalink($post->ID); ?> '); return true;">

    <div class='whatsapp'>
        <img src="<?php echo plugins_url('/images/whatsapp-icone.png', __FILE__);  ?>">
        <?php 
        if( get_option('texticon_option') === ""){
        }else{ ?>
            <span class="span-text-zap">
                <?php echo esc_attr( get_option('texticon_option') ); ?></span>
        <?php }
        ?>
    </div>
</a>

<?php
}

function wln_settings_page() { ?>
    <style type='text/css'>
        .textarea-message-option{
            width: 400px;
            height: 100px;
        }
    </style>

    <div class="">

        <h1>Wln Chat Plugin Lite</h1>

        <form method="post" action="options.php">
            <?php settings_fields( 'wln-plugin-settings-group-fields' ); ?>
            <?php do_settings_sections( 'wln-plugin-settings-group-fields' ); ?>
            <table class="form-table">

                <tr valign="top">
                    <th scope="row">Número de telefone: </th>
                    <td>
                        <input type="text" name="phone_option" placeholder="5599999999999" value="<?php echo esc_attr( get_option('phone_option') ); ?>" /> 

                        (Não utilize sinais de: <strong>"+", "-", "_", " "</strong> no código do pais ou como separadores do número.)
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Sua mensagem padrão: </th>
                    <td>
                        <textarea class="textarea-message-option" name="message_option"><?php echo esc_attr( get_option('message_option') ); ?></textarea>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Texto do ícone: </th>
                    <td>
                        <input type="text" name="texticon_option" placeholder="Insira um texto ao lado do ícone" value="<?php echo esc_attr( get_option('texticon_option') ); ?>" /> 

                        (Insira a mensagem que aparecerá ao lado do ícone. <em>Ex. Solocitar orçamento.</em>)
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Posição horizontal do icone: </th>
                    <td>
                      <br>
                      <?php
                      $position = "";
                      $position2 = "";
                      if( esc_attr( get_option('position_option') ) === "left:0"){
                        $position = "checked";
                    }

                    if( esc_attr( get_option('position_option') ) === "right:0"){
                        $position2 = "checked";
                    }

                    ?>

                    <input type="radio" name="position_option" value="left:0" <?php echo $position; ?>> esquerda<br>
                    <input type="radio" name="position_option" value="right:0" <?php echo $position2; ?>>  direita<br>

                    <br>
                    <?php //echo esc_attr( get_option('position_option') ); ?><br>

                </td>

            </tr>

            <tr valign="top">
                <th scope="row">Posição vertical do icone (<em>margin do rodapé</em>): </th>
                <td><input type="text" name="position_option_v" value="<?php echo esc_attr( get_option('position_option_v') ); ?>" size="3" /> PX</td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>
<?php } ?>