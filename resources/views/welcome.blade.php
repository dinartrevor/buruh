<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel</title>

		<!-- Fonts -->
		<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<main>
				<div class="row g-5 mt-5">
					<div class="col-md-7 col-lg-8">
						<form class="needs-validation" id="form-pembayaran">
							<div class="row g-3">
								<div class="col-12">
									<label for="pembayaran" class="form-label">Pembayaran</label>
									<div class="input-group has-validation">
										<span class="input-group-text">Rp</span>
										<input type="number" class="form-control" id="pembayaran" placeholder="Pembayaran" min="0" />
									</div>
								</div>
							</div>
							<div class="row g-3 mt-2" id="input-buruh">
								<div class="col">
									<label for="buruh_a" class="form-label">Buruh A</label>
									<div class="input-group has-validation">
										<input type="number" class="form-control" min="1" max="100" id="buruh_a" />
										<span class="input-group-text">%</span>
									</div>
								</div>
								<div class="col">
									<label for="buruh_b" class="form-label">Buruh B</label>
									<div class="input-group has-validation">
										<input type="number" class="form-control" min="1" max="100" id="buruh_b" />
										<span class="input-group-text">%</span>
									</div>
								</div>
								<div class="col">
									<label for="buruh_c" class="form-label">Buruh C</label>
									<div class="input-group has-validation">
										<input type="number" class="form-control" min="1" max="100" id="buruh_c" />
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
							<div class="row g-3 mt-2 mb-2">
								<div class="col">
									<button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
								</div>
							</div>
						</form>
						<div class="row g-3 mt-2 mb-2">
							<div class="col">
								<h6>Buruh A</h6>
								<p id="buruh_a_output">Rp 0</p>
							</div>
							<div class="col">
								<h6>Buruh B</h6>
								<p id="buruh_b_output">Rp 0</p>
							</div>
							<div class="col">
								<h6>Buruh C</h6>
								<p id="buruh_c_output">Rp 0</p>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>

		<!-- JavaScript Bundle with Popper -->
		<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

		<script type="text/javascript">
			$(document).ready(() => {
				const inputArr = [];
				$("#form-pembayaran #input-buruh input[type=number]").each(function () {
					inputArr.push('#' + $(this).attr('id'));
				});

				$("#pembayaran, " + inputArr.join(', ')).keyup(() => {
					const pembayaran = $("#pembayaran").val() !== "" ? $("#pembayaran").val() : 0;
					const buruh_a = $("#buruh_a").val() !== "" ? $("#buruh_a").val() : 1;
					const buruh_b = $("#buruh_b").val() !== "" ? $("#buruh_b").val() : 1;
					const buruh_c = $("#buruh_c").val() !== "" ? $("#buruh_c").val() : 1;
					const hasil_buruh_a = getPercentage(pembayaran, buruh_a);
					const hasil_buruh_b = getPercentage(pembayaran, buruh_b);
					const hasil_buruh_c = getPercentage(pembayaran, buruh_c);

					$("#buruh_a_output").text(`Rp ${hasil_buruh_a}`);
					$("#buruh_b_output").text(`Rp ${hasil_buruh_b}`);
					$("#buruh_c_output").text(`Rp ${hasil_buruh_c}`);
				});


				$("#form-pembayaran").submit((e) => {
					e.preventDefault();

					if (buruh_a + buruh_b + buruh_c !== 100 && hasil_buruh_a + hasil_buruh_b + hasil_buruh_c !== pembayaran) {
						alert('Pembagian bonus masih salah!');
					}
				});
			});

			const getPercentage = (total, persen) => total * persen / 100;
		</script>
	</body>
</html>
