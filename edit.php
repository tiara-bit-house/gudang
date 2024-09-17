<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <?php
    require_once 'app/database.php';

    if (!isset($_GET['id_barang'])) {
        header('Location: index.php?message="No id were given"');
        exit();
    }

    $id_barang = $_GET['id_barang'];

    $stmt = $conn->prepare("SELECT id_barang, name, stock, id_kategori FROM barang WHERE id_barang = ?");
    $stmt->bind_param('i', $id_barang);
    $stmt->execute();
    $stmt->bind_result($id_barang, $name, $stock, $id_kategori);
    $stmt->fetch();
    $stmt->close();

    if (!$name) {
        header('Location: index.php?message="Data unavailable"');
        exit();
    }
    ?>
</head>

<body>
    <form
        action="app/barang.php"
        method="POST"
        style="display: flex; flex-direction:column;width:300px;margin:auto;margin-bottom:30px;gap: 5px;">
        <input type="hidden" name="id_barang" value="<?= $id_barang ?>">
        <div>
            <label for="inputName">Nama barang</label>
            <br>
            <input type="text" required value="<?= $name ?>" name="name" id="inputName">
        </div>
        <div>
            <label for="inputStock">Stock barang</label>
            <br>
            <input type="number" value="<?= $stock ?>" required min="0" name="stock" id="inputStock">
        </div>
        <div>
            <label for="inputKategori">Kategori</label>
            <select name="id_kategori" id="inputKategori">
                <option value="" hidden>Pilih kategori</option>
                <?php
                require_once 'app/database.php';
                $resultKategori = $conn->query("SELECT * FROM kategori");
                while ($kategori = $resultKategori->fetch_object()):
                ?>
                    <option
                        <?php
                        if ($id_kategori == $kategori->id_kategori) {
                            echo "selected";
                        }
                        ?>
                        value="<?= $kategori->id_kategori ?>"><?= $kategori->name ?> </option>
                <?php endwhile ?>
            </select>
        </div>
        <button type="submit" name="updateBarang">Update barang</button>
    </form>
</body>

</html>