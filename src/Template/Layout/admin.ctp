<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>
        Drone Clothing Co - Virtual Shop
    </title>
    <?= $this->Html->css(['all.min.css', 'sb-admin-2.min.css', 'datepicker.css']) ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/sweetalert2@9') ?>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<?= $this->Html->script([
    	'jquery.min.js', 
    	'bootstrap.bundle.min.js', 
    	'jquery.easing.min.js',
    	'sb-admin-2.min.js',
    	'bootstrap-datepicker.js'
    ]) ?>
	<?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body id="page-top">
	<div id="wrapper">
		<?= $this->element('sidebar_admin') ?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?= $this->element('header_admin') ?>
				<div class="container-fluid">
					<?= $this->Flash->render() ?>
					<?= $this->fetch('content') ?>
				</div>
			</div>
		</div>
	</div>
	
    <?= $this->fetch('script') ?>
    <script type="text/javascript">
        var url = '<?= $this->Url->build('/', true); ?>';
        var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
    </script>
</body>
</html>