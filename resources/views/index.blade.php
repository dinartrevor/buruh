<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ config('app.name') }}</title>

		<!-- Fonts -->
		<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	</head>
	<body>
		<main class="container mt-5 pt-5">
			<h2 class="text-center">Pembagian Bonus Buruh</h2>
			<div class="row pt-5 justify-content-center">
				<div class="col-8">
					<form class="needs-validation" id="formPembagian">
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
							<div class="col">
								<label for="buruh_a" class="form-label">Buruh A</label>
								<div class="input-group has-validation">
									<input type="number" class="form-control" min="1" max="100" id="buruh_a" required />
									<span class="input-group-text">%</span>
								</div>
								<p id="buruh_a_output">Rp 0</p>
							</div>
							<div class="col">
								<label for="buruh_b" class="form-label">Buruh B</label>
								<div class="input-group has-validation">
									<input type="number" class="form-control" min="1" max="100" id="buruh_b" required />
									<span class="input-group-text">%</span>
								</div>
								<p id="buruh_b_output">Rp 0</p>
							</div>
							<div class="col">
								<label for="buruh_c" class="form-label">Buruh C</label>
								<div class="input-group has-validation">
									<input type="number" class="form-control" min="1" max="100" id="buruh_c" required />
									<span class="input-group-text">%</span>
								</div>
								<p id="buruh_c_output">Rp 0</p>
							</div>
						</div>
						<div class="row mt-3 justify-content-end">
							<div class="col-2">
								<button class="w-100 btn btn-primary btn-lg" type="submit">Bayar</button>
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
				let totalBonus = 0
				let buruh_a = 1
				let buruh_b = 1
				let buruh_c = 1
				let hasil_buruh_a = 0
				let hasil_buruh_b = 0
				let hasil_buruh_c = 0

				$("#totalBonus, #buruh_a, #buruh_b, #buruh_c").keyup(() => {
					totalBonus = $("#totalBonus").val() !== "" ? Number($("#totalBonus").val()) : 0;
					buruh_a = $("#buruh_a").val() !== "" ? Number($("#buruh_a").val()) : 1;
					buruh_b = $("#buruh_b").val() !== "" ? Number($("#buruh_b").val()) : 1;
					buruh_c = $("#buruh_c").val() !== "" ? Number($("#buruh_c").val()) : 1;
					hasil_buruh_a = getPercentage(totalBonus, buruh_a);
					hasil_buruh_b = getPercentage(totalBonus, buruh_b);
					hasil_buruh_c = getPercentage(totalBonus, buruh_c);

					$("#buruh_a_output").text(`Rp ${hasil_buruh_a}`);
					$("#buruh_b_output").text(`Rp ${hasil_buruh_b}`);
					$("#buruh_c_output").text(`Rp ${hasil_buruh_c}`);
				});

				$("#formPembagian").submit((e) => {
					e.preventDefault();

					if (buruh_a + buruh_b + buruh_c > 100 && hasil_buruh_a + hasil_buruh_b + hasil_buruh_c > totalBonus) {
						alert('Pembagian bonus tidak sesuai!');
					}
				});
			});

			const getPercentage = (total, persen) => total * persen / 100;
		</script>
	</body>
</html>
