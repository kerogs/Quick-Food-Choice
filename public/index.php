<?php

// require_once('../config.php');

$serverConfig = json_decode(file_get_contents('../backend/serverConfig.json'), true);

// print_r($serverConfig);



switch ($serverConfig["theme"]) {
    case 'light':
        file_exists('src/css/login_light.css') ? $cssPath = '<link rel="stylesheet" href="src/css/login_light.css">' : $cssPath = '<link rel="stylesheet" href="src/css/login.css">';
        break;
    default:
        file_exists('src/css/login.css') ? $cssPath = '<link rel="stylesheet" href="src/css/login.css">' : $cssPath = '<link rel="stylesheet" href="src/css/login_light.css">';
        break;
}

?>

<!DOCTYPE html>
<html lang="<?= $kpf_config["seo"]["lang_short"] ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../inc/head.php' ?>
    <title><?= $kpf_config["seo"]["title_short"] ?></title>
    <?= $cssPath ?>

    <!-- src -->
    <link rel="stylesheet" href="./node_modules/boxicons/css/boxicons.min.css">
</head>

<body>

    <div class="topbuttonlist" style="display: none">
        <button onclick="showLogin('customer')">customer</button>
        <button onclick="showLogin('cook')">Cook</button>
        <button onclick="showLogin('admin')">Administrator</button>
    </div>

    <div class="ccenter">
        <h2>Please choose your role.</h2>
        <div class="buttonList">
            <button onclick="showLogin('customer')">customer</button>
            <button onclick="showLogin('cook')">Cook</button>
            <button onclick="showLogin('admin')">Administrator</button>
        </div>

        <div id="formShow">
        </div>


        <script>
            function showLogin(role) {
                let formShow = document.querySelector('#formShow');

                document.querySelector(".buttonList").style.display = "none";
                document.querySelector(".topbuttonlist").style.display = "flex";

                if (role == 'customer') {
                    formShow.innerHTML = `
                            <form action="">
                                <div class="group">
                                    <label for="">Table Number</label>
                                    <input type="number" name="id" id="" minlength="1" maxlength="3" required>
                                    <input type="hidden" name="role" value="customer">
                                </div>
                                <button type="submit">Submit</button>
                            </form>
                    `;
                }
                if (role == 'cook') {
                    formShow.innerHTML = `
                    <form action="">
                        <div class="group">
                            <label for="">Account ID</label>
                            <input type="password" name="id" minlength="8" maxlength="10" id="" required>
                            <input type="hidden" name="role" value="cook"/>
                        </div>
                        <button type="submit">Submit</button>
                    </form>`;
                }
                if(role == 'admin') {
                    formShow.innerHTML = `
                    <form action="">
                        <div class="group">
                            <label for="">Password</label>
                            <input type="password" name="id" minlength="8" maxlength="16" id="" required>
                            <input type="hidden" name="role" value="admin"/>
                        </div>
                        <button type="submit">Submit</button>
                    </form>`
                }
            }
        </script>

    </div>
    <?php require_once '../inc/script.php' ?>
</body>

</html>