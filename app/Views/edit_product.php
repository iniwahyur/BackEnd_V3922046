<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?= base_url('update-product/'. $product->id)?>">
        <label for="nama_product">Nama Product</label>
        <input value="<?=$product->nama_product?>"type="text" name="nama_product" id="nama_product">

        <label for="description">Deskripsi</label>
        <input value="<?=$product->description?>"type="text" name="description" id="description">

        <button type="submit">Update</button>
    </form>
</body>
</html>