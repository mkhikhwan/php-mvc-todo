<div class="auth-container">
    <?php if (!empty($errors['general'])): ?>
        <p class="error"><?php echo htmlspecialchars($errors['general']); ?></p>
    <?php endif; ?>

    <form method="post" action="/register" class="auth-form">
        <h1>Registration</h1>
        <div class="auth-input-group">
            <input type="text" name="username" value="<?php echo htmlspecialchars($old['username'] ?? ''); ?>" placeholder="Username">
            <label for="username">Username</label>
            <?php if (!empty($errors['username'])): ?>
                <small>*<?php echo htmlspecialchars($errors['username']) ?></small>
            <?php endif ?>
        </div>
        <div class="auth-input-group">
            <input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" placeholder="Email">
            <label for="email">Email</label>
            <?php if (!empty($errors['email'])): ?>
                <small>*<?php echo htmlspecialchars($errors['email']) ?></small>
            <?php endif ?>
        </div>
        <div class="auth-input-group">
            <input type="password" name="password" placeholder="Password">
            <label for="password">Password</label>
            <?php if (!empty($errors['password'])): ?>
                <small>*<?php echo htmlspecialchars($errors['password']) ?></small>
            <?php endif ?>
        </div>
        <div class="auth-input-group">
            <input type="password" name="confirmPassword" placeholder="Confirm Password">
            <label for="confirmPassword">Confirm Password</label>
            <?php if (!empty($errors['confirmPassword'])): ?>
                <small>*<?php echo htmlspecialchars($errors['confirmPassword']) ?></small>
            <?php endif ?>
        </div>

        <div class="auth-message">
            Already have an account? <a href="/login">Login here.</a>
        </div>

        <button type="submit" class="auth-submit">Register</button>
    </form>
</div>
