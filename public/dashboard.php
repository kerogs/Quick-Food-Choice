<?php

require_once('../config.php');

$serverConfig = json_decode(file_get_contents('../backend/serverConfig.json'), true);

switch ($serverConfig["theme"]) {
    case 'light':
        file_exists('src/css/admin_light.css') ? $cssPath = '<link rel="stylesheet" href="src/css/admin_light.css">' : $cssPath = '<link rel="stylesheet" href="src/css/admin.css">';
        break;
    case 'kslabs':
        file_exists('src/css/admin_kslabs.css') ? $cssPath = '<link rel="stylesheet" href="src/css/admin_kslabs.css">' : $cssPath = '<link rel="stylesheet" href="src/css/admin.css">';
    default:
        $cssPath = '<link rel="stylesheet" href="src/css/admin.css">';
        break;
}

?>

<!DOCTYPE html>
<html lang="<?= $kpf_config["seo"]["lang_short"] ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../inc/head.php' ?>
    <title><?= $kpf_config["seo"]["title_short"] ?> | dashboard</title>
    <?= $cssPath ?>

    <!-- src -->
    <link rel="stylesheet" href="./node_modules/boxicons/css/boxicons.min.css">
</head>

<body>
    <div class="dashboard">
        <aside>
            <nav>
                <ul>
                    <li onclick="showPage('Show all')" class="active">Show all</li>
                    <hr>
                    <li onclick="showPage('Cooks account')">Cooks account</li>
                </ul>
            </nav>
        </aside>
        <main>
            <?php if (isset($_GET['ok'])) : ?>
                <p style="margin:0 0 10px 0;color:green;background-color:#00ff0020;padding:10px;border-radius:10px;width:100%;"><?= htmlspecialchars($_GET['ok']) ?></p>
            <?php elseif (isset($_GET['ko'])) : ?>
                <p style="margin:0 0 10px 0;color:red;background-color:#ff000020;padding:10px;border-radius:10px;width:100%;"><?= htmlspecialchars($_GET['ko']) ?></p>
            <?php endif ?>
            <section id="Cooks account" class="cadre">
                <div class="title">
                    <h2>Cooks account</h2>
                </div>
                <div>
                    <form action="form/addcook.php" class="littleForm" method="post">
                        <input placeholder="Enter ID" type="text" name="id" id="" required minlength="8" maxlength="20">
                        <button type="submit">Add Cook</button>
                    </form>
                </div>
                <?php

                $cookAccountPath = '../backend/cookAccount.json';
                if (!file_exists($cookAccountPath)) {
                    file_put_contents($cookAccountPath, json_encode([]));
                }

                $cookAccountList = json_decode(file_get_contents($cookAccountPath), true);
                ?>

                <table>
                    <thead>
                        <tr>
                            <th>Cook ID</th>
                            <th>Number of orders made</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($cookAccountList) > 0): ?>
                            <?php foreach ($cookAccountList as $cook): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($cook['id']); ?></td>
                                    <td><?php echo htmlspecialchars($cook['order']); ?></td>
                                    <td><a href="form/deletecook.php?id=<?php echo $cook['id']; ?>"><button class="delete">Delete</button></a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No existing cook</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>


        </main>
    </div>
    <?php require_once '../inc/script.php' ?>
</body>
<script>
    let allli = document.querySelectorAll("nav ul li");
    let allsection = document.querySelectorAll("main section");

    function showPage(page) {
        if (page == 'Show all') {
            allli.forEach(li => {
                if (li.innerText == page) {
                    li.classList.add("active");
                } else {
                    li.classList.remove("active");
                }
            })
            allsection.forEach(section => {
                section.style.display = "block";
            })
        } else {
            // show only section with same id
            allli.forEach(li => {
                li.classList.remove("active");

                if (li.innerText == page) {
                    li.classList.add("active");
                }
            })

            allsection.forEach(section => {
                section.style.display = "none";

                if (section.id == page) {
                    section.style.display = "block";
                }
            })
        }
    }
</script>

</html>