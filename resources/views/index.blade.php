<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ config('app.name') }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Fonts -->
		<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	</head>
	<body>
		<main class="container mt-5 pt-5">
			<h2 class="text-center">Pembagian Bonus Buruh</h2>
			<div class="row pt-5 justify-content-center">
				<div class="col-8" id="alert">
					<form class="needs-validation" id="formPembagian">
						@csrf
						@method('PUT')
						<div class="row">
							<div class="col-12">
								<label for="totalBonus" class="form-label">Total Bonus</label>
								<div class="input-group has-validation">
									<span class="input-group-text">Rp</span>
									<input type="number" class="form-control" id="totalBonus" placeholder="Total Bonus" min="0" required />
								</div>
							</div>
						</div>
						<div class="row mt-3">
							@forelse ($labors as $labor)
							<div class="col">
								<label for="labor_{{ $labor->id }}" class="form-label">{{ $labor->name }}</label>
								<div class="input-group has-validation">
									<input type="number" class="form-control" min="1" max="100" id="labor_{{ $labor->id }}" required />
									<span class="input-group-text">%</span>
								</div>
								<p class="mb-0" id="labor_{{ $labor->id }}_output">Estimasi: Rp 0</p>
								@if ($labor->bonus > 0)
								<p class="mb-0">Bonus saat ini: Rp {{ $labor->bonus }}</p>
								@endif
							</div>
							@empty
							<div class="col">
								<p>Data buruh tidak ada.</p>
							</div>
							@endforelse
						</div>
						<div class="row mt-3 justify-content-end">
							<div class="col-2">
								<button class="w-100 btn btn-primary btn-lg" type="submit">Bagikan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</main>

		<!-- JavaScript Bundle with Popper -->
		<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

		<script type="text/javascript">
			$(document).ready(() => {
				let token = $("meta[name='csrf-token']").attr("content");
				let totalBonus = 0;
				let labor_1 = 1;
				let labor_2 = 1;
				let labor_3 = 1;
				let labor_result_1 = 0;
				let labor_result_2 = 0;
				let labor_result_3 = 0;
				let arr = [];

				$("#totalBonus, #labor_1, #labor_2, #labor_3").keyup(() => {
					totalBonus = $("#totalBonus").val() !== "" ? Number($("#totalBonus").val()) : 0;
					labor_1 = $("#labor_1").val() !== "" ? Number($("#labor_1").val()) : 1;
					labor_2 = $("#labor_2").val() !== "" ? Number($("#labor_2").val()) : 1;
					labor_3 = $("#labor_3").val() !== "" ? Number($("#labor_3").val()) : 1;
					labor_result_1 = getPercentage(totalBonus, labor_1);
					labor_result_2 = getPercentage(totalBonus, labor_2);
					labor_result_3 = getPercentage(totalBonus, labor_3);

					$("#labor_1_output").text(`Rp ${labor_result_1}`);
					$("#labor_2_output").text(`Rp ${labor_result_2}`);
					$("#labor_3_output").text(`Rp ${labor_result_3}`);
				});

				$("#formPembagian").submit((e) => {
					e.preventDefault();

					if (labor_1 + labor_2 + labor_3 !== 100 && labor_result_1 + labor_result_2 + labor_result_3 !== totalBonus) {
						return alert('Pembagian bonus tidak sesuai!');
					}

					arr.push(labor_result_1, labor_result_2, labor_result_3);
					arr.forEach((item, i) => {
						$.ajax({
							url: `/labor/${i + 1}`,
							type: 'PUT',
							cache: false,
							data: {
								'bonus': item,
								'_token': token,
							},

							success: function(response) {
								$('#totalBonus').val('');
								$(`#labor_${i + 1}`).val('');
								$(`#labor_${i + 1}_output`).text('Rp 0');

								const alert =
									`<div class="alert alert-success alert-dismissible fade show" role="alert">
										${response.message}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>`;

								$('#alert').prepend(alert);
							},

							error: function(error) {
								const alert =
									`<div class="alert alert-danger alert-dismissible fade show" role="alert">
										${error.message}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>`;

								$('#alert').prepend(alert);
							}
						});
					});
				});
			});

			const getPercentage = (total, persen) => total * persen / 100;
		</script>
	</body>
</html>
