<!DOCTYPE html>
<html>
    <head>
        <title>PHP Todo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/public/css/style.css">
    </head>
    <body>
        <header>
            <nav>
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <a href="/tasks">Tasks</a> |
                    <a href="/logout">Logout</a> |
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                <?php else: ?>
                    <a href="/login">Login</a> |
                    <a href="/register">Register</a>
                <?php endif; ?>
            </nav>
        </header>

        <main>
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