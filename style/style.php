<?php 

ob_start();

header("Content-type: text/css", true);

?>

<style type='text/css'>
.whatsapp {
	background: url(<?php echo plugins_url('../images/whatsapp-icone.png', __FILE__);  ?>);
	background-repeat: no-repeat;
	background-position: center center;
	position: fixed!important;
	bottom: 3%;
	width: 61px;
	height: 50px;
	display: block;
	margin: 7px 10px;
	<?php echo esc_attr( get_option('position_option') ); ?>;
	z-index: 99999;
}

.textarea-message-option{

	width: 400px;

	height: 100px;

}

</style>