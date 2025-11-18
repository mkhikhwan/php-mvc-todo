<h2>Register</h2>

<?php if (!empty($errors['general'])): ?>
    <p class="error"><?php echo htmlspecialchars($errors['general']); ?></p>
<?php endif; ?>

<form method="post" action="/register">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($old['username'] ?? ''); ?>">
        <?php if (!empty($errors['username'])): ?>
            <small><?php echo htmlspecialchars($errors['username']) ?></small>
        <?php endif ?>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
        <?php if (!empty($errors['email'])): ?>
            <small><?php echo htmlspecialchars($errors['email']) ?></small>
        <?php endif ?>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
        <?php if (!empty($errors['password'])): ?>
            <small><?php echo htmlspecialchars($errors['password']) ?></small>
        <?php endif ?>
    </div>
    <div>
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword">
        <?php if (!empty($errors['confirmPassword'])): ?>
            <small><?php echo htmlspecialchars($errors['confirmPassword']) ?></small>
        <?php endif ?>
    </div>

    <input type="submit" value="Register">
</form>