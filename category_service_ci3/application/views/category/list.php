<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td>
                        <?php echo $category->id ?>
                    </td>
                    <td>
                        <?php echo $category->name ?>
                    </td>
                    <td>
                        <?php echo $category->created_at ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </div>
</body>

</html>