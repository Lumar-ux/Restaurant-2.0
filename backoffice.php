<?php
try{
  $mysqlClient = new PDO('mysql:host=localhost;dbname=db_tavola;charset=utf8','root','');
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
    <title>Backoffice</title>
  </head>
  <body style="background-color: #f1ebd9;">
    <main>
      <aside>
        <section id="sec-logo-backoffice">
          <img src="images/logo_tavola_colo_02.svg" alt="logo tavola" class="w-100">
        </section>
        <section class="sidebar">
          <a href="#">Messages</a>
          <a href="#">Guest book</a>
          <a href="#">Gallery</a>
        </section>
      </aside>
      <section id="cont-contact" class="container px-0">
        <article class="row m-0">
          <div class="col-12 p-0 d-flex justify-content-center">
            <h1>Back Office</h1>
          </div>
        </article>
        <article class="row m-0">
          <div class="col px-0">
            <table id="tab-back" class="w-100 border border-2">
              <thead>
                <td class="corner-left_backoffice">Date</td>
                <td>Name</td>
                <td>Email</td>
                <td>Message</td>
                <td class="corner-right_backoffice">Delete</td>
              </thead>
              <tbody>
                <tr>
                  <td>
                  <?php
                    foreach ($tavola as $tavo) {
                      echo $tavo['email'];
                    }
                  ?>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="corner-left-bottom_backoffice"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="corner-right-bottom_backoffice"></td>
                </tr>
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
