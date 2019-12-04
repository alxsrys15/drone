<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Announcements</h1>
	<button class="btn btn-sm btn-primary shadow-sm" data-target="#announcement_add_modal" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Add Announcement</button>
</div>
<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table">
			<thead>
				<th>Image</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php foreach ($announcements as $a): ?>
					<tr>
						<td>
							<div class="p-2">
								<?= $this->Html->image('carousel_images/' . $a['img'], ['class' => 'img-fluid rounded shadow-sm', 'width' => '70']) ?>
							</div>
						</td>
						<td>
							<button class="btn btn-primary btn-view" data-image="<?= $a['img'] ?>" data-target="#announcement_view_modal" data-toggle="modal">View</button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="announcement_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel1">Preview announcement</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= $this->Html->image('assets/default-image.jpg', ['class' => 'img-fluid', 'id' => 'view-image']) ?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="announcement_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create(null,['url' => ['action' => 'announcementAdd'], 'enctype' => 'multipart/form-data']) ?>
			<div class="modal-body">
				<div class="form-row">
					<div class="col-sm-12 form-group">
						<?= $this->Html->image('assets/default-image.jpg', ['class' => 'img-fluid', 'id' => 'image-preview']) ?>
					</div>
					<div class="col-sm-4 form-group">
						<a class="btn btn-primary btn-small btn-select-img" style="color: white"><i class="fa fa-image"></i> Select image</a>
						<div class="custom-file d-none">
							  <?= $this->Form->input('img', ['type' => 'file', 'data-preview' => '#image-preview', 'class' => 'uploader', 'accept' => 'image/x-png,image/gif,image/jpeg']) ?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<?= $this->Form->button('Add Announcement', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
			</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function readURL (input, uploader) {
		if (input.files && input.files[0]) {
		    var reader = new FileReader();
		    reader.onload = function(e) {
		      $('#image-preview').attr('src', e.target.result);
		    }
		    reader.readAsDataURL(input.files[0]);
		 }
	}
	$(document).ready(function () {
		$('.btn-select-img').on('click', function () {
			$('.uploader').trigger('click');
		});
		$('.uploader').on('change', function () {
			readURL(this);
		});
		$('#announcement_view_modal').on('show.bs.modal', function (e) {
			var img_src = '/img/carousel_images/' + $(e.relatedTarget).data('image');
			$('#view-image').attr('src', img_src);
		});
	});
</script>