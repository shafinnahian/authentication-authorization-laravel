<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Register an Admin</h1>
    <form method="post" action="{{route('admin.store')}}">
        @csrf
        @method('post')
        <div>
            <label for="">Name</label>
            <input type="text" name="name" placeholder="name" />
            <input type="text" name="email" placeholder="email" />
            <input type="password" name="password" placeholder="password" />
        </div>
        <div>
            <input type="submit" value="Save" />
        </div>
    </form>
</body>
</html>