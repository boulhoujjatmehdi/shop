<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create product</title>
</head>
<body>
    <form action="{{route('product.store')}}" method="POST">
        @csrf
    title : <input type="text" name="title" value="{{old('title')}}" ><br>
    price : <input type="text" name="price" value="{{old('price')}}" ><br>
    size : <input type="text" name="size" value="{{old('size')}}" ><br>
    color : <input type="text" name="color" value="{{old('color')}}" ><br>
    description : <input type="text" name="description" value="{{old('description')}}" ><br>
    additional_info : <input type="text" name="additional_info" value="{{old('additional_info')}}" ><br>
    stock : <input type="text" name="stock" value="{{old('stock')}}" ><br>
    categorie_id : <input type="text" name="categorie_id" value="{{old('categorie_id')}}" ><br>


    

    <button type="submit">create</button>
    </form>

</body>
</html>