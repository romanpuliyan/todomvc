<div class="container">
    <h2>Login</h2>

    <form action="/action_page.php" class="was-validated">

        <!-- LOGIN -->
        <div class="form-group">
            <label for="uname">Login:</label>
            <input type="text" class="form-control" id="login" placeholder="Enter login" name="login" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div class="row registration-link">
        <div class="col col-md-12">
            <a href="/user/registration">Registration</a>
        </div>
    </div>

</div>
