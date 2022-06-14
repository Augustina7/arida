<?php
$conn = new mysqli('localhost', 'root', '', 'arida');
?>
<?php
error_reporting(0);
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
                    <div class="main-block__body" style="max-width: 1000px;display: flex; align-items: center; justify-content:flex-start;">
                    <div>

                    <h1 class="main-block__title" style="font-size: 42px;">
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
                        $tel = $_POST['phone'];
                        $problem = $_POST['problem'];
                        $img = $_POST['img'];
                        if (!is_null($_POST['phone']) and $_POST['problem'] != '') {
                            $res = "SET FOREIGN_KEY_CHECKS=0";
                            $sql = "INSERT INTO orders (client_id, tel, problem, img) VALUES ((SELECT client_id from clients where cast(AES_DECRYPT(client_uin, '666srpite666') as char(100)) = '" . $_SESSION['mod'] . "'), '$tel', '$problem', '$img')";
                            // echo "Ваша заявка успешно отправлена!";
                            if ($conn->query($sql) === TRUE) {
                            // echo "Ваша заявка принята!";
                            } else {
                            // echo "Error: " . $sql . "<br>" . $conn->error;
                            // echo "Ошибка! Заполните все поля.";
                            } 
                        }
                        else {
                            // echo "Ошибка! Заполните все поля.";
                        } 
                        ?>
                        </h1>
                        <div class="main-block__text" style="max-width: 600px;">
                            <br>
                            <span style="padding-right: 80px;">Ваша заявка отправлена в компанию. 
                            <br>
                            Заявка находиться в следующих состояниях: </span>
                                <br>
                                1. В работе без исполнителя
                                <br>
                                2. Программист назначен, но на данный момент заявка в очереди
                                <br>
                                3. В работе с исполнителем
                                <br>
                                4. Завершена
                        </div>
                        </div>
                        <div>
                        <img src="img/req_send.jpg" alt="Иконка статуса заявки" class="img_status" style="width: 250px;height: 250px;display: block;margin: 0 auto;">
                        <a href="req_status.php">
                            <input type="submit" class="login_button main-block__button main-block__button_orange" value="Посмотреть статус заявки"  style="background: #0D5C63;">
                        </a>
                        </div>
                    


                    </div>
                    <p style="visibility: hidden;">Мы рады вас видеть</p>
                        <p style="visibility: hidden;">Мы рады вас видеть</p>
                        <p style="visibility: hidden;">Мы рады вас видеть</p>
                </div>
                <div class="main-block__image _ibg">
                    <!-- <img src="img/mainblock/cover.jpg" alt="cover"> -->
                </div>
            </div>
        </main>
        <footer class="footer">
            © 2022 Все права защищены. Разработчик: Серикова Дарья.
        </footer>
    </div>            

</body>
</html>     