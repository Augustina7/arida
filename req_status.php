<?php
$conn = new mysqli('localhost', 'root', '', 'arida');
?>
<?php
// error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:regular,500,600,700,800&display=swap" rel="stylesheet" />
    <title>Арида-Софт</title>
</head>
<body>
<div class="wrapper">
        <header class="header">
            <div class="header__container _container">
                <a href="index.php" class="header__logo">
                    <img src="https://opt-106822.ssl.1c-bitrix-cdn.ru/upload/main/550/logo.png?164753669410756" alt="Логотип компании">
                </a>
                <nav class="header__menu menu">
                    <ul class="menu__list">
                        <li class="menu__item">
                            <a href="https://arida.kz/" class="menu__link" target="_blank">Главная</a>
                        </li>
                        <li class="menu__item">
                            <a href="https://arida.kz/services/" class="menu__link" target="_blank">Услуги 1С</a>
                        </li>
                        <li class="menu__item">
                            <a href="https://arida.kz/production/" class="menu__link" target="_blank">Программы 1С</a>
                        </li>
                        <li class="menu__item">
                            <a href="https://arida.kz/contacts/" class="menu__link" target="_blank">Контакты</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main class="page">
            <div class="page__main-block main-block">
                <div class="main-block__container _container">
                    <div class="main-block__body" style="max-width: 400px; display: flex; align-items: flex-start; justify-content: space-around;max-width: 1000px;">
                        <div style="max-width: 500px;">
                            <h1 class="main-block__title" style="font-size: 42px; padding-bottom: 20px;">Просмотр статуса заявки</h1>
                        <?php
                        if(empty(session_id()) && !headers_sent()){
                            session_start();
                        }
                        if(isset($_SESSION['mod'])){
                            // echo $_SESSION['mod'];
                        }
                        else {
                            $_SESSION['mod'] = '011010010110';
                        }
                        // $id = "SELECT client_id from clients where cast(AES_DECRYPT(client_uin, '666srpite666') as char(100)) = '" . $_SESSION['mod'] . "' ";
                        // $sql = "SELECT * FROM orders where client_id like %$id%";
                        $sql = "SELECT * FROM orders";
                        if($result = $conn->query($sql)){
                            foreach($result as $row){
                                $client_id = $row["client_id"];
                                $problem = $row["problem"];
                                $status = $row["status_order"];
                                // $img = $row["img"];
                            }
                            echo "<div class=\"main-block__text\">".
                                        "Ваша заявка:" .
                                "<span style=\"display:block;color: black; font-size: 18px; padding: 10px 0;\"> $problem </span>" .
                                "</div>" ;

                            echo "<div class=\"main-block__text\">".
                                    "Статус заявки:" .
                                "<span style=\"display:block;color: black; font-size: 18px; padding: 10px 0;\"> $status</span>" .
                                "</div>" .
                            "</div>" ;

                        }
                        ?>
                        <div style="max-width:600px; margin-left: 70px;">
                            <div class="main-block__text" style="margin-top: -20px; margin-bottom: 20px;">
                                <br>
                                <span style="padding-right: 80px;">Получайте уведомления об изменении статуса заявки в телеграм-боте! </span>
                            </div>
                            <img src="img/uved.png" alt="Иконка уведомления" style="display:block;width:250px; height: 250px; margin: 0 auto;">
                            <br>
                            <br>
                            <input type="submit" class="login_button main-block__button main-block__button_orange" value="Получать уведомления" style="display: block; margin: 0 auto; background: #4d77ff;">
                        </div>
                    </div>
                </div>
                <div class="main-block__image _ibg">
                </div>
            </div>
        </main>
        <footer class="footer">
            © 2022 Все права защищены. Разработчик: Серикова Дарья.
        </footer>
    </div>            

</body>
</html>     