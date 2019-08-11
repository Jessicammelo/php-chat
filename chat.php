<?php
require "bancoDados.php";
$grupo = $_GET['grupo'];
if (!empty($_POST['mensagem'])) {
    $mensagem = $_POST['mensagem'];
    $stmt = $conn->prepare('INSERT INTO chat (grupo,mensagem) VALUES (?,?)');
    $stmt->bindValue(1, $grupo);
    $stmt->bindValue(2, nl2br($mensagem));
    $stmt->execute();
}
if (!empty($grupo)) {
    $stmt = $conn->query('SELECT * FROM chat WHERE grupo = ' . $grupo);
    $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        setInterval(() => {
            $.ajax({
                method: "GET",
                url: "chatUpdate.php",
                data: {
                    grupo: <?php echo $grupo ?>
                },
                success: (data) => {
                    const chats = JSON.parse(data);
                    $('.update').html('');
                    chats.forEach((chat) => {
                        $('.update').append(
                            '<tr><td>' + chat.mensagem + '</td></tr>'
                        )
                    })

                }
            })
        }, 5000)
    </script>
</head>

<body class="container">
    <table class="table">
        <thead>
            <th>
                chat
            </th>
        </thead>
        <tbody class="update">
            <?php
            for ($i = 0; $i < count($chat); $i++) {
                ?>
                <tr>
                    <td>
                        <?php echo $chat[$i]['mensagem'] ?>
                    </td>
                </tr>

            <?php
            }
            ?>

        </tbody>
    </table>
    <form method="POST" action="?grupo=<?php echo $_GET['grupo'] ?>">
        <div class="form-group">
            <textarea class="form-control" name="mensagem">

            </textarea>
        </div>
        <button class="btn btn-primary">
            Enviar
        </button>
    </form>
</body>

</html>