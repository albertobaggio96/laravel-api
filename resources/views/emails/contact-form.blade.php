<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>contact form email</title>
</head>
<body>
  <h1>Email inviata</h1>

  <p> La mail è stata inviata da: miaApp</p>

  <p> La mail della persona che ti ha contattato: {{ $lead->email }}</p>

  <p> La mail è stata inviata da: {{ $lead->name }}</p>

  <p>il messaggio che hai scritto: {{ $lead->message }}</p>
</body>
</html>