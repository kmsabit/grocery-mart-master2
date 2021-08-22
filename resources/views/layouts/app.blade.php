<!DOCTYPE html>
<html lang="en">

@include('client.include.header')

<body class="goto-here">

@include('client.include.navbar')

{{--Start Content--}}

@yield('content')

{{--End Content--}}


@include('client.include.footer')

</body>
</html>
