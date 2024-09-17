<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <?php
    require_once 'app/database.php';
    ?>
</head>

<body>
    <form
        action="app/barang.php"
        method="POST"
        style="display: flex; flex-direction:column;width:300px;margin:auto;margin-bottom:30px;gap: 5px;">
        <div>
            <label for="inputName">Nama barang</label>
            <br>
            <input type="text" required name="name" id="inputName">
        </div>
        <div>
            <label for="inputStock">Stock barang</label>
            <br>
            <input type="number" required min="0" name="stock" id="inputStock">
        </div>
        <div>
            <label for="inputKategori">Kategori</label>
            <select name="id_kategori" id="inputKategori">
                <option value="" hidden>Pilih kategori</option>
                <?php
                $resultKategori = $conn->query("SELECT * FROM kategori");
                while ($kategori = $resultKategori->fetch_object()):
                ?>
                    <option value="<?= $kategori->id_kategori ?>"><?= $kategori->name ?> </option>
                <?php endwhile ?>
            </select>
        </div>
        <button type="submit" name="saveBarang">Save barang</button>
    </form>

    <table border="1" style="margin: auto; width: 500px;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Stock</th>
                <th>Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query(
                "SELECT
                barang.id_barang, kategori.id_kategori,
                barang.name AS 'nama_barang', kategori.name AS 'nama_kategori',
                barang.stock
                from barang 
                JOIN kategori ON barang.id_kategori = kategori.id_kategori"
            );
            $increment = 1;
            while ($data =  $result->fetch_object()):
            ?>
                <tr>
                    <td><?php echo $increment ?></td>
                    <td><?php echo $data->nama_barang ?></td>
                    <td><?php echo $data->stock ?></td>
                    <td><?php echo $data->nama_kategori ?></td>
                    <td style="display: flex; justify-content: space-between;">
                        <a href="edit.php?id_barang=<?= $data->id_barang ?>">
                            Edit
                        </a>
                        <form
                            action="app/barang.php"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data?')">
                            <input type="hidden" name="id_barang" value="<?= $data->id_barang ?>">
                            <button type="submit" name="deleteBarang">Delete</button>
                        </form>
                    </td>
                </tr>

            <?php
                $increment++;
            endwhile;
            ?>

        </tbody>
    </table>
</body>

</html>