<form action="/action_page.php">
	<div class="row">
		@foreach($cols as $col)
		@if($col['type'] == '')
		<div class="form-group col-md-6">
			<div class="row">
				<div class="col-md-3">
					<label for="email">Information:</label>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
				</div>
			</div>
		</div>
		@elseif($col['type'] == 'select')
		<div class="form-group col-md-6">
			<div class="row">
				<div class="col-md-3">
					<label for="email">Information:</label>
				</div>
				<div class="col-md-9">
					<select name="test" id="test">
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
				</div>
			</div>
		</div>
		@endif
		@endforeach
	</div>
</form>