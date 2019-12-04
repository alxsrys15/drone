<div class="container-fluid" id="slider">
	<div class="row ml-0 mr-0">
		<div class="col-md-12 px-0">
			<div id="c1_indicator" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#c1_indicator" data-slide-to="0" class="active"></li>
					<li data-target="#c1_indicator" data-slide-to="1"></li>
					<?php $ctr = 1; ?>		    
					<?php foreach ($announcements as $announcement): ?>
					<?php $ctr = $ctr + 1 ?>
					<li data-target="#c1_indicator" data-slide-to="<?= $ctr ?>"></li>	
					<?php endforeach ?>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<?= $this->Html->image('drone_caro.jpg') ?>
					</div>
					<div class="carousel-item">
						<?= $this->Html->image('drone_caro11.jpg') ?>
					</div>
					<?php foreach ($announcements as $a): ?>
					<div class="carousel-item">
						<?= $this->Html->image('carousel_images/' . $a->img) ?>
					</div>
					<?php endforeach ?>
				</div>
				<a class="carousel-control-prev" href="#c1_indicator" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#c1_indicator" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
</div>
<div class="container mt-3">
	<div class="row">
		<?= $this->element('shop') ?> 
	</div>
</div>