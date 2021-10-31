<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('import-clients')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>File Upload</label>
        <input type="file" name="file"/>
        <input type="submit"/>
    </form>
</body>
</html>