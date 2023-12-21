<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Form Agama</title>
</head>
<body>
    <div class='container mt-5'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <form action="{{ route('form.submit') }}" method="post">
                    @csrf
                    <h2 class="text-center mb-4">INPUT AGAMA</h2>
                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <input type="text" name="field_name" class="form-control" id="agama" aria-describedby="agama" placeholder="Field">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
