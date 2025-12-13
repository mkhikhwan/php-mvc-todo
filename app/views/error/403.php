<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>403 · Forbidden</title>
        <style>
            * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            }


            body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: #111827;
            }


            .container {
            text-align: center;
            max-width: 420px;
            padding: 32px;
            }


            .code {
            font-size: 96px;
            font-weight: 700;
            letter-spacing: -2px;
            color: #e5e7eb;
            line-height: 1;
            }


            h1 {
            font-size: 24px;
            font-weight: 600;
            margin-top: 16px;
            }


            p {
            font-size: 15px;
            color: #6b7280;
            margin-top: 12px;
            line-height: 1.6;
            }


            .actions {
            margin-top: 28px;
            display: flex;
            justify-content: center;
            gap: 12px;
            }


            a {
            text-decoration: none;
            font-size: 14px;
            padding: 10px 16px;
            border-radius: 8px;
            transition: all 0.15s ease;
            }


            .primary {
            background: #111827;
            color: #ffffff;
            }


            .primary:hover {
            background: #000000;
            }


            .secondary {
            background: #f3f4f6;
            color: #111827;
            }


            .secondary:hover {
            background: #e5e7eb;
            }


            footer {
            margin-top: 32px;
            font-size: 12px;
            color: #9ca3af;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="code">403</div>
            <h1>Access Forbidden</h1>
            <p>
                Sorry, you don’t have permission to access this page.
            </p>

            <div class="actions">
                <a href="/" class="primary">Go Home</a>
                <a href="javascript:history.back()" class="secondary">Go Back</a>
            </div>

            <footer>
                © <?= date('Y') ?> · Your App Name
            </footer>
        </div>
    </body>
</html>