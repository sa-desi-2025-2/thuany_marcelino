<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ewo</title>
</head>

<body>
<select name="linha" id="linha">
        <option value="">Selecione...</option>
            <?php foreach ($lista as $item): ?>
                <option value="<?= $item['id_linha'] ?>">
                <?= htmlspecialchars($item['nome_linha']) ?>
                </option>
            <?php endforeach ?>
    </select>


</body>

</html>