@extends('layout.ecomm')
@section('title')
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/menudashboard.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/kupon.css') }}"> --}}
@endsection

@section('content')

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>

        <button class="tablink" onclick="openPage('Home', this, 'red')" id="defaultOpen">Akun Saya</button>
        <button class="tablink" onclick="openPage('News', this, 'green')">Pesanan Saya</button>
        <button class="tablink" onclick="openPage('Contact', this, 'blue')">Favorites</button>
        <button class="tablink" onclick="openPage('About', this, 'orange')">Voucher Saya</button>

        <div id="Home" class="tabcontent">
            @include('layout.ecomm.module.profil')
        </div>

        <div id="News" class="tabcontent">
            @include('layout.ecomm.module.pesanan')
        </div>

        <div id="Contact" class="tabcontent">
            <h1><b>Favorites</h1><br/>
                <div class="kotak">
                    @include('layout.ecomm.module.favorites')
                </div>
        </div>

        <div id="About" class="tabcontent">
        <h1><b>Voucher Saya</h1><br/>
                <div class="kotak">
                    @include('layout.ecomm.module.voucher')
                </div>
        </div>

        <script>
        function openPage(pageName,elmnt,color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
        </script>

    </body>
</html>

@endsection
