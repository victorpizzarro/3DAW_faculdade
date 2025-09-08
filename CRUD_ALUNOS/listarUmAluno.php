
<!DOCTYPE html>
<html>
   <head>    
   <?php include 'MenuAlunos.html'; ?>
   </head>
   <body>
       <h1>Qual aluno deseja visualizar?</h1>
       <form action="listarUmAluno2.php" method="POST">
       Escreva a matricula do aluno:
       <input type="text" name="matricula">
       <input type="submit" value="Ok" href="listarUmAluno2.php">
   </body>
</html>