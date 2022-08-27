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
    <header style="background: #4e0189;color: #ffffff;">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-md">
                <div class="container-fluid"><a class="navbar-brand" href="{{ asset('/') }}"
                        style="color: #000000;background: #ffffff;font-weight: bold;border-width: 1px;border-style: solid;border-radius: 10px;padding: 4px 6px;">DRAGON-GAS</a><button
                        data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span
                            class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"
                            style="color: #ffffff;"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link active" href="{{ asset('/') }}"
                                    style="color: #ffffff;">Pedidos</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ asset('produto') }}"
                                    style="color: #ffffff;">Produtos</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ asset('relatorio') }}"
                                    style="color: #ffffff;">Relatorios</a></li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item" style="margin: 0px 6px 0px 0px;"><a class="nav-link active"
                                    href="#"><i class="fa fa-bell"
                                        style="color: #ffffff;font-size: 22px;"></i></a></li>
                            <li class="nav-item"><label class="switch">
                                    <input name="change" id="change" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li class="nav-item" style="margin: 0px 0px 0px 8px;"><a class="nav-link active"
                                    href="{{ asset('perfil') }}"
                                    style="background: #ffffff;border-radius: 50%;padding: 4px 8px;margin: 0px 0px 0px 0px;"><i
                                        class="fa fa-user" style="color: #4e0189;font-size: 22px;"></i></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main style="padding: 12px 0px;">
        @yield('body')
    </main>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var type;

            function alertaRetorno(data) {
                sellerId = data.id

                getOrder(sellerId);

            }
            $(function() {
                if (!localStorage.getItem('session')) window.location.href = '/login';

                $.ajax({
                    url: `{{ route('auth.seller.info') }}`,
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('session'),
                    },
                    type: 'GET',
                    success: (data) => {
                        // console.log(data.info);
                        for (i in data) {

                            $('#editar-user').find(`[name="${i}"]`).val(data[i]);

                        }
                        for (i in data.info) {

                            $('#edit-app').find(`[name="${i}"]`).val(data.info[i]);
                        }

                        alertaRetorno(data);

                    }
                });

                $.ajax({
                    url: `{{ route('product') }}`,
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('session'),
                    },
                    type: 'GET',
                    success: (data) => {
                        // console.log(data);
                        $('.table-produto').empty();
                        for (i in data.data) {
                            if (data.data[i].product_type == 1) {
                                type = 'Gás';
                            } else if (data.data[i].product_type == 2) {
                                type = 'Aguá';
                            }
                            $('.table-produto').append(`
                                <tr>
                                    <td>${type}</td>
                                    <td>${data.data[i].brand}</td>
                                    <td>${data.data[i].type}</td>
                                    <td>${data.data[i].price}</td>
                                    <td><div class="btn-group" role="group"><button class="btn btn-info" type="button" data-id="${data.data[i].id}" data-bs-target="#editar-produto" data-bs-toggle="modal">Editar</button><button class="btn btn-danger btn-apagar-product" data-id="${data.data[i].id}" type="button">Apagar</button></div></td>
                                </tr>
                            `);

                        }
                    }
                });
            });
            $(document).on('change', '#cep', function() {
                $.ajax({
                    url: `{{ route('buscacep') }}`,
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('session'),
                    },
                    type: 'GET',
                    data: {
                        zip_code: $('#cep').val(),
                    },
                    success: (data) => {
                        console.log(data);
                        $('#address').val(data.address);
                        $('#city').val(data.city);
                        $('#district').val(data.district);
                        $('#state').val(data.state);
                        $('#lat').val(data.lat);
                        $('#lng').val(data.lng);
                    }
                });

            });
            $(document).on('click', '[data-bs-target="#editar-produto"]', function() {
                $.ajax({
                    url: `{{ route('product') }}/${$(this).data('id')}`,
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('session'),
                    },
                    type: 'GET',
                    success: (data) => {
                        for (i in data) {
                            $('#editar-produto').find(`[name="${i}"]`).val(data[i]);
                        }
                    }
                });
            });

            $(document).on('click', '.btn-apagar-product', function() {
                $.ajax({
                    url: `{{ route('product') }}`,
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('session'),
                    },
                    type: 'DELETE',
                    data: {
                        products_id: [$(this).data('id')]
                    },
                    success: (data) => {
                        window.location.reload();
                    }
                });
            });

            $(document).on('click', '.btn-send', function() {
                var btn = $(this);
                var btn_text = btn.html();
                btn.html(
                    `<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Loading...</span></div>`
                );

                $.ajax({
                    url: btn.closest('form').attr('action'),
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('session'),
                    },
                    type: (btn.closest('form').attr('method') ? btn.closest('form').attr('method') :
                        'POST'),
                    data: btn.closest('form').serialize(),
                    success: (data) => {
                        console.log(data);
                        btn.html(btn_text);
                        window.location.reload();
                    }
                });
            });

            function getOrder(sellerId) {
                $.ajax({
                    url: `{{ route('orderBy') }}/${sellerId}`,
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('session'),
                    },
                    type: 'GET',
                    success: (data) => {
                        console.log(data[2])
                        $.each(data[0], (key, value) => {
                            if (value.status == 0) {

                                $('.allpedidos').append(`<div class="row pedido" style="margin-top: 12px;">
                                <div class="col" data-bs-toggle="modal" data-orderid="${value.id}" data-bs-target="#status" style="margin-bottom: 12px;border-width: 1px;border-style: solid;border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;border-radius: 6px;">
                                    <div style="padding-top: 12px;padding-bottom: 12px;"><span>${value.customer.name}, pedido: #${value.id.substring(0,4)}</span></div>
                                </div>
                            </div>`);
                                $('#total').html(`<div class="text-white bg-success d-flex justify-content-center align-items-center"
                                        style="width: 38px;height: 38px;padding: 2px;border-radius: 20px;"><span id="">${data[1]}</span>
                                    </div>`);

                            };
                            if (value.status == 1 || value.status == 2) {
                                $('.peddidos').append(`<div class="row pedido" style="margin-top: 12px;">
                                <div class="col" data-bs-toggle="modal" data-orderid="${value.id}" data-bs-target="#status" style="margin-bottom: 12px;border-width: 1px;border-style: solid;border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;border-radius: 6px;">
                                    <div style="padding-top: 12px;padding-bottom: 12px;"><span>${value.customer.name}, pedido: #${value.id.substring(0,4)}</span></div>
                                </div>
                            </div>`);
                                $('#total-andamento').html(`<div class="text-white bg-success d-flex justify-content-center align-items-center"
                                        style="width: 38px;height: 38px;padding: 2px;border-radius: 20px;"><span id="">${data[2]}</span>
                                    </div>`);

                            };



                            if (value.status == 3 || value.status == 4) {
                                $('.concluidos').append(`<div class="row pedido" style="margin-top: 12px;">
                                <div class="col" data-bs-toggle="modal" data-orderid="${value.id}" data-bs-target="#status" style="margin-bottom: 12px;border-width: 1px;border-style: solid;border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;border-radius: 6px;">
                                    <div style="padding-top: 12px;padding-bottom: 12px;"><span>${value.customer.name}, pedido: #${value.id.substring(0,4)}</span></div>
                                </div>
                            </div>`);
                                $('#total-concluido').html(`<div class="text-white bg-success d-flex justify-content-center align-items-center"
                                        style="width: 38px;height: 38px;padding: 2px;border-radius: 20px;"><span id="">${data[3]}</span>
                                    </div>`);



                            };

                        });
                    }
                });
            }
            $(document).on('click', '[data-bs-target="#status"]',
                function() {
                    console.log($(this).data('orderid'));
                    // $('#statusChange').empty();
                    $.ajax({
                        url: `{{ route('orderstatus') }}/${$(this).data('orderid')}`,
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('session'),
                        },
                        type: 'GET',
                        success: (data) => {
                            $('#statusId').val(data.id);

                        }
                    });
                });
            $(document).on('click', '.btn-enviar', function() {
                var btn = $(this);
                var btn_text = btn.html();
                btn.html(
                    `<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Loading...</span></div>`
                );

                $.ajax({
                    url: $('#form-send').attr('action'),
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('session'),
                    },
                    type: $('#form-send').attr('method'),
                    data: $('#form-send').serialize(),
                    success: (data) => {
                        console.log(data);
                        btn.html(btn_text);
                        window.location.reload();
                    }
                });
            });


        });
    </script>
</body>

</html>
