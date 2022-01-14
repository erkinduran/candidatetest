<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Candidate Test</title>

	<link rel="stylesheet" href="<?= url ( 'public/css/bootstrap.css' ) ?>">
	<link rel="stylesheet" href="<?= url ( 'public/css/app.css' ) ?>">
</head>
<body>
<div class="row p-15">
	<div class="col-md-3">

		<div class="card" style="width: 18rem;">
			<div class="card-header">Depedencies</div>
			<div class="card-body">
				<label for="">Topsoil bag cost</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">£</span>
					</div>
					<input type="text" class="form-control" aria-describedby="basic-addon1" selectAll value="72">
				</div>

				<div class="form-group">
					<label for="">Measurement unit</label>
					<select id="measurement" class="form-control">
						<option value="meter">Meter</option>
						<option value="feet">Feet</option>
						<option value="yard">Yard</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">Depth measurement unit</label>
					<select name="depth_measurement" id="" class="form-control">
						<option value="centimeter">Centimeter</option>
						<option value="inch">Inch</option>
					</select>
				</div>
			</div>
		</div>

	</div>

	<div class="col-md-3">

		<div class="card" style="width: 18rem;">
			<div class="card-header">Dimensions</div>
			<div class="card-body">

				<div class="form-group">
					<label for="">Width</label>
					<input type="number" name="width" class="form-control" min="0" selectAll value="0">
				</div>

				<div class="form-group">
					<label for="">Length</label>
					<input type="number" name="length" class="form-control" min="0" selectAll value="0">
				</div>

				<div class="form-group">
					<label for="">Depth</label>
					<input type="number" name="depth" class="form-control" min="0" selectAll value="0">
				</div>

			</div>
		</div>

	</div>
</div>

<div class="row p-15">
	<div class="col-12 text-left">
		<button class="btn btn-primary" onclick="calc()">Calculate</button>
	</div>
</div>

<script src="<?= url ( 'public/js/jquery.js' ) ?>"></script>

<script>
	$ ( function ()
	{
		$ ( '[selectAll]' ).focus ( function () { $ ( this ).select (); } );
	} );

	function calc ()
	{
		const measurement       = $ ( 'measurement' ).val ();
		const depth_measurement = $ ( 'depth_measurement' ).val ();
		const width             = $ ( 'width' ).val ();
		const length            = $ ( 'length' ).val ();
		const depth             = $ ( 'depth' ).val ();

		$.ajax ( {
			url   : '<?= url ( 'calc' ) ?>',
			method: 'post',
			data  : {
				measurement      : measurement
				depth_measurement: depth_measurement
				width            : width
				length           : length
				depth            : depth,
			},
		} ).then ( res =>
		{
			console.log (res);
		} );
	}
</script>

</body>
</html>