<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <style>
        .headT{
            background-color: black;
            color: white;
        }
        .tab{
            text-align: center;
        }
        table {
            width:500px;
            font:normal 13px Arial;
            text-align:center;
            border-collapse:collapse;
        }
        th{
            width: 99px;
        }
    </style>
</head>
<body>
    <h1>Resultados {{$event->nombre_e}}</h1>
    <h2>Clasificacion</h2>
    <table class="table tab" border="1">
        <thead class="headT">
          <tr>
            <th scope="col">Gimnasta</th>
            <th scope="col">Ronda</th>
            <th scope="col">Aparato</th>
            <th scope="col">Dificultad</th>
            <th scope="col">Ejecucion</th>
            <th scope="col">Deducciones</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($scoresQ as $score)
                <tr>
                    <td>{{$score->gimnastas->nombre_g}} {{$score->gimnastas->apellido_g}}</td>
                    <td>{{$score->rounds->clave_r}}</td>
                    <td>{{$score->aparatos->clave_a}}</td>
                    <td>{{$score->difficulty_s}}</td>
                    <td>{{$score->execution_s}}</td>
                    <td>{{$score->deductions_s}}</td>
                    <td>{{$score->total_s}}</td>
                </tr>
            @endforeach
        </tbody>
      </table>

      <h2>Final por equipos</h2>
    <table class="table" border="1">
        <thead class="headT">
          <tr>
            <th scope="col">Gimnasta</th>
            <th scope="col">Ronda</th>
            <th scope="col">Aparato</th>
            <th scope="col">Dificultad</th>
            <th scope="col">Ejecucion</th>
            <th scope="col">Deducciones</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($scoresT as $score)
                <tr>
                    <td>{{$score->gimnastas->nombre_g}} {{$score->gimnastas->apellido_g}}</td>
                    <td>{{$score->rounds->clave_r}}</td>
                    <td>{{$score->aparatos->clave_a}}</td>
                    <td>{{$score->difficulty_s}}</td>
                    <td>{{$score->execution_s}}</td>
                    <td>{{$score->deductions_s}}</td>
                    <td>{{$score->total_s}}</td>
                </tr>
            @endforeach
        </tbody>
      </table>

    <h2>All around</h2>
    <table class="table" border="1">
        <thead class="headT">
          <tr>
            <th scope="col">Gimnasta</th>
            <th scope="col">Ronda</th>
            <th scope="col">Aparato</th>
            <th scope="col">Dificultad</th>
            <th scope="col">Ejecucion</th>
            <th scope="col">Deducciones</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($scoresA as $score)
                <tr>
                    <td>{{$score->gimnastas->nombre_g}} {{$score->gimnastas->apellido_g}}</td>
                    <td>{{$score->rounds->clave_r}}</td>
                    <td>{{$score->aparatos->clave_a}}</td>
                    <td>{{$score->difficulty_s}}</td>
                    <td>{{$score->execution_s}}</td>
                    <td>{{$score->deductions_s}}</td>
                    <td>{{$score->total_s}}</td>
                </tr>
            @endforeach
        </tbody>
      </table>

      <h2>Final individual</h2>
    <table class="table" border="1">
        <thead class="headT">
          <tr>
            <th scope="col">Gimnasta</th>
            <th scope="col">Ronda</th>
            <th scope="col">Aparato</th>
            <th scope="col">Dificultad</th>
            <th scope="col">Ejecucion</th>
            <th scope="col">Deducciones</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($scoresE as $score)
                <tr>
                    <td>{{$score->gimnastas->nombre_g}} {{$score->gimnastas->apellido_g}}</td>
                    <td>{{$score->rounds->clave_r}}</td>
                    <td>{{$score->aparatos->clave_a}}</td>
                    <td>{{$score->difficulty_s}}</td>
                    <td>{{$score->execution_s}}</td>
                    <td>{{$score->deductions_s}}</td>
                    <td>{{$score->total_s}}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>