<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<!-- Style -->
	<link rel="stylesheet" href="<?php echo asset('fonts/style.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('css/style.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('bootstrap4/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('bootstrap4/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('datetimepicker/css/bootstrap-datepicker.min.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('chosen/chosen.min.css') ?>">
	<!-- JS -->
	<script src="<?php echo asset('jquery/jquery.js') ?>"></script>
	<script src="<?php echo asset('bootstrap4/js/popper.min.js') ?>"></script>
	<script src="<?php echo asset('bootstrap4/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo asset('datetimepicker/js/bootstrap-datepicker.js') ?>"></script>
    <script src="<?php echo asset('datetimepicker/locales/bootstrap-datepicker.es.min.js') ?>"></script>
	<script src="<?php echo asset('chosen/chosen.jquery.min.js') ?>"></script>
	<!-- yield -->
	@yield('style')
</head>
<body>
	@include('Template.menu-top')
	<div class="container">
		<br>
        <?php if(count($errors) > 0){ ?>
            <div class="alert alert-danger">
                <p class="text-center" style="margin-top:-10px;"><b>Error:</b></p>
                <ul style="margin-top:-15px;">
                    <?php foreach($errors->all() as $error) { ?>
                        <li><?php echo $error ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
		@yield('body')
	</div>
	@yield('js')
	<script>
		$(document).ready(function(){
			$(document).on('focus','input,textarea',function(){
				$(this).select();
			});

			$(document).on('keyup','input,textarea',function(){
				this.value = this.value.toUpperCase();
			});
			$(document).on('change','input,textarea',function(){
				this.value = this.value.toUpperCase();
			});
		});
	</script>
</body>
</html>