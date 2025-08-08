<?php 
	session_start();
	$relpath = '';
	include_once($relpath.'_api.php');
	include_once($relpath.'_config.php');	
?>

<!-- head template -->
<?php include($root.'template/body/head.php'); ?>

<body>
	
	<!-- scroll container --><!-- barba wrapper -->
	<div data-barba="wrapper" data-scroll-container>

		<!-- header template -->
		<?php include($root.'template/layout/header.php') ?>
		
		<!-- barba container -->
		<main id="top" data-barba="container" data-barba-namespace="home" class="">
			
			<!-- footer template -->
			<?php include($root.'template/layout/footer.php') ?>

		</main> <!-- barba container end -->
	</div> <!-- scroll container end --><!-- barba wrapper end -->

	<!-- component templates -->
	<?php include($root.'template/layout/components.php') ?>

	<!-- global js -->
	<?php include($root.'template/js/js_setup.php') ?>

	<!-- local js -->
	<script type="text/javascript">
		
	</script>

	<?php include($root.'template/body/end.php'); ?>
