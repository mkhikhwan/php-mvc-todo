<!DOCTYPE html>
<html>
    <head>
        <title>PHP Todo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/public/css/style.css">
    </head>
    <body>
        <header>
            <nav class="navbar">
                <ul class="nav-links">
                    <li class="logo">PHP-TODO</li>
                    <?php if (!empty($_SESSION['user_id'])): ?>
                        <li><a href="/tasks">Tasks</a></li>
                        <li><a href="/logout">Logout</a></li>
                        <li><?php echo htmlspecialchars($_SESSION['username']); ?></li>
                    <?php else: ?>
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        <main class="content">
            <?php
                // View File Include Logic
                $viewFile = __DIR__ . "/../" . $viewPath . ".php";
                if(file_exists($viewFile)){
                    require $viewFile;
                }else{
                    echo "View Not Found: " . $viewPath;
                }
            ?>
        </main>
    </body>
</html>