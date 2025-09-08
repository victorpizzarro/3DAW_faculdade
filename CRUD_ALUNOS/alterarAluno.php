<!DOCTYPE html>
<html>
   <head>    
   <?php include 'MenuAlunos.html'; ?>
   </head>
   <body>
       <h1>Editar Alunos</h1>
       <form action="alterarAluno2.php" method="POST">
       Qual aluno deseja editar:
       <input type="text" name="matricula">
       <input type="submit" value="Ok" href="alterarAluno2.php">
   </body>
</html>