<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="{{ route('subir.excel')  }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="file">Conversiones
{{--        <br>--}}
{{--        <input type="file" name="interpretaciones" id="file2">Interpretaciones--}}
{{--        <br>--}}
{{--        <input type="file" name="interValidez" id="file3">Interpretaciones de Validez--}}
{{--        <br>--}}
{{--        <input type="file" name="escalas" id="file4">Escalas--}}
{{--        <br>--}}
        <button>Importar archivos</button>
    </form>
</body>
</html>
