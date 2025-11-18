<h2>Login</h2>

<?php if (!empty($errors['general'])): ?>
    <p class="error"><?php echo htmlspecialchars($errors['general']); ?></p>
<?php endif; ?>

<form method="post" action="/login">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($old['username'] ?? ''); ?>">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>

    <input type="submit" value="Register">
</form>