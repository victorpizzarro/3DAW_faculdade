
<!DOCTYPE html>
<html>
   <head>    
   <?php include 'MenuAlunos.html'; ?>
   </head>
   <body>
       <h1>Excluir Alunos</h1>
       <form action="excluirAlunos2.php" method="POST">
       Qual aluno deseja excluir:
       <input type="text" name="matricula">
       <input type="submit" value="Ok" href="excluirAlunos2.php">
   </body>
</html>