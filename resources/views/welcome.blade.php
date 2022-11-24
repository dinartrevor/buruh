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
                    <form class="needs-validation">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="firstName" class="form-label">Pembayaran</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">RP</span>
                                    <input type="text" class="form-control" id="pembayaran" placeholder="Pembayaran" >
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="username" class="form-label">Buruh A</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="buruh_a">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-6">
                                <label for="username" class="form-label">Buruh B</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="buruh_b">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-2 mb-2">
                            <div class="col-6">
                                <label for="username" class="form-label">Buruh C</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="buruh_c">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <button class="w-100 btn btn-primary btn-lg" type="submit" id="button-pembayaran">Continue to checkout</button>
                    </form>
                </div>
                </div>
            </main>

        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

        <script>
            $( document ).ready(function() {
                $("#pembayaran, #buruh_a").on("change", function(){
                    let pembayaran =  $("#pembayaran").val() !== "" ? parseInt($(this).val()) : 0;
                    let buruh_a = $("#buruh_a").val() !== "" ? parseInt($(this).val()) : 0;
                    let hasil =  buruh_a/100*pembayaran;
                    console.log(hasil);
                });

                $("#button-pembayaran").on("click", function(){
                   
                    
                    
                })
            });
        </script>
    </body>
</html>
