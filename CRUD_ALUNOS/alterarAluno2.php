<?php
   $materiaOriginal = $_POST["matricula"];
   $arquivo = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo!");
   $colunaDados = []; 

   while (($linha = fgets($arquivo)) !== false) {
       $linha = trim($linha);

     
       if ($linha === "") {
           continue;
       }

       $colunaDados = explode(";", $linha);

      
       if (count($colunaDados) < 2) {
           continue;
       }

       if ($colunaDados[1] == $materiaOriginal) {
           break;
       }
   }
   fclose($arquivo);
?>
<!DOCTYPE html>
<html>
   <head>
   </head>
   <body>
       <h1>Digite o que deseja editar:</h1>
       <form action="alterarAluno3.php" method="POST">
           <input type="hidden" name="matriculaOriginal" value="<?php echo $materiaOriginal; ?>">
           <input type="text" name="nome" value="<?php echo $colunaDados[0] ?? ''; ?>">
           <input type="text" name="matricula" value="<?php echo $colunaDados[1] ?? ''; ?>">
           <input type="text" name="nascimento" value="<?php echo $colunaDados[2] ?? ''; ?>">
           <input type="text" name="cpf" value="<?php echo $colunaDados[3] ?? ''; ?>">
           <input type="submit" value="Editar">
       </form>
   </body>
</html
