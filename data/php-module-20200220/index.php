<?php
ob_start();
session_start();
$_SESSION['lang'] = 'vi';

    // Tải thư viện
    require_once ('libs/constants.php');
    require_once ('libs/db.php');
    require_once ('libs/utils.php');
    // Xử lý module và action truyền từ URL
	$module = isset($_GET['m']) ? $_GET['m'] : 'home';
    $action = isset($_GET['a']) ? $_GET['a'] : 'list';
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $page_index = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_size = isset($_GET['page_size']) ? $_GET['page_size'] : 1;
    $deleted = isset($_GET['deleted']) ? $_GET['deleted'] : -1;
    
    // Check xem đã login chưa?
    if (isset($_SESSION['username'])) {
        if (in_array($module, ['account'])) {
            header('Location: index.php');
        }
    } else {
        if (! in_array($module, ['home', 'account', 'language', 'rss', 'weather'])) {
            header('Location: index.php?m=account&a=login');
        }
    }

    $file = '';
	switch ($module) {
        case 'home':
            $file = 'modules/training/home/home.php';
            break;
        case 'project':
            $file = 'modules/training/project/project.php';
            break;
        case 'task':
            $file = 'modules/training/task/task.php';
            switch ($action) {
                case 'export':
                    include($file);
                    die();
                default:
            }
            break;
        case 'user':
            $file = 'modules/training/user/user.php';
            break;
        case 'api':
            $file = 'modules/training/api/api.php';
            include($file);
            break;
        case 'anhttc':
            $file = 'modules/students/anhttc/anhttc.php';
            break;
        case 'ducnm':
            $file = 'modules/students/ducnm/ducnm.php';
            break;
        case 'huudat':
            $file = 'modules/students/huudat/huudat.php';
            break;
        case 'lananh':
            $file = 'modules/students/lananh/lananh.php';
            break;
        case 'ngandt':
            $file = 'modules/students/ngandt/ngandt.php';
            break;
        case 'thachht':
            $file = 'modules/students/thachht/thachht.php';
            break;
        case 'tuanqt':
            $file = 'modules/students/tuanqt/tuanqt.php';
            break;
        case 'ajax':
            $file = 'modules/training/ajax/ajax.php';
            include($file);die();
            break;
        case 'account':
            $file = 'modules/training/account/account.php';
            break;
        case 'language':
            $file = 'modules/training/language/language.php';
            break;
        case 'rss':
            $file = 'modules/training/rss/rss.php';
            break;
        case 'weather':
            $file = 'modules/training/weather/weather.php';
            break;
        default:
            $file = 'modules/training/home/home.php';
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <?php if ($module === 'rss') : ?>
    <meta http-equiv="refresh" content="180"/>
    <?php endif; ?>
    <title>My Office: <?php echo $module ?></title>
    <!-- Bootstrap core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="public/css/sticky-footer.css" rel="stylesheet" crossorigin="anonymous">
    <link href="public/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="public/css/select2.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="public/css/style.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="public/css/jumbotron.css" rel="stylesheet">
    <script src="public/js/jquery-3.4.1.min.js"></script>
    <script src="public/js/jquery.number.min.js"></script>
    <script src="public/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php">MyOffice</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <!-- Home -->
            <li class="nav-item <?php if ($module === 'home') echo 'active'; ?>">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <!-- RSS -->
            <ul class="navbar-nav mr-0">
                <li class="nav-item dropdown dropdown-menu-right <?php if ($module === 'rss') echo 'show'; ?>">
                    <a class="nav-link dropdown-toggle"
                       href="#" id="dropdown-rss" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">RSS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-rss">
                        <a class="dropdown-item" href="index.php?m=rss&a=vnexpress.net">
                            <i class="fa fa-rss"></i> Tin từ vnexpress.net <?php if ($action === 'vnexpress.net') echo ' <i class="fa fa-check"></i>'; ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?m=rss&a=dantri.com.vn">
                            <i class="fa fa-rss"></i> Tin từ dantri.com.vn <?php if ($action === 'dantri.com.vn') echo ' <i class="fa fa-check"></i>'; ?></a>
                    </div>
                </li>
            </ul>
            <li class="nav-item <?php if ($module === 'weather') echo 'active'; ?>">
                <a class="nav-link" href="index.php?m=weather&a=edupham">Weather <span class="sr-only">(current)</span></a>
            </li>
            <!-- Chức năng -->
            <?php if (isset($_SESSION['username']) && $_SESSION['username']): ?>
            <li class="nav-item <?php if ($module === 'user') echo 'active'; ?>">
                <a class="nav-link" href="index.php?m=user&a=list">User</a>
            </li>
            <li class="nav-item <?php if ($module === 'project') echo 'active'; ?>">
                <a class="nav-link" href="index.php?m=project&a=list">Project</a>
            </li>
            <li class="nav-item <?php if ($module === 'task') echo 'active'; ?>">
                <a class="nav-link" href="index.php?m=task&a=list">Task</a>
            </li>
            <!-- Đăng nhập/Đăng ký -->
            <?php else: ?>
                <li class="nav-item <?php if ($module === 'account' && $action === 'login') echo 'active'; ?>">
                    <a class="nav-link" href="index.php?m=account&a=login">Đăng nhập</a>
                </li>
                <li class="nav-item <?php if ($module === 'account' && $action === 'register') echo 'active'; ?>">
                    <a class="nav-link" href="index.php?m=account&a=register">Đăng ký</a>
                </li>
            <?php endif; ?>
        </ul>
        <!-- Ngôn ngữ -->
        <ul class="navbar-nav mr-0">
            <li class="nav-item dropdown dropdown-menu-right">
                <a class="nav-link dropdown-toggle"
                   href="#" id="dropdown-lang" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-language"></i> Ngôn ngữ
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown-lang">
                    <a class="dropdown-item" href="index.php?m=language&a=vi">
                        <img src="public/images/languages/vi.png"> Tiếng Việt</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?m=language&a=en">
                        <img src="public/images/languages/en.png"> Tiếng Anh</a>
                </div>
            </li>
        </ul>
        <!-- Tài khoản -->
        <?php if (isset($_SESSION['username']) && $_SESSION['username']): ?>
        <ul class="navbar-nav mr-0">
            <li class="nav-item dropdown dropdown-menu-right">
                <a class="nav-link dropdown-toggle"
                   href="#" id="dropdown-account" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle-o"></i> <?php echo $_SESSION['username'] ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown-account">
                    <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Thông tin cá nhân</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="confirmLogout()">Thoát</a>
                </div>
            </li>
        </ul>
        <?php endif; ?>
    </div>
</nav>

<main role="main">
    <?php if ($module == 'home') { ?>
    <?php include($file) ?>
    <?php } else { ?>
        <div class="container">
            <div class="row" style="position: relative">
                <?php include($file) ?>
            </div>
        </div>
    <?php } ?>
</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <span>&copy; by DCV 2020</span>
    </div>
</footer>
<script src="public/js/select2.min.js"></script>
<script>
    function confirmLogout() {
        var ask = confirm('Bạn có chắc chắn muốn thoát không?');
        if (ask) {
            window.location.href = "index.php?m=account&a=logout";
        } else {
            return false;
        }
    }
</script>
</body>
</html>
<?php isset($conn) ? mysqli_close($conn) : null ?>
