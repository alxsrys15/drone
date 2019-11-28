<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Reports</h1>
</div>
<?= $this->Form->create() ?>
<div class="form-row">
	<div class="col-sm-4 form-group">
		<label for="start-date">Start Date</label>
		<input type="text" name="start_date" class="form-control datepicker" id="start-date">
	</div>
	<div class="col-sm-4 form-group">
		<label for="start-date">End Date</label>
		<input type="text" name="end_date" class="form-control datepicker" id="end-date">
	</div>
</div>
<div class="form-row">
	<div class="col-sm-4 form-group">
		<?= $this->Form->button('Generate', ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
	</div>
</div>
<?= $this->Form->end() ?>
<script type="text/javascript">
	$(document).ready(function () {
		$('.datepicker').datepicker()
	});
</script>