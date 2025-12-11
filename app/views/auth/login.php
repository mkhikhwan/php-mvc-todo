<div class="auth-container">
    <form method="post" action="/login" class="auth-form">
        <h1>Login</h1>

        <?php if (!empty($errors['general'])): ?>
            <p style="text-align:center; color: red; font-style:italic;">*<?php echo htmlspecialchars($errors['general']); ?></p>
            <br>
        <?php endif; ?>

        <div class="auth-input-group">
            <input type="text" name="username" 
                   value="<?php echo htmlspecialchars($old['username'] ?? ''); ?>" 
                   placeholder="Username">
            <label for="username">Username</label>
        </div>

        <div class="auth-input-group">
            <input type="password" name="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <div class="auth-message">
            Don't have an account? <a href="/register">Register here.</a>
        </div>

        <button type="submit" class="auth-submit">Login</button>
    </form>
</div>
