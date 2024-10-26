<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>{{ $code }} Error</title>
    <link href=
                  "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
          rel="stylesheet" />
    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
<div class="col-md-12 text-center">
    <h1>{{ $code }}</h1>
    <p>{{ $message }}</p>
</div>
</body>

</html>