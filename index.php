<?php
require_once '_connec.php';

         
            //On essaie de se connecter
            try{
                $conn = new PDO("mysql:host=$servername;dbname=pdo_quest", $username, $password);
                //On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'Connexion réussie';
            }
            
            /*On capture les exceptions si une exception est lancée et on affiche
             *les informations relatives à celle-ci*/
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
        ?>

<?php include('inc/head.php'); ?>
    <?php
// Affichage des répertoires et fichiers dans 'files/roswell'
$dir = 'files/roswell';
$baseDir = 'files/roswell';

// Vérification si un dossier ou un fichier a été sélectionné
if (isset($_GET['f'])) {
    $dir = $baseDir . '/' . $_GET['f'];
} else {
    $dir = $baseDir;
}
if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            if (is_dir($dir . '/' . $file)) {
                echo '<a href="?f=' . $file . '">';
                echo '<p>📁 <strong>' . $file . '</strong></p>';
                echo '</a>';
            } else {
                echo '<a href="?f=' . $file . '">';
                echo '<p>📄 ' . $file . '</p>';
                echo '</a>';
            }
        }
    }
}

// Traitement de la soumission du formulaire
if (isset($_POST['content']) && isset($_GET['f'])) {
    $file = 'files/roswell/' . $_GET['f'];
    $newFiles = fopen($file, 'w');
    fwrite($newFiles, $_POST['content']);
    fclose($newFiles);
}

// Affichage du contenu du fichier sélectionné
if (isset($_GET['f'])) {
    $file = 'files/roswell/' . $_GET['f'];
    if (is_file($file)) {
        $content = file_get_contents($file);
        echo '<h2>📄 ' . $_GET['f'] . '</h2>';
        echo '<form action="index.php?f=' . $_GET['f'] . '" method="post">';
        echo '<textarea name="content" style="width:100%; height:200px">' . htmlspecialchars($content) . '</textarea>';
        echo '<input type="submit" value="Envoyer">';
        echo '</form>';
    } else {
        echo '<p>Le fichier sélectionné n\'existe pas.</p>';
    }
}



if (isset($_GET['f'])) {
    echo '<form action="index.php" method="post">';
    echo '<input type="hidden" name="f" value="' . $_GET['f'] . '">';
    echo '<input type="submit" name="delete" value="Supprimer le fichier">';
    echo '</form>';
}

if (isset($_POST['delete']) && isset($_POST['f'])) {
    $fileToDelete = 'files/roswell/' . $_POST['f'];
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo 'Le fichier ' . $_POST['f'] . ' a bien été supprimé.';
    } else {
        echo 'Le fichier à supprimer n\'existe pas.';
    }
}

// Affichage des images dans le répertoire 'files/roswell/photos'
$photoDir = 'files/roswell/photos';
if (is_dir($photoDir)) {
    $photoFiles = scandir($photoDir);
    echo '<h2>Photos</h2>';
    foreach ($photoFiles as $photo) {
        if ($photo != '.' && $photo != '..') {
            echo '<div class="photo">';
            echo '<a href="' . $photoDir . '/' . $photo . '">';
            echo '<img src="' . $photoDir . '/' . $photo . '" alt="' . $photo . '" style="max-width: 200px; max-height: 200px; margin: 10px;">';
            echo '</a>';
            echo '</div>';
        }
    }
}
//Affichage des fichiers dans le répertoire 'files/roswell/maps'
$mapDir = 'files/roswell/maps';
if (is_dir($mapDir)) {
    $mapFiles = scandir($mapDir);
    echo '<h2Carte</h2>';
    foreach ($mapFiles as $map) {
        if ($map != '.' && $map != '..') {
            echo '<div class="map">';
            echo '<a href="' . $mapDir . '/' . $map . '">';
            echo '<img src="' . $mapDir . '/' . $map . '" alt="' . $map . '" style="display:flex;justify-content:center; align-item:center; margin: 10px;">';
            echo '</a>';
            echo '</div>';
        }
    }}
    //Affichage des fichiers dans le répertoire 'files/roswell/newspaper'
$paperDir = 'files/roswell/newspaper';
if (is_dir($paperDir)) {
    $paperFiles = scandir($paperDir);
    echo '<h2Carte</h2>';
    foreach ($paperFiles as $paper) {
        if ($paper != '.' && $paper != '..') {
            echo '<div class="paper">';
            echo '<a href="' . $paperDir . '/' . $paper . '">';
            echo '<img src="' . $paperDir . '/' . $paper . '" alt="' . $paper . '">';
            echo '</a>';
            echo '</div>';
        }
    }

}


?>

<?php include('inc/foot.php'); ?>
