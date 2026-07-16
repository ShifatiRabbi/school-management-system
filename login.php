<?php include 'header.php'; ?>

<div class="black-fill"><br /> <br />
    <div class="d-flex justify-content-center align-items-center flex-column">
        <form class="login" method="post" action="req/login.php" autocomplete="off">
            <?= csrf_field() ?>
            <div class="text-center">
                <img src="logo.png" width="100" alt="Logo">
            </div>
            <h3>LOGIN</h3>
            <?= alert_from_query() ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="uname" required maxlength="50" autocomplete="username">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" required autocomplete="current-password">
            </div>
            <div class="mb-3">
                <label class="form-label">Login As</label>
                <select class="form-control" name="role" required>
                    <option value="1">Admin</option>
                    <option value="2">Teacher</option>
                    <option value="3">Student</option>
                    <option value="4">Registrar Office</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
