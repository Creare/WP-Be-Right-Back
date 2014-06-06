<!DOCTYPE HTML>
<html>
<head>
<?php
	$title = get_option( 'wp_brb_holding_title' );
	$content = get_option( 'wp_brb_holding_content' );
	$show_date = get_option( 'wp_brb_show_date' );
	$email = get_option( 'wp_brb_email' );
	$telephone = get_option( 'wp_brb_telephone' );
	$logo = get_option( 'wp_brb_logo_image' );
	$background_image = get_option( 'wp_brb_background_image' );
	$background_colour = get_option( 'wp_brb_background_colour' );
	
	if( !empty( $background_image ) ) {
		$background = 'url('.$background_image.') no-repeat; background-size:cover; width:100%';
		$colour = '#ff0000';
	} elseif( !empty( $background_colour ) ) {
		$background = $background_colour;
		$colour = $background;
	} else {
		$background = 'url('.WP_BRB_URL. 'theme/images/default.jpg) no-repeat; background-size:cover; width:100%';
		$colour = '#ff0000';
	}
	
	if( !$title ) {
		$title = get_bloginfo( 'blogname' );	
	}
	
	if( !$background_colour && !$background_image ) {
		$background = '#43B77B';	
	}
	
	if( !$content ) {
		$content = '<p>WP Be Right Back is a free lightweight plugin which can add a holding page to your website enabling logged in users to browse the site as normal/make changes, whilst non-logged in users access a holding page. With easy customisation of your holding page and an SEO friendly 503 status option, WP Be Right Back is ideal for all.</p>';	
	}
	
?>
<meta charset="UTF-8">
<title><?php echo $title; ?> - <?php echo bloginfo( 'name' ); ?></title>
<style>
* {
	margin: 0;
	padding: 0;
}
body {
	font-size: 62.5%;
	font-family: helvetica;
}
::selection {
}
p {
	font-size: 1.3em;
	line-height: 1.4em;
	color: #454545;
	padding: 0 0 5px;
}
span {
	font-size: 1.3em;
}
a {
	font-size: 1.6em;
	text-decoration: underline;
	color: <?php echo $colour; ?>;
	font-weight: bold;
}
a:hover {
	text-decoration: none;
}
.container {
	width:75%;
	margin: 10% auto;
	text-align: center;
	background: #fff;
	padding: 20px;	
}
#logo {
	width:200px;
	height:110px;
}
#logo img {
	width:100%;
}
h1 {
	font-size: 3em;
	line-height: 1em;
	margin: 0 0 15px;
}
.back-on {
	margin: 10px 0;
}
.back-on p {
	font-size: 1.6em;
	line-height: 1em;
	font-weight: bold;
}
@media screen and (min-width: 600px) {
	.container {
		width:55%;
	}
}
@media screen and (min-width: 768px) {
	.container {
		width:45%;
	}
}
</style>
</head>
<body style="background: <?php echo $background; ?>; height: 100%;">

<div class="container" >
  <div class="holder">
  
	<?php if( !empty( $logo ) ) { ?>
		<div class="logo">
			<img width="200" src="<?php echo $logo; ?>" alt="Logo" />
		</div>
	<?php } ?>
  
    <?php if( $title ) { ?>
    	<h1><?php echo $title; ?></h1>
	<?php } ?>
	
	
    <?php echo apply_filters( 'the_content', $content ); ?>
    
    
    <div style="overflow:hidden;">
    <?php if( $show_date == 1 ) { ?>
      <div class="back-on">
        <p>We'll be back on:</p>
        <p><?php echo get_option( 'wp_brb_return_date_format' ); ?></p>
      </div>
      <?php } ?>
      
      <?php if( !empty( $email ) && !empty( $telephone ) ) { ?>
      <p>For all urgent enquiries, contact us using the below:</p>
      
	      <?php if( !empty( $telephone ) ) { ?>
	      <a href="tel:<?php echo $telephone; ?>" style=""><?php echo $telephone; ?></a> <span>or</span> 
	      <?php } ?>
	      <?php if( !empty( $email ) ) { ?>
	      <a href="mailto:<?php echo $email; ?>" style=""><?php echo $email; ?></a> 
	      <?php } ?>
      
      <?php } ?>
      
      </div>
  </div>
</div>
</body>
</html>