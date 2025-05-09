<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .cadastro {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 16px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #444;
            color: #fff;
        }
        .button-container {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .button-container input {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            color: #000;
            font-size: 16px;
            cursor: pointer;
        }
        .button-container input:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <div class="cadastro">
        <form action="verifica_login.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required/>
            
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required/>
            
            <div class="button-container">
                <input type="submit" value="Logar"/>
            </div>
        </form>
    </div>
</body>
</html>