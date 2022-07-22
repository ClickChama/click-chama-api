<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ClickChamaPainel</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Toggle-Switch-1.css">
    <link rel="stylesheet" href="assets/css/Toggle-Switch.css">
</head>

<body>
    <main style="height: 100vh;">
        <div class="container" style="height: 100%;">
            <div class="row justify-content-center align-items-center" style="height: 100%;">
                <div class="col-12 col-sm-8 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Login Click Chama</h4>
                            <form action="{{route('auth.seller.login')}}">
                                <div class="row justify-content-center">
                                    <div class="col-10 mb-2"><label class="form-label">Email</label><input type="email" class="form-control" name="email"></div>
                                    <div class="col-10 mb-2"><label class="form-label">Senha</label><input type="password" class="form-control" name="password"></div>
                                    <div class="col-10 mb-2"><button class="btn btn-primary btn-send" type="button" style="width: 100%;">ENTRAR</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $(document).on('click', '.btn-send', function(){
                var btn = $(this);
                var btn_text = btn.html();
                btn.html(`<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Loading...</span></div>`);

                $.ajax({
                    url: btn.closest('form').attr('action'),
                    headers: {
                        'Authorization': 'Basic '+btoa(`${$('[name="email"]').val()}:${$('[name="password"]').val()}`),
                    },
                    type: 'POST',
                    data: btn.closest('form').serialize(),
                    success: (data) => {
                        // console.log(data);
                        btn.html(btn_text);
                        localStorage.setItem('session', data.access_token);
                        window.location.href = '/';
                    }
                });
            });
        });
    </script>
</body>

</html>