<!doctype html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Administrace</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form id="login" method="POST">
            <h1>Přihlášení</h1>
            <fieldset id="inputs">
                <input id="username" name="username" type="text" placeholder="Uživ. jméno" autofocus required>
                <input id="password" name="password" type="password" placeholder="Heslo" required>
            </fieldset>
            <fieldset id="actions">
                <input type="submit" id="submit" value="Přihlásit">
            </fieldset>
        </form>
    </body>
</html>
