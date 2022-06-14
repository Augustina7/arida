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
                    <div class="main-block__body" style="padding: 184px 0 132px 0;">
                        <h1 class="main-block__title">Идентификация клиента</h1>
                        <div class="main-block__text">
                            <br>
                            <span style="padding-right: 80px;">Вас приветствует ТОО "Арида-Софт"! </span>
                            Для входа в систему введите ИИН: 
                        </div>
                        <!-- <form action="index.php" class="form" method="post">
                            <p><input type="text" maxlength="12" name="client_uin" class="input_uin" placeholder="Введите Ваш ИИН"></p>
                            <p><input type="submit" name="submit" value="Войти в систему" class="login_button main-block__button main-block__button_orange"></p>
                        </form> 
                      -->
                        <form action="login.php" method="post" class=form>
                            <input type="hidden" name="form1" value="3">
                            <input type="text" maxlength="12" name="mod" placeholder="Введите ИИН" class="input_uin"><input type="submit" class="login_button main-block__button main-block__button_orange" value="Войти в систему">
                        </form>
                        <p>
                        <?php
                        session_start();
                        $_SESSION['mod'] = $mod;
                        if (!is_null($_POST['mod']) and $_POST['mod'] != '') {
                            if ($_POST['form1'] == 3) {
                                $mod = $_POST['mod'];
                                $sql = "SELECT * FROM clients WHERE `client_uin` LIKE '%$mod%'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo 'Добро пожаловать, ' . $row["client_name"] ;
                                    }
                                } else {
                                    echo "Введенный ИИН $mod не найден в базе ";
                                }
                            }
                        }
                        else {
                            echo " ";
                        } 
                        ?>
                        <?php 
                        
                        // header("Location: mod=$mod");
                        ?>
                        </p>
                        <!-- <p style="visibility: hidden;">Мы рады вас видеть</p> -->
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
    <script src="js/script.js"></script>
</body>
</html>