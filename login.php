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
<body><div class="wrapper">
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
                    <div class="main-block__body" style="max-width: 700px; padding: 184px 0 0px 0;">
                        <h1 class="main-block__title" style="font-size: 42px;">
                        <?php
                            if (!is_null($_POST['mod']) and $_POST['mod'] != '') {
                                if ($_POST['form1'] == 3) {
                                    $mod = $_POST['mod'];
                                    $sql = "SELECT * FROM clients WHERE cast(AES_DECRYPT(client_uin, '666srpite666') as char(100)) LIKE '%$mod%'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo 'Добро пожаловать, ';
                                            ?>
                                            <br>
                                            <?php
                                            echo  $row["client_name"] ;
                                            ?>
                                            </h1>
                                            <?php
                                            $sql = "SELECT client_id FROM clients where cast(AES_DECRYPT(client_uin, '666srpite666') as char(100)) LIKE '%$mod%'";
                                            if($result = $conn->query($sql)){
                                                while($row = $result->fetch_array()){
                                                    $userid = $row["client_id"];
                                                }
                                            }
                                            $sql = "SELECT validation FROM contracts where client_id LIKE '%$userid%'";
                                            if($result = $conn->query($sql)){
                                                while($row = $result->fetch_array()){
                                                    $val = $row["validation"];
                                                    if ($val == 1) {
                                                        echo "<div class=\"main-block__text\">".
                                                        "Не ждите очереди по телефону, оформите заявку прямо сейчас!" .
                                                        "</div>" .
                                                        "<div class=\"main-block__buttons\">" .
                                                        "<a href=\"new_request.php\" class=\"main-block__button main-block__button_orange\">Заполнить новую заявку</a>" .
                                                        "<a href=\"req_status.php\" class=\"main-block__button main-block__button_border\">Просмотреть статус заявки</a>" .
                                                        "</div>" ;
                                            } 
                                            else {
                                                echo "<div class=\"main-block__text\">".
                                                "Ваш договор недействителен. Для того, чтобы продолжить работу с компанией \"Арида-Софт\", перезаключите договор.".
                                                "<br>".
                                                "<br>".
                                                "Оставьте заявку на перезаключение договора:".
                                                "</div>" .
                                                "<div class=\"main-block__buttons\">" .
                                                "<a href=\"new_dogovor.php\" class=\"main-block__button main-block__button_orange\">Оставить заявку</a>" .
                                                "</div>" ;
                                            }
                                                }
                                            }
                                        }
                                    } else {
                                        echo "Введенный ИИН $mod не найден в базе ";
                                        ?>
                                            </h1>
                                            <?php
                                        echo "<div class=\"main-block__text\">".
                                            "Для работы с компанией \"Арида-Софт\" Вам необходимо заключить договор." .
                                            "</div>" ;
                                        echo "<div class=\"main-block__text\">".
                                            "Если Вашей компании необходима автоматизация бизнес-процессов, запишитесь на собеседование!" .
                                            "</div>" .
                                        "<div class=\"main-block__buttons\">" .
                                            "<a href=\"sobes.php\" class=\"main-block__button main-block__button_orange\">Записаться на собеседование</a>" .
                                        "</div>" ;

                                    }
                                }
                            }
                            else {
                                echo " ";
                            } 
                            ?>  
                        
                        <p style="visibility: hidden;">Мы рады вас видеть</p>
                        <p style="visibility: hidden;">Мы рады вас видеть</p>
                    </div>
                </div>
                <div class="main-block__image _ibg">
                    <img src="img/mainblock/cover.jpg" alt="cover">
                </div>
            </div>
        </main>
        <footer class="footer">
            © 2022 Все права защищены. Разработчик: Серикова Дарья.
        </footer>
    </div>
    </div>                    
</body>
</html>


<!-- INSERT INTO clients (client_name, client_uin) VALUES ('Серикова Дарья Леонидовна', AES_ENCRYPT ('uin1212122','666srpite666')); -->
<!-- select client_id, client_name, cast(AES_DECRYPT(client_uin, '666srpite666') as char(100)) from clients  -->

<!-- INSERT INTO clients (client_name, client_uin) VALUES ('Бурханов Руслан Ренатович', DES_ENCRYPT ('030820641186','666srpite666')); -->
<!-- select client_id, client_name, cast(DES_DECRYPT(client_uin, '666srpite666') as char(100)) from clients  -->