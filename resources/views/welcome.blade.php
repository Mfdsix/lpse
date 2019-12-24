<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- Styles -->
    <style type="text/css">
        .center{
            text-align: center;
        }
        button{
            padding: 10px 20px;
            border: none;
        }
        select{
            padding: 10px 20px;
            border: 1px solid #eee;
            background: #fff;
        }
    </style>
</head>
<body>
    <div class="center">
        <h3>Hey Dude,</h3>
        <p>click button below to start getting datas</p>
        <select id="link">
            @foreach($links as $k => $v)
            <option value="{{ $v->link }}">{{ $v->name }}</option>
            @endforeach
        </select>
        <button id="get_datas">Get Datas</button>
    </div>
    <div class="container mb-4 mt-4" id="notif">
        <div class="alert alert-primary">
            Yes ketemu banyak nih, <a target="_blank" href="{{ route('import_data') }}">Import Sekarang</a>
        </div>
    </div>
    <div class="container mb-4" id="main-table">
        <table id="table" class="table table-striped">
            <thead>
                <th>Kode</th>
                <th>Nama Paket</th>
                <th>HPS</th>
                <th>Akhir Pendaftaran</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $("#notif").hide();
        $(document).ready(function(){
            $("#badge").hide();
            $("#table").hide();
            $("#get_datas").on('click', function(){
                $("#notif").hide();
                $("#get_datas").hide(300);
                $("#table").hide();
                $("#badge").show(500);
                $("tbody").html("");
                $.ajax({
                    url : '{{ route("get_data") }}',
                    method : 'POST',
                    data : {
                        _token : '{{ csrf_token() }}',
                        link : $("#link").val()
                    },
                    success : function(datas){
                        $("#main-table").html('<table id="table" class="table table-striped"><thead><th>Kode</th><th>Nama Paket</th><th>HPS</th><th>Akhir Pendaftaran</th></thead><tbody></tbody></table>');
                        $("#badge").hide();
                        $("tbody").html(datas);
                        $("#table").show(500);
                        $("#get_datas").show(500);
                        table = $("#table").dataTable();
                        $("#notif").show(500);
                    },
                    error : function(request, error, response){
                        $("#badge").hide();
                        alert('Terjadi Kesalahan');
                        $("#get_datas").show(500);
                    }
                })
            })
        })
    </script>
</body>
</html>
