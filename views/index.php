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
					<input type="text" id="bag_cost" class="form-control" aria-describedby="basic-addon1" selectAll value="72">
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
					<select id="depth_measurement" class="form-control">
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
					<input type="number" id="width" class="form-control" min="0" selectAll value="0">
				</div>

				<div class="form-group">
					<label for="">Length</label>
					<input type="number" id="length" class="form-control" min="0" selectAll value="0">
				</div>

				<div class="form-group">
					<label for="">Depth</label>
					<input type="number" id="depth" class="form-control" min="0" selectAll value="0">
				</div>

			</div>
		</div>

	</div>

	<div class="col-md-3 hidden" id="result">

		<div class="card" style="width: 18rem;">
			<div class="card-header">Result</div>
			<div class="card-body">

				<table class="table">
					<tr>
						<td>Bags Of Top Soil</td>
						<td id="bagsOfTopSoil"></td>
					</tr>
					<tr>
						<td>Total Cost</td>
						<td id="totalCost"></td>
					</tr>
				</table>

			</div>
		</div>

	</div>
</div>

<div class="row p-15">
	<div class="col-12 text-left">
		<button class="btn btn-primary" onclick="calc()">Calculate</button>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<table class="table table-striped table-hovered">
			<thead>
			<tr>
				<td>Bag Cost</td>
				<td>Measurement Unit</td>
				<td>Depth Measurement Unit</td>
				<td>Width</td>
				<td>Length</td>
				<td>Depth</td>
				<td>Bags Of Top Soil</td>
				<td>Total Cost</td>
				<td>Date</td>
			</tr>
			</thead>
			<tbody id="oldResults"></tbody>
		</table>
	</div>
</div>

<script src="<?= url ( 'public/js/jquery.js' ) ?>"></script>

<script>
	$ ( function ()
	{
		$ ( '[selectAll]' ).focus ( function () { $ ( this ).select (); } );
		
		getCalculations();
	} );
	
	function getCalculations(){
		$.ajax({
			url: '<?=url('getCalculations')?>',
			method: 'GET',
		}).then(res=>{
			if(res.status === true){
				console.log (res.message);
				$("#oldResults").html(
					res.message.map(item=>`
						<tr>
							<td>${item.bag_cost}</td>
							<td>${item.measurement}</td>
							<td>${item.depth_measurement}</td>
							<td>${item.width}</td>
							<td>${item.length}</td>
							<td>${item.depth}</td>
							<td>${item.bags_of_top_soil}</td>
							<td>${item.total_cost}</td>
							<td>${item.created_at}</td>
						</tr>
					`)
				)
			}
		})
	}

	function calc ()
	{
		const bag_cost          = $ ( '#bag_cost' ).val ();
		const measurement       = $ ( '#measurement' ).val ();
		const depth_measurement = $ ( '#depth_measurement' ).val ();
		const width             = $ ( '#width' ).val ();
		const length            = $ ( '#length' ).val ();
		const depth             = $ ( '#depth' ).val ();
		
		$.ajax ( {
			url   : '<?= url ( 'calc' ) ?>',
			method: 'post',
			data  : {
				bag_cost         : bag_cost,
				measurement      : measurement,
				depth_measurement: depth_measurement,
				width            : width,
				length           : length,
				depth            : depth,
			},
		} ).then ( res =>
		{
			if ( res.status === true )
			{
				const r = res.message;
				$ ( '#result' ).removeClass ( 'hidden' );
				$ ( '#bagsOfTopSoil' ).text ( r.bagsOfTopSoil );
				$ ( '#totalCost' ).text ( r.totalCost.numberFormat () );
				getCalculations();
			}
		} );
	}

	Number.prototype.numberFormat = function ()
	{
		const price           = this;
		const currency_symbol = '₺';
		const formattedOutput = new Intl.NumberFormat ( 'en-US', {
			style                : 'currency',
			currency             : 'GBP',
			minimumFractionDigits: 0,
			maximumFractionDigits: 0,
		} );

		return formattedOutput.format ( price ).replace ( currency_symbol, '' );
	};

</script>

</body>
</html>