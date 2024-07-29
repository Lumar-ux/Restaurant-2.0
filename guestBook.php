<?php
try{
  $mysqlClient = new PDO('mysql:host=localhost;dbname=db_tavola;charset=utf8','root','', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
}
catch (Exception $e)
{
  die('Erreur :'.$e->getMessage());
}
?>
<?php 
  $sqlQuerry = 'SELECT * FROM users';
  $tavolaStatement = $mysqlClient->prepare($sqlQuerry);
  $tavolaStatement->execute();
  $tavola = $tavolaStatement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en" class="html-backoffice">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/index.css" />
    <title>Guest Book</title>
  </head>
  <body style="background-color: #f1ebd9;">
    <main>
      <aside>
        <section id="sec-logo-backoffice">
          <img src="images/logo_tavola_colo_02.svg" alt="logo tavola" class="w-100">
        </section>
        <section class="sidebar">
          <a href="backoffice.php">Messages</a>
          <a href="#">Guest book</a>
          <a href="#">Gallery</a>
        </section>
      </aside>
      <section id="cont-contact" class="container px-0">
        <article class="row m-0">
          <div class="col-12 p-0 d-flex justify-content-center">
            <h1 class="text-uppercase">Guest Book</h1>
          </div>
        </article>
        <article class="row m-0">
          <div class="col px-0">
            <table id="tab-back" class="w-100 border border-2">
              <thead>
                <td class="corner-left_backoffice">Date</td>
                <td>Name</td>
                <td>Email</td>
                <td>Visited Resto</td>
                <td>Message</td>
                <td class="corner-right_backoffice">Delete</td>
              </thead>
              <tbody>
              <form action="delete_data.php" method="POST">
                <?php 
                $setDate = new DateTime();
                $date = $setDate->format('Y-m-d H:i:s');
                foreach ($tavola as $donnee):  
                  ?>
                  
                  <tr>
                    <td name="user_id"><?= $donnee['date1'] ?></td>
                    <td><?= htmlspecialchars($donnee['firstname'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars($donnee['lastname'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars($donnee['email'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars($donnee['motif'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars($donnee['message'], ENT_QUOTES) ?></td>
                    <td>
                      <input type="hidden" name="user_id" value="<?= htmlspecialchars($donnee['user_id'], ENT_QUOTES) ?>"> 
                      <button type="submit" name="submit" class="delete_button bg-transparent border border-0"><img src="images/delete_32dp_000000_FILL0_wght400_GRAD0_opsz40.svg" alt="delete_icon"></button>
                    
                    </td>
                  </tr>
                <?php endforeach; ?>
              </form>
              </tbody>
            </table>
          </div>
        </article>
      </section>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>