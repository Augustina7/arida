<?php
$conn = new mysqli('localhost', 'root', '', 'arida');
?>
                            <form action="dddd.php" method="post" class=form style="flex-direction: column;">
                            <input type="hidden" name="form1" value="3">
                            <div style=" margin-bottom:50px;">
                            <div style="display: flex;flex-direction: column; margin-bottom:40px;">
                            <label for="" style="margin-bottom: 15px;">Контакный телефон</label>
                            <input type="tel" name="phone" pattern="+7-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="+7-777-xxx-xx-xx" class="input_uin" style="border: 1.5px solid #0D5C63;">
                            <!-- <input type="text" maxlength="12" name="mod" placeholder="Введите номер" class="input_uin" style="border: 1.5px solid #0D5C63;"> -->
                            </div>
                            <div style="">
                            <label for="">Описание проблемы</label>
                            <textarea name="problem"></textarea>
                            </div>
                            </div>
                            <input type="submit" name="form1" value="Отправить" style="background: #0D5C63;">
                        </form>
                        <p>
                        <?php
                        if(empty(session_id()) && !headers_sent()){
                            session_start();
                        }
                        if(isset($_SESSION['mod'])){
                            echo $_SESSION['mod'];
                        }
                        else {
                            $_SESSION['mod'] = '011010010110';
                        }
                        // if(isset($_SESSION['mod'])){
                        //     echo $_SESSION['mod'];
                        // }
                            $tel = $_POST['phone'];
                            $problem = $_POST['problem'];
                            $res = "SET FOREIGN_KEY_CHECKS=0";
                            $sql = "INSERT INTO orders (client_id, tel, problem) VALUES ((SELECT client_id from clients where cast(AES_DECRYPT(client_uin, '666srpite666') as char(100)) = '" . $_SESSION['mod'] . "'), '$tel', '$problem')";
                            if ($conn->query($sql) === TRUE) {
                            //   echo "New record created successfully";
                            } else {
                            //   echo "Error: " . $sql . "<br>" . $conn->error;
                            } 
                        ?>