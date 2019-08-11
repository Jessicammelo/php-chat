<?php
require "bancoDados.php";
try {
    $stmt = $conn->query('SELECT * FROM grupo');
    $grupos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $erro) {
    print_r($erro);
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <table class="table">
        <thead>
            <th>
                Grupo
            </th>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($grupos); $i++) {
                ?>

                <tr>
                    <td>
                        <a href="chat.php?grupo=<?php echo $grupos[$i]['id']?>">
                        <?php echo $grupos[$i]['nome'];?>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</body>

</html>