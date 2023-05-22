<!DOCTYPE html>
<html>

<head>
    <title>Edit Sarana</title>
</head>

<body>
    <h1>Edit Sarana</h1>
    <form action="<?= base_url('/sarana/update/' . $sarana['id']) ?>" method="post">
        <label for="nama_sarana">Nama Sarana:</label><br>
        <input type="text" id="nama_sarana" name="nama_sarana" value="<?= $sarana['nama_sarana'] ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>