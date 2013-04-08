<div class="forma">
    <form action="/user/login" method="post">
        <div class="title">
            <h1>Вхід</h1>
        </div>

        <div>
            <label>email:</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Пароль:</label>
            <input type="password" name="password" required>
            
        </div>

        <div class="buttons">
            <a href="/user/reminder" >Забули пароль?</a>
            <button class="btn" name="signin">Вхід</button>
        </div>
    </form>
</div>