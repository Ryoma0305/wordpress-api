<?php global $global_vars; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/static/images/common/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/assets/static/images/common/apple-touch-icon.png">
	<meta name="format-detection" content="telephone=no"/>
	<!-- og:image -->
  	<meta property="og:image" content="<?php echo $global_vars['ogp']; ?>">
  <!--/ og:image -->
	<!-- webfont -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Noto+Serif+JP:wght@600&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
	<!--/ webfont -->
	<!-- css -->
	<?php $theme_info = wp_get_theme(); ?>
	<link href="<?php echo get_template_directory_uri(); ?>/assets/main.css?ver=<?php echo $theme_info->get('Version'); ?>" rel="stylesheet">
	<!--/ css -->
	<?php wp_head(); ?>
	<!-- Google analytics -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-58777056-1', 'auto');
		ga('send', 'pageview');
	</script>
	<!--/ Google analytics -->
</head>
<body class="l-contents">
