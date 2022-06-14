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
        <header class="header2">
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
        <main class="page2">
                <div class="main-block__container2 _container">
                    <section style="display: flex;flex-direction: row;justify-content: flex-start;align-items: flex-start;padding: 70px 0 100px 0;">  
                    <div style="margin-right: 150px;">   
                    <h1 class="main-block__title" style="font-size: 42px; padding-bottom: 35px;">Перезаключение договора</h1>
                        <div class="main-block__text">
                            <span style="padding-right: 80px;">Уважаемый клиент,</span>
                            <br>
                            Перезаключить договор можно, если Вы планируете использовать те же продукты.
                            <br>
                            <br>
                            Если Ваша фирма расширяется, и Вам необходимо автоматизировать новые бизнес-процессы, запишитесь на собеседование.
                        </div>
                        <div class="main-block__buttons">
                            <a href="sobes.php" class="main-block__button main-block__button_orange" style="margin: 40px 0;">Записаться на собеседование</a>
                        </div>
                    </div>
                        <form action="sobes_send.php" method="post" class=form style="flex-direction: column;" id="carform">
                            <input type="hidden" name="form1" value="3">
                            <div style=" margin-bottom:50px;">
                            <div style="display: flex;flex-direction: column; margin-bottom:30px;">
                            <label for="" style="margin: 15px 0;">Контактный телефон</label>
                            <input type="tel" required id="phone" name="phone" pattern="+7-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="+7-777-xxx-xx-xx" class="input_uin" style="border: 1.5px solid #3e4095;">
                            </div>
                            <div style="display: flex;flex-direction: column; margin-bottom:30px;">
                            <label for="" style="margin-bottom: 15px;">Срок продления договора</label>
                            <select name="srok">
                                <option value="3 месяца">3 месяца</option>
                                <option value="6 месяцев">6 месяцев</option>
                                <option value="1 год">1 год</option>
                            </select>
                            </div>
                            <div style="">
                            <label for="">Комментарий</label>
                            <textarea required name="problem" placeholder="Комментарий" class="input_uin" style="min-width: 31rem;max-width: 31rem;min-height: 120px; margin-top: 15px; border: 1.5px solid #3e4095;"></textarea>
                            </div>
                            </div>
                            <input type="submit" name="form2" class="login_button main-block__button main-block__button_orange" value="Отправить" style="background: white; border: 2px solid #3e4095; color: #3e4095;">
                        </form>
                        <p>
                        <?php
                        if(empty(session_id()) && !headers_sent()){
                            session_start();
                        }
                        if(isset($_SESSION['mod'])){
                            // echo $_SESSION['mod'];
                        }
                        else {
                            $_SESSION['mod'] = '011202621193';
                        }
                        $tel = $_POST['phone'];
                        $srok = $_POST['srok'];
                        $komm = $_POST['problem'];
                        if (!is_null($_POST['phone']) and $_POST['problem'] != '') {
                            $res = "SET FOREIGN_KEY_CHECKS=0";
                            $sql = "INSERT INTO dogovor_prodlen (client_id, tel, srok, komm) VALUES ((SELECT client_id from clients where cast(AES_DECRYPT(client_uin, '666srpite666') as char(100)) = '" . $_SESSION['mod'] . "'), '$tel', '$srok', '$problem')";
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
                    </section>
                        <p style="visibility: hidden;">Мы рады вас видеть</p>
                        <p style="visibility: hidden;">Мы рады вас видеть</p>
                        <p style="visibility: hidden;">Мы рады вас видеть</p>
        <footer class="footer">
            © 2022 Все права защищены. Разработчик: Серикова Дарья.
        </footer>
    </div>            

</body>
</html>