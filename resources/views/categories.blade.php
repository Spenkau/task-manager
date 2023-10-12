<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
</head>
<body>
<ul>
    @foreach($categories as $category)
        <li>{{ $category['name'] }}</li>
        <ul>
            @if($category['children_categories'])
                @foreach($category['children_categories'] as $childCategory)
                    <li>{{ $childCategory['name'] }}</li>
                    <ul>
                        @if($childCategory['categories'])
                            @foreach($childCategory['categories'] as $subCategory)
                                <li>{{ $subCategory['name'] }}</li>
                            @endforeach
                        @endif
                    </ul>
                @endforeach
            @endif
        </ul>
    @endforeach
</ul>
</body>
</html>
