<div class="container">
    <h2>Login</h2>

    <?php if(isset($errors['common'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $errors['common'] ?>
        </div>
    <?php endif; ?>

    <?php

        // PREPARE ERRORS
        $loginError          = '';
        $loginClass          = '';
        $passwordError       = '';
        $passwordClass       = '';

        if(isset($errors['login'])) {
            $loginError = $errors['login'];
            $loginClass = 'is-invalid';
        }
        elseif(count($_POST)) {
            $loginClass = 'is-valid';
        }

        if(isset($errors['password'])) {
            $passwordError = $errors['password'];
            $passwordClass = 'is-invalid';
        }
        elseif(count($_POST)) {
            $passwordClass = 'is-valid';
        }

        // PREPARE VALUES FOR POPULATE
        $loginValue = '';
        if(isset($values['login'])) {
            $loginValue = $values['login'];
        }
    ?>

    <form action="" method="POST">

        <!-- LOGIN -->
        <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" class="form-control <?= $loginClass ?>" id="login" placeholder="Enter login" name="login" value="<?= $loginValue ?>">

            <?php if($loginError): ?>
                <div class="invalid-feedback">
                    <?= $loginError ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control <?= $passwordClass ?>" id="password" placeholder="Enter password" name="password">

            <?php if($passwordError): ?>
                <div class="invalid-feedback">
                    <?= $passwordError ?>
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div class="row registration-link">
        <div class="col col-md-12">
            <a href="/user/registration">Registration</a>
        </div>
    </div>

</div>
