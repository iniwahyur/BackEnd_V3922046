<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form method="post" action="<?= base_url('insertproduct') ?>">
        <label for="nama_product">Nama Product:</label>
        <input type="text" id="nama_product" name="nama_product" required>
        <br><br>
        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required></textarea>
        <br><br>
        <button type="submit">Tambahkan</button>
    </form>
</body>
</html>
