<div>
    <fieldset>
        <form action="/?c=user&a=register" method="post">
            <div>
                <label for="email">Mail: </label>
                <input id="email" type="email" name="email" placeholder="Adresse mail"  minlength="6" maxlength="150" required>
            </div>

            <div class="margin_div_form">
                <label for="username">Nom d'utilisateur: </label>
                <input id="username" type="text" name="username" placeholder="Nom d'utilisateur" minlength="6" maxlength="40" required>
            </div>

            <div class="margin_div_form">
                <label for="password">Mot de passe: </label>
                <input id="password" type="password" name="password" placeholder="Mot de passe" minlength="8" maxlength="30" required>
            </div>

            <div class="margin_div_form">
                <label for="password_repeat">Répétez le mot de passe: </label>
                <input id="password_repeat" type="password" name="password_repeat" placeholder="Mot de passe" minlength="8" maxlength="30" required>
            </div>

            <div class="margin_div_form button_container">
                <button id="login_button" name="submit">S'inscrire</button>
            </div>

        </form>
    </fieldset>
</div>