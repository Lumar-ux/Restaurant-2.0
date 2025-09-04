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
  // Ensure the gallery table exists and fetch records
  $mysqlClient->exec(
    "CREATE TABLE IF NOT EXISTS gallery (
      id INT AUTO_INCREMENT PRIMARY KEY,
      date1 DATETIME NOT NULL,
      name VARCHAR(255) NOT NULL,
      filename VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
  );
  $sqlQuerry = 'SELECT id, date1, name, filename FROM gallery ORDER BY date1 DESC, id DESC';
  $tavolaStatement = $mysqlClient->prepare($sqlQuerry);
  $tavolaStatement->execute();
  $tavola = $tavolaStatement->fetchAll(PDO::FETCH_ASSOC);
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
          <a href="guestBook.php">Guest book</a>
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
            <section>
                <form action="treatment_galery.php" method="POST" enctype="multipart/form-data" class="d-flex flex-row align-items-center gap-2">
                  <label for="fileInput" class="button py-2 px-3 rounded-2" style="background-color: #73160e; color: #f1ebd9;">Choose an image</label>
                  <input type="file" id="fileInput" name="image" accept="image/*" style="display: none;">
                  <input type="hidden" name="date1" value="<?= (new DateTime())->format('Y-m-d H:i:s'); ?>">
                  <input type="text" name="name" placeholder="Name (optional)" class="form-control" style="max-width: 240px;">
                  <button type="submit" name="submit" class="py-2 px-3 rounded-2 border-2" style="background-color: #f1ebd9; color: #73160e;">Upload</button>
                </form>
            </section>
            <table id="tab-back" class="w-100 border border-2">
              <thead>
                <td class="corner-left_backoffice">Date</td>
                <td>Name</td>
                <td>Preview</td>
                <td class="corner-right_backoffice">Delete</td>
              </thead>
              <tbody>
              <form action="treatment_galery.php" method="POST">
                <?php 
                $setDate = new DateTime();
                $date = $setDate->format('Y-m-d H:i:s');
                foreach ($tavola as $donnee):  
                  ?>
                  
                  <tr>
                    <td><?= htmlspecialchars($donnee['date1'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($donnee['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                      <?php $src = 'images/uploads/' . ($donnee['filename'] ?? ''); ?>
                      <?php if (!empty($donnee['filename'])): ?>
                        <img src="<?= htmlspecialchars($src, ENT_QUOTES, 'UTF-8') ?>" alt="preview" style="max-height:60px" />
                      <?php endif; ?>
                    </td>
                    <td>
                      <input type="hidden" name="delete_id" value="<?= htmlspecialchars($donnee['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"> 
                      <button type="submit" name="delete" class="delete_button bg-transparent border border-0"><img src="images/delete_32dp_000000_FILL0_wght400_GRAD0_opsz40.svg" alt="delete_icon"></button>
                    
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