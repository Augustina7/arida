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
                    <h1 class="main-block__title" style="font-size: 42px; padding-bottom: 35px;">Заполнение новой заявки</h1>
                        <div class="main-block__text">
                            <span style="padding-right: 80px;">Уважаемый клиент,</span>
                            <br>
                            Опишите Вашу проблему наиболее конкретным образом и прикрепите скрин при небходимости.
                        </div>
                    </div>
                        <form action="req_send.php" method="post" class=form style="flex-direction: column;">
                            <input type="hidden" name="form1" value="3">
                            <div style=" margin-bottom:50px;">
                            <div style="display: flex;flex-direction: column; margin-bottom:40px;">
                            <label for="" style="margin-bottom: 15px;">Контактный телефон</label>
                            <input type="tel" required id="phone" name="phone" pattern="+7-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="+7-777-xxx-xx-xx" class="input_uin" style="border: 1.5px solid #0D5C63;">
                            </div>
                            <div style="">
                            <label for="">Описание проблемы</label>
                            <textarea required name="problem" placeholder="Опишите Вашу проблему" class="input_uin" style="min-width: 31rem;max-width: 31rem;min-height: 216px; margin-top: 15px; border: 1.5px solid #0D5C63;"></textarea>
                            </div>
                            <label for="" style="display: block;margin: 20px 0 10px 0;">Прикрепить скриншот</label>
                            <input type="file" name="img">
                            </div>
                            <input type="submit" name="form2" class="login_button main-block__button main-block__button_orange" value="Отправить" style="background: #0D5C63;">
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