<div class="forma">
    <form action="/user/register" method="post">
        <div class="title">
            <h1>Реєстрація</h1>
        </div>

        <div>
            <label>Ім'я:</label>
            <input type="text" name="first_name" title="не менше 3 символа" required>
        </div>

        <div>
            <label>Прізвище:</label>
            <input type="text" name="last_name" title="не менше 3 символа" required>
        </div>

        <div>
            <label>email:</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Пароль:</label>
            <input type="password" name="password" title="не менше 6 символів" required>
        </div>

        <div>
            <label>Повторіть пароль:</label>
            <input type="password" name="password2" required>
        </div>

        <div class="buttons">
            <button class="btn" name="signup">Реєстрація</button>
        </div>
    </form>
</div>